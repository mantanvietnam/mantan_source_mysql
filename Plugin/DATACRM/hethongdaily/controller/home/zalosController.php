<?php 
function setttingZaloOA($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){

	    $metaTitleMantan = 'Cài đặt Zalo OA';

		$modelZalos = $controller->loadModel('Zalos');

		$mess= '';

		$infoUser = $session->read('infoUser');

		// lấy data edit
		$data = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();

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
		        $data->id_system = $infoUser->id_system;

		        $modelZalos->save($data);

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

    if(!empty($session->read('infoUser'))){
    	$infoUser = $modelMembers->find()->where(['id'=>$session->read('infoUser')->id])->first();

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

    if(!empty($session->read('infoUser'))){
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

		$infoUser = $session->read('infoUser');

		// danh sách chiến dịch
		$conditions = array('id_member'=>$session->read('infoUser')->id);
		$listCampaign = $modelCampaigns->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

		// danh sách nhóm khách hàng
		$conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        // danh sách chức danh đại lý
        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system);
        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['content']) && !empty($dataSend['title'])){
	        	$dataSendNotification= array('title'=>$dataSend['title'],'time'=>date('H:i d/m/Y'),'content'=>$dataSend['content'],'action'=>'notificationAdmin');
                $token_device = [];

	        	if($dataSend['type_user'] == 'customer_campaign'){
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
	        		}
	        	}elseif($dataSend['type_user'] == 'member_position'){
	        		if(!empty($dataSend['id_position'])){
	        			$infoPosition = $modelCategories->find()->where(['id'=>(int) $dataSend['id_position'], 'type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system])->first();

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
	        		$listTokenDevice =  $modelTokenDevices->find()->where(['id_customer >'=>0])->all()->toList();
	        	}elseif($dataSend['type_user'] == 'all_member'){
	        		$listTokenDevice =  $modelTokenDevices->find()->where(['id_member >'=>0])->all()->toList();
	        	}else{
	        		$listTokenDevice =  $modelTokenDevices->find()->where()->all()->toList();
	        	}

                if(!empty($listTokenDevice)){
                    foreach ($listTokenDevice as $tokenDevice) {
                        if(!empty($tokenDevice->token_device)){
                            $token_device[] = $tokenDevice->token_device;
                        }
                    }

                    if(!empty($token_device)){
                        $return = sendNotification($dataSendNotification, $token_device);
                    }
                }

		        $mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format(count($token_device)).' người dùng</p>';
		    
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('mess', $mess);
	    setVariable('listCampaign', $listCampaign);
	    setVariable('listGroupCustomer', $listGroupCustomer);
	    setVariable('listPositions', $listPositions);
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

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Gửi tin Zalo ZNS';
		$mess= '';

		$modelZaloTemplates = $controller->loadModel('ZaloTemplates');
		$modelCampaigns = $controller->loadModel('Campaigns');
		$modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
		$modelMembers = $controller->loadModel('Members');
		$modelZalos = $controller->loadModel('Zalos');
		$modelCustomers = $controller->loadModel('Customers');
		$modelTransactionHistories = $controller->loadModel('TransactionHistories');

		$infoUser = $modelMembers->find()->where(['id'=>$session->read('infoUser')->id])->first();

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
	        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system);
	        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

			$today = getdate();

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
			        		}
			        	}elseif($dataSend['type_user'] == 'member_position'){
			        		if(!empty($dataSend['id_position'])){
			        			$infoPosition = $modelCategories->find()->where(['id'=>(int) $dataSend['id_position'], 'type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system])->first();

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
						    		$params = [];

                                    foreach ($dataSend['variable'] as $key => $variable) {
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
                                        }
                                    }

                                    if(!empty($params) && strlen($customer->phone)==10){
                                        $returnZalo = sendZNSZalo($dataSend['id_zns'], $params, $customer->phone, $infoZalo->id_oa, $infoZalo->id_app);
                                        
                                        if($returnZalo['error']==0){
                                            $numberSend ++;
                                        }elseif($returnZalo['error']!=0){
                                            $mess = $returnZalo['message'];
                                            echo $mess;die;
                                        }
                                    }else{
                                    	$mess= '<p class="text-danger">Nhập thiếu giá trị biến hoặc sai định dạng số điện thoại '.$customer->phone.'</p>';
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

							        $mess = '<p class="text-success">Gửi thành công '.number_format($numberSend).' tin nhắn Zalo ZNS cho khách hàng</p>';
						        }else{
						        	$mess= '<p class="text-danger">Không gửi được tin nhắn cho khách hàng nào</p>';
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