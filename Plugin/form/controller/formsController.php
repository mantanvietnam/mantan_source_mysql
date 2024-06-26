<?php

function listFormAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đăng ký';

    $formModel = $controller->loadModel('Forms');
    
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $formModel->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $formModel->find()->where($conditions)->all()->toList();
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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
}

function addFormAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelOptions;
    $conditions = array('key_word' => 'contact_site');
    $data = $modelOptions->find()->where($conditions)->first();

    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $metaTitleMantan = 'Form Đăng Ký';

    $formModel = $controller->loadModel('Forms');

    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $formModel->get( (int) $_GET['id']);
    }else{
        $data = $formModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $formModel->newEmptyEntity();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone_number']) && !empty($dataSend['email']) && !empty($dataSend['address'] && !empty($dataSend['note']))){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->email = @$dataSend['email'];
            $data->address = @$dataSend['address'];
            $data->note = @$dataSend['note'];

            $formModel->save($data);
          
            $mess = '<p class="text-success">Thêm dữ liệu thành công</p>';
        }else{
            $mess = '<p class="text-danger">Thiếu dữ liệu</p>';
        }
        
    }
   
    setVariable('mess', $mess);

}

function deleteFormAdmin($input){
    global $controller;

    $formModel = $controller->loadModel('Forms');
    
    if(!empty($_GET['id'])){
        $data = $formModel->get($_GET['id']);
        
        if($data){
            $formModel->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/form-view-admin-listFormAdmin');
}

?>