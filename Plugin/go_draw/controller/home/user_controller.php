<?php 
function register($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelUsers = $controller->loadModel('Users');
	
	$mess = '';
	
	if($isRequestPost && empty($session->read('infoMember'))){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		$avatar= 'https://godraw.vn/plugins/go_draw/view/agency/images/avatar-default.png';

		if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again']) && !empty($dataSend['email'])){
			
			$checkPhone = $modelUsers->find()->where(array('username'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					// tạo người dùng mới
					$data = $modelUsers->newEmptyEntity();

					$data->username = $dataSend['phone'];
					$data->name = $dataSend['name'];
					$data->password = md5($dataSend['password']);
					$data->email = @$dataSend['email'];
					$data->phone = $dataSend['phone'];
					$data->avatar = $avatar;
					$data->total_coin = 0;
					$data->status = 1;
					$data->created_at = date('Y-m-d H:i:s');
					$data->updated_at = date('Y-m-d H:i:s');

					$modelUsers->save($data);

					$session->write('infoMember', $data);

					return $controller->redirect('/?status=registerDone');
					
				}else{
					$mess = '<p class="text-danger">Mật khẩu nhập lại không đúng</p>';		

					return $controller->redirect('/?status=errorPassAgain');
				}
			}else{
				$mess = '<p class="text-danger">Số điện thoại đã tồn tại</p>';

				return $controller->redirect('/?status=errorPhoneExits');
			}
		}else{
			$mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';

			return $controller->redirect('/?status=errorEmptyData');
		}
	}
	
	setVariable('mess', $mess);

	return $controller->redirect('/');
}

function logoutUser($input)
{	
	global $session;
	global $controller;

	$session->destroy();

	return $controller->redirect('/');
}

function loginUser($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập Godraw';

    $modelUsers = $controller->loadModel('Users');

    if(empty($session->read('infoMember'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['username']) && !empty($dataSend['password'])){

	    		$conditions = array('username'=>$dataSend['username'], 'password'=>md5($dataSend['password']));
	    		
	    		$info_customer = $modelUsers->find()->where($conditions)->first();

	    		if($info_customer){

    				// nếu tài khoản không bị khóa
    				if($info_customer->status == 1){
    					
		    			$session->write('infoMember', $info_customer);
		    			
						return $controller->redirect('/');
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';

						return $controller->redirect('/?status=errorUserLock');
					}
	    		}else{
	    			$mess= '<p class="text-danger">Sai tài khoản hoặc mật khẩu</p>';

	    			return $controller->redirect('/?status=errorUserOrPass');
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';

	    		return $controller->redirect('/?status=errorEmptyData');
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

?>