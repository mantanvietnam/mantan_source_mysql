<?php 
function listWallPost($input){
    global $controller;
    global $urlHomes;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMakeFriend = $controller->loadModel('MakeFriends');
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');
    $mess =  '';
    if(function_exists('checklogin')){
    	$user = checklogin('listWallPost');   
    }
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        if(!empty($user->id_father)){
          return $controller->redirect('/');
      }
      $conditions = array();
      $limit = 10;
      $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
      if($page<1) $page = 1;
      $order = array('id'=>'desc');

      if(!empty($_GET['id_customer'])){
       $conditions['id_customer'] = (int) $_GET['id_customer'];
   }

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

        // phân trang
$totalData = $modelWallPost->find()->where($conditions)->all()->toList();
$totalData = count($totalData);
$balance = $totalData % $limit;
$totalPage = ($totalData - $balance) / $limit;
if ($balance > 0)
 $totalPage+=1;
$back = $page - 1;
$next = $page + 1;
if ($back <= 0)
 $back = 1;
if ($next >= $totalPage)
 $next = $totalPage;
if (isset($_GET['page'])) {
 $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
 $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
} else {
 $urlPage = $urlCurrent;
}

if (strpos($urlPage, '?') !== false) {
 if (count($_GET) >= 1) {
     $urlPage = $urlPage . '&page=';
 } else {
     $urlPage = $urlPage . 'page=';
 }
} else {
 $urlPage = $urlPage . '?page=';
}
$mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }
setVariable('page', $page);
setVariable('totalPage', $totalPage);
setVariable('back', $back);
setVariable('mess', $mess);
setVariable('next', $next);
setVariable('urlPage', $urlPage);
setVariable('listData', $listData);
}else{
    return $controller->redirect('/login');
}
}

function addWallPost($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');
    $mess =  '';
    if(function_exists('checklogin')){
    	$user = checklogin('addWallPost');   
    }
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listWallPost');
        }
        if(!empty($user->id_father)){
          return $controller->redirect('/');
        }

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelWallPost->get( (int) $_GET['id']);
        }else{
            $data = $modelWallPost->newEmptyEntity();
            $data->created_at = time();
            $data->id_customer = 0;
        }

        if($isRequestPost) {
            $dataSend = $input['request']->getData();
            $data->connent = $dataSend['connent'];
            $data->pin = $dataSend['pin'];
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
                            $fileName = 'image'.$i.'_wallpost_'.$data->id_custome.'_'.$data->id.time().rand(0,1000000);
                        }else{
                            $fileName = 'image'.$i.'_wallpost_'.time().rand(0,1000000);
                        }
                        $image = uploadImage($user->id, 'listImages'.$i, $fileName);
                        if(!empty($image['linkOnline'])){
                            $save = $modelImageCustomer->newEmptyEntity();

                            $save->id_customer = $data->id_customer;
                            $save->id_post = $data->id;
                            $save->image = $image['linkOnline'].'?time='.time();;
                            $save->public = $dataSend['public'];
                            $save->created_at = time();
                            $modelImageCustomer->save($save);
                        }
                    }
                }
            }

            if(!empty($dataSend['id_image_delete'])){
                $conditions['id IN'] =$dataSend['id_image_delete'];
                deletelikeIdObject($dataSend['id_image_delete'],'image_customer');
                deleteCommentIdObject($dataSend['id_image_delete'],'image_customer');
                $modelImageCustomer->deleteAll($conditions);
            }

            $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();

            return $controller->redirect('/listWallPost?mess=saveSuccess');

        }
        if(!empty($data->id)){
             $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
             if(!empty($data->id_customer)){
              $data->infoCustomer = getInfoCustomerMember($data->id_customer, 'id'); 
          }
        }
    setVariable('data', $data);
    setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteWallPost($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    $mess =  '';
    if(function_exists('checklogin')){
    	$user = checklogin('deleteWallPost');   
    }
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listWallPost');
        }
        if(!empty($user->id_father)){
          return $controller->redirect('/');
      }
      $data = $modelWallPost->find()->where(['id'=>$_GET['id']])->first();
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

   return $controller->redirect('/listWallPost?mess=deleteSuccess');
}
return $controller->redirect('/listWallPost?mess=deleteError'); 
}else{
    return $controller->redirect('/login');
}
}

?>
