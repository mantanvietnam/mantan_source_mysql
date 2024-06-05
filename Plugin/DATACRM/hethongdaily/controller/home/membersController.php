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

	    		if($info_customer){
    				// nếu tài khoản không bị khóa
    				if($info_customer->status == 'active'){
    					$info_customer->info_system = $modelCategories->find()->where(['id'=>(int) $info_customer->id_system])->first();

		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');

		    			$session->write('infoUser', $info_customer);
		    			
		    			if($info_customer->verify == 'active'){
							return $controller->redirect('/listCustomerAgency');
						}else{
							return $controller->redirect('/verify');
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
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/listCustomerAgency');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();

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

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['avatar']) && !empty($dataSend['email'])){
				$user->name = $dataSend['name'];
				$user->avatar = $dataSend['avatar'];
				$user->email = $dataSend['email'];
				$user->address = $dataSend['address'];
				$user->birthday = $dataSend['birthday'];
				$user->facebook = $dataSend['facebook'];
				$user->twitter = $dataSend['twitter'];
				$user->tiktok = $dataSend['tiktok'];
				$user->youtube = $dataSend['youtube'];
				$user->web = (!empty($dataSend['web']))?$dataSend['web']:$urlHomes.'/info/?id='.$user->id;
				$user->instagram = $dataSend['instagram'];
				$user->linkedin = $dataSend['linkedin'];
				$user->description = $dataSend['description'];
				$user->zalo = $dataSend['zalo'];
				$user->banner = $dataSend['banner'];
				$user->display_info = $dataSend['display_info'];
				$user->image_qr_pay = $dataSend['image_qr_pay'];

				$modelMembers->save($user);

				$user->info_system = $modelCategories->find()->where(['id'=>(int) $user->id_system])->first();

				$session->write('infoUser', $user);

				$mess= '<p class="text-success">Đổi thông tin thành công</p>';
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		setVariable('mess', $mess);
		setVariable('user', $user);
		setVariable('displayInfo', $displayInfo);
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

	if(!empty($session->read('infoUser'))){
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

		$listData = $modelMembers->find()->where(['id_father'=>$session->read('infoUser')->id])->all()->toList();

		if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $listData[$key]->agentSystem = getTreeSystem($value->id, $modelMembers);
	        }
	    }

		setVariable('listData', $listData);
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

    if(!empty($session->read('infoUser'))){
    	if($session->read('infoUser')->create_agency == 'lock'){
			return $controller->redirect('/listMember');
		}

	    $metaTitleMantan = 'Thông tin đại lý tuyến dưới';

		$modelMembers = $controller->loadModel('Members');
		$modelZalos = $controller->loadModel('Zalos');

		$mess= '';

		$infoUser = $session->read('infoUser');

		// lấy data edit
		if(!empty($_GET['id'])){
			$data = $modelMembers->find()->where(['id'=>(int) $_GET['id'], 'id_father'=>$infoUser->id])->first();

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

	        		if(empty($dataSend['avatar'])){
	        			if(!empty($system->image)){
	        				$dataSend['avatar'] = $system->image;
	        			}

	        			if(empty($dataSend['avatar'])){
	        				$dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
	        			}
	        		}

	        		// tạo dữ liệu save
	        		if(empty($data->id_father)){
	        			$data->id_father = (!empty($_GET['id_father']))? (int) $_GET['id_father']:(int) $infoUser->id;
	        		}
			        
			        $data->name = $dataSend['name'];
			        $data->address = $dataSend['address'];
			        $data->avatar = $dataSend['avatar'];
			        $data->portrait = $dataSend['portrait'];
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
					

					if(empty($_GET['id'])){
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
						
					}else{
						if(!empty($dataSend['password'])){
				        	$data->password = md5($dataSend['password']);
				        }
					}

			        $modelMembers->save($data);

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
			    }
		    
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    $conditions = array('type' => 'system_positions', 'parent'=>$infoUser->id_system);
        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

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
    $session->write('infoUser', []);

	if(!empty($_GET['id'])){
		$info = $modelMembers->find()->where(['id'=>(int) $_GET['id'], 'status'=>'active', 'verify'=>'active'])->first();

		if(!empty($info)){
			if(empty($info->token)){
				$info->token = createToken();
			}

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
						$listProduct[$product->id_category]['product'][$product->id] = $product;
					}
				}

				setVariable('listProduct', $listProduct);
			}

			// lấy danh sách nhóm khách hàng
			$conditions = array('type' => 'group_customer', 'parent'=>$info->id);
        	$listGroupCustomer = $modelCategories->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
		
			setVariable('info', $info);
			setVariable('listGroupCustomer', $listGroupCustomer);
		}else{
			return $controller->redirect('/');
		}
	}else{
		return $controller->redirect('/');
	}
}
?>