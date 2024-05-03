<?php

function createBookingApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $modelProvince = $controller->loadModel('Provinces');
    $userBookingModel = $controller->loadModel('UserBookings');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelUser = $controller->loadModel('Users');
    $modelBookmark = $controller->loadModel('Bookmarks');
    $modelNotification = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        if (isset($dataSend['name'])
            && isset($dataSend['price'])
            && isset($dataSend['departure_province_id'])
            && isset($dataSend['introduce_fee'])
        ) {
            if (!is_numeric($dataSend['price']) || $dataSend['price'] < 0) {
                return apiResponse(2, 'Số tiền không hợp lệ');
            }

            $province = $modelProvince->find()->where([
                'id' => $dataSend['departure_province_id'],
                'status' => 1
            ])->first();

            if (empty($province)) {
                return apiResponse(2, 'Tỉnh khởi hành không hợp lệ');
            }

            if (!is_numeric($dataSend['introduce_fee']) || $dataSend['introduce_fee'] < 0 || $dataSend['introduce_fee'] > 100) {
                return apiResponse(2, 'Tỉ lệ chiết khấu không hợp lệ');
            }

            $now = date('Y-m-d H:i:s');
            if (isset($dataSend['start_time'])) {
                $startTime = date('Y-m-d H:i:s', strtotime($dataSend['start_time']));

                if ($startTime <= $now) {
                    return apiResponse(2, 'Thời gian khởi hành phải lớn hơn hiện tại');
                }
            }

            if (isset($dataSend['finish_time'])) {
                $finishTime = date('Y-m-d H:i:s', strtotime($dataSend['finish_time']));

                if ($finishTime <= $startTime) {
                    return apiResponse(2, 'Thời gian đến phải lớn hơn thời gian khởi hành');
                }
            }

            $booking = $modelBooking->newEmptyEntity();
            $booking->name = $dataSend['name'];
            $booking->posted_by = $currentUser->id;
            $booking->status = $bookingStatus['unreceived'];
            $booking->start_time = $startTime ?? null;
            $booking->finish_time = $finishTime ?? null;
            $booking->departure_province_id = $dataSend['departure_province_id'];
            $booking->destination_province_id = $dataSend['destination_province_id'] ?? null;
            $booking->departure = $dataSend['departure'] ?? null;
            $booking->destination = $dataSend['destination'] ?? null;
            $booking->introduce_fee = $dataSend['introduce_fee'];
            $booking->deposit = $dataSend['deposit'] ?? 0;
            $booking->price = $dataSend['price'];
            $booking->description = $dataSend['description'] ?? null;
            $booking->created_at = $now;
            $booking->updated_at = $now;
            $modelBooking->save($booking);

            if (!empty($dataSend['deposit'])) {
                if ($dataSend['deposit'] > $currentUser->total_coin) {
                    return apiResponse(2, 'Số tiền trong ví không đủ để cọc');
                }

                // Giữ tiền cọc của người đăng
                $currentUser->total_coin -= $dataSend['deposit'];
                $modelUser->save($currentUser);

                $bookingFee = $modelBookingFee->newEmptyEntity();
                $bookingFee->received_fee = 0;
                $bookingFee->service_fee = 0;
                $bookingFee->deposit = $dataSend['deposit'];
                $bookingFee->booking_id = $booking->id;
                $modelBookingFee->save($bookingFee);

                $depositTransaction = $modelTransaction->newEmptyEntity();
                $depositTransaction->user_id = $currentUser->id;
                $depositTransaction->amount = $dataSend['deposit'];
                $depositTransaction->type = $transactionType['subtract'];
                $depositTransaction->booking_id = $booking->id;
                $depositTransaction->name = "Thanh toán tiền cọc khi đăng cuốc xe #$booking->id thành công";
                $depositTransaction->description = '-' . number_format($dataSend['deposit']) . ' EXC-xu';
                $depositTransaction->created_at = date('Y-m-d H:i:s');
                $depositTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($depositTransaction);
            }

            // Lưu lại lịch sử đăng cuốc xe
            $userBooking = $userBookingModel->newEmptyEntity();
            $userBooking->user_id = $currentUser->id;
            $userBooking->booking_id = $booking->id;
            $userBooking->type = $bookingType['post'];
            $userBooking->status = $bookingStatus['unreceived'];
            $userBookingModel->save($userBooking);

            $listUserId = $modelBookmark->find()->where([
                'province_id' => $booking->departure_province_id
            ])->all()->map(function ($item) {
                return $item->user_id;
            })->toArray();

            // Thông báo cho những tài xế quan tâm nhóm
            $title = 'Có một cuốc xe mới được đăng trong nhóm bạn quan tâm';
            $content = "Cuốc xe #$booking->id mới được đăng trong nhóm $province->name";
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'action' => 'newBookingCreated',
                'booking_id' => $booking->id,
            );

            $now = date('Y-m-d H:i:s');
            foreach (array_chunk($listUserId, 1000) as $userIds) {
                $listUser = $modelUser->find()->where(['id IN' => $userIds])->all()->toArray();
                $listToken = [];
                $listNewNotification = [];

                foreach ($listUser as $user) {
                    if (!empty($user['device_token'])) {
                        $listToken[] = $user['device_token'];
                    }

                    $notification = $modelNotification->newEmptyEntity();
                    $notification->user_id = $user['id'];
                    $notification->booking_id = $booking->id;
                    $notification->title = $title;
                    $notification->content = $content;
                    $notification->created_at = $now;
                    $notification->updated_at = $now;
                    $listNewNotification[] = $notification;
                }

                sendNotification($dataSendNotification, $listToken);
                $modelNotification->saveMany($listNewNotification);
            }

            return apiResponse(0, 'Lưu thông tin thành công', $booking);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getBookingListApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelPinnedProvince = $controller->loadModel('PinnedProvinces');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $conditions = [];
        $order = [
            'Bookings.status = 0' => 'DESC',
            'Bookings.created_at' => 'DESC',
        ];
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
        if ($page < 1) $page = 1;
        $conditions['Bookings.status IN'] = [$bookingStatus['unreceived'], $bookingStatus['received'], $bookingStatus['completed'], $bookingStatus['confirmed'], $bookingStatus['paid']];

        if (!empty($dataSend['keyword'])) {
            $conditions[] = ['OR' => [
                ['Bookings.name LIKE' => '%' . $dataSend['keyword'] . '%'],
                ['Bookings.departure LIKE' => '%' . $dataSend['keyword'] . '%'],
                ['Bookings.destination LIKE' => '%' . $dataSend['keyword'] . '%'],
            ]];
        }

        if (!empty($dataSend['province_id'])) {
            $conditions[] = ['OR' => [
                ['Bookings.departure_province_id' => $dataSend['province_id']],
                ['Bookings.destination_province_id' => $dataSend['province_id']]
            ]];
        }

        /*if (!empty($dataSend['access_token'])) {
            // TH: user đã đăng nhập
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            // Mặc định sẽ sắp xếp các cuốc xe có điểm đi hoặc đến các tỉnh được ghim lên trước
            $listPinnedProvince = $modelPinnedProvince->find()
                ->where(['user_id =' => $currentUser->id])
                ->all();

            if (count($listPinnedProvince)) {
                $listPinnedProvinceIds = $listPinnedProvince->map(function ($item) {
                    return $item->province_id;
                })->toArray();
                $listPinnedProvinceIds = implode(',', $listPinnedProvinceIds);
                $order = [
                    "departure_province_id IN ($listPinnedProvinceIds) OR destination_province_id IN ($listPinnedProvinceIds)" => 'DESC'
                ] + $order;
            }
        }*/
        $listData = $modelBooking->find()
            ->join([
                [
                    'table' => 'users',
                    'alias' => 'PostedUsers',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Bookings.posted_by = PostedUsers.id',
                    ],
                ],
            ])->select([
                'Bookings.id', 'Bookings.name', 'Bookings.posted_by', 'Bookings.received_by', 'Bookings.status',
                'Bookings.start_time', 'Bookings.finish_time', 'Bookings.departure', 'Bookings.destination',
                'Bookings.departure_province_id', 'Bookings.destination_province_id', 'Bookings.description',
                'Bookings.introduce_fee', 'Bookings.deposit', 'Bookings.price', 'Bookings.created_at',
                'Bookings.updated_at', 'Bookings.received_at', 'Bookings.canceled_at', 'PostedUsers.name', 'PostedUsers.avatar',
            ])->limit($limit)
            ->page($page)
            ->where($conditions)
            ->order($order)
            ->all()
            ->toList();
        $totalBookings = $modelBooking->find()
            ->where($conditions)
            ->all()
            ->toList();
        $paginationMeta = createPaginationMetaData(count($totalBookings), $limit, $page);

        return apiResponse(0, 'Lấy danh sách cuốc xe thành công', $listData, $paginationMeta);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function receiveBookingApi($input): array
{
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelUser = $controller->loadModel('Users');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');
    $userBookingModel = $controller->loadModel('UserBookings');
    $serviceFee = getServiceFee();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type == 0) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            if (isset($dataSend['booking_id'])) {
                $booking = $modelBooking->find()
                    ->where(['id' => $dataSend['booking_id']])
                    ->first();

                if (!is_null($booking->received_by)) {
                    return apiResponse(4, 'Cuốc xe đã được nhận');
                }
                $receivedFee = ceil($booking->price * $booking->introduce_fee / 100);
                $deposit = $booking->deposit;

                if ($currentUser->total_coin < ($receivedFee + $deposit)) {
                    return apiResponse(4, 'Tổng số dư tài khoản không đủ để nhận cuốc xe');
                }

                // Tạm giữ phí nhận cuốc xe và thu phí sàn
                $bookingFee = $modelBookingFee->find()->where(['booking_id' => $booking->id])->first();
                if (empty($bookingFee)) {
                    $bookingFee = $modelBookingFee->newEmptyEntity();
                    $bookingFee->booking_id = $booking->id;
                }
                $bookingFee->received_fee = $receivedFee;
                $bookingFee->service_fee = $serviceFee;
                /*$bookingFee->deposit = $deposit;        // Tiền cọc đã lưu vào khi tạo cuốc
                $bookingFee->booking_id = $booking->id;*/
                $modelBookingFee->save($bookingFee);

                $totalFee = $receivedFee + $serviceFee + $deposit;
                // Trừ xu của user nhận cuốc xe
                $currentUser->total_coin = $currentUser->total_coin - $totalFee;
                $modelUser->save($currentUser);

                // Update cuốc xe
                $booking->received_by = $currentUser->id;
                $booking->status = $bookingStatus['received'];
                $booking->received_at = date('Y-m-d H:i:s');
                $booking->updated_at = date('Y-m-d H:i:s');
                $modelBooking->save($booking);

                // Lưu lại lịch sử nhận cuốc
                $receivedUserBooking = $userBookingModel->find()->where([
                    'user_id' => $currentUser->id,
                    'booking_id' => $booking->id,
                    'type' => $bookingType['receive'],
                ])->first();
                if (empty($receivedUserBooking)) {
                    $receivedUserBooking = $userBookingModel->newEmptyEntity();
                    $receivedUserBooking->user_id = $currentUser->id;
                    $receivedUserBooking->booking_id = $booking->id;
                    $receivedUserBooking->type = $bookingType['receive'];
                }
                $receivedUserBooking->status = $bookingStatus['received'];
                $receivedUserBooking->received_at = date('Y-m-d H:i:s');
                $receivedUserBooking->canceled_at = null;
                $userBookingModel->save($receivedUserBooking);

                // Update lịch sử cuốc xe của người đăng cuốc
                $postedUserBooking = $userBookingModel->find()->where([
                    'user_id' => $booking->posted_by,
                    'booking_id' => $booking->id,
                    'type' => $bookingType['post'],
                ])->first();
                if (!empty($postedUserBooking)) {
                    $postedUserBooking->status = $bookingStatus['received'];
                    $postedUserBooking->received_at = date('Y-m-d H:i:s');
                    $userBookingModel->save($postedUserBooking);
                }

                // Save transaction
                // Giao dịch trừ phí nhận cuốc xe
                $receiveTransaction = $modelTransaction->newEmptyEntity();
                $receiveTransaction->user_id = $currentUser->id;
                $receiveTransaction->amount = $receivedFee;
                $receiveTransaction->type = $transactionType['subtract'];
                $receiveTransaction->booking_id = $booking->id;
                $receiveTransaction->name = "Thanh toán chiết khấu cuốc xe #$booking->id thành công";
                $receiveTransaction->description = '-' . number_format($receivedFee) . ' EXC-xu';
                $receiveTransaction->created_at = date('Y-m-d H:i:s');
                $receiveTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($receiveTransaction);

                // Giao dịch trừ phí sàn
                if ($serviceFee) {
                    $serviceTransaction = $modelTransaction->newEmptyEntity();
                    $serviceTransaction->user_id = $currentUser->id;
                    $serviceTransaction->amount = $serviceFee;
                    $serviceTransaction->type = $transactionType['subtract'];
                    $serviceTransaction->booking_id = $booking->id;
                    $serviceTransaction->name = "Thanh toán phí sàn khi nhận cuốc xe #$booking->id thành công";
                    $serviceTransaction->description = '-' . number_format($serviceFee) . ' EXC-xu';
                    $serviceTransaction->created_at = date('Y-m-d H:i:s');
                    $serviceTransaction->updated_at = date('Y-m-d H:i:s');
                    $modelTransaction->save($serviceTransaction);
                }

                if ($deposit) {
                    $depositTransaction = $modelTransaction->newEmptyEntity();
                    $depositTransaction->user_id = $currentUser->id;
                    $depositTransaction->amount = $deposit;
                    $depositTransaction->type = $transactionType['subtract'];
                    $depositTransaction->booking_id = $booking->id;
                    $depositTransaction->name = "Thanh toán tiền cọc khi nhận cuốc xe #$booking->id thành công";
                    $depositTransaction->description = '-' . number_format($deposit) . ' EXC-xu';
                    $depositTransaction->created_at = date('Y-m-d H:i:s');
                    $depositTransaction->updated_at = date('Y-m-d H:i:s');
                    $modelTransaction->save($depositTransaction);
                }

                // Thông báo trừ tiền
                // Thông báo cho người đăng cuốc xe
                $title = 'Trừ EXC coin khi nhận chuyến';
                $content = "Tài khoản của bạn đã bị trừ $totalFee coin khi nhận cuốc xe #$booking->id, vui lòng vào phần thông tin giao dịch để xem chi tiết";
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $currentUser->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);

                if ($currentUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'receiveBookingSuccess'
                    );
                    sendNotification($dataSendNotification, $currentUser->device_token);
                }

                // Thông báo cho người đăng cuốc xe
                $title = 'Cuốc xe đã được nhận';
                $content = "Cuốc xe #$booking->id đã được nhận bởi tài xế $currentUser->name";
                $postedUser = $modelUser->find()->where(['id' => $booking->posted_by])->first();
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $postedUser->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);

                if ($postedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'receiveBookingSuccess'
                    );
                    sendNotification($dataSendNotification, $postedUser->device_token);
                }

                return apiResponse(0, 'Nhận cuốc xe thành công');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function cancelReceiveBookingApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');
    $canceledBookingModel = $controller->loadModel('CanceledBookingRequests');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type == 0) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            if (isset($dataSend['booking_id'])) {
                $booking = $modelBooking->find()
                    ->where(['id' => $dataSend['booking_id']])
                    ->first();

                if ($booking->received_by != $currentUser->id) {
                    return apiResponse(4, 'Bạn không phải người nhận cuốc xe này nên không thể hủy');
                }

                if ($booking->status == $bookingStatus['completed']) {
                    return apiResponse(4, 'Cuốc xe đã hoàn thành nên không thể hủy');
                }

                $canceledBooking = $canceledBookingModel->newEmptyEntity();
                $canceledBooking->booking_id = $booking->id;
                $canceledBooking->user_id = $currentUser->id;
                $canceledBooking->status = 0;
                $canceledBooking->created_at = date('Y-m-d H:i:s');
                $canceledBooking->updated_at = date('Y-m-d H:i:s');
                $canceledBookingModel->save($canceledBooking);

                // Thông báo cho người đăng cuốc xe
                $title = 'Tài xế đã hủy nhận cuốc xe';
                $content = "Tài xế $currentUser->name đã hủy nhận cuốc xe #$booking->id";
                $postedUser = $modelUser->find()->where(['id' => $booking->posted_by])->first();
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $postedUser->id;
                $notification->booking_id = $booking->id;
                $notification->request_id = $canceledBooking->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);

                if ($postedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'cancelReceiveBookingSuccess',
                        'user_id' => $currentUser->id,
                        'booking_id' => $booking->id,
                        'request_id' => $canceledBooking->id
                    );
                    sendNotification($dataSendNotification, $postedUser->device_token);
                }

                return apiResponse(0, 'Gửi yêu cầu hủy cuốc xe thành công');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function acceptCanceledBookingApi($input): array
{
    global $controller, $bookingStatus, $bookingType, $transactionType;
    global $isRequestPost;

    $bookingModel = $controller->loadModel('Bookings');
    $canceledBookingModel = $controller->loadModel('CanceledBookingRequests');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $userBookingModel = $controller->loadModel('UserBookings');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type != 2) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            if (empty($dataSend['request_id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            $request = $canceledBookingModel->find()->where(['id' => $dataSend['request_id']])->first();
            if (empty($request)) {
                return apiResponse(4, 'Không tìm thấy dữ liệu');
            }

            $booking = $bookingModel->find()->where(['id' => $request->booking_id])->first();

            if ($booking->posted_by != $currentUser->id) {
                return apiResponse(4, 'Bạn không phải người đăng cuốc xe này');
            }

            $cancelUser = $modelUser->find()->where(['id' => $booking->received_by])->first();
            $bookingFee = $modelBookingFee->find()
                ->where(['booking_id' => $booking->id])
                ->first();

            // Cộng lại số tiền chiết khấu
            $refundCoin = $bookingFee->received_fee + $bookingFee->service_fee + $bookingFee->deposit;
            $cancelUser->total_coin += $refundCoin;
            $modelUser->save($cancelUser);

            // Update trạng thái cuốc xe
            $booking->received_by = null;
            $booking->status = $bookingStatus['unreceived'];
            $booking->received_at = null;
            $booking->updated_at = date('Y-m-d H:i:s');
            $bookingModel->save($booking);

            // Update phí cuốc xe
            /*
            $bookingFee->received_fee = 0;
            $bookingFee->service_fee = 0;
            $modelBookingFee->save($bookingFee);
            */

            // Lưu lại lịch sử hủy cuốc của tài xế
            $canceledBooking = $userBookingModel->find()->where([
                'user_id' => $cancelUser->id,
                'booking_id' => $booking->id,
                'type' => $bookingType['receive'],
            ])->first();
            if (!empty($canceledBooking)) {
                $canceledBooking->status = $bookingStatus['canceled'];
                $canceledBooking->canceled_at = date('Y-m-d H:i:s');
                $canceledBooking->received_at = null;
                $userBookingModel->save($canceledBooking);
            }

            // Update lịch sử cuốc xe của người đăng
            $postedUserBooking = $userBookingModel->find()->where([
                'user_id' => $booking->posted_by,
                'booking_id' => $booking->id,
                'type' => $bookingType['post'],
            ])->first();
            if (!empty($postedUserBooking)) {
                $postedUserBooking->status = $bookingStatus['unreceived'];
                $postedUserBooking->received_at = null;
                $userBookingModel->save($postedUserBooking);
            }

            // Update trạng thái yêu cầu
            $request->status = 1;
            $canceledBookingModel->save($request);

            // Lưu giao dịch hoàn tiền
            $newTransaction = $modelTransaction->newEmptyEntity();
            $newTransaction->user_id = $cancelUser->id;
            $newTransaction->booking_id = $booking->id;
            $newTransaction->amount = $refundCoin;
            $newTransaction->type = $transactionType['add'];
            $newTransaction->name = "Hoàn phí nhận cuốc xe #$booking->id thành công";
            $newTransaction->description = '+' . number_format($refundCoin) . ' EXC-xu';
            $newTransaction->created_at = date('Y-m-d H:i:s');
            $newTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($newTransaction);

            // Thông báo cho người hủy cuốc xe
            $title = 'Yêu cầu hủy cuốc xe đã được chấp nhận';
            $content = "Tài xế $currentUser->name đã chấp nhận hủy cuốc xe #$booking->id";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $cancelUser->id;
            $notification->request_id = $request->id;
            $notification->booking_id = $booking->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);

            if ($cancelUser->device_token) {
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'cancelReceiveBookingSuccess',
                    'booking_id' => $booking->id,
                    'request_id' => $request->id
                );
                sendNotification($dataSendNotification, $cancelUser->device_token);
            }

            return apiResponse(0, 'Thao tác thành công');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function rejectCanceledBookingApi($input): array
{
    global $controller;
    global $isRequestPost;

    $bookingModel = $controller->loadModel('Bookings');
    $canceledBookingModel = $controller->loadModel('CanceledBookingRequests');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type != 2) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            if (empty($dataSend['request_id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            $request = $canceledBookingModel->find()->where(['id' => $dataSend['request_id']])->first();
            if (empty($request)) {
                return apiResponse(4, 'Không tìm thấy dữ liệu');
            }

            $booking = $bookingModel->find()->where(['id' => $request->booking_id])->first();
            $cancelUser = $modelUser->find()->where(['id' => $booking->received_by])->first();

            if ($booking->posted_by != $currentUser->id) {
                return apiResponse(4, 'Bạn không phải người đăng cuốc xe này');
            }

            $title = 'Yêu cầu hủy cuốc xe thất bại';
            $content = "Người đăng chuyến không đồng ý hủy chuyến vui lòng liên hệ với người đăng";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $cancelUser->id;
            $notification->request_id = $request->id;
            $notification->booking_id = $booking->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);

            if ($cancelUser->device_token) {
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'cancelReceiveBookingFailed',
                    'booking_id' => $booking->id,
                );
                sendNotification($dataSendNotification, $cancelUser->device_token);
            }

            return apiResponse(0, 'Thao tác thành công');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function completeBookingApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');
    $userBookingModel = $controller->loadModel('UserBookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type == 0) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            if (isset($dataSend['booking_id'])) {
                $booking = $modelBooking->find()
                    ->where(['id' => $dataSend['booking_id']])
                    ->first();

                if ($booking->received_by !== $currentUser->id) {
                    return apiResponse(4, 'Bạn không phải người nhận cuốc xe này');
                }

                if ($booking->status == $bookingStatus['completed']) {
                    return apiResponse(4, 'Cuốc xe đã được hoàn thành rồi');
                }

                $booking->status = $bookingStatus['completed'];
                $booking->completed_at = date('Y-m-d H:i:s');
                $booking->updated_at = date('Y-m-d H:i:s');
                $modelBooking->save($booking);

                // Lưu lịch sử đăng cuốc xe và nhận cuốc xe
                $receivedUserBooking = $userBookingModel->find()->where([
                    'user_id' => $currentUser->id,
                    'booking_id' => $booking->id,
                    'type' => $bookingType['receive'],
                ])->first();
                if (!empty($receivedUserBooking)) {
                    $receivedUserBooking->status = $bookingStatus['completed'];
                    $userBookingModel->save($receivedUserBooking);
                }

                $postedUserBooking = $userBookingModel->find()->where([
                    'user_id' => $booking->posted_by,
                    'booking_id' => $booking->id,
                    'type' => $bookingType['post'],
                ])->first();
                if (!empty($postedUserBooking)) {
                    $postedUserBooking->status = $bookingStatus['completed'];
                    $userBookingModel->save($postedUserBooking);
                }

                // Thông báo cho người đăng cuốc xe
                $title = 'Cuốc xe đã hoàn thành';
                $content = "Cuốc xe #$booking->id đã được hoàn thành bởi tài xế $currentUser->name";
                $postedUser = $modelUser->find()->where(['id' => $booking->posted_by])->first();
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $postedUser->id;
                $notification->booking_id = $booking->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);

                if ($postedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'completeBookingSuccess',
                        'booking_id' => $booking->id,
                    );
                    sendNotification($dataSendNotification, $postedUser->device_token);
                }

                return apiResponse(0, 'Bạn đã hoàn thành cuốc xe');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function confirmFinishedBookingApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type == 0) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            if (isset($dataSend['booking_id'])) {
                $booking = $modelBooking->find()
                    ->where(['id' => $dataSend['booking_id']])
                    ->first();

                if (empty($booking)) {
                    return apiResponse(3, 'Cuốc xe không tồn tại.');
                }

                if ($currentUser->id != $booking->posted_by) {
                    return apiResponse(3, 'Bạn không phải người đăng cuốc xe này.');
                }

                if ($booking->status != $bookingStatus['completed']) {
                    return apiResponse(3, 'Cuốc xe chưa được hoàn thành bởi tài xế.');
                }

                $booking->status = $bookingStatus['confirmed'];
                $booking->updated_at = date('Y-m-d H:i:s');
                $modelBooking->save($booking);

                // Thông báo cho người nhận cuốc xe
                $title = 'Cuốc xe đã được xác nhận hoàn thành';
                $content = "Cuốc xe #$booking->id đã được xác nhận hoàn thành bởi người đăng $currentUser->name";
                $receivedUser = $modelUser->find()->where(['id' => $booking->received_by])->first();
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $receivedUser->id;
                $notification->booking_id = $booking->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);

                if ($receivedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'confirmBookingSuccess',
                        'booking_id' => $booking->id,
                    );
                    sendNotification($dataSendNotification, $receivedUser->device_token);
                }

                return apiResponse(0, 'Xác nhận thành công.');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function checkFinishedBookingApi($input): array
{
    /*global $controller;
    global $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingFeeStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $now = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $bookingList = $modelBooking->find()
            ->where([
                'status' => $bookingStatus['confirmed'],
                'completed_at <=' => $now->sub(new DateInterval('P1D'))->format('Y-m-d H:i:s'),
                'completed_at >=' => $now->sub(new DateInterval('P2D'))->format('Y-m-d H:i:s'),
            ])->all();

        foreach ($bookingList as $booking) {
            $bookingFee = $modelBookingFee->find()
                ->where(['booking_id' => $booking->id])
                ->first();

            $postedUser = $modelUser->find()
                ->where(['id' => $booking->posted_by])
                ->first();
            $postedUser->total_coin += $bookingFee->received_fee;
            $booking->status = $bookingStatus['paid'];
            $bookingFee->status = $bookingFeeStatus['paid'];

            $modelUser->save($postedUser);
            $modelBooking->save($booking);

            // Save transaction
            $newTransaction = $modelTransaction->newEmptyEntity();
            $newTransaction->user_id = $postedUser->id;
            $newTransaction->booking_id = $booking->id;
            $newTransaction->amount = $bookingFee->received_fee;
            $newTransaction->type = $transactionType['add'];
            $newTransaction->name = "Nhận thanh toán cuốc xe #$booking->id thành công";
            $newTransaction->description = '+' . number_format($bookingFee->received_fee) . ' EXC-xu';
            $newTransaction->created_at = date('Y-m-d H:i:s');
            $newTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($newTransaction);

            // Thông báo cho người đăng
            $title = 'Cộng EXC coin vào tài khoản';
            $content = "Tài khoản của bạn được công thêm $bookingFee->received_fee phí giới thiệu cuốc xe #$booking->id";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $postedUser->id;
            $notification->booking_id = $booking->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);
            if ($postedUser->device_token) {
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'addMoneySuccess',
                    'user_id' => $postedUser->id,
                    'booking_id' => $booking->id,
                );
                sendNotification($dataSendNotification, $postedUser->device_token);
            }

            // Thông báo cộng tiền cọc
            if ($bookingFee->deposit) {
                // Người nhận chuyến
                $receivedUser = $modelUser->find()
                    ->where(['id' => $booking->received_by])
                    ->first();
                $receivedUser->total_coin += $bookingFee->deposit;
                $modelUser->save($receivedUser);

                // Save transaction
                $newTransaction = $modelTransaction->newEmptyEntity();
                $newTransaction->user_id = $receivedUser->id;
                $newTransaction->booking_id = $booking->id;
                $newTransaction->amount = $bookingFee->deposit;
                $newTransaction->type = $transactionType['add'];
                $newTransaction->name = "Nhận lại tiền cọc cuốc xe #$booking->id thành công";
                $newTransaction->description = '+' . number_format($bookingFee->deposit) . ' EXC-xu';
                $newTransaction->created_at = date('Y-m-d H:i:s');
                $newTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($newTransaction);

                // Thông báo cho người nhận
                $title = 'Cộng EXC coin vào tài khoản';
                $content = "Tài khoản của bạn được trả lại $bookingFee->deposit tiền cọc cho cuốc xe #$booking->id";
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $receivedUser->id;
                $notification->booking_id = $booking->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);
                if ($receivedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'addMoneySuccess',
                        'user_id' => $receivedUser->id,
                        'booking_id' => $booking->id,
                    );
                    sendNotification($dataSendNotification, $receivedUser->device_token);
                }

                // Người đăng chuyến
                $postedUser = $modelUser->find()
                    ->where(['id' => $booking->posted_by])
                    ->first();
                $postedUser->total_coin += $bookingFee->deposit;
                $modelUser->save($postedUser);

                $newTransaction = $modelTransaction->newEmptyEntity();
                $newTransaction->user_id = $postedUser->id;
                $newTransaction->booking_id = $booking->id;
                $newTransaction->amount = $bookingFee->deposit;
                $newTransaction->type = $transactionType['add'];
                $newTransaction->name = "Nhận lại tiền cọc cuốc xe #$booking->id thành công";
                $newTransaction->description = '+' . number_format($bookingFee->deposit) . ' EXC-xu';
                $newTransaction->created_at = date('Y-m-d H:i:s');
                $newTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($newTransaction);

                // Thông báo cho người đăng
                $title = 'Cộng EXC coin vào tài khoản';
                $content = "Tài khoản của bạn được trả lại $bookingFee->deposit tiền cọc cho cuốc xe #$booking->id";
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $postedUser->id;
                $notification->booking_id = $booking->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->updated_at = date('Y-m-d H:i:s');
                $modelNotification->save($notification);
                if ($postedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'addMoneySuccess',
                        'user_id' => $postedUser->id,
                        'booking_id' => $booking->id,
                    );
                    sendNotification($dataSendNotification, $postedUser->device_token);
                }
            }

            $modelBookingFee->save($bookingFee);
        }

        return apiResponse(0, 'Thanh toán phí thành công', $bookingList->toList());
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');*/

    return checkFinishedBooking();
}

function getMyBookingListApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $userBookingModel = $controller->loadModel('UserBookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type == 0) {
                return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
            }

            $conditions = [];
            $order = [];
            $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
            $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

            // Filter by date
            $numberOfDays = 30;
            if (!empty($dataSend['from_date']) && !empty($dataSend['to_date'])) {
                $from = DateTime::createFromFormat('d/m/Y', $dataSend['from_date']);
                $to = DateTime::createFromFormat('d/m/Y', $dataSend['to_date']);
                $fromDate = $from->format('Y-m-d');
                $toDate = $to->format('Y-m-d') . ' 23:59:59';
                $interval = $from->diff($to);
                $numberOfDays = $interval->days;
            } else {
                $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                $fromDate = $date->sub(new DateInterval('P30D'))->format('Y-m-d');
                $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                $toDate = $date->add(new DateInterval('P1D'))->format('Y-m-d');
            }

            $query = $userBookingModel->find()
                ->join([
                    [
                        'table' => 'bookings',
                        'alias' => 'Bookings',
                        'type' => 'LEFT',
                        'conditions' => [
                            'UserBookings.booking_id = Bookings.id',
                        ],
                    ],
                    [
                        'table' => 'users',
                        'alias' => 'PostedUsers',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Bookings.posted_by = PostedUsers.id',
                        ],
                    ],
                    [
                        'table' => 'users',
                        'alias' => 'ReceivedUsers',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Bookings.received_by = ReceivedUsers.id',
                        ],
                    ],
                    [
                        'table' => 'provinces',
                        'alias' => 'DepartureProvinces',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Bookings.departure_province_id = DepartureProvinces.id',
                        ],
                    ],
                    [
                        'table' => 'provinces',
                        'alias' => 'DestinationProvinces',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Bookings.destination_province_id = DestinationProvinces.id',
                        ],
                    ]
                ]);

            $conditions['user_id'] = $currentUser->id;
            if (!empty($dataSend['type']) && $dataSend['type'] === 'receive') {
                $conditions['UserBookings.type'] = $bookingType['receive'];
                $conditions['UserBookings.status <>'] = $bookingStatus['canceled'];
                $conditions['OR'][] = [
                    'AND' => [
                        'UserBookings.received_at >=' => $fromDate,
                        'UserBookings.received_at <=' => $toDate,
                    ],
                ];
                /*$conditions['OR'][] = [
                    'AND' => [
                        'UserBookings.canceled_at >=' => $fromDate,
                        'UserBookings.canceled_at <=' => $toDate,
                    ]
                ];*/

                $order['UserBookings.received_at'] = 'DESC';
                $order['UserBookings.canceled_at'] = 'DESC';
            } else {
                $conditions['UserBookings.type'] = $bookingType['post'];
                $conditions['UserBookings.created_at >='] = $fromDate;
                $conditions['UserBookings.created_at <'] = $toDate;
                $order['Bookings.created_at'] = 'DESC';
            }

            $listData = $query->select([
                    'UserBookings.id',
                    'UserBookings.status',
                    'UserBookings.received_at',
                    'UserBookings.canceled_at',
                    'Bookings.id',
                    'Bookings.name',
                    'Bookings.price',
                    'Bookings.introduce_fee',
                    'Bookings.deposit',
                    'Bookings.start_time',
                    'Bookings.finish_time',
                    'Bookings.status',
                    'Bookings.created_at',
                    'PostedUsers.id',
                    'PostedUsers.name',
                    'PostedUsers.phone_number',
                    'PostedUsers.avatar',
                    'ReceivedUsers.id',
                    'ReceivedUsers.name',
                    'ReceivedUsers.phone_number',
                    'ReceivedUsers.avatar',
                    'DepartureProvinces.id',
                    'DepartureProvinces.name',
                    'DestinationProvinces.id',
                    'DestinationProvinces.name',
                ])->limit($limit)
                ->page($page)
                ->where($conditions)
                ->order($order)
                ->all()
                ->toList();
            foreach ($listData as $key => $item) {
                $item->Bookings['id'] = (int)$item->Bookings['id'];
                $item->Bookings['status'] = (int)$item->Bookings['status'];
                $item->Bookings['price'] = (int)$item->Bookings['price'];
                $item->PostedUsers['id'] = (int)$item->PostedUsers['id'];
                $item->ReceivedUsers['id'] = (int)$item->ReceivedUsers['id'];
                $item->DepartureProvinces['id'] = (int)$item->DepartureProvinces['id'];
                $item->DestinationProvinces['id'] = (int)$item->DestinationProvinces['id'];
            }
            $totalBookings = $query->where($conditions)->count();
            $paginationMeta = createPaginationMetaData($totalBookings, $limit, $page);

            $statsData = $userBookingModel->find()
                ->where($conditions)
                ->all();
            $total = count($statsData);
            $count = [
                'unreceived' => 0,
                'received' => 0,
                'completed' => 0,
            ];
            foreach ($statsData as $item) {
                if ($item->status == $bookingStatus['unreceived']) {
                    ++$count['unreceived'];
                } elseif ($item->status == $bookingStatus['completed'] || $item->status === $bookingStatus['confirmed'] || $item->status === $bookingStatus['paid']) {
                    ++$count['completed'];
                } elseif ($item->status == $bookingStatus['received']) {
                    ++$count['received'];
                }
            }

            $receiveRate = isset($count['received']) && !empty($total) ? round($count['received'] / $total, 1) : 0;
            $finishRate = isset($count['completed']) && !empty($total) ? round($count['completed'] / $total, 1) : 0;
            $cancelRate = isset($count['unreceived']) && !empty($total) ? round($count['unreceived'] / $total, 1) : 0;
            $bookingsPerDay = !empty($numberOfDays) ? round($total / $numberOfDays, 1) : 0;

            $data = [
                'stats' => [
                    'total' => $count,
                    'received' => [
                        'count' => $count['received'] ?? 0,
                        'rate' => $receiveRate,
                    ],
                    'finished' => [
                        'count' => $count['completed'] ?? 0,
                        'rate' => $finishRate,
                    ],
                    'unreceived' => [
                        'count' => $count['unreceived'] ?? 0,
                        'rate' => $cancelRate,
                    ],
                    'average' => $bookingsPerDay
                ],
                'listData' => $listData,
            ];

            return apiResponse(0, 'Lấy danh sách cuốc xe thành công', $data, $paginationMeta);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function viewBookingDetailApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelBooking = $controller->loadModel('Bookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id'])) {
            $booking = getDetailBooking($dataSend['id']);

            return apiResponse(0, 'Lấy dữ liệu thành công', $booking);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function updateBookingApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelProvince = $controller->loadModel('Provinces');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        if (!empty($dataSend['id'])) {
            $booking = $modelBooking->find()
                ->where(['id' => $dataSend['id']])
                ->first();

            if (!$booking) {
                return apiResponse(4, 'Cuốc xe không tồn tại');
            }

            if ($booking->posted_by !== $currentUser->id) {
                return apiResponse(5, 'Bạn không phải người tạo cuốc xe này nên không có quyền chỉnh sửa');
            }

            $now = date('Y-m-d H:i:s');
            $listProvince = $modelProvince->find()->where([
                'status' => 1
            ])->all();
            $listProvinceIds = $listProvince->map(function ($item) {
                return $item->id;
            })->toArray();

            // Validate data
            if (!empty($dataSend['name'])) {
                $booking->name = $dataSend['name'];
            }

            if (isset($dataSend['price'])) {
                if (!is_numeric($dataSend['price']) || $dataSend['price'] < 0) {
                    return apiResponse(2, 'Số tiền không hợp lệ');
                }

                $booking->price = $dataSend['price'];
            }

            if (!empty($dataSend['departure_province_id'])) {
                if (!in_array($dataSend['departure_province_id'], $listProvinceIds)) {
                    return apiResponse(2, 'Tỉnh khởi hành không hợp lệ');
                }

                $booking->departure_province_id = $dataSend['departure_province_id'];
            }


            if (!empty($dataSend['destination_province_id'])) {
                if (!in_array($dataSend['destination_province_id'], $listProvinceIds)) {
                    return apiResponse(2, 'Tỉnh đến không hợp lệ');
                }

                $booking->destination_province_id = $dataSend['destination_province_id'];
            }

            if (isset($dataSend['introduce_fee'])) {
                if (!is_numeric($dataSend['introduce_fee']) || $dataSend['introduce_fee'] < 0 || $dataSend['introduce_fee'] > 100) {
                    return apiResponse(2, 'Tỉ lệ chiết khấu không hợp lệ');
                }

                $booking->introduce_fee = $dataSend['introduce_fee'];
            }

            if (!empty($dataSend['start_time'])) {
                $startTime = date('Y-m-d H:i:s', strtotime($dataSend['start_time']));
                if ($startTime <= $now) {
                    return apiResponse(2, 'Thời gian khởi hành phải lớn hơn hiện tại');
                }

                $booking->start_time = $startTime;
            }

            if (!empty($dataSend['finish_time'])) {
                $finishTime = date('Y-m-d H:i:s', strtotime($dataSend['finish_time']));
                if ($finishTime <= $booking->start_time) {
                    return apiResponse(2, 'Thời gian đến phải lớn hơn thời gian khởi hành');
                }

                $booking->finish_time = $finishTime;
            }

            if (!empty($dataSend['departure'])) {
                $booking->departure = $dataSend['departure'];
            }

            if (!empty($dataSend['destination'])) {
                $booking->destination = $dataSend['destination'];
            }

            if (!empty($dataSend['description'])) {
                $booking->description = $dataSend['description'];
            }

            if (!empty($dataSend['deposit'])) {
                $booking->deposit = $dataSend['deposit'];
            }

            if (!empty($dataSend['status'])) {
                if (!in_array($dataSend['status'], $bookingStatus)) {
                    return apiResponse(2, 'Trạng thái không hợp lệ');
                }

                if ($booking->status !== $bookingStatus['unreceived']) {
                    return apiResponse(2, 'Cuốc xe đã được nhận, bạn không thể thay đổi trạng thái');
                }
                $booking->status = $dataSend['status'];
            }

            $booking->updated_at = $now;
            $modelBooking->save($booking);

            $result = getDetailBooking($dataSend['id']);

            return apiResponse(0, 'Lưu thông tin thành công', $result);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function cancelBookingApi($input): array
{
    global $controller, $transactionType, $bookingFeeStatus;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $userBookingModel = $controller->loadModel('UserBookings');
    $modelUser = $controller->loadModel('Users');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');
    $modelBookingFee = $controller->loadModel('BookingFees');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if (!empty($dataSend['booking_id'])) {
                $booking = $modelBooking->find()->where(['id' => $dataSend['booking_id']])->first();

                if (empty($booking)) {
                    return apiResponse(4, 'Cuốc xe không tồn tại');
                }

                if ($currentUser->id !== $booking->posted_by) {
                    return apiResponse(4, 'Bạn không phải người đăng cuốc xe nên không thể hủy');
                }

                if (!is_null($booking->received_by)) {
                    return apiResponse(4, 'Cuốc xe đã được nhận nên không thể hủy');
                }

                // Update trạng thái cuốc xe
                $booking->status = $bookingStatus['canceled'];
                $booking->canceled_at = date('Y-m-d H:i:s');
                $modelBooking->save($booking);

                $bookingFee = $modelBookingFee->find()
                    ->where(['booking_id' => $booking->id])
                    ->first();

                if (!empty($bookingFee)) {
                    $bookingFee->status = $bookingFeeStatus['paid'];
                    $modelBookingFee->save($bookingFee);

                    // Trả lại tiền cọc nếu có
                    if ($bookingFee->deposit) {
                        $currentUser->total_coin += $bookingFee->deposit;
                        $modelUser->save($currentUser);

                        $newTransaction = $modelTransaction->newEmptyEntity();
                        $newTransaction->user_id = $currentUser->id;
                        $newTransaction->booking_id = $booking->id;
                        $newTransaction->amount = $bookingFee->deposit;
                        $newTransaction->type = $transactionType['add'];
                        $newTransaction->name = "Nhận lại tiền cọc cuốc xe #$booking->id thành công";
                        $newTransaction->description = '+' . number_format($bookingFee->deposit) . ' EXC-xu';
                        $newTransaction->created_at = date('Y-m-d H:i:s');
                        $newTransaction->updated_at = date('Y-m-d H:i:s');
                        $modelTransaction->save($newTransaction);

                        // Thông báo cho người đăng
                        $title = 'Cộng EXC coin vào tài khoản';
                        $content = "Tài khoản của bạn được trả lại $bookingFee->deposit tiền cọc cho cuốc xe #$booking->id";
                        $notification = $modelNotification->newEmptyEntity();
                        $notification->user_id = $currentUser->id;
                        $notification->booking_id = $booking->id;
                        $notification->title = $title;
                        $notification->content = $content;
                        $notification->created_at = date('Y-m-d H:i:s');
                        $notification->updated_at = date('Y-m-d H:i:s');
                        $modelNotification->save($notification);
                        if ($currentUser->device_token) {
                            $dataSendNotification= array(
                                'title' => $title,
                                'time' => date('H:i d/m/Y'),
                                'content' => $content,
                                'action' => 'addMoneySuccess',
                                'user_id' => $currentUser->id,
                                'booking_id' => $booking->id,
                            );
                            sendNotification($dataSendNotification, $currentUser->device_token);
                        }
                    }
                }

                // Update lịch sử đăng cuốc xe
                $postedUserBooking = $userBookingModel->find()->where([
                    'user_id' =>  $currentUser->id,
                    'booking_id' => $booking->id,
                    'type' => $bookingType['post'],
                ])->first();
                $postedUserBooking->status = $bookingStatus['canceled'];
                $postedUserBooking->received_at = null;
                $postedUserBooking->canceled_at = date('Y-m-d H:i:s');
                $userBookingModel->save($postedUserBooking);

                return apiResponse(0, 'Hủy cuốc xe thành công');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getAvailableBookingListApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;

    $modelBooking = $controller->loadModel('Bookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $conditions = [];
            $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
            $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

            if (isset($dataSend['type']) && $dataSend['type'] == 'receive') {
                $conditions['received_by'] = $currentUser->id;
                $order = ['received_at' => 'DESC'];
            } else {
                $conditions['posted_by'] = $currentUser->id;
                $order = ['created_at' => 'DESC'];
            }

            if (isset($dataSend['status'])) {
                if ($dataSend['status'] == $bookingStatus['completed']) {
                    $conditions['status IN'] = [$bookingStatus['completed'], $bookingStatus['confirmed'], $bookingStatus['paid']];
                } else {
                    $conditions['status'] = $dataSend['status'];
                }
            }

            $listData = $modelBooking->find()
                ->limit($limit)
                ->page($page)
                ->where($conditions)
                ->order($order)
                ->all()
                ->toList();
            $totalBookings = $modelBooking->find()
                ->where($conditions)
                ->all()
                ->toList();
            $paginationMeta = createPaginationMetaData(count($totalBookings), $limit, $page);

            return apiResponse(0, 'Lấy danh sách cuốc xe thành công', $listData, $paginationMeta);
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function createBookingDealApi($input): array
{
    global $controller;
    global $isRequestPost;

    $bookingDealModel = $controller->loadModel('BookingDeals');
    $bookingModel = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type !== 2) {
                return apiResponse(4, 'Bạn cần trở thành tài xế để nhận chuyến');
            }

            if (empty($dataSend['introduce_fee']) || empty($dataSend['booking_id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            if ($dataSend['introduce_fee'] < 0 || $dataSend['introduce_fee'] >100) {
                return apiResponse(4, 'Chiết khấu không hợp lệ');
            }

            $booking = $bookingModel->find()
                ->where(['id' => $dataSend['booking_id']])
                ->first();

            if (empty($booking) || $booking->status != 0) {
                return apiResponse(4, 'Bạn không thể nhận chuyến xe này');
            }

            $newDeal = $bookingDealModel->find()
                ->where([
                    'user_id' => $currentUser->id,
                    'booking_id' => $dataSend['booking_id'],
                    'status <>' => 2,
                ])->first();

            if (empty($newDeal)) {
                $newDeal = $bookingDealModel->newEmptyEntity();
            }

            $newDeal->user_id = $currentUser->id;
            $newDeal->booking_id = $dataSend['booking_id'];
            $newDeal->introduce_fee = $dataSend['introduce_fee'];
            $newDeal->price = ceil((int) $dataSend['introduce_fee'] * $booking->price / 100);
            $newDeal->status = 1;
            $newDeal->created_at = date('Y-m-d H:i:s');
            $newDeal->updated_at = date('Y-m-d H:i:s');
            $bookingDealModel->save($newDeal);

            // Thông báo cho người đăng cuốc xe
            $title = 'Tài xế đã trả giá cho cuốc xe mà bạn đăng';
            $content = "Tài xế $currentUser->name đã trả giá cho cuốc xe #$booking->id";
            $postedUser = $modelUser->find()->where(['id' => $booking->posted_by])->first();
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $postedUser->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);

            if ($postedUser->device_token) {
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'createBookingDealSuccess',
                    'user_id' => $currentUser->id,
                    'booking_id' => $booking->id,
                );
                sendNotification($dataSendNotification, $postedUser->device_token);
            }

            return apiResponse(0, 'Trả giá cho chuyến xe thành công', $newDeal);
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getListBookingDealApi($input): array
{
    global $controller;
    global $isRequestPost;

    $bookingDealModel = $controller->loadModel('BookingDeals');
    $bookingModel = $controller->loadModel('Bookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type !== 2) {
                return apiResponse(4, 'Bạn cần trở thành tài xế để xem thông tin này');
            }

            if (empty($dataSend['booking_id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            $booking = $bookingModel->find()
                ->where(['id' => $dataSend['booking_id']])
                ->first();

            if (empty($booking) || $booking->posted_by !== $currentUser->id) {
                return apiResponse(4, 'Bạn không thể xem thông tin này');
            }

            $listDeal = $bookingDealModel->find()
                ->join([
                    [
                        'table' => 'users',
                        'alias' => 'Users',
                        'type' => 'LEFT',
                        'conditions' => [
                            'BookingDeals.user_id = Users.id',
                        ],
                    ],
                ])->where(['booking_id' => $dataSend['booking_id']])
                ->select([
                    'BookingDeals.id', 'BookingDeals.booking_id', 'BookingDeals.user_id',
                    'BookingDeals.introduce_fee', 'BookingDeals.price',
                    'Users.name', 'Users.id', 'Users.phone_number', 'Users.avatar'
                ])->all();

            return apiResponse(0, 'Lấy thông tin thành công', $listDeal);
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function acceptBookingDealApi($input): array
{
    global $controller, $bookingType;
    global $isRequestPost;
    global $bookingStatus;
    global $transactionType;

    $bookingDealModel = $controller->loadModel('BookingDeals');
    $bookingModel = $controller->loadModel('Bookings');
    $userModel = $controller->loadModel('Users');
    $userBookingModel = $controller->loadModel('UserBookings');
    $bookingFeeModel = $controller->loadModel('BookingFees');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');
    $serviceFee = getServiceFee();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type !== 2) {
                return apiResponse(4, 'Bạn cần trở thành tài xế để xem thông tin này');
            }

            if (empty($dataSend['booking_deal_id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
            $deal = $bookingDealModel->find()->where(['id' => $dataSend['booking_deal_id']])->first();

            if (empty($deal)) {
                return apiResponse(4, 'Thông tin không hợp lệ');
            }
            $booking = $bookingModel->find()->where(['id' => $deal->booking_id])->first();

            if ($booking->posted_by !== $currentUser->id) {
                return apiResponse(4, 'Bạn không có quyền thực hiện');
            }

            if ($booking->status !== $bookingStatus['unreceived']) {
                return apiResponse(4, 'Cuốc xe này đã được nhận hoặc bị hủy');
            }
            $receivedUser = $userModel->find()->where([
                'id' => $deal->user_id,
                'type' => 2,
                'total_coin >=' => ($deal->price + $serviceFee),
                'status' => 1
            ])->first();

            if (empty($receivedUser)) {
                return apiResponse(4, 'Người nhận hiện tại không thể nhận cuốc xe này');
            }

            // Tạm giữ phí nhận cuốc xe và thu phí sàn
            $bookingFee = $bookingFeeModel->newEmptyEntity();
            $bookingFee->received_fee = $deal->price;
            $bookingFee->service_fee = $serviceFee;
            $bookingFee->booking_id = $booking->id;
            $bookingFeeModel->save($bookingFee);

            // Trừ xu của user nhận cuốc xe
            $receivedUser->total_coin = $receivedUser->total_coin - $deal->price - $serviceFee;
            $userModel->save($receivedUser);

            // Update cuốc xe
            $booking->received_by = $receivedUser->id;
            $booking->status = $bookingStatus['received'];
            $booking->introduce_fee = $deal->introduce_fee;
            $booking->received_at = date('Y-m-d H:i:s');
            $bookingModel->save($booking);

            // Lưu lại lịch sử nhận cuốc
            $receivedUserBooking = $userBookingModel->find()->where([
                'user_id' => $receivedUser->id,
                'booking_id' => $booking->id,
                'type' => $bookingType['receive'],
            ])->first();
            if (empty($receivedUserBooking)) {
                $receivedUserBooking = $userBookingModel->newEmptyEntity();
                $receivedUserBooking->user_id = $receivedUser->id;
                $receivedUserBooking->booking_id = $booking->id;
                $receivedUserBooking->type = $bookingType['receive'];
            }
            $receivedUserBooking->status = $bookingStatus['received'];
            $receivedUserBooking->received_at = date('Y-m-d H:i:s');
            $receivedUserBooking->canceled_at = null;
            $userBookingModel->save($receivedUserBooking);

            // Update lịch sử cuốc xe của người đăng cuốc
            $postedUserBooking = $userBookingModel->find()->where([
                'user_id' => $booking->posted_by,
                'booking_id' => $booking->id,
                'type' => $bookingType['post'],
            ])->first();
            if (!empty($postedUserBooking)) {
                $postedUserBooking->status = $bookingStatus['received'];
                $postedUserBooking->received_at = date('Y-m-d H:i:s');
                $userBookingModel->save($postedUserBooking);
            }

            // Save transaction
            // Giao dịch trừ phí nhận cuốc xe
            $receiveTransaction = $modelTransaction->newEmptyEntity();
            $receiveTransaction->user_id = $receivedUser->id;
            $receiveTransaction->amount = $deal->price;
            $receiveTransaction->type = $transactionType['subtract'];
            $receiveTransaction->booking_id = $booking->id;
            $receiveTransaction->name = "Thanh toán cuốc xe #$booking->id thành công";
            $receiveTransaction->description = '-' . number_format($deal->price) . ' EXC-xu';
            $receiveTransaction->created_at = date('Y-m-d H:i:s');
            $receiveTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($receiveTransaction);

            // Giao dịch trừ phí sàn
            if ($serviceFee) {
                $serviceTransaction = $modelTransaction->newEmptyEntity();
                $serviceTransaction->user_id = $receivedUser->id;
                $serviceTransaction->amount = $serviceFee;
                $serviceTransaction->type = $transactionType['subtract'];
                $serviceTransaction->booking_id = $booking->id;
                $serviceTransaction->name = "Thanh toán phí sàn khi nhận cuốc xe #$booking->id thành công";
                $serviceTransaction->description = '-' . number_format($serviceFee) . ' EXC-xu';
                $serviceTransaction->created_at = date('Y-m-d H:i:s');
                $serviceTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($serviceTransaction);
            }

            // Thông báo cho người nhận được cuốc xe
            $title = 'Cuốc xe đã được nhận';
            $content = "Người đăng cuốc xe #$booking->id đã chấp nhận yêu cầu nhận cuốc của bạn";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $receivedUser->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);

            if ($receivedUser->device_token) {
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'receiveBookingSuccess'
                );
                sendNotification($dataSendNotification, $receivedUser->device_token);
            }

            return apiResponse(0, 'Nhận cuốc xe thành công');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function repostBookingApi($input): array
{
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $bookingStatus;

    $bookingModel = $controller->loadModel('Bookings');
    $modelBookmark = $controller->loadModel('Bookmarks');
    $modelUser = $controller->loadModel('Users');
    $modelProvince = $controller->loadModel('Provinces');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if ($currentUser->type !== 2) {
                return apiResponse(4, 'Bạn cần trở thành tài xế để xem thông tin này');
            }

            if (empty($dataSend['id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            $booking = $bookingModel->find()->where(['id' => $dataSend['id']])->first();

            if ($currentUser->id !== $booking->posted_by) {
                return apiResponse(4, 'Bạn không phải là người đăng cuốc xe này');
            }

            if (!is_null($booking->received_by)) {
                return apiResponse(4, 'Cuốc xe đã có người nhận');
            }

            if (!empty($booking->deposit)) {
                if ($booking->deposit > $currentUser->total_coin) {
                    return apiResponse(2, 'Số tiền trong ví không đủ để cọc');
                }

                // Giữ tiền cọc của người đăng
                $currentUser->total_coin -= $booking->deposit;
                $modelUser->save($currentUser);

                /*$bookingFee = $modelBookingFee->newEmptyEntity();
                $bookingFee->received_fee = 0;
                $bookingFee->service_fee = 0;
                $bookingFee->deposit = $booking->deposit;
                $bookingFee->booking_id = $booking->id;
                $modelBookingFee->save($bookingFee);*/

                $depositTransaction = $modelTransaction->newEmptyEntity();
                $depositTransaction->user_id = $currentUser->id;
                $depositTransaction->amount = $booking->deposit;
                $depositTransaction->type = $transactionType['subtract'];
                $depositTransaction->booking_id = $booking->id;
                $depositTransaction->name = "Thanh toán tiền cọc khi đăng lại cuốc xe #$booking->id thành công";
                $depositTransaction->description = '-' . number_format($booking->deposit) . ' EXC-xu';
                $depositTransaction->created_at = date('Y-m-d H:i:s');
                $depositTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($depositTransaction);
            }

            $booking->created_at = date('Y-m-d H:i:s');
            $booking->status = $bookingStatus['unreceived'];
            $bookingModel->save($booking);

            $province = $modelProvince->find()->where([
                'id' => $booking->departure_province_id,
                'status' => 1
            ])->first();

            $listUserId = $modelBookmark->find()->where([
                'province_id' => $booking->departure_province_id
            ])->all()->map(function ($item) {
                return $item->user_id;
            })->toArray();

            $title = 'Có một cuốc xe mới được đăng trong nhóm bạn quan tâm';
            $content = "Cuốc xe #$booking->id mới được đăng trong nhóm $province->name";
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'action' => 'newBookingCreated',
                'booking_id' => $booking->id,
            );

            $now = date('Y-m-d H:i:s');
            foreach (array_chunk($listUserId, 1000) as $userIds) {
                $listUser = $modelUser->find()->where(['id IN' => $userIds])->all()->toArray();
                $listToken = [];
                $listNewNotification = [];

                foreach ($listUser as $user) {
                    if (!empty($user['device_token'])) {
                        $listToken[] = $user['device_token'];
                    }

                    $notification = $modelNotification->newEmptyEntity();
                    $notification->user_id = $user['id'];
                    $notification->booking_id = $booking->id;
                    $notification->title = $title;
                    $notification->content = $content;
                    $notification->created_at = $now;
                    $notification->updated_at = $now;
                    $listNewNotification[] = $notification;
                }

                sendNotification($dataSendNotification, $listToken);
                $modelNotification->saveMany($listNewNotification);
            }

            return apiResponse(0, 'Thao tác thành công');
        }

        return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
