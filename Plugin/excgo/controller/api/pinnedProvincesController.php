<?php

function addPinnedProvinceApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelPinnedProvince = $controller->loadModel('PinnedProvinces');
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

        if (isset($dataSend['province_id'])) {
            $listProvince = $modelProvince->find()->where([
                'status' => 1
            ])->all();
            $listProvinceIds = $listProvince->map(function ($item) {
                return $item->id;
            })->toArray();

            if (!in_array($dataSend['province_id'], $listProvinceIds)) {
                return apiResponse(2, 'Tỉnh khởi hành không hợp lệ');
            }

            $newPinnedProvince = $modelPinnedProvince->newEmptyEntity();
            $newPinnedProvince->province_id = $dataSend['province_id'];
            $newPinnedProvince->user_id = $currentUser->id;
            $newPinnedProvince->created_at = date('Y-m-d H:i:s');
            $modelPinnedProvince->save($newPinnedProvince);

            return apiResponse(0, 'Lưu thông tin thành công', $newPinnedProvince);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function removePinnedProvinceApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelPinnedProvince = $controller->loadModel('PinnedProvinces');

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

        if (!empty($dataSend['province_id'])) {
            $data = $modelPinnedProvince->find()
                ->where([
                    'province_id' => $dataSend['province_id'],
                    'user_id' => $currentUser->id
                ])->first();

            if ($data) {
                $modelPinnedProvince->delete($data);
            } else {
                return apiResponse(3, 'Thông tin yêu cầu không tồn tại');
            }

            return apiResponse(0, 'Xóa thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
