<?php 
function listSearchKeyAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách mã giảm giá';

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

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelSearchKey->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

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

    }else{
        $data = $modelSearchKey->newEmptyEntity();
        $data->created_at = date('Y-m-d H:i:s');
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['keyword'])){
            // tạo dữ liệu save
            $data->keyword = @$dataSend['keyword'];
            $data->slug = strtoupper(@$dataSend['keyword']);
            $data->status = @$dataSend['status'];

            $modelSearchKey->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-searchKey-listSearchKeyAdmin.php?status=2');
            }else{
              
                return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-searchKey-listSearchKeyAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
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