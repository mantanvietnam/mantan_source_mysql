<?php 
function addWallPostApi($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            if (!empty($user)) {
            	$data = $modelWallPost->newEmptyEntity();

            	$data->id_customer = $user->id;
            	$data->connent = $dataSend['connent'];
            	$data->created_at = time();
                $data->updated_at = time();
            	$data->public = $dataSend['public'];

            	$modelWallPost->save($data);
                $total = 0;
            	if(!empty($_FILES['listImage']['name'][0])){
                    foreach($_FILES['listImage']['name'] as $key => $value){
                        $_FILES['listImages'.$key]['name'] = $value;
                        $_FILES['listImages'.$key]['type'] = $_FILES['listImage']['type'][$key];
                        $_FILES['listImages'.$key]['tmp_name'] = $_FILES['listImage']['tmp_name'][$key];
                        $_FILES['listImages'.$key]['error'] = $_FILES['listImage']['error'][$key];
                        $_FILES['listImages'.$key]['size'] = $_FILES['listImage']['size'][$key];
                    }

                    $total = count(@$_FILES['listImage']['name']);
                }

                if(!empty($total)){
                    for($i=0;$i<=$total;$i++){
                        if(isset($_FILES['listImages'.$i]) && empty($_FILES['listImages'.$i]["error"])){
                            if(!empty($data->id)){
                                $fileName = 'image'.$i.'_wallpost_'.$user->id.'_'.$data->id.time().rand(0,1000000);
                            }else{
                                $fileName = 'image'.$i.'_wallpost_'.time().rand(0,1000000);
                            }
                            $image = uploadImage($user->id, 'listImages'.$i, $fileName);
                            if(!empty($image['linkOnline'])){
                                $save = $modelImageCustomer->newEmptyEntity();

                				$save->id_customer = $user->id;
                				$save->id_post = $data->id;
                				$save->image = $image['linkOnline'].'?time='.time();
                				$save->public = $dataSend['public'];
                                $save->link_local = strstr($dataSend['public'], 'upload');
                				$save->created_at = time();
                				$modelImageCustomer->save($save);
                            }
                        }
                    }
                }

                $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();

                $point = listPonint();
                $note = 'bạn được công '.$point['point_wall_post'].' đăng bài liên mạng xã hội';
                accumulatePoint($user->id,$point['point_wall_post'],$note);
               
                return array('code'=>1, 'messages'=>'Bạn đăng bài thành công ', 'data'=>$data);
              
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function  editWallPostApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    $modelLike = $controller->loadModel('Likes');

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                $data = $modelWallPost->find()->where(['id'=>$dataSend['id'],'id_customer'=>$user->id ])->first();
                if(!empty($data)){
                    if(!empty($dataSend['connent'])){
                        $data->connent = $dataSend['connent'];
                    }
                    $data->updated_at = time();
                    if(!empty($dataSend['public'])){
                      $data->public = $dataSend['public'];
                    }
                    $modelWallPost->save($data);
                    $conditions = array('id_post'=>$data->id,'id_customer'=>$user->id);
                    if(!empty($dataSend['id_image_delete'])){
                        $id_image_delete = array_map('intval', explode(',', $dataSend['id_image_delete']));
                        $conditions['id IN'] =$id_image_delete;
                        deletelikeIdObject($id_image_delete,'image_customer');
                        deleteCommentIdObject($id_image_delete,'image_customer');
                        $modelImageCustomer->deleteAll($conditions);
                    }

                    $total = 0;
                    if(!empty($_FILES['listImage']['name'][0])){
                        foreach($_FILES['listImage']['name'] as $key => $value){
                            $_FILES['listImages'.$key]['name'] = $value;
                            $_FILES['listImages'.$key]['type'] = $_FILES['listImage']['type'][$key];
                            $_FILES['listImages'.$key]['tmp_name'] = $_FILES['listImage']['tmp_name'][$key];
                            $_FILES['listImages'.$key]['error'] = $_FILES['listImage']['error'][$key];
                            $_FILES['listImages'.$key]['size'] = $_FILES['listImage']['size'][$key];
                        }

                        $total = count($_FILES['listImage']['name']);
                    }
                    
                    if(!empty($total)){
                        for($i=0;$i<=$total;$i++){
                            if(isset($_FILES['listImages'.$i]) && empty($_FILES['listImages'.$i]["error"])){
                                if(!empty($data->id)){
                                    $fileName = 'image'.$i.'_wallpost_'.$user->id.$data->id.time().rand(0,1000000);
                                }else{
                                    $fileName = 'image'.$i.'_wallpost_'.time().rand(0,1000000);
                                }
                                $image = uploadImage($user->id, 'listImages'.$i, $fileName);
                                if(!empty($image['linkOnline'])){
                                    $save = $modelImageCustomer->newEmptyEntity();

                                    $save->id_customer = $user->id;
                                    $save->id_post = $data->id;
                                    $save->image = $image['linkOnline'].'?time='.time();;
                                    $save->public = $dataSend['public'];
                                    $save->link_local = strstr($dataSend['public'], 'upload');
                                    $save->created_at = time();
                                    $modelImageCustomer->save($save);
                                }
                            }
                        }
                    }
                    $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
               
                return array('code'=>1, 'messages'=>'Bạn sửa bài thành công ', 'data'=>$data);
                }

                return array('code'=>4, 'messages'=>'Bạn không thể sửa bài này được');
              
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function deleteWallPostApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            if (!empty($user)) {
                $data = $modelWallPost->find()->where(['id'=>$dataSend['id'],'id_customer'=>$user->id])->first();
                if(!empty($data)){
                    $conditions = array('id_post'=>$data->id);
                    deletelikeIdObject([$data->id],'wall_post');
                    deleteCommentIdObject([$data->id],'wall_post');
                    $listImage = $modelImageCustomer->find()->where($conditions)->all()->toList();
                    if(!empty($listImage)){
                        foreach($listImage as $key => $item){
                            deletelikeIdObject([$item->id],'image_customer');
                            deleteCommentIdObject([$item->id],'image_customer');
                        }
                    }
                    $modelImageCustomer->deleteAll($conditions);
                    $modelWallPost->delete($data);
               
                    return array('code'=>3, 'messages'=>'Bạn xóa  bài thành công ', 'data'=>$data);
                }
               return array('code'=>3, 'messages'=>'Bạn không được xóa bài này ', 'data'=>$data);
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function listWallPostApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

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
                $listData =array($user->id, 0);
                if(!empty($checkFriend)){
                    foreach($checkFriend as $key => $item){
                        if($item->id_customer_request!=$user->id){
                          $friend = $modelCustomer->find()->where(['id'=>$item->id_customer_request])->first();
                          
                          $listData[] = $friend->id;
                        }elseif($item->id_customer_confirm!=$user->id){
                          $friend = $modelCustomer->find()->where(['id'=>$item->id_customer_confirm])->first();
                          
                          $listData[] = $friend->id;
                        }
                    }
                }
                $userblock = explode(",", $user->id_friend_block);
                if(empty($userblock)){
                    $userblock =[0];
                }

                // debug($userblock);
                // die();
               // $conditions = array('id_customer IN' => $listData, 'public'=>'public');
                 $conditions = array('public'=>'public','id_customer NOT IN' => $userblock);
                $limit = 10;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('pin'=>'asc','id'=>'desc');

                $listData = $modelWallPost->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach($listData as $key => $item){
                        $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                        unset($infoCustomer->pass);
                        unset($infoCustomer->token_device);
                        unset($infoCustomer->token);
                        unset($infoCustomer->reset_password_code);
                        $listData[$key]->infoCustomer = $infoCustomer;
                        $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'wall_post', 'li.type'=>'like'];
                        $json = [
                            [
                                'table' => 'likes',
                                'alias' => 'li',
                                'type' => 'LEFT',
                                'conditions' => [
                                    'Customers.id = li.id_customer'
                                ],
                            ]
                        ];
                        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                        $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                        $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'wall_post', 'li.type'=>'dislike'];
                        $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                        $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post'])->all()->toList();
                        $listcomment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post', 'id_father'=>0])->all()->toList();

                        if(!empty($listcomment)){
                            foreach ($listcomment as $k => $value) {
                                $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                            }
                        
                        }
                        $listData[$key]->like = count($like);
                        $listData[$key]->infoLike = $like;
                        $listData[$key]->dislike = count($dislike);
                        $listData[$key]->infoDislike = $dislike;
                        $listData[$key]->comment = count($comment);     
                        $listData[$key]->infoComment = $listcomment;     
                        $listData[$key]->listImage = @$modelImageCustomer->find()->where(['id_post'=>$item->id])->all()->toList();          
                    }
                }



                return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
            }


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}


function listWallPostFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);


           }
           if (!empty($user)) {
                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
                }
                if (!empty($friend)) {
                    $conditions = ['status'=>"agree"];

                    
                    $conditions = array('id_customer' => $friend->id, 'public'=>'public');
                    $limit = 10;
                    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                    if($page<1) $page = 1;
                    $order = array('id'=>'desc');

                    $listData = $modelWallPost->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                    if(!empty($listData)){
                        foreach($listData as $key => $item){
                            $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'wall_post', 'li.type'=>'like'];
                            $json = [
                                [
                                    'table' => 'likes',
                                    'alias' => 'li',
                                    'type' => 'LEFT',
                                    'conditions' => [
                                        'Customers.id = li.id_customer'
                                    ],
                                ]
                            ];

                            $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                            $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'wall_post', 'li.type'=>'dislike'];
                            $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post'])->all()->toList();
                            $listcomment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post', 'id_father'=>0])->all()->toList();

                            if(!empty($listcomment)){
                                foreach ($listcomment as $k => $value) {
                                    $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                    $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                                }
                            
                            }
                            
                            $listData[$key]->like = count($like);
                            $listData[$key]->infolike =$like;
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->infodislike =$dislike;
                            $listData[$key]->comment = count($comment);    
                            $listData[$key]->infoComment = $listcomment;
                            $listData[$key]->listImage = @$modelImageCustomer->find()->where(['id_post'=>$item->id])->all()->toList();          
                        }
                    }
                    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
                }
            }


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function listWallPostMyApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                    $conditions = ['status'=>"agree"];
                    $conditions = array('id_customer' => $user->id);
                    $limit = 10;
                    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                    if($page<1) $page = 1;
                    $order = array('id'=>'desc');

                    $listData = $modelWallPost->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                    if(!empty($listData)){
                        foreach($listData as $key => $item){
                            $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $like = $modelLike->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post', 'type'=>'like'])->all()->toList();
                            $dislike = $modelLike->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post', 'type'=>'dislike'])->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post'])->all()->toList();
                            $listData[$key]->like = count($like);
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->comment = count($comment); $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'wall_post', 'li.type'=>'like'];
                            $json = [
                                [
                                    'table' => 'likes',
                                    'alias' => 'li',
                                    'type' => 'LEFT',
                                    'conditions' => [
                                        'Customers.id = li.id_customer'
                                    ],
                                ]
                            ];

                            $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                            $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'wall_post', 'li.type'=>'dislike'];
                            $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post'])->all()->toList();
                            $listcomment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'wall_post', 'id_father'=>0])->all()->toList();

                            if(!empty($listcomment)){
                                foreach ($listcomment as $k => $value) {
                                    $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                    $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                                }
                            
                            }
                            
                            $listData[$key]->like = count($like);
                            $listData[$key]->infolike =$like;
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->infodislike =$dislike;
                            $listData[$key]->comment = count($comment);    
                            $listData[$key]->infoComment = $listcomment;
                            $listData[$key]->listImage = @$modelImageCustomer->find()->where(['id_post'=>$item->id])->all()->toList();          
                        }
                    }
                    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
                }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function detailWallPostFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                    $data = $modelWallPost->find()->where(['id'=>$dataSend['id'],'public'=>'public'])->first();
                    if(!empty($data)){
                        $infoCustomer = getInfoCustomerMember($data->id_customer, 'id');      
                        unset($infoCustomer->pass);
                        unset($infoCustomer->token_device);
                        unset($infoCustomer->token);
                        unset($infoCustomer->reset_password_code);
                        $data->infoCustomer = $infoCustomer;
                        $conditions = ['li.id_object'=>$data->id, 'li.keyword'=>'wall_post', 'li.type'=>'like'];
                        $json = [
                            [
                                'table' => 'likes',
                                'alias' => 'li',
                                'type' => 'LEFT',
                                'conditions' => [
                                    'Customers.id = li.id_customer'
                                ],
                            ]
                        ];
                        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                        $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                        $conditions = ['li.id_object'=>$data->id, 'li.keyword'=>'wall_post', 'li.type'=>'dislike'];
                        $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                        $comment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'wall_post'])->all()->toList();
                        $listcomment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'wall_post', 'id_father'=>0])->all()->toList();

                        if(!empty($listcomment)){
                            foreach ($listcomment as $k => $value) {
                                $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                            }
                            
                        }
                            
                        $data->like = count($like);
                        $data->infolike =$like;
                        $data->dislike = count($dislike);
                        $data->infodislike =$dislike;
                        $data->comment = count($comment);    
                        $data->infoComment = $listcomment;
                        $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
                    }
                    
                    return array('code'=>1,'data'=>$data, 'messages'=>'Lấy dữ liệu thành công');
                }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function detailWallPostMyApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                     $data = $modelWallPost->find()->where(['id'=>$dataSend['id'],'id_customer'=>$user->id])->first();

                   if(!empty($data)){
                        $infoCustomer = getInfoCustomerMember($data->id_customer, 'id');      
                        unset($infoCustomer->pass);
                        unset($infoCustomer->token_device);
                        unset($infoCustomer->token);
                        unset($infoCustomer->reset_password_code);
                        $data->infoCustomer = $infoCustomer;
                        $conditions = ['li.id_object'=>$data->id, 'li.keyword'=>'wall_post', 'li.type'=>'like'];
                        $json = [
                            [
                                'table' => 'likes',
                                'alias' => 'li',
                                'type' => 'LEFT',
                                'conditions' => [
                                    'Customers.id = li.id_customer'
                                ],
                            ]
                        ];
                        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                        $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                        $conditions = ['li.id_object'=>$data->id, 'li.keyword'=>'wall_post', 'li.type'=>'dislike'];
                        $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                        $comment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'wall_post'])->all()->toList();
                        $listcomment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'wall_post', 'id_father'=>0])->all()->toList();

                        if(!empty($listcomment)){
                            foreach ($listcomment as $k => $value) {
                                $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                            }
                            
                        }
                            
                        $data->like = count($like);
                        $data->infolike =$like;
                        $data->dislike = count($dislike);
                        $data->infodislike =$dislike;
                        $data->comment = count($comment);    
                        $data->infoComment = $listcomment;
                        $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
                    }
                    return array('code'=>1,'data'=>$data, 'messages'=>'Lấy dữ liệu thành công');
                }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function listAlbumFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                if(function_exists('getInfoCustomerMember')){
                $friend =  getInfoCustomerMember((int)$dataSend['id_friend'], 'id');
                }
                if (!empty($friend)) {


                     $listData = $modelImageCustomer->find()->where(['id_customer'=>$friend->id])->all()->toList();

                    if(!empty($listData)){
                        foreach($listData as $key => $item){
                            $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $like = $modelLike->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer', 'type'=>'like'])->all()->toList();
                            $dislike = $modelLike->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer', 'type'=>'dislike'])->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer'])->all()->toList();
                            $listData[$key]->like = count($like);
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->comment = count($comment); $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'image_customer', 'li.type'=>'like'];
                            $json = [
                                [
                                    'table' => 'likes',
                                    'alias' => 'li',
                                    'type' => 'LEFT',
                                    'conditions' => [
                                        'Customers.id = li.id_customer'
                                    ],
                                ]
                            ];

                            $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                            $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'image_customer', 'li.type'=>'dislike'];
                            $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer'])->all()->toList();
                            $listcomment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer', 'id_father'=>0])->all()->toList();

                            if(!empty($listcomment)){
                                foreach ($listcomment as $k => $value) {
                                    $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                    $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                                }
                            
                            }
                            
                            $listData[$key]->like = count($like);
                            $listData[$key]->infolike =$like;
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->infodislike =$dislike;
                            $listData[$key]->comment = count($comment);    
                            $listData[$key]->infoComment = $listcomment;               
                        }
                    }
                    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
                }
                 return array('code'=>1, 'messages'=>'bạn bè không tồi tạn');
            }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function listAlbumMyApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                

                     $listData = $modelImageCustomer->find()->where(['id_customer'=>$user->id])->all()->toList();

                    if(!empty($listData)){
                        foreach($listData as $key => $item){
                             $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $like = $modelLike->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer', 'type'=>'like'])->all()->toList();
                            $dislike = $modelLike->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer', 'type'=>'dislike'])->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer'])->all()->toList();
                            $listData[$key]->like = count($like);
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->comment = count($comment); $infoCustomer = getInfoCustomerMember($item->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $listData[$key]->infoCustomer = $infoCustomer;
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'image_customer', 'li.type'=>'like'];
                            $json = [
                                [
                                    'table' => 'likes',
                                    'alias' => 'li',
                                    'type' => 'LEFT',
                                    'conditions' => [
                                        'Customers.id = li.id_customer'
                                    ],
                                ]
                            ];

                            $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                            $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $conditions = ['li.id_object'=>$item->id, 'li.keyword'=>'image_customer', 'li.type'=>'dislike'];
                            $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer'])->all()->toList();
                            $listcomment = $modelComment->find()->where(['id_object'=>$item->id, 'keyword'=>'image_customer', 'id_father'=>0])->all()->toList();

                            if(!empty($listcomment)){
                                foreach ($listcomment as $k => $value) {
                                    $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                    $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                                }
                            
                            }
                            
                            $listData[$key]->like = count($like);
                            $listData[$key]->infolike =$like;
                            $listData[$key]->dislike = count($dislike);
                            $listData[$key]->infodislike =$dislike;
                            $listData[$key]->comment = count($comment);    
                            $listData[$key]->infoComment = $listcomment;               
                        }
                    }
                    return array('code'=>1,'data'=>$listData, 'messages'=>'Lấy dữ liệu thành công');
               
            }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function detailAlbumFriendApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                    $data = $modelImageCustomer->find()->where(['id'=>(int)$dataSend['id']])->first();
                    if($data){
                        $infoCustomer = getInfoCustomerMember($data->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $data->infoCustomer = $infoCustomer;
                            $like = $modelLike->find()->where(['id_object'=>$data->id, 'keyword'=>'image_customer', 'type'=>'like'])->all()->toList();
                            $dislike = $modelLike->find()->where(['id_object'=>$data->id, 'keyword'=>'image_customer', 'type'=>'dislike'])->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'image_customer'])->all()->toList();
                            $data->like = count($like);
                            $data->dislike = count($dislike);
                            $data->comment = count($comment); $infoCustomer = getInfoCustomerMember($data->id_customer, 'id');   
                            unset($infoCustomer->pass);
                            unset($infoCustomer->token_device);
                            unset($infoCustomer->token);
                            unset($infoCustomer->reset_password_code);
                            $data->infoCustomer = $infoCustomer;
                            $conditions = ['li.id_object'=>$data->id, 'li.keyword'=>'image_customer', 'li.type'=>'like'];
                            $json = [
                                [
                                    'table' => 'likes',
                                    'alias' => 'li',
                                    'type' => 'LEFT',
                                    'conditions' => [
                                        'Customers.id = li.id_customer'
                                    ],
                                ]
                            ];

                            $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
                            
                            $like = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $conditions = ['li.id_object'=>$data->id, 'li.keyword'=>'image_customer', 'li.type'=>'dislike'];
                            $dislike = $modelCustomer->find()->join($json)->select($select)->where($conditions)->all()->toList();
                            $comment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'image_customer'])->all()->toList();
                            $listcomment = $modelComment->find()->where(['id_object'=>$data->id, 'keyword'=>'image_customer', 'id_father'=>0])->all()->toList();

                            if(!empty($listcomment)){
                                foreach ($listcomment as $k => $value) {
                                    $listcomment[$k]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                                    $listcomment[$k]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
                                }
                            
                            }
                            
                            $data->like = count($like);
                            $data->infolike =$like;
                            $data->dislike = count($dislike);
                            $data->infodislike =$dislike;
                            $data->comment = count($comment);    
                            $data->infoComment = $listcomment;
                    }               
                       
                    return array('code'=>1,'data'=>$data, 'messages'=>'Lấy dữ liệu thành công');
               
            }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function reportWallPostAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelReportWallPost = $controller->loadModel('ReportWallPosts');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            if(function_exists('getCustomerByToken')){
               $user =  getCustomerByToken($dataSend['token']);
           }
           if (!empty($user)) {
                    $data = $modelWallPost->find()->where(['id'=>$dataSend['id'],'public'=>'public'])->first();
                    if(!empty($data)){
                        $infoCustomer = getInfoCustomerMember($data->id_customer, 'id');      
                        unset($infoCustomer->pass);
                        unset($infoCustomer->token_device);
                        unset($infoCustomer->token);
                        unset($infoCustomer->reset_password_code);
                        $data->infoCustomer = $infoCustomer;
                        
                        $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();

                        $checkdate = $modelReportWallPost->find()->where(['id_post'=>$data->id,'id_customer'=>$user->id])->first();
                        if(empty($checkdate)){
                            $checkdate = $modelReportWallPost->newEmptyEntity();
                            $checkdate->id_post = $data->id;
                            $checkdate->id_customer = $user->id;
                            $checkdate->created_at = time();
                            $modelReportWallPost->save($checkdate);
                        }
                        return array('code'=>1,'data'=>$data, 'messages'=>'Bạn báo cáo bài viết thành công');
                    }
                    return array('code'=>4, 'messages'=>'không tìm thấy bài viết');
                }
            


          return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}
 ?>

 