<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

    $metaTitleMantan = 'Đăng nhập tài khoản';

    $modelMembers = $controller->loadModel('Members');

    if(empty($session->read('infoUser'))){
    	$mess = '';

    	if(!empty($_GET['error'])){
    		switch ($_GET['error']) {
    			case 'account_lock':
    				$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
    				break;
    		}
    	}
    	
	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone'], 'pass'=>md5($dataSend['password']));
	    		$info_customer = $modelMembers->find()->where($conditions)->first();

	    		if(!empty($info_customer)){
    				// nếu tài khoản không bị khóa
    				if($info_customer->status == 'active'){
    					
						$info_customer->last_login = time();
						$modelMembers->save($info_customer);
						
    					$session->write('infoUser', $info_customer);
		    			
	    				setcookie('id_member',$info_customer->id,time()+365*24*60*60, "/");
						
						return $controller->redirect('/?statusLogin=loginAccount');
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}
	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }elseif(!empty($_COOKIE['id_member'])){
    		$conditions = array('id'=>(int) $_COOKIE['id_member']);
    		$info_customer = $modelMembers->find()->where($conditions)->first();

    		if(!empty($info_customer)){
				// nếu tài khoản không bị khóa
				if($info_customer->status == 'active'){
					$info_customer->last_login = time();
					$modelMembers->save($info_customer);
					
	    			$session->write('infoUser', $info_customer);
	    			
	    			return $controller->redirect('/?statusLogin=loginCookie');
				}else{
					$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
				}
    		}
    	}

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/?statusLogin=loginDone');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();
	setcookie('id_member','',time()+365*24*60*60, "/");

	return $controller->redirect('/login');
}

function changePass($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Đổi mật khẩu';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
				if($dataSend['passNew'] == $dataSend['passAgain']){
					$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);

						$modelMembers->save($user);

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
	global $modelCategories;
	global $urlHomes;
	global $displayInfo;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name'])){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($user->id, 'avatar', 'avatar_'.$user->id);
				}

				if(!empty($avatar['linkOnline'])){
					$user->avatar = $avatar['linkOnline'].'?time='.time();
				}else{
					if(empty($user->avatar)){
						$user->avatar = $urlHomes.'/plugins/vemoi/view/home/assets/img/avatar-default-crm.png';
					}
				}

				$user->name = $dataSend['name'];
				$user->email = $dataSend['email'];
				$user->address = $dataSend['address'];
				$user->facebook = $dataSend['facebook'];

				$modelMembers->save($user);

				$session->write('infoUser', $user);

				$mess= '<p class="text-success">Đổi thông tin thành công</p>';
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		
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

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions['phone'] = $dataSend['phone'];
		$checkMember = $modelMembers->find()->where($conditions)->first();

		if(!empty($checkMember)){
			$checkMember->otp = rand(1000,9999);
			
			$modelMembers->save($checkMember);
			sendEmailnewpassword($checkMember->email, $checkMember->name, $checkMember->otp);
			
			$session->write('phone', $checkMember->phone);
			
			return $controller->redirect('/confirm');


		}else{
			$mess= '<p class="text-danger">Số điện thoại không đúng!</p>';
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

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'otp'=>(int)$dataSend['code']);
		$data = $modelMembers->find()->where($conditions)->first();
		if(!empty($data)){
			if($dataSend['pass'] == $dataSend['passAgain']){
				$data->pass = md5($dataSend['pass']);

				$modelMembers->save($data);
				$session->destroy();
	    			
				return $controller->redirect('/login');		

			}else{
				$mess= '<p class="text-danger">Mật khẩu xác nhận của bạn không đúng</p>';
			}
		}else{
			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
		}

	    setVariable('mess', $mess);
	}

}

function register($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');
	$mess = '';

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){

			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					// tạo người dùng mới
					$data = $modelMember->newEmptyEntity();

					$data->name = $dataSend['name'];
					$data->phone = $dataSend['phone'];
					$data->email = $dataSend['email'];
					$data->pass = md5($dataSend['password']);
					$data->status = 'active';
					$data->avatar = 'https://ai.phoenixtech.vn/plugins/phoenix_ai/view/home/assets/img/avatar-default-crm.png';
					$data->created_at = time();
					$data->last_login = time();
					$data->address = '';

					$modelMember->save($data);

					// thực hiện đăng nhập luôn
					$session->write('infoUser', $data);
	    			
    				setcookie('id_member',$data->id,time()+365*24*60*60, "/");
					
					return $controller->redirect('/');
					

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

?>
