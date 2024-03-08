<?php

function listAgencyOrderAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách yêu cầu hoàn hàng';

    $orderBackModel = $controller->loadModel('AgencyOrderBackStores');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = ['AgencyOrderBackStores.id'=>'desc'];

    if (!empty()) {
        $conditions[]
    }

    $query = $orderBackModel->find()
        ->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => [
                    'AgencyOrderBackStores.agency_id = AgencyAccounts.id',
                ],
            ],
        ]);

}