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
            && isset($dataSend['device_token'])
        ) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);
            $checkDuplicatePhone = $modelUser->find()->where([
                'phone_number' => $dataSend['phone_number']
            ])->first();

            if (isset($dataSend['email'])) {
                $checkDuplicateEmail = $modelUser->find()->where([
                    'email' => $dataSend['email']
                ])->first();
            }

            if (empty($checkDuplicatePhone) && empty($checkDuplicateEmail)) {
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
                $user->device_token = $dataSend['device_token'];
                $modelUser->save($user);

                $loginUser = $modelUser->find()->where([
                    'phone_number' => $dataSend['phone_number'],
                    'password' => md5($dataSend['password']),
                    'status' => 1
                ])->first();

                sendEmailnewUserRegistration($user->name, $user->id);

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

        if (isset($dataSend['phone_number']) && isset($dataSend['password']) && isset($dataSend['device_token'])) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);

            $user = $modelUser->find()->where([
                'phone_number' => $dataSend['phone_number'],
                'password' => md5($dataSend['password']),
                'status' => 1,
                'deleted_at IS' => null
            ])->first();

            if (!empty($user)) {
                $user->access_token = createToken();
                $user->last_login = date('Y-m-d H:i:s');
                $user->device_token = $dataSend['device_token'];
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
    global $ownerType;
    global $imageType;
    global $isRequestPost;
    global $memberType;
    global $urlTransaction;
    global $transactionKey;

    $modelImage = $controller->loadModel('Images');
    $modelDriverRequest = $controller->loadModel('DriverRequests');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã toksen');
            }
        }

        if ($currentUser->type === $memberType['driver']) {
            return apiResponse(4, 'Bạn đã là tài xế rồi');
        }

        $currentRequest = $modelDriverRequest->find()
            ->where(['user_id' => $currentUser->id])
            ->first();
        $parameter = parameter();
        if (!empty($currentRequest) && !$currentRequest->status) {
            $money = (int) $parameter['moneyUpgradeToDriver'];
            $data =array();
            if (!empty($money)) {
                $addInfo = "$currentUser->phone_number $transactionKey";
                $url = $urlTransaction . "amount=$money&addInfo=$addInfo&accountName=CTY CP THUONG MAI VA DV EXC-GO";
                $data = [
                    'url' => $url,
                    'bank' => 'Ngân hàng Tiên Phong Bank (TPB)',
                    'account_number' => '26689898989',
                    'account_name' => 'CTY CP THUONG MAI VA DV EXC-GO',
                    'content' => $addInfo,
                    'noidung' => @$parameter['contentUpgradeToDriver']
                ];
            }

            return apiResponse(4, 'Yêu cầu của bạn đang chờ duyệt',$data);
        }

       /* $checkAvatar = $modelImage->find()
            ->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['avatar']
            ])->first();

        if (empty($checkAvatar)) {
            return apiResponse(4, 'Bạn cần cập nhật ảnh đại diện');
        }*/

        $checkIdCardFront = $modelImage->find()
            ->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['id-card-front']
            ])->first();
        $checkIdCardBack = $modelImage->find()
            ->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['id-card-back']
            ])->first();

        if (empty($checkIdCardFront) || empty($checkIdCardBack)) {
            return apiResponse(4, 'Bạn cần cập nhật ảnh CCCD');
        }

        $checkCarImage = $modelImage->find()
            ->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['car']
            ])->first();

        if (empty($checkCarImage)) {
            return apiResponse(4, 'Bạn cần cập nhật ảnh phương tiện');
        }

        if (empty($currentUser->email)
            || empty($currentUser->bank_account)
            || empty($currentUser->account_number)
            || empty($currentUser->birthday)
        ) {
            return apiResponse(4, 'Bạn cần nhập đủ thông tin tài khoản trước khi gửi yêu cầu');
        }

        $request = $modelDriverRequest->newEmptyEntity();
        $request->user_id = $currentUser->id;
        $modelDriverRequest->save($request);



        sendEmailUpgradeToDriver($currentUser->name, $currentUser->id);

         $money = (int) parameter()['moneyUpgradeToDriver'];
        $data =array();
        if (!empty($money)) {
            $addInfo = "$currentUser->phone_number $transactionKey";
            $url = $urlTransaction . "amount=$money&addInfo=$addInfo&accountName=CTY CP THUONG MAI VA DV EXC-GO";
            $data = [
                'url' => $url,
                'bank' => 'Ngân hàng Tiên Phong Bank (TPB)',
                'account_number' => '26689898989',
                'account_name' => 'CTY CP THUONG MAI VA DV EXC-GO',
                'content' => $addInfo
            ];
        }

        return apiResponse(0, 'Gửi yêu cầu thành công', $data);
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
    $imageModel = $controller->loadModel('Images');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['google_id'])) {
            $user = $userModel->find()->where(['google_id' => $dataSend['google_id']])->first();

            if ($user) {
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $user->device_token = $dataSend['device_token'] ?? $user->device_token;
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
                        $checkPhone->device_token = $dataSend['device_token'] ?? $checkPhone->device_token;
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
                        $checkEmail->device_token = $dataSend['device_token'] ?? $checkEmail->device_token;
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

                    if (!empty($dataSend['avatar'])) {
                        $newImage = [
                            'path' => $dataSend['avatar'],
                            'local_path' => null,
                            'type' => 'avatar',
                            'owner_id' => $newUser->id,
                            'owner_type' => 'users',
                        ];
                        $imageModel->save($newImage);
                    }

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
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                $user = $userModel->newEmptyEntity();
                $user->apple_id = $dataSend['apple_id'];
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->is_verified = 1;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getUserDetailApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelUser = $controller->loadModel('Users');
    $modelImage = $controller->loadModel('Images');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $idCardFront = $imageType['id-card-front'];
            $idCardBack = $imageType['id-card-back'];
            $carImage = $imageType['car'];
            $type = $ownerType['users'];
            $user = $modelUser->find()
                ->join([
                    [
                        'table' => 'images',
                        'alias' => 'IdCardFront',
                        'type' => 'LEFT',
                        'conditions' => [
                            'IdCardFront.owner_id = Users.id',
                            "IdCardFront.owner_type = '$type'",
                            "IdCardFront.type = '$idCardFront'"
                        ],
                    ],
                    [
                        'table' => 'images',
                        'alias' => 'IdCardBack',
                        'type' => 'LEFT',
                        'conditions' => [
                            'IdCardBack.owner_id = Users.id',
                            "IdCardBack.owner_type = '$type'",
                            "IdCardBack.type = '$idCardBack'"
                        ],
                    ],
                    [
                        'table' => 'images',
                        'alias' => 'CarImages',
                        'type' => 'LEFT',
                        'conditions' => [
                            'CarImages.owner_id = Users.id',
                            "CarImages.owner_type = '$type'",
                            "CarImages.type = '$carImage'"
                        ],
                    ]
                ])->select([
                    'Users.id',
                    'Users.name',
                    'Users.email',
                    'Users.phone_number',
                    'Users.bank_account',
                    'Users.account_number',
                    'Users.avatar',
                    'Users.address',
                    'Users.type',
                    'Users.birthday',
                    'Users.total_coin',
                    'IdCardFront.id',
                    'IdCardFront.path',
                    'IdCardBack.id',
                    'IdCardBack.path',
                ])->where([
                    'access_token' => $dataSend['access_token'],
                    'status' => 1
                ])->first();

            if (empty($user)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $carImage = $modelImage->find()
                ->select(['id', 'path'])
                ->where([
                    'owner_id' => $user->id,
                    'owner_type' => 'users',
                    'type' => 'car'
                ])->all()->toArray();
            $user->carImages = $carImage;

            return apiResponse(0, 'Láy thông tin người dùng thành công', $user);
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function updateUserApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelUser = $controller->loadModel('Users');
    $modelImage = $controller->loadModel('Images');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        if ($currentUser->type == 0) {
            return apiResponse(3, 'Tài khoản chưa nâng cấp lên tài xế');
        }

        if (isset($dataSend['name'])) {
            $currentUser->name = $dataSend['name'];
        }

        if (isset($dataSend['email'])) {
            $checkEmail = $modelUser->find()
                ->where([
                    'email' => $dataSend['email'],
                    'id <>' => $currentUser->id,
                ])->first();

            if (!empty($checkEmail)) {
                return apiResponse(4, 'Email đã được sử dụng');
            }
            $currentUser->email = $dataSend['email'];
        }

        if (isset($dataSend['phone_number'])) {
            $checkPhone = $modelUser->find()
                ->where([
                    'email' => $dataSend['phone_number'],
                    'id <>' => $currentUser->id,
                ])->first();

            if (!empty($checkPhone)) {
                return apiResponse(4, 'Số điện thoại đã được sử dụng');
            }
            $currentUser->phone_number = $dataSend['phone_number'];
        }

        if (isset($dataSend['birthday'])) {
            $currentUser->birthday = DateTime::createFromFormat('d/m/Y', $dataSend['birthday']);
        }

        if (isset($dataSend['address'])) {
            $currentUser->address = $dataSend['address'];
        }

        if (isset($dataSend['bank_account'])) {
            $currentUser->bank_account = $dataSend['bank_account'];
        }

        if (isset($dataSend['account_number'])) {
            $currentUser->account_number = $dataSend['account_number'];
        }

        $newImages = [];
        $oldImages = [];

        // avatar
        if (isset($_FILES['avatar'])) {
            // Old image
            $oldAvatar = $modelImage->find()->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['avatar']
            ])->first();
            $oldImages[] = $oldAvatar;

            // New image
            $newAvatar = uploadImage($currentUser->id, 'avatar', "avatar_$currentUser->id" . '_' . time());
            $currentUser->avatar = $newAvatar['linkOnline'];
            $newImages[] = [
                'path' => $newAvatar['linkOnline'],
                'local_path' => $newAvatar['linkLocal'],
                'type' => $imageType['avatar'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];

            $currentUser->avatar = $newAvatar['linkOnline'];
        }

        // Id card front
        if (isset($_FILES['id_card_front'])) {
            $oldCardFront = $modelImage->find()->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['id-card-front']
            ])->first();

            if (!empty($oldCardFront)) {
                $oldImages[] = $oldCardFront;
            }

            $newCardFront = uploadImage($currentUser->id, 'id_card_front', "id_card_front_$currentUser->id" . '_' . time());
            $newImages[] = [
                'path' => $newCardFront['linkOnline'],
                'local_path' => $newCardFront['linkLocal'],
                'type' => $imageType['id-card-front'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];
        }

        // Id card back
        if (isset($_FILES['id_card_back'])) {
            $oldCardBack = $modelImage->find()->where([
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users'],
                'type' => $imageType['id-card-back']
            ])->first();

            if (!empty($oldCardBack)) {
                $oldImages[] = $oldCardBack;
            }

            $newCardFront = uploadImage($currentUser->id, 'id_card_back', "id_card_back_$currentUser->id" . '_' . time());
            $newImages[] = [
                'path' => $newCardFront['linkOnline'],
                'local_path' => $newCardFront['linkLocal'],
                'type' => $imageType['id-card-back'],
                'owner_id' => $currentUser->id,
                'owner_type' => $ownerType['users']
            ];
        }

        // new car image
        for ($i = 1; $i <= 10; $i++) {
            if (isset($_FILES["car_image_$i"])) {
                $carImage = uploadImage($currentUser->id, "car_image_$i", "car_$i" . "_$currentUser->id" . '_' . time());
                if ($carImage['code']) {
                    return apiResponse(4, $carImage['mess']);
                }
                $newImages[] = [
                    'path' => $carImage['linkOnline'],
                    'local_path' => $carImage['linkLocal'],
                    'type' => $imageType['car'],
                    'owner_id' => $currentUser->id,
                    'owner_type' => $ownerType['users']
                ];
            } else {
                break;
            }
        }

        // old car image
        if (!empty($dataSend['delete_car_images']) && is_array($dataSend['delete_car_images'])) {
            $oldCarImages = $modelImage->find()
                ->where([
                    'id IN' => $dataSend['delete_car_images'],
                    'owner_id' => $currentUser->id,
                    'owner_type' => $ownerType['users']
                ])->all();
            $oldImages = array_merge($oldImages, $oldCarImages->toList());
        }

        // Insert new image
        $modelImage->saveMany($modelImage->newEntities($newImages));
        $modelUser->save($currentUser);

        // Delete old image
        if (count(array_filter($oldImages))) {
            $deleteImageIds = array_map(function ($item) {
                return $item->id;
            }, $oldImages);

            $modelImage->deleteAll(['id IN' => $deleteImageIds]);

            foreach ($oldImages as $item) {
                if (!empty($item->local_path)) {
                    removeFile($item->local_path);
                }
            }
        }

        return apiResponse(0, 'Cập nhật thông tin thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function deleteUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            if(!empty($dataSend['pass'])){
                $currentUser = getUserByToken($dataSend['access_token']);

                if (empty($currentUser)) {
                    return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
                }else{
                    if(md5($dataSend['pass']) != $currentUser->password){
                        return apiResponse(4, 'Mật khẩu nhập chưa đúng');
                    }
                }
            }else{
                return apiResponse(2, 'Gửi thiếu mật khẩu');
            }
        }

        $currentUser->deleted_at = date('Y-m-d H:i:s');
        $currentUser->access_token = null;
        $modelUser->save($currentUser);

        return apiResponse(0, 'Xóa tài khoản thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function conventionParameterAPI(){
    return apiResponse(1, 'Lấy dữ liệu thành công', parameter());
}

