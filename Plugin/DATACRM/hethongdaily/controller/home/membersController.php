<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

    $metaTitleMantan = 'Đăng nhập phần mềm quản lý đại lý';

    $modelMembers = $controller->loadModel('Members');
    $modelStaff = $controller->loadModel('Staffs');

    if(empty($session->read('infoUser'))){
    	$mess = '';

    	if(!empty($_GET['error'])){
    		switch ($_GET['error']) {
    			case 'account_lock':
    				$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
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
	    		$info_staff = $modelStaff->find()->where($conditions)->first();

	    		if(!empty($info_customer)){
    				// nếu tài khoản không bị khóa
    				if($info_customer->status == 'active'){
    					if($info_customer->deadline > time()){
    						$info_customer->last_login = time();
							$modelMembers->save($info_customer);
							
	    					$info_customer->info_system = $modelCategories->find()->where(['id'=>(int) $info_customer->id_system])->first();

			    			$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');

			    			$session->write('infoUser', $info_customer);
			    			
			    			if($info_customer->verify == 'active'){
			    				setcookie('id_member',$info_customer->id,time()+365*24*60*60, "/");

			    				if($info_customer->id_father==0){
			    					$dataPost= array('boss_phone'=>$info_customer->phone);
            							sendDataConnectMantan('https://icham.vn/apis/updateLastLoginBossAPI', $dataPost);
			    				}
								
								return $controller->redirect('/statisticAgency/?statusLogin=loginAccount');
							}else{
								return $controller->redirect('/verify');
							}
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}
	    		}elseif(!empty($info_staff)){
	    			if($info_staff->status == 'active'){
	    				$members = $modelMembers->find()->where(array('id'=>$info_staff->id_member))->first();


    					if($members->deadline > time()){
    						$info_staff->last_login = time();
							$modelStaff->save($info_staff);
							
	    					$info_staff->info_system = $modelCategories->find()->where(['id'=>(int) $members->id_system])->first();
	    					$info_staff->id_father = $members->id_father;
	    					$info_staff->create_order_agency = $members->create_order_agency;

			    			$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$members->id.'/');

			    			$session->write('infoStaff', $info_staff);
			    			

			    				setcookie('id_staff',$info_staff->id,time()+365*24*60*60, "/");

			    				if($members->id_father==0){
			    					$dataPost= array('boss_phone'=>$members->phone);
            							sendDataConnectMantan('https://icham.vn/apis/updateLastLoginBossAPI', $dataPost);
			    				}
								
								return $controller->redirect('/statisticAgency/?statusLogin=loginAccount');
							
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}

	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }elseif(!empty($_COOKIE['id_member'])){
    		$conditions = array('id'=>(int) $_COOKIE['id_member']);
    		$info_customer = $modelMembers->find()->where($conditions)->first();

    		if(!empty($info_customer)){
				// nếu tài khoản không bị khóa
				if($info_customer->status == 'active'){
					if($info_customer->deadline > time()){
						$info_customer->last_login = time();
						$modelMembers->save($info_customer);

						$info_customer->info_system = $modelCategories->find()->where(['id'=>(int) $info_customer->id_system])->first();

		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');

		    			$session->write('infoUser', $info_customer);
		    			if($info_customer->id_father==0){
			    			$dataPost= array('boss_phone'=>$info_customer->phone);
            					sendDataConnectMantan('https://icham.vn/apis/updateLastLoginBossAPI', $dataPost);
			    		}
		    			
		    			if($info_customer->verify == 'active'){
							return $controller->redirect('/statisticAgency/?statusLogin=loginCookie');
						}else{
							return $controller->redirect('/verify');
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
					}
				}else{
					$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
				}
    		}
    	}elseif(!empty($_COOKIE['id_staff'])){
    		$conditions = array('id'=>(int) $_COOKIE['id_staff']);
    		$info_staff = $modelStaff->find()->where($conditions)->first();
    		$members = $modelMembers->find()->where(array('id'=>$info_staff->id_member))->first();

    		if(!empty($info_staff)){
				// nếu tài khoản không bị khóa
				if($members->status == 'active'){
					if($members->deadline > time()){
						$info_staff->last_login = time();
						$modelStaff->save($info_staff);

						$info_staff->info_system = $modelCategories->find()->where(['id'=>(int) $info_staff->id_system])->first();
						$info_staff->id_father = $members->id_father;
	    				$info_staff->create_order_agency = $members->create_order_agency;
		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$members->id.'/');

		    			$session->write('infoStaff', $info_staff);
		    			if($members->id_father==0){
			    			$dataPost= array('boss_phone'=>$members->phone);
            					sendDataConnectMantan('https://icham.vn/apis/updateLastLoginBossAPI', $dataPost);
			    		}
		    			
						return $controller->redirect('/statisticAgency/?statusLogin=loginCookie');
					
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
					}
				}else{
					$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
				}
    		}
    	}


	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/statisticAgency/?statusLogin=loginDone');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();
	setcookie('id_member','',time()+365*24*60*60, "/");
	setcookie('id_staff','',time()+365*24*60*60, "/");

	return $controller->redirect('/login');
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
					$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);

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
	global $modelCategories;
	global $urlHomes;
	global $displayInfo;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');
	$modelSetingThemeInfo = $controller->loadModel('SetingThemeInfos');
	$modelLinkInfo = $controller->loadModel('LinkInfos');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();
		$boss = $modelMembers->find()->where(['id_father'=>0])->first();
		$dataLink = $modelLinkInfo->find()->where(['id_member'=>$user->id])->all()->toList();

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['email'])){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($user->id, 'avatar', 'avatar_'.$user->id);
				}

				if(isset($_FILES['banner']) && empty($_FILES['banner']["error"])){
					$banner = uploadImage($user->id, 'banner', 'banner_'.$user->id);
				}

				if(!empty($avatar['linkOnline'])){
					$user->avatar = $avatar['linkOnline'].'?time='.time();
				}else{
					if(empty($user->avatar)){
						$user->avatar = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
					}
				}

				if(!empty($banner['linkOnline'])){
					$user->banner = $banner['linkOnline'].'?time='.time();
				}

				$user->name = $dataSend['name'];
				$user->email = $dataSend['email'];
				$user->address = $dataSend['address'];
				$user->birthday = $dataSend['birthday'];
				$user->facebook = $dataSend['facebook'];
				$user->twitter = $dataSend['twitter'];
				$user->agent_commission = (int) $dataSend['agent_commission'];
				$user->tiktok = $dataSend['tiktok'];
				if($user->id_father == 0){
                	$user->id_position = (int) $dataSend['id_position'];
				}
				$user->youtube = $dataSend['youtube'];
				$user->web = (!empty($dataSend['web']))?$dataSend['web']:$urlHomes.'/info/?id='.$user->id;
				$user->instagram = $dataSend['instagram'];
				$user->linkedin = $dataSend['linkedin'];
				$user->description = $dataSend['description'];
				$user->zalo = $dataSend['zalo'];
				$user->image_qr_pay = '';
				$user->bank_number = $dataSend['bank_number'];
				$user->bank_name = $dataSend['bank_name'];
				$user->bank_code = $dataSend['bank_code'];

				if(!empty($user->bank_number) && !empty($user->bank_name) && !empty($user->bank_code)){
					$user->image_qr_pay = 'https://img.vietqr.io/image/'.$user->bank_code.'-'.$user->bank_number.'-compact2.png?amount=&addInfo=&accountName='.$user->bank_name;
				}

				$modelMembers->save($user);

				
				$user->info_system = $modelCategories->find()->where(['id'=>(int) $user->id_system])->first();

				
		        	$conditions = ['id_member'=>$user->id];
		        	$modelLinkInfo->deleteAll($conditions);
		        if(!empty($dataSend['link'])){
		        	foreach ($dataSend['link'] as $key => $link) {
		        		if(!empty($link)){
			        		$LinkInfo = $modelLinkInfo->newEmptyEntity();
			        		$LinkInfo->link = $link;
			        		$LinkInfo->namelink = $dataSend['namelink'][$key];
			        		$LinkInfo->id_member = $user->id;
			        		$LinkInfo->type = @$dataSend['type'][$key];
			        		$LinkInfo->description = @$dataSend['descriptionlink'][$key];
			        		$modelLinkInfo->save($LinkInfo);
			        	}
		        	}
		        }

				$session->write('infoUser', $user);

				$dataLink = $modelLinkInfo->find()->where(['id_member'=>$user->id])->all()->toList();



				$mess= '<p class="text-success">Đổi thông tin thành công</p>';
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		$conditions = array('type' => 'system_positions', 'parent'=>(int) $user->id_system, 'status'=>'active');
        $position = $modelCategories->find()->where($conditions)->all()->toList();

		setVariable('mess', $mess);
		setVariable('user', $user);
		setVariable('boss', $boss);
		setVariable('position', $position);
		setVariable('displayInfo', $displayInfo);
		setVariable('dataLink', $dataLink);
		setVariable('modelSetingThemeInfo', $modelSetingThemeInfo);
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
			$checkMember->otp = rand(1000,9999);
			
			$modelMembers->save($checkMember);
			sendEmailnewpassword($checkMember->email, $checkMember->name, $checkMember->otp);
			
			$session->write('phone', $checkMember->phone);
			
			return $controller->redirect('/confirm');


		}else{
			$mess= '<p class="text-danger">Số điện thoại không đúng!</p>';
		}
		setVariable('mess', $mess);
	}
}

