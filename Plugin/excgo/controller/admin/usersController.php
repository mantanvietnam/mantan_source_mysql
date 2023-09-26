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
    $modelImage = $controller->loadModel('Images');
    $modelDriverRequest = $controller->loadModel('DriverRequests');
    $metaTitleMantan = 'Thông tin người dùng';
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
        $idCardFront = $modelImage->find()
            ->where([
                'owner_id' => $_GET['id'],
                'owner_type' => 'users',
                'type' => 'id-card-front'
            ])->first();
        $idCardBack = $modelImage->find()
            ->where([
                'owner_id' => $_GET['id'],
                'owner_type' => 'users',
                'type' => 'id-card-back'
            ])->first();
        $car = $modelImage->find()
            ->where([
                'owner_id' => $_GET['id'],
                'owner_type' => 'users',
                'type' => 'car'
            ])->all();

        $isRequestUpgrade = $modelDriverRequest->find()
            ->where(['user_id' => $_GET['id']])
            ->where(['status' => 0])
            ->first();
    } else {
        $data = $modelUser->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            $data->avatar = $dataSend['avatar'];
            $data->phone_number = $dataSend['phone_number'];
            $data->status = $dataSend['status'];
            $data->type = $dataSend['type'];
            $data->email = $dataSend['email'];
            $data->total_coin = $dataSend['total_coin'];
            $data->available_coin = $dataSend['available_coin'];

            $modelUser->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    if (isset($idCardFront) && isset($idCardBack) && isset($car)) {
        setVariable('idCardFront', $idCardFront);
        setVariable('idCardBack', $idCardBack);
        setVariable('car', $car);
    }

    if (isset($isRequestUpgrade)) {
        setVariable('isRequestUpgrade', $isRequestUpgrade);
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function listUpgradeRequestToDriverAdmin($input)
{
    global $controller;

    $modelDriverRequest = $controller->loadModel('DriverRequests');
    $modelUser = $controller->loadModel('Users');

    $listUserRequest = $modelDriverRequest->find()
        ->where(['status' => 0])
        ->all();

    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (count($listUserRequest->toList())) {
        $listUserId = $listUserRequest->map(function ($item) {
            return $item->user_id;
        })->toList();
        $conditions = ['id IN' => $listUserId];

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
            ->count();
    } else {
        $listData = [];
        $totalUser = 0;
    }

    $paginationMeta = createPaginationMetaData($totalUser, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function acceptUpgradeToDriverAdmin($input)
{
    global $controller;
    global $memberType;

    $modelUser = $controller->loadModel('Users');
    $modelDriverRequest = $controller->loadModel('DriverRequests');

    if (!empty($_GET['id'])) {
        $user = $modelUser->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($user) {
            $user->type = $memberType['driver'];
            $modelUser->save($user);

            $request = $modelDriverRequest->find()
                ->where(['user_id' => $_GET['id']])
                ->first();
            $request->status = 1;
            $request->handled_by = 1;
            $modelDriverRequest->save($request);
        }

        return $controller->redirect("/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin.php/?id=$user->id");
    }
}

function listWithdrawRequestAdmin($input)
{
    global $controller;
    global $withdrawRequestStatus;

    $withdrawRequestModel = $controller->loadModel('WithdrawRequests');
    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $query = $withdrawRequestModel->find()
        ->join([
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => [
                    'WithdrawRequests.user_id = Users.id',
                ],
            ],
        ]);

    if (!empty($_GET['user_id'])) {
        $conditions['Users.id'] = $_GET['user_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['WithdrawRequests.status'] = $_GET['status'];
    } else {
        $conditions['WithdrawRequests.status'] = $withdrawRequestStatus['pending'];
    }

    if (!empty($_GET['name'])) {
        $conditions['Users.name LIKE'] =  '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['Users.phone_number'] = $_GET['phone_number'];
    }

    if (!empty($_GET['email'])) {
        $conditions['Users.email'] = $_GET['email'];
    }

    $requestList = $query->select([
            'Users.id',
            'Users.name',
            'Users.avatar',
            'Users.total_coin',
            'Users.phone_number',
            'Users.bank_account',
            'Users.account_number',
            'Users.email',
            'WithdrawRequests.id',
            'WithdrawRequests.amount',
            'WithdrawRequests.status',
            'WithdrawRequests.created_at',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalRequest = $query->where($conditions)->count();
    $paginationMeta = createPaginationMetaData($totalRequest, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $requestList);
}
