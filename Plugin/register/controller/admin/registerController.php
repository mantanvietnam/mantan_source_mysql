<?php

function listRegister($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đăng ký';

    $registerModel = $controller->loadModel('Registers');
    
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $registerModel->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $registerModel->find()->where($conditions)->all()->toList();
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

function addRegister($input)
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

    $registerModel = $controller->loadModel('Registers');

    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $registerModel->get( (int) $_GET['id']);
    }else{
        $data = $registerModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $registerModel->newEmptyEntity();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone_number']) && !empty($dataSend['email']) && !empty($dataSend['address'] && !empty($dataSend['course']) && !empty($dataSend['centre']))){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->email = @$dataSend['email'];
            $data->address = @$dataSend['address'];
            $data->course = @$dataSend['course'];
            $data->centre = @$dataSend['centre'];

            $registerModel->save($data);
          
            $mess = '<p class="text-success">Thêm dữ liệu thành công</p>';
        }else{
            $mess = '<p class="text-danger">Thiếu dữ liệu</p>';
        }
        
    }
   
    setVariable('mess', $mess);

}

function deleteRegisterAdmin($input){
    global $controller;

    $registerModel = $controller->loadModel('Registers');
    
    if(!empty($_GET['id'])){
        $data = $registerModel->get($_GET['id']);
        
        if($data){
            $registerModel->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/register-view-admin-listRegisterAdmin');
}

?>