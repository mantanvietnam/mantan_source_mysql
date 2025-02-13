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
                            saveNotification($dataSendNotification, $friend->id, $user->id);
                    	}
        				return array('code'=>1, 'messages'=>'bạn gửi yêu cầu kết bạn thành công', 'notification'=>$dataSendNotification);
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
    global $urlHomes;
    
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

                    $friend->linkinfo = $urlHomes.'infoCustomer?id='.$friend->id;
                    $friend->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$urlHomes.'infoCustomer?id='.$friend->id;
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
    global $urlHomes;
    
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
                    $friend->linkinfo = $urlHomes.'infoCustomer?id='.$friend->id;
                    $friend->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$urlHomes.'infoCustomer?id='.$friend->id;

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
                            saveNotification($dataSendNotification, $friend->id,  $user->id);
                        }
                        return array('code'=>1, 'messages'=>'bạn đã đồng ý thành công', 'notification'=>$dataSendNotification);
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
         
            if(!empty($user)){
               

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
                                $modelMakeFriend->delete($checkFriend);
                            }
                        return array('code'=>1, 'messages'=>'Bạn block thành công ');
                    }
                     return array('code'=>1, 'messages'=>'Bạn block thành công ');
                }
                 return array('code'=>1, 'messages'=>'Bạn block thành công ');
                 
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

function sendGreenCheckRequestAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelMember = $controller->loadModel('Members');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelVerifyAccount = $controller->loadModel('VerifyAccounts');
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
                $total_friend = $modelMakeFriend->find()->where($conditions)->count();
                $member = $modelMember->find()->where(['id_father'=>0])->first();
                $point = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$user->id])->first()->point;
                 $checkVerify = $modelVerifyAccount->find()->where(['id_customer'=>$user->id])->first();
                if(!empty($checkVerify->image_card_after) && !empty($checkVerify->image_card_before) && !empty($checkVerify->image_face) && !empty($checkVerify->link_news) && !empty($checkVerify->image_license_before) && !empty($checkVerify->image_license_after) && $total_friend>=1000 && $point>=5000){
                    $data = $modelCustomer->find()->where(['ìd'=>$user->id])->first();
                    $data->blue_check = 'request';
                    $data->updated_at = time();
                    $modelCustomer->save($data);
                    
                    sendEmailCustomerRequestCheck($user->full_name,$user->phone);

                    return array('code'=>3, 'messages'=>'Yêu cầu của bạn đã được gửi đi và đang được xử lý','infoUser'=>$data);
                }

                return array('code'=>4, 'messages'=>'Bạn chưa đủ điều khện lên tích xanh');
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
   
} 


function sendVerifyAccountAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelMember = $controller->loadModel('Members');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelVerifyAccount = $controller->loadModel('VerifyAccounts');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                $checkVerify = $modelVerifyAccount->find()->where(['id_customer'=>$user->id])->first();
                if(empty($checkVerify)){
                    $checkVerify =$modelVerifyAccount->newEmptyEntity();
                    $checkVerify->created_at = time();
                    $checkVerify->id_customer = $user->id;
                }

                if(isset($_FILES['image_face']) && empty($_FILES['image_face']["error"])){
                    $image_face = uploadImage($user->id, 'image_face', 'image_face_customer'.$user->id);

                }
                if(!empty($image_face['linkOnline'])){
                    $checkVerify->image_face = $image_face['linkOnline'];
                }

                if(isset($_FILES['image_card_before']) && empty($_FILES['image_card_before']["error"])){
                    $image_card_before = uploadImage($user->id, 'image_card_before', 'image_card_before'.$user->id);
                }
                if(!empty($image_card_before['linkOnline'])){
                    $checkVerify->image_card_before = $image_card_before['linkOnline'];
                }

                if(isset($_FILES['image_card_after']) && empty($_FILES['image_card_after']["error"])){
                    $image_card_after = uploadImage($user->id, 'image_card_after', 'image_card_after'.$user->id);
                }
                if(!empty($image_card_after['linkOnline'])){
                    $checkVerify->image_card_after = $image_card_after['linkOnline'];
                }

                if(isset($_FILES['image_license_before']) && empty($_FILES['image_license_before']["error"])){
                    $image_license_before = uploadImage($user->id, 'image_license_before', 'image_license_before'.$user->id);
                }
                if(!empty($image_license_before['linkOnline'])){
                    $checkVerify->image_license_before = $image_license_before['linkOnline'];
                }

                if(isset($_FILES['image_license_after']) && empty($_FILES['image_license_after']["error"])){
                    $image_license_after = uploadImage($user->id, 'image_license_after', 'image_license_after'.$user->id);
                }
                if(!empty($image_license_after['linkOnline'])){
                    $checkVerify->image_license_after = $image_license_after['linkOnline'];
                }

                if(!empty($dataSend['link_news'])){
                    $checkVerify->link_news = $dataSend['link_news'];
                }

                $checkVerify->updated_at = time();
                $modelVerifyAccount->save($checkVerify);

                $user =  getCustomerByToken($dataSend['token']);

                return array('code'=>1, 'messages'=>'Bạn Xác thực tài khoản của bạn thành công','infoUser'=>$user);
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
   
} 

function deleteCheckRequestAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelMember = $controller->loadModel('Members');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelVerifyAccount = $controller->loadModel('VerifyAccounts');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                    $data = $modelCustomer->find()->where(['ìd'=>$user->id])->first();
                    $data->blue_check = 'lock';
                    $data->updated_at = time();
                    $modelCustomer->save($data);
                    return array('code'=>3, 'messages'=>'bạn dã xóa yêu cầu tích xanh ','infoUser'=>$data);
            }
             
            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }
    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
} 
?>

