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

function addAgencyOrderAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $orderModel = $controller->loadModel('AgencyOrders');
    $orderDetailModel = $controller->loadModel('AgencyOrderDetails');
    $comboModel = $controller->loadModel('Combos');
    $agencyModel = $controller->loadModel('Agencies');
    $mess = '';

    if (!empty($_GET['id'])) {
        $order = $orderModel->find()
            ->where(['id' => $_GET['id']])
            ->first();
    } else {
        $order = $orderModel->newEmptyEntity();
    }

    if (!empty($order)) {
        $listItem = $orderDetailModel->find()->where(['order_id' => $order->id])->all();
        setVariable('listItem', $listItem);
        $agency = $agencyModel->find()->where(['id' => $order->agency_id])->first();
        setVariable('agency', $agency);
        $listAgency = $agencyModel->find()->all();
        setVariable('listAgency', $listAgency);
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['agency_id'])
            && !empty($dataSend['total_price'])
            && !empty($dataSend['status'])
        ) {
            $order->agency_id = $dataSend['agency_id'];
            $order->total_price = $dataSend['total_price'];
            $order->status = (int)$dataSend['status'];
            $orderModel->save($order);

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }
    $listCombo = $comboModel->find()->where(['status' => 1])->all();

    setVariable('data', $order);
    setVariable('listCombo', $listCombo);
    setVariable('mess', $mess);
}