function getUserStatisticAdmin($input)
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    $modelBooking = $controller->loadModel('Bookings');
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

            // $currentUser->nhan_cuoc = count($modelBooking->find()->where(array('received_by'=>$currentUser->id,))->all()->toList());
            // $currentUser->dang_cuoc = count($modelBooking->find()->where(array('posted_by'=>$currentUser->id,))->all()->toList());

            $currentUser->dang_cuoc = $currentUser->posted;
            $currentUser->nhan_cuoc = $currentUser->received;

            return apiResponse(0, 'Lấy dữ liệu thành công', $currentUser);
        }

    }
    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');

}
function checkVersionApp($input){
      global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $dataSend['id_app_ios'] = isset($dataSend['id_app_ios']) ? $dataSend['id_app_ios'] : 6470706785;
        $dataSend['id_app_android'] = isset($dataSend['id_app_android']) ? $dataSend['id_app_android'] : 'com.tasvn.exc';


    
        $ios = sendDataConnectMantan('https://itunes.apple.com/lookup?id='.$dataSend['id_app_ios']);
        $ios = str_replace('ï»¿', '', utf8_encode($ios));
        $ios = json_decode($ios, true);

        $ios = $ios['results'][0]['version'];

        $android = sendDataConnectMantan('https://play.google.com/store/apps/details?id='.$dataSend['id_app_android'].'&hl=en');
        $android = str_replace('ï»¿', '', utf8_encode($android));
        
        
        // $pattern = "/version%3D%27([0-9\.]+)%27/";
         $pattern ='/\[\[\[\"\d+\.\d+\.\d+/';

        $version = '';
        if (preg_match($pattern, $android, $matches)) {
            $version = ltrim($matches[0],'[[["');
        }
      
        $data = ['ios'=>$ios,'android'=>$version];
        return apiResponse(1, 'Lấy dữ liệu thành công', $data);
      

    }
    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
} 
?>