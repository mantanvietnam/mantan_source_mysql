<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$metaTitleMantan = 'Đăng nhập công cụ phầm mềm quản lý SPA';

	$modelMembers = $controller->loadModel('Members');

    setVariable('page_view', 'login');
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
	    			// nếu đây là nhân viên
					if($info_customer->type == 0){
						$info_member = $modelMembers->find()->where(array('id'=>$info_customer->id_member, 'type'=>1))->first();

						// lấy tình trạng tài khoản của nhân viên theo chủ spa
						$info_customer->dateline_at = $info_member->dateline_at;
						$info_customer->status = $info_member->status;
						$info_customer->module = json_decode($info_member->module, true);
					}

	    			// còn hạn sử dụng
					if($info_customer->dateline_at >= time()){

	    				// nếu tài khoản không bị khóa
						if($info_customer->status == 1){
							$info_customer->last_login = time();
							
							if(is_array($info_customer->module)){
								$info_customer->module = json_encode($info_customer->module);
							}
							
							$modelMembers->save($info_customer);

							if(is_string($info_customer->module)){
								$info_customer->module = json_decode($info_customer->module, true);
							}
							
			    			// nếu là chủ spa
							if($info_customer->type == 1){
								$info_customer->id_member = $info_customer->id;

								if(is_string($info_customer->module)){
									$info_customer->module = json_decode($info_customer->module, true);
								}
							}

							if(!empty($info_customer->permission) && is_string($info_customer->permission)){
								$info_customer->list_permission = json_decode($info_customer->permission,true);
							}

							$session->write('CheckAuthentication', true);
							$session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id_member.'/');

							$session->write('infoUser', $info_customer);

							return $controller->redirect('/managerSelectSpa');
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn</p>';
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
	
    setVariable('page_view', 'dashboard');
	if(!empty($session->read('infoUser'))){
		$user = $session->read('infoUser');
		$conditBill['type'] = 0;
		$conditBill['id_member'] = $user->id_member;
		$conditBill['id_spa'] = $user->id_spa;
		$modelBill = $controller->loadModel('Bills');
		$order = array('created_at'=>'asc');
        $modelOrder = $controller->loadModel('Orders');
        $modelBook = $controller->loadModel('Books');

		$listDataBill = $modelBill->find()->where($conditBill)->order($order)->all()->toList();

		$conditionproduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'),'type'=>'product' ,'time >='=> strtotime(date("Y-m-d 00:00:00")));
		$totalOrderproduct = count($modelOrder->find()->where($conditionproduct)->all()->toList());

		$conditioncombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'),'type'=>'combo' ,'time >='=> strtotime(date("Y-m-d 00:00:00")));
		$totalOrderCombo = count($modelOrder->find()->where($conditioncombo)->all()->toList());

		$conditionServicet = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'),'type'=>'service' ,'time >='=> strtotime(date("Y-m-d 00:00:00")));
		$totalOrderService = count($modelOrder->find()->where($conditionServicet)->all()->toList());

		$conditionbook = array('Books.id_member'=>$user->id_member, 'Books.id_spa'=>$session->read('id_spa') ,'Books.time_book >='=> strtotime(date("Y-m-d 00:00:00")));

		$listBooking = $modelBook
	    			->find()
	    			->select([
			            'Books.id',
			            'Books.name',
			            'Books.time_book',
			            'Books.status',
			            'Books.repeat_book',
			            'Books.apt_times',
			            'Books.apt_step',
			            'Services.name',
			            'Members.name',
			            'Members.id',
			            'Beds.name',
			        ])
	    			->join([
				            [
				                'table' => 'services',
				                'alias' => 'Services',
				                'type' => 'LEFT',
				                'conditions' => [
				                    'Books.id_service = Services.id',
				                ],
				            ],
				            [
				                'table' => 'members',
				                'alias' => 'Members',
				                'type' => 'LEFT',
				                'conditions' => [
				                    'Books.id_staff = Members.id',
				                ],
				            ],
				            [
				                'table' => 'beds',
				                'alias' => 'Beds',
				                'type' => 'LEFT',
				                'conditions' => [
				                    'Books.id_bed = Beds.id',
				                ],
				            ],
				        ])
	    			->where($conditionbook)->all()->toList();

		$totalbook = count($listBooking);


		
		$total = 0;

		$dayDataBill= array();

		if(!empty($listDataBill)){
			foreach ($listDataBill as $item) {
				$time= @$item->created_at;
				$time = strtotime($time);
				$todayTime= getdate($time);

	                      // tính doanh thu theo ngày
				@$dayTotalBill[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += $item->total;
				$total += $item->total; 

			}

			if(!empty($dayTotalBill)){
				foreach($dayTotalBill as $key=>$item){
	                $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
	                $dayDataBill[]= array('time'=>$time , 'value'=>$item );
	            }
	        }
	    }
	    setVariable('dayDataBill', $dayDataBill);
	    setVariable('totalOrderproduct', $totalOrderproduct);
	    setVariable('totalOrderService', $totalOrderService);
	    setVariable('totalOrderCombo', $totalOrderCombo);
	    setVariable('totalbook', $totalbook);
	    setVariable('listBooking', $listBooking);
	    setVariable('total', $total);
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

    setVariable('page_view', 'changePass');
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

						$modelMembers->save($user);

					// nếu là chủ spa
						if($user->type == 1){
							$user->id_member = $user->id;
						}

						$session->write('infoUser', $user);
						return $controller->redirect('/managerSelectSpa');

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

    setVariable('page_view', 'account');
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
				$user->module = json_decode($user->module, true);
				// nếu là chủ spa
				if($user->type == 1){
					$user->id_member = $user->id;
				}
				$session->write('infoUser', $user);
				return $controller->redirect('/managerSelectSpa');
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

function forgotPass($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$metaTitleMantan = 'Quên mật khẩu';

	$modelMembers = $controller->loadModel('Members');

    setVariable('page_view', 'forgotPass');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions['phone'] = $dataSend['phone'];
		$checkMember = $modelMembers->find()->where($conditions)->first();
		if(!empty($checkMember)){
			$pass = rand(100000,999999);
			$checkMember->code_otp = $pass;
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

function confirm($input)
{

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$phone = $session->read('phone');

    setVariable('page_view', 'confirm');
	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'code_otp'=>$dataSend['code']);
		$data = $modelMembers->find()->where($conditions)->first();
		if(!empty($data)){
			if($dataSend['pass'] == $dataSend['passAgain']){
				$data->password = md5($dataSend['pass']);
				$data->code_otp = rand(100000, 999999);
				$modelMembers->save($data);
				$session->destroy();
				return $controller->redirect('/login');		
			}else{
				$mess= '<p class="text-danger">Mật khẩu nhập lại không đúng</p>';
			}
		}else{
			$mess= '<p class="text-danger">Mã xác thực của bạn không đúng</p>';
		}
		setVariable('mess', $mess);
	}
}


function register($input){
		global $isRequestPost;
		global $controller;
		global $session;
		global $urlHomes;

		$modelMember = $controller->loadModel('Members');
		$modelSpas = $controller->loadModel('Spas');
		$modelWarehouse = $controller->loadModel('Warehouses');
		$mess = '';
    setVariable('page_view', 'register');

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
			$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

			if(!empty($dataSend['name_spa']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

				if(empty($checkPhone)){
					if($dataSend['password'] == $dataSend['password_again']){
						// tạo người dùng mới
						$data = $modelMember->newEmptyEntity();

						$data->name = $dataSend['name_spa'].' (chủ)';
						$data->avatar = 'https://spa.databot.vn/plugins/databot_spa/view/home/assets/img/avatar-default.png';
						$data->phone = $dataSend['phone'];
						$data->email = @$dataSend['email'];
						$data->password = md5($dataSend['password']);
						$data->status = 1; //1: kích hoạt, 0: khóa
						$data->type = 1; // 0: nhân viên, 1: chủ spa
						$data->id_member = 0;
						$data->created_at = time();
						$data->updated_at = time();
						$data->last_login = time();
						$data->dateline_at = strtotime("+30 days", time());
						$data->number_spa = 1;
						$data->address = $dataSend['address'];
						$data->code_otp = rand(100000, 999999);
						$data->module = '["customer","staff","calendar","room","product","prepaid_cards","combo","bill","static"]';

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
						sendEmailRegAcc($data->email, $data->name, $data->phone, $dataSend['password']);

						$mess = '<p class="text-success">Đăng ký phần mền quản lý SPA thành công</p>';

						// thực hiện đăng nhập tự động
						$data->id_member = $data->id;
						$data->list_permission = [];

						if(is_string($data->module)){
							$data->module = json_decode($data->module, true);
						}

						$session->write('CheckAuthentication', true);
						$session->write('urlBaseUpload', '/upload/admin/images/'.$data->id_member.'/');

						$session->write('infoUser', $data);

						return $controller->redirect('/managerSelectSpa');
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

function managerSelectSpa() {
	global $controller;
	global $isRequestPost;
	global $urlHomes;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');

	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');
		$mess= '';

		$dataList = $modelSpas->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

		if(!empty($dataList)){
			$totalData = count($dataList);
			if($totalData > 1){
				if ($isRequestPost) {
					if (!empty($_POST['idspa'])) {
						$hotel= $modelSpas->get($_POST['idspa']);

						if(!empty($hotel)){
							$infoUser->id_spa = $_POST['idspa'];

							$session->write('infoUser', @$infoUser);
							$session->write('id_spa', $_POST['idspa']);

							return $controller->redirect('/dashboard');
						}
					}
				} 

				setVariable('mess', $mess);
				setVariable('dataList', $dataList);
			}else{
				$data = $modelSpas->find()->where(array('id_member'=>$infoUser->id_member))->first();

				$infoUser->id_spa = $data->id;
				$session->write('infoUser', @$infoUser);
				$session->write('id_spa', $data->id);

				return $controller->redirect('/dashboard');
			}
		}else{
			return $controller->redirect('/addSpa');
		}
	}else{
		return $controller->redirect('/login');
	}
}

function error_permission($input)
{

}
?>