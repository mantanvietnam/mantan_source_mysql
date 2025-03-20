<?php 
function affiliaterLogin($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

    $metaTitleMantan = 'Đăng nhập phần mềm quản lý đại lý';

    $modelMembers = $controller->loadModel('Members');
    $modelAffiliaters = $controller->loadModel('Affiliaters');

    if(empty($session->read('infoAff'))){
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

	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
	    		$info_aff = $modelAffiliaters->find()->where($conditions)->first();

	    		if(!empty($info_aff)){
	    			if($info_aff->status == 'active'){
	    				$members = $modelMembers->find()->where(array('id'=>$info_aff->id_member))->first();
    					if($members->deadline > time()){
    						$info_aff->last_login = time();
							$modelAffiliaters->save($info_aff);
			    			$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$members->id.'/');

			    			$session->write('infoAff', $info_aff);
			    			

			    				setcookie('id_aff',$info_aff->id,time()+365*24*60*60, "/");
								
								return $controller->redirect('/listOrderAffiliater/?statusLogin=loginAccount');
							
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}

	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }elseif(!empty($_COOKIE['id_aff'])){
    		$conditions = array('id'=>(int) $_COOKIE['id_aff'], 'status'=>'active');
    		$info_aff = $modelAffiliaters->find()->where($conditions)->first();

    		if(!empty($info_aff)){
    			$members = $modelMembers->find()->where(array('id'=>$info_aff->id_member))->first();
    			if($members->deadline > time()){
					// nếu tài khoản không bị khóa
					if($members->status == 'active'){
						if($members->deadline > time()){
							$info_aff->last_login = time();
							$modelStaff->save($info_aff);
							$session->write('CheckAuthentication', true);
			                $session->write('urlBaseUpload', '/upload/admin/images/'.$members->id.'/');

				    		$session->write('infoAff', $info_aff);
				    			
				    		setcookie('id_aff',$info_aff->id,time()+365*24*60*60, "/");
									
							return $controller->redirect('/listOrderAffiliater/?statusLogin=loginAccount');
						
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}
				}
    		}
    	}


	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/listOrderAffiliater/?statusLogin=loginDone');
	}
}

function affiliaterLogout($input)
{	
	global $session;
	global $controller;

	$session->destroy();
	setcookie('id_member','',time()+365*24*60*60, "/");
	setcookie('id_staff','',time()+365*24*60*60, "/");
	setcookie('id_aff','',time()+365*24*60*60, "/");

	return $controller->redirect('/affiliaterLogin');
}
 ?>