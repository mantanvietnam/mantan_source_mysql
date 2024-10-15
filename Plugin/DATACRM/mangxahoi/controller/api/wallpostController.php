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
                				$save->image = $image['linkOnline'].'?time='.time();;
                				$save->public = $dataSend['public'];
                				$save->created_at = time();
                				$modelImageCustomer->save($save);
                            }
                        }
                    }
                }

                $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
               
                return array('code'=>3, 'messages'=>'Bạn đăng bài thành công ', 'data'=>$data);
              
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
                $data = $modelWallPost->find()->where(['id'=>$dataSend['id']])->first();
                if(!empty($data)){
                    if(!empty($dataSend['connent'])){
                        $data->connent = $dataSend['connent'];
                    }
                    $data->updated_at = time();
                    if(!empty($dataSend['public'])){
                      $data->public = $dataSend['public'];
                    }
                    $modelWallPost->save($data);
                    $conditions = array('id_post'=>$data->id);
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
                                    $save->created_at = time();
                                    $modelImageCustomer->save($save);
                                }
                            }
                        }
                    }
                }

                $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
               
                return array('code'=>3, 'messages'=>'Bạn sửa bài thành công ', 'data'=>$data);
              
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
                $data = $modelWallPost->find()->where(['id'=>$dataSend['id']])->first();
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
                $listData =array($user->id);
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

                $conditions = array('id_customer IN' => $listData, 'public'=>'public');
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
                        $listData[$key]->comment = count($comment);     
                        $listData[$key]->listImage = @$modelImageCustomer->find()->where(['id_post'=>$item->id])->all()->toList();          
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