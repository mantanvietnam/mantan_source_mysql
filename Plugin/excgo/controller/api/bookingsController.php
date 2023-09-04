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