function confirm($input)
{

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$phone = $session->read('phone');

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'otp'=>(int)$dataSend['code']);
		$data = $modelMembers->find()->where($conditions)->first();
		if(!empty($data)){
			if($dataSend['pass'] == $dataSend['passAgain']){
				$data->password = md5($dataSend['pass']);

				$modelMembers->save($data);
				$session->destroy();
	    			
				return $controller->redirect('/login');		

			}else{
				$mess= '<p class="text-danger">Mật khẩu xác nhận của bạn không đúng</p>';
			}
		}else{
			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
		}

	    setVariable('mess', $mess);
	}

}

function listMember($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Danh sách đại lý tuyến dưới';

	$modelMembers = $controller->loadModel('Members');

	$user = checklogin('listMember');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
		$mess = '';
		if(!empty($_GET['status'])){
			switch($_GET['status']){
				case 'done':
					$mess= '<p class="text-success">Thay đổi trạng thái tài khoản đại lý thành công</p>';
					break;

				case 'verify':
					$mess= '<p class="text-success">Xác thực tài khoản đại lý thành công</p>';
					break;

				case 'deadline':
					$mess= '<p class="text-danger">Không thể kích hoạt tài khoản đại lý do chưa đóng phí duy trì</p>';
					break;

				case 'father':
					$mess= '<p class="text-danger">Bạn không phải quản lý của tài khoản đại lý này</p>';
					break;

				case 'empty':
					$mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
					break;

				case 'error_otp':
					$mess= '<p class="text-danger">Nhập sai mã OTP</p>';
					break;
			}
		}

		$listData = $modelMembers->find()->where(['id_father'=>$user->id, 'status !='=>'delete'])->all()->toList();

		if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $listData[$key]->agentSystem = getTreeSystem($value->id, $modelMembers);
	        }
	    }
	    
		setVariable('listData', $listData);
		setVariable('user', $user);
		setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function addMember($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('addMember');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listMember');
        }

	    $metaTitleMantan = 'Thông tin đại lý tuyến dưới';

		$modelMembers = $controller->loadModel('Members');
		$modelZalos = $controller->loadModel('Zalos');

		$mess= '';

		$infoUser = $session->read('infoUser');

		// lấy data edit
		if(!empty($_GET['id'])){
			$data = $modelMembers->find()->where(['id'=>(int) $_GET['id']])->first();

			if(empty($data)){
				return $controller->redirect('/listMember');
			}
		}else{
			$data = $modelMembers->newEmptyEntity();
		}

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
	        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
	        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	        	$conditions = ['phone'=>$dataSend['phone']];
	        	$checkPhone = $modelMembers->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
	        		$system = $modelCategories->find()->where(['id'=>(int) $infoUser->id_system])->first();
	        		$user = $session->read('infoUser');

	        		if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
	        			if(!empty($data->id)){
	                        $fileName = 'avatar_'.$data->id;
	                    }else{
	                        $fileName = 'avatar_'.time().rand(0,1000000);
	                    }

						$avatar = uploadImage($user->id, 'avatar', $fileName);
					}

					if(!empty($avatar['linkOnline'])){
						$data->avatar = $avatar['linkOnline'].'?time='.time();
					}else{
						if(empty($data->avatar)){
							if(!empty($system->image)){
		        				$data->avatar = $system->image;
		        			}

		        			if(empty($data->avatar)){
		        				$data->avatar = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
		        			}
						}
					}

					if(isset($_FILES['portrait']) && empty($_FILES['portrait']["error"])){
						if(!empty($data->id)){
	                        $fileName = 'portrait_'.$data->id;
	                    }else{
	                        $fileName = 'portrait_'.time().rand(0,1000000);
	                    }

						$portrait = uploadImage($user->id, 'portrait', $fileName);
					}

					if(!empty($portrait['linkOnline'])){
						$data->portrait = $portrait['linkOnline'].'?time='.time();
					}

	        		// tạo dữ liệu save
	        		if(empty($data->id_father)){
	        			$data->id_father = (!empty($_GET['id_father']))? (int) $_GET['id_father']:(int) $infoUser->id;
	        		}
			        
			        $data->name = $dataSend['name'];
			        $data->address = $dataSend['address'];
			        $data->phone = $dataSend['phone'];
					$data->id_system = (int) $infoUser->id_system;
					$data->email = $dataSend['email'];
					$data->birthday = $dataSend['birthday'];
					$data->facebook = $dataSend['facebook'];
					$data->create_agency = $dataSend['create_agency'];
					$data->id_position = (int) $dataSend['id_position'];
					$data->linkedin = $dataSend['linkedin'];
					$data->web = $dataSend['web'];
					$data->instagram = $dataSend['instagram'];
					$data->zalo = $dataSend['zalo'];
					$data->twitter = $dataSend['twitter'];
					$data->tiktok = $dataSend['tiktok'];
					$data->youtube = $dataSend['youtube'];
					$data->description = $dataSend['description'];

					if(!empty($dataSend['phone_agency'])){

						$dataSend['phone_agency'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_agency']));
	        			$dataSend['phone_agency'] = str_replace('+84','0',$dataSend['phone_agency']);

	        			$conditions = ['phone'=>$dataSend['phone_agency']];
	        			$checkphoneagency = $modelMembers->find()->where($conditions)->first();

	        			if(!empty($checkphoneagency)){
	        				$data->id_agency_introduce = $checkphoneagency->id;
	        			}
					}
					

					if(empty($_GET['id'])){
						if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
						$data->password = md5($dataSend['password']);

						$data->created_at = time();
						$data->deadline = time(); // 2 năm
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
						
					}else{
						if(!empty($dataSend['password'])){
				        	$data->password = md5($dataSend['password']);
				        }
					}

			        $modelMembers->save($data);

			        if(!empty($_GET['id'])){
                        $note = $user->type_tv.' '. $user->name.' sửa thông tin đại lý '.$data->name.'('.$data->phone.') có id đơn là:'.$data->id;
                    }else{
                        $note = $user->type_tv.' '. $user->name.' tạo đại lý '.$data->name.'('.$data->phone.') có id đơn là:'.$data->id;
                    }
                    addActivityHistory($user,$note,'addMember',$data->id);

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
			    }
		    
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    $conditions = array('type' => 'system_positions', 'parent'=>$infoUser->id_system, 'status'=>'active');
        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

        if(!empty($data->id_agency_introduce)){
	        $conditions = ['id'=>$data->id_agency_introduce];
	        $checkidagency = $modelMembers->find()->where($conditions)->first();
			if(!empty($checkidagency)){
	        	$data->phone_agency = $checkidagency->phone;
			}
		}
	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listPositions', $listPositions);
	}else{
		return $controller->redirect('/login');
	}
}

