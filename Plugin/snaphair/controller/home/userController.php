<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập tài khoản';

    $modelUser = $controller->loadModel('Users');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']),'status'=>'active');
	    		$info_customer = $modelUser->find()->where($conditions)->first();

	    		if(!empty($info_customer)){
	    			$session->write('infoUser', $info_customer);
	    			
					return $controller->redirect('/dashboard');
	    		}else{
	    			$mess= '<p class="text-danger">Sai tài khoản hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/dashboard');
	}
}

function register($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $urlHomes;
	global $session;

    $metaTitleMantan = 'Đăng ký tài khoản';
    $modelUser = $controller->loadModel('Users');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){

	    	$dataSend = $input['request']->getData();

	    	if (isset($dataSend['full_name'])
            && isset($dataSend['phone'])
            && isset($dataSend['password'])
            && isset($dataSend['password_confirmation'])
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
                $session->write('infoUser', $loginUser);
                return $controller->redirect('/dashboard');
            }
            $mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
        }else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();

	return $controller->redirect('/');
}
function infoUser(){
	global $session;
	global $controller;
	$modelUser = $controller->loadModel('Users');
    $infoUser  = $session->read('infoUser');
    $infoUser = $modelUser->find()->where(['id'=>$infoUser->id])->first();

    setVariable('infoUser', $infoUser);
}

function changepassword($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Sửa mật khẩu';

    $modelCustomer = $controller->loadModel('Customers');
    $infoUser  = $session->read('infoUser');

    if(!empty($infoUser)){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    		$conditions = array('email'=>$infoUser['email'], 'pass'=>md5($dataSend['oldpass']));
	    		$data = $modelCustomer->find()->where($conditions)->first();
	    		if(!empty($data)){
	    			if($dataSend['pass'] == $dataSend['passAgain']){
	    				$data->pass = md5($dataSend['pass']);

	    				$modelCustomer->save($data);

			    		$conditions = array('email'=>$infoUser['email'], 'pass'=>md5($dataSend['passAgain']));
			    		$info_customer = $modelCustomer->find()->where($conditions)->first();
			    		$session->write('infoUser', $info_customer);
			    			
						return $controller->redirect('/infoUser');		

	    			}else{
	    				$mess= '<p class="text-danger">Mật khẩu xác nhập mới bạn không đúng</p>';
	    			}
	    		}else{
	    			$mess= '<p class="text-danger">Xác nhận lại mật khẩu bạn không đúng</p>';
	    		}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}

}

function account($input){

	global $metaTitleMantan;
	global $metaTitleMantan;
	global $urlHomes;
	global $controller;
	global $session;
	global $isRequestPost;

    $metaTitleMantan = 'sửa tài khoản';

    $modelUser = $controller->loadModel('Users');
    $infoUser  = $session->read('infoUser');

    if(!empty($infoUser)){
    	$mess = '';
    	 $infoUser = $modelUser->find()->where(['id'=>$infoUser->id])->first();
	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    
	    	if(!empty($_FILES["avatar"]["name"])){
                $avatar = '';
                $today= getdate();
                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                $avatars = uploadImage($infoUser->phone, 'avatar', 'avatar_'.$infoUser->phone);
	            }
	            if(!empty($avatars['linkOnline'])){
	                $avatar = $avatars['linkOnline'];
	            }else{
	                $avatar = $urlHomes."/plugins/snaphair/view/image/default-avatar.png";
	            }
                $infoUser->avatar = $avatar;

            }
            $infoUser->full_name = $dataSend['full_name'];
            $infoUser->address = $dataSend['address'];
            $infoUser->sex = $dataSend['sex'];
            $infoUser->email = $dataSend['email'];
            //$infoUser->phone = $dataSend['phone'];
            $modelUser->save($infoUser);
            $session->write('infoUser', $infoUser);
			// return $controller->redirect('/infoUser');
           
	    }

	    setVariable('infoUser', $infoUser);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}

}

function forgotpassword($input){
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$modelUser = $controller->loadModel('Users');
	$metaTitleMantan = 'Quên mật khẩu';

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions['phone'] = $dataSend['phone'];
		$user = $modelUser->find()->where($conditions)->first();
		if(!empty($user)){
			 $code = rand(100000, 999999);
            $user->otp = $code;
            $modelUser->save($user);
            sendEmailCodeForgotPassword($user->email, $user->full_name, $code);
            $session->write('phone', $user->phone);
			return $controller->redirect('/confirm');
		}else{
			$mess= '<p class="text-danger">Số điện thoại không đúng!</p>';
		}
		setVariable('mess', $mess);
	}

}

function confirm($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$phone = $session->read('phone');
	$modelUser = $controller->loadModel('Users');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'otp'=>$dataSend['c']);
	    		$data = $modelUser->find()->where($conditions)->first();
	    		if(!empty($data)){
	    				return $controller->redirect('/newpassword');
			    			
						
	    		}else{
	    			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
	    		}
	    setVariable('mess', $mess);
	}


}

function newpassword($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$phone = $session->read('phone');
	$modelUser = $controller->loadModel('Users');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone,);
	    		$data = $modelUser->find()->where($conditions)->first();
	    		if(!empty($data)){
	    			if($dataSend['password'] == $dataSend['password_confirmation']){
	    				$data->password = md5($dataSend['password']);
	    				$data->otp = null;
	    				$modelUser->save($data);
	    				$session->destroy();
			    			
						return $controller->redirect('/login');		

	    			}else{
	    				$mess= '<p class="text-danger">Mật khẩu xác nhập mới bạn không đúng</p>';
	    			}
	    		}else{
	    			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
	    		}
	    setVariable('mess', $mess);
	}

}

function confirmAPI($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$modelCustomer = $controller->loadModel('Customers');
	$dataSend = $input['request']->getData();
	$conditions = array();
	$conditions = array('email'=>@$dataSend['email'], 'pass'=>md5($dataSend['code']));
	$data = $modelCustomer->find()->where($conditions)->first();
	if(!empty($data)){
	    $return = array('code'=>1,
				'infoUser'=> $data,
				'messages'=>'Đăng ký thành công',
			);
						
	}else{
	    $return = array('code'=>2,
				'messages'=>'Your verification code is incorrect!',
			);

	}
	return $return;
}

function newpasswordAPI($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$infoUser = $session->read('infoUser');

	


	$modelCustomer = $controller->loadModel('Customers');

	
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('email'=>@$dataSend['email'], 'pass'=>$dataSend['code']);
	    		$data = $modelCustomer->find()->where($conditions)->first();
	    		if(!empty($data)){
	    			if($dataSend['pass'] == $dataSend['passAgain']){
	    				$data->pass = md5($dataSend['pass']);

	    				$modelCustomer->save($data);
	    				$session->destroy();
	
						 $return = array('code'=>1,
							'infoUser'=> $data,
							'messages'=>'Đăng ký thành công',
						);

	    			}else{
	    				 $return = array('code'=>2,
				'messages'=>'Your new login password is incorrect',
						);
	    			}
	    		}else{
	    			 $return = array('code'=>2,
				'messages'=>'Your verification code is incorrect!',
						);
	    		}
	  	return $return;
	

}

 ?>