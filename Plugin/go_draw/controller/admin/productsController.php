<?php

function listProductAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $domain;

    $productModel = $controller->loadModel('Products');
    $comboProductModel = $controller->loadModel('ComboProducts');
    $categoryModel = $controller->loadModel('Categories');
    $comboModel = $controller->loadModel('Combos');

    $metaTitleMantan = 'Danh sách sản phẩm';
    $conditions = ['Products.deleted_at IS' => null];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $productModel->find()
        ->join([
            [
                'table' => 'categories',
                'alias' => 'Categories',
                'type' => 'LEFT',
                'conditions' => 'Products.category_id = Categories.id',
            ]
        ]);

    if (!empty($_GET['id'])) {
        $conditions['Products.id'] = (int)$_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['Products.name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['code'])) {
        $conditions['Products.code LIKE'] = '%' . $_GET['code'] . '%';
    }

    if (!empty($_GET['category_id'])) {
        $conditions['Products.category_id'] = (int)$_GET['category_id'];
    }

    if (!empty($_GET['combo_id'])) {
        $listId = $comboProductModel->find()
            ->where(['id' => (int)$_GET['combo_id']])
            ->all()
            ->map(function ($item) {
                return $item->id;
            })->toArray();

        if (count($listId)) {
            $conditions['Products.id IN'] = $listId;
        }
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['Products.status'] = (int)$_GET['status'];
    }

    $productList = $query->select([
            'Products.id',
            'Products.name',
            'Products.price',
            'Products.image',
            'Products.status',
            'Categories.id',
            'Categories.name',
        ])->where($conditions)
        ->all()
        ->toList();
    $total = $productModel->find()->count();
    $paginationMeta = createPaginationMetaData($total, $limit, $page);

    $categoryList = $categoryModel->find()->all();
    $comboList = $comboModel->find()->where(['status' => 1])->all();

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('productList', $productList);
    setVariable('categoryList', $categoryList);
    setVariable('comboList', $comboList);
}

function deleteProductAdmin($input)
{
    global $controller;

    $productModel = $controller->loadModel('Products');

    if (!empty($_GET['id'])) {
        $product = $productModel->find()->where([
            'id' => (int)$_GET['id'],
            'deleted_at IS' => null
        ])->first();

        if ($product) {
            $product->deleted_at = date('Y-m-d H:i:s');
            $productModel->save($product);
        }
    }

    return $controller->redirect('/plugins/admin/go_draw-view-admin-product-listProductAdmin.php');
}

function addProductAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $productModel = $controller->loadModel('Products');
    $categoryModel = $controller->loadModel('Categories');
    $mess = '';

    if (!empty($_GET['id'])) {
        $product = $productModel->find()
            ->join([
                [
                    'table' => 'categories',
                    'alias' => 'Categories',
                    'type' => 'LEFT',
                    'conditions' => 'Products.category_id = Categories.id',
                ]
            ])->where([
                'Products.id' => (int)$_GET['id']
            ])->first();
    } else {
        $product = $productModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['name'])
            && isset($dataSend['code'])
            && isset($dataSend['status'])
            && isset($dataSend['category_id'])
            && isset($dataSend['price'])
            && isset($dataSend['type'])
            && isset($dataSend['amount_in_stock'])
            && isset($dataSend['amount_sold'])
        ) {
            $product->name = $dataSend['name'];
            $product->code = $dataSend['code'];
            $product->status = $dataSend['status'];
            $product->category_id = (int)$dataSend['category_id'];
            $product->description = $dataSend['description'];
            $product->price = $dataSend['price'];
            $product->type = (int)$dataSend['type'];
            $product->amount_in_stock = (int) $dataSend['amount_in_stock'];
            $product->amount_sold = (int) $dataSend['amount_sold'];
            $product->image = $dataSend['image'] ?? 'https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg';
            $productModel->save($product);

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    $categoryList = $categoryModel->find()->all();

    setVariable('data', $product);
    setVariable('categoryList', $categoryList);
    setVariable('mess', $mess);
}

function getProductDetailAdminApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelProduct = $controller->loadModel('Products');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['id'])) {
            $product = $modelProduct->find()
                ->where([
                    'id' => $dataSend['id'],
                    'status' => 1
                ])->first();

            return apiResponse(0, 'Lấy thông tin sản phẩm thành công', $product);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng method POST');
}
