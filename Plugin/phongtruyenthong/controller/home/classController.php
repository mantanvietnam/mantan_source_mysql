<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

    $metaTitleMantan = 'Đăng nhập phòng truyền thống ảo';

    $modelClasses = $controller->loadModel('Classes');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('user'=>$dataSend['phone'], 'pass'=>$dataSend['password']);
	    		$info_customer = $modelClasses->find()->where($conditions)->first();

	    		if($info_customer){
	    			$infoCategory = $modelCategories->find()->where(['id'=>(int) $info_customer->id_year])->first();

	    			if(!empty($infoCategory)){
	    				$year = createSlugMantan($infoCategory->name);
	    				$class = createSlugMantan($info_customer->name);

	    				if (!file_exists(__DIR__.'/../../../../upload/admin/images/'.$year.'/'.$class )) {
					        mkdir(__DIR__.'/../../../../upload/admin/images/'.$year.'/'.$class, 0755, true);
					    }

		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$year.'/'.$class.'/');

		    			$session->write('infoUser', $info_customer);
		    			
						return $controller->redirect('/infoClass');
					}else{
						$mess= '<p class="text-danger">Tài khoản chưa được gắn với niên khóa</p>';
					}
	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/infoClass');
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

	$modelClasses = $controller->loadModel('Classes');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
				if($dataSend['passNew'] == $dataSend['passAgain']){
					$user = $modelClasses->get($session->read('infoUser')->id);

					if($user->pass == $dataSend['passOld']){
						$user->pass = $dataSend['passNew'];

						$modelClasses->save($user);

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

function infoClass($input)
{
	global $session;
	global $controller;
	global $isRequestPost;
	global $urlHomes;
	global $modelCategories;

	$modelClasses = $controller->loadModel('Classes');

	if(!empty($session->read('infoUser'))){
		$infoClass = $modelClasses->get($session->read('infoUser')->id);
		$mess = '';

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

            if(empty($dataSend['image'])) $dataSend['image'] = $urlHomes.'/plugins/phongtruyenthong/view/home/assets/img/default-thumbnail.jpg';

            if(!empty($dataSend['des_image'])){
                foreach ($dataSend['des_image'] as $key => $value) {
                    if(!empty($dataSend['des_image'][$key])){
                        $dataSend['des_image'][$key] = str_replace(array('"', "'"), '’', $dataSend['des_image'][$key]);
                    }
                }
            }

	        // tạo dữ liệu save
	        $infoClass->info = $dataSend['info'];
	        $infoClass->image = $dataSend['image'];
            $infoClass->images = json_encode(@$dataSend['images']);
            $infoClass->des_image = json_encode(@$dataSend['des_image']);
            $infoClass->audio_image = json_encode(@$dataSend['audio_image']);
            $infoClass->video = $dataSend['video'];

	        $modelClasses->save($infoClass);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    
	    }

	    $infoClass->images = json_decode($infoClass->images, true);
        $infoClass->des_image = json_decode($infoClass->des_image, true);
        $infoClass->audio_image = json_decode($infoClass->audio_image, true);

        $conditions = array('type' => 'school_year');
    	$years = $modelCategories->find()->where($conditions)->all()->toList();

		setVariable('infoClass', $infoClass);
		setVariable('mess', $mess);
		setVariable('years', $years);
	}else{
		return $controller->redirect('/login');
	}
}