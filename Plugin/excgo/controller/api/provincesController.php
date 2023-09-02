<?php

function getListProvinceApi($input): array
{
    global $controller;

    $modelProvinces = $controller->loadModel('Provinces');
    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['bsx'])) {
        $conditions['bsx LIKE'] = '%' . $_GET['bsx'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelProvinces->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalProvince = $modelProvinces->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalProvince),
        $limit,
        $page
    );

    return apiResponse(0, 'Lấy danh sách tỉnh thành công', $listData, $paginationMeta);
}
