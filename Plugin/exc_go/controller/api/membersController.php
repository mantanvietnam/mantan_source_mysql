<?php 
function saveRegisterMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
		

		if(!empty($dataSend['phone'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				$data = $modelMember->newEmptyEntity();
					$data->phone = $dataSend['phone'];
					$data->code_otp = random_int(100000, 999999);
					$data->type =  0; // 0: người dùng, 1: tài xế
					$data->token = createToken();
					$data->created_at = date('Y-m-d H:i:s');
					$data->last_login = date('Y-m-d H:i:s');
					$data->token_device = @$dataSend['token_device'];

					$modelMember->save($data);
					$return = array('code'=>1, 
			    					'id_member'=>$data->id,
			    					'code_otp'=>$data->code_otp,
			    					'mess'=>'Lưu thông tin thành công',
			    					'info_member'=>$data
			    					);
				
			}else{
				$return = array('code'=>3, 
			    				'id_member'=>$checkPhone->id,
			    				'mess'=>'Số điện thoại đã tồn tại',
			    				'info_member'=>$checkPhone
			    				);

			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function acceptMemberAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$checkPhone = $modelMember->find()->where(array('code_otp'=>(int)$dataSend['code_otp'],'phone'=>$dataSend['phone']))->first();
		if(!empty($checkPhone)){
			$checkPhone->code_otp = random_int(100000, 999999);

			$checkPhone->status = 1; //1: kích hoạt, 0: khóa
			$modelMember->save($checkPhone);

				$return = array('code'=>1, 
			    				'id_member'=>$checkPhone->id,
			    				'code_otp'=>$checkPhone->code_otp,
			    				'mess'=>'kích hoạt tài khoản thành công',
			    				'info_member'=>$checkPhone
			    			);
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi sai mã OTP'
				);
		}
	}
	return $return;
}

function savePasswordMemberAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
		if(!empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty(!$checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					$checkPhone->code_otp = random_int(100000, 999999);
					$checkPhone->password = md5($dataSend['password']);
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');

					$modelMember->save($checkPhone);

					$return = array('code'=>1, 
			    					'id_member'=>$checkPhone->id,
			    					'mess'=>'Lưu thông tin thành công',
			    					'info_member'=>$checkPhone
			    				);
				}else{
					$return = array('code'=>4,
								'mess'=>'Mật khẩu nhập lại không đúng'
							);
				}
			}else{
				$return = array('code'=>3,
								'mess'=>'số điện thoại không đúng'
									);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}

	}
	return $return;
}

function saveInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
		
		if(empty($dataSend['status'])) $dataSend['status']=1;
		if(empty($dataSend['password'])) $dataSend['password']= $dataSend['phone'];
		

		if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty(!$checkPhone)){
				$data = $modelMember->newEmptyEntity();

				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($dataSend['phone'], 'avatar', 'avatar_'.$dataSend['phone']);
				}

				if(!empty($avatar['linkOnline'])){
					$checkPhone->avatar = $avatar['linkOnline'];
				}

				$checkPhone->name = $dataSend['name'];
				$checkPhone->email = @$dataSend['email'];
				$checkPhone->address = @$dataSend['address'];
				$checkPhone->lat = @$dataSend['lat'];
				$checkPhone->long = @$dataSend['long'];
				$checkPhone->code_otp = random_int(100000, 999999);
				$checkPhone->token = createToken();
				$checkPhone->last_login = date('Y-m-d H:i:s');
				$checkPhone->token_device = @$dataSend['token_device'];

				$modelMember->save($checkPhone);

				$return = array('code'=>1, 
		    					'id_member'=>$checkPhone->id,
		    					'mess'=>'Lưu thông tin thành công',
		    					'info_member'=>$checkPhone
		    				);
			}else{
				$return = array('code'=>3,
					'mess'=>'Số điện thoại không tồn tại'
				);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}
	return $return;
}

function checkLoginMemberAPI($input)
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

		if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']), 'status'=>1 ))->first();

			if(!empty($checkPhone)){
				if(!empty($dataSend['token_device']) && $checkPhone->token_device != $dataSend['token_device']){
					// gửi thông báo đăng xuất
                    $dataSendNotification= array('title'=>'Đăng xuất','time'=>date('H:i d/m/Y'),'content'=>'Tài khoản của bạn đã được đăng nhập trên một thiết bị khác','action'=>'login');

                    sendNotification($dataSendNotification, $checkPhone->token_device);
				}

				$checkPhone->token = createToken();
				$checkPhone->last_login = date('Y-m-d H:i:s');
				$checkPhone->code_otp = random_int(100000, 999999);
				$checkPhone->token_device = @$dataSend['token_device'];
				$modelMember->save($checkPhone);

				$return = array(	'code'=>0, 
		    						'info_member'=>$checkPhone
		    					);
			}else{
				$return = array('code'=>3,
					'mess'=>'Tài khoản không tồn tại hoặc sai mật khẩu'
				);

			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function logoutMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->token = '';
				$checkPhone->code_otp = random_int(100000, 999999);
				$checkPhone->token_device = null;
				$modelMember->save($checkPhone);

				$return = array('code'=>1);
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại hoặc sai token'
								);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function getInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$name_slug = createSlugMantan($checkPhone->name);
				$checkPhone->link_share = 'https://designer.ezpics.vn/designer/'.$name_slug.'-'.$checkPhone->id.'.html';
				
				$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'mess'=>'bạn lấy dữ liệu thành công'
								);
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại'
								);
			}
		}else{
			$return = array('code'=>2,
									'mess'=>'Bạn thiếu dữ liệu'
								);
		}
	
	}

	return $return;
}

function getInfoUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelOrder = $controller->loadModel('Orders');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();


		if(!empty($dataSend['idUser'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['idUser'] , 'type'=> 1))->first();
		

			if(!empty($checkPhone)){
				unset($checkPhone->password);
				unset($checkPhone->token);
				unset($checkPhone->token_device);
				unset($checkPhone->last_login);
				unset($checkPhone->account_balance);
				
				if($checkPhone->type==1){

					
					$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'mess'=>'Bạn lấy dữ liệu thành công'
								);
				}else{
					$return = array('code'=>4,
									'mess'=>'Tài khoản chưa phải là tài xế'
								);
				}
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại'
								);
			}
		}else{
			$return = array('code'=>2,
									'mess'=>'Bạn thiếu dữ liệu'
								);
		}
	
	}

	return $return;
}

function lockAccountAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->code_otp = random_int(100000, 999999);
				$checkPhone->status = 0;
				$checkPhone->token = '';
				$modelMember->save($checkPhone);
				
				$return = array('code'=>0);
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại hoặc sai token'
								);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function saveChangePassAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
			if(!empty($checkPhone)){
				if($checkPhone->password == md5($dataSend['passOld']) ){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$checkPhone->token = '';
						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>5,
									'mess'=>'Mật khẩu nhập lại không đúng'
								);
					}
				}else{
					$return = array('code'=>4,
									'mess'=>'Mật khẩu cũ nhập không đúng'
								);
				}
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại hoặc sai token'
								);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function saveInfoUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['name'])&& !empty($dataSend['email'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($checkPhone->phone, 'avatar', 'avatar_'.$checkPhone->phone);
				}

				if(!empty($avatar['linkOnline'])){
					$checkPhone->avatar = $avatar['linkOnline'];
				}

				$checkPhone->name = $dataSend['name'];
				$checkPhone->email = $dataSend['email'];

				if(!empty($dataSend['phone'])){
					$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
					$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

					$checkMember = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

					if(empty($checkMember) || $checkMember->id == $checkPhone->id){
						$checkPhone->phone = $dataSend['phone'];

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>4,
									'mess'=>'Số điện thoại đã tồn tại'
								);
					}
				}else{
					$modelMember->save($checkPhone);

					$return = array('code'=>0);
				}
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại hoặc sai token'
								);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function requestCodeForgotPasswordAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty($checkPhone->email)){

				sendEmailCodeForgotPassword($checkPhone->email, $checkPhone->name, $checkPhone->code_otp);

				$return = array('code'=>1,
								'code_otp' => $checkPhone->code_otp,
								'mess'=>'lấy code OPT thành công'
							);
			}else{
				$return = array('code'=>3,
					'mess'=>'Tài khoản chưa cài email'
				);
			}
		}else{
			$return = array('code'=>2,
							'mess'=>'Gửi thiếu dữ liệu hoặc sai định dạng số điện thoại'
						);
		}
	}

	return $return;
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

		if(!empty($dataSend['phone']) && !empty($dataSend['code_otp']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty($checkPhone)){
				if($checkPhone->code_otp == $dataSend['code_otp'] ){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$data->code_otp = random_int(100000, 999999);
						$checkPhone->token = '';

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>5,
									'mess'=>'Mật khẩu nhập lại không đúng'
								);
					}
				}else{
					$return = array('code'=>4,
									'mess'=>'Mã xác thực nhập không đúng'
								);
				}
			}else{
				$return = array('code'=>3,
									'mess'=>'Tài khoản không tồn tại hoặc sai số điện thoại'
								);
			}
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi thiếu dữ liệu'
				);
		}
	}

	return $return;
}

function updateLastLoginAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->last_login = date('Y-m-d H:i:s');

				$modelMember->save($checkPhone);
				$return = array('code'=>1,
									'last_login'=> $checkPhone->last_login,
						 			'mess'=>'Bạn cập nhật thời gian login thành công',
						 		);
			}else{
				 $return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			 $return = array('code'=>0, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

function updatelocationAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->lat = @$dataSend['lat'];
				$checkPhone->long = @$dataSend['long'];

				$modelMember->save($checkPhone);
				$return = array('code'=>1,
									'long'=> $checkPhone->long,
									'lat'=> $checkPhone->lat,
						 			'mess'=>'Bạn cập nhật thời gian login thành công',
						 		);
			}else{
				 $return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			 $return = array('code'=>0, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}


?>