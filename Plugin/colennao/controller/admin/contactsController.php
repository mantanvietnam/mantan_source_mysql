<?php

function listContactAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách liên hệ';

    $contactModel = $controller->loadModel('Contacts');
    
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $contactModel->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $contactModel->find()->where($conditions)->all()->toList();
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
function addContactAdmin($input)
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

    $metaTitleMantan = 'Liên hệ';

    $contactModel = $controller->loadModel('Contacts');

    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $contactModel->get( (int) $_GET['id']);
    }else{
        $data = $contactModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $contactModel->newEmptyEntity();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone_number']) && !empty($dataSend['email']) && !empty($dataSend['object'] && !empty($dataSend['message']))){
            // tạo dữ liệu save
            $data->object = @$dataSend['object'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->message = @$dataSend['message'];

            $contactModel->save($data);
          
            $mess = '<p class="text-success">Gửi yêu cầu liên hệ thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }
   
    setVariable('mess', $mess);

}
function deleteContactAdmin($input){
    global $controller;

    $contactModel = $controller->loadModel('Contacts');
    
    if(!empty($_GET['id'])){
        $data = $contactModel->get($_GET['id']);
        
        if($data){
            $contactModel->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/contacts-view-admin-listContactAdmin');
}

?>