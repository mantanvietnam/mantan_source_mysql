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
        ->order(['id'=>'desc'])
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

    $comboModel = $controller->loadModel('Combos');
    $productModel = $controller->loadModel('Products');
    $mess = '';

    if (!empty($_GET['id'])) {
        $combo = $comboModel->find()
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
                'ComboProducts.id',
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
    $comboModel = $controller->loadModel('Combos');
    $productModel = $controller->loadModel('Products');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['id'])) {
            $data = $comboProductModel->find()
                ->where(['id' => $dataSend['id']])
                ->first();
            $product = $productModel->find()
                ->where(['id' => $data->product_id])
                ->first();
            $combo = $comboModel->find()
                ->where(['id' => $data->combo_id])
                ->first();
            $combo->price = $combo->price - $product->price * $data->amount;

            $comboModel->save($combo);
            $comboProductModel->delete($data);

            return apiResponse(0, 'Xóa thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng method POST');
}

function updateComboAdminApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $defaultImage;

    $comboModel = $controller->loadModel('Combos');
    $comboProductModel = $controller->loadModel('ComboProducts');
    $productModel = $controller->loadModel('Products');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (empty($dataSend['name'])) {
            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        $listProductId = [];
        if (!empty($dataSend['id'])) {
            $combo = $comboModel->find()->where(['id' => $dataSend['id']])->first();
            $listProductId = $comboProductModel->find()->where(['combo_id' => $combo->id])->all()
                ->map(function ($item) {
                    return $item->product_id;
                })->toArray();
        } else {
            $combo = $comboModel->newEmptyEntity();
        }
        $combo->name = $dataSend['name'];
        $combo->description = $dataSend['description'];
        $combo->price = 0;
        $combo->image = $dataSend['image'] ?? $defaultImage;
        $combo->slug = createSlugMantan($dataSend['name']);
        $combo->status = 1;
        $comboModel->save($combo);
        $totalPrice = 0;

        if (!empty($dataSend['productList']) && is_array($dataSend['productList'])) {
            foreach ($dataSend['productList'] as $item) {
                if (in_array($item['productId'], $listProductId)) {
                    $comboProduct = $comboProductModel->find()
                        ->where([
                            'combo_id' => $combo->id,
                            'product_id' => $item['productId'],
                        ])->first();
                    $comboProduct->amount = $item['amount'] ?? 1;
                } else {
                    $newComboProduct = $comboProductModel->newEmptyEntity();
                    $newComboProduct->combo_id = $combo->id;
                    $newComboProduct->product_id = $item['productId'];
                    $newComboProduct->amount = $item['amount'];
                    $comboProductModel->save($newComboProduct);
                }
                $product = $productModel->find()->where(['id' => $item['productId']])->first();
                
                if($product->type == 0){
                    $totalPrice += $product->price * $item['amount'];
                }
            }
        }
        $combo->price = $totalPrice;
        $comboModel->save($combo);

        return apiResponse(0, 'Cập nhật thành công', $combo);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