function updateStatusMember($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
    	$modelMembers = $controller->loadModel('Members');

    	if(!empty($_GET['id']) && !empty($_GET['status'])){
    		$checkMember = $modelMembers->find()->where(['id'=>(int) $_GET['id']])->first();

    		if(!empty($checkMember) && $checkMember->id_father == $session->read('infoUser')->id){
    			if($_GET['status']=='lock' || $checkMember->deadline > time()){
    				$checkMember->status = $_GET['status'];
    				
    				$modelMembers->save($checkMember);

    				return $controller->redirect('/listMember/?status=done');
    			}else{
    				return $controller->redirect('/listMember/?status=deadline');
    			}
    		}else{
    			return $controller->redirect('/listMember/?status=father');
    		}
    	}else{
    		return $controller->redirect('/listMember/?status=empty');
    	}
    }else{
		return $controller->redirect('/login');
	}
}

function verifyMember($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
    	$modelMembers = $controller->loadModel('Members');

    	if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['idMemberVerify']) && !empty($dataSend['otp'])){
	        	$checkPhone = $modelMembers->find()->where(['id'=>(int) $dataSend['idMemberVerify'], 'otp'=>(int) $dataSend['otp']])->first();

	        	if(!empty($checkPhone)){
	        		$checkPhone->otp = null;
	        		$checkPhone->verify =  'active';

	        		$modelMembers->save($checkPhone);

	        		return $controller->redirect('/listMember/?status=verify');
	        	}else{
	        		return $controller->redirect('/listMember/?status=error_otp');
	        	}
	        }else{
	        	return $controller->redirect('/listMember/?status=empty');
	        }
	    }

	    return $controller->redirect('/listMember');
    }else{
		return $controller->redirect('/login');
	}
}

