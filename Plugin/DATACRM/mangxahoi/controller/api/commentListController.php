<?php 
function addlikeApi($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $listPonint = listPonint();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['type'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                $check = 0;
            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(empty($data)) {
            		$data = $modelLike->newEmptyEntity();
                    $check = 1;
            	}

                if($dataSend['keyword']=='wall_post'){
                    $checkWallPost = $modelWallPost->find()->where(['id'=>(int)$dataSend['id_object']])->first();
                }

		        $data->created_at = time();
		        $data->id_object =(int) $dataSend['id_object'];
		        $data->keyword = $dataSend['keyword'];
		        $data->type = $dataSend['type'];
		        $data->id_customer = $user->id;
        		$modelLike->save($data);

        		   if($data->type=='like'){
                        if(!empty($checkWallPost) && $check ==1 && $checkWallPost->id_customer!=$user->id && function_exists('accumulatePoint')){
                            $note = 'Bạn được công 1 điểm cho người like bài viết của bạn ';
                            accumulatePoint($checkWallPost->id_customer,$listPonint['point_like'],$note);
                            $customer = $modelCustomer->find()->where(['id'=>$checkWallPost->id_customer])->first();
                            $dataSendNotification= array('title'=>"$user->full_name like bài viết của bạn",
                            'time'=>date('H:i d/m/Y'),
                            'content'=>substr($checkWallPost->connent, 0, 160),
                            'id_post'=>"$checkWallPost->id",
                            'action'=>'addlikeApi');

                            if(!empty($customer->token_device)){
                                 sendNotification($dataSendNotification, $customer->token_device);
                                 saveNotification($dataSendNotification, $customer->id, $data->id_object);
                            }
                        }
                        return array('code'=>1,'messages'=>'bạn đã like  thành công ');

                         
                    }elseif($data->type=='dislike'){
                         if(!empty($checkWallPost)  && $check ==1 && $checkWallPost->id_customer!=$user->id && function_exists('minuAccumulatePointlike')){
                              $note = 'Bạn bị trừ 2 điểm cho người dislike bài viết của bạn ';
                            minuAccumulatePointlike($checkWallPost->id_customer,$listPonint['point_dislike'],$note);
                            $customer = $modelCustomer->find()->where(['id'=>$checkWallPost->id_customer])->first();
                            $dataSendNotification= array('title'=>"$user->full_name dislike bài viết của bạn",
                                'time'=>date('H:i d/m/Y'),
                                'content'=>substr($checkWallPost->connent, 0, 160),
                                'id_post'=>"$checkWallPost->id",
                                'action'=>'addlikeApi');

                            if(!empty($customer->token_device)){
                                 sendNotification($dataSendNotification, $customer->token_device);
                                 saveNotification($dataSendNotification, $customer->id, $data->id_object);
                            }
                         }
                        return array('code'=>4,'messages'=>'bạn đã dislike  thành công ');

                         
                    }


    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function delelelikeApi($input){

	global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');

    $listPonint = listPonint();
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
           if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(!empty($data)) {
                    if($dataSend['keyword']=='wall_post'){
                        $checkWallPost = $modelWallPost->find()->where(['id'=>(int)$dataSend['id_object']])->first();
                    }
                    if($data->type=='like'){
                        if(!empty($checkWallPost) && function_exists('minuAccumulatePointlike')){
                            $note = 'Bạn được công 1 điểm cho người like bài viết của bạn ';
                            minuAccumulatePointlike($checkWallPost->id_customer,$listPonint['point_like'],$note);
                        }
                    }elseif($data->type=='dislike'){
                         if(!empty($checkWallPost) && function_exists('accumulatePoint')){
                              $note = 'Bạn bị trừ 2 điểm cho người dislike bài viết của bạn ';
                            accumulatePoint($checkWallPost->id_customer,$listPonint['point_dislike'],$note);
                         }
                    }
            		$modelLike->delete($data);
            		return array('code'=>1,'messages'=>'bạn xóa like thành công');
            	}
		        
            	 return array('code'=>4,'messages'=>'bạn xóa like thành công');
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function checklikeApi ($input){

	global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(!empty($data)) {
            		if($data->type=='like'){
            			return array('code'=>1,'messages'=>'bạn đã like ');
            		}elseif($data->type=='dislike'){
            			return array('code'=>4,'messages'=>'bạn đã dislike ');
            		}
            		
            	}
		        
            	 return array('code'=>5,'messages'=>'bạn chưa likes');
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function addCommentApi($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['comment'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }

            if (!empty($user)){

            	$data = $modelComment->newEmptyEntity();
                $data->created_at = time();
                $data->id_object=(int)@$dataSend['id_object'];
                $data->keyword=@$dataSend['keyword'];
                $data->id_father=(int)@$dataSend['id_father'];
                $data->id_customer=$user->id;
                $data->comment=checkKeyword($dataSend['comment']);

                $modelComment->save($data);

                 if($dataSend['keyword']=='wall_post'){
                        $checkWallPost = $modelWallPost->find()->where(['id'=>(int)$dataSend['id_object']])->first();
                    if(!empty($checkWallPost)){
                        $checkWallPost->updated_at = time();
                        $modelWallPost->save($checkWallPost);
                        $customer = $modelCustomer->find()->where(['id'=>$checkWallPost->id_customer])->first();
                        $dataSendNotification= array('title'=>"$user->full_name bình luận bài viết của bạn",
                            'time'=>date('H:i d/m/Y'),
                            'content'=>substr($checkWallPost->connent, 0, 160),
                            'id_post'=>"$checkWallPost->id",
                            'action'=>'addCommentApi');

                        if(!empty($customer->token_device)){
                           sendNotification($dataSendNotification, $customer->token_device);
                           saveNotification($dataSendNotification, $customer->id, $data->id_object);
                       }
                   }
                }
                return array('code'=>1,'messages'=>'bạn thêm bình luận thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function deleleCommentApi($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }

            if (!empty($user)) {
                    $data = $modelComment->find()->where(['id'=>$dataSend['id'], 'id_customer'=>(int)$user->id])->first();
                if(!empty($user)){    
                    $modelComment->delete($data);
                    return array('code'=>1,'messages'=>'bạn xóa bình luận thành công');
                }
                
                 return array('code'=>4,'messages'=>'bạn xóa like thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function listCommentAPI($input){
    global $controller;
    global $urlCurrent;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Danh sách bình luận';

    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');
     if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['keyword']) && !empty($dataSend['id_object'])){
            $listData = $modelComment->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_father'=>0])->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $listData[$key]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                    $listData[$key]->infoCustomer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first();
                }
            
            }
              return array('code'=>0, 'mess'=> 'lấy dữ liệu thành công','listData'=>$listData); 
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function listNotificationApi($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelNotification = $controller->loadModel('Notifications');
    $listPonint = listPonint();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('pin'=>'asc','updated_at'=>'desc');

                $listData = $modelNotification->find()->limit($limit)->page($page)->where(['id_user like'=>'%"'.$user->id.'"%'])->order(['created_at'=>'DESC'])->all()->toList();
                $totalData = $modelNotification->find()->where(['id_user like'=>'%"'.$user->id.'"%'])->order(['created_at'=>'DESC'])->count();
                return array('code'=>1, 'messages'=> 'lấy dữ liệu thành công','listData'=>$listData,'totalData'=>$totalData); 
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

 ?>