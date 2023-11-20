<?php

function listAgencyOrderProductAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đơn hàng mua sản phẩm';

    $agencyOrderProductsModel = $controller->loadModel('AgencyOrderProducts');
    $agencyModel = $controller->loadModel('Agencies');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = ['AgencyOrderProducts.id'=>'desc'];

    $query = $agencyOrderProductsModel->find()
        
        ->join([
            [
                'table' => 'agency_accounts',
                'alias' => 'AgencyAccounts',
                'type' => 'LEFT',
                'conditions' => [
                    'AgencyOrderProducts.agency_id = AgencyAccounts.id',
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
        $conditions['AgencyOrderProducts.id'] = $_GET['id'];
    }

    if (!empty($_GET['agency_id'])) {
        $conditions['Agencies.id'] = $_GET['agency_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['AgencyOrderProducts.status'] = (int)$_GET['status'];
    }

    if (!empty($_GET['from_date'])) {
        $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from_date']);
        $conditions['AgencyOrderProducts.created_at >='] = $fromDate->format('Y-m-d H:i:s');
    }

    if (!empty($_GET['to_date'])) {
        $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to_date']);
        $conditions['AgencyOrderProducts.created_at <='] = $toDate->format('Y-m-d H:i:s');
    }

    $listData = $query->select([
            'AgencyOrderProducts.id',
            'AgencyOrderProducts.agency_id',
            'AgencyOrderProducts.total_price',
            'AgencyOrderProducts.status',
            'AgencyOrderProducts.created_at',
            'Agencies.name',
            'AgencyAccounts.name',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();

    $totalUser = $agencyOrderProductsModel->find()
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

function addAgencyOrderProductAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $agencyOrderProductsModel = $controller->loadModel('AgencyOrderProducts');
    $agencyOrderProductDetailsModel = $controller->loadModel('AgencyOrderProductDetails');
    $agencyModel = $controller->loadModel('Agencies');
    $agencyAccountsModel = $controller->loadModel('AgencyAccounts');
    $productsModel = $controller->loadModel('Products');

    $mess = '';

    if (!empty($_GET['id'])) {
        $order = $agencyOrderProductsModel->find()
            ->where(['id' => $_GET['id']])
            ->first();


        if (!empty($order)) {
            $listItem = $agencyOrderProductDetailsModel->find()->where(['order_id' => $order->id])->all()->toList();
            
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
            return $controller->redirect('/plugins/admin/go_draw-view-admin-agency_order_product-listAgencyOrderProductAdmin.php');
        }


        setVariable('data', $order);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/plugins/admin/go_draw-view-admin-agency_order_product-listAgencyOrderProductAdmin.php');
    }
}

function acceptAgencyOrderProductAdminApi($input)
{
    global $controller;
    global $isRequestPost;

    $agencyOrderProductsModel = $controller->loadModel('AgencyOrderProducts');
    $agencyOrderProductHistoriesModel = $controller->loadModel('AgencyOrderProductHistories');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id'])) {
            $order = $agencyOrderProductsModel->find()->where(['id' => $dataSend['id']])->first();
            $order->status = 1; // 0: đơn hàng mới, 1: đã duyệt xuất kho, 2: đã nhập kho, 3: đã thanh toán, 4: hủy bỏ
            $order->updated_at = date('Y-m-d H:i:s');

            $agencyOrderProductsModel->save($order);

            // lưu lịch sử thay đổi trạng thái đơn hàng
            $orderHistory = $agencyOrderProductHistoriesModel->newEmptyEntity();

            $orderHistory->agency_id = $order->agency_id;
            $orderHistory->order_id = $order->id;
            $orderHistory->note = 'Admin duyệt xuất kho đơn hàng mua lẻ sản phẩm của đại lý';
            $orderHistory->created_at = date('Y-m-d H:i:s');
            $orderHistory->status = $order->status;

            $agencyOrderProductHistoriesModel->save($orderHistory);

            return apiResponse(0, 'Cập nhật thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function payAgencyOrderProductAdminApi($input)
{
    global $controller;
    global $isRequestPost;

    $agencyOrderProductsModel = $controller->loadModel('AgencyOrderProducts');
    $agencyOrderProductHistoriesModel = $controller->loadModel('AgencyOrderProductHistories');
    $productsModel = $controller->loadModel('Products');
    $agencyOrderProductDetailsModel = $controller->loadModel('AgencyOrderProductDetails');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id'])) {
            $order = $agencyOrderProductsModel->find()->where(['id' => $dataSend['id']])->first();

            // hoàn hàng vào kho
            $listItem = $agencyOrderProductDetailsModel->find()->where(['order_id' => $order->id])->all();
            $total_price = 0;
            debug($listItem);die;
            if (!empty($listItem)) {
                foreach ($listItem as $item) {
                    $infoProduct = $productsModel->find()->where(['id'=>$item->product_id])->first();
                    
                    // nếu là sản phẩm tái sử dụng
                    if($infoProduct->type == 1){
                        $infoProduct->amount += $item->amount;
                        $infoProduct->updated_at = date('Y-m-d H:i:s');

                        debug($infoProduct);die;
                        $productsModel->save($infoProduct);
                    }else{
                        $total_price += $item->price * $item->amount;
                    }
                }
            }

            // cập nhập trạng thái đơn hàng
            $order->status = 3; // 0: đơn hàng mới, 1: đã duyệt xuất kho, 2: đã nhập kho, 3: đã thanh toán, 4: hủy bỏ
            $order->total_price = $total_price;
            $order->updated_at = date('Y-m-d H:i:s');

            $agencyOrderProductsModel->save($order);

            // lưu lịch sử thay đổi trạng thái đơn hàng
            $orderHistory = $agencyOrderProductHistoriesModel->newEmptyEntity();

            $orderHistory->agency_id = $order->agency_id;
            $orderHistory->order_id = $order->id;
            $orderHistory->note = 'Admin duyệt thanh toán đơn hàng mua lẻ sản phẩm của đại lý';
            $orderHistory->created_at = date('Y-m-d H:i:s');
            $orderHistory->status = $order->status;

            $agencyOrderProductHistoriesModel->save($orderHistory);

            return apiResponse(0, 'Cập nhật thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}