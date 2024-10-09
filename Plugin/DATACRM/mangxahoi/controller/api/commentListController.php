<?php 
function addlikeApi ($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['type'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'active'=>'active'])->first();

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(empty($data)) {
            		$data = $modelLike->newEmptyEntity();
            	}
		        $data->created_at = time();
		        $data->id_object =(int) $dataSend['id_object'];
		        $data->keyword = $dataSend['keyword'];
		        $data->type = $dataSend['type'];
		        $data->id_customer = $user->id;
        		$modelLike->save($data);
        		 return array('code'=>1,'messages'=>'bạn thêm like thành công');
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function delelelikeApi ($input){

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
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(!empty($data)) {
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
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(!empty($data)) {
            		if($data->type=='like'){
            			return array('code'=>1,'messages'=>'bạn đã like ');
            		}elseif($data->type=='dislike'){
            			return array('code'=>1,'messages'=>'bạn đã dislike ');
            		}
            		
            	}
		        
            	 return array('code'=>4,'messages'=>'bạn chưa likes');
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
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['comment'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

        	$data = $modelComment->newEmptyEntity();
            $data->created_at = time();
            $data->id_object=$dataSend['id_object'];
            $data->keyword=$dataSend['keyword'];
            $data->id_father=$dataSend['id_father'];
            $data->id_customer=$dataSend['id_customer'];
            $data->comment=$dataSend['comment'];

            $modelComment->save($data);
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

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['comment'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {
                if(!empty($_POST)){
                    $data = $modelComment->get($_POST['id']);
                   $modelComment->delete($data);
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

function listCommentAdmin(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Danh sách bình luận';

    $modelComment = $controller->loadModel('Comments');
    $modelProduct = $controller->loadModel('Products');
    
    $conditions = array('type'=>'product');
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelComment->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelComment->find()->where($conditions_scan)->all()->toList();

            $listData[$key]->number_scan = count($static);
            $listData[$key]->product = $modelProduct->find()->where(['id'=>$value->idobject])->first();

        }
    }

    // phân trang
    $totalData = $modelComment->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function deleleCommentAdmin($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
        $modelComments = $controller->loadModel('Comments');
        if(!empty($_GET['id'])){
            $data = $modelComments->get($_GET['id']);

           $modelComments->delete($data);
             }
        return $controller->redirect('/plugins/admin/like_comment-admin-listCommentAdmin?status=3');
        
}


 ?>