<?php

function createBookingApi($input): array
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

        if (isset($dataSend['name'])
            && isset($dataSend['price'])
            && isset($dataSend['departure_province_id'])
            && isset($dataSend['destination_province_id'])
            && isset($dataSend['departure'])
            && isset($dataSend['destination'])
            && isset($dataSend['introduce_fee'])
            && isset($dataSend['start_time'])
            && isset($dataSend['finish_time'])
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

            if (!in_array($dataSend['destination_province_id'], $listProvinceIds)) {
                return apiResponse(2, 'Tỉnh đến không hợp lệ');
            }

            if (!is_numeric($dataSend['introduce_fee']) || $dataSend['introduce_fee'] < 0 || $dataSend['introduce_fee'] > 100) {
                return apiResponse(2, 'Tỉ lệ chiết khấu không hợp lệ');
            }

            $startTime = date('Y-m-d H:i:s', strtotime($dataSend['start_time']));
            $finishTime = date('Y-m-d H:i:s', strtotime($dataSend['finish_time']));
            $now = date('Y-m-d H:i:s');

            if ($startTime <= $now) {
                return apiResponse(2, 'Thời gian khởi hành phải lớn hơn hiện tại');
            }

            if ($finishTime <= $startTime) {
                return apiResponse(2, 'Thời gian đến phải lớn hơn thời gian khởi hành');
            }

            $booking = $modelBooking->newEmptyEntity();
            $booking->name = $dataSend['name'];
            $booking->posted_by = $currentUser->id;
            $booking->status = $bookingStatus['unreceived'];
            $booking->start_time = $startTime;
            $booking->finish_time = $finishTime;
            $booking->departure_province_id = $dataSend['departure_province_id'];
            $booking->destination_province_id = $dataSend['destination_province_id'];
            $booking->departure = $dataSend['departure'];
            $booking->destination = $dataSend['destination'];
            $booking->introduce_fee = $dataSend['introduce_fee'];
            $booking->price = $dataSend['price'];
            $booking->description = $dataSend['description'] ?? null;
            $booking->created_at = $now;
            $booking->updated_at = $now;
            $modelBooking->save($booking);

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

    $modelBooking = $controller->loadModel('Bookings');
    $modelPinnedProvince = $controller->loadModel('PinnedProvinces');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $conditions = [];
        $order = ['created_at' => 'DESC'];
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
        if ($page < 1) $page = 1;

        if (!empty($dataSend['keyword'])) {
            $conditions[] = ['OR' => [
                ['name LIKE' => '%' . $dataSend['keyword'] . '%'],
                ['departure LIKE' => '%' . $dataSend['keyword'] . '%'],
                ['destination LIKE' => '%' . $dataSend['keyword'] . '%'],
            ]];
        }

        if (!empty($dataSend['province_id'])) {
            $conditions[] = ['OR' => [
                ['departure_province_id' => $dataSend['province_id']],
                ['destination_province_id' => $dataSend['province_id']]
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
        $paginationMeta = createPaginationMetaData(
            count($totalBookings),
            $limit,
            $page
        );

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

    $modelBooking = $controller->loadModel('Bookings');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelUser = $controller->loadModel('Users');
    $modelTransaction = $controller->loadModel('Transactions');

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
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelUser = $controller->loadModel('Users');

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

                $currentUser->total_coin = $currentUser->total_coin + $bookingFee->received_fee + $bookingFee->service_fee;

                $booking->received_by = null;
                $booking->status = $bookingStatus['unreceived'];
                $booking->received_at = null;

                $modelUser->save($currentUser);
                $modelBooking->save($booking);
                $modelBookingFee->delete($bookingFee);

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

    $modelBooking = $controller->loadModel('Bookings');

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

    $modelBooking = $controller->loadModel('Bookings');

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
            $order = ['Bookings.created_at' => 'DESC'];
            $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
            $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

            $query = $modelBooking->find()
                ->join([
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

            // Filter by type: post or receive
            if (!empty($dataSend['type']) && $dataSend['type'] === 'receive') {
                $conditions['Bookings.received_by'] = $currentUser->id;
            } else {
                $conditions['Bookings.posted_by'] = $currentUser->id;
            }

            // Filter by date
            if (!empty($dataSend['from_date']) || !empty($dataSend['to_date'])) {
                if (!empty($dataSend['from_date'])) {
                    $startTime = DateTime::createFromFormat('d/m/Y', $dataSend['from_date']);
                    $conditions[] = ['OR' => [
                        ['Bookings.start_time >=' => $startTime->format('Y-m-d H:i:s')],
                        ['Bookings.finish_time >=' => $startTime->format('Y-m-d H:i:s')],
                    ]];
                }

                if (!empty($dataSend['to_date'])) {
                    $finishTime = DateTime::createFromFormat('d/m/Y', $dataSend['to_date']);
                    $conditions[] = ['OR' => [
                        ['Bookings.start_time <=' => $finishTime->format('Y-m-d H:i:s')],
                        ['Bookings.finish_time <=' => $finishTime->format('Y-m-d H:i:s')],
                    ]];
                }
            } else {
                $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                $conditions[] = ['OR' => [
                    ['Bookings.start_time >=' => $date->sub(new DateInterval('P30D'))->format('Y-m-d H:i:s')],
                    ['Bookings.finish_time >=' => $date->sub(new DateInterval('P30D'))->format('Y-m-d H:i:s')],
                ]];
            }

            if (!empty($dataSend['keyword'])) {
                if ((int) $dataSend['keyword']) {
                    $conditions[] = ['OR' => [
                        'Bookings.id' => (int) $dataSend['keyword'],
                        'Bookings.name LIKE' => '%' . $dataSend['keyword'] . '%',
                    ]];
                } else {
                    $conditions['Bookings.name LIKE'] = '%' . $dataSend['keyword'] . '%';
                }
            }

            $listData = $query->select([
                    'Bookings.id',
                    'Bookings.name',
                    'Bookings.price',
                    'Bookings.start_time',
                    'Bookings.finish_time',
                    'Bookings.status',
                    'Bookings.created_at',
                    'PostedUsers.id',
                    'PostedUsers.name',
                    'ReceivedUsers.id',
                    'ReceivedUsers.name',
                    'DepartureProvinces.name',
                    'DestinationProvinces.name',
                ])->limit($limit)
                ->page($page)
                ->where($conditions)
                ->order($order)
                ->all()
                ->toList();
            $totalBookings = $query->where($conditions)->count();
            $paginationMeta = createPaginationMetaData($totalBookings, $limit, $page);

            return apiResponse(0, 'Lấy danh sách cuốc xe thành công', $listData, $paginationMeta);
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
