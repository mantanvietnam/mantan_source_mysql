<?php
function settingUpLikeAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt Tăng tương tác';
    $mess= '';
    $conditions = array('key_word' => 'settingUpLikeAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'tokenOngTrum' => $dataSend['tokenOngTrum'],
                        'multiplier' => (int) $dataSend['multiplier'],
                    );

        $data->key_word = 'settingUpLikeAdmin';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data', $data_value);
    setVariable('mess', $mess);
}

function listUplikeHistoriesAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách đại lý hệ thống';
    $mess = '';

    $modelMembers = $controller->loadModel('Members');
    $modelCustomer = $controller->loadModel('Customers');
    $modelUplikeHistories = $controller->loadModel('UplikeHistories');
    
    $conditions = array();
    $limit = 20;


    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelUplikeHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            if($value->type=='member'){
                 $listData[$key]->info_member = $modelMembers->find()->where(['id'=>$value->id_member])->first();
             }else{
                 $listData[$key]->info_member = $modelCustomer->find()->where(['id'=>$value->id_member])->first();

             }
           

            if($value->status == 'Running'){
                $checkStatus = checkRequestOngTrum($value->id_request_buff, $value->type_page);

                if($checkStatus['code'] == 200){
                    if($checkStatus['data']['status'] != 'Running'){
                        $listData[$key]->status = $checkStatus['data']['status'];
                    }

                    $listData[$key]->run = (int) $checkStatus['data']['run'];

                    $modelUplikeHistories->save($listData[$key]);
                }
            }
        }
    }
    

    $totalData = $modelUplikeHistories->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
}

function settingUpLikeCustomerAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt Tăng tương tác';
    $mess= '';
    $conditions = array('key_word' => 'settingUpLikeCustomerAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'chanel' => $dataSend['chanel'],
                        'function_customerUpLikePage' => $dataSend['function_customerUpLikePage'],
                    );

        $data->key_word = 'settingUpLikeCustomerAdmin';

        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $listPrice = getListPriceOngTrum();


    setVariable('data', $data_value);
    setVariable('mess', $mess);
    setVariable('listPrice', $listPrice);
}