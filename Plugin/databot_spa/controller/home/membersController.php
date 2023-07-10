<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập công cụ phầm mềm quản lý SPA';

    $modelMembers = $controller->loadModel('Members');

    if(empty($session->read('infoUser'))){
    	$mess = '';

    	if(!empty($_GET['error'])){
    		switch ($_GET['error']) {
    			case 'account_lock':
    				$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
    				break;
    			
    			case 'account_not_designer':
    				$mess= '<p class="text-danger">Bạn chưa đăng ký để trở thành Designer</p>';
    				break;
    		}
    	}

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
	    		$info_customer = $modelMembers->find()->where($conditions)->first();

	    		if($info_customer){
	    			// hiến hạn sử dụng
	    			if($info_customer->dateline_at >= date('Y-m-d H:i:s')){

	    				// nếu tài khoản không bị khóa
	    				if($info_customer->status == 1){

	    				

			    			$info_customer->last_login = date('Y-m-d H:i:s');

			    			$modelMembers->save($info_customer);

			    			$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');

			    			$session->write('infoUser', $info_customer);
			    			
							return $controller->redirect('/managerSelectSpa');
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
						}
					}else{
						$mess= '<p class="text-danger">ài khoản của bạn đã hết hạn</p>';
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
		return $controller->redirect('/managerSelectSpa');
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

	// $modelProduct = $controller->loadModel('Products');
	// $modelOrder = $controller->loadModel('Orders');

	if(!empty($session->read('infoUser'))){
		$conditions = array('user_id'=>$session->read('infoUser')->id, 'type'=>'user_create', 'status'=>2);
		$limit = 5;
		$page = 1;

		
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

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
				if($dataSend['passNew'] == $dataSend['passAgain']){
					$user = $modelMembers->get($session->read('infoUser')->id);

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);
						$user->token = createToken(25);

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

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->get($session->read('infoUser')->id);

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['avatar']) && !empty($dataSend['email'])){
				$user->name = $dataSend['name'];
				$user->avatar = $dataSend['avatar'];
				$user->email = $dataSend['email'];

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
			@$pass = getdate()[0];
			$checkMember->password = md5($pass);
			
			$modelMembers->save($checkMember);
			sendEmailnewpassword($checkMember->email, $checkMember->name, $pass);
			$session->write('phone', $checkMember->phone);
			
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

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'password'=>md5($dataSend['code']));
	    		$data = $modelMembers->find()->where($conditions)->first();
	    		if(!empty($data)){
	    				if($dataSend['pass'] == $dataSend['passAgain']){
	    				$data->password = md5($dataSend['pass']);

	    				$modelMembers->save($data);
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


function register($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$mess = '';
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(empty($mess) && !empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					// tạo người dùng mới
					$data = $modelMember->newEmptyEntity();

					$data->name = $dataSend['name'];
					$data->phone = $dataSend['phone'];
					$data->email = @$dataSend['email'];
					$data->number_spa = 1;
					$data->password = md5($dataSend['password']);
					$data->status = 1; //1: kích hoạt, 0: khóa
					$data->type = 1; // 0: nhân viên, 1: Member
					$data->created_at = date('Y-m-d H:i:s');
					$data->last_login = date('Y-m-d H:i:s');
					$data->dateline_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). '30 days'));

					$modelMember->save($data);

					$checkMember = $modelMember->find()->where(array('phone'=>$data->phone))->first();
					if(!empty($checkMember)){

						$dataSpa = $modelSpas->newEmptyEntity();
						$dataSpa->name = $dataSend['name_spa'];
						$dataSpa->phone = $dataSend['phone'];
						$dataSpa->email = @$dataSend['email'];
						$dataSpa->id_member = $checkMember->id;
						$dataSpa->address = @$dataSend['address'];
						$dataSpa->slug = createSlugMantan($dataSpa->name);
						$dataSpa->created_at = date('Y-m-d H:i:s');
						$dataSpa->updated_at = date('Y-m-d H:i:s');

						$modelSpas->save($dataSpa);

				    	$mess = '<p class="text-success">Yêu cầu đăng ký  phần mền quản lý SPA thành công</p>';
			    	}else{
			    		$mess = '<p class="text-success">không tạo được cơ sở</p>';
			    	}
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

// Lua chon spa
function managerSelectSpa() {
	global $controller;
    global $isRequestPost;
    global $urlHomes;
    global $session;
    global $urlHomeManager;
    setVariable('permission', 'managerSelectHotel');
    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$infoUser = $session->read('infoUser');

	if(!empty($infoUser)){
	    $mess= '';
	    if(!empty($_GET['status'])){
	        switch($_GET['status']){
	            case 'deleteHotelDone': $mess= '<p class="color_green">Xóa Spa thành công</p>';break;
	            case 'addHotelDone': $mess= '<p class="color_green">Thêm mới Spa thành công</p>';break;
	            case 'deleteHotelFail': $mess= '<p class="color_red">Xóa Spa thất bại</p>';break;
	            case 'selectHotelFail': $mess= '<p class="color_red">Không tồn tại thông tin Spa này</p>';break;
	        }
	    }
	    
	    $dataList = $modelSpas->find()->where(array('id_member'=>$infoUser->id))->all()->toList();


	    if ($isRequestPost) {
	        if (!empty($_POST['idspa'])) {
	            $hotel= $modelSpas->get($_POST['idspa']);
	            if(!empty($hotel)){
	                $session->write('idspa', $_POST['idspa']);
	                return $controller->redirect('/dashboard');
	            }
	        }
	    } 

	    setVariable('mess', $mess);
	    setVariable('dataList', $dataList);
	}else{
		return $controller->redirect('/login');
	}
}

 ?>