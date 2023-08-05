<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập Zoom Cheap';

    $modelManagers = $controller->loadModel('Managers');

    if(empty($session->read('infoUser'))){
    	$mess = '';

    	/*
    	if(!empty($_GET['error'])){
    		switch ($_GET['error']) {
    			case 'empty':
    				$mess= '<p class="text-danger">Sai mật khẩu hoặc tài khoản đăng nhập</p>';
    				break;
    		}
    	}
    	*/

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
	    		$info_customer = $modelManagers->find()->where($conditions)->first();

	    		if($info_customer){
	    			$info_customer->lastLogin = time();

	    			$modelManagers->save($info_customer);

	    			$session->write('infoUser', $info_customer);
	    			
					return $controller->redirect('/dashboard');
	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
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

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();

	return $controller->redirect('/login');
}

function dashboard($input)
{	
	global $session;
	global $controller;
	global $metaTitleMantan;

	$metaTitleMantan = 'Thống kê tài khoản';

	$modelOrders = $controller->loadModel('Orders');
	$modelHistories = $controller->loadModel('Histories');

	if(!empty($session->read('infoUser'))){
		$listHistories = $modelHistories->find()->where(['idManager'=>$session->read('infoUser')->id, 'type'=>'plus'])->all()->toList();
		$allMoneyPlus = 0;
		if(!empty($listHistories)){
			foreach ($listHistories as $key => $value) {
				$allMoneyPlus += $value->numberCoin;
			}
		}

		setVariable('allMoneyPlus', $allMoneyPlus);
	}else{
		return $controller->redirect('/login');
	}
}

function changePass($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Đổi mật khẩu';

	$modelManagers = $controller->loadModel('Managers');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
				if($dataSend['passNew'] == $dataSend['passAgain']){
					$user = $modelManagers->get($session->read('infoUser')->id);

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);

						$modelManagers->save($user);

						$session->write('infoUser', $user);

						$mess= '<p class="text-success">Đổi mật khẩu thành công</p>';
					}else{
						$mess= '<p class="text-danger">Sai mật khẩu cũ</p>';
					}
				}else{
					$mess= '<p class="text-danger">Mật khẩu nhập lại chưa đúng</p>';
				}
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function account($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelManagers = $controller->loadModel('Managers');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelManagers->get($session->read('infoUser')->id);

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['fullname']) && !empty($dataSend['email'])){
				$user->fullname = $dataSend['fullname'];
				$user->email = $dataSend['email'];

				$modelManagers->save($user);

				$mess= '<p class="text-success">Đổi thông tin thành công</p>';
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		$session->write('infoUser', $user);

		setVariable('mess', $mess);
		setVariable('user', $user);
	}else{
		return $controller->redirect('/login');
	}
}

function forgotPass($input){
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$metaTitleMantan = 'Số điện thoại xác thực';

	$modelManagers = $controller->loadModel('Managers');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['phone'])){
			$conditions = array();

			$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
			$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

			$conditions['phone'] = $dataSend['phone'];
			$checkMember = $modelManagers->find()->where($conditions)->first();

			if(!empty($checkMember)){
				$checkMember->otp = rand(100000,999999);
				
				$modelManagers->save($checkMember);
				sendEmailnewpassword($checkMember->email, $checkMember->name, $checkMember->otp);
				$session->write('phone', $checkMember->phone);
				
				return $controller->redirect('/confirm');
			}else{
				$mess= '<p class="text-danger">Số điện thoại không đúng!</p>';
			}
		}else{
			$mess= '<p class="text-danger">Gửi thiếu số điện thoại</p>';
		}
		setVariable('mess', $mess);
	}
}

function confirm($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$phone = $session->read('phone');

	$modelManagers = $controller->loadModel('Managers');

	if(!empty($phone)){
		if($isRequestPost){
			$dataSend = $input['request']->getData();

			$mess = '';

			if(!empty($dataSend['code'])){
				$conditions = array();
				$conditions = array('phone'=>$phone, 'otp'=>$dataSend['code']);
			    		
				$data = $modelManagers->find()->where($conditions)->first();
				
				if(!empty($data)){
					if($dataSend['pass'] == $dataSend['passAgain']){
						$data->password = md5($dataSend['pass']);
						$data->otp = 0;

						$modelManagers->save($data);
						$session->destroy();
			    			
						return $controller->redirect('/login');		

					}else{
						$mess= '<p class="text-danger">Mật khẩu xác nhập mới bạn không đúng</p>';
					}
				}else{
					$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
				}
			}else{
			    $mess= '<p class="text-danger">Bạn chưa nhập mã xác thực</p>';
			}

			setVariable('mess', $mess);
		}
	}else{
		return $controller->redirect('/login');
	}

}


