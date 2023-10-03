<?php 
function saveRegisterMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	$return = array('code'=>1,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>''))
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		
		if(empty($dataSend['status'])) $dataSend['status']=1;
		if(empty($dataSend['password'])) $dataSend['password']= $dataSend['phone'];
		if(empty($dataSend['aff'])) $dataSend['aff']= $dataSend['phone'];
		if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';
		if(empty($dataSend['type'])) $dataSend['type']= 0;

		if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					$data = $modelMember->newEmptyEntity();

					$data->name = $dataSend['name'];
					$data->avatar = $dataSend['avatar'];
					$data->phone = $dataSend['phone'];
					$data->aff = $dataSend['aff'];
					
					if(!empty($dataSend['affsource']) && $dataSend['affsource']!=$dataSend['aff']){
						$affsource = $modelMember->find()->where(array('aff'=>$dataSend['affsource']))->first();
						
						if(!empty($affsource)){
							$data->affsource = $affsource->id;

							if(!empty($affsource->deadline_pro) && $affsource->deadline_pro->format('Y-m-d H:i:s') > date('Y-m-d H:i:s')){
								$affsource->deadline_pro = date('Y-m-d H:i:s', strtotime($affsource->deadline_pro . ' + 7   days'));
							}else{
								$affsource->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 7 days'));
							}
							$affsource->member_pro = 1;

							$modelMember->save($affsource);

							$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$affsource->id))->first();

							
							if(empty($WarehouseUser)){
								$Warehouse = $modelWarehouseUsers->newEmptyEntity();
						            // tạo dữ liệu saves
								$Warehouse->warehouse_id = (int) 1;
								$Warehouse->user_id = $affsource->id;
								$Warehouse->designer_id = 343;
								$Warehouse->price = 0;
								$Warehouse->created_at = date('Y-m-d H:i:s');
								$Warehouse->note ='';
								$Warehouse->deadline_at = $affsource->deadline_pro;
								$modelWarehouseUsers->save($Warehouse);
							}else{
								$WarehouseUser->deadline_at = $affsource->deadline_pro;
								$modelWarehouseUsers->save($WarehouseUser);
							}
						}
							
					}

					$data->email = @$dataSend['email'];
					$data->password = md5($dataSend['password']);
					$data->account_balance = 0; // tặng 0k cho tài khoản mới
					$data->status = (int) $dataSend['status']; //1: kích hoạt, 0: khóa
					$data->type = (int) $dataSend['type']; // 0: người dùng, 1: designer
					$data->otp = rand(100000,999999);
					$data->token = createToken();
					$data->created_at = date('Y-m-d H:i:s');
					$data->last_login = date('Y-m-d H:i:s');
					$data->token_device = @$dataSend['token_device'];

					// tạo link deep
			        $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
		            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
		                                                'link'=>'https://ezpics.page.link/register?affsource='.$data->aff,
		                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
		                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
		                                        ]
		                        ];
		            $header_deep = ['Content-Type: application/json'];
		            $typeData='raw';
		            $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
		            $deep_link = json_decode($deep_link);

		            $data->link_affiliate = @$deep_link->shortLink;


					$modelMember->save($data);
					sendNotificationAdmin('64a247e5c939b1e3d37ead0b');
					
					// gửi thông báo về app cho người giới thiệu
					if(!empty($affsource)){
	                    $dataSendNotification= array('title'=>'Có người đăng ký dưới mã của bạn','time'=>date('H:i d/m/Y'),'content'=>'Chúc mừng '.$affsource->name.', người dùng '.$dataSend['name'].' ('.@$dataSend['phone'].') đã đăng ký bằng mã giới thiệu của bạn, và bạn được cộng thêm 7 ngày sử dụng bản EZPICS PRO','action'=>'adminSendNotification');
	                    if(!empty($affsource->token_device)){
	                        sendNotification($dataSendNotification, $affsource->token_device);
	                    }
					}

					// gửi mã xác thực về Zalo người đăng ký
					sendOTPZalo($dataSend['phone'], $data->otp);
					/*
					$url_zns = 'http://rest.esms.vn/MainService.svc/json/SendZaloMessage_V4_post_json/';
		            $data_send_zns = [
										"ApiKey" => "E69EBCCCBD92CC5E403D68E78F605E",
										"SecretKey" => "262DC6F859F9EC69B9F6F46388B71E",
										"Phone" => $dataSend['phone'],
										"Params" => [$data->otp],
										"TempID" => "205644",
										"OAID" => "4097311281936189049",
										"SendDate" => "",
										"Sandbox" => "0",
										"RequestId" => time(),
										"campaignid" => "EZPICS OTP",
										"CallbackUrl" => "https://apis.ezpics.vn/calbackZalo"
									];
		            $header_zns = ['Content-Type: application/json'];
		            $typeData='raw';
		            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns,$typeData);
		            $return_zns = json_decode($return_zns);
					*/



					$return = array(	'code'=>0, 
			    						'set_attributes'=>array('id_member'=>$data->id),
			    						'messages'=>array(array('text'=>'Lưu thông tin thành công')),
			    						'info_member'=>$data,
			    						'code_otp' => $data->otp,
			    						'return_zns' => $return_zns
			    					);
				}else{
					$return = array('code'=>4,
										'set_attributes'=>array('id_customer'=>0),
										'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
									);
				}
			}else{
				$return = array('code'=>3,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>'Số điện thoại đã tồn tại'))
				);

			}
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
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
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']), 'status'=>1 ))->first();

			if(!empty($checkPhone)){
				if(!empty($dataSend['token_device']) && $checkPhone->token_device != $dataSend['token_device']){
					// gửi thông báo đăng xuất
                    $dataSendNotification= array('title'=>'Đăng xuất','time'=>date('H:i d/m/Y'),'content'=>'Tài khoản của bạn đã được đăng nhập trên một thiết bị khác','action'=>'login');

                    sendNotification($dataSendNotification, $checkPhone->token_device);
				}

				$checkPhone->token = createToken();
				$checkPhone->last_login = date('Y-m-d H:i:s');
				$checkPhone->token_device = @$dataSend['token_device'];
				$checkdeadlinepro = $modelMember->find()->where(array('deadline_pro <=' => date('Y-m-d H:i:s'),"member_pro" => 1,'id'=>$checkPhone->id))->first();
				if(!empty($checkdeadlinepro)){
					$checkPhone->member_pro = 0;
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

function checkLoginFacebookAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_facebook'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'FB'.$dataSend['id_facebook'];

			$checkPhone = $modelMember->find()->where(array('id_facebook'=>$dataSend['id_facebook'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_facebook = @$dataSend['id_facebook'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->aff = @$dataSend['phone'];
				$data->affsource = '';
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->account_balance = 0; // tặng 0k cho tài khoản mới
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];
				$data->id_facebook = $dataSend['id_facebook'];

				$url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
		        $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
		                                                'link'=>'https://ezpics.page.link/register?affsource='.$data->aff,
		                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
		                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
		                                        ]
		                        ];
		        $header_deep = ['Content-Type: application/json'];
		        $typeData='raw';
		        $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
		        $deep_link = json_decode($deep_link);

		        $data->link_affiliate = @$deep_link->shortLink;


				$modelMember->save($data);
				sendNotificationAdmin('64a247e5c939b1e3d37ead0b');

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
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

function checkLoginGoogleAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_google'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'GG'.$dataSend['id_google'];

			$checkPhone = $modelMember->find()->where(array('id_google'=>$dataSend['id_google'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_google = @$dataSend['id_google'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->aff = @$dataSend['phone'];
				$data->affsource = '';
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->account_balance = 0; // tặng 0k cho tài khoản mới
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];
				$data->id_google = $dataSend['id_google'];

				$url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
		            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
		                                                'link'=>'https://ezpics.page.link/register?affsource='.$data->aff,
		                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
		                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
		                                        ]
		                        ];
		        $header_deep = ['Content-Type: application/json'];
		        $typeData='raw';
		        $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
		        $deep_link = json_decode($deep_link);

		        $data->link_affiliate = @$deep_link->shortLink;


				$modelMember->save($data);
				sendNotificationAdmin('64a247e5c939b1e3d37ead0b');

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
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

function checkLoginAppleAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_apple'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'A'.$dataSend['id_apple'];

			$checkPhone = $modelMember->find()->where(array('id_apple'=>$dataSend['id_apple'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_apple = @$dataSend['id_apple'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->aff = @$dataSend['phone'];
				$data->affsource = '';
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->account_balance = 0; // tặng 0k cho tài khoản mới
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];
				$data->id_apple = $dataSend['id_apple'];


				$url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
		        $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
		                                                'link'=>'https://ezpics.page.link/register?affsource='.$data->aff,
		                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
		                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
		                                        ]
		                        ];
		        $header_deep = ['Content-Type: application/json'];
		        $typeData='raw';
		        $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
		        $deep_link = json_decode($deep_link);

		        $data->link_affiliate = @$deep_link->shortLink;


				$modelMember->save($data);

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
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
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

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

function getTopDesignerAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $input['request']->getData();
	$listDesign = [];

	if(empty($dataSend['orderBy'])) $dataSend['orderBy'] = 'bestSeller';

	if($dataSend['orderBy'] == 'bestSeller' || $dataSend['orderBy'] == 'bestMoney'){
		// bán được nhiều mẫu hoặc doanh thu cao trong tuần
		$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")));
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:100;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array();

		$listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$listDesignStatic = [];

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				if(empty($listDesignStatic[$value->member_id])){
					$listDesignStatic[$value->member_id] = 0;
				}

				if($dataSend['orderBy'] == 'bestSeller'){
					$listDesignStatic[$value->member_id] ++;
				}else{
					$listDesignStatic[$value->member_id] += $value->total;
				}
			}

			arsort($listDesignStatic);

			foreach ($listDesignStatic as $key => $value) {
				$member = $modelMember->find()->where(['id'=>(int) $key])->first();
				if(!empty($member)){
					$member->sold = $value;
					unset($member->password);
					unset($member->token);

					$listDesign[] = $member;
				}
			}
		}
	}elseif($dataSend['orderBy'] == 'bestCreate'){
		// tạo nhiều mẫu bán trong tuần
		$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'status'=>1);
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:100;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array();

		$listData = $modelProduct->find()->where($conditions)->order($order)->all()->toList();
		$listDesignStatic = [];

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				if(empty($listDesignStatic[$value->user_id ])){
					$listDesignStatic[$value->user_id ] = 0;
				}

				$listDesignStatic[$value->user_id] ++;
			}

			arsort($listDesignStatic);

			foreach ($listDesignStatic as $key => $value) {
				$member = $modelMember->find()->where(['id'=>(int) $key])->first();
				if(!empty($member)){
					$member->sold = $value;
					unset($member->password);
					unset($member->token);

					$listDesign[] = $member;
				}
			}
		}
	}
	return 	array('listData'=>$listDesign);
}

function getInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkdeadlinepro = $modelMember->find()->where(array('deadline_pro <=' => date('Y-m-d H:i:s'),"member_pro" => 1,'id'=>$checkPhone->id))->first();
				if(!empty($checkdeadlinepro)){
					$checkPhone->member_pro =0;
					$modelMember->save($checkPhone);
				}

				$name_slug = createSlugMantan($checkPhone->name);
				$checkPhone->link_share = 'https://designer.ezpics.vn/designer/'.$name_slug.'-'.$checkPhone->id.'.html';
				$checkPhone->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$checkPhone->link_affiliate;
				
				$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'messages'=>array(array('text'=>'bạn lấy dữ liệu thành công'))
								);
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

function getInfoUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelProduct = $controller->loadModel('Products');
	$modelOrder = $controller->loadModel('Orders');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();


		if(!empty($dataSend['idUser'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['idUser'] , 'type'=> 1))->first();
		

			if(!empty($checkPhone)){
				unset($checkPhone->password);
				unset($checkPhone->token);
				unset($checkPhone->token_device);
				unset($checkPhone->id_facebook);
				unset($checkPhone->last_login);
				unset($checkPhone->account_balance);
				
				if($checkPhone->type==1){

					$product = $modelProduct->find()->where(array('user_id' => $checkPhone->id, 'type'=>'user_create','status'=>2))->all()->toList();
					$checkPhone->listProduct = @$product;
					$checkPhone->quantityProduct = count(@$product);

					$Order = $modelOrder->find()->where(array('member_id' => $checkPhone->id, 'type'=>3))->all()->toList();
					$checkPhone->quantitySell  = count(@$Order);

					$Follow = $modelFollowDesigner->find()->where(array('designer_id' => $checkPhone->id))->all()->toList();
					$checkPhone->quantityFollow  = count(@$Follow);

					$name_slug = createSlugMantan($checkPhone->name);
					$checkPhone->link_share = 'https://designer.ezpics.vn/designer/'.$name_slug.'-'.$checkPhone->id.'.html';
					$checkPhone->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$checkPhone->link_affiliate;

					$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'messages'=>array(array('text'=>'Bạn lấy dữ liệu thành công'))
								);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Tài khoản chưa phải là designer'))
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

function getProductUserAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelProduct = $controller->loadModel('Products');
	$modelOrder = $controller->loadModel('Orders');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['idUser'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['idUser'] , 'type'=> 1))->first();
			if(!empty($checkPhone)){
				$limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				$conditions = array('user_id' => $dataSend['idUser']);

				if(!empty($dataSend['type'])){
					if($dataSend['type']=='user_create'){
						$conditions['status']= 2;
					}elseif($dataSend['type']=='user_series') {
						$conditions['status']= 1;
					}
					$conditions['type']= $dataSend['type'];
				}else{
					$conditions['type']='user_create';
					$conditions['status']= 2;
				}

				$product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->all()->toList();
				if(!empty($product)){
					$return = array('code'=>1,
								 'data'=>$product,
								 'messages'=>array(array('text'=>'Bạn lấy dữ liệu thành công'))
								);
				}else{
					$return = array('code'=>4,
							'messages'=>array(array('text'=>'không có data '))
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

function lockAccountAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->status = 0;
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

function saveChangePassAPI($input)
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
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

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

function saveInfoUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) 
			&& !empty($dataSend['name'])
			&& !empty($dataSend['email'])

		){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($checkPhone->id, 'avatar', 'avatar_'.$checkPhone->id);
				}

				if(!empty($avatar['linkOnline'])){
					$checkPhone->avatar = $avatar['linkOnline'];
				}

				$checkPhone->name = $dataSend['name'];
				$checkPhone->email = $dataSend['email'];

				if(isset($dataSend['description'])){
					$checkPhone->description = $dataSend['description'];
				}

				if(isset($_FILES['file_cv']) && empty($_FILES['file_cv']["error"])){
					$file_cv = uploadImage($checkPhone->id, 'file_cv', 'file_cv_'.$checkPhone->id);

					if(!empty($file_cv['linkOnline'])){
						$checkPhone->file_cv = $file_cv['linkOnline'].'?time='.time();
					}
				}

				if(!empty($dataSend['phone'])){
					$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
					$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

					$checkMember = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

					if(empty($checkMember) || $checkMember->id == $checkPhone->id){
						$checkPhone->phone = $dataSend['phone'];

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>4,
									'messages'=>array(array('text'=>'Số điện thoại đã tồn tại'))
								);
					}
				}else{
					$modelMember->save($checkPhone);

					$return = array('code'=>0);
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

				sendEmailCodeForgotPassword($checkPhone->email, $checkPhone->name, $code);

				$return = array('code'=>0,
								'codeForgotPassword' => $code,
								'messages'=>array(array('text'=>''))
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

function checkCodeAffiliateAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['aff'])){
			$checkPhone = $modelMember->find()->where(array('aff'=>$dataSend['aff']))->first();

			if(!empty($checkPhone)){
				$return = array('code'=>0);
			}else{
				$return = array('code'=>3);
			}
		}else{
			$return = array('code'=>2);
		}
	}

	return $return;
}

function updateLastLoginAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->last_login = date('Y-m-d H:i:s');

				$checkdeadlinepro = $modelMember->find()->where(array('deadline_pro <=' => date('Y-m-d H:i:s'),"member_pro" => 1,'id'=>$checkPhone->id))->first();
				if(!empty($checkdeadlinepro)){
					$checkPhone->member_pro =0;
				}

				$modelMember->save($checkPhone);
				$return = array('code'=>1,
									'last_login'=> $checkPhone->last_login,
						 			'mess'=>'Bạn cập nhật thời gian login thành công',
						 		);
				
			}else{
				 $return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			 $return = array('code'=>0, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

function statisticalAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelProduct = $controller->loadModel('Products');

	$return = array('code'=>0);

	$conditiontoday['created_at >='] = date('Y-m-d').' 00:00:00';
	$conditiontoday['created_at <='] = date('Y-m-d H:i:s');

	$conditionlastlogin['last_login >='] = date('Y-m-d').' 00:00:00';
	$conditionlastlogin['last_login <='] = date('Y-m-d H:i:s');


	$totalDatatoday = $modelMember->find()->where($conditiontoday)->all()->toList();
    $totalDatatoday = count($totalDatatoday);

    $totalDatalastlogin = $modelMember->find()->where($conditionlastlogin)->all()->toList();
    $totalDatalastlogin = count($totalDatalastlogin);

    $conditionOrder['created_at >='] = date('Y-m-d').' 00:00:00';
	$conditionOrder['created_at <='] = date('Y-m-d H:i:s');
	$conditionOrder['type'] = 1;
	$conditionOrder['status'] = 2;
	$conditionOrder['payment_kind'] = 1;

    $totalDataOrder = $modelOrder->find()->where($conditionOrder)->all()->toList();
   	$Order = 0;

    if(!empty($totalDataOrder)){
            foreach ($totalDataOrder as $item) {
             
               @$Order += $item->total;
    
            }
    }

    $conditionProduct['approval_date >='] = date('Y-m-d').' 00:00:00';
	$conditionProduct['approval_date <='] = date('Y-m-d H:i:s');
	$conditionProduct['status'] = 2;
	$conditionProduct['type'] = 'user_create';

	$totalDataProduct = $modelProduct->find()->where($conditionProduct)->all()->toList();
    $totalDataProduct = count($totalDataProduct);

    $totalDataMember = $modelMember->find()->where()->all()->toList();
    $totalDataMember = count($totalDataMember);


    $return = [	'static_code'=>1,
				'static_luong_dang_ky' => (int) @$totalDatatoday,
				'static_luong_dang_nhap' => (int) @$totalDatalastlogin,
				'static_doanh_thu' => (int) @$Order,
				'static_mau_duyet' => (int) @$totalDataProduct,
				'static_today' => date('H:i d/m/Y'),
				'static_member' => $totalDataMember
			];

	if(function_exists('sendNotificationAdmin')){
		sendNotificationAdmin('649e829c2a4b5185c86af438', $return);
	}

    return $return;

}

function searchDesignerAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$modelProduct = $controller->loadModel('Products');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');

	$return = array('code'=> 0);

	if($isRequestPost){

		$dataSend = $input['request']->getData();
		$conditions = array();
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:20;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array('id'=>'desc');
		if(!empty($dataSend['name'])){
			$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
			
		}
		$conditions['type'] = 1;
		$data = $modelMember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		if(!empty($data)){
			foreach($data as $key => $item){
		    	$data[$key]->totalProducts  = count($modelProduct->find()->where(array('type'=>'user_create', 'status'=> 2, 'user_id'=> $item->id))->all()->toList());

		    	$data[$key]->totalWarehouse = count($modelWarehouse->find()->where(array('user_id'=> $item->id))->all()->toList());
		    	$data[$key]->totalFollowDesigner = count($modelFollowDesigner->find()->where(array('designer_id'=> $item->id))->all()->toList());
		    }
			$return = array('code'=>1,
								'data' => $data,
								'mess'=>'Lấy data thành công'
							);
		}else{
			$return = array('code'=>2,
								'mess'=>'không có data'
							);
		}



	}

	return 	$return;
}

