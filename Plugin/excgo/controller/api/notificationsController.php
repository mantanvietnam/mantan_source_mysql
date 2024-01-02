<?php

function getListNotificationApi($input): array
{
    global $controller;
    global $isRequestPost;

    $notificationModel = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $conditions = ['user_id' => $currentUser->id];
            $order = ['created_at' => 'DESC'];
            $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
            $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

            $data = $notificationModel->find()
                ->where($conditions)
                ->page($page)
                ->limit($limit)
                ->order($order)
                ->all()
                ->toList();
            $total = $notificationModel->find()->where($conditions)->count();
            $paginationMeta = createPaginationMetaData($total, $limit, $page);

            return apiResponse(0, 'Lấy danh sách thông báo thành công', $data, $paginationMeta);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function updateNotificationStatusApi($input): array
{
    global $controller;
    global $isRequestPost;

    $notificationModel = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token']) && isset($dataSend['notification_id']) && isset($dataSend['status'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $notification = $notificationModel->find()
                ->where(['id' => $dataSend['notification_id']])
                ->first();

            if ($notification->user_id !== $currentUser->id) {
                return apiResponse(3, 'Bạn không thể xem thông báo này');
            }
            $notification->is_viewed = boolval($dataSend['status']);
            $notificationModel->save($notification);

            return apiResponse(0, 'Cập nhật thông báo thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function markAllNotificationAsReadApi($input): array
{
    global $controller;
    global $isRequestPost;

    $notificationModel = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $result = $notificationModel->updateAll([
                    'is_viewed' => 1,
                ], [
                    'user_id' => $currentUser->id,
                    'is_viewed' => 0
                ]);

            return apiResponse(0, 'Cập nhật thành công', $result);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function deleteAllNotificationsApi($input): array
{
    global $controller;
    global $isRequestPost;

    $notificationModel = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $result = $notificationModel->deleteAll([
                'user_id' => $currentUser->id
            ]);

            return apiResponse(0, 'Xóa thông báo thành công', $result);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function deleteNotificationApi($input): array
{
    global $controller;
    global $isRequestPost;

    $notificationModel = $controller->loadModel('Notifications');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            if (empty($dataSend['id'])) {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            $notification = $notificationModel->find()->where(['id' => $dataSend['id']])->first();

            if ($notification->user_id != $currentUser->id) {
                return apiResponse(3, 'Bạn không có quyền xóa thông báo này');
            }

            $result = $notificationModel->delete($notification);

            return apiResponse(0, 'Xóa thông báo thành công', $result);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
