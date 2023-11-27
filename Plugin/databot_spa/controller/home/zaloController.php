<?php 
function settingZaloMarketing($input)
{
	global $controller;
    global $isRequestPost;
    global $urlHomes;
    global $session;
    
    $modelMembers = $controller->loadModel('Members');

	if(!empty(checkLoginManager('settingZaloMarketing', 'zalo'))){
		$mess = '';
		$loginUrl = '';

		if(!empty($_GET['status'])){
			switch ($_GET['status']) {
				case 'errorAccessToken':
					$mess = '<p class="text-danger">Mã token hết hạn, hãy cấp lại quyền</p>';		
					break;
				
				case 'emptyData':
					$mess = '<p class="text-danger">Bạn cần cài đặt cấp quyền Zalo trước khi sử dụng các chức năng khác</p>';		
					break;
			}
		}

		$infoUser = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			$checkApp = $modelMembers->find()->where(['id !='=>$infoUser->id, 'id_app_zalo'=>$dataSend['id_app_zalo']])->first();

			if(empty($checkApp)){
				$infoUser->id_app_zalo = $dataSend['id_app_zalo'];
				$infoUser->secret_app_zalo = $dataSend['secret_app_zalo'];
				$infoUser->id_oa_zalo = $dataSend['id_oa_zalo'];

				$modelMembers->save($infoUser);

				$mess = '<p class="text-success">Lưu dữ liệu thành công</p>';	
			}else{
				$mess = '<p class="text-danger">ID APP đã được cài ở tài khoản khác</p>';	
			}
		}

		if(!empty($infoUser->id_app_zalo) && !empty($infoUser->secret_app_zalo) && empty($infoUser->access_token_zalo)){
			$config = array(
			    'app_id' => $infoUser->id_app_zalo,
			    'app_secret' => $infoUser->secret_app_zalo
			);

			$zalo = new Zalo\Zalo($config);

			$helper = $zalo -> getRedirectLoginHelper();
			$callbackUrl = $urlHomes."callbackZalo";

			$random = bin2hex(openssl_random_pseudo_bytes(32));
		    $codeVerifier = base64url_encode(pack('H*', $random));
		    $codeChallenge = base64url_encode(pack('H*', hash('sha256', $codeVerifier)));

			$state = $session->read('infoUser')->id;

			$loginUrl = $helper->getLoginUrl($callbackUrl, $codeChallenge, $state); // This is login url

			$session->write('codeVerifierZalo', $codeVerifier);
		}

		

		setVariable('loginUrl', $loginUrl);
		setVariable('mess', $mess);
		setVariable('infoUser', $infoUser);
	}else{
		return $controller->redirect('/login');
	}
}

function callbackZalo($input)
{
	global $controller;
    global $isRequestPost;
    global $urlHomes;
    global $session;
    
    $modelMembers = $controller->loadModel('Members');

    if(!empty(checkLoginManager('settingZaloMarketing', 'zalo'))){

		if(!empty($_GET['state'])){
			$infoUser = $modelMembers->find()->where(['id'=>(int) $_GET['state']])->first();

			if(!empty($infoUser->id_app_zalo) && !empty($infoUser->secret_app_zalo)){
				$config = array(
				    'app_id' => $infoUser->id_app_zalo,
				    'app_secret' => $infoUser->secret_app_zalo
				);
				
				$zalo = new Zalo\Zalo($config);

				$helper = $zalo -> getRedirectLoginHelper();

			    $codeVerifier = $session->read('codeVerifierZalo');
				$zaloToken = $helper->getZaloToken($codeVerifier); // get zalo token
				$accessToken = $zaloToken->getAccessToken();

				$infoUser->access_token_zalo = $accessToken;

				$modelMembers->save($infoUser);
			}
		}

		return $controller->redirect('/settingZaloMarketing');
	}else{
		return $controller->redirect('/login');
	}
}

