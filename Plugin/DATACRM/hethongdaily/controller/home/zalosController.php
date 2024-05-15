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

	        if(!empty($dataSend['id_oa']) && !empty($dataSend['id_app']) && !empty($dataSend['secret_key']) && !empty($dataSend['template_otp'])){
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

		$infoUser = $session->read('infoUser');

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['content']) && !empty($dataSend['title'])){
	        	$dataSendNotification= array('title'=>$dataSend['title'],'time'=>date('H:i d/m/Y'),'content'=>$dataSend['content'],'action'=>'notificationAdmin');
                $token_device = [];

                $listTokenDevice =  $modelTokenDevices->find()->where()->all()->toList();

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

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Gửi tin Zalo ZNS';
		$mess= '';

		$modelZaloTemplates = $controller->loadModel('ZaloTemplates');

		$conditions = array('id_system'=>$session->read('infoUser')->id_system);
		$listTemplateZNS = $modelZaloTemplates->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

		$today = getdate();

		if ($isRequestPost) {
			if($today['hours']<22 && $today['hours']>=6){
		        $dataSend = $input['request']->getData();

		        if(!empty($dataSend['id_zns'])){
		        	

			        $mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format(count($token_device)).' người dùng</p>';
			    
			    }else{
			    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
			    }
			}else{
				$mess= '<p class="text-danger">Hệ thống Zalo không cho phép gửi tin từ 22h hôm trước đến 6h hôm sau</p>';
			}
	    }

	    setVariable('mess', $mess);
	    setVariable('listTemplateZNS', $listTemplateZNS);
	    setVariable('today', $today);
	}else{
		return $controller->redirect('/login');
	}
}
?>