<?php
function listProvinceAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tỉnh thành';
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

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function updateStatusProvinceAdmin($input)
{
    global $controller;

    $modelProvinces = $controller->loadModel('Provinces');

    if (!empty($_GET['id'])) {
        $data = $modelProvinces->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data) {
            if (isset($_GET['status'])) {
                $data->status = $_GET['status'];
                $modelProvinces->save($data);
            }
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-province-listProvinceAdmin.php');
}
