<?php

function registerUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['full_name'])
            && isset($dataSend['phone'])
            && isset($dataSend['password'])
            && isset($dataSend['password_confirmation'])
            && isset($dataSend['device_token'])
        ) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
            $checkDuplicatePhone = $modelUser->find()->where([
                'phone' => $dataSend['phone']
            ])->first();

            if (isset($dataSend['email'])) {
                $checkDuplicateEmail = $modelUser->find()->where([
                    'email' => $dataSend['email']
                ])->first();
            }

            if (empty($checkDuplicatePhone)) {
                if ($dataSend['password'] !== $dataSend['password_confirmation']) {
                    return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
                }

                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                    $avatar = uploadImage($dataSend['phone'], 'avatar', 'avatar_'.$dataSend['phone']);
                }

                if(!empty($avatar['linkOnline'])){
                    $avatars = $avatar['linkOnline'].'?time='.time();
                }
                $current_date = new DateTime();
                $current_date->modify('+30 days');
                 (int) $current_date->getTimestamp();
                  $user = $modelUser->newEmptyEntity();
                if(!empty($dataSend['affsource'])){
                    $affsource = $modelUser->find()->where(array('phone'=>$dataSend['affsource']))->first();
                    if(!empty($affsource)){
                        $user->id_affsource =$affsource->id;
                    }
                }

              
                $user->full_name = $dataSend['full_name'];
                $user->avatar = @$avatars ?? '';
                $user->phone = @$dataSend['phone'];
                $user->password = md5($dataSend['password']);
                $user->info = @$dataSend['info'];
                $user->sex = (int) $dataSend['sex'];
                $user->birthday = (int) strtotime($dataSend['birthday']);
                $user->email = @$dataSend['email'] ?? null;
                $user->address = @$dataSend['address'] ?? null;
                $user->status = 'active';
                $user->created_at = time();
                $user->updated_at = time();
                $user->last_login = time();
                $user->token = createToken();
                $user->device_token = @$dataSend['device_token'];
                $user->current_weight =  (int) @$dataSend['current_weight'];
                $user->target_weight =  (int) @$dataSend['target_weight'];
                $user->height =  (int) @$dataSend['height'];
                $modelUser->save($user);

                $loginUser = $modelUser->find()->where([
                    'phone' => $dataSend['phone'],
                    'password' => md5($dataSend['password']),
                    'status' => 'active'
                ])->first();

                // sendEmailnewUserRegistration($user->name, $user->id);

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

        if (!empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['device_token'])) {

            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);

            $user = $modelUser->find()->where([
                'phone' => $dataSend['phone'],
                'password' => md5($dataSend['password']),
                'status' => 'active',
            ])->first();

            if (!empty($user)) {
                $user->token = createToken();
                $user->last_login = time();
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

        if (isset($dataSend['token'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
                $user->token = '';
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

        if (!isset($dataSend['token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['token']);

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
            $currentUser->token = createToken();
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

        if (isset($dataSend['phone'])) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
            $user = $modelUser->find()->where([
                'phone' => $dataSend['phone'],
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

        if (isset($dataSend['phone'])
            && isset($dataSend['code'])
            && isset($dataSend['new_password'])
            && isset($dataSend['password_confirmation'])
        ) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
            $user = $modelUser->find()->where([
                'phone' => $dataSend['phone'],
            ])->first();

            if (empty($user)) {
                return apiResponse(3, 'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if ($user->status != 'active') {
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

function checkLoginFacebookApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $defaultAvatar;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['facebook_id'])) {
            $user = $modelUser->find()->where(['facebook_id' => $dataSend['facebook_id']])->first();

            if ($user) {
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $modelUser->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone'])) {
                    $checkPhone = $modelUser->find()->where(['phone' => $dataSend['phone']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->facebook_id = $dataSend['facebook_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->name = $dataSend['name'] ?? $checkPhone->name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = date('Y-m-d H:i:s');
                        $checkPhone->access_token = createToken();
                        $modelUser->save($checkPhone);

                        return apiResponse(0, 'Đăng nhập thành công', $checkPhone);
                    }
                }

                // Kiểm tra user email đã tồn tại chưa
                if (!empty($dataSend['email'])) {
                    $checkEmail = $modelUser->find()->where(['email' => $dataSend['email']])->first();

                    if (!empty($checkEmail)) {
                        $checkEmail->facebook_id = $dataSend['facebook_id'];
                        $checkEmail->avatar = $dataSend['avatar'] ?? $checkEmail->avatar;
                        $checkEmail->name = $dataSend['name'] ?? $checkEmail->name;
                        $checkEmail->phone = $dataSend['phone'] ?? $checkEmail->phone;
                        $checkEmail->last_login = date('Y-m-d H:i:s');
                        $checkEmail->access_token = createToken();
                        $modelUser->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới

                if (!empty($dataSend['email']) || !empty($dataSend['phone'])) {
                    $newUser = $modelUser->newEmptyEntity();
                    $newUser->name = $dataSend['name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone = $dataSend['phone'] ?? 'FB' . $dataSend['facebook_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 1;
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $newUser->last_login = date('Y-m-d H:i:s');
                    $newUser->access_token = createToken();
                    $newUser->device_token = $dataSend['device_token'] ?? null;
                    $modelUser->save($newUser);

                    return apiResponse(0, 'Đăng nhập thành công', $newUser);
                }

                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function checkLoginGoogleApi($input): a'])) {
                    $checkPhone = $modelUser->find()->where(['phone' => $dataSend['phone']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->google_id = $dataSend['google_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->name = $dataSend['name'] ?? $checkPhone->name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = date('Y-m-d H:i:s');
                        $checkPhone->access_token = createToken();
                        $checkPhone->device_token = $dataSend['device_token'] ?? $checkPhone->device_token;
                        $modelUser->save($checkPhone);

                        return apiResponse(0, 'Đăng nhập thành công', $checkPhone);
                    }
                }

                // Kiểm tra user email đã tồn tại chưa
                if (!empty($dataSend['email'])) {
                    $checkEmail = $modelUser->find()->where(['email' => $dataSend['email']])->first();

                    if (!empty($checkEmail)) {
                        $checkEmail->google_id = $dataSend['google_id'];
                        $checkEmail->avatar = $dataSend['avatar'] ?? $checkEmail->avatar;
                        $checkEmail->name = $dataSend['name'] ?? $checkEmail->name;
                        $checkEmail->phone = $dataSend['phone'] ?? $checkEmail->phone;
                        $checkEmail->last_login = date('Y-m-d H:i:s');
                        $checkEmail->access_token = createToken();
                        $checkEmail->device_token = $dataSend['device_token'] ?? $checkEmail->device_token;
                        $modelUser->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới
                if (!empty($dataSend['email']) || !empty($dataSend['phone'])) {
                    $newUser = $modelUser->newEmptyEntity();
                    $newUser->name = $dataSend['name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone = $dataSend['phone'] ?? 'GG' . $dataSend['google_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 1;
                    $newUser->created_at = date('Y-m-d H:i:s');
                    $newUser->updated_at = date('Y-m-d H:i:s');
                    $newUser->last_login = date('Y-m-d H:i:s');
                    $newUser->access_token = createToken();
                    $newUser->device_token = $dataSend['device_token'] ?? null;
                    $modelUser->save($newUser);

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

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['apple_id'])) {
            $user = $modelUser->find()->where(['apple_id' => $dataSend['apple_id']])->first();

            if ($user) {
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->name = $dataSend['name'] ?? $user->name;
                $modelUser->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                $user = $modelUser->newEmptyEntity();
                $user->apple_id = $dataSend['apple_id'];
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                $user->last_login = date('Y-m-d H:i:s');
                $user->access_token = createToken();
                $user->is_verified = 1;
                $modelUser->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getUserDetailApi($input): a',
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

function updateUserApi($input): a'])) {
            $checkPhone = $modelUser->find()
                ->where([
                    'email' => $dataSend['phone'],
                    'id <>' => $currentUser->id,
                ])->first();

            if (!empty($checkPhone)) {
                return apiResponse(4, 'Số điện thoại đã được sử dụng');
            }
            $currentUser->phone = $dataSend['phone'];
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