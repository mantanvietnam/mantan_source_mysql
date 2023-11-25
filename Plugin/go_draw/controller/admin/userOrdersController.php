<?php

function listUserOrderAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đơn hàng của đại lý';

    $userOrdersModel = $controller->loadModel('UserOrders');
    $agencyModel = $controller->loadModel('Agencies');
    $usersModel = $controller->loadModel('Users');
    

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = ['UserOrders.id'=>'desc'];

    $query = $userOrdersModel->find()->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => [
                    'UserOrders.agency_id = AgencyAccounts.id',
                ],
            ],
            [
                'table' => 'agencies',
                'alias' => 'Agencies',
                'type' => 'LEFT',
                'conditions' => [
                    'AgencyAccounts.agency_id = Agencies.id',
                ],
            ],
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => [
                    'UserOrders.user_id = Users.id',
                ],
            ],
            [
                'table' => 'combos',
                'alias' => 'Combos',
                'type' => 'LEFT',
                'conditions' => [
                    'UserOrders.combo_id = Combos.id',
                ],
            ],
        ])
        ;
        

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['UserOrders.id'] = $_GET['id'];
    }

    if (!empty($_GET['agency_id'])) {
        $conditions['Agencies.id'] = $_GET['agency_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['UserOrders.status'] = (int)$_GET['status'];
    }

    if (!empty($_GET['from_date'])) {
        $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from_date']);
        $conditions['UserOrders.created_at >='] = $fromDate->format('Y-m-d H:i:s');
    }

    if (!empty($_GET['to_date'])) {
        $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to_date']);
        $conditions['UserOrders.created_at <='] = $toDate->format('Y-m-d H:i:s');
    }

    $listData = $query
        ->select([
            'UserOrders.id',
            'UserOrders.agency_id',
            'UserOrders.user_id',
            'UserOrders.combo_id',
            'UserOrders.total_price',
            'UserOrders.status',
            'UserOrders.created_at',
            'Agencies.name',
            'AgencyAccounts.name',
            'Users.name',
            'Combos.name',
        ])
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();

    $totalUser = $query
        ->where($conditions)
        ->all()
        ->toList();

    $paginationMeta = createPaginationMetaData(
        count($totalUser),
        $limit,
        $page
    );

    $listAgency = $agencyModel->find()
        ->where(['status' => 1])
        ->all();

    $total_money = 0;

    if(!empty($totalUser)){
        foreach ($totalUser as $key => $value) {
            $total_money += $value->total_price;
        }
    }

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);

    setVariable('listData', $listData);
    setVariable('listAgency', $listAgency);
    setVariable('total_money', $total_money);
}