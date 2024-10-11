<?php 
function sendFriendRequestApi($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            if (!empty($user)) {
               

                if(function_exists('getInfoCustomerMember')){
            	$friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
        		}

        		if (!empty($friend)) {
        			$conditions = ['id_customer_request' => $user->id,'id_customer_confirm'=>$friend->id];
        			$checkFriend = $modelMakeFriend->find()->where($conditions)->first();
        			if(empty($checkFriend)){
        				$checkFriend = $modelMakeFriend->newEmptyEntity();

        				$checkFriend->id_customer_request = $user->id;
        				$checkFriend->id_customer_confirm = $friend->id;
        				$checkFriend->status = 'request';
        				$checkFriend->created_at = time();
        				$checkFriend->updated_at = time();
        				$modelMakeFriend->save($checkFriend);

        				$dataSendNotification= array('title'=>'Gửi yêu cầu kết bạn',
        					'time'=>date('H:i d/m/Y'),
        					'content'=>"$user->full_name đã gửi yêu cầu kết bạn vời bạn",
        					'id_friend'=>"$user->id",
        					'action'=>'sendFriendRequest');

        				if(!empty($friend->token_device)){
                        	sendNotification($dataSendNotification, $friend->token_device);
                    	}
        				return array('code'=>1, 'messages'=>'bạn gửi yêu cầu kết bạn thành công');
        			}
        			if($checkFriend->status == 'request'){
        				return array('code'=>4, 'messages'=>'đang chờ xác nhận ');
        			}elseif($checkFriend->status == 'agree'){
        				return array('code'=>3, 'messages'=>'đã trở thành bạn bè');
        			}
        		}
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');


}

function getCustomerByPhomeApi($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['phone'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            if (!empty($user)) {
                $conditions = ['id_user' => $user->id];

                if(function_exists('getInfoCustomerMember')){
            	$friend =  getInfoCustomerMember($dataSend['phone'], 'phone');
        		}	
                
        		if (!empty($friend)) {
        			$conditions = ['id_customer_request' => $user->id,'id_customer_confirm'=>$friend->id];
        			$checkFriendRequest = $modelMakeFriend->find()->where($conditions)->first();

        			$conditions = ['id_customer_request' => $friend->id,'id_customer_confirm'=>$user->id];
        			$checkFriendConfirm = $modelMakeFriend->find()->where($conditions)->first();

        			if(!empty($checkFriendRequest)){
                       if($checkFriendRequest->status == 'request'){
        				$friend->status_friend = "request";
        			   }elseif($checkFriendRequest->status == 'agree'){
        				$friend->status_friend = "friend";
        			   }
        			}elseif(!empty($checkFriendConfirm)){
                       if($checkFriendConfirm->status == 'request'){
        				$friend->status_friend = "confirm";
        			   }elseif($checkFriendConfirm->status == 'agree'){
        				$friend->status_friend = "friend";
        			   }
        			}else{
        				$friend->status_friend = "yet";
        			}


        			unset($friend->pass);
        			unset($friend->token_device);
        			unset($friend->token);
        			unset($friend->reset_password_code);
            	    return array('code'=>1,'data'=>$friend, 'messages'=>'Lấy dữ liệu thành công');
            	}
            	return array('code'=>3,'data'=>null, 'messages'=>'số điện thoại này không tồn tại ');
            }

            return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');


}

function listFriendApi($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['phone'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            if (!empty($user)) {
                $conditions = ['id_user' => $user->id];
        			$conditions = ['status'=>"agree"];

        			$conditions['OR'] = [ 
            			['id_customer_request'=>$user->id],
            			['id_customer_confirm'=>$user->id],
        			];
        			$checkFriend = $modelMakeFriend->find()->where($conditions)->all()->toList();
        			$listData =array();
        			if(!empty($checkFriend)){
        				foreach($checkFriend as $key => $item){
        					if($item->id_customer_request!=$user->id){
        						$friend = $modelCustomer->find()->where(['id_customer_request'=>$item->id_customer_request])->first();
        						unset($friend->pass);
        						unset($friend->token_device);
        						unset($friend->token);
        						unset($friend->reset_password_code);
        						$listData[] = $friend;
        					}elseif($item->id_customer_confirm!=$user->id){
        						$friend = $modelCustomer->find()->where(['id_customer_confirm'=>$item->id_customer_confirm])->first();
        						unset($friend->pass);
        						unset($friend->token_device);
        						unset($friend->token);
        						unset($friend->reset_password_code);
        						$listData[] = $friend;
        					}
        					

        				}
        			}
        			
            	    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
            	}
            	

            return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');
}
?>

