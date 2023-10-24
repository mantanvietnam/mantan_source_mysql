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
