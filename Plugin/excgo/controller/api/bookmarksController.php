<?php

function createBookmarkApi($input)
{
    global $controller;
    global $isRequestPost;

    $modelBookmark = $controller->loadModel('Bookmarks');
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
            $province = $modelProvince->find()->where([
                'id' => $dataSend['province_id'],
                'status' => 1
            ])->first();

            if (empty($province)) {
                return apiResponse(2, 'Tỉnh không hợp lệ');
            }

            $newBookmark = $modelBookmark->newEmptyEntity();
            $newBookmark->province_id = $dataSend['province_id'];
            $newBookmark->user_id = $currentUser->id;
            $newBookmark->created_at = date('Y-m-d H:i:s');
            $newBookmark->updated_at = date('Y-m-d H:i:s');
            $modelBookmark->save($newBookmark);

            return apiResponse(0, 'Lưu thông tin thành công', $newBookmark);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getListBookmarkApi($input)
{
    global $controller;
    global $isRequestPost;

    $modelBookmark = $controller->loadModel('Bookmarks');
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

        $listProvinceId = $modelBookmark->find()
            ->where(['user_id' => $currentUser->id])
            ->all()->map(function ($item) {
                return $item->province_id;
            })->toArray();

        $listProvince = $modelProvince->find()->where([
            'id IN' => $listProvinceId,
            'status' => 1,
        ])->all()->toList();

        return apiResponse(0, 'Lưu thông tin thành công', $listProvince);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function deleteBookmarkApi($input)
{
    global $controller;
    global $isRequestPost;

    $modelBookmark = $controller->loadModel('Bookmarks');

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
            $bookmark = $modelBookmark->find()
                ->where([
                    'user_id' => $currentUser->id,
                    'province_id' => $dataSend['province_id'],
                ])->first();

            if (empty($bookmark)) {
                return apiResponse(4, 'Không tìm thấy tỉnh trong danh sách quan tâm.');
            }

            $modelBookmark->delete($bookmark);

            return apiResponse(0, 'Lưu thông tin thành công');
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
