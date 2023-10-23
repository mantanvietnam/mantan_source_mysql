<?php

function listCategoryAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $domain;

    $metaTitleMantan = 'Danh sách danh mục';
    $categoryModel = $controller->loadModel('Categories');
    $conditions = ['deleted_at IS' => null];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $categoryModel->find();

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int)$_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    $listData = $query->where($conditions)
        ->limit($limit)
        ->page($page)
        ->all()
        ->toList();
    $total = $categoryModel->find()->count();
    $paginationMeta = createPaginationMetaData($total, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function addCategoryAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $categoryModel = $controller->loadModel('Categories');
    $mess = '';

    if (!empty($_GET['id'])) {
        $category = $categoryModel->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
    } else {
        $category = $categoryModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['name'])) {
            $category->name = $dataSend['name'];
            $category->image = $dataSend['image'] ?? 'https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg';
            $category->description = $dataSend['description'] ?? null;
            $category->type = 1;
            $category->slug = createSlugMantan($dataSend['name']);
            $categoryModel->save($category);

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    setVariable('data', $category);
    setVariable('mess', $mess);
}

function deleteCategoryAdmin($input)
{
    global $controller;

    $categoryModel = $controller->loadModel('Categories');

    if (!empty($_GET['id'])) {
        $category = $categoryModel->find()->where([
            'id' => (int)$_GET['id'],
            'deleted_at IS' => null
        ])->first();

        if ($category) {
            $category->deleted_at = date('Y-m-d H:i:s');
            $categoryModel->save($category);
        }
    }

    return $controller->redirect('/plugins/admin/go_draw-view-admin-category-listCategoryAdmin.php');
}
