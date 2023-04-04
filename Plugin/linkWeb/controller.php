<?php
	/*Nhóm liên kết LinkWebCategory */
function listLinkWebCategoryAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách điểm đến di tích và danh lam';

    $modelLinkWebCategory = $controller->loadModel('Linkwebcategorys');
    
    $conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }

    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelLinkWebCategory->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelLinkWebCategory->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelLinkWebCategory->find()->where($conditions)->all()->toList();
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


function addLinkWebCategoryAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin điểm đến di tích và danh lam';

    $modelLinkWebCategory = $controller->loadModel('Linkwebcategorys');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelLinkWebCategory->get( (int) $_GET['id']);

    }else{
        $data = $modelLinkWebCategory->newEmptyEntity();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $modelLinkWebCategory->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

            if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/linkWeb-admin-listLinkWebCategoryAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/linkWeb-admin-listLinkWebCategoryAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteLinkWebCategoryAdmin($input){
    global $controller;

    $modelLinkWebCategory = $controller->loadModel('Linkwebcategorys');
    if(!empty($_GET['id'])){
        $data = $modelLinkWebCategory->get($_GET['id']);
        
        if($data){
            $modelLinkWebCategory->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/linkWeb-admin-listLinkWebCategoryAdmin.php?status=3');
}

/*Liên kết LinkWeb */
function listLinkWebAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách điểm đến di tích và danh lam';

    $modelLinkWeb = $controller->loadModel('linkwebs');
    
    $conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }

    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelLinkWeb->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelLinkWeb->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelLinkWeb->find()->where($conditions)->all()->toList();
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


function addLinkWebAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin điểm đến di tích và danh lam';

    $modelLinkWeb = $controller->loadModel('linkwebs');
    $mess= '';

    $modelLinkwebcategory = $controller->loadModel('Linkwebcategorys');
    $conditions = array();
    $listLinkwebcategory = $modelLinkwebcategory->find()->where($conditions)->all()->toList();

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelLinkWeb->get( (int) $_GET['id']);

    }else{
        $data = $modelLinkWeb->newEmptyEntity();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->link = @$dataSend['link'];
            $data->image = @$dataSend['image'];
            $data->idCategory = @$dataSend['idCategory'];
            $modelLinkWeb->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

            if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/linkWeb-admin-listLinkWebAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/linkWeb-admin-listLinkWebAdmin.php?status=1');
            }
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
        }
    }



    setVariable('data', $data);
    setVariable('data', $data);
    setVariable('listLinkwebcategory', $listLinkwebcategory);
}

function deleteLinkWebAdmin($input){
    global $controller;

    $modelLinkWeb = $controller->loadModel('linkwebs');
    if(!empty($_GET['id'])){
        $data = $modelLinkWeb->get($_GET['id']);
        
        if($data){
            $modelLinkWeb->delete($data);
        }
    }

    return $controller->redirect('plugins/admin/linkWeb-admin-listLinkWebAdmin.php?status=3');
}
?>