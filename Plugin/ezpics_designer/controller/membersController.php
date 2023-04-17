<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập công cụ thiết kế cho Designer - Ezpics';

    $modelMembers = $controller->loadModel('Members');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
	    		$info_customer = $modelMembers->find()->where($conditions)->first();

	    		if($info_customer){
	    			if($info_customer->type == 1){
	    				if($info_customer->status == 1){
			    			if(empty($info_customer->token)){
			    				$info_customer->token = createToken(25);

			    				$modelMembers->save($info_customer);
			    			}

			    			$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');

			    			$session->write('infoUser', $info_customer);
			    			
							return $controller->redirect('/dashboard');
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
						}
					}else{
						$mess= '<p class="text-danger">Bạn chưa đăng ký để trở thành Designer</p>';
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
		return $controller->redirect('/dashboard');
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

	$modelProduct = $controller->loadModel('Products');
	$modelOrder = $controller->loadModel('Orders');

	if(!empty($session->read('infoUser'))){
		$conditions = array('user_id'=>$session->read('infoUser')->id, 'type'=>'user_create', 'status'=>1);
		$limit = 5;
		$page = 1;

		// mẫu thiết kế nhiều lượt xem nhất
		$order = array('views'=>'desc', 'id'=>'desc');

		$listTopView = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		// mẫu thiết kế nhiều lượt thích nhất
		$order = array('favorites'=>'desc', 'id'=>'desc');

		$listTopFavorite = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		// mẫu thiết kế nhiều lượt mua nhất
		$order = array('sold'=>'desc', 'id'=>'desc');

		$listTopSell = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		// mẫu mới 7 ngày
		$conditions = array('user_id'=>$session->read('infoUser')->id,'created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'type'=>'user_create', 'status'=>1);

		$products = $modelProduct->find()->where($conditions)->all()->toList();
		$countProductNew = count($products);

		// mẫu mới 14 ngày
		$conditions = array('user_id'=>$session->read('infoUser')->id,
							'created_at <' => date('Y-m-d H:i:s', strtotime("-7 day")),
							'created_at >=' => date('Y-m-d H:i:s', strtotime("-14 day")), 
							'type'=>'user_create', 
							'status'=>1);

		$products = $modelProduct->find()->where($conditions)->all()->toList();
		$countProductOld = count($products);

		// doanh thu 7 ngày
		$conditions = array('member_id'=>$session->read('infoUser')->id,'created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'type'=>3, 'status'=>2);

		$orders = $modelOrder->find()->where($conditions)->all()->toList();
		$countOrderNew = 0;
		if(!empty($orders)){
			foreach ($orders as $key => $value) {
				$countOrderNew += $value->total;
			}
		}

		// doanh thu 14 ngày
		$conditions = array('member_id'=>$session->read('infoUser')->id,
							'created_at <' => date('Y-m-d H:i:s', strtotime("-7 day")), 
							'created_at >=' => date('Y-m-d H:i:s', strtotime("-14 day")), 
							'type'=>3, 
							'status'=>2);

		$orders = $modelOrder->find()->where($conditions)->all()->toList();
		$countOrderOld = 0;
		if(!empty($orders)){
			foreach ($orders as $key => $value) {
				$countOrderOld += $value->total;
			}
		}

		setVariable('listTopView', $listTopView);
		setVariable('listTopFavorite', $listTopFavorite);
		setVariable('listTopSell', $listTopSell);
		setVariable('countProductNew', $countProductNew);
		setVariable('countProductOld', $countProductOld);
		setVariable('countOrderNew', $countOrderNew);
		setVariable('countOrderOld', $countOrderOld);
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
?>