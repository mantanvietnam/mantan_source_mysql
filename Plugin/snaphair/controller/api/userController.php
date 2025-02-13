<?php 
function registerUserApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $urlHomes;

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

            if (empty($checkDuplicatePhone) && empty($checkDuplicateEmail)) {
                if ($dataSend['password'] !== $dataSend['password_confirmation']) {
                    return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
                }

                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                $avatars = uploadImage($dataSend['phone'], 'avatar', 'avatar_'.$dataSend['phone']);
	            }
	            if(!empty($avatars['linkOnline'])){
	                $avatar = $avatars['linkOnline'];
	            }else{
	                $avatar = $urlHomes."/plugins/snaphair/view/image/default-avatar.png";
	            }

                $user = $modelUser->newEmptyEntity();
                $user->full_name = $dataSend['full_name'];
                $user->avatar = $avatar;
                $user->phone = $dataSend['phone'];
                $user->password = md5($dataSend['password']);
                $user->email = $dataSend['email'] ?? null;
                $user->address = $dataSend['address'] ?? null;
                $user->sex = $dataSend['sex'] ?? 1;
                $user->status = isset($dataSend['status']) ? (int)$dataSend['status'] : 'active';
                $user->created_at = time();
                $user->last_login = time();
                $user->coin = 0;
                $user->access_token = createTokenCode();
                if (!empty($dataSend['birthday'])) {
		            $date = explode("/", $dataSend['birthday']);
		            $user->birthday =  mktime(0, 0, 0, $date[1], $date[0], $date[2]);
		        }	
                $user->device_token = $dataSend['device_token'];

                if(!empty($dataSend['affsource'])){
                    $affsource = $modelUser->find()->where(array('phone'=>$dataSend['affsource']))->first();
                    if(!empty($affsource)){
                        $user->id_affsource =$affsource->id;
                    }
                }
                
                $modelUser->save($user);

                $loginUser = $modelUser->find()->where([
                    'phone' => $dataSend['phone'],
                    'password' => md5($dataSend['password']),
                    'status' => 'active'
                ])->first();

                return apiResponse(1, 'Lưu thông tin thành công', $loginUser);
            }

            return apiResponse(3, 'Số điện thoại đã tồn tại');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
}

function loginUserApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone']) && isset($dataSend['password']) && isset($dataSend['device_token'])) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);

            $user = $modelUser->find()->where([
                'phone' => $dataSend['phone'],
                'password' => md5($dataSend['password']),
                'status' => 'active',
            ])->first();

            if (!empty($user)) {
                $user->access_token = createTokenCode();
                $user->last_login = time();
                $user->device_token = $dataSend['device_token'];
                $modelUser->save($user);

                return apiResponse(1, 'Đăng nhập thành công', $user);
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mật khẩu');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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

                return apiResponse(1, 'Đăng xuất thành công');
            }

            return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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
            if (md5($dataSend['current_password']) != $currentUser->password) {
                return apiResponse(3, 'Mật khẩu không chính xác');
            }

            if ($dataSend['new_password'] != $dataSend['password_confirmation']) {
                return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
            }

            $currentUser->password = md5($dataSend['new_password']);
            $currentUser->access_token = createTokenCode();
            $currentUser->device_token = @$dataSend['device_token'];
            $modelUser->save($currentUser);

            return apiResponse(1, 'Thay đổi mật khẩu thành công', $currentUser);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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
                return apiResponse(5, 'Tài khoản đang bị khóa');
            }

            if (!$user->email) {
                return apiResponse(4, 'Tài khoản chưa có thông tin email');
            }

            $code = rand(100000, 999999);
            $user->otp = $code;
            $modelUser->save($user);
            sendEmailCodeForgotPassword($user->email, $user->full_name, $code);

            return apiResponse(1, 'Tạo mã cấp lại mật khẩu thành công');
        }

        return apiResponse(2, 'Chưa nhập số điện thoại');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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

            if (!$user) {
                return apiResponse(3, 'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if ($user->status != 'active') {
                return apiResponse(3, 'Tài khoản đang bị khóa');
            }

            if ($user->otp != $dataSend['code']) {
                return apiResponse(4, 'Mã cấp lại mật khẩu không chính xác');
            }

            if ($dataSend['new_password'] != $dataSend['password_confirmation']) {
                return apiResponse(4, 'Mật khẩu nhập lại không chính xác');
            }

            $user->password = md5($dataSend['new_password']);
            $user->otp = null;
            $user->access_token = createTokenCode();
            $user->device_token = @$dataSend['device_token'];
            $modelUser->save($user);

            return apiResponse(1, 'Đổi mật khẩu thành công', $user);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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
                $user->last_login =time();
                $user->access_token = createTokenCode();
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->full_name = $dataSend['full_name'] ?? $user->full_name;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                // Kiểm tra user phone đã tồn tại chưa
                if (!empty($dataSend['phone'])) {
                    $checkPhone = $userModel->find()->where(['phone' => $dataSend['phone']])->first();

                    if (!empty($checkPhone)) {
                        $checkPhone->facebook_id = $dataSend['facebook_id'];
                        $checkPhone->avatar = $dataSend['avatar'] ?? $checkPhone->avatar;
                        $checkPhone->full_name = $dataSend['full_name'] ?? $checkPhone->full_name;
                        $checkPhone->email = $dataSend['email'] ?? $checkPhone->email;
                        $checkPhone->last_login =time();
                        $checkPhone->access_token = createTokenCode();
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
                        $checkEmail->full_name = $dataSend['full_name'] ?? $checkEmail->full_name;
                        $checkEmail->phone = $dataSend['phone'] ?? $checkEmail->phone;
                        $checkEmail->last_login =time();
                        $checkEmail->access_token = createTokenCode();
                        $userModel->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới

                if (!empty($dataSend['email']) || !empty($dataSend['phone'])) {
                    $newUser = $userModel->newEmptyEntity();
                    $newUser->full_name = $dataSend['full_name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone = $dataSend['phone'] ?? 'FB' . $dataSend['facebook_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 'active';
                    $newUser->created_at =time();
                    $newUser->updated_at =time();
                    $newUser->last_login =time();
                    $newUser->access_token = createTokenCode();
                    $newUser->device_token = $dataSend['device_token'] ?? null;
                    $userModel->save($newUser);

                    return apiResponse(1, 'Đăng nhập thành công', $newUser);
                }

                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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
                $user->last_login =time();
                $user->access_token = createTokenCode();
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
                        $checkPhone->last_login =time();
                        $checkPhone->access_token = createTokenCode();
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
                        $checkEmail->last_login =time();
                        $checkEmail->access_token = createTokenCode();
                        $checkEmail->device_token = $dataSend['device_token'] ?? $checkEmail->device_token;
                        $userModel->save($checkEmail);

                        return apiResponse(0, 'Đăng nhập thành công', $checkEmail);
                    }
                }

                // Tạo user mới
                if (!empty($dataSend['email']) || !empty($dataSend['phone'])) {
                    $newUser = $userModel->newEmptyEntity();
                    $newUser->full_name = $dataSend['full_name'] ?? 'Người dùng';
                    $newUser->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                    $newUser->phone = $dataSend['phone'] ?? 'GG' . $dataSend['google_id'];
                    $newUser->is_verified = 1;
                    $newUser->email = $dataSend['email'] ?? null;
                    $newUser->address = $dataSend['address'] ?? null;
                    $newUser->status = isset($dataSend['status']) ? (int) $dataSend['status'] : 'active';
                    $newUser->created_at =time();
                    $newUser->updated_at =time();
                    $newUser->last_login =time();
                    $newUser->access_token = createTokenCode();
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

                    return apiResponse(1, 'Đăng nhập thành công', $newUser);
                }

                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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
                $user->last_login = time();
                $user->access_token = createTokenCode();
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $user->avatar;
                $user->full_name = $dataSend['full_name'] ?? $user->full_name;
                $userModel->save($user);

                return apiResponse(0, 'Đăng nhập thành công', $user);
            } else {
                $user = $userModel->newEmptyEntity();
                $user->apple_id = $dataSend['apple_id'];
                $user->device_token = $dataSend['device_token'] ?? null;
                $user->avatar = $dataSend['avatar'] ?? $defaultAvatar;
                $user->last_login =time();
                $user->access_token = createTokenCode();
                $user->is_verified = 1;
                $userModel->save($user);

                return apiResponse(1, 'Đăng nhập thành công', $user);
            }
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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
        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        if (isset($dataSend['full_name'])) {
            $currentUser->full_name = $dataSend['full_name'];
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

        if (isset($dataSend['phone'])) {
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

       

        if (isset($dataSend['address'])) {
            $currentUser->address = $dataSend['address'];
        }


        if (!empty($dataSend['sex'])) {
            $currentUser->sex = $dataSend['sex'];
        }

      

        if (!empty($dataSend['birthday'])) {
		    $date = explode("/", $dataSend['birthday']);
	        $currentUser->birthday =  mktime(0, 0, 0, $date[1], $date[0], $date[2]);
		}

        if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
            $avatars = uploadImage($ $currentUser->phone, 'avatar', 'avatar_'.$ $currentUser->phone);
	        if(!empty($avatars['linkOnline'])){
	            $currentUser->avatar = $avatars['linkOnline'];
	        }
	    }

        $modelUser->save($currentUser);

      

        return apiResponse(1, 'Cập nhật thông tin thành công',$currentUser);
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
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

        $currentUser->deleted_at =time();
        $currentUser->access_token = null;
        $currentUser->status = 'delete';
        $modelUser->save($currentUser);

        return apiResponse(1, 'Xóa tài khoản thành công');
    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');
}
 ?>