<?php

function listCategoryAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách cuốc xe';
    $categoryModel = $controller->loadModel('Categories');
    $conditions = ['deleted_at IS' => null];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 10;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $categoryModel->find();

    if (!empty($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    $listData = $query->where($conditions)
        ->limit($limit)
        ->page($page)
        ->all()
        ->toList();

    setVariable('listData', $listData);
}