<?php

function listAgencyOrderAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đơn hàng';
    $orderModel = $controller->loadModel('AgencyOrders');
    $agencyModel = $controller->loadModel('Agencies');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $orderModel->find()
        ->join([
            [
                'table' => 'agencies',
                'alias' => 'Agencies',
                'type' => 'LEFT',
                'conditions' => [
                    'AgencyOrders.agency_id = Agencies.id',
                ],
            ],
        ]);

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['AgencyOrders.id'] = $_GET['id'];
    }

    if (!empty($_GET['agency_id'])) {
        $conditions['AgencyOrders.agency_id'] = $_GET['agency_id'];
    }

    if (!empty($_GET['status'])) {
        $conditions['AgencyOrders.status'] = (int)$_GET['status'];
    }

    if (!empty($_GET['from_date'])) {
        $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from_date']);
        $conditions['AgencyOrders.created_at >='] = $fromDate->format('Y-m-d H:i:s');
    }

    if (!empty($_GET['to_date'])) {
        $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to_date']);
        $conditions['AgencyOrders.created_at <='] = $toDate->format('Y-m-d H:i:s');
    }

    $listData = $query->select([
            'AgencyOrders.id',
            'AgencyOrders.agency_id',
            'AgencyOrders.total_price',
            'AgencyOrders.status',
            'AgencyOrders.created_at',
            'Agencies.name',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalUser = $orderModel->find()
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

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
    setVariable('listAgency', $listAgency);
}
