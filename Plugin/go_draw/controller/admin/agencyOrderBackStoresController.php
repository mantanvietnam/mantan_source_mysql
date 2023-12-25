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

function viewAgencyBackProductAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Chi tiết yêu cầu trả hàng';

    $agencyOrderBackStoresModel = $controller->loadModel('AgencyOrderBackStores');
    $agencyOrderBackStoreDetailsModel = $controller->loadModel('AgencyOrderBackStoreDetails');
    $productsModel = $controller->loadModel('Products');
    $agencyModel = $controller->loadModel('Agencies');
    $agencyAccountsModel = $controller->loadModel('AgencyAccounts');

    $mess = '';

    if (!empty($_GET['id'])) {
        $order = $agencyOrderBackStoresModel->find()
            ->where(['id' => $_GET['id']])
            ->first();


        if (!empty($order)) {
            $listItem = $agencyOrderBackStoreDetailsModel->find()->where(['order_id' => $order->id])->all()->toList();
            
            if(!empty($listItem)){
                foreach ($listItem as $key => $value) {
                    $product = $productsModel->find()->where(['id' => $value->product_id])->first();

                    $listItem[$key]->name_product = $product->name;
                }
            }

            setVariable('listItem', $listItem);

            $agency = $agencyAccountsModel->find()->where(['id' => $order->agency_id])->first();
            setVariable('agency', $agency);

            $listAgency = $agencyModel->find()->all();
            setVariable('listAgency', $listAgency);

            
        } else {
            return $controller->redirect('/plugins/admin/go_draw-view-admin-agency_order_back_stores-listAgencyBackProductAdmin');
        }


        setVariable('data', $order);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/plugins/admin/go_draw-view-admin-agency_order_back_stores-listAgencyBackProductAdmin');
    }
}

function acceptAgencyBackProductAdminApi($input)
{
    global $controller;
    global $isRequestPost;

    $agencyOrderBackStoresModel = $controller->loadModel('AgencyOrderBackStores');
    $agencyOrderBackStoreDetailsModel = $controller->loadModel('AgencyOrderBackStoreDetails');
    $agencyOrderBackStoreHistoriesModel = $controller->loadModel('AgencyOrderBackStoreHistories');
    $productsModel = $controller->loadModel('Products');
    $warehouseHistoriesModel = $controller->loadModel('WarehouseHistories');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id'])) {
            $order = $agencyOrderBackStoresModel->find()->where(['id' => $dataSend['id']])->first();
            $order->status = 2; // 0: đơn hàng mới,  2: đã nhập kho, 3: hủy bỏ
            $order->updated_at = date('Y-m-d H:i:s');

            $agencyOrderBackStoresModel->save($order);

            // lưu lịch sử thay đổi trạng thái đơn hàng
            $orderHistory = $agencyOrderBackStoreHistoriesModel->newEmptyEntity();

            $orderHistory->agency_id = $order->agency_id;
            $orderHistory->order_id = $order->id;
            $orderHistory->note = 'Admin duyệt nhập kho yêu cầu trả hàng của đại lý';
            $orderHistory->created_at = date('Y-m-d H:i:s');
            $orderHistory->status = $order->status;

            $agencyOrderBackStoreHistoriesModel->save($orderHistory);

            // cộng hàng vào kho của admin
            $listItem = $agencyOrderBackStoreDetailsModel->find()->where(['order_id' => $order->id])->all()->toList();
            
            if(!empty($listItem)){
                foreach ($listItem as $key => $value) {
                    $product = $productsModel->find()->where(['id' => $value->product_id])->first();

                    $product->amount_in_stock += $value->amount;

                    $productsModel->save($product);

                    // lưu lịch sử nhập kho
                    $histories = $warehouseHistoriesModel->newEmptyEntity();

                    $histories->product_id = (int) $value->product_id;
                    $histories->amount = (int) $value->amount;
                    $histories->total_price = $value->amount * $value->price;
                    $histories->price_average = $value->price;
                    $histories->note = 'Đại lý trả lại hàng';
                    $histories->updated_at = date('Y-m-d H:i:s');
                    $histories->type = 'plus';

                    $warehouseHistoriesModel->save($histories);
                }
            }

            return apiResponse(0, 'Cập nhật thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}