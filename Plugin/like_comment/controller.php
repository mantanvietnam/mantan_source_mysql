<?php
	/*Link*/
function addlike ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $infoUser = $session->read('infoUser');
        $modelLike = $controller->loadModel('Likes');
        $data = $modelLike->newEmptyEntity();
       

        if(!empty($_POST)){
            $data->created = getdate()[0];
            $data->idobject=$_POST['idobject'];
            $data->tiype=$_POST['tiype'];
            $data->idcustomer=$_POST['idcustomer'];

            $modelLike->save($data);
            $return = array('code'=>1);
             }
        return $return;
}

function delelelike ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
        $modelLike = $controller->loadModel('Likes');
        if(!empty($_POST)){
            $conditions['idobject']=$_POST['idobject'];
            $conditions['tiype']=$_POST['tiype'];
            $conditions['idcustomer']=$_POST['idcustomer'];


            $data = $modelLike->find()->where($conditions)->first();

           $modelLike->delete($data);
            $return = array('code'=>1);
             }
        return $return;
        
}

 function addComment ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $infoUser = $session->read('infoUser');
        $modelComment = $controller->loadModel('Comments');
        $data = $modelComment->newEmptyEntity();
       

        if(!empty($_POST)){
            $data->created = getdate()[0];
            $data->idobject=$_POST['idobject'];
            $data->tiype=$_POST['tiype'];
            $data->idcustomer=$_POST['idcustomer'];
            $data->comment=$_POST['comment'];

            $modelComment->save($data);
             $return = array('code'=>1);
             }
        return $return;
}

function deleleComment($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
        $modelComments = $controller->loadModel('Comments');
        if(!empty($_POST)){
            $data = $modelComments->get($_POST['id']);

           $modelComments->delete($data);
             $return = array('code'=>1);
             }
        return $return;
        
}

function listCommentAdmin(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cơ quan hành chính';

    $modelComment = $controller->loadModel('Comments');
    
    $conditions = array();
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
        return $controller->redirect('/plugins/admin/like_comment-admin-listCommentAdmin.php?status=3');
        
}

?>