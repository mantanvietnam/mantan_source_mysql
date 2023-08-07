<?php 
function saveRegisterMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>''))
				);
	
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
					//sendNotificationAdmin('64a247e5c939b1e3d37ead0b');

					$return = array(	'code'=>0, 
			    						'set_attributes'=>array('id_member'=>$data->id),
			    						'messages'=>array(array('text'=>'Lưu thông tin thành công')),
			    						'info_member'=>$data
			    					);
				
			}else{
				$return = array('code'=>3, 
			    				'set_attributes'=>array('id_member'=>$checkPhone->id),
			    				'messages'=>array(array('text'=>'Số điện thoại đã tồn tại')),
			    				'info_member'=>$checkPhone
			    				);

			}
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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

	$return = array('code'=>1,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>''))
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$checkPhone = $modelMember->find()->where(array('code_otp'=>(int)$dataSend['code_otp'],'phone'=>$dataSend['phone']))->first();
		if(!empty($checkPhone)){
			$checkPhone->code_otp = random_int(100000, 999999);

			$checkPhone->status = 1; //1: kích hoạt, 0: khóa
			$modelMember->save($checkPhone);
					//sendNotificationAdmin('64a247e5c939b1e3d37ead0b');

				$return = array('code'=>1, 
			    				'set_attributes'=>array('id_member'=>$checkPhone->id),
			    				'messages'=>array(array('text'=>'kích hoạt tài khoản  thành công')),
			    				'info_member'=>$checkPhone
			    			);
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi sai mã OTP'))
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

	$return = array('code'=>1,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>''))
				);
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
		if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty(!$checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					$checkPhone->code_otp = random_int(100000, 999999);
					$checkPhone->password = md5($dataSend['password']);
					$checkPhone->status = 0; //1: kích hoạt, 0: khóa
					$checkPhone->type =  0; // 0: người dùng, 1: tài xế
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');

					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'set_attributes'=>array('id_member'=>$checkPhone->id),
			    						'messages'=>array(array('text'=>'Lưu thông tin thành công')),
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>4,
								'set_attributes'=>array('id_member'=>0),
								'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
							);
				}
			}else{
				$return = array('code'=>4,
										'set_attributes'=>array('id_member'=>0),
										'messages'=>array(array('text'=>'số điện thoại không đúng'))
									);
			}
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}

	}
	return $return;
}
s
function saveInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>''))
				);
	
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
				$checkPhone->code_otp = random_int(100000, 999999);
				$checkPhone->token = createToken();
				$checkPhone->last_login = date('Y-m-d H:i:s');
				$checkPhone->token_device = @$dataSend['token_device'];

				$modelMember->save($checkPhone);

				$return = array('code'=>0, 
		    					'set_attributes'=>array('id_member'=>$checkPhone->id),
		    					'messages'=>array(array('text'=>'Lưu thông tin thành công')),
		    					'info_member'=>$checkPhone
		    				);
				
			}else{
				$return = array('code'=>3,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>'Số điện thoại không tồn tại'))
				);

			}
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_member'=>0),
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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
				$checkPhone->token_device = @$dataSend['token_device'];
				$modelMember->save($checkPhone);

				$return = array(	'code'=>0, 
		    						'info_member'=>$checkPhone
		    					);
			}else{
				$return = array('code'=>3,
					'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai mật khẩu'))
				);

			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkLoginFacebookAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_facebook'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'FB'.$dataSend['id_facebook'];

			$checkPhone = $modelMember->find()->where(array('id_facebook'=>$dataSend['id_facebook'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_facebook = @$dataSend['id_facebook'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];

				$modelMember->save($data);
				//sendNotificationAdmin('64a247e5c939b1e3d37ead0b');

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
			    					);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->token = '';
				$checkPhone->token_device = null;
				$modelMember->save($checkPhone);

				$return = array('code'=>0);
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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
								 'messages'=>array(array('text'=>'bạn lấy dữ liệu thành công'))
								);
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
								);
			}
		}else{
			$return = array('code'=>2,
									'messages'=>array(array('text'=>'Bạn thiếu dữ liệu'))
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
				unset($checkPhone->id_facebook);
				unset($checkPhone->last_login);
				unset($checkPhone->account_balance);
				
				if($checkPhone->type==1){

					
					$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'messages'=>array(array('text'=>'Bạn lấy dữ liệu thành công'))
								);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Tài khoản chưa phải là designer'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
								);
			}
		}else{
			$return = array('code'=>2,
									'messages'=>array(array('text'=>'Bạn thiếu dữ liệu'))
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
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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

		if(!empty($dataSend['token']) 
			&& !empty($dataSend['passOld'])
			&& !empty($dataSend['passNew'])
			&& !empty($dataSend['passAgain'])

		){
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
									'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
								);
					}
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Mật khẩu cũ nhập không đúng'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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

		if(!empty($dataSend['token']) 
			&& !empty($dataSend['name'])
			&& !empty($dataSend['email'])

		){
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

				if(isset($dataSend['description'])){
					$checkPhone->description = $dataSend['description'];
				}

				if(isset($_FILES['file_cv']) && empty($_FILES['file_cv']["error"])){
					$file_cv = uploadImage($checkPhone->phone, 'file_cv', 'file_cv_'.$checkPhone->phone);

					if(!empty($file_cv['linkOnline'])){
						$checkPhone->file_cv = $file_cv['linkOnline'].'?time='.time();
					}
				}

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
									'messages'=>array(array('text'=>'Số điện thoại đã tồn tại'))
								);
					}
				}else{
					$modelMember->save($checkPhone);

					$return = array('code'=>0);
				}

				
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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

	$return = array('code'=>1,
					'messages'=>array(array('text'=>''))
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty($checkPhone->email)){

				//$checkPhone->token = $code;
				//$modelMember->save($checkPhone);

				sendEmailCodeForgotPassword($checkPhone->email, $checkPhone->name, $code->code_otp);

				$return = array('code'=>0,
								'code_otp' => $code->code_otp,
								'messages'=>array(array('text'=>''))
							);
			}else{
				$return = array('code'=>3,
					'messages'=>array(array('text'=>'Tài khoản chưa cài email'))
				);
			}
		}else{
			$return = array('code'=>2,
							'messages'=>array(array('text'=>'Gửi thiếu dữ liệu hoặc sai định dạng số điện thoại'))
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

		if(!empty($dataSend['phone']) 
			&& !empty($dataSend['code_otp'])
			&& !empty($dataSend['passNew'])
			&& !empty($dataSend['passAgain'])

		){
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
									'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
								);
					}
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Mã xác thực nhập không đúng'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai số điện thoại'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkCodeAffiliateAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['aff'])){
			$checkPhone = $modelMember->find()->where(array('aff'=>$dataSend['aff']))->first();

			if(!empty($checkPhone)){
				$return = array('code'=>0);
			}else{
				$return = array('code'=>3);
			}
		}else{
			$return = array('code'=>2);
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

function searchDesignerAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$return = array('code'=> 0);

	if($isRequestPost){

		$dataSend = $input['request']->getData();
		$conditions = array();
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:20;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array('id'=>'desc');
		if(!empty($dataSend['name'])){
			$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
			
		}
		$conditions['type'] = 1;
		$data = $modelMember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
			$return = array('code'=>1,
								'data' => $data,
								'mess'=>'Lấy data thành công'
							);
		}else{
			$return = array('code'=>2,
								'mess'=>'không có data'
							);
		}

	return 	$return;
}

function listDesignerAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=> 0);

	if($isRequestPost){

		$dataSend = $input['request']->getData();
		$conditions = array();
		
		$conditions['type'] = 1;
		$data = $modelMember->find()->where($conditions)->all()->toList();		    
			$return = array('code'=>1,
								'data' => $data,
								'mess'=>'Lấy data thành công'
							);
		

	}

	return 	$return;
}
?>