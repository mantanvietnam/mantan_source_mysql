<?php 
function getInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();

		if(!empty($dataSend['id'])){
			$conditions['id'] = $dataSend['id'];
		}

		if(!empty($dataSend['phone'])){
			$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions['phone'] = $dataSend['phone'];
		}

		$checkPhone = $modelMember->find()->where($conditions)->first();

		if(!empty($checkPhone)){
			$position = $modelCategories->find()->where(array('id'=>$checkPhone->id_position))->first();
			
			$checkPhone->name_position = @$position->name;
			$checkPhone->discount_position = @$position->description;

			unset($checkPhone->password);
			
			$return = array('code'=>0,
							 'data'=>$checkPhone,
							 'messages'=>array(array('text'=>'Bạn lấy dữ liệu thành công'))
							);
		}else{
			$return = array('code'=>3,
								'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
							);
		}
	
	}

	return $return;
}

function resendOTPAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelZalos = $controller->loadModel('Zalos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['id']))->first();

			if(!empty($checkPhone)){
				$checkPhone->otp = rand(1000,9999);
				$modelMember->save($checkPhone);

				// gửi mã xác thức qua Zalo
				$zalo = $modelZalos->find()->where(['id_system'=>$checkPhone->id_system])->first();
				
				if(!empty($zalo->access_token)){
					$returnZalo = sendZNSZalo($zalo->template_otp, ['otp'=>$checkPhone->otp], $checkPhone->phone, $zalo->id_oa, $zalo->id_app);

					$return = array('code'=>0,
									'messages'=>array(array('text'=>'Gửi mã OTP thành công')),
									'zalo' => $returnZalo
								);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Hệ thống chưa cài đặt Zalo OA'))
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
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']), 'status'=>'active' ))->first();

			if(!empty($checkPhone)){
				if(!empty($dataSend['token_device']) && $checkPhone->token_device != $dataSend['token_device']){
					// gửi thông báo đăng xuất
                    $dataSendNotification= array('title'=>'Đăng xuất','time'=>date('H:i d/m/Y'),'content'=>'Tài khoản của bạn đã được đăng nhập trên một thiết bị khác','action'=>'login');

                    sendNotification($dataSendNotification, $checkPhone->token_device);
				}

				$checkPhone->last_login = time();
				$checkPhone->token = createToken();

				if(!empty($dataSend['token_device'])){
					$checkPhone->token_device = $dataSend['token_device'];
				}

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
			$checkPhone = getMemberByToken($dataSend['token']);

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

function lockMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				$checkPhone->status = 'lock';
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

function saveChangePassMemberAPI($input)
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
			$checkPhone = getMemberByToken($dataSend['token']);

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

function saveInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				if(!empty($dataSend['name'])){
					$checkPhone->name = $dataSend['name'];
				}

				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($checkPhone->id, 'avatar', 'avatar_'.$checkPhone->id);
				}

				if(!empty($avatar['linkOnline'])){
					$checkPhone->avatar = $avatar['linkOnline'];
				}

				if(!empty($dataSend['email'])){
					$checkPhone->email = $dataSend['email'];
				}

				if(!empty($dataSend['address'])){
					$checkPhone->address = $dataSend['address'];
				}
				
				if(!empty($dataSend['birthday'])){
					$checkPhone->birthday = $dataSend['birthday'];
				}
				
				if(!empty($dataSend['facebook'])){
					$checkPhone->facebook = $dataSend['facebook'];
				}

				if(!empty($dataSend['twitter'])){
					$checkPhone->twitter = $dataSend['twitter'];
				}

				if(!empty($dataSend['tiktok'])){
					$checkPhone->tiktok = $dataSend['tiktok'];
				}

				if(!empty($dataSend['youtube'])){
					$checkPhone->youtube = $dataSend['youtube'];
				}

				if(!empty($dataSend['zalo'])){
					$checkPhone->zalo = $dataSend['zalo'];
				}

				if(isset($dataSend['description'])){
					$checkPhone->description = $dataSend['description'];
				}

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
				$code = rand(1000,9999);

				$checkPhone->otp = $code;
				$modelMember->save($checkPhone);

				sendEmailNewPassword($checkPhone->email, $checkPhone->name, $code);

				// gửi mã xác thực về Zalo người đăng ký
				//sendOTPZalo($checkPhone->phone, $checkPhone->otp);

				$return = array('code'=>0,
								'codeForgotPassword' => $code,
								'messages'=>array(array('text'=>'Gửi email mã xác thực thành công'))
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
			&& !empty($dataSend['code'])
			&& !empty($dataSend['passNew'])
			&& !empty($dataSend['passAgain'])

		){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty($checkPhone)){
				if($checkPhone->otp == $dataSend['code'] ){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$checkPhone->otp = null;

						$checkPhone->token = createToken();
						//$checkPhone->token_web = createToken();

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

function updateLastLoginAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				$checkPhone->last_login = time();

				$modelMember->save($checkPhone);
				
				$return = array(	'code'=>0,
									'last_login'=> $checkPhone->last_login,
						 			'mess'=>'Bạn cập nhật thời gian login thành công',
						 		);
				
			}else{
				 $return = array('code'=>3, 'mess'=>'Sai mã token');
			}
		}else{
			 $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}
?>