<?php

function registerUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    $modelHistoryResultUser = $controller->loadModel('HistoryResultUsers');

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
                $getBankAccount =getBankAccount();
                  $user = $modelUser->newEmptyEntity();
                if(!empty($dataSend['affsource'])){
                    $affsource = $modelUser->find()->where(array('phone'=>$dataSend['affsource']))->first();
                    if(!empty($affsource)){
                        $user->id_affsource =$affsource->id;
                        
                        $user->rose =0;
                        
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
                $user->deadline =  strtotime("+7 days", time());
                $user->updated_at = time();
                $user->last_login = time();
                $user->token = 'web'.createToken();
                $user->token_app = 'app'.createToken();
                $code = rand(100000, 999999);
                $user->reset_password_code = @$code;
                $user->device_token = @$dataSend['device_token'];
                $user->current_weight =  (double) @$dataSend['current_weight'];
                $user->target_weight =  (double) @$dataSend['target_weight'];
                $user->height =  (int) @$dataSend['height'];
                $user->id_group_user =  (double) @$dataSend['id_group_user'];
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

                if(!empty($dataSend['token'])){

                    $checkHistoryResult = $modelHistoryResultUser->find()->where(['token'=>$dataSend['token']])->first();

                    if(!empty($checkHistoryResult)){
                        $checkHistoryResult->token = null;
                        $checkHistoryResult->id_user = $loginUser->id;
                        $modelHistoryResultUser->save($checkHistoryResult);

                        $loginUser->historyResult= $checkHistoryResult;
                    }else{
                        $loginUser->historyResult= array();
                    }
                }


                return apiResponse(0, 'Lưu thông tin thành công', $loginUser);
            }

            return apiResponse(3, 'Số điện thoại đã tồn tại');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function sendEmailCodeApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $conditions = array();
        if (isset($dataSend['phone'])) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $conditions['phone'] = str_replace('+84', '0', $dataSend['phone']);
        }elseif(!empty($dataSend['token'])){
            $conditions['token'] = $dataSend['token'];
        }else{
             return apiResponse(1, 'thiếu dữ liệu');
        }


            $user = $modelUser->find()->where([
                'phone' => $dataSend['phone'],
            ])->first();

            if (!$user) {
                return apiResponse(3, 'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if (!$user->email) {
                return apiResponse(3, 'Tài khoản chưa có thông tin email');
            }

            $code = rand(100000, 999999);
            $user->reset_password_code = $code;
            $modelUser->save($user);
            sendEmailCodeForgotPassword($user->email, $user->full_name, $code);

            return apiResponse(0, 'Tạo mã OTP thành công');
        

        return apiResponse(2, 'Chưa nhập số điện thoại');
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

        if (!empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['type'])) {

            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);

            $user = $modelUser->find()->where([
                'phone' => $dataSend['phone'],
                'password' => md5($dataSend['password']),
            ])->first();

            if (!empty($user)) {
                if($dataSend['type']=='web'){
                    $user->token = 'web'.createToken();
                }elseif($dataSend['type']=='app'){
                    $user->token_app = 'app'.createToken();   
                    $user->device_token = $dataSend['device_token'];
                }
                
                $user->last_login = time();
                $modelUser->save($user);

                if($user->status=='lock'){
                    return apiResponse(5, 'Bạn chưa xác nhận mã OTP', $user);
                }elseif(!empty($user->status_pay_package)){
                    return apiResponse(0, 'Đăng nhập thành công', $user);
                 }else{
                    return apiResponse(4, 'Bạn chưa thanh toán gói tập', $user);
                 }

               
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

        if (isset($dataSend['token']) && !empty($dataSend['type'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
                if($dataSend['type']=='web'){
                    $user->token = '';
                }elseif($dataSend['type']=='app'){
                    $user->token_app = '';   
                    $user->device_token = null;
                }
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
            $date = explode("/", $dataSend['birthday']);
            $currentUser->birthday =  mktime(0, 0, 0, $date[1], $date[0], $date[2]);
        }


        if (!empty($dataSend['sex'])) {
            $currentUser->sex = (int) strtotime($dataSend['sex']);
        }

        if (!empty($dataSend['address'])) {
            $currentUser->address = $dataSend['address'];
        }

        if (!empty($dataSend['target_weight'])) {
            $currentUser->target_weight = (double) $dataSend['target_weight'];
        }

        if (!empty($dataSend['height'])) {
            $currentUser->height = (double) $dataSend['height'];
        }

        if (isset($dataSend['current_weight'])) {
            $currentUser->current_weight = (double) $dataSend['current_weight'];
        }

        if (isset($dataSend['id_workout'])) {
            $currentUser->id_workout = (int) $dataSend['id_workout'];
        }

        if (isset($dataSend['id_mealplan'])) {
            $currentUser->id_mealplan = (int) $dataSend['id_mealplan'];
        }

        if (isset($dataSend['id_fitness_level'])) {
            $currentUser->id_fitness_level = (int) $dataSend['id_fitness_level'];
        }

         if (isset($dataSend['id_unit'])) {
            $currentUser->id_unit = (int) $dataSend['id_unit'];
        }

         if (isset($dataSend['id_area'])) {
            $currentUser->id_area = $dataSend['id_area'];
        }
        if (isset($dataSend['water'])) {
            $currentUser->water = (int) $dataSend['water'];
        }

         if (isset($dataSend['meal'])) {
            $currentUser->meal = (int) $dataSend['meal'];
        }

         if (isset($dataSend['workout'])) {
            $currentUser->workout = (int) $dataSend['workout'];
        }



        if (isset($dataSend['time_fast'])) {
            $time_now = explode(" ", $dataSend['time_fast']);
            $time = explode(":", $time_now[0]);
            $date = explode("/", $time_now[1]);
            $currentUser->time_fast = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
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

    $modelUser = $controller->loadModel('Users');

    $return = array('code'=>0);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
        $checkUser = getUserByToken($dataSend['token']);
        if(!empty($checkUser)){
            $data = $modelUser->find()->where(array('id_affsource'=>$checkUser->id))->all()->toList();
            return apiResponse(0, 'lấy dữ liệu thành công công', $data,count($data));
                
            }
            return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


function checkUserPayPackage($input)
{
      global $controller;
    global $isRequestPost;
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (empty($dataSend['token'])) {
            return apiResponse(3, 'thiếu dữ liệu');
        }

            $user = getUserByToken($dataSend['token']);

            if(!empty($user)){
         
                if(!empty($user->status_pay_package)){
                    return apiResponse(1, 'bạn dã thanh toán', $user);
                }else{
                        return apiResponse(4, 'Bạn chưa thanh toán ', $user);
                     }
            }else{
                return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
            }
    }
     return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
}

function checkUserDateline($input)
{
      global $controller;
    global $isRequestPost;
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (empty($dataSend['token'])) {
            return apiResponse(3, 'thiếu dữ liệu');
        }

            $user = getUserByToken($dataSend['token']);

            if(!empty($user)){
         
                if($user->deadline>time()){
                    return apiResponse(1, 'Tài khoản của bạn vẫn còn hạn ', $user);
                }else{
                        return apiResponse(4, 'Tài khoản của bạn đã hết hạn  ', $user);
                     }
            }else{
                return apiResponse(2, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
            }
    }
     return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
}

function fastingTimerUsre($input){
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelUser = $controller->loadModel('Users');
    $modelMealtime = $controller->loadModel('Mealtime');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id_fasting'])){
        $currentUser = getUserByToken($dataSend['token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $dataMyplane = $modelMealtime->find()->where(['id'=>(int)$dataSend['id_fasting']])->first();
        if(!empty($dataMyplane)){
            $currentUser->time_fast = time();
            $currentUser->id_mealtime = $dataMyplane->id; 
            $currentUser->time_fast_end = time() + ($dataMyplane->fasting * 60 * 60);
            $modelUser->save($currentUser);
               return apiResponse(0, 'bạn gia hạn nhịn ăn thành công ',$currentUser);
        }

        return apiResponse(0, 'thời gian này không tồi tại');
    }
        return apiResponse(3, 'thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}




function checkfastingTimerUsreAPI($input){
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelUser = $controller->loadModel('Users');
    $modelMealtime = $controller->loadModel('Mealtime');
    $modelNotification = $controller->loadModel('Notifications');

    $listData = $modelUser->find()->where(['time_fast_end >'=> time()-60,'time_fast_end <'=> time()+60 ])->all()->toList();

    if(!empty($listData)){
        foreach($listData as $key => $item){
            $checkUser = $modelUser->find()->where(['id'=>$item->id ])->first();
           $device_token =array();
            if(!empty($checkUser)){
                $device_token[] = $checkUser->device_token;
                $title = 'Thông báo nhịn ăn';
                $content = 'bạn nhị ăn thành công';
                $notification = $modelNotification->newEmptyEntity();
                $notification->id_user = $checkUser->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->action = 'adminSendNotification';
                $notification->created_at = time();
                $modelNotification->save($notification);

                $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'adminSendNotification'
                    );

                    if(!empty($device_token)){

                            // $return = sendNotification($dataSendNotification, $device_token);
                        
                        $mess = sendNotificationnew($dataSendNotification, $device_token);
                        
                        
                    }
                        

                $checkUser->time_fast = 0;
                $checkUser->time_fast_end = 0;
                $modelUser->save($checkUser);

            }
        }
        return array('code'=>1 ,'mess'=>'ok');
    }
     return array('code'=>2 ,'mess'=>' no ok');
        
}


function getInfoContactAPI($input){
    global $modelOptions;
    $conditions = array('key_word' => 'contact_site');
    $contact_site = $modelOptions->find()->where($conditions)->first();

    $contact_site_value = array();
        if(!empty($contact_site->value)){
            $contact_site_value = json_decode($contact_site->value, true);
        }


    return apiResponse(0, 'Lấy dữ liệu thành công', $contact_site_value);
}

function userSetReminderAPI($input){    
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $getday;

    $modelUser = $controller->loadModel('Users');
    $modelReminder = $controller->loadModel('Reminders');   

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (empty($dataSend['token']) && empty($dataSend['data_time'])) {
            return apiResponse(3, 'thiếu dữ liệu');
        }

            $user = getUserByToken($dataSend['token']);
         
            if(!empty($user)){
               if(!empty($dataSend['data_time'])){
                    $modelReminder->deleteAll(['id_user'=>$user->id]);
                    $listData = json_decode($dataSend['data_time'], true);
                    foreach($listData as $key => $value){
                         $checkday =  $modelReminder->newEmptyEntity();
                        $checkday->number = (int) @$value['number_day'];
                        $checkday->day = @$getday[$checkday->number]['name_en'];

                        $checkday->status = (!empty($value['status']))?$value['status']:'off';
                        $time = explode(":", @$value['time']);
                        $checkday->hour = (!empty($time[0]))?(int)$time[0]:0;
                        $checkday->id_user = @$user->id;
                        $checkday->minute = (!empty($time[1]))?(int)$time[1]:0;
                        $modelReminder->save($checkday);
                    }
                       
                }


                return apiResponse(0, 'Cài đặt hẹn giờ tập thành công',  getdaty($user->id));
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


function  getReminderAPI($input){    
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $getday;

    $modelUser = $controller->loadModel('Users');
    $modelReminder = $controller->loadModel('Reminders');   

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (empty($dataSend['token']) && empty($dataSend['data_time'])) {
            return apiResponse(3, 'thiếu dữ liệu');
        }

            $user = getUserByToken($dataSend['token']);
         
            if(!empty($user)){
              
                return apiResponse(0, 'Lấy dữ liệu thành công',  getdaty($user->id));
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


function checkReminderUsreAPI($input){
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelUser = $controller->loadModel('Users');
    $modelMealtime = $controller->loadModel('Mealtime');
    $modelNotification = $controller->loadModel('Notifications');
   

    $conditions = array('re.day'=>date('l'),'re.hour'=>(int)date('H'),'re.minute'=>(int)date('i'),'re.status'=>'on');

    $json = [
            [
                'table' => 'reminders',
                'alias' => 're',
                'type' => 'LEFT',
                'conditions' => [
                    'Users.id = re.id_user'
                ],
            ]
        ];
    $listData = $modelUser->find()->join($json)->where($conditions)->all()->toList();

    if(!empty($listData)){
        foreach($listData as $key => $item){
           $device_token =array();
            if(!empty($item)){
                $device_token[] = $item->device_token;
                $title = 'Thông báo giờ tập luyện';
                $content = 'bạn đên giờ tập luyện rồi chung bạn tập luyện thật hiệu quản';
                $notification = $modelNotification->newEmptyEntity();
                $notification->id_user = $item->id;
                $notification->title = $title;
                $notification->content = $content;
                $notification->action = 'sendNotificationReminderUsre';
                $notification->created_at = time();
                $modelNotification->save($notification);

                $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'sendNotificationReminderUsre'
                    );

                    if(!empty($device_token)){
                            // $return = sendNotification($dataSendNotification, $device_token);
                        $mess = sendNotificationnew($dataSendNotification, $device_token);
                    }
            }
        }
        return array('code'=>1 ,'mess'=>'ok'.date('H:i'));
    }
     return array('code'=>2 ,'mess'=>' no ok'.date('H:i'));
        
}

function saveRequestWithdrawAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelUser = $controller->loadModel('Users');
    $modeTransactionRoses = $controller->loadModel('TransactionRoses');
    $return = array('code'=>1);

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token']) && !empty($dataSend['money'])){
            if($dataSend['money']>=10000){
                $infoUser = getUserByToken($dataSend['token']);

                if(!empty($infoUser)){
                    if($infoUser->total_coin >= $dataSend['money']){
                        $check = $modeTransactionRoses->find()->where(['id_user'=>$infoUser->id,'status'=>'new'])->first();
                        if(empty($check)){
                            $user = $modelUser->find()->where()->first();
                            if(!empty($user)){
                                if(!empty($dataSend['account_name'])){
                                    $user->account_name = @$dataSend['account_name'];
                                }
                                
                                if(!empty($dataSend['code_bank'])){
                                    $user->code_bank = @$dataSend['code_bank'];
                                }
                                if(!empty($dataSend['account_number'])){
                                    $user->account_number=  @$dataSend['account_number'];
                                }
                            }

                            $order = $modeTransactionRoses->newEmptyEntity();

                            $order->id_user =$infoUser->id;
                            $order->account_name = $user->account_name;
                            $order->code_bank = $user->code_bank;
                            $order->account_number = $user->account_number;
                            $order->phone =$user->phone;
                            $order->note =@$dataSend['note'];
                            $order->status = 'new';
                            $order->total = @$dataSend['money'];
                            $order->created_at =time();
                            $order->updated_at =time();
                            
                            $modeTransactionRoses->save($order);

                            $return = array('code'=>0,
                                            'messages'=>'Tạo yêu cầu rút tiền thành công'
                                        );
                        }else{
                            $return = array('code'=>4,
                                    'messages'=>'bạn đang có giao dịch chưa được sử lý'
                                );
                        }
                    }else{
                        $return = array('code'=>4,
                                    'messages'=>'Số tiền muốn rút vượt quá số dư tài khoản'
                                );
                    }
                }else{
                    $return = array('code'=>3,
                                    'messages'=>'Tài khoản không tồn tại hoặc sai mã token'
                                );
                }
            }else{
                $return = array('code'=>5,
                                    'messages'=>'Số tiền rút phải tối thiểu là 10.000đ'
                                );
            }
        }else{
            $return = array('code'=>2,
                                'messages'=>'Gửi thiếu dữ liệu'
                            );
        }
    }

    return  $return;
}

function listBankAPI(){
    return listBank();
}

function transactioncMoneyAPI($input){
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modeTransactionRoses = $controller->loadModel('TransactionRoses');
    if($isRequestPost){
        $dataSend = $input['request']->getData();   
         if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);
            if (!empty($user)) {
                $dataSend = $input['request']->getData();
                $conditions = array('id_user'=>$user->id);
                $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
                $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
                if ($page < 1) $page = 1;

                $condition = array('id_user'=> $user->id);
                
                $listData = $modeTransactionRoses->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();        
               
                $totalData = count($modeTransactionRoses->find()->where($conditions)->all()->toList());
                    
                return apiResponse(0, 'lấy dữ liệu thành công', $listData, $totalData);
            }
             return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
     return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
?>