function verify($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
    	$modelMembers = $controller->loadModel('Members');

    	$infoUser = $session->read('infoUser');
    	$mess = '';

    	if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['otp'])){
	        	$checkPhone = $modelMembers->find()->where(['id'=>(int) $infoUser->id, 'otp'=>(int) $dataSend['otp']])->first();

	        	if(!empty($checkPhone)){
	        		$checkPhone->otp = null;
	        		$checkPhone->verify =  'active';

	        		$modelMembers->save($checkPhone);

	        		$session->write('infoUser', $checkPhone);

	        		return $controller->redirect('/listMember/?status=verify');
	        	}else{
	        		$mess= '<p class="text-danger">Nhập sai mã xác thực</p>';
	        	}
	        }else{
	        	$mess= '<p class="text-danger">Chưa nhập mã xác thực</p>';
	        }
	    }

	    setVariable('mess', $mess);
	    setVariable('infoUser', $infoUser);
    }else{
		return $controller->redirect('/login');
	}
}

function info($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $metaImageMantan;
    global $metaDescriptionMantan;
    global $session;
    global $urlHomes;

    $modelMembers = $controller->loadModel('Members');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    
	$modelSetingThemeInfo = $controller->loadModel('SetingThemeInfos');
	$modelLinkInfo = $controller->loadModel('LinkInfos');

    $session->write('infoUser', []);

	if(!empty($_GET['id'])){
		$info = $modelMembers->find()->where(['id'=>(int) $_GET['id'], 'status'=>'active', 'verify'=>'active'])->first();

		if(!empty($info)){
			if(empty($info->token)){
				$info->token = createToken();
			}


			$dataLink = $modelLinkInfo->find()->where(['id_member'=>$info->id])->all()->toList();

			$metaTitleMantan = $info->name;
			$metaImageMantan = (!empty($info->banner))?$info->banner:$info->avatar;
			
			if(!empty($info->description)){
				$metaDescriptionMantan = strip_tags($info->description);
			}

			// tăng lượt xem
			$info->view ++;
			$modelMembers->save($info);
			$info->view += 1000;

			$position = $modelCategories->find()->where(array('id'=>$info->id_position))->first();
			$system = $modelCategories->find()->where(array('id'=>$info->id_system ))->first();
				
			$info->name_position = @$position->name;
			$info->name_system = @$system->name;
			$info->image_system = @$system->image;

			if($info->id_father == 0 && empty($info->name_position)){
				$info->name_position = 'CO-FOUNDER';
			}

			if(function_exists('getAllProductActive')){
				// lấy sản phẩm trong kho
				$conditions = array('id_member'=>$info->id);
				$warehouseProduct = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
				
				if(empty($warehouseProduct)){
					$allProduct = getAllProductActive();
				}else{
					$allProduct = [];
					foreach ($warehouseProduct as $product) {
						if($product->quantity > 0){
							$infoProduct = getProduct($product->id_product);

							if(!empty($infoProduct)){
								$allProduct[] = $infoProduct;
							}
						}
					}
				}

				$allCategoryProduct = getAllCategoryProduct();
				$listProduct = [];

				if(!empty($allCategoryProduct)){
					foreach ($allCategoryProduct as $category) {
						$listProduct[$category->id]['category'] = $category;
					}
				}

				if(!empty($allProduct)){
					foreach ($allProduct as $product) {
						if(empty($product->price_agency)){
               				$product->price_agency = $product->price; 
            			}

						$listProduct[$product->id_category]['product'][$product->id] = $product;

						
					}
				}
				
				setVariable('listProduct', $listProduct);
			}

			// lấy danh sách nhóm khách hàng
			$conditions = array('type' => 'group_customer', 'parent'=>$info->id);
        	$listGroupCustomer = $modelCategories->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

        	// lấy danh sách chức danh
        	$listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$info->id_system, 'status'=>'active'])->all()->toList();
		
			setVariable('info', $info);
			setVariable('dataLink', $dataLink);
			setVariable('listGroupCustomer', $listGroupCustomer);
			setVariable('modelSetingThemeInfo', $modelSetingThemeInfo);
			setVariable('listPositions', $listPositions);
		}else{
			return $controller->redirect('/');
		}
	}else{
		return $controller->redirect('/');
	}
}

