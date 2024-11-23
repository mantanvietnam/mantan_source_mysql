<?php 
function sendFriendRequestApi($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id_friend'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            if (!empty($user)) {
               

                if(function_exists('getInfoCustomerMember')){
            	$friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
        		}

        		if (!empty($friend)) {
                    $block = explode(",", $friend->id_friend_block);
                    $userblock = explode(",", $user->id_friend_block);
                    if (in_array($user->id, $block) || in_array($friend->id, $userblock)) {
                          return array('code'=>3,'data'=>null, 'messages'=>'bạn bè này không tồn tại ');
                    }
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
        				return array('code'=>5, 'messages'=>'đã trở thành bạn bè');
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

                if(function_exists('getInfoCustomerMember')){
            	$friend =  getInfoCustomerMember($dataSend['phone'], 'phone');
        		}	
                
        		if (!empty($friend)) {
                    $userblock = explode(",", $user->id_friend_block);
                    $block = explode(",", $user->id_friend_block);
                    if (in_array($user->id, $block) || in_array($friend->id, $userblock)) {
                          return array('code'=>3,'data'=>null, 'messages'=>'số điện thoại này không tồn tại ');
                    }
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

function getCustomerByIdApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id_friend'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {

                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember($dataSend['id_friend'], 'id');
                }   
                
                if (!empty($friend)) {
                    $block = explode(",", $friend->id_friend_block);
                    $userblock = explode(",", $user->id_friend_block);
                    if (in_array($user->id, $block) || in_array($friend->id, $userblock)) {
                          return array('code'=>3,'data'=>null, 'messages'=>'bạn bè này không tồn tại ');
                    }
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
                return array('code'=>3,'data'=>null, 'messages'=>'bạn bè này không tồn tại ');
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

        if (!empty($dataSend['token'])) {
        	if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
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
                          $friend = $modelCustomer->find()->where(['id'=>$item->id_customer_request])->first();
                          unset($friend->pass);
                          unset($friend->token_device);
                          unset($friend->token);
                          unset($friend->reset_password_code);
                          $listData[] = $friend;
                        }elseif($item->id_customer_confirm!=$user->id){
                          $friend = $modelCustomer->find()->where(['id'=>$item->id_customer_confirm])->first();
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

function sendFriendConfirmApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])  && !empty($dataSend['id_friend'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
               

                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
                }

                if (!empty($friend)) {
                    $conditions = ['id_customer_request' => $friend->id,'id_customer_confirm'=>$user->id, 'status'=>'request'];
                    $checkFriend = $modelMakeFriend->find()->where($conditions)->first();
                    if(!empty($checkFriend)){
                        
                        $checkFriend->status = 'agree';
                        $checkFriend->created_at = time();
                        $checkFriend->updated_at = time();
                        $modelMakeFriend->save($checkFriend);

                        $dataSendNotification= array('title'=>'Đã đồng ý kết bạn',
                            'time'=>date('H:i d/m/Y'),
                            'content'=>"$user->full_name đã đồng ý kết bạn vời bạn",
                            'id_friend'=>"$user->id",
                            'action'=>'sendFriendRequest');

                        if(!empty($friend->token_device)){
                            sendNotification($dataSendNotification, $friend->token_device);
                        }
                        return array('code'=>1, 'messages'=>'bạn đã đồng ý thành công');
                    }
                   
                        return array('code'=>4, 'messages'=>'đã trở thành bạn bè');
                }
                 
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}


function listFriendRequestApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                    $conditions = ['status'=>"Request"];

                    $conditions['id_customer_request']=$user->id;
                    
                    $checkFriend = $modelMakeFriend->find()->where($conditions)->all()->toList();
                    $listData =array();
                    if(!empty($checkFriend)){
                        foreach($checkFriend as $key => $item){
                                $friend = $modelCustomer->find()->where(['id'=>$item->id_customer_confirm])->first();
                                unset($friend->pass);
                                unset($friend->token_device);
                                unset($friend->token);
                                unset($friend->reset_password_code);
                                $listData[] = $friend;
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

function listFriendConfirmApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                    $conditions = ['status'=>"Request"];

                    $conditions['id_customer_confirm']=$user->id;
                    
                    $checkFriend = $modelMakeFriend->find()->where($conditions)->all()->toList();
                    $listData =array();
                    if(!empty($checkFriend)){
                        foreach($checkFriend as $key => $item){
                                $friend = $modelCustomer->find()->where(['id'=>$item->id_customer_request])->first();
                                unset($friend->pass);
                                unset($friend->token_device);
                                unset($friend->token);
                                unset($friend->reset_password_code);
                                $listData[] = $friend;
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

function listYetFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                    $conditions = [];

                    $conditions['OR'] = [ 
                        ['id_customer_request'=>$user->id],
                        ['id_customer_confirm'=>$user->id],
                    ];
                    $checkFriend = $modelMakeFriend->find()->where($conditions)->all()->toList();
                    $id_father =array($user->id);
                    if(!empty($checkFriend)){
                        foreach($checkFriend as $key => $item){
                            if($item->id_customer_request!=$user->id){
                                $id_father[] = $item->id_customer_request;
                            }elseif($item->id_customer_confirm!=$user->id){
                                 $id_father[] = $item->id_customer_confirm;
                            }             
                        }
                    }
                    $block = explode(",", $user->id_friend_block);
                    if(!empty($block)){
                        foreach($block as $key => $item){
                            if(!empty($item)){
                                $id_father[] =(int) $item;
                            }
                                        
                        }
                    }
                   
                    $listData = $modelCustomer->find()->where(['id NOT IN' => $id_father])->all()->toList();
                    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
                }
                return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');
}


function unFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id_friend'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {

                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember($dataSend['id_friend'], 'id');
                }   
                
                if (!empty($friend)) {
                    $conditions = ['id_customer_request' => $user->id,'id_customer_confirm'=>$friend->id];
                    $checkFriendRequest = $modelMakeFriend->find()->where($conditions)->first();

                    $conditions = ['id_customer_request' => $friend->id,'id_customer_confirm'=>$user->id];
                    $checkFriendConfirm = $modelMakeFriend->find()->where($conditions)->first();

                    if(!empty($checkFriendRequest)){
                       $modelMakeFriend->delete($checkFriendRequest);
                    }elseif(!empty($checkFriendConfirm)){
                       $modelMakeFriend->delete($checkFriendConfirm);
                    }
                    
                    return array('code'=>1, 'messages'=>'bạn hủy kết bạn thành công');
                }
                return array('code'=>3,'data'=>null, 'messages'=>'số điện thoại này không tồn tại ');
            }

            return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');
}

function blockFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])  && !empty($dataSend['id_friend'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
               

                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
                }

                if (!empty($friend) && $friend->id!=$user->id) {

                    if(!empty($friend->id_friend_block)){
                        $friendblock = explode(",", $friend->id_friend_block);
                    }else{
                        $friendblock = array();
                    }

                    if(!empty($user->id_friend_block)){
                        $userblock = explode(",", $user->id_friend_block);
                    }else{
                        $userblock = array();
                    }


                    if(in_array($user->id, $friendblock) || in_array($friend->id, $userblock)){
                         return array('code'=>1, 'messages'=>'bạn block thành công ');
                     }else{

                         
                            $friendblock[]= $user->id;
                            $friend->id_friend_block = implode(',', $friendblock);
                            $userblock[]= $friend->id;
                            $user->id_friend_block = implode(',', $userblock);


                            $modelCustomer->save($friend);
                            $modelCustomer->save($user);
                            $conditions = [];

                            $conditions['OR'] = [ 
                                ['id_customer_request'=>$user->id,'id_customer_confirm'=>$friend->id],
                                ['id_customer_request'=>$friend->id,'id_customer_confirm'=>$user->id],
                            ];
                            $checkFriend = $modelMakeFriend->find()->where($conditions)->first();

                            if(!empty($checkFriend)){
                                $modelMakeFriend->delete($checkFrien);
                            }
                        return array('code'=>1, 'messages'=>'bạn block thành công ');
                    }
                }
                 
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function listBlockFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                    if(!empty($user->id_friend_block)){
                        $userblock = explode(",", $user->id_friend_block);
                    }else{
                        $userblock = array(0);
                    }
                   
                    $listData = $modelCustomer->find()->where(['id  IN' => $userblock])->all()->toList();
                    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
                }
                return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');
}

function cancelBlockFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])  && !empty($dataSend['id_friend'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
               

                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
                }

                if (!empty($friend) && $friend->id!=$user->id) {

                    if(!empty($friend->id_friend_block)){
                        $friendblock = explode(",", $friend->id_friend_block);
                    }else{
                        $friendblock = array();
                    }

                    if(!empty($user->id_friend_block)){
                        $userblock = explode(",", $user->id_friend_block);
                    }else{
                        $userblock = array();
                    }

                    if(in_array($user->id, $friendblock) || in_array($friend->id, $userblock)){
                        $block_friend = [];
                        foreach ($friendblock as $value) {
                            if ($value != $user->id) {
                                $block_friend[] = (int)$value;
                            }
                        }

                        $block_user = [];
                        foreach ($userblock as $value) {
                            if ($value != $friend->id) {
                                $block_user[] = (int)$value;
                            }
                        }

                        $friend->id_friend_block = implode(',', $block_friend);
                        $user->id_friend_block = implode(',', $block_user);
                        $modelCustomer->save($friend);
                        $modelCustomer->save($user);
                        return array('code'=>1, 'messages'=>'bạn bỏ block thành công ');
                    }
                    return array('code'=>1, 'messages'=>'bạn bỏ block thành công ');
                }
                 return array('code'=>1, 'messages'=>'bạn bỏ block thành công ');
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

?>

