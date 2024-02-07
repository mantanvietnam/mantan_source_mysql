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

    return $controller->redirect('/plugins/admin/excgo-view-admin-user-listUserAdmin');
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

    $requestConditions = [];
    if (isset($_GET['status']) && is_numeric($_GET['status'])) {
        $requestConditions['status'] = $_GET['status'];
    }
    $listUserRequest = $modelDriverRequest->find()
        ->where($requestConditions)
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
    $notificationModel = $controller->loadModel('Notifications');

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

            if ($user->device_token) {
                $title = 'Yêu cầu nâng cấp tài khoản được chấp nhận';
                $content = 'Yêu cầu nâng cấp tài khoản thành tài xế của bạn đã được chấp nhận';
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'upgradeToDriverSuccess'
                );

                $newNotification = $notificationModel->newEmptyEntity();
                $newNotification->user_id = $user->id;
                $newNotification->title = $title;
                $newNotification->content = $content;
                $newNotification->created_at = date('Y-m-d H:i:s');
                $newNotification->updated_at = date('Y-m-d H:i:s');
                $notificationModel->save($newNotification);
                sendNotification($dataSendNotification, $user->device_token);
            }
        }

        return $controller->redirect("/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=$user->id");
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
        ->order(['WithdrawRequests.created_at' => 'DESC'])
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

function updateStatusWithdrawRequestAdmin($input)
{
    global $controller;
    global $withdrawRequestStatus;
    global $transactionType;

    $withdrawRequestModel = $controller->loadModel('WithdrawRequests');
    $userModel = $controller->loadModel('Users');
    $transactionModel = $controller->loadModel('Transactions');
    $notificationModel = $controller->loadModel('Notifications');

    if (!empty($_GET['id'])) {
        $request = $withdrawRequestModel->find()
            ->where([
                'id' => $_GET['id']
            ])->first();

        $user = $userModel->find()
            ->where([
                'id' => $request->user_id
            ])->first();

        if ($request && isset($_GET['status'])) {
            $user->total_coin -= $request->amount;
            $userModel->save($user);

            $request->status = $_GET['status'];
            $withdrawRequestModel->save($request);

            // Save transaction
            $newTransaction = $transactionModel->newEmptyEntity();
            $newTransaction->user_id = $user->id;
            $newTransaction->amount = $request->amount;
            $newTransaction->type = $transactionType['subtract'];
            $newTransaction->name = 'Rút tiền EXC-xu thành công';
            $newTransaction->description = '-' . number_format($request->amount) . ' EXC-xu';
            $newTransaction->created_at = date('Y-m-d H:i:s');
            $newTransaction->updated_at = date('Y-m-d H:i:s');
            $transactionModel->save($newTransaction);

            if ($user->device_token && (int)$_GET['status'] === $withdrawRequestStatus['done']) {
                $title = 'Rút tiền thành công EXC-GO';
                $content = 'Rút tiền thành công '.number_format($request->amount).'đ từ tài khoản ' . $user->phone_number;
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'withdrawMoneySuccess'
                );

                $newNotification = $notificationModel->newEmptyEntity();
                $newNotification->user_id = $user->id;
                $newNotification->title = $title;
                $newNotification->content = $content;
                $newNotification->created_at = date('Y-m-d H:i:s');
                $newNotification->updated_at = date('Y-m-d H:i:s');
                $notificationModel->save($newNotification);
                sendNotification($dataSendNotification, $user->device_token);
            }
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-withdrawRequest-listWithdrawRequestAdmin');
}

function updateUserCoinAdmin($input)
{
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $metaTitleMantan;

    $userModel = $controller->loadModel('Users');
    $notificationModel = $controller->loadModel('Notifications');
    $transactionModel = $controller->loadModel('Transactions');
    $metaTitleMantan = 'Thông tin người dùng';
    $mess = '';

    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        $user = $userModel->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($isRequestPost && $user) {
            $dataSend = $input['request']->getData();
            if (!empty($dataSend['coin']) && !empty($dataSend['note'])) {
                $newTransaction = $transactionModel->newEmptyEntity();

                if ($_GET['type'] === 'plus') {
                    $user->total_coin += $dataSend['coin'];
                    $newTransaction->user_id = $user->id;
                    $newTransaction->amount = $dataSend['coin'];
                    $newTransaction->type = $transactionType['add'];
                    $newTransaction->name = 'Admin cộng coin cho người dùng';
                    $newTransaction->description = $dataSend['note'];
                    $newTransaction->created_at = date('Y-m-d H:i:s');
                    $newTransaction->updated_at = date('Y-m-d H:i:s');

                    $userModel->save($user);
                    $transactionModel->save($newTransaction);

                    $title = 'Tài khoản của bạn đã được cộng coin';
                    $content = "Tài khoản của bạn đã được cộng $newTransaction->amount coin bởi admin";
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'plusCoinSuccess'
                    );
                } else if ($_GET['type'] === 'minus') {
                    $user->total_coin -= $dataSend['coin'];
                    $newTransaction->user_id = $user->id;
                    $newTransaction->amount = $dataSend['coin'];
                    $newTransaction->type = $transactionType['subtract'];
                    $newTransaction->name = 'Admin trừ coin của người dùng';
                    $newTransaction->description = $dataSend['note'];
                    $newTransaction->created_at = date('Y-m-d H:i:s');
                    $newTransaction->updated_at = date('Y-m-d H:i:s');

                    $userModel->save($user);
                    $transactionModel->save($newTransaction);

                    $title = 'Tài khoản của bạn đã bị trừ coin';
                    $content = "Tài khoản của bạn đã bị trừ $newTransaction->amount coin bởi admin";
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'minusCoinSuccess'
                    );
                }

                // Gửi thông báo tới người dùng
                if (!empty($newTransaction)) {
                    $newNotification = $notificationModel->newEmptyEntity();
                    $newNotification->user_id = $user->id;
                    $newNotification->title = $title ?? '';
                    $newNotification->content = $content ?? '';
                    $newNotification->created_at = date('Y-m-d H:i:s');
                    $newNotification->updated_at = date('Y-m-d H:i:s');
                    $notificationModel->save($newNotification);
                    sendNotification($dataSendNotification ?? [], $user->device_token);
                }

                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            } else {
                $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
            }
        }
    } else {
        $user = $userModel->newEmptyEntity();
    }

    setVariable('data', $user);
    setVariable('mess', $mess);
}
