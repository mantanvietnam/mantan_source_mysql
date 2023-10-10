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

function changePasswordApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

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

        if (isset($dataSend['current_password'])
            && isset($dataSend['new_password'])
            && isset($dataSend['password_confirmation'])
        ) {
            if (md5($dataSend['current_password']) !== $currentUser->password) {
                return apiResponse(3, 'Mật khẩu không chính xác');
            }

            if ($dataSend['new_password'] !== $dataSend['password_confirmation']) {
                return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
            }

            $currentUser->password = md5($dataSend['new_password']);
            $currentUser->access_token = createToken();
            $currentUser->device_token = @$dataSend['device_token'];
            $modelUser->save($currentUser);

            return apiResponse(0, 'Thay đổi mật khẩu thành công', $currentUser);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function forgotPasswordApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone_number'])) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);
            $user = $modelUser->find()->where([
                'phone_number' => $dataSend['phone_number'],
            ])->first();

            if (!$user) {
                return apiResponse(3, 'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if ($user->status != 1) {
                return apiResponse(3, 'Tài khoản đang bị khóa');
            }

            if (!$user->email) {
                return apiResponse(3, 'Tài khoản chưa có thông tin email');
            }

            $code = rand(100000, 999999);
            $user->reset_password_code = $code;
            $modelUser->save($user);
            sendEmailCodeForgotPassword($user->email, $user->name, $code);

            return apiResponse(0, 'Tạo mã cấp lại mật khẩu thành công');
        }

        return apiResponse(2, 'Chưa nhập số điện thoại');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function resetPasswordApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone_number'])
            && isset($dataSend['code'])
            && isset($dataSend['new_password'])
            && isset($dataSend['password_confirmation'])
        ) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);
            $user = $modelUser->find()->where([
                'phone_number' => $dataSend['phone_number'],
            ])->first();

            if (!$user) {
                return apiResponse(3, 'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if ($user->status != 1) {
                return apiResponse(3, 'Tài khoản đang bị khóa');
            }

            if ($user->reset_password_code !== $dataSend['code']) {
                return apiResponse(4, 'Mã cấp lại mật khẩu không chính xác');
            }

            if ($dataSend['new_password'] !== $dataSend['password_confirmation']) {
                return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
            }

            $user->password = md5($dataSend['new_password']);
            $user->reset_password_code = null;
            $user->access_token = createToken();
            $user->device_token = @$dataSend['device_token'];
            $modelUser->save($user);

            return apiResponse(0, 'Đổi mật khẩu thành công', $user);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function upgradeToDriverApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelUser = $controller->loadModel('Users');
    $modelImage = $controller->loadModel('Images');
    $modelDriverRequest = $controller->loadModel('DriverRequests');

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


        if (isset($_FILES['id_card_front'])
            && isset($_FILES['id_card_back'])
            && isset($_FILES['avatar'])
            && isset($_FILES['car_image_1'])
            && isset($dataSend['bank_account'])
            && isset($dataSend['account_number'])
            && isset($dataSend['email'])
            && isset($dataSend['address'])
        ) {
            $currentUser->bank_account = $dataSend['bank_account'];
            $currentUser->account_number = $dataSend['account_number'];
            $currentUser->email = $dataSend['email'];
            $currentUser->address = $dataSend['address'];
            $modelUser->save($currentUser);

            $imageData = [];
            $idCardFront = uploadImage($currentUser->id, 'id_card_front', 'id_card_front_' . $currentUser->id);
            if ($idCardFront['code']) {
                return apiResponse(4, $idCardFront['mess']);
            }
            $imageData[] = [
                'path' => $idCardFront['linkOnline'],
                'type' => $imageType['id-card-front'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];

            $idCardBack = uploadImage($currentUser->id, 'id_card_back', 'id_card_back_' . $currentUser->id);
            if ($idCardBack['code']) {
                return apiResponse(4, $idCardBack['mess']);
            }
            $imageData[] = [
                'path' => $idCardBack['linkOnline'],
                'type' => $imageType['id-card-back'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];

            $carImage = uploadImage($currentUser->id, 'car_image_1', 'car_1_' . $currentUser->id);
            if ($carImage['code']) {
                return apiResponse(4, $carImage['mess']);
            }
            $imageData[] = [
                'path' => $carImage['linkOnline'],
                'type' => $imageType['car'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];

            for ($i = 2; $i <= 10; $i++) {
                if (isset($_FILES["car_image_$i"])) {
                    $carImage = uploadImage($currentUser->id, 'car_image_' . $i, 'car_' . $i . '_' . $currentUser->id);
                    if ($carImage['code']) {
                        return apiResponse(4, $carImage['mess']);
                    }
                    $imageData[] = [
                        'path' => $carImage['linkOnline'],
                        'type' => $imageType['car'],
                        'owner_id' => $currentUser->id,
                        'owner_type' => $ownerType['users']
                    ];
                } else {
                    break;
                }
            }

            $avatar = uploadImage($currentUser->id, 'avatar', 'avatar' . $currentUser->id);
            if ($avatar['code']) {
                return apiResponse(4, $avatar['mess']);
            }
            $imageData[] = [
                'path' => $avatar['linkOnline'],
                'type' => $imageType['car'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];

            $images = $modelImage->newEntities($imageData);
            $modelImage->saveMany($images);

            $currentRequest = $modelDriverRequest->find()
                ->where(['user_id' => $currentUser->id])
                ->first();
            if (!$currentRequest) {
                $request = $modelDriverRequest->newEmptyEntity();
                $request->user_id = $currentUser->id;
                $modelDriverRequest->save($request);
            } else {
                $currentRequest->updated_at = date('Y-m-d H:i:s');
                $modelDriverRequest->save($currentRequest);
            }

            return apiResponse(0, 'Gửi yêu cầu thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function generateQRCodeApi($input): array
{
    global $isRequestPost;
    global $urlTransaction;
    global $transactionKey;

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

        if (isset($dataSend['amount'])) {
            $amount = $dataSend['amount'];
            $addInfo = "$currentUser->phone_number $transactionKey";
            $url = $urlTransaction . "amount=$amount&addInfo=$addInfo&accountName=Tran Ngoc Manh";
            $data = [
                'url' => $url,
                'bank' => 'Ngân hàng Tiên Phong Bank (TPB)',
                'account_number' => '06931228668',
                'account_name' => 'Trần Ngọc Mạnh',
                'content' => $addInfo
            ];

            return apiResponse(0, 'Gửi yêu cầu nạp tiền thành công', $data);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function addMoneyTPBankApi($input): array
{
    global $transactionKey;
    global $isRequestPost;

    if ($isRequestPost) {
        if (!empty($_POST['message'])) {
            $keyApp = strtoupper($transactionKey);
            $message = strtoupper($_POST['message']);

            $description = explode('ND: ', $message);
            $description = trim($description[1]);
            $description = str_replace(array('IBFT ', 'THANH TOAN QR ', 'QR - '), '', $description);

            $money = explode('PS:+', $message);
            $money = explode('SD:', $money[1]);
            $money = (int)str_replace(array('.', 'VND'), '', $money[0]);

            if ($money > 0 && strlen(strstr($description, $keyApp)) > 0) {
                // xóa dấu chấm
                $removeDot = explode('.', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }

                // xóa dấu chấm phẩy
                $removeDot = explode(';', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }

                // xóa dấu gạch ngang
                $removeDot = explode('-', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }


                $removeSpace = explode(' ', trim($description));
                $phoneNumber = $removeSpace[0];

                $mess = processAddMoney($money, $phoneNumber);

                return apiResponse(0, $mess);
            } else {
                return apiResponse(3, 'Sai cú pháp hoặc số tiền không đủ');
            }
        } else {
            return apiResponse(2, 'Gửi thiếu nội dung SMS');
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function createWithdrawRequestApi($input): array
{
    global $controller;
    global $isRequestPost;

    $withdrawRequestModel = $controller->loadModel('WithdrawRequests');

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

        if ($dataSend['amount']) {
            if ($dataSend['amount'] > $currentUser->total_coin) {
                return apiResponse(4, 'Số tiền trong ví không đủ');
            }

            $newRequest = $withdrawRequestModel->newEmptyEntity();
            $newRequest->user_id = $currentUser->id;
            $newRequest->amount = $dataSend['amount'];
            $withdrawRequestModel->save($newRequest);

            return apiResponse(0, 'Gửi yêu cầu thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function checkLoginFacebookApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $defaultAvatar;

    $userModel = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['facebook_id'])) {
            $user = $userModel->find()->where(['facebook_id' => $dataSend['facebook_id']])->first();

            if ($user) {
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone_number'])) {
                    $checkPhone = $userModel->find()->where(['phone_number' => $dataSend['phone_number']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->facebook_id = $dataSend['facebook_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->name = $dataSend['name'] ?? $checkPhone->name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = date('Y-m-d H:i:s');
                        $checkPhone->access_token = createToken();
                        $userModel->save($checkPhone);

                        return apiResponse(0, 'Đăng nhập thành công', $checkPhone);
                    }
                }

                // Kiểm tra user email đã tồn tại chưa
                if (!empty($dataSend['email'])) {
                    $checkEmail = $userModel->find()->where(['email' => $dataSend['email']])->first();

                    if (!empty($checkEmail)) {
                        $checkEmail->facebook_id = $dataSend['facebook_id'];
                        $checkEmail->avatar = $dataSend['avatar'] ?? $checkEmail->avatar;
                        $checkEmail->name = $dataSend['name'] ?? $checkEmail->name;
                        $checkEmail->phone_number = $dataSend['phone_number'] ?? $checkEmail->phone_number;
                        $checkEmail->last_login = date('Y-m-d H:i:s');
                        $checkEmail->access_token = createToken();
                        $userModel->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới

                if (!empty($dataSend['email']) || !empty($dataSend['phone_number'])) {
                    $newUser = $userModel->newEmptyEntity();
                    $newUser->name = $dataSend['name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone_number = $dataSend['phone_number'] ?? 'FB' . $dataSend['facebook_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 1;
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $newUser->last_login = date('Y-m-d H:i:s');
                    $newUser->access_token = createToken();
                    $newUser->device_token = $dataSend['device_token'] ?? null;
                    $userModel->save($newUser);

                    return apiResponse(0, 'Đăng nhập thành công', $newUser);
                }

                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function checkLoginGoogleApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $defaultAvatar;

    $userModel = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['google_id'])) {
            $user = $userModel->find()->where(['google_id' => $dataSend['google_id']])->first();

            if ($user) {
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone_number'])) {
                    $checkPhone = $userModel->find()->where(['phone_number' => $dataSend['phone_number']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->google_id = $dataSend['google_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->name = $dataSend['name'] ?? $checkPhone->name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = date('Y-m-d H:i:s');
                        $checkPhone->access_token = createToken();
                        $userModel->save($checkPhone);

                        return apiResponse(0, 'Đăng nhập thành công', $checkPhone);
                    }
                }

                // Kiểm tra user email đã tồn tại chưa
                if (!empty($dataSend['email'])) {
                    $checkEmail = $userModel->find()->where(['email' => $dataSend['email']])->first();

                    if (!empty($checkEmail)) {
                        $checkEmail->google_id = $dataSend['google_id'];
                        $checkEmail->avatar = $dataSend['avatar'] ?? $checkEmail->avatar;
                        $checkEmail->name = $dataSend['name'] ?? $checkEmail->name;
                        $checkEmail->phone_number = $dataSend['phone_number'] ?? $checkEmail->phone_number;
                        $checkEmail->last_login = date('Y-m-d H:i:s');
                        $checkEmail->access_token = createToken();
                        $userModel->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới

                if (!empty($dataSend['email']) || !empty($dataSend['phone_number'])) {
                    $newUser = $userModel->newEmptyEntity();
                    $newUser->name = $dataSend['name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone_number = $dataSend['phone_number'] ?? 'GG' . $dataSend['google_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 1;
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $newUser->last_login = date('Y-m-d H:i:s');
                    $newUser->access_token = createToken();
                    $newUser->device_token = $dataSend['device_token'] ?? null;
                    $userModel->save($newUser);

                    return apiResponse(0, 'Đăng nhập thành công', $newUser);
                }

                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function checkLoginAppleApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $defaultAvatar;

    $userModel = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['apple_id'])) {
            $user = $userModel->find()->where(['apple_id' => $dataSend['apple_id']])->first();

            if ($user) {
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone_number'])) {
                    $checkPhone = $userModel->find()->where(['phone_number' => $dataSend['phone_number']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->apple_id = $dataSend['apple_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->name = $dataSend['name'] ?? $checkPhone->name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = date('Y-m-d H:i:s');
                        $checkPhone->access_token = createToken();
                        $userModel->save($checkPhone);

                        return apiResponse(0, 'Đăng nhập thành công', $checkPhone);
                    }
                }

                // Kiểm tra user email đã tồn tại chưa
                if (!empty($dataSend['email'])) {
                    $checkEmail = $userModel->find()->where(['email' => $dataSend['email']])->first();

                    if (!empty($checkEmail)) {
                        $checkEmail->apple_id = $dataSend['apple_id'];
                        $checkEmail->avatar = $dataSend['avatar'] ?? $checkEmail->avatar;
                        $checkEmail->name = $dataSend['name'] ?? $checkEmail->name;
                        $checkEmail->phone_number = $dataSend['phone_number'] ?? $checkEmail->phone_number;
                        $checkEmail->last_login = date('Y-m-d H:i:s');
                        $checkEmail->access_token = createToken();
                        $userModel->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới

                if (!empty($dataSend['email']) || !empty($dataSend['phone_number'])) {
                    $newUser = $userModel->newEmptyEntity();
                    $newUser->name = $dataSend['name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone_number = $dataSend['phone_number'] ?? 'AP' . $dataSend['apple_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 1;
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $newUser->last_login = date('Y-m-d H:i:s');
                    $newUser->access_token = createToken();
                    $newUser->device_token = $dataSend['device_token'] ?? null;
                    $userModel->save($newUser);

                    return apiResponse(0, 'Đăng nhập thành công', $newUser);
                }

                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
