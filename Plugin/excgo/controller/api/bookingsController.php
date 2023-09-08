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
