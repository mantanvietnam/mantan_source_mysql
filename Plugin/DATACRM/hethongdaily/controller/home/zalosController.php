<?php 
function setttingZaloOA($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('setttingZaloOA');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/');
        }

	    $metaTitleMantan = 'Cài đặt Zalo OA';

		$modelZalos = $controller->loadModel('Zalos');

		$mess= '';

		// lấy data edit
		$data = $modelZalos->find()->where(['id_system'=>$user->id_system])->first();

		if(empty($data)){
			$data = $modelZalos->newEmptyEntity();
		}

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['id_oa']) && !empty($dataSend['id_app']) && !empty($dataSend['secret_key'])){
	        	$data->id_oa = trim($dataSend['id_oa']);
		        $data->id_app = trim($dataSend['id_app']);
		        $data->secret_key = trim($dataSend['secret_key']);
		        $data->template_otp = (int) $dataSend['template_otp'];
		        $data->template_order = (int) $dataSend['template_order'];
		        $data->id_system = $user->id_system;

		        $modelZalos->save($data);

		        $note = $user->type_tv.' '. $user->name.' cài đặt Zalo OA';
                    

                 addActivityHistory($user,$note,'setttingZaloOA',$data->id);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function callbackZalo($input)
{
	global $controller;

	if(!empty($_GET['code']) && !empty($_GET['oa_id'])){
		$modelZalos = $controller->loadModel('Zalos');

		$zalooa = $modelZalos->find()->where(['id_oa'=>$_GET['oa_id']])->first();

		if(!empty($zalooa)){
			$zalooa->oauth_code = $_GET['code'];

			$modelZalos->save($zalooa);

			$return = getAccessTokenZaloOA($zalooa->id_oa, $zalooa->id_app);
		}
	}

	return $controller->redirect('/setttingZaloOA');
}

function sendMessZaloFollow($input)
{
	global $controller;
    global $isRequestPost;
    global $urlHomes;
    global $session;
    
    $modelZalos = $controller->loadModel('Zalos');
    $modelTransactionHistories = $controller->loadModel('TransactionHistories');
    $modelMembers = $controller->loadModel('Members');

    $user = checklogin('sendMessZaloFollow');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/');
        }
    	$infoUser = $modelMembers->find()->where(['id'=>$user->id])->first();

		// lấy data edit
		$infoZalo = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();

    	if(!empty($infoZalo->id_app) && !empty($infoZalo->secret_key) && !empty($infoZalo->id_oa) && !empty($infoZalo->access_token)){
    		if($infoZalo->deadline < time()){
    			refreshTokenZaloOA($infoZalo->id_oa, $infoZalo->id_app);

                $infoZalo = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();
    		}

    		$mess = '';

    		if($isRequestPost){
    			$dataSend = $input['request']->getData();

    			if(!empty($dataSend['mess']) && !empty($dataSend['typeUser'])){
    				// lấy danh sách user quan tâm OA
			        $listFollowers = [];

			        if(in_array('follower', $dataSend['typeUser'])){
				        $page = -1;
				        do{
				        	$page ++;
				        	$offset = 50*$page;

					        $url_zns = 'https://openapi.zalo.me/v2.0/oa/getfollowers?data={"offset":'.$offset.',"count":50,"tag_name":""}';
					        $header_zns = ['access_token: '.$infoZalo->access_token];
					        $data_send_zns = [];

						    $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns);

						    $return_zns = json_decode($return_zns, true);
						    
						    if(!empty($return_zns['data']['followers'])){
						    	$listFollowers += $return_zns['data']['followers'];
							}

						} while(!empty($return_zns['data']['followers']));
					}

					if(!empty($listFollowers)){
						$requestMoney = 500 * count($listFollowers);

						if($infoUser->coin >= $requestMoney){
							// trừ tiền tài khoản
					        $infoUser->coin -= $requestMoney;
					        $modelMembers->save($infoUser);

					        // tạo lịch sử giao dịch
			                $histories = $modelTransactionHistories->newEmptyEntity();

			                $histories->id_member = $infoUser->id;
			                $histories->id_system = $infoUser->id_system;
			                $histories->coin = $requestMoney;
			                $histories->type = 'minus';
			                $histories->note = 'Trừ tiền dịch vụ gửi '.number_format(count($listFollowers)).' tin nhắn Zalo cho khách hàng, số dư tài khoản sau giao dịch là '.number_format($infoUser->coin).'đ';
			                $histories->create_at = time();
			                
			                $modelTransactionHistories->save($histories);

			                // gửi tin Zalo 
			                foreach ($listFollowers as $follower) {
					    		$url_zns = 'https://openapi.zalo.me/v3.0/oa/message/cs';
					            $data_send_zns = [
					                                "recipient" => ["user_id"=>$follower['user_id']],
					                                "message" => ["text"=>$dataSend['mess']],
					                            ];
					            $header_zns = ['Content-Type: application/json', 'access_token: '.$infoZalo->access_token];
					            $typeData='raw';
					            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns,$typeData);
					        }

					        $mess = '<p class="text-success">Gửi thành công '.number_format(count($listFollowers)).' tin nhắn Zalo cho khách hàng</p>';	

					        $note = $user->type_tv.' '. $user->name.' đã gửi tin nhắn Zalo cho khách hàng nội dung là '.@$dataSend['mess'];
                 			addActivityHistory($user,$note,'setttingZaloOA',0);

					    }else{
					    	$mess = '<p class="text-danger">Tài khoản bạn không đủ tiền, vui lòng nạp thêm '.number_format($requestMoney).'đ để gửi tin nhắn Zalo cho '.number_format(count($listFollowers)).' khách hàng. Liên hệ hotline 081.656.000 để được hỗ trợ nạp tiền</p>';	
					    }
			        }
		        }else{
		        	$mess = '<p class="text-danger">Bạn chưa soạn nội dung tin nhắn</p>';	
		        }
	        }

	        setVariable('mess', $mess);
	        setVariable('infoUser', $infoUser);
    	}else{
    		return $controller->redirect('/setttingZaloOA/?status=emptyData');
    	}
    }else{
		return $controller->redirect('/login');
	}
}

