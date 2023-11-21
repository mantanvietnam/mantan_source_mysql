<?php

function createBookingApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $modelProvince = $controller->loadModel('Provinces');
    $userBookingModel = $controller->loadModel('UserBookings');

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

            $listProvince = $modelProvince->find()->where([
                'status' => 1
            ])->all();
            $listProvinceIds = $listProvince->map(function ($item) {
                return $item->id;
            })->toArray();

            if (!in_array($dataSend['departure_province_id'], $listProvinceIds)) {
                return apiResponse(2, 'Tỉnh khởi hành không hợp lệ');
            }

            if (isset($dataSend['destination_province_id']) && !in_array($dataSend['destination_province_id'], $listProvinceIds)) {
                return apiResponse(2, 'Tỉnh đến không hợp lệ');
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
            $booking->price = $dataSend['price'];
            $booking->description = $dataSend['description'] ?? null;
            $booking->created_at = $now;
            $booking->updated_at = $now;
            $modelBooking->save($booking);

            // Lưu lại lịch sử đăng cuốc xe
            $userBooking = $userBookingModel->newEmptyEntity();
            $userBooking->user_id = $currentUser->id;
            $userBooking->booking_id = $booking->id;
            $userBooking->type = $bookingType['post'];
            $userBooking->status = $bookingStatus['unreceived'];
            $userBookingModel->save($userBooking);

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
        $conditions = ['Bookings.status' => $bookingStatus['unreceived']];
        $order = ['Bookings.updated_at' => 'DESC'];
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
        if ($page < 1) $page = 1;

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

        if (!empty($dataSend['access_token'])) {
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
        }
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
                'Bookings.introduce_fee', 'Bookings.price', 'Bookings.created_at', 'Bookings.updated_at',
                'Bookings.received_at', 'Bookings.canceled_at', 'PostedUsers.name', 'PostedUsers.avatar',
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
    global $serviceFee;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelUser = $controller->loadModel('Users');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');
    $userBookingModel = $controller->loadModel('UserBookings');

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
                $receivedFee = ceil($booking->price / 10);

                if ($currentUser->total_coin < $receivedFee) {
                    return apiResponse(4, 'Tổng số dư tài khoản không đủ để nhận cuốc xe');
                }

                // Tạm giữ phí nhận cuốc xe và thu phí sàn
                $bookingFee = $modelBookingFee->newEmptyEntity();
                $bookingFee->received_fee = $receivedFee;
                $bookingFee->service_fee = $serviceFee;
                $bookingFee->booking_id = $booking->id;
                $modelBookingFee->save($bookingFee);

                // Trừ xu của user nhận cuốc xe
                $currentUser->total_coin = $currentUser->total_coin - $receivedFee - $serviceFee;
                $modelUser->save($currentUser);

                // Update cuốc xe
                $booking->received_by = $currentUser->id;
                $booking->status = $bookingStatus['received'];
                $booking->received_at = date('Y-m-d H:i:s');
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
                $receiveTransaction->name = "Thanh toán cuốc xe #$booking->id thành công";
                $receiveTransaction->description = '-' . number_format($receivedFee) . ' EXC-xu';
                $modelTransaction->save($receiveTransaction);

                // Giao dịch trừ phí sàn
                if ($serviceFee) {
                    $serviceTransaction = $modelTransaction->newEmptyEntity();
                    $serviceTransaction->user_id = $currentUser->id;
                    $serviceTransaction->amount = $serviceFee;
                    $serviceTransaction->type = $transactionType['subtract'];
                    $serviceTransaction->name = "Thanh toán phí sàn khi nhận cuốc xe #$booking->id thành công";
                    $serviceTransaction->description = '-' . number_format($serviceFee) . ' EXC-xu';
                    $modelTransaction->save($serviceTransaction);
                }

                // Thông báo cho người đăng cuốc xe
                $title = 'Cuốc xe đã được nhận';
                $content = "Cuốc xe #$booking->id đã được nhận bởi tài xế $currentUser->name";
                $postedUser = $modelUser->find()->where(['id' => $booking->posted_by])->first();
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $postedUser->id;
                $notification->title = $title;
                $notification->content = $content;
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
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');
    $userBookingModel = $controller->loadModel('UserBookings');

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

                $bookingFee = $modelBookingFee->find()
                    ->where(['booking_id' => $booking->id])
                    ->first();

                // Cộng lại số tiền chiết khấu
                $currentUser->total_coin = $currentUser->total_coin + $bookingFee->received_fee + $bookingFee->service_fee;
                $modelUser->save($currentUser);

                // Update trạng thái cuốc xe
                $booking->received_by = null;
                $booking->status = $bookingStatus['unreceived'];
                $booking->received_at = null;
                $modelBooking->save($booking);
                $modelBookingFee->delete($bookingFee);

                // Lưu lại lịch sử hủy cuốc của tài xế
                $canceledBooking = $userBookingModel->find()->where([
                    'user_id' => $currentUser->id,
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

                // Thông báo cho người đăng cuốc xe
                $title = 'Tài xế đã hủy nhận cuốc xe';
                $content = "Tài xế $currentUser->name đã hủy nhận cuốc xe #$booking->id";
                $postedUser = $modelUser->find()->where(['id' => $booking->posted_by])->first();
                $notification = $modelNotification->newEmptyEntity();
                $notification->user_id = $postedUser->id;
                $notification->title = $title;
                $notification->content = $content;
                $modelNotification->save($notification);

                if ($postedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'cancelReceiveBookingSuccess'
                    );
                    sendNotification($dataSendNotification, $postedUser->device_token);
                }

                return apiResponse(0, 'Hủy cuốc xe thành công');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
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

                $booking->status = $bookingStatus['completed'];
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
                $notification->title = $title;
                $notification->content = $content;
                $modelNotification->save($notification);

                if ($postedUser->device_token) {
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'completeBookingSuccess'
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

function checkFinishedBookingApi($input): array
{
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingFeeStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelTransaction = $controller->loadModel('Transactions');

    if ($isRequestPost) {
        $now = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $bookingList = $modelBooking->find()
            ->where([
                'status' => $bookingStatus['completed'],
                'finish_time <=' => $now->sub(new DateInterval('P1D'))->format('Y-m-d H:i:s')
            ])->all();

        foreach ($bookingList as $booking) {
            $bookingFee = $modelBookingFee->find()
                ->where(['booking_id' => $booking->id])
                ->first();
            $user = $modelUser->find()
                ->where(['id' => $booking->posted_by])
                ->first();
            $user->total_coin += $bookingFee->received_fee;
            $booking->status = $bookingStatus['paid'];
            $bookingFee->staus = $bookingFeeStatus['paid'];

            $modelUser->save($user);
            $modelBooking->save($booking);

            // Save transaction
            $newTransaction = $modelTransaction->newEmptyEntity();
            $newTransaction->user_id = $user->id;
            $newTransaction->amount = $bookingFee->received_fee;
            $newTransaction->type = $transactionType['add'];
            $newTransaction->name = "Nhận thanh toán cuốc xe #$booking->id thành công";
            $newTransaction->description = '+' . number_format($bookingFee->received_fee) . ' EXC-xu';
            $modelTransaction->save($newTransaction);
        }

        return apiResponse(0, 'Thanh toán phí thành công', $bookingList->toList());
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
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
                $toDate = $to->format('Y-m-d');
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
                $conditions['OR'][] = [
                    'AND' => [
                        'UserBookings.received_at >=' => $fromDate,
                        'UserBookings.received_at <' => $toDate,
                    ],
                ];
                $conditions['OR'][] = [
                    'AND' => [
                        'UserBookings.canceled_at >=' => $fromDate,
                        'UserBookings.canceled_at <' => $toDate,
                    ]
                ];

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
            foreach ($listData as $item) {
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
            $count = $statsData->countBy(function ($item) use ($bookingStatus) {
                if ($item->status === $bookingStatus['received']) {
                    return 'received';
                } elseif ($item->status === $bookingStatus['completed'] || $item->status === $bookingStatus['paid']) {
                    return 'completed';
                } elseif ($item->status === $bookingStatus['canceled']) {
                    return 'canceled';
                }
            })->toArray();

            $receiveRate = isset($count['received']) ? round($count['received'] / $total, 1) : 0;
            $finishRate = isset($count['completed']) ? round($count['completed'] / $total, 1) : 0;
            $cancelRate = isset($count['canceled']) ? round($count['canceled'] / $total, 1) : 0;
            $bookingsPerDay = round($total / $numberOfDays, 1);

            $data = [
                'stats' => [
                    'total' => $total,
                    'received' => [
                        'count' => $count['received'] ?? 0,
                        'rate' => $receiveRate,
                    ],
                    'finished' => [
                        'count' => $count['completed'] ?? 0,
                        'rate' => $finishRate,
                    ],
                    'canceled' => [
                        'count' => $count['canceled'] ?? 0,
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
    global $controller;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
    $userBookingModel = $controller->loadModel('UserBookings');

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
            $order = ['updated_at' => 'DESC'];
            $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
            $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

            if (isset($dataSend['type']) && $dataSend['type'] == 'receive') {
                $conditions['received_by'] = $currentUser->id;
            } else {
                $conditions['posted_by'] = $currentUser->id;
            }

            if (isset($dataSend['status'])) {
                $conditions['status'] = $dataSend['status'];
            } else {
                $conditions['status'] = $bookingStatus['unreceived'];
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
            $bookingDealModel->save($newDeal);

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
                    'Users.name', 'Users.id', 'Users.phone_number',
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
    global $serviceFee;
    global $transactionType;

    $bookingDealModel = $controller->loadModel('BookingDeals');
    $bookingModel = $controller->loadModel('Bookings');
    $userModel = $controller->loadModel('Users');
    $userBookingModel = $controller->loadModel('UserBookings');
    $bookingFeeModel = $controller->loadModel('BookingFees');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');

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
            $receiveTransaction->name = "Thanh toán cuốc xe #$booking->id thành công";
            $receiveTransaction->description = '-' . number_format($deal->price) . ' EXC-xu';
            $modelTransaction->save($receiveTransaction);

            // Giao dịch trừ phí sàn
            if ($serviceFee) {
                $serviceTransaction = $modelTransaction->newEmptyEntity();
                $serviceTransaction->user_id = $receivedUser->id;
                $serviceTransaction->amount = $serviceFee;
                $serviceTransaction->type = $transactionType['subtract'];
                $serviceTransaction->name = "Thanh toán phí sàn khi nhận cuốc xe #$booking->id thành công";
                $serviceTransaction->description = '-' . number_format($serviceFee) . ' EXC-xu';
                $modelTransaction->save($serviceTransaction);
            }

            // Thông báo cho người nhận được cuốc xe
            $title = 'Cuốc xe đã được nhận';
            $content = "Người đăng cuốc xe #$booking->id đã chấp nhận yêu cầu nhận cuốc của bạn";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $receivedUser->id;
            $notification->title = $title;
            $notification->content = $content;
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