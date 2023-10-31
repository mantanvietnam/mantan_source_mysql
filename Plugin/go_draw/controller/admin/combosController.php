<?php

function listComboAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách combo';
    $comboModel = $controller->loadModel('Combos');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $comboModel->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalUser = $comboModel->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalUser),
        $limit,
        $page
    );

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function viewDetailComboAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $comboModel = $controller->loadModel('Combos');
    $productModel = $controller->loadModel('Products');
    $mess = '';

    if (!empty($_GET['id'])) {
        $combo = $comboModel->find()
            ->select(['id', 'name'])
            ->where(['id' => $_GET['id']])
            ->first();
        $comboProduct = $productModel->find()
            ->join([
                [
                    'table' => 'combo_products',
                    'alias' => 'ComboProducts',
                    'type' => 'LEFT',
                    'conditions' => [
                        'ComboProducts.product_id = Products.id',
                    ],
                ],
            ])->where(['ComboProducts.combo_id' => $combo->id])
            ->select([
                'Products.id',
                'Products.name',
                'Products.price',
                'Products.image',
                'ComboProducts.amount',
            ])->all();
    } else {
        $combo = $comboModel->newEmptyEntity();
    }

    $productList = $productModel->find()
        ->where(['status' => 1])
        ->all();

    setVariable('data', $combo);
    setVariable('comboProduct', $comboProduct ?? []);
    setVariable('productList', $productList);
    setVariable('mess', $mess);
}

function deleteComboProductAdminApi($input): array
{
    global $controller;
    global $isRequestPost;

    $comboProductModel = $controller->loadModel('ComboProducts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['id'])) {
            $data = $comboProductModel->find()
                ->where(['id' => $dataSend['id']])
                ->first();
            $comboProductModel->delete($data);

            return apiResponse(0, 'Xóa thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng method POST');
}