function sendNotificationMobile($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    
    $user = checklogin('setttingZaloOA');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

	    $metaTitleMantan = 'Gửi thông báo trên ứng dụng điện thoại';
		$mess= '';

		$modelTokenDevices = $controller->loadModel('TokenDevices');
		
		$modelZaloTemplates = $controller->loadModel('ZaloTemplates');
		$modelCampaigns = $controller->loadModel('Campaigns');
		$modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
		$modelMembers = $controller->loadModel('Members');
		$modelZalos = $controller->loadModel('Zalos');
		$modelCustomers = $controller->loadModel('Customers');
		$modelTransactionHistories = $controller->loadModel('TransactionHistories');

		$infoUser = $modelMembers->find()->where(['id'=>$session->read('infoUser')->id])->first();

		

		// danh sách chiến dịch
		$conditions = array('id_member'=>$session->read('infoUser')->id);
		$listCampaign = $modelCampaigns->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

		// danh sách nhóm khách hàng
		$conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        // danh sách chức danh đại lý
        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active');
        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['content']) && !empty($dataSend['title'])){
	        	$dataSendNotification= array(
	        			'title'=>$dataSend['title'],
	        			'time'=>date('H:i d/m/Y'),
	        			'content'=>$dataSend['content'],
	        			'action'=>$dataSend['action'] ,
	        			'id_object'=>$dataSend['id_object']
	        		);
                $token_device = [];
                $listTokenDevice = [];
                $type = '';
	        	if($dataSend['type_user'] == 'customer_campaign'){
	        		$type = 'Người dùng theo chiến dịch';
	        		if(!empty($dataSend['id_campaign'])){
	        			$infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$session->read('infoUser')->id])->first();

	        			if(!empty($infoCampaign)){
	        				$conditions = array('id_member'=>$session->read('infoUser')->id, 'id_campaign'=>(int) $infoCampaign->id);

	        				$listCampaignCustomers = $modelCampaignCustomers->find()->where($conditions)->all()->toList();

	        				if(!empty($listCampaignCustomers)){
			                    foreach ($listCampaignCustomers as $key => $value) {
			                    	// danh sách token
			                    	$listToken = $modelTokenDevices->find()->where(['id_customer'=>$value->id_customer])->all()->toList();

			                        if(!empty($listToken)){
			                        	$listTokenDevice += $listToken;
			                    	}
			                    }
			                }
	        			}
	        		}
	        	}elseif($dataSend['type_user'] == 'customer_group'){
	        		$type = 'Người dùng theo nhóm';
	        		if(!empty($dataSend['id_group_customer'])){
	        			$infoGroup = $modelCategories->find()->where(['id'=>(int) $dataSend['id_group_customer'], 'parent'=>$session->read('infoUser')->id, 'type' => 'group_customer'])->first();

	        			if(!empty($infoGroup)){
		        			$customer_in_group = $modelCategoryConnects->find()->where(['keyword'=>'group_customers','id_category'=> (int) $dataSend['id_group_customer']])->all()->toList();

		        			if(!empty($customer_in_group)){
		        				foreach ($customer_in_group as $key => $value) {
		        					// danh sách token
			                    	$listToken = $modelTokenDevices->find()->where(['id_customer'=>$value->id_parent])->all()->toList();

			                        if(!empty($listToken)){
			                        	$listTokenDevice += $listToken;
			                    	}
		        				}
		        			}
		        		}
	        		}else{
	        			// tất cả các nhóm
	        			$join = [
						            [
						                'table' => 'category_connects',
						                'alias' => 'CategoryConnects',
						                'type' => 'LEFT',
						                'conditions' => [
						                    'Customers.id = CategoryConnects.id_parent'
						                ],
						            ]
						        ];

						$select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

						$conditions = array('CategoryConnects.id_category'=>$session->read('infoUser')->id, 'CategoryConnects.keyword'=>'member_customers');

	        			$listCustomers = $modelCustomers->find()->join($join)->select($select)->where($conditions)->all()->toList();

	        			if(!empty($listCustomers)){
	        				foreach ($listCustomers as $key => $value) {
	        					// danh sách token
		                    	$listToken = $modelTokenDevices->find()->where(['id_customer'=>$value->id])->all()->toList();

		                        if(!empty($listToken)){
		                        	$listTokenDevice += $listToken;
		                    	}
	        				}
	        			}
	        		}
	        	}elseif($dataSend['type_user'] == 'member_position'){
	        		$type = 'Đại lý theo chức danh';
	        		if(!empty($dataSend['id_position'])){
	        			$infoPosition = $modelCategories->find()->where(['id'=>(int) $dataSend['id_position'], 'type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active'])->first();

	        			if(!empty($infoPosition)){
	        				$listMembers = $modelMembers->find()->where(['id_position'=>(int) $dataSend['id_position']])->all()->toList();

	        				if(!empty($listMembers)){
		        				foreach ($listMembers as $key => $value) {
		        					// danh sách token
			                    	$listToken = $modelTokenDevices->find()->where(['id_member'=>$value->id])->all()->toList();

			                        if(!empty($listToken)){
			                        	$listTokenDevice += $listToken;
			                    	}
		        				}
		        			}
	        			}
	        		}
	        	}elseif($dataSend['type_user'] == 'test_customer'){
	        		$type = 'Gửi test kiểm tra app khách hàng';
	        		if(!empty($dataSend['phone_test_customer'])){
	        			$dataSend['phone_test_customer'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_test_customer']));
            			$dataSend['phone_test_customer'] = str_replace('+84','0',$dataSend['phone_test_customer']);


            			$infoCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_test_customer']])->first();

            			// danh sách token
                    	$listToken = $modelTokenDevices->find()->where(['id_customer'=>$infoCustomer->id])->all()->toList();

                        if(!empty($listToken)){
                        	$listTokenDevice += $listToken;
                    	}
	        		}
	        	}elseif($dataSend['type_user'] == 'test_member'){
	        		$type = 'Gửi test kiểm tra app Đại lý';
	        		if(!empty($dataSend['phone_test_member'])){
	        			$dataSend['phone_test_member'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_test_member']));
            			$dataSend['phone_test_member'] = str_replace('+84','0',$dataSend['phone_test_member']);


            			$infoMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_test_member']])->first();

            			// danh sách token
                    	$listToken = $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                        if(!empty($listToken)){
                        	$listTokenDevice += $listToken;
                    	}
	        		}
	        	}elseif($dataSend['type_user'] == 'all_customer'){
	        		$type = 'Gửi tất cả khách hàng';
	        		$listTokenDevice =  $modelTokenDevices->find()->where(['id_customer >'=>0])->all()->toList();
	        	}elseif($dataSend['type_user'] == 'all_member'){
	        		$type = 'Gửi tất cả đại lý';
	        		$listTokenDevice =  $modelTokenDevices->find()->where(['id_member >'=>0])->all()->toList();
	        	}else{
	        		$type = 'Gửi toàn hệ thống';
	        		$listTokenDevice =  $modelTokenDevices->find()->where()->all()->toList();
	        	}
	        	$id_customer = [];
	        	$id_member = [];
                if(!empty($listTokenDevice)){
                    foreach ($listTokenDevice as $tokenDevice) {
                        if(!empty($tokenDevice->token_device)){
                            $token_device[] = $tokenDevice->token_device;

                            if(!empty($tokenDevice->id_customer) && !in_array($tokenDevice->id_customer, $id_customer)){
                            	$id_customer[] =  $tokenDevice->id_customer;
                            	
                            }
                            if(!empty($tokenDevice->id_member) && !in_array($tokenDevice->id_member, $id_member)){
                            	$id_member[] =  $tokenDevice->id_member;
                            	
                            }
                        }
                    }


                    if(!empty($token_device)){
                        $return = sendNotification($dataSendNotification, $token_device);

                        if(!empty($id_customer)){
                        	saveNotification($dataSendNotification, $id_customer, @$dataSend['id_object'], 'customer');
                        }

                        if(!empty($id_member)){
                        	saveNotification($dataSendNotification, $id_member, @$dataSend['id_object'], 'member');
                        }

                    }
                }




                $note = $user->type_tv.' '. $user->name.' đã gửi thông báo app cho '.$type.' nội dung gửi '.$dataSend['title'];
       			addActivityHistory($user,$note,'sendNotificationMobile',0);

		        $mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format(count($token_device)).' người dùng</p>';
		    
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('mess', $mess);
	    setVariable('listCampaign', $listCampaign);
	    setVariable('listGroupCustomer', $listGroupCustomer);
	    setVariable('listPositions', $listPositions);
	    setVariable('infoUser', $infoUser);
	}else{
		return $controller->redirect('/login');
	}
}