function listDesignerAPI($input){

	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');

	$return = array('code'=> 0);

	if($isRequestPost){

		$dataSend = $input['request']->getData();
		$conditions = array();
		
		$conditions['type'] = 1;
		$data = $modelMember->find()->where($conditions)->all()->toList();
		if(!empty($data)){
			 foreach($data as $key => $item){
		    	$data[$key]->totalProducts  = count($modelProduct->find()->where(array('type'=>'user_create', 'status'=> 2, 'user_id'=> $item->id))->all()->toList());

		    	$data[$key]->totalWarehouse = count($modelWarehouse->find()->where(array('user_id'=> $item->id))->all()->toList());
		    	$data[$key]->totalFollowDesigner = count($modelFollowDesigner->find()->where(array('designer_id'=> $item->id))->all()->toList());
		    }
		    
			$return = array('code'=>1,
								'data' => $data,
								'mess'=>'Lấy data thành công'
							);
		}else{
			$return = array('code'=>2,
								'mess'=>'không có data'
							);
		}

	}

	return 	$return;
}

function staticNumberUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$user = $modelMember->find()->where(['status'=>1])->all()->toList();

	return ['number'=>count($user)];
}

function acceptMemberAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$checkPhone = $modelMember->find()->where(array('otp'=>(int)$dataSend['otp'],'token'=>$dataSend['token']))->first();
		if(!empty($checkPhone)){
			$checkPhone->otp = null;

			$checkPhone->status = 1; //1: kích hoạt, 0: khóa
			$modelMember->save($checkPhone);

				$return = array('code'=>1, 
			    				'mess'=>'kích hoạt tài khoản thành công',
			    				'info_member'=>$checkPhone
			    			);
		}else{
			$return = array('code'=>2,
					'mess'=>'Gửi sai mã OTP'
				);
		}
	}
	return $return;
}

?>