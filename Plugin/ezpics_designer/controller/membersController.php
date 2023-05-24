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
	    			// nếu là desiger
	    			if($info_customer->type == 1){

	    				// nếu tài khoản không bị khóa
	    				if($info_customer->status == 1){

	    					// nếu chưa có token
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
					$data->account_balance = 10000; // tặng 10k cho tài khoản mới
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

			    	return $controller->redirect('/login');



					
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

function ggCallback($input)
{
    global $google_clientId;
    global $google_clientSecret;
    global $google_redirectURL;
    global $controller;

    //$modelUserhotel= new Userhotel();

	$modelMember = $controller->loadModel('Members');

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
			$name = $google_account_info->name;

			debug($email);
			debug($name);
			die;








            $gapi = new GoogleLoginApi();
            debug('sssss');

            // Get the access token 
            $data = $gapi->GetAccessToken($google_clientId, $google_redirectURL, $google_clientSecret, $_GET['code']);
              debug($data);
              debug($data['access_token']);
            // Get user information
            $user = $gapi->GetUserProfileInfo($data['access_token']);

            debug($user);

            if(!empty($user)){
                $checkUser= $modelUserhotel->getByGoogle($user['id']);

                if(!empty($checkUser)){
                    // nếu đã tồn tại tài khoản
                    $checkUser['User']['accessTokenGoogle']= $data['access_token'];
                    $_SESSION['userInfo']= $checkUser;

                    $update['$set']['accessToken']= getGUID().rand(0,1000000000);
                    $update['$set']['accessTokenGoogle']= $data['access_token'];
                    $modelUserhotel->create();
                    $modelUserhotel->updateAll($update,array('_id'=>new MongoId($_SESSION['userInfo']['User']['id'])));
                    $_SESSION['accessTokenUser']= $update['$set']['accessToken'];

                    if(!empty($_SESSION['urlCallBack'])){
                        $modelUserhotel->redirect($_SESSION['urlCallBack']);
                    }else{
                        $modelUserhotel->redirect('/account');
                    }
                }else{
                    // nếu chưa có tài khoản
                    if(!empty($user['emails'][0]['value'])){
                        $checkUserEmail= $modelUserhotel->getByEmail($user['emails'][0]['value']);
                    }
                    
                    if(!empty($checkUserEmail)){
                        // ghép 1 tài khoản đã có với facebook
                        $checkUserEmail['User']['accessTokenGoogle']= $data['access_token'];
                        $checkUserEmail['User']['idGoogle']= $user['id'];
                        $modelUserhotel->create();
                        $modelUserhotel->save($checkUserEmail);

                        $_SESSION['userInfo']= $checkUserEmail;

                        $saveUser['$set']['accessToken']= getGUID().rand(0,1000000000);
                        $dkUser= array('_id'=> new MongoId($checkUserEmail['User']['id']));
                        $modelUserhotel->updateAll($saveUser,$dkUser);
                        $_SESSION['accessTokenUser']= $saveUser['$set']['accessToken'];

                    }else{
                        // khởi tạo dữ liệu mới hoàn toàn
                        $avatar= explode('?', $user['image']['url']);
                        $data['User']['password']= '';
                        $data['User']['fullname']= $user['displayName'];
                        $data['User']['user']= 'GG'.$user['id'];
                        $data['User']['email']= $user['emails'][0]['value'];
                        $data['User']['phone']= '';
                        $data['User']['address']= '';
                        $data['User']['actived']= 1;
                        $data['User']['avatar']= $avatar[0];
                        $data['User']['accessTokenGoogle']= $data['access_token'];
                        $data['User']['idGoogle']= $user['id'];
                        $data['User']['linkGoogle']= @$user['url'];

                        if(!empty($user['gender']) && $user['gender']=='male'){
                            $data['User']['sex']= 'man';
                        }elseif(!empty($user['gender']) && $user['gender']=='female'){
                            $data['User']['sex']= 'woman';
                        }else{
                            $data['User']['sex']= 'lgbt';
                        }

                        $modelUserhotel->create();
                        $modelUserhotel->save($data);
                        $data['User']['id']= $modelUserhotel->getLastInsertId();

                        $_SESSION['userInfo']= $data;

                        $saveUser['$set']['accessToken']= getGUID().rand(0,1000000000);
                        $dkUser= array('_id'=> new MongoId($data['User']['id']));
                        $modelUserhotel->updateAll($saveUser,$dkUser);
                        $_SESSION['accessTokenUser']= $saveUser['$set']['accessToken'];

                        // tạo tài khoản ManMo Chat
                        $data['User']['idUserManMo']= $data['User']['id'];
                        $return= sendDataConnectMantan('https://chat.manmo.vn/createUserAPI',$data['User']);
                        
                    }

                    if(!empty($_SESSION['urlCallBack'])){
                        $modelUserhotel->redirect($_SESSION['urlCallBack']);
                    }else{
                        $modelUserhotel->redirect('/account');
                    }
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
?>