function sendMessZaloZNS($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    global $modelCategoryConnects;

     $user = checklogin('sendMessZaloZNS');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/statisticAgency');
        }
	    $metaTitleMantan = 'Gửi tin Zalo ZNS';
		$mess= '';

		$modelZaloTemplates = $controller->loadModel('ZaloTemplates');
		$modelCampaigns = $controller->loadModel('Campaigns');
		$modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
		$modelMembers = $controller->loadModel('Members');
		$modelZalos = $controller->loadModel('Zalos');
		$modelCustomers = $controller->loadModel('Customers');
		$modelTransactionHistories = $controller->loadModel('TransactionHistories');

		$infoUser = $modelMembers->find()->where(['id'=>$user->id])->first();

		// lấy data edit
		$infoZalo = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();

    	if(!empty($infoZalo->id_app) && !empty($infoZalo->secret_key) && !empty($infoZalo->id_oa) && !empty($infoZalo->access_token)){
    		if($infoZalo->deadline < time()){
    			refreshTokenZaloOA($infoZalo->id_oa, $infoZalo->id_app);

                $infoZalo = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();
    		}

			// danh sách mẫu tin ZNS
			$conditions = array('id_system'=>$session->read('infoUser')->id_system);
			$listTemplateZNS = $modelZaloTemplates->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

			// danh sách chiến dịch
			$conditions = array('id_member'=>$session->read('infoUser')->id);
			$listCampaign = $modelCampaigns->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

			// danh sách nhóm khách hàng
			$conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
	        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

	        // danh sách chức danh đại lý
	        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active');
	        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

			$today = getdate();
			$listSendBug = [];

			if ($isRequestPost) {
				if($today['hours']<22 && $today['hours']>=6){
			        $dataSend = $input['request']->getData();

			        if(!empty($dataSend['id_zns']) && !empty($dataSend['type_user'])){
			        	$listCustomers = [];

			        	if($dataSend['type_user'] == 'customer_campaign'){
			        		if(!empty($dataSend['id_campaign'])){
			        			$infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$session->read('infoUser')->id])->first();

			        			if(!empty($infoCampaign)){
			        				$conditions = array('id_member'=>$session->read('infoUser')->id, 'id_campaign'=>(int) $infoCampaign->id);

			        				$listCampaignCustomers = $modelCampaignCustomers->find()->where($conditions)->all()->toList();

			        				if(!empty($listCampaignCustomers)){
					                    foreach ($listCampaignCustomers as $key => $value) {
					                        // thông tin khách hàng
					                        $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();

					                        if(!empty($checkCustomer)){
					                        	$listCustomers[] = $checkCustomer;
					                    	}
					                    }
					                }
			        			}
			        		}
			        	}elseif($dataSend['type_user'] == 'customer_group'){
			        		if(!empty($dataSend['id_group_customer'])){
			        			$infoGroup = $modelCategories->find()->where(['id'=>(int) $dataSend['id_group_customer'], 'parent'=>$session->read('infoUser')->id, 'type' => 'group_customer'])->first();

			        			if(!empty($infoGroup)){
				        			$customer_in_group = $modelCategoryConnects->find()->where(['keyword'=>'group_customers','id_category'=> (int) $dataSend['id_group_customer']])->all()->toList();

				        			if(!empty($customer_in_group)){
				        				foreach ($customer_in_group as $key => $value) {
				        					// thông tin khách hàng
					                        $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_parent])->first();

					                        if(!empty($checkCustomer)){
					                        	$listCustomers[] = $checkCustomer;
					                    	}
				        				}
				        			}
				        		}
			        		}else{
			        			$join = [
								            [
								                'table' => 'category_connects',
								                'alias' => 'CategoryConnects',
								                'type' => 'LEFT',
								                'conditions' => [
								                    'Customers.id = CategoryConnects.id_parent'
								                ],
								            ]
								        ];

								$select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

								$conditions = array('CategoryConnects.id_category'=>$session->read('infoUser')->id, 'CategoryConnects.keyword'=>'member_customers');

			        			$listCustomers = $modelCustomers->find()->join($join)->select($select)->where($conditions)->all()->toList();
			        		}
			        	}elseif($dataSend['type_user'] == 'member_position'){
			        		if(!empty($dataSend['id_position'])){
			        			$infoPosition = $modelCategories->find()->where(['id'=>(int) $dataSend['id_position'], 'type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active'])->first();

			        			if(!empty($infoPosition)){
			        				$listCustomers = $modelMembers->find()->where(['id_position'=>(int) $dataSend['id_position']])->all()->toList();
			        			}
			        		}
			        	}elseif($dataSend['type_user'] == 'test'){
			        		if(!empty($dataSend['phone_test'])){
			        			$infoCustomer = $modelCustomers->newEmptyEntity();

			        			$dataSend['phone_test'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_test']));
                    			$dataSend['phone_test'] = str_replace('+84','0',$dataSend['phone_test']);

			        			$infoCustomer->id = 0;
			        			$infoCustomer->full_name = 'Khách Test';
			        			$infoCustomer->phone = $dataSend['phone_test'];

			        			$listCustomers[] = $infoCustomer;
			        		}
			        	}
			        	
			        	if(!empty($listCustomers)){
							$requestMoney = 500 * count($listCustomers);

							if($infoUser->coin >= $requestMoney){
								// gửi tin Zalo 
				                $numberSend = 0;
				                foreach ($listCustomers as $customer) {
				                	if(strlen($customer->phone) == 10){
							    		$params = [];

	                                    foreach ($dataSend['variable'] as $key => $variable) {
	                                    	if(!empty($variable)){
		                                        if(!empty($dataSend['value'][$key])){
		                                        	$name = (!empty($customer->full_name))?$customer->full_name:$customer->name;
		                                        	$nameCampaign = @$infoCampaign->name;
		                                        	$nameGroup = @$infoGroup->name;
		                                        	$namePosition = @$infoPosition->name;

		                                            $smsSend = str_replace('%name%', $name, $dataSend['value'][$key]);
		                                            $smsSend = str_replace('%phone%', $customer->phone, $smsSend);
		                                            $smsSend = str_replace('%id_user%', $customer->id, $smsSend);
		                                            $smsSend = str_replace('%campaign_name%', $nameCampaign, $smsSend);
		                                            $smsSend = str_replace('%group_name%', $nameGroup, $smsSend);
		                                            $smsSend = str_replace('%position_name%', $namePosition, $smsSend);
		                                            

		                                            $params[$variable] = $smsSend;
		                                        }else{
		                                        	$mess= '<p class="text-danger">Nhập thiếu giá trị biến <b>'.$variable.'</b></p>';
		                                        	echo $mess;die;
		                                        }
		                                    }
	                                    }

	                                    if(!empty($params) && strlen($customer->phone)==10){
	                                        $returnZalo = sendZNSZalo($dataSend['id_zns'], $params, $customer->phone, $infoZalo->id_oa, $infoZalo->id_app);
	                                        
	                                        if($returnZalo['error']==0){
	                                            $numberSend ++;
	                                        }elseif($returnZalo['error']!=0){
	                                            //$mess = $returnZalo['message'];
	                                            //echo $mess;
	                                            $listSendBug[$customer->phone] = $returnZalo['message'];
	                                        }
	                                    }else{
	                                    	$mess= '<p class="text-danger">Nhập thiếu giá trị biến hoặc sai định dạng số điện thoại '.$customer->phone.'</p>';
	                                    	echo $mess;die;
	                                    }
	                                }
						        }

						        if($numberSend > 0){
							        // trừ tiền tài khoản
							        $requestMoney = $numberSend * 500;

							        $infoUser->coin -= $requestMoney;
							        $modelMembers->save($infoUser);

							        // tạo lịch sử giao dịch
					                $histories = $modelTransactionHistories->newEmptyEntity();

					                $histories->id_member = $infoUser->id;
					                $histories->id_system = $infoUser->id_system;
					                $histories->coin = $requestMoney;
					                $histories->type = 'minus';
					                $histories->note = 'Trừ tiền dịch vụ gửi '.number_format($numberSend).' tin nhắn Zalo ZNS '.$dataSend['id_zns'].' cho khách hàng, số dư tài khoản sau giao dịch là '.number_format($infoUser->coin).'đ';
					                $histories->create_at = time();
					                
					                $modelTransactionHistories->save($histories);

					                $note = $user->type_tv.' '. $user->name.' đã gửi  tin nhắn Zalo ZNS cho khách hàng ';
       								addActivityHistory($user,$note,'sendMessZaloZNS',0);

							        $mess = '<p class="text-success">Gửi thành công '.number_format($numberSend).' tin nhắn Zalo ZNS cho khách hàng</p>';
						        }else{
						        	$mess= '<p class="text-danger">Không gửi được tin nhắn cho khách hàng nào</p>';

						        	if(!empty($listSendBug)){
						        		foreach ($listSendBug as $phoneBug => $messBug) {
						        			$mess .= '<p class="text-danger">'.$phoneBug.': '.$messBug.'</p>';
						        		}
						        	}
						        }	
						    }else{
						    	$mess = '<p class="text-danger">Tài khoản bạn không đủ tiền, vui lòng nạp thêm '.number_format($requestMoney).'đ để gửi tin nhắn Zalo cho '.number_format(count($listCustomers)).' khách hàng. Liên hệ hotline 081.656.000 để được hỗ trợ nạp tiền</p>';	
						    }
				        }else{
				        	$mess= '<p class="text-danger">Không tìm được khách hàng phù hợp</p>';
				        }
				    
				    }else{
				    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
				    }
				}else{
					$mess= '<p class="text-danger">Hệ thống Zalo không cho phép gửi tin từ 22h hôm trước đến 6h hôm sau</p>';
				}
		    }

		    setVariable('mess', $mess);
		    setVariable('listTemplateZNS', $listTemplateZNS);
		    setVariable('listCampaign', $listCampaign);
		    setVariable('listGroupCustomer', $listGroupCustomer);
		    setVariable('listPositions', $listPositions);
		    setVariable('today', $today);
		    setVariable('infoUser', $infoUser);
		}else{
    		return $controller->redirect('/setttingZaloOA/?status=emptyData');
    	}
	}else{
		return $controller->redirect('/login');
	}
}
?>