function useThemeInfo($input){

	global $session;
	global $controller;
	global $metaTitleMantan;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();
		$user->display_info = $_GET['id'];


		$modelMembers->save($user);
		
		return $controller->redirect('/account');


	}else{
		return $controller->redirect('/login');
	}

}

function editThemeinfo($input){
	global $session;
	global $controller;
	global $metaTitleMantan;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');
	$modelSetingThemeInfo = $controller->loadModel('SetingThemeInfos');

	if(!empty($session->read('infoUser'))){
		$dataSend = $input['request']->getData();
	
		$user = $session->read('infoUser');
		$data = $modelSetingThemeInfo->find()->where(['id_theme'=>(int)$dataSend['id_theme'],'id_member'=>$user->id])->first();
		$image_background = '';
		
		if(empty($data)){
			$data = $modelSetingThemeInfo->newEmptyEntity();
			$data->id_theme = (int) @$dataSend['id_theme'];
			$data->id_member = $user->id;
		}else{
			$data_value = array();
    		if(!empty($data->config)){
    		    $data_value = json_decode($data->config, true);
    		}
    		if(!empty($data_value['image_background'])){
    			$image_background = @$data_value['image_background'];
    		}
		}

		if(isset($_FILES['image_background']) && empty($_FILES['image_background']["error"])){
			$background = uploadImage($user->id, 'image_background', 'image_background_'.$data->id_theme);
		}
		
		if(!empty($background['linkOnline'])){
			$image_background = @$background['linkOnline'].'?time='.time();
		}
		$value = array('background_color1'=>$dataSend['background_color1'],
				'background_color2'=>$dataSend['background_color2'],
				'text_color_name'=>$dataSend['text_color_name'],
				'text_color_Jobtitle'=>$dataSend['text_color_Jobtitle'],
				'text_color_address'=>$dataSend['text_color_address'],
				'image_background'=>$image_background,
				);
		 $data->config = json_encode($value);

		 $modelSetingThemeInfo->save($data);	

		return $controller->redirect('/account');


	}else{
		return $controller->redirect('/login');
	}
}
?>
