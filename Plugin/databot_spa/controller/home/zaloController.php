<?php 
function addFriendZaloMarketing()
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
?>