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

    	if(!empty($_GET['error'])){
    		switch ($_GET['error']) {
    			case 'account_lock':
    				$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
    				break;
    			
    			case 'account_not_designer':
    				$mess= '<p class="text-danger">Bạn chưa đăng ký để trở thành Designer</p>';
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
	    			// nếu là desiger
	    			if($info_customer->type == 1){

	    				// nếu tài khoản không bị khóa
	    				if($info_customer->status == 1){

	    					// nếu chưa có token
			    			if(empty($info_customer->token)){
			    				$info_customer->token = createToken(25);
			    			}

			    			$info_customer->last_login = date('Y-m-d H:i:s');

			    			$modelMembers->save($info_customer);

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
		$conditions = array('user_id'=>$session->read('infoUser')->id, 'type'=>'user_create', 'status'=>2);
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
		$conditions = array('user_id'=>$session->read('infoUser')->id,'created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'type'=>'user_create', 'status'=>2);

		$products = $modelProduct->find()->where($conditions)->all()->toList();
		$countProductNew = count($products);

		// mẫu mới 14 ngày
		$conditions = array('user_id'=>$session->read('infoUser')->id,
							'created_at <' => date('Y-m-d H:i:s', strtotime("-7 day")),
							'created_at >=' => date('Y-m-d H:i:s', strtotime("-14 day")), 
							'type'=>'user_create', 
							'status'=>2);

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
			@$pass = getdate()[0];
			$checkMember->password = md5($pass);
			
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

function confirm($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$phone = $session->read('phone');

	$modelCustomer = $controller->loadModel('Customers');
	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'password'=>md5($dataSend['code']));
	    		$data = $modelMembers->find()->where($conditions)->first();
	    		if(!empty($data)){
	    				if($dataSend['pass'] == $dataSend['passAgain']){
	    				$data->password = md5($dataSend['pass']);

	    				$modelMembers->save($data);
	    				$session->destroy();
			    			
						return $controller->redirect('/login');		

	    			}else{
	    				$mess= '<p class="text-danger">Mật khẩu xác nhập mới bạn không đúng</p>';
	    			}
	    		}else{
	    			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
	    		}
	    setVariable('mess', $mess);
	}


}


function register($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelContact = $controller->loadModel('Contact');
	$mess = '';
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		
		/*if(empty($dataSend['status'])) $dataSend['status']=1;
		if(empty($dataSend['password'])) $dataSend['password']= $dataSend['phone'];
		if(empty($dataSend['aff'])) $dataSend['aff']= $dataSend['phone'];
		if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';
		if(empty($dataSend['type'])) $dataSend['type']= 0;*/

		$avatar= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

        $portfolio = '';
		if(!empty($_FILES["portfolio"]["name"])){
      $today= getdate();
	    $thumbnail = uploadImage($today[0], 'portfolio');
	    $portfolio = $thumbnail['linkOnline'];
    }

		if(empty($mess) && !empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again']) && !empty($_FILES['portfolio']["name"])  && !empty($dataSend['content'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					// tạo người dùng mới
					$data = $modelMember->newEmptyEntity();

					$data->name = $dataSend['name'];
					$data->avatar = $avatar;
					$data->phone = $dataSend['phone'];
					$data->aff = $dataSend['phone'];
					$data->affsource = $dataSend['affsource'];
					$data->email = @$dataSend['email'];
					$data->password = md5($dataSend['password']);
					$data->account_balance = 10000; // tặng 10k cho tài khoản mới
					$data->status = 1; //1: kích hoạt, 0: khóa
					$data->type = 0; // 0: người dùng, 1: designer
					$data->token = createToken();
					$data->commission = 70;
					$data->created_at = date('Y-m-d H:i:s');
					$data->last_login = date('Y-m-d H:i:s');
					$data->token_device = '';

					$modelMember->save($data);

					// tạo yêu cầu xét duyệt designer
					$dataContact = $modelContact->newEmptyEntity();

					$dataContact->customer_id = $data->id;
					$dataContact->content = $dataSend['content'];
					$dataContact->title = 'Đăng ký làm Designer';
					$dataContact->meta = $portfolio;
					$dataContact->type = 1; // 0: order mẫu thiết kế, 1: đăng ký designer, 2: báo xấu mẫu thiết kế
					$dataContact->status = 0; // 0: chưa xử lý, 1: đã xử lý
					$dataContact->created_at = date('Y-m-d H:i:s');

					$modelContact->save($dataContact);
					sendNotificationAdmin('6479b759179eba65139297da');

			    	$mess = '<p class="text-success">Yêu cầu đăng ký Designer của bạn đã được tạo thành công. Bạn sẽ sử dụng tài khoản của mình sau khi được Ezpics kiểm tra và phê duyệt</p>';
					
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

function ggCallback($input)
{
    global $google_clientId;
    global $google_clientSecret;
    global $google_redirectURL;
    global $controller;
    global $session;

	$modelMembers = $controller->loadModel('Members');

  	$client = new Google_Client();
  	$client->setClientId($google_clientId);
  	$client->setClientSecret($google_clientSecret);
  	$client->setRedirectUri($google_redirectURL);
  	$client->addScope('email');
  	$client->setApplicationName('Đăng nhập Ezpics');
  	$client->setApprovalPrompt('force');
    
    if(isset($_GET['code'])) {
       	try {
       		$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    		
    		if (!isset($token['access_token'])) {
				die('Failed to retrieve access token');
			}

			$client->setAccessToken($token['access_token']);
			$google_oauth = new Google_Service_Oauth2($client);
			$google_account_info = $google_oauth->userinfo->get();

			$email = $google_account_info->email;

            if(!empty($email)){
            	$conditions = array('id_google'=>$google_account_info->id);
	    		$checkUser = $modelMembers->find()->where($conditions)->first();

	    		// nếu chưa có tài khoản liên kết với GG thì tìm lại theo email
	    		if(empty($checkUser)){
	    			$conditions = array('email'=>$google_account_info->email);
	    			$checkUser = $modelMembers->find()->where($conditions)->first();

	    			if(!empty($checkUser)){
	    				$checkUser->id_google = $google_account_info->id;

	    				$modelMembers->save($checkUser);
	    			}
	    		}

	    		// nếu tìm theo email vẫn chưa có thì tạo mới
	    		if(empty($checkUser)){
	    			$checkUser = $modelMembers->newEmptyEntity();

					$checkUser->name = $google_account_info->name;
					$checkUser->avatar = $google_account_info->picture;
					$checkUser->phone = 'GG'.$google_account_info->id;
					$checkUser->aff = $checkUser->phone;
					$checkUser->affsource = '';
					$checkUser->email = $google_account_info->email;
					$checkUser->password = '';
					$checkUser->account_balance = 10000; // tặng 10k cho tài khoản mới
					$checkUser->status = 1; //1: kích hoạt, 0: khóa
					$checkUser->type = 0; // 0: người dùng, 1: designer
					$checkUser->token = createToken(25);
					$checkUser->created_at = date('Y-m-d H:i:s');
					$checkUser->last_login = date('Y-m-d H:i:s');
					$checkUser->token_device = '';
					$checkUser->id_google = $google_account_info->id;

					$modelMembers->save($checkUser);
	    		}

	    		// nếu là desiger
    			if($checkUser->type == 1){

    				// nếu tài khoản không bị khóa
    				if($checkUser->status == 1){

    					// nếu chưa có token
		    			if(empty($checkUser->token)){
		    				$checkUser->token = createToken(25);
		    			}

		    			$checkUser->last_login = date('Y-m-d H:i:s');

		    			$modelMembers->save($checkUser);

		    			$session->write('CheckAuthentication', true);
	                    $session->write('urlBaseUpload', '/upload/admin/images/'.$checkUser->id.'/');

		    			$session->write('infoUser', $checkUser);
		    			
						return $controller->redirect('/dashboard');
					}else{
						return $controller->redirect('/login/?error=account_lock');
					}
				}else{
					return $controller->redirect('/login/?error=account_not_designer');
				}
            }
        }
        catch(Exception $e) {
        	echo $e->getMessage();
            exit();
        }
    }else{
        return $controller->redirect('/login');
    }
}

function detailDesigner($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;

	$modelProduct = $controller->loadModel('Products');
	$modelMembers = $controller->loadModel('Members');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelOrder = $controller->loadModel('Orders');

	$link_open_app = '';
	
	if(!empty($input['request']->getAttribute('params')['pass'][1])){
		$slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
		$slug = explode('-', $slug);
		$count = count($slug)-1;
		$id = (int) $slug[$count];

		$designer = $modelMembers->find()->where(['id'=>$id])->first();

		if(!empty($designer)){

			$metaTitleMantan = 'Designer '.$designer->name;
			$metaDescriptionMantan = 'Trang cá nhân của designer '.$designer->name.' trên Ezpics';
			$metaImageMantan = $designer->avatar;

			if($designer->type == 1){
				$link_open_app =  (!empty($designer->link_open_app))?$designer->link_open_app:'https://ezpics.page.link/vn1s';

				$pro = $modelProduct->find()->where(array('user_id' => $designer->id, 'type'=>'user_create','status'=>2))->all()->toList();
				
				$quantityProduct = count(@$pro);

				$conditionProduct =array('user_id' => $designer->id, 'type'=>'user_create','status'=>2);

				if(!empty($_GET['name'])){
					$conditionProduct['name LIKE'] = '%'.$_GET['name'].'%';
				}

				$limit = 20;
				$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
				if($page<1) $page = 1;
				$order = array('created_at'=>'desc');

				$product = $modelProduct->find()->limit($limit)->page($page)->where($conditionProduct)->order($order)->all()->toList();
				$totalData = $modelProduct->find()->where($conditionProduct)->all()->toList();

				$totalData = count($totalData);

			    $balance = $totalData % $limit;
			    $totalPage = ($totalData - $balance) / $limit;
			    if ($balance > 0)
			        $totalPage+=1;

			    $back = $page - 1;
			    $next = $page + 1;
			    if ($back <= 0)
			        $back = 1;
			    if ($next >= $totalPage)
			        $next = $totalPage;

			    if (isset($_GET['page'])) {
			        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
			        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
			    } else {
			        $urlPage = $urlCurrent;
			    }
			    if (strpos($urlPage, '?') !== false) {
			        if (count($_GET) >= 1) {
			            $urlPage = $urlPage . '&page=';
			        } else {
			            $urlPage = $urlPage . 'page=';
			        }
			    } else {
			        $urlPage = $urlPage . '?page=';
			    }

				

				$order = $modelOrder->find()->where(array('member_id' => $designer->id, 'type'=>3))->all()->toList();
				$quantitySell  = count(@$order);

				$follow = $modelFollowDesigner->find()->where(array('designer_id' => $designer->id))->all()->toList();
				$quantityFollow  = count(@$follow);

				$Warehouse = $modelWarehouse->find()->where(array('user_id' => $designer->id, 'status'=>1))->all()->toList();

				$quantityWarehouse  = count(@$Warehouse);

				if(!empty($Warehouse)){
			    	foreach ($Warehouse as $key => $value) {
			    		$users = $modelWarehouseUsers->find()->where(['warehouse_id'=>$value->id])->all()->toList();
			    		$Warehouse[$key]->number_user = count($users);

			    		$products = $modelWarehouseProducts->find()->where(['warehouse_id'=>$value->id])->all()->toList();
			    		$Warehouse[$key]->number_product = count($products);
			    	}
			    }

				setVariable('designer', $designer);
				setVariable('product', $product);
				setVariable('link_open_app', $link_open_app);
				setVariable('quantityProduct', $quantityProduct);
				setVariable('quantitySell', $quantitySell);
				setVariable('quantityFollow', $quantityFollow);
				setVariable('quantityWarehouse', $quantityWarehouse);
				setVariable('Warehouse', $Warehouse);

				setVariable('page', $page);
	    		setVariable('totalPage', $totalPage);
	    		setVariable('back', $back);
	    		setVariable('next', $next);
	    		setVariable('urlPage', $urlPage);
	    		setVariable('totalData', $totalData);
			}else{
				return $controller->redirect('https://ezpics.page.link/vn1s');
			}
		}else{
			return $controller->redirect('https://ezpics.page.link/vn1s');
		}
	}else{
		return $controller->redirect('https://ezpics.page.link/vn1s');
	}
}
?>