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