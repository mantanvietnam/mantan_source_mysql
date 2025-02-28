<?php 
function createMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$mess = '';
	$return = ['code'=>0, 'mess'=>''];
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
		if(!empty($dataSend['password'])){
			if($dataSend['password']!=$dataSend['password_again']){
				return apiResponse(4,'Mật khẩu nhập lại không dúng');
			}
		}else{
			$dataSend['password'] = $dataSend['phone'];	
		}
		

		if(!empty($dataSend['name_spa']) && !empty($dataSend['phone'])){
			
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				// tạo người dùng mới
				$data = $modelMember->newEmptyEntity();

				$data->name = $dataSend['name_spa'].' (chủ)';
				$data->avatar = 'https://phanmem.quanlyspa.pro/plugins/databot_spa/view/home/assets/img/avatar-default.png';
				$data->phone = $dataSend['phone'];
				$data->email = @$dataSend['email'];
				$data->password = md5($dataSend['password']);
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 1; // 0: nhân viên, 1: chủ spa
				$data->id_member = 0;
				$data->created_at = time();
				$data->updated_at = time();
				$data->last_login = time();
				$data->dateline_at =  strtotime(date('Y-m-d H:i:s'). '30 days');
				$data->number_spa = 1;
				$data->address = $dataSend['address'];
				$data->code_otp = rand(100000, 999999);
				$data->module = '["customer","staff","calendar","campain","zalo","sms","room","product","prepaid_cards","combo","bill","static"]';

				$modelMember->save($data);

				// tạo cơ sở spa mới
				$dataSpa = $modelSpas->newEmptyEntity();

				$dataSpa->name = $dataSend['name_spa'];
				$dataSpa->phone = $dataSend['phone'];
				$dataSpa->email = @$dataSend['email'];
				$dataSpa->id_member = $data->id;
				$dataSpa->address = @$dataSend['address'];
				$dataSpa->slug = createSlugMantan($dataSpa->name).'-'.time();
				$dataSpa->created_at = time();
				$dataSpa->updated_at = time();
				$dataSpa->image = $urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.jpg';
				$dataSpa->facebook = '';
				$dataSpa->website = '';
				$dataSpa->zalo = $dataSend['phone'];

				$modelSpas->save($dataSpa);

				// tạo kho mới
				$dataWarehouse = $modelWarehouse->newEmptyEntity();
				
				$dataWarehouse->name = $dataSpa->address;
				$dataWarehouse->credit = 1;
				$dataWarehouse->id_member = $data->id;
				$dataWarehouse->id_spa = $dataSpa->id;
				$dataWarehouse->created_at = time();
				
				$modelWarehouse->save($dataWarehouse);

				// gửi email thông báo tài khoản
				if(!empty($data->email)){
					sendEmailRegAcc($data->email, $data->name, $data->phone, $dataSend['phone']);
				}
				

					return apiResponse(1,'Đăng ký phần mền quản lý SPA thành công',$data);
			}else{
				return apiResponse(3,'Số điện thoại đã tồn tại');
			}
		}else{
				return apiResponse( 2, 'Gửi thiếu dữ liệu');
		}
	}else{
		return  apiResponse(0,'Gửi thiếu dữ liệu');
	}
	
}

function loginAPI($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$metaTitleMantan = 'Đăng nhập công cụ phầm mềm quản lý SPA';

	$modelMembers = $controller->loadModel('Members');
    $modelTokenDevice = $controller->loadModel('TokenDevices');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
			$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
			$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

			$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
			$infoUser = $modelMembers->find()->where($conditions)->first();

			if(!empty($infoUser)){
				$user = array();
	    		// nếu đây là nhân viên
				if($infoUser->type == 0){
					 $checkMember = $modelMember->find()->where(array('id'=>$infoUser->id_member, 'dateline_at >'=>time(), 'status'=>'1' ))->first();
	                if(!empty($checkMember)){
	                    $user = $infoUser;
	                }
					
				}else{
					$user = $infoUser;
				}
				if(!empty($user)){
					$checkTokenDevice = $modelTokenDevice->newEmptyEntity();
					$checkTokenDevice->token_device = @$dataSend['token_device'];
					$checkTokenDevice->id_member = $user->id;
					if($infoUser->type == 0){	
						$checkTokenDevice->type = 'staff';
						$checkTokenDevice->token = 'staff'.createToken();
					}else{
						$checkTokenDevice->type = 'member';
						$checkTokenDevice->token = 'member'.createToken();
					}

					$modelTokenDevice->save($checkTokenDevice);
					return apiResponse(1,'Đăng nhập thành công',getMemberByToken($checkTokenDevice->token));

				}
	    		
			}
				return apiResponse(3,'Sai số điện thoại hoặc mật khẩu');
		}
			return apiResponse(2,'Bạn gửi thiếu thông tin');
		
	}
	return apiResponse(2,'Dữ liệu gửi kiểu POST');
}

function logoutAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelTokenDevice = $controller->loadModel('TokenDevices');
	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$checkPhone = $modelTokenDevice->find()->where(['token'=>$dataSend['token']])->first();

			if(!empty($checkPhone)){
					$checkUser = $modelMember->find()->where(['id'=>$checkPhone->id_member])->first();
					if(!empty($checkUser)){
						$checkUser->token = '';
						$checkUser->id_spa = 0;
						$checkUser->token_device = null;
						$modelMember->save($checkUser);
					}
				
				$modelTokenDevice->delete($checkPhone);

				return apiResponse(1, 'Đăng xuất thành công');
			}
				return apiResponse(3,'Tài khoản không tồn tại hoặc sai token');
			
		}
			return apiResponse(2,'Gửi thiếu dữ liệu');
		
	}
}

function requestCodeForgotPasswordAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1,'mess'=> '');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone'])){
			$checkPhone = $modelStaff->find()->where(array('phone'=>$dataSend['phone']))->first();
			if(!empty($checkPhone->email)){
				$code = rand(1000,9999);

				$checkPhone->code_otp = $code;
				$modelMember->save($checkPhone);
				sendEmailNewPassword($checkPhone->email, $checkPhone->name, $code);
				apiResponse(1,'Gửi email mã xác thực thành công');
			}else{
				apiResponse(3,'Tài khoản chưa cài email');
			}
		}else{
			apiResponse(2,'Gửi thiếu dữ liệu hoặc sai định dạng số điện thoại');
		}
	}
	return  apiResponse(0,'Gửi thiếu dữ liệu');
}

function saveNewPassAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone']) 
			&& !empty($dataSend['code'])
			&& !empty($dataSend['passNew'])
			&& !empty($dataSend['passAgain'])

		){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'code_otp'=>$dataSend['code']))->first();

			if(!empty($checkPhone)){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$checkPhone->code_otp = null;
						$checkPhone->token = '';
						$modelMember->save($checkPhone);
						$return = apiResponse(1, 'lưu mật khẩu mới thành công');
					}else{
						$return = apiResponse(5,'Mật khẩu nhập lại không đúng');
					}
			}else{
				$return = apiResponse(4,'Mã xác thực nhập không đúng');
			}
		}else{
			$return = apiResponse(2,'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

function getInfoMyAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array('status NOT IN'=>'delete');

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);
			if(!empty($checkPhone)){
				
				
				return apiResponse(1,'Bạn lấy dữ liệu thành công',$checkPhone );
			}else{
				return apiResponse(3,'Tài khoản không tồn tại' );
			}
		
		}else{
			return apiResponse(2,'Gửi sai phương thức POST' );
		}

	return apiResponse(0,'Gửi sai phương thức POST');
	}
}

function saveInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
    $modelStaff = $controller->loadModel('Staffs');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
					$checkUser = $modelMember->find()->where(['id'=>$checkPhone->id])->first();
					if(!empty($checkUser)){
						if(!empty($dataSend['name'])){
							$checkUser->name = $dataSend['name'];
						}

						if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
							$avatar = uploadImage($checkUser->id, 'avatar', 'avatar_'.$checkUser->id);
						}

						if(!empty($avatar['linkOnline'])){
							$checkUser->avatar = $avatar['linkOnline'].'?time='.time();
						}

						if(!empty($dataSend['email'])){
							$checkUser->email = $dataSend['email'];
						}

						if(!empty($dataSend['address'])){
							$checkUser->address = $dataSend['address'];
						}
						
						if(!empty($dataSend['birthday'])){
							$checkUser->birthday = $dataSend['birthday'];
						}
						
						
						$modelMember->save($checkUser);
					}
				
				return apiResponse(1, 'Lưu thành công', getMemberByToken($dataSend['token']));

				
			}
				return apiResponse(3,'Tài khoản không tồn tại hoặc sai token');
		}
			return apiResponse(2,'Gửi thiếu dữ liệu');
	}

	return apiResponse(0,'Gửi kiểu POST');
}

function managerSelectSpaAPI($input){
	global $controller;
	global $isRequestPost;
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');

	if($isRequestPost){
		if(!empty($dataSend['token']) && $dataSend['idspa']){
			$checkPhone = getMemberByToken($dataSend['token']);
			if(!empty($checkPhone)){
				$infoUser = $modelMember->find()->where(array('id'=>$checkPhone->id))->first();
				$checkSpa = $modelSpas->find()->where(['id'=>(int)$dataSend['idspa'],'id_member'=>$checkPhone->id_member])->first();
				if(!empty($checkSpa)){
					$infoUser->id_spa = $dataSend['idspa'];
					$modelMember->save($infoUser);

					return apiResponse(3,'Tài khoản không tồn tại hoặc sai token');;
				}
				return apiResponse(4,'Spa không tồn tại');
							
			}
			return apiResponse(3,'Tài khoản không tồn tại hoặc sai token');
		}
		return apiResponse(2,'Gửi thiếu dữ liệu');
	}
	return apiResponse(0,'Gửi kiểu POST');
}

?>