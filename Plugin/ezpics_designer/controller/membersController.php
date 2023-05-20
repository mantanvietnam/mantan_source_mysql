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

function forgotPass($input){
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$metaTitleMantan = 'Email xác thực';

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions['email'] = $dataSend['email'];
		$checkMember = $modelMembers->find()->where($conditions)->first();

		if(!empty($checkMember)){
			@$pass = getdate()[0];
			$checkMember->password = md5($pass);
			
			$modelMembers->save($checkMember);
			sendEmailnewpassword($checkMember->email, $checkMember->name, $pass);
			$session->write('email', $checkMember->email);
			
			return $controller->redirect('/confirm');


		}else{
			$mess= '<p class="text-danger">Email không đúng!</p>';
		}
		setVariable('mess', $mess);
	}
}

function confirm($input){

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$email = $session->read('email');

	$modelCustomer = $controller->loadModel('Customers');
	$modelMembers = $controller->loadModel('Members');
	debug($email);
	die;

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('email'=>@$email, 'password'=>md5($dataSend['code']));
	    		$data = $modelMembers->find()->where($conditions)->first();
	    		if(!empty($data)){
	    				$session->destroy();

	    				$session->write('infoUser', $data);


	    				return $controller->redirect('/newpassword');
			    			
						
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

		$avatar = '';
		if(!empty($_FILES["avatar"]["name"])){
               
                $today= getdate();
                if(isset($_FILES["avatar"]) && empty($_FILES["avatar"]["error"])){
	                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	                $filename = $_FILES["avatar"]["name"];
	                $filetype = $_FILES["avatar"]["type"];
	                $filesize = $_FILES["avatar"]["size"];
	                
	                // Verify file extension
	                $ext = pathinfo($filename, PATHINFO_EXTENSION);
	                if(!array_key_exists($ext, $allowed)) $mess= '<h3 class="color_red">File upload không đúng định dạng ảnh</h3>';
	                
	                // Verify file size - 1MB maximum
	                $maxsize = 1024 * 1024;
	                if($filesize > $maxsize) $mess= '<h3 class="color_red">File ảnh vượt quá giới hạn cho phép 1Mb</h3>';
	                
	                // Verify MYME type of the file
	                if(in_array($filetype, $allowed)){
	                    // Check whether file exists before uploading it
	                    move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__.'/../../../webroot/upload/register/' . $today[0].'_avatar.jpg');
	                    $avatar= 'https://designer.ezpics.vn/webroot/upload/register/'.$today[0].'_avatar.jpg';
	                    
	                } else{
	                    $mess= '<h3 class="color_red">Upload dữ liệu bị lỗi</h3>';
	                }
	            }
        }else{
           $avatar= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';
        }

        $portfolio = '';
		if(!empty($_FILES["portfolio"]["name"])){
              $today= getdate();
                if(isset($_FILES["portfolio"]) && empty($_FILES["portfolio"]["error"])){
	                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	                $filename = $_FILES["portfolio"]["name"];
	                $filetype = $_FILES["portfolio"]["type"];
	                $filesize = $_FILES["portfolio"]["size"];
	                
	                // Verify file extension
	                $ext = pathinfo($filename, PATHINFO_EXTENSION);
	                if(!array_key_exists($ext, $allowed)) $mess= '<h3 class="color_red">File upload không đúng định dạng ảnh</h3>';
	                
	                // Verify file size - 1MB maximum
	                $maxsize = 1024 * 1024;
	                if($filesize > $maxsize) $mess= '<h3 class="color_red">File ảnh vượt quá giới hạn cho phép 1Mb</h3>';
	                
	                // Verify MYME type of the file
	                if(in_array($filetype, $allowed)){
	                    // Check whether file exists before uploading it
	                    move_uploaded_file($_FILES["portfolio"]["tmp_name"], __DIR__.'/../../../webroot/upload/portfolio/' . $today[0].'_portfolio.jpg');
	                    $portfolio= 'https://designer.ezpics.vn/webroot/upload/portfolio/'.$today[0].'_portfolio.jpg';
	                    
	                } else{
	                    $mess= '<h3 class="color_red">Upload dữ liệu bị lỗi</h3>';
	                }
	       	}
        }

		if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again']) && !empty($_FILES['avatar']["name"])  && !empty($_FILES['portfolio']["name"])  && !empty($dataSend['content'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					$data = $modelMember->newEmptyEntity();

					$data->name = $dataSend['name'];
					$data->avatar = $avatar;
					$data->phone = $dataSend['phone'];
					$data->aff = @$dataSend['aff'];
					$data->affsource = @$dataSend['affsource'];
					$data->email = @$dataSend['email'];
					$data->password = md5($dataSend['password']);
					$data->account_balance = 100000; // tặng 100k cho tài khoản mới
					$data->status = 1; //1: kích hoạt, 0: khóa
					$data->type = 0; // 0: người dùng, 1: designer
					$data->token = createToken();
					$data->created_at = date('Y-m-d H:i:s');
					$data->last_login = date('Y-m-d H:i:s');
					$data->token_device = @$dataSend['token_device'];


					$modelMember->save($data);

					$Member =  $modelMember->find()->where(array('token'=>$data->token))->first();
					$dataContact = $modelContact->newEmptyEntity();

					$dataContact->customer_id = $Member->id;
					$dataContact->content = $dataSend['content'];
					$dataContact->title = 'Đăng ký làm Designer';
					$dataContact->meta = $portfolio;
					$dataContact->type = 1; // 0: order mẫu thiết kế, 1: đăng ký designer, 2: báo xấu mẫu thiết kế
					$dataContact->status = 0; // 0: chưa xử lý, 1: đã xử lý
					$dataContact->created_at = date('Y-m-d H:i:s');

					$modelContact->save($dataContact);

					$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$dataContact->id.'/');

			    			$session->write('infoUser', $data);
			    			
							return $controller->redirect('/dashboard');



					
				}else{
					$mess = 'Mật khẩu nhập lại không đúng';
								
				}
			}else{
				$mess = 'Số điện thoại đã tồn tại';

			}
		}else{
			$mess = 'Gửi thiếu dữ liệu';
		}
	}
	 setVariable('mess', $mess);

}
?>