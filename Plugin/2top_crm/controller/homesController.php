<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập tài khoản';

    $modelCustomer = $controller->loadModel('Customers');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	if(!empty($dataSend['email']) && !empty($dataSend['pass'])){
	    		$conditions = array('email'=>$dataSend['email'], 'pass'=>md5($dataSend['pass']),'status'=>'active');
	    		$info_customer = $modelCustomer->find()->where($conditions)->first();

	    		if(empty($info_customer )){
	    			$conditions = array('phone'=>$dataSend['email'], 'pass'=>md5($dataSend['pass']));
	    			$info_customer = $modelCustomer->find()->where($conditions)->first();
	    		}

	    		if($info_customer){
	    			$session->write('infoUser', $info_customer);
	    			
					return $controller->redirect('/');
	    		}else{
	    			$mess= '<p class="text-danger">Sai tài khoản hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

function register($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng ký tài khoản';



    $modelCustomer = $controller->loadModel('Customers');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){

	    	$dataSend = $input['request']->getData();

	    	if(	!empty($dataSend['full_name']) && 
	    		!empty($dataSend['phone']) &&
	    		!empty($dataSend['email']) &&
	    		!empty($dataSend['pass']) &&
	    		!empty($dataSend['passAgain']) 
	    	){
	    		if($dataSend['pass'] == $dataSend['passAgain']){
		    		$data = $modelCustomer->newEmptyEntity();

		    		$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
		        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		        	$conditions = array();
			        $conditions['email'] = $dataSend['email'];
			        $checkCustomer = $modelCustomer->find()->where($conditions)->first();

			        if(empty($checkCustomer)){
				        // tạo dữ liệu save
				        $data->full_name = $dataSend['full_name'];
				        $data->phone = $dataSend['phone'];

				        $data->email = $dataSend['email'];
				        $data->address = (!empty($dataSend['address']))?$dataSend['address']:'';
				        $data->sex = (int) @$dataSend['sex'];
				        $data->id_city = (int) @$dataSend['id_city'];
				        $data->id_messenger = (!empty($dataSend['id_messenger']))?$dataSend['id_messenger']:'';
				        $data->avatar = 'https://tayho360.vn/plugins/2top_crm/view/admin/img/user-placeholder.png';
				        $data->status = 'active';
				        $data->id_parent = (int) @$dataSend['id_parent'];
				        $data->id_level = (int) @$dataSend['id_level'];
				        $data->token = createToken(10);
				        $data->pass = md5($dataSend['pass']);

				        if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';
						$birthday_date = 0;
						$birthday_month = 0;
						$birthday_year = 0;

						$birthday = explode('/', trim($dataSend['birthday']));
						if(count($birthday)==3){
							$birthday_date = (int) $birthday[0];
							$birthday_month = (int) $birthday[1];
							$birthday_year = (int) $birthday[2];
						}

						$data->birthday_date = (int) @$birthday_date;
						$data->birthday_month = (int) @$birthday_month;
						$data->birthday_year = (int) @$birthday_year;

				        $modelCustomer->save($data);

			    		$conditions = array('phone'=>$dataSend['phone'], 'pass'=>md5($dataSend['pass']));
			    		$info_customer = $modelCustomer->find()->where($conditions)->first();

			    		if($info_customer){
			    			$session->write('infoUser', $info_customer);
			    			
							return $controller->redirect('/');
			    		}else{
			    			$mess= '<p class="text-danger">Đăng ký thất bại do lỗi hệ thống</p>';
			    		}
			    	}else{
			    		$mess= '<p class="text-danger">Email đã được đăng ký</p>';
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
	 $modelCustomer = $controller->loadModel('Customers');
    $infoUser  = $session->read('infoUser');

    if(empty($infoUser)){
    	return $controller->redirect('/');
    }
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

function editInfoUser($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'sửa tài khoản';

    $modelCustomer = $controller->loadModel('Customers');
    $infoUser  = $session->read('infoUser');

    if(!empty($infoUser)){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();

	    	
	    	
	    	if(!empty($_FILES["avatar"]["name"])){
                $avatar = '';
                $today= getdate();

                

                  if(isset($_FILES["avatar"]) && empty($_FILES["avatar"]["error"])){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["avatar"]["name"];
                $filetype = $_FILES["avatar"]["type"];
                $filesize = $_FILES["avatar"]["size"];
                
                // Verify file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if(!array_key_exists($ext, $allowed)) $mess= '<h3 class="color_red">File upload không đúng định dạng ảnh</h3>';
                
                // Verify file size - 1MB maximum
                $maxsize = 1024 * 1024;
                if($filesize > $maxsize) $mess= '<h3 class="color_red">File ảnh vượt quá giới hạn cho phép 1Mb</h3>';
                
                // Verify MYME type of the file
                if(in_array($filetype, $allowed)){
                    // Check whether file exists before uploading it
                    move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__.'/../../../webroot/upload/regcustomer/' . $today[0].'_avatar.jpg');
                    $avatar= 'https://tayho360.vn/webroot/upload/regcustomer/'.$today[0].'_avatar.jpg';
                    
                } else{
                    $mess= '<h3 class="color_red">Upload dữ liệu bị lỗi</h3>';
                }
            }
                $infoUser->avatar = $avatar;
            }
            $infoUser->full_name = $dataSend['full_name'];
            $infoUser->address = $dataSend['address'];
            //$infoUser->phone = $dataSend['phone'];
            $modelCustomer->save($infoUser);
            $session->write('infoUser', $infoUser);
			return $controller->redirect('/infoUser');
           
	    }

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

	$modelCustomer = $controller->loadModel('Customers');
	$mess = '';

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions['email'] = $dataSend['email'];
		$checkCustomer = $modelCustomer->find()->where($conditions)->first();

		if(!empty($checkCustomer)){
			@$pass = getdate()[0];
			$checkCustomer->token = $pass;
			
			$modelCustomer->save($checkCustomer);
			sendEmailNewPass($checkCustomer->email, $checkCustomer->full_name, $pass);
			$session->write('email', $checkCustomer->email);
			return $controller->redirect('/confirm');


		}else{
			$mess= '<p class="text-danger">Email không đúng!</p>';
		}
		
	}
	setVariable('mess', $mess);
}

function confirm($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$email = $session->read('email');

	$modelCustomer = $controller->loadModel('Customers');
	$mess = '';

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('email'=>@$email, 'token'=>$dataSend['code']);
	    		$data = $modelCustomer->find()->where($conditions)->first();
	    		if(!empty($data)){
	    				$session->destroy();

	    				$session->write('infoUser', $data);


	    				return $controller->redirect('/newpassword');
			    			
						
	    		}else{
	    			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
	    		}
	    
	}

	setVariable('mess', $mess);
}

function newpassword($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$infoUser = $session->read('infoUser');

	


	$modelCustomer = $controller->loadModel('Customers');
	$mess = '';
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('email'=>@$infoUser['email'], 'pass'=>$infoUser['pass']);
	    		$data = $modelCustomer->find()->where($conditions)->first();
	    		if(!empty($data)){
	    			if($dataSend['pass'] == $dataSend['passAgain']){
	    				$data->pass = md5($dataSend['pass']);

	    				$modelCustomer->save($data);
	    				$session->destroy();
			    			
						return $controller->redirect('/login');		

	    			}else{
	    				$mess= '<p class="text-danger">Mật khẩu xác nhập mới bạn không đúng</p>';
	    			}
	    		}else{
	    			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
	    		}
	    
	}
	setVariable('mess', $mess);

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