function register($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $metaTitleMantan;

	$metaTitleMantan = 'Đăng ký Zoom Cheap';


	$modelManagers = $controller->loadModel('Managers');
	$mess = '';
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		$avatar= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';


		if(!empty($dataSend['fullname']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){
			$checkPhone = $modelManagers->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					// tạo người dùng mới
					$data = $modelManagers->newEmptyEntity();

					$data->fullname = $dataSend['fullname'];
					$data->phone = $dataSend['phone'];
					$data->email = @$dataSend['email'];
					$data->password = md5($dataSend['password']);
					$data->coin = 0;
					$data->modified = time();
					$data->created = time();
					$data->lastLogin = time();
					$data->avatar = $avatar;

					$modelManagers->save($data);

					$session->write('infoUser', $data);

					return $controller->redirect('/dashboard');	
					
				}else{
					$mess = '<p class="text-danger">Mật khẩu nhập lại không đúng</p>';		
				}
			}else{
				$mess = '<p class="text-danger">Số điện thoại đã tồn tại</p>';
			}
		}else{
			$mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
		}
	}
	
	setVariable('mess', $mess);

}

function ggCallback($input)
{
    global $google_clientId;
    global $google_clientSecret;
    global $google_redirectURL;
    global $controller;
    global $session;

	$modelMembers = $controller->loadModel('Members');

  	$client = new Google_Client();
  	$client->setClientId($google_clientId);
  	$client->setClientSecret($google_clientSecret);
  	$client->setRedirectUri($google_redirectURL);
  	$client->addScope('email');
  	$client->setApplicationName('Đăng nhập Ezpics');
  	$client->setApprovalPrompt('force');
    
    if(isset($_GET['code'])) {
       	try {
       		$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    		
    		if (!isset($token['access_token'])) {
				die('Failed to retrieve access token');
			}

			$client->setAccessToken($token['access_token']);
			$google_oauth = new Google_Service_Oauth2($client);
			$google_account_info = $google_oauth->userinfo->get();

			$email = $google_account_info->email;

            if(!empty($email)){
            	$conditions = array('id_google'=>$google_account_info->id);
	    		$checkUser = $modelMembers->find()->where($conditions)->first();

	    		// nếu chưa có tài khoản liên kết với GG thì tìm lại theo email
	    		if(empty($checkUser)){
	    			$conditions = array('email'=>$google_account_info->email);
	    			$checkUser = $modelMembers->find()->where($conditions)->first();

	    			if(!empty($checkUser)){
	    				$checkUser->id_google = $google_account_info->id;

	    				$modelMembers->save($checkUser);
	    			}
	    		}

	    		// nếu tìm theo email vẫn chưa có thì tạo mới
	    		if(empty($checkUser)){
	    			$checkUser = $modelMembers->newEmptyEntity();

					$checkUser->name = $google_account_info->name;
					$checkUser->avatar = $google_account_info->picture;
					$checkUser->phone = 'GG'.$google_account_info->id;
					$checkUser->aff = $checkUser->phone;
					$checkUser->affsource = '';
					$checkUser->email = $google_account_info->email;
					$checkUser->password = '';
					$checkUser->account_balance = 10000; // tặng 10k cho tài khoản mới
					$checkUser->status = 1; //1: kích hoạt, 0: khóa
					$checkUser->type = 0; // 0: người dùng, 1: designer
					$checkUser->token = createToken(25);
					$checkUser->created_at = date('Y-m-d H:i:s');
					$checkUser->last_login = date('Y-m-d H:i:s');
					$checkUser->token_device = '';
					$checkUser->id_google = $google_account_info->id;

					$modelMembers->save($checkUser);
	    		}

	    		// nếu là desiger
    			if($checkUser->type == 1){

    				// nếu tài khoản không bị khóa
    				if($checkUser->status == 1){

    					// nếu chưa có token
		    			if(empty($checkUser->token)){
		    				$checkUser->token = createToken(25);
		    			}

		    			$checkUser->last_login = date('Y-m-d H:i:s');

		    			$modelMembers->save($checkUser);

		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$checkUser->id.'/');

		    			$session->write('infoUser', $checkUser);
		    			
						return $controller->redirect('/dashboard');
					}else{
						return $controller->redirect('/login/?error=account_lock');
					}
				}else{
					return $controller->redirect('/login/?error=account_not_designer');
				}
            }
        }
        catch(Exception $e) {
        	echo $e->getMessage();
            exit();
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>