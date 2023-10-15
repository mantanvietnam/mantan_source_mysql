<?php 
function listSearchKeyEzpics($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Lịch sử tìm kiếm';

    $modelSearchKey = $controller->loadModel('SearchKeys');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelSearchKey->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelSearchKey->find()->where($conditions)->all()->toList();
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

function addSearchKeyAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin mã giảm giá';


    $modelSearchKey = $controller->loadModel('SearchKeys');
    $modelMember = $controller->loadModel('Members');
    $mess= '';
    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelSearchKey->get( (int) $_GET['id']);
            // tạo dữ liệu save
            $data->keyword = mb_strtolower(@$_GET['keyword'], 'UTF-8');
            $data->slug = createSlugMantan(@$_GET['keyword']);

            $modelSearchKey->save($data);
        return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-searchKey-listSearchKeyEzpics.php?status=1');
            
            
    }
    return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-searchKey-listSearchKeyEzpics.php?status=1');
}


function deleteSearchKeyAdmin($input){
    global $controller;
    $modelSearchKey = $controller->loadModel('SearchKeys');
    if(!empty($_GET['id'])){
        $data = $modelSearchKey->get($_GET['id']);
        
        if($data){
            $modelSearchKey->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-searchKey-listSearchKeyAdmin.php?status=3');
}
?>