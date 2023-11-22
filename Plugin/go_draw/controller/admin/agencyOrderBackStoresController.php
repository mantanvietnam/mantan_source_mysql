<?php

function listAgencyBackProductAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách yêu cầu trả hàng';

    $agencyOrderBackStoresModel = $controller->loadModel('AgencyOrderBackStores');
    $agencyModel = $controller->loadModel('Agencies');
    

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = ['AgencyOrderBackStores.id'=>'desc'];

    $query = $agencyOrderBackStoresModel->find()->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => [
                    'AgencyOrderBackStores.agency_id = AgencyAccounts.id',
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
        ])
        ;
        

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['AgencyOrderBackStores.id'] = $_GET['id'];
    }

    if (!empty($_GET['agency_id'])) {
        $conditions['Agencies.id'] = $_GET['agency_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['AgencyOrderBackStores.status'] = (int)$_GET['status'];
    }

    if (!empty($_GET['from_date'])) {
        $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from_date']);
        $conditions['AgencyOrderBackStores.created_at >='] = $fromDate->format('Y-m-d H:i:s');
    }

    if (!empty($_GET['to_date'])) {
        $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to_date']);
        $conditions['AgencyOrderBackStores.created_at <='] = $toDate->format('Y-m-d H:i:s');
    }

    $listData = $query
        ->select([
            'AgencyOrderBackStores.id',
            'AgencyOrderBackStores.agency_id',
            'AgencyOrderBackStores.total_price',
            'AgencyOrderBackStores.status',
            'AgencyOrderBackStores.created_at',
            'AgencyOrderBackStores.note',
            'Agencies.name',
            'AgencyAccounts.name',
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

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);

    setVariable('listData', $listData);
    setVariable('listAgency', $listAgency);
}