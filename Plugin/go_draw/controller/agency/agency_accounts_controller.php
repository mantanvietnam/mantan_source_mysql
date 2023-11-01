<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập Godraw';

    $modelAgencyAccounts = $controller->loadModel('AgencyAccounts');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['name']) && !empty($dataSend['password'])){

	    		$conditions = array('name'=>$dataSend['name'], 'password'=>md5($dataSend['password']));
	    		$info_customer = $modelAgencyAccounts->find()->where($conditions)->first();

	    		if($info_customer){

    				// nếu tài khoản không bị khóa
    				if($info_customer->status == 'active'){
    					// lưu lịch sử đăng nhập
		    			$info_customer->last_login = date('Y-m-d H:i:s');

		    			$modelAgencyAccounts->save($info_customer);

		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');

		    			$session->write('infoUser', $info_customer);
		    			
						return $controller->redirect('/sellProduct');
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}
	    		}else{
	    			$mess= '<p class="text-danger">Sai tài khoản hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/sellProduct');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();

	return $controller->redirect('/login');
}

function changePass($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Đổi mật khẩu';

	$modelAgencyAccounts = $controller->loadModel('AgencyAccounts');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
				if($dataSend['passNew'] == $dataSend['passAgain']){
					$user = $modelAgencyAccounts->get($session->read('infoUser')->id);

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);

						$modelAgencyAccounts->save($user);

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