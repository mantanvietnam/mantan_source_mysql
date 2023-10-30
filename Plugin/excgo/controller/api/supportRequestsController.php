<?php

function createSupportRequestApi($input): array
{
    global $controller;
    global $isRequestPost;

    $requestModel = $controller->loadModel('SupportRequests');

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

        if (!empty($dataSend['content'])) {
            $newRequest = $requestModel->newEmptyEntity();
            $newRequest->user_id = $currentUser->id;
            $newRequest->content = $dataSend['content'];
            $requestModel->save($newRequest);

            return apiResponse(0, 'Gửi yêu cầu thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getListSupportRequestApi($input): array
{
    global $controller;
    global $isRequestPost;

    $requestModel = $controller->loadModel('SupportRequests');

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

        $listRequest = $requestModel->find()
            ->where(['user_id' => $currentUser->id])
            ->all()
            ->toList();

        return apiResponse(0, 'Lấy danh sách yêu cầu trợ giúp thành công', $listRequest);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}