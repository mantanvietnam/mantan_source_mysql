<?php

function listUserAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thành viên';
    $modelUser = $controller->loadModel('Users');

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

    if (!empty($_GET['phone_number'])) {
        $conditions['phone_number LIKE'] = '%' . $_GET['phone_number'] . '%';
    }

    if (!empty($_GET['email'])) {
        $conditions['email LIKE'] = '%' . $_GET['email'] . '%';
    }

    if (isset($_GET['type']) && $_GET['type'] !== '' && is_numeric($_GET['type'])) {
        $conditions['type'] = $_GET['type'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelUser->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalUser = $modelUser->find()
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

function updateStatusUserAdmin($input)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelUser->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-user-listUserAdmin.php');
}

function viewUserDetailAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');
    $metaTitleMantan = 'Thông tin người dùng';
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
    } else {
        $data = $modelUser->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            $data->name = $dataSend['name'];
            $data->avatar = $dataSend['avatar'];
            $data->phone_number = $dataSend['phone_number'];
            $data->status = $dataSend['status'];
            $data->type = $dataSend['type'];
            $data->email = $dataSend['email'];
            $data->total_coin = $dataSend['total_coin'];
            $data->available_coin = $dataSend['available_coin'];

            $modelUser->save($data);
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}
