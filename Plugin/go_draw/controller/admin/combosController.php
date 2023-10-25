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

function viewComboDetailAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $comboModel = $controller->loadModel('Combos');
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $comboModel->find()->where([
            'id' => $_GET['id']
        ])->first();
    } else {
        $data = $comboModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])
            || !empty($dataSend['address'])
            || !empty($dataSend['phone'])
        ) {
            $data->name = $dataSend['name'];
            $data->address = $dataSend['address'];
            $data->phone = $dataSend['phone'];
            $data->status = $dataSend['status'];

            $agencyModel->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}
