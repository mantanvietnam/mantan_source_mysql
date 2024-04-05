<?php 
function searchMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelMembers = $controller->loadModel('Members');

	$dataSend = $_REQUEST;
	
    $conditions = [];

	if(!empty($dataSend['term'])){
        $conditions['name LIKE'] = '%'.$dataSend['term'].'%';
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    if(!empty($dataSend['phone'])){
    	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        $conditions['phone'] = $dataSend['phone'];
    }

    if(!empty($dataSend['email'])){
        $conditions['email'] = $dataSend['email'];
    }

    if(!empty($dataSend['status'])){
        $conditions['status'] = $dataSend['status'];
    }

    if(!empty($dataSend['id_father'])){
        $conditions['id_father'] = (int) $dataSend['id_father'];
    }

    $listData= $modelMembers->find()->where($conditions)->all()->toList();
    
    $positions = [];

    if($listData){
        foreach($listData as $data){
        	if(empty($positions[$data->id_position])){
        		$positions[$data->id_position] = $modelCategories->find()->where(array('id'=>$data->id_position))->first();
        	}

            $return[]= array(   'id'=>$data->id,
                                'label'=>$data->name.' '.$data->phone,
                                'value'=>$data->id,
                                'name'=>$data->name,
                                'avatar'=>$data->avatar,
                                'phone'=>$data->phone,
                                'id_father'=>$data->id_father,
                                'email'=>$data->email,
                                'status'=>$data->status,
                                'created_at'=>$data->created_at,
                                'address'=>$data->address,
                                'birthday'=>$data->birthday,
                                'id_position'=>$data->id_position,
                                'name_position'=>@$positions[$data->id_position]->name,
                                'discount'=>@$positions[$data->id_position]->description,
                            );
        }
    }else{
        $return= array(array(   'id'=>0, 
                                'label'=>'Không tìm được đại lý, hãy tạo thông tin cho đại lý mới', 
                                'value'=>'', 
                            )
                );
    }

	return $return;
}

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
							 'mess'=> 'Bạn lấy dữ liệu thành công'
							);
		}else{
			$return = array('code'=>3,
							'mess'=> 'Tài khoản không tồn tại'
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
									'mess'=>'Gửi mã OTP thành công',
									'zalo' => $returnZalo
								);
				}else{
					$return = array('code'=>4,
									'mess'=>'Hệ thống chưa cài đặt Zalo OA'
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
				$return = array('code'=> 3,
								'mess'=> 'Tài khoản không tồn tại hoặc sai mật khẩu'
							);

			}
		}else{
			$return = array('code'=>2,
							'mess'=> 'Gửi thiếu dữ liệu'
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
								'mess'=> 'Tài khoản không tồn tại hoặc sai token'
							);
			}
		}else{
			$return = array('code'=>2,
							'mess'=> 'Gửi thiếu dữ liệu'
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
								'mess'=> 'Tài khoản không tồn tại hoặc sai token'
							);
			}
		}else{
			$return = array('code'=>2,
							'mess'=> 'Gửi thiếu dữ liệu'
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
										'mess'=> 'Mật khẩu nhập lại không đúng'
									);
					}
				}else{
					$return = array('code'=>4,
									'mess'=> 'Mật khẩu cũ nhập không đúng'
								);
				}
			}else{
				$return = array('code'=>3,
								'mess'=> 'Tài khoản không tồn tại hoặc sai token'
							);
			}
		}else{
			$return = array('code'=>2,
							'mess'=> 'Gửi thiếu dữ liệu'
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

				$return = array('code'=>0, 'data'=>$checkPhone);

				
			}else{
				$return = array('code'=>3,
								'mess'=> 'Tài khoản không tồn tại hoặc sai token'
							);
			}
		}else{
			$return = array('code'=>2,
							'mess'=> 'Gửi thiếu dữ liệu'
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
					'mess'=> ''
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
								'mess'=> 'Gửi email mã xác thực thành công'
							);
			}else{
				$return = array('code'=>3,
								'mess'=> 'Tài khoản chưa cài email'
							);
			}
		}else{
			$return = array('code'=>2,
							'mess'=> 'Gửi thiếu dữ liệu hoặc sai định dạng số điện thoại'
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

function getListMemberDownAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMembers = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				$listData = $modelMembers->find()->where(['id_father'=>$checkPhone->id])->all()->toList();

				if(!empty($listData)){
			        foreach ($listData as $key => $value) {
			            $listData[$key]->agentSystem = getTreeSystem($value->id, $modelMembers);
			        }
			    }
				
				$return = array('code'=>0, 'listData'=>$listData);
			}else{
				 $return = array('code'=>3, 'mess'=>'Sai mã token');
			}
		}else{
			 $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

function addMemberDownAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$modelMembers = $controller->loadModel('Members');
	$modelZalos = $controller->loadModel('Zalos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){
				if(!empty($dataSend['id'])){
					$data = $modelMembers->find()->where(['id'=>(int) $dataSend['id']])->first();

					if(empty($data)){
						return array('code'=>4, 'mess'=>'Không tìm thấy đại lý cần sửa');
					}
				}else{
					$data = $modelMembers->newEmptyEntity();
				}

				if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
		        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
		        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		        	$conditions = ['phone'=>$dataSend['phone']];
		        	$checkPhone = $modelMembers->find()->where($conditions)->first();

		        	if(empty($checkPhone) || (!empty($dataSend['id']) && $dataSend['id']==$checkPhone->id) ){
		        		$system = $modelCategories->find()->where(['id'=>(int) $infoMember->id_system])->first();

		        		// nếu up file ảnh avatar lên
		        		if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
				            $avatar = uploadImage($infoMember->id, 'avatar');

				            if(!empty($avatar['linkOnline'])){
				            	$dataSend['avatar'] = $avatar['linkOnline'];
				            }
				        }

		        		if(empty($dataSend['avatar'])){
		        			if(!empty($data->avatar)){
		        				$dataSend['avatar'] = $data->avatar;
		        			}

		        			if(empty($dataSend['avatar']) && !empty($system->image)){
		        				$dataSend['avatar'] = $system->image;
		        			}

		        			if(empty($dataSend['avatar'])){
		        				$dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
		        			}
		        		}

		        		// tạo dữ liệu save
		        		if(empty($data->id_father)){
		        			$data->id_father = (!empty($dataSend['id_father']))? (int) $dataSend['id_father']:(int) $infoMember->id;
		        		}
				        
				        $data->name = $dataSend['name'];
				        $data->address = $dataSend['address'];
				        $data->avatar = $dataSend['avatar'];
				        $data->phone = $dataSend['phone'];
						$data->id_system = (int) $infoMember->id_system;
						$data->email = $dataSend['email'];
						$data->birthday = $dataSend['birthday'];
						$data->facebook = $dataSend['facebook'];
						$data->create_agency = (!empty($dataSend['create_agency']))?$dataSend['create_agency']:'active';
						$data->id_position = (int) $dataSend['id_position'];
						$data->linkedin = $dataSend['linkedin'];
						$data->web = $dataSend['web'];
						$data->instagram = $dataSend['instagram'];
						$data->zalo = $dataSend['zalo'];
						$data->twitter = $dataSend['twitter'];
						$data->tiktok = $dataSend['tiktok'];
						$data->youtube = $dataSend['youtube'];
						$data->description = $dataSend['description'];
						

						if(empty($dataSend['id'])){
							if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
							
							$data->password = md5($dataSend['password']);

							$data->created_at = time();
							$data->deadline = time()+ 63072000; // 2 năm
							$data->status =  'active';
							
							if(empty($system->keyword)){
								$data->verify =  'lock';
								$data->otp =  rand(1000,9999);

								// gửi mã xác thức qua Zalo
								$zalo = $modelZalos->find()->where(['id_system'=>$infoMember->id_system])->first();
								if(!empty($zalo->access_token)){
									sendZNSZalo($zalo->template_otp, ['otp'=>$data->otp], $data->phone, $zalo->id_oa, $zalo->id_app);
								}
							}else{
								$data->verify =  'active';
								$data->otp = null;
							}
							
						}else{
							if(!empty($dataSend['password'])){
					        	$data->password = md5($dataSend['password']);
					        }
						}

				        $modelMembers->save($data);

				        $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_member'=>$data->id);
				    }else{
				    	$return = array('code'=>4, 'mess'=>'Số điện thoại đã tồn tại');
				    }
			    
			    }else{
			    	$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
			    }
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