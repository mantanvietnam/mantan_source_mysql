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

    if (!empty($_GET['phone'])) {
        $conditions['phone LIKE'] = '%' . $_GET['phone'] . '%';
    }

    if (!empty($_GET['email'])) {
        $conditions['email LIKE'] = '%' . $_GET['email'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelUser->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['id'=>'desc'])
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

    return $controller->redirect('/plugins/admin/go_draw-view-admin-user-listUserAdmin');
}

function viewUserDetailAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $userModel = $controller->loadModel('Users');
    $mess = '';

    if (!empty($_GET['id'])) {
        $user = $userModel->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
    } else {
        $user = $userModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])
            || !empty($dataSend['email'])
            || !empty($dataSend['phone'])
        ) {
            $user->name = $dataSend['name'];
            $user->email = $dataSend['email'];
            $user->phone = $dataSend['phone'];
            $user->total_coin = $dataSend['total_coin'];
            $user->status = $dataSend['status'];

            $userModel->save($user);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    setVariable('data', $user);
    setVariable('mess', $mess);
}
