<?php

function listAgencyOrderHistoryAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $orderHistoryModel = $controller->loadModel('AgencyOrderHistories');

    $metaTitleMantan = 'Lịch sử đơn hàng của đại lý';
    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $orderHistoryModel->find()
        ->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => 'AgencyOrderHistories.agency_id = AgencyAccounts.id',
            ],
            [
                'table' => 'agencies',
                'alias' => 'Agencies',
                'type' => 'LEFT',
                'conditions' => 'Agencies.id = AgencyAccounts.agency_id',
            ],
        ]);

    if (!empty($_GET['id'])) {
        $conditions['AgencyOrderHistories.id'] = (int) $_GET['id'];
    }

    if (!empty($_GET['agency_id'])) {
        $conditions['AgencyOrderHistories.agency_id'] = (int) $_GET['agency_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['AgencyOrderHistories.status'] = (int) $_GET['status'];
    }

    $listData = $query->select([
            'AgencyOrderHistories.id',
            'AgencyOrderHistories.agency_id',
            'AgencyOrderHistories.status',
            'AgencyOrderHistories.created_at',
            'Agencies.name'
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['AgencyOrderHistories.id'=>'desc'])
        ->all();

    $total = $orderHistoryModel->find()
        ->where($conditions)
        ->count();
    $paginationMeta = createPaginationMetaData($total, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function listUserOrderHistoryAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $orderHistoryModel = $controller->loadModel('UserOrderHistories');

    $metaTitleMantan = 'Lịch sử đơn hàng của user';
    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $orderHistoryModel->find()
        ->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => 'UserOrderHistories.agency_id = AgencyAccounts.id',
            ],
            [
                'table' => 'agencies',
                'alias' => 'Agencies',
                'type' => 'LEFT',
                'conditions' => 'Agencies.id = AgencyAccounts.agency_id',
            ],
            [
                'table' => 'user_orders',
                'alias' => 'UserOrders',
                'type' => 'LEFT',
                'conditions' => 'UserOrders.id = UserOrderHistories.order_id',
            ],
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => 'Users.id = UserOrders.user_id',
            ],
        ]);

    if (!empty($_GET['id'])) {
        $conditions['UserOrderHistories.id'] = (int) $_GET['id'];
    }

    if (!empty($_GET['user_id'])) {
        $conditions['UserOrders.user_id'] = (int) $_GET['user_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['UserOrderHistories.status'] = (int) $_GET['status'];
    }

    $listData = $query->select([
        'UserOrderHistories.id',
        'UserOrderHistories.agency_id',
        'UserOrderHistories.status',
        'UserOrderHistories.created_at',
        'Users.name'
    ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['UserOrderHistories.id'=>'desc'])
        ->all();

    $total = $orderHistoryModel->find()
        ->where($conditions)
        ->count();
    $paginationMeta = createPaginationMetaData($total, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function listUserOrderComboHistoryAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $orderHistoryModel = $controller->loadModel('UserOrderComboHistories');

    $metaTitleMantan = 'Lịch sử đơn hàng combo của user';
    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $orderHistoryModel->find()
        ->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => 'UserOrderComboHistories.agency_id = AgencyAccounts.id',
            ],
            [
                'table' => 'agencies',
                'alias' => 'Agencies',
                'type' => 'LEFT',
                'conditions' => 'Agencies.id = AgencyAccounts.agency_id',
            ],
            [
                'table' => 'user_combo_orders',
                'alias' => 'UserComboOrders',
                'type' => 'LEFT',
                'conditions' => 'UserComboOrders.id = UserOrderComboHistories.order_combo_id',
            ],
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => 'Users.id = UserComboOrders.user_id',
            ],
        ]);

    if (!empty($_GET['id'])) {
        $conditions['UserOrderComboHistories.id'] = (int) $_GET['id'];
    }

    if (!empty($_GET['user_id'])) {
        $conditions['UserComboOrders.user_id'] = (int) $_GET['user_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['UserOrderComboHistories.status'] = (int) $_GET['status'];
    }

    $listData = $query->select([
        'UserOrderComboHistories.id',
        'UserOrderComboHistories.agency_id',
        'UserOrderComboHistories.status',
        'UserOrderComboHistories.created_at',
        'Users.name'
    ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['UserOrderComboHistories.id'=>'desc'])
        ->all();

    $total = $orderHistoryModel->find()
        ->where($conditions)
        ->count();
    $paginationMeta = createPaginationMetaData($total, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}
