<?php

function registerUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['name'])
            && isset($dataSend['phone_number'])
            && isset($dataSend['password'])
            && isset($dataSend['password_confirmation'])
        ) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);
            $checkDuplicatePhone = $modelUser->find()->where([
                'phone_number' => $dataSend['phone_number']
            ])->first();

            if (empty($checkDuplicatePhone)) {
                if ($dataSend['password'] !== $dataSend['password_confirmation']) {
                    return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
                }

                $user = $modelUser->newEmptyEntity();
                $user->name = $dataSend['name'];
                $user->avatar = $dataSend['avatar'] ?? 'https://apis.exc-go.vn/plugins/excgo/view/image/default-avatar.png';
                $user->phone_number = $dataSend['phone_number'];
                $user->password = md5($dataSend['password']);
                $user->is_verified = 1;
                $user->email = $dataSend['email'] ?? null;
                $user->address = $dataSend['address'] ?? null;
                $user->status = isset($dataSend['status']) ? (int)$dataSend['status'] : 1;
                $user->created_at = date('Y-m-d H:i:s');
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->device_token = @$dataSend['device_token'];
                $modelUser->save($user);

                $loginUser = $modelUser->find()->where([
                    'phone_number' => $dataSend['phone_number'],
                    'password' => md5($dataSend['password']),
                    'status' => 1
                ])->first();

                return apiResponse(0, 'Lưu thông tin thành công', $loginUser);
            }

            return apiResponse(3, 'Số điện thoại đã tồn tại');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function loginUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone_number']) && isset($dataSend['password'])) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);

            $user = $modelUser->find()->where([
                'phone_number' => $dataSend['phone_number'],
                'password' => md5($dataSend['password']),
                'status' => 1
            ])->first();

            if (!empty($user)) {
                $user->access_token = createToken();
                $user->last_login = date('Y-m-d H:i:s');
                $user->device_token = @$dataSend['device_token'];
                $modelUser->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mật khẩu');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function logoutUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['access_token'])) {
            $user = getUserByToken($dataSend['access_token']);

            if (!empty($user)) {
                $user->access_token = '';
                $user->device_token = null;
                $modelUser->save($user);

                return apiResponse(0, 'Đăng xuất thành công');
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
