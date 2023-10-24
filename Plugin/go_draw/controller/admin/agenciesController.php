<?php

function listAgencyAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đại lý';
    $agencyModel = $controller->loadModel('Agencies');

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

    if (!empty($_GET['phone'])) {
        $conditions['phone LIKE'] = '%' . $_GET['phone'] . '%';
    }

    if (!empty($_GET['address'])) {
        $conditions['address LIKE'] = '%' . $_GET['address'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $agencyModel->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalUser = $agencyModel->find()
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

function updateStatusAgencyAdmin($input)
{
    global $controller;

    $agencyModel = $controller->loadModel('Agencies');

    if (!empty($_GET['id'])) {
        $data = $agencyModel->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $agencyModel->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/go_draw-view-admin-agency-listAgencyAdmin.php');
}

function viewDetailAgencyAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $agencyModel = $controller->loadModel('Agencies');
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $agencyModel->find()->where([
            'id' => $_GET['id']
        ])->first();
    } else {
        $data = $agencyModel->newEmptyEntity();
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
