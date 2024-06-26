<?php

function listTransactionAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách giao dịch';

    $transactionModel = $controller->loadModel('Transactions');
    $modelUser = $controller->loadModel('Users');

    $conditions = array('amount >'=>0);
    $order = ['created_at' => 'DESC'];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {
        $conditions['user_id'] = $_GET['user_id'];
    }

    if (!empty($_GET['booking_id']) && is_numeric($_GET['booking_id'])) {
        $conditions['booking_id'] = $_GET['booking_id'];
    }



    $listData = $transactionModel->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();
    $totalUser = $transactionModel->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalUser),
        $limit,
        $page
    );
    
    if(!empty($listData)){
        foreach($listData as $key => $item){
            if(!empty($item->user_id)){
                $listData[$key]->user =$modelUser->find()->where(['id'=>$item->user_id])->first();
            }
        }
    }
    
    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}