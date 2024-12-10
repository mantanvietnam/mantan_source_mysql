<?php 
function searchMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelMembers = $controller->loadModel('Members');

	$dataSend = $_REQUEST;
	
    $conditions = ['status NOT IN'=>'delete'];

	if(!empty($dataSend['term'])){
        $conditions['OR'] = ['name LIKE' => '%'.$dataSend['term'].'%', 'phone LIKE' => '%'.$dataSend['term'].'%'];
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
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');

	$modelLinkInfo = $controller->loadModel('LinkInfos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array('status NOT IN'=>'delete');

		if(!empty($dataSend['id'])){
			$conditions['id'] = $dataSend['id'];
		}

		if(!empty($dataSend['phone'])){
			$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions['phone'] = $dataSend['phone'];
		}

		if(!empty($dataSend['token'])){
			$conditions['token'] = $dataSend['token'];
		}

		$checkPhone = $modelMember->find()->where($conditions)->first();

		if(!empty($checkPhone)){
			$dataLink = $modelLinkInfo->find()->where(['id_member'=>$checkPhone->id])->all()->toList();
			$position = $modelCategories->find()->where(array('id'=>$checkPhone->id_position))->first();
			$checkAgencyDownline = $modelMember->find()->where(array('id_father'=>$checkPhone->id))->first();
			
			$checkPhone->name_position = @$position->name;
			$checkPhone->ListLink = @$dataLink;
			$checkPhone->discount_position = @$position->description;
			$checkPhone->checkAgencyDownline = (!empty($checkAgencyDownline))?1:0;
			$checkPhone->Link = $urlHomes.'info/?id='.@$checkPhone->id;
			$checkPhone->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$urlHomes.'info/?id='.@$checkPhone->id;

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
	
	}else{
		$return = array('code'=>1,
						'mess'=> 'Gửi sai phương thức POST'
						);
	}

	return $return;
}

function deteleMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend= $input['request']->getData();
		$user = checklogin('deteleMember');   
		$checkPhone = getMemberByToken(@$dataSend['token'],'deteleMember'); 
	    if(!empty($user)){
	        if(empty($user->grant_permission)){
	           return array('code'=>4,
						'mess'=> 'bạn không có quyền'
						);
	        }
	    }elseif(empty($checkPhone)){
	    	return  array('code'=>2,
								'mess'=> 'Tài khoản không tồn tại hoặc sai token'
							);
	    }



		$dataSend = $input['request']->getData();
		$deteleMember = $modelMember->find()->where(array('id'=>@$dataSend['id_agency']))->first();
		$checkAgency = $modelMember->find()->where(array('phone'=>@$dataSend['phone'], 'status'=>'active'))->first();

		if(empty($checkAgency)){
			return array('code'=>3,
						'mess'=> 'Đại lý này không tồn tại'
						);
		}

		if($deteleMember->id==$checkAgency->id){
			return array('code'=>3,
						'mess'=> 'Đại lý này không phải '
						);
		}

		$listData = $modelMember->find()->where(['id_father'=>$deteleMember->id])->all()->toList();
		$array =0;
		if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            if($checkAgency->id==$value->id){
	                $array ++;
	            }else{
	            	$array += checkDuplicateSystem($value->id, $modelMember, $checkAgency->id,0);
	            	//return 100;
	            }
	            
	        }
	    }
	    //s return $array;


	   if($array==0){
	    	if(!empty($listData)){
		        foreach ($listData as $key => $value) {
		            $value->id_father =  $checkAgency->id;
		            $modelMember->save($value);
		        }
		    }

		    $deteleMember->status = 'delete';
		    $modelMember->save($deteleMember);
		    return array('code'=>1,
	                        'mess'=> 'Bạn xóa thành công'
	                        );
	    }else{
	    	return array('code'=>3,
	                        'mess'=> 'Đại lý này không phải '
	                        );
	    }

	}else{
		$return = array('code'=>0,
						'mess'=> 'Gửi sai phương thức POST'
						);
	}

	return $return;
}

function getInfoMemberMyAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');

	$modelLinkInfo = $controller->loadModel('LinkInfos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array('status NOT IN'=>'delete');

		if(!empty($dataSend['token'])){
			$conditions['token'] = $dataSend['token'];
		}elseif(!empty($dataSend['id'])){
			$conditions['id'] = $dataSend['id'];
		}else{
			return  array('code'=>4,
							'mess'=> 'Thiếu dữ liệu'
						);
		}

		$checkPhone = $modelMember->find()->where($conditions)->first();

		if(!empty($checkPhone)){
			$dataLink = $modelLinkInfo->find()->where(['id_member'=>$checkPhone->id])->all()->toList();
			$position = $modelCategories->find()->where(array('id'=>$checkPhone->id_position))->first();
			
			$checkPhone->name_position = @$position->name;
			$checkPhone->ListLink = @$dataLink;
			$checkPhone->discount_position = @$position->description;
			$checkPhone->Link = $urlHomes.'info/?id='.@$checkPhone->id;
			$checkPhone->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$urlHomes.'info/?id='.@$checkPhone->id;

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
	
	}else{
		$return = array('code'=>1,
						'mess'=> 'Gửi sai phương thức POST'
						);
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
	$modelTokenDevices = $controller->loadModel('TokenDevices');
	$modelStaff = $controller->loadModel('Staffs');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']), 'status'=>'active' ))->first();
				$checkStaff = $modelStaff->find()->where(array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']), 'status'=>'active' ))->first();

			if(!empty($checkPhone)){
				/*
				if(!empty($dataSend['token_device']) && $checkPhone->token_device != $dataSend['token_device']){
					// gửi thông báo đăng xuất
                    $dataSendNotification= array('title'=>'Đăng xuất','time'=>date('H:i d/m/Y'),'content'=>'Tài khoản của bạn đã được đăng nhập trên một thiết bị khác','action'=>'login');

                    sendNotification($dataSendNotification, $checkPhone->token_device);
				}
				*/
				if($checkPhone->deadline > time()){

					$checkPhone->last_login = time();
					$checkPhone->token = 'member'.createToken();

					if(!empty($dataSend['token_device'])){
						$checkPhone->token_device = $dataSend['token_device'];

						$checkTokenDevice = $modelTokenDevices->find()->where(['token_device'=>$dataSend['token_device']])->first();

						if(!empty($checkTokenDevice)){
							$checkTokenDevice->id_member = $checkPhone->id;
						}else{
							$checkTokenDevice = $modelTokenDevices->newEmptyEntity();

							$checkTokenDevice->token_device = $dataSend['token_device'];
							$checkTokenDevice->id_member = $checkPhone->id;
						}

						$modelTokenDevices->save($checkTokenDevice);
					}

					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=> 3,
								'mess'=> 'Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ'
							);
				}
			}elseif(!empty($checkStaff)){
				$checkStaff->last_login = time();
				$checkStaff->token = 'staff'.createToken();
				$checkBoss = $modelMember->find()->where(array('id'=>$checkStaff->id_member, 'deadline >'=>time(), 'status'=>'active' ))->first();
				if(!empty($checkBoss)){
					if(!empty($dataSend['token_device'])){
						$checkStaff->token_device = $dataSend['token_device'];

						$checkTokenDevice = $modelTokenDevices->find()->where(['token_device'=>$dataSend['token_device']])->first();

						if(!empty($checkTokenDevice)){
							$checkTokenDevice->id_member = $checkStaff->id;
						}else{
							$checkTokenDevice = $modelTokenDevices->newEmptyEntity();

							$checkTokenDevice->token_device = $dataSend['token_device'];
							$checkTokenDevice->id_member = $checkStaff->id;
						}

						$modelTokenDevices->save($checkTokenDevice);
					}

					$modelStaff->save($checkStaff);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkStaff
			    					);
				}else{
					$return = array('code'=> 3,
								'mess'=> 'Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ'
							);
				}
				
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

    $modelStaff = $controller->loadModel('Staffs');
	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);
			if(!empty($checkPhone)){
				if($checkPhone->type=='member'){
					$checkUser = $modelMember->find()->where(['id'=>$checkPhone->id])->first();
					if(!empty($checkUser)){
						$checkUser->token = '';
						$checkUser->token_device = null;
						$modelMember->save($checkUser);
					}
				}elseif($checkPhone->type=='staff'){
					$checkUser = $modelStaff->find()->where(['id'=>$checkPhone->id_staff])->first();
					if(!empty($checkUser)){
						$checkUser->token = '';
						$checkUser->token_device = null;
						$modelStaff->save($checkUser);
					}
				}
				

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
    $modelStaff = $controller->loadModel('Staffs');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				if($checkPhone->type=='member'){
					$checkUser = $modelMember->find()->where(['id'=>$checkPhone->id])->first();
					if(!empty($checkUser)){
						$checkUser->token = '';
						$checkUser->status = 'lock';
						$checkUser->token_device = null;
						$modelMember->save($checkUser);
					}
				}elseif($checkPhone->type=='staff'){
					$checkUser = $modelStaff->find()->where(['id'=>$checkPhone->id_staff])->first();
					if(!empty($checkUser)){
						$checkUser->token = '';
						$checkUser->status = 'lock';
						$checkUser->token_device = null;
						$modelStaff->save($checkUser);
					}
				}
				
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
    $modelStaff = $controller->loadModel('Staffs');

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
						if($checkPhone->type=='member'){
							$checkUser = $modelMember->find()->where(['id'=>$checkPhone->id])->first();
							if(!empty($checkUser)){
								$checkUser->password = md5($dataSend['passNew']);
								$modelMember->save($checkUser);
							}
						}elseif($checkPhone->type=='staff'){
							$checkUser = $modelStaff->find()->where(['id'=>$checkPhone->id_staff])->first();
							if(!empty($checkUser)){
								$checkUser->password = md5($dataSend['passNew']);
								$modelStaff->save($checkUser);
							}
						}

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
    $modelStaff = $controller->loadModel('Staffs');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				if($checkPhone->type=='member'){
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
						
						if(!empty($dataSend['facebook'])){
							$checkUser->facebook = $dataSend['facebook'];
						}

						if(!empty($dataSend['twitter'])){
							$checkUser->twitter = $dataSend['twitter'];
						}

						if(!empty($dataSend['tiktok'])){
							$checkUser->tiktok = $dataSend['tiktok'];
						}

						if(!empty($dataSend['youtube'])){
							$checkUser->youtube = $dataSend['youtube'];
						}

						if(!empty($dataSend['zalo'])){
							$checkUser->zalo = $dataSend['zalo'];
						}

						if(isset($dataSend['description'])){
							$checkUser->description = $dataSend['description'];
						}

						if(!empty($dataSend['bank_number'])){
							$checkUser->bank_number = $dataSend['bank_number'];
						}
						if(!empty($dataSend['bank_name'])){
							$checkUser->bank_name = $dataSend['bank_name'];
						}
						if(!empty($dataSend['bank_code'])){
							$checkUser->bank_code = $dataSend['bank_code'];
						}

						if(!empty($checkPhone->bank_number) && !empty($checkPhone->bank_name) && !empty($checkPhone->bank_code)){
							$checkUser->image_qr_pay = 'https://img.vietqr.io/image/'.$checkPhone->bank_code.'-'.$checkPhone->bank_number.'-compact2.png?amount=&addInfo=&accountName='.$checkPhone->bank_name;
						}

						$modelMember->save($checkUser);
					}
				}elseif($checkPhone->type=='staff'){
					$checkUser = $modelStaff->find()->where(['id'=>$checkPhone->id_staff])->first();
					if(!empty($checkUser)){
						if(!empty($dataSend['name'])){
							$checkUser->name = $dataSend['name'];
						}

						if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
							$avatar = uploadImage($checkPhone->id, 'avatar', 'avatar_staff'.$checkUser->id);
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
						
						if(!empty($dataSend['facebook'])){
							$checkUser->facebook = $dataSend['facebook'];
						}

						if(!empty($dataSend['twitter'])){
							$checkUser->twitter = $dataSend['twitter'];
						}

						if(!empty($dataSend['tiktok'])){
							$checkUser->tiktok = $dataSend['tiktok'];
						}

						if(!empty($dataSend['youtube'])){
							$checkUser->youtube = $dataSend['youtube'];
						}

						if(!empty($dataSend['zalo'])){
							$checkUser->zalo = $dataSend['zalo'];
						}

						if(isset($dataSend['description'])){
							$checkUser->description = $dataSend['description'];
						}
						$modelStaff->save($checkUser);
					}
				}

				$return = array('code'=>0, 'data'=>$checkUser);

				
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

function saveLinkInfoMemberAPI($input){
		global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelLinkInfo = $controller->loadModel('LinkInfos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				if($checkPhone->type=='member'){
				
					if($dataSend['id']){
						$LinkInfo = $modelLinkInfo->find()->where(['id'=>(int)$dataSend['id'],'id_member'=>$checkPhone->id])->first();
						if(empty($LinkInfo)){
							$LinkInfo = $modelLinkInfo->newEmptyEntity();
						}
					}else{
						$LinkInfo = $modelLinkInfo->newEmptyEntity();
					}

					if(!empty($dataSend['link'])){
				    	$LinkInfo->link = $dataSend['link'];
					}
				    if(!empty($dataSend['namelink'])){
				    	$LinkInfo->namelink = $dataSend['namelink'];
					}
				    $LinkInfo->id_member = $checkPhone->id;
				    if(!empty($dataSend['type'])){
				    	$LinkInfo->type = @$dataSend['type'];
					}
				    if(!empty($dataSend['description'])){
				    	$LinkInfo->description = @$dataSend['description'];
					}
				    $modelLinkInfo->save($LinkInfo);

					$return = array('code'=>0, 'data'=>$LinkInfo, 'mess'=> 'Lưu thành công');
				}else{
					$return = array('code'=>4,
								'mess'=> 'Bạn không có quyền này'
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

function getTypeLink(){
	return typeLink();
}

function getLinstBank(){
	return listBank();
}

function deleteLinkInfoMemberAPI($input){
		global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelLinkInfo = $controller->loadModel('LinkInfos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$checkPhone = getMemberByToken($dataSend['token']);

			if(!empty($checkPhone)){
				if($checkPhone->type=='member'){
					$LinkInfo = $modelLinkInfo->find()->where(['id'=>(int)$dataSend['id'],'id_member'=>$checkPhone->id])->first();
					if(!empty($LinkInfo)){
						$modelLinkInfo->delete($LinkInfo);
						
						$return = array('code'=>0,'mess'=> 'Xóa Link thành công');
					}else{
						$return = array('code'=>4,
								'mess'=> 'Link này không tồn tại'
							);
					}
				}else{
					$return = array('code'=>5,
								'mess'=> 'Bạn không có quyền này'
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


function saveConfigNotificationAPI($input)
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
				if(isset($dataSend['noti_new_order'])){
					$checkPhone->noti_new_order = (int) $dataSend['noti_new_order'];
				}

				if(isset($dataSend['noti_new_customer'])){
					$checkPhone->noti_new_customer = (int) $dataSend['noti_new_customer'];
				}

				if(isset($dataSend['noti_checkin_campaign'])){
					$checkPhone->noti_checkin_campaign = (int) $dataSend['noti_checkin_campaign'];
				}

				if(isset($dataSend['noti_reg_campaign'])){
					$checkPhone->noti_reg_campaign = (int) $dataSend['noti_reg_campaign'];
				}

				if(isset($dataSend['noti_product_warehouse'])){
					$checkPhone->noti_product_warehouse = (int) $dataSend['noti_product_warehouse'];
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
	$modelStaff = $controller->loadModel('Staffs');

	$return = array('code'=>1,
					'mess'=> ''
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone'])){
			if(@$dataSend['type']=='staff'){
				$checkPhone = $modelStaff->find()->where(array('phone'=>$dataSend['phone']))->first();
			}else{
				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();
			}
			

			if(!empty($checkPhone->email)){
				$code = rand(1000,9999);

				$checkPhone->otp = $code;
				if(@$dataSend['type']=='staff'){
					$modelStaff->save($checkPhone);
				}else{
					$modelMember->save($checkPhone);
				}
				

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
	$modelStaff = $controller->loadModel('Staffs');

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
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'otp'=>$dataSend['code']))->first();
			$checkStaff = $modelStaff->find()->where(array('phone'=>$dataSend['phone'], 'otp'=>$dataSend['code']))->first();

			if(!empty($checkPhone)){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$checkPhone->otp = null;

						$checkPhone->token = '';
						//$checkPhone->token_web = createToken();

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>5,
										'mess'=>'Mật khẩu nhập lại không đúng'
									);
					}

			}elseif(!empty($checkStaff)){
				if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkStaff->password = md5($dataSend['passNew']);
						$checkStaff->otp = null;

						$checkStaff->token = '';
						//$checkPhone->token_web = createToken();

						$modelStaff->save($checkStaff);

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

		        		if(!empty($dataSend['phone_agency_introduce'])){

							$dataSend['phone_agency_introduce'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_agency_introduce']));
	        				$dataSend['phone_agency_introduce'] = str_replace('+84','0',$dataSend['phone_agency_introduce']);

	        				$conditions = ['phone'=>$dataSend['phone_agency_introduce']];
	        				$checkphoneagency = $modelMembers->find()->where($conditions)->first();

	        				if(!empty($checkphoneagency)){
		        				$data->id_agency_introduce = $checkphoneagency->id;
		        			}
						}
				        if(!empty($dataSend['name'])){
				        	$data->name = $dataSend['name'];
				        } 
				        if(!empty($dataSend['address'])){
				        $data->address = $dataSend['address'];
				         } 
				        if(!empty($dataSend['avatar'])){
				        $data->avatar = $dataSend['avatar'];
				         } 
				        if(!empty($dataSend['phone'])){
				        $data->phone = $dataSend['phone'];
				    	}
						$data->id_system = (int) $infoMember->id_system;
						 
				        if(!empty($dataSend['email'])){
						$data->email = $dataSend['email'];
						 } 
				        if(!empty($dataSend['birthday'])){
						$data->birthday = $dataSend['birthday'];
						 } 
				        if(!empty($dataSend['facebook'])){
						$data->facebook = $dataSend['facebook'];
						 } 
				        if(!empty($dataSend['create_agency'])){
						$data->create_agency = (!empty($dataSend['create_agency']))?$dataSend['create_agency']:'active';
						 } 
				        if(!empty($dataSend['id_position'])){
						$data->id_position = (int) $dataSend['id_position'];
						 } 
				        if(!empty($dataSend['linkedin'])){
						$data->linkedin = $dataSend['linkedin'];
						 } 
				        if(!empty($dataSend['web'])){
						$data->web = $dataSend['web'];
						 } 
				        if(!empty($dataSend['instagram'])){
						$data->instagram = $dataSend['instagram'];
						 } 
				        if(!empty($dataSend['zalo'])){
						$data->zalo = $dataSend['zalo'];
						 } 
				        if(!empty($dataSend['twitter'])){
						$data->twitter = $dataSend['twitter'];
						 } 
				        if(!empty($dataSend['tiktok'])){
						$data->tiktok = $dataSend['tiktok'];
						 } 
				        if(!empty($dataSend['youtube'])){
						$data->youtube = $dataSend['youtube'];
						 } 
				        if(!empty($dataSend['description'])){
						$data->description = $dataSend['description'];
						}
						

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
				 $return = array('code'=>3, 'mess'=>'Sai mã token');
			}
		}else{
			 $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

function saveInfoAgencyAjax($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

	if(!empty($session->read('infoUser'))){
		if($session->read('infoUser')->create_agency == 'lock'){
			return $controller->redirect('/listMember');
		}

		$metaTitleMantan = 'Thông tin đại lý tuyến dưới';

		$modelMembers = $controller->loadModel('Members');
		$modelZalos = $controller->loadModel('Zalos');

		$mess= '';

		$infoUser = $session->read('infoUser');
		
		$data = $modelMembers->newEmptyEntity();
		

		if ($isRequestPost) {
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
				$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$conditions = ['phone'=>$dataSend['phone']];
				$checkPhone = $modelMembers->find()->where($conditions)->first();

				if(empty($checkPhone) ){
					$system = $modelCategories->find()->where(['id'=>(int) $infoUser->id_system])->first();

					if(empty($dataSend['avatar'])){
						if(!empty($system->image)){
							$dataSend['avatar'] = $system->image;
						}

						if(empty($dataSend['avatar'])){
							$dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
						}
					}

	        		// tạo dữ liệu save
					$data->id_father = $infoUser->id;

					$data->name = $dataSend['name'];
					$data->address = $dataSend['address'];
					$data->avatar = $dataSend['avatar'];
					$data->phone = $dataSend['phone'];
					$data->id_system = (int) $infoUser->id_system;
					$data->email = $dataSend['email'];
					$data->birthday = $dataSend['birthday'];
					$data->id_position = (int) $dataSend['id_position'];
					

					if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
					$data->password = md5($dataSend['password']);

					$data->created_at = time();
					$data->deadline = time()+ 63072000; // 2 năm
					$data->status =  'active';
						
					if(empty($system->keyword)){
						$data->verify =  'lock';
						$data->otp =  rand(1000,9999);
						// gửi mã xác thức qua Zalo
						$zalo = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();
						if(!empty($zalo->access_token)){
							sendZNSZalo($zalo->template_otp, ['otp'=>$data->otp], $data->phone, $zalo->id_oa, $zalo->id_app);
						}
					}else{
						$data->verify =  'active';
						$data->otp = null;
					}
					$modelMembers->save($data);

					return array('code'=> 1 , 'mess'=> '<p class="text-success">Lưu dữ liệu thành công</p>','id_member_buy'=>$data->id,'member_buy'=>$data->name );

				}else{
					return array('code'=> 0 , 'mess'=> '<p class="text-danger">Số điện thoại này đã được sử dụng rồi</p>');
				}
			}else{
				return array('code'=> 0 , 'mess'=> '<p class="text-danger">Bạn không được để trống các trường bắt buộc</p>');
			}
		}else{
			return array('code'=> 0 , 'mess'=> '<p class="text-danger">Bạn không được để trống các trường bắt buộc</p>');
		}
	}else{
		return array('code'=> 0 , 'mess'=> '<p class="text-danger">Bạn chưa đăng nhập</p>');
	}
}

function NotificationCustomerHistories($input){

	global $controller;
	global $session;
	global $modelCategories;

	$modelCustomers = $controller->loadModel('Customers');
    $modelMembers = $controller->loadModel('Members');
   	$modelCustomerHistories = $controller->loadModel('CustomerHistories');

	$return = array('code'=>1);

	$listData = $modelMembers->find()->where(array('status'=>'active' ))->all()->toList();

	$current_time = time();
	$time_in_5_minutes  = $current_time+ (5 * 60);

	$conditions = array('status'=>'new');
	$conditions['time_now >='] = $current_time;

	$conditions['time_now <='] =$time_in_5_minutes;


	if(!empty($listData)){


		foreach($listData as $key => $item){
			$conditions['id_staff_now'] = $item->id;
			$historie = $modelCustomerHistories->find()->where($conditions)->first();
			if(!empty($historie)){
				debug($historie);
				if(!empty($session->read('infoUser')->noti_new_customer)){
                    $dataSendNotification= array('title'=>'Lịch hẹn','time'=>date('H:i d/m/Y'),'content'=>'Trong vòng 5 phúc nữa bạn có lịch hẹn','action'=>'addCustomer');
                   
                  		if(!empty($item->token_device)){
                            $return = sendNotification($dataSendNotification, $item->token_device);
                        }
                    }
                }
			}	
	}
	
}

function buyThemeInfo($input){
	global $controller;

	global $isRequestPost;
	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$user = $modelMembers->find()->where(['id'=>(int) $dataSend['idUser']])->first();
		$price = 0;
		if(!empty(listThemeInfo())){
            foreach(listThemeInfo() as $key => $item){
                if($dataSend['idTheme']==$item['id']) {
                	$price = $item['price'];
               	}
            }
        }

        if($price > $dataSend['price']){
        	return ['code'=> 0, 'mess'=>'Số tiền bạn không đủ '];
        }

		if(!empty($user)){
			$user->list_theme_info .= ','.$dataSend['idTheme'];
			$modelMembers->save($user);
			return ['code'=> 1, 'mess'=>'Mua tài khoản thành công'];
		}
		return ['code'=> 0, 'mess'=>'Tài khoản này không tồn tại'];

	}

	return ['code'=> 0, 'mess'=>'chuyền phương thức POST'];
}

function extendMemberAPI($input){
	global $controller;

	global $isRequestPost;
	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['phone']) && !empty($dataSend['deadline'])){

			$user = $modelMembers->find()->where(['phone'=>$dataSend['phone']])->first();

			if(!empty($user)){
				$date = explode("/", $dataSend['deadline']);
				$user->deadline =  mktime(23, 59, 59, $date[1], $date[0], $date[2]);
				$modelMembers->save($user);
				return ['code'=> 1, 'mess'=>'<p class="text-success">Tài khoản này gia hạn thành công</p>', 'data'=> $user];
			}
			return ['code'=> 0, 'mess'=>'<p class="text-danger"> số điện thoại này không tồn tại</p>'];
		}
		return ['code'=> 0, 'mess'=>'<p class="text-danger"> Thiếu dữ liệu</p>'];
	}

	return ['code'=> 0, 'mess'=>'<p class="text-danger"> chuyền phương thức POST</p>'];
}

function getInfoSystemAPI($input)
{
	global $modelCategories;


	$conditions = array('type' => 'system_sales');
    $data = $modelCategories->find()->where($conditions)->first();
     if(!empty($data->description)){
        $description = json_decode($data->description, true);
        $data->description = @$description;
        }
	$return = array('code'=>0,
				'data'=>$data,
				'mess'=> 'Bạn lấy dữ liệu thành công');
	
	
	
	return $return;
}
?>



