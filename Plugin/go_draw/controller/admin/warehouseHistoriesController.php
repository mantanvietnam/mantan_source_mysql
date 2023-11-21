<?php
function historyProductWarehouseAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $domain;

    $productsModel = $controller->loadModel('Products');
    $warehouseHistoriesModel = $controller->loadModel('WarehouseHistories');

    $metaTitleMantan = 'Lịch sử nhập kho sản phẩm';
    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['from_date'])) {
        $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from_date']);
        $conditions['created_at >='] = $fromDate->format('Y-m-d H:i:s');
    }

    if (!empty($_GET['to_date'])) {
        $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to_date']);
        $conditions['created_at <='] = $toDate->format('Y-m-d H:i:s');
    }

    if (!empty($_GET['type'])) {
        $conditions['type'] = $_GET['type'];
    }

    if (!empty($_GET['product_id'])) {
        $conditions['product_id'] = $_GET['product_id'];
    }

    $listData = $warehouseHistoriesModel->find()->where($conditions)
                ->limit($limit)
                ->page($page)
                ->order(['id'=>'desc'])
                ->all()
                ->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $info_product = $productsModel->get($value->product_id);
            $listData[$key]->name_product = $info_product->name;
        }
    }

    $total = $warehouseHistoriesModel->find()->where($conditions)->count();
    $paginationMeta = createPaginationMetaData($total, $limit, $page);


    $list_product = $productsModel->find()->where(['deleted_at IS'=>null])->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);

    setVariable('listData', $listData);
    setVariable('list_product', $list_product);
}

function addProductWarehouseAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $domain;
    global $isRequestPost;

    $productsModel = $controller->loadModel('Products');
    $warehouseHistoriesModel = $controller->loadModel('WarehouseHistories');

    $metaTitleMantan = 'Phiếu nhập kho';

    $mess = '';

    $list_product = $productsModel->find()->where(['deleted_at IS'=>null])->all()->toList();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['product_id'])
            && !empty($dataSend['amount'])
        ) {
            $data = $warehouseHistoriesModel->newEmptyEntity();

            $data->product_id = (int) $dataSend['product_id'];
            $data->amount = (int) $dataSend['amount'];
            $data->total_price = (int) $dataSend['total_price'];
            $data->price_average = round($data->total_price/$data->amount);
            $data->note = $dataSend['note'];
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type = 'plus';

            $warehouseHistoriesModel->save($data);

            $info_product = $productsModel->get($data->product_id);
            $info_product->amount_in_stock += $data->amount;

            $productsModel->save($info_product);

            $mess = '<p class="text-success">Nhập kho thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    setVariable('list_product', $list_product);
    setVariable('mess', $mess);
} 