function addFriendZaloMarketing($input)
{
	global $controller;
    global $isRequestPost;
    global $urlHomes;
    global $session;
    
    $modelMembers = $controller->loadModel('Members');

    if(!empty(checkLoginManager('addFriendZaloMarketing', 'zalo'))){
		$infoUser = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

		if(!empty($infoUser->id_app_zalo) && !empty($infoUser->secret_app_zalo) && !empty($infoUser->access_token_zalo)){
			$config = array(
			    'app_id' => $infoUser->id_app_zalo,
			    'app_secret' => $infoUser->secret_app_zalo
			);
			
			$zalo = new Zalo\Zalo($config);

			$accessToken = $infoUser->access_token_zalo;
			$params = ['fields' => 'id,name,picture'];
			$response = $zalo->get(Zalo\ZaloEndPoint::API_GRAPH_ME, $accessToken, $params);
			$infoZalo = $response->getDecodedBody(); // result

			if($infoZalo['error'] > 0){
				$infoUser->access_token_zalo = '';
				$modelMembers->save($infoUser);

				return $controller->redirect('/settingZaloMarketing/?status=errorAccessToken');
			}

			setVariable('infoZalo', $infoZalo);
		}else{
			return $controller->redirect('/settingZaloMarketing/?status=emptyData');
		}
	}else{
		return $controller->redirect('/login');
	}
}

function callbackZaloOA($input)
{
	global $controller;

	if(!empty($_GET['code']) && !empty($_GET['oa_id'])){
		$modelMembers = $controller->loadModel('Members');

		$infoUser = $modelMembers->find()->where(['id_oa_zalo'=>$_GET['oa_id']])->first();

		if(!empty($infoUser)){
			$infoUser->code_zalo_oa = $_GET['code'];

			$modelMembers->save($infoUser);

			$return = getAccessTokenZaloOA($infoUser->id_oa_zalo, $infoUser->id_app_zalo);
		}
	}

	return $controller->redirect('/settingZaloMarketing');
}

function sendMessZaloOA($input)
{
	global $controller;
    global $isRequestPost;
    global $urlHomes;
    global $session;
    
    $modelMembers = $controller->loadModel('Members');
    $modelTransactionHistories = $controller->loadModel('TransactionHistories');

    if(!empty(checkLoginManager('sendMessZaloOA', 'zalo'))){
    	$infoUser = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

    	if(!empty($infoUser->id_app_zalo) && !empty($infoUser->secret_app_zalo) && !empty($infoUser->id_oa_zalo) && !empty($infoUser->access_token_zalo_oa)){
    		if($infoUser->deadline_token_zalo_oa < time()){
    			refreshTokenZaloOA($infoUser->id_oa_zalo, $infoUser->id_app_zalo);

                $infoUser = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();
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
					        $header_zns = ['access_token: '.$infoUser->access_token_zalo_oa];
					        $data_send_zns = [];

						    $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns);

						    $return_zns = json_decode($return_zns, true);

						    $listFollowers += $return_zns['data']['followers'];
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
					            $header_zns = ['Content-Type: application/json', 'access_token: '.$infoUser->access_token_zalo_oa];
					            $typeData='raw';
					            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns,$typeData);
					        }

					        $mess = '<p class="text-success">Gửi thành công '.number_format(count($listFollowers)).' tin nhắn Zalo cho khách hàng</p>';	
					    }else{
					    	$mess = '<p class="text-danger">Tài khoản bạn không đủ tiền, vui lòng nạp thêm '.number_format($requestMoney).'đ để gửi tin nhắn Zalo cho '.number_format(count($listFollowers)).' khách hàng</p>';	
					    }
			        }
		        }else{
		        	$mess = '<p class="text-danger">Bạn chưa soạn nội dung tin nhắn</p>';	
		        }
	        }

	        setVariable('mess', $mess);
    	}else{
    		return $controller->redirect('/settingZaloMarketing/?status=emptyData');
    	}
    }else{
		return $controller->redirect('/login');
	}
}
?>