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
            && isset($dataSend['email'])
            && isset($dataSend['password_confirmation'])
        ){
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
                $user->sex = (int) @$dataSend['sex']?? 1;
                $user->birthday = (int) strtotime(@$dataSend['birthday']);
                $user->email = @$dataSend['email'] ?? null;
                $user->address = @$dataSend['address'] ?? null;
                $user->status = 'lock';
                $user->created_at = time();
                $user->deadline =  strtotime("+30 days", time());
                $user->updated_at = time();
                $user->last_login = time();
                $user->token = createToken();
                $code = rand(100000, 999999);
                $user->reset_password_code = @$code;
                $user->device_token = @$dataSend['device_token'];
                $user->current_weight =  (int) @$dataSend['current_weight'];
                $user->target_weight =  (int) @$dataSend['target_weight'];
                $user->height =  (int) @$dataSend['height'];
                $modelUser->save($user);

                $loginUser = $modelUser->find()->where([
                    'phone' => $dataSend['phone'],
                    'password' => md5($dataSend['password']),
                    'status' => 'lock'
                ])->first();

                // sendEmailnewUserRegistration($user->name, $user->id);
                if($loginUser->email){
                    sendEmailCodeForgotPassword($loginUser->email, $loginUser->full_name, $code);
                }
                

                return apiResponse(0, 'Lưu thông tin thành công', $loginUser);
            }

            return apiResponse(3, 'Số điện thoại đã tồn tại');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function confirmotpcodeApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone']) && isset($dataSend['code'])  && isset($dataSend['device_token'])) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
            $user = $modelUser->find()->where(['phone' => $dataSend['phone'],])->first();

            if (empty($user)) {
                return apiResponse(3, 'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if ($user->reset_password_code !== $dataSend['code']) {
                return apiResponse(4, 'Mã xác nhận không chính xác');
            }

            $user->reset_password_code = null;
            $user->token = createToken();
            $user->last_login = time();
            $user->status = 'active';
            $user->device_token = @$dataSend['device_token'];
            $modelUser->save($user);

            return apiResponse(0, 'xác nhận thành công', $user);
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

            if ($user->status != 'active') {
                return apiResponse(3, 'Tài khoản đang bị khóa');
            }

            if (!$user->email) {
                return apiResponse(3, 'Tài khoản chưa có thông tin email');
            }

            $code = rand(100000, 999999);
            $user->reset_password_code = $code;
            $modelUser->save($user);
            sendEmailCodeForgotPassword($user->email, $user->full_name, $code);

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
            $user->token = createToken();
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
                $user->last_login = time();
                $user->token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->full_name = $dataSend['full_name'] ?? $user->name;
                $modelUser->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone'])) {
                    $checkPhone = $modelUser->find()->where(['phone' => $dataSend['phone']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->facebook_id = $dataSend['facebook_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->full_name = $dataSend['full_name'] ?? $checkPhone->full_name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = time();
                        $checkPhone->token = createToken();
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
                        $checkEmail->full_name = $dataSend['full_name'] ?? $checkEmail->full_name;
                        $checkEmail->phone = $dataSend['phone'] ?? $checkEmail->phone;
                        $checkEmail->last_login = time();
                        $checkEmail->token = createToken();
                        $modelUser->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới

                if (!empty($dataSend['email']) || !empty($dataSend['phone'])) {
                    $newUser = $modelUser->newEmptyEntity();
                    $newUser->full_name = $dataSend['full_name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone = $dataSend['phone'] ?? 'FB' . $dataSend['facebook_id'];
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->birthday = (int) strtotime($dataSend['birthday']);
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = 'active';
                    $newUser->created_at = time();
                    $newUser->updated_at = time();
                    $newUser->facebook_id = $dataSend['facebook_id'];
                    $newUser->last_login = time();
                    $newUser->deadline =  strtotime("+30 days", time());
                    $newUser->token = createToken();
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
                $user->last_login = time();
                $user->token = createToken();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->full_name = $dataSend['full_name'] ?? $user->full_name;
                $user->device_token = $dataSend['device_token'] ?? $user->device_token;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone'])) {
                    $checkPhone = $userModel->find()->where(['phone' => $dataSend['phone']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->google_id = $dataSend['google_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->full_name = $dataSend['full_name'] ?? $checkPhone->full_name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login = time();
                        $checkPhone->token = createToken();
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
                        $checkEmail->full_name = $dataSend['full_name'] ?? $checkEmail->full_name;
                        $checkEmail->phone = $dataSend['phone'] ?? $checkEmail->phone;
                        $checkEmail->last_login = time();
                        $checkEmail->token = createToken();
                        $checkEmail->device_token = $dataSend['device_token'] ?? $checkEmail->device_token;
                        $userModel->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới
                if (!empty($dataSend['email'])){
                    $newUser = $userModel->newEmptyEntity();

                    if(empty($dataSend['phone'])){
                        $dataSend['phone'] = 'GG' . $dataSend['google_id'];
                    }
                    $newUser->full_name = $dataSend['full_name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? '';
                    $newUser->phone =  $dataSend['phone'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = 'active';
                    $newUser->birthday = (int) strtotime(@$dataSend['birthday']);
                    $newUser->created_at = time();
                    $newUser->updated_at = time();
                    $newUser->password = md5($newUser->phone);
                    $newUser->google_id = $dataSend['google_id'];
                    $newUser->last_login = time();
                    $newUser->deadline =  strtotime("+30 days", time());
                    $newUser->token = createToken();
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

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['apple_id'])) {
            $user = $modelUser->find()->where(['apple_id' => $dataSend['apple_id']])->first();

            if ($user) {
                $user->last_login = time();
                $user->token = createToken();
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->full_name = $dataSend['full_name'] ?? $user->full_name;
                $modelUser->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                $user = $modelUser->newEmptyEntity();
                $user->apple_id = $dataSend['apple_id'];
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? '';
                $user->last_login = date('Y-m-d H:i:s');
                $user->token = createToken();
                $modelUser->save($user);

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

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (empty($dataSend['token'])) {
            return apiResponse(3, 'thiếu dữ liệu');
        }

            $user = getUserByToken($dataSend['token']);
         
            if(!empty($user)){
                return apiResponse(0, 'Láy thông tin người dùng thành công', $user);
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        
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

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $currentUser = getUserByToken($dataSend['token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

       
        if (!empty($dataSend['full_name'])) {
            $currentUser->full_name = $dataSend['full_name'];
        }

        if (!empty($dataSend['email'])) {
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

        if (!empty($dataSend['phone'])) {
            $checkPhone = $modelUser->find()
                ->where([
                    'phone' => $dataSend['phone'],
                    'id <>' => $currentUser->id,
                ])->first();

            if (!empty($checkPhone)) {
                return apiResponse(4, 'Số điện thoại đã được sử dụng');
            }
            $currentUser->phone = $dataSend['phone'];
        }

        if (!empty($dataSend['birthday'])) {
            $currentUser->birthday = (int) strtotime($dataSend['birthday']);
        }

        if (!empty($dataSend['sex'])) {
            $currentUser->sex = (int) strtotime($dataSend['sex']);
        }

        if (!empty($dataSend['address'])) {
            $currentUser->address = $dataSend['address'];
        }

        if (!empty($dataSend['target_weight'])) {
            $currentUser->target_weight = $dataSend['target_weight'];
        }

        if (!empty($dataSend['height'])) {
            $currentUser->height = (int) $dataSend['height'];
        }

        if (isset($dataSend['current_weight'])) {
            $currentUser->current_weight = (int) $dataSend['current_weight'];
        }

        if (isset($dataSend['id_workout'])) {
            $currentUser->id_workout = (int) $dataSend['id_workout'];
        }

        if (isset($dataSend['id_mealplan'])) {
            $currentUser->id_mealplan = (int) $dataSend['id_mealplan'];
        }

        if (isset($dataSend['id_unit'])) {
            $currentUser->id_unit = (int) $dataSend['id_unit'];
        }

        // avatar
        if (!empty($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
            // New image
            $avatar = uploadImage($currentUser->phone, 'avatar', 'avatar_'.$currentUser->phone);
            if(!empty($avatar['linkOnline'])){
                $currentUser->avatar = $avatar['linkOnline'];
            }
            
        }


        $modelUser->save($currentUser);

        return apiResponse(0, 'Cập nhật thông tin thành công',$currentUser);
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


function listUnitApi(){
    global $listUnit; 
    return apiResponse(1, 'Lấy dữ liệu thành công', $listUnit);
}

function listUserGetAffsource($input){
    global $isRequestPost;
    global $controller;
    global $session;

    $modelMember = $controller->loadModel('Members');

    $return = array('code'=>0);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $checkUser = getMemberByToken($dataSend['token']);
        if(!empty($checkUser)){
            $data = $modelMember->find()->where(array('id_affsource'=>$checkUser->id))->all()->toList();
            if(!empty($data)){
                $return = array('code'=>1,
                                'data'=>$data,
                                'messages'=>'lấy data thành công'
                                );
            }else{
                $return = array('code'=>2,
                                    'messages'=>'không có data'
                                );
            }
        }else{
                $return = array('code'=>3,
                                    'messages'=>'Tài khoản không tồn tại hoặc sai token'
                                );
            }

    }
    return $return;
}
?>