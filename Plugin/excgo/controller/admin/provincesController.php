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

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelProvinces->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-province-listProvinceAdmin');
}

function addProvinceAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin khu vực';
    $provinceModel = $controller->loadModel('Provinces');
    $mess = '';

    if (!empty($_GET['parent_id'])) {
        $parent = $provinceModel->find()->where(['id' => (int)$_GET['parent_id']])->first();
    }
    $listProvince = $provinceModel->find()
        ->where([
            'status' => 1,
            'parent_id' => 0
        ])->all()
        ->toList();

    if (!empty($_GET['id'])) {
        $data = $provinceModel->find()->where(['id' => $_GET['id']])->first();
    } else {
        $data = $provinceModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            $data->parent_id = $dataSend['parent_id'] ?? 0;
            $data->status = (int) $dataSend['status'] ?? 1;
            $provinceModel->save($data);

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('listProvince', $listProvince);
    setVariable('parent', $parent ?? null);
    setVariable('mess', $mess);
}