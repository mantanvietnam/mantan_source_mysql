<?php

function listSupportAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách yêu cầu';
    $supportModel = $controller->loadModel('SupportRequests');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['SupportRequests,id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['Users.name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['Users.phone_number'] = $_GET['phone_number'];
    }

    if (!empty($_GET['email'])) {
        $conditions['Users.email'] = $_GET['email'];
    }

    if (isset($_GET['status'])) {
        $conditions['SupportRequests.status'] = $_GET['status'];
    }


    $query = $supportModel->find()
        ->join([
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => [
                    'SupportRequests.user_id = Users.id',
                ],
            ],
        ]);

    $listRequest = $query->select([
        'SupportRequests.id',
        'SupportRequests.user_id',
        'SupportRequests.content',
        'SupportRequests.status',
        'SupportRequests.created_at',
        'SupportRequests.updated_at',
        'Users.id',
        'Users.name',
        'Users.phone_number',
        'Users.email',
        'Users.avatar',
    ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['SupportRequests.created_at' => 'DESC'])
        ->all()
        ->toList();

    $totalRequest = $query->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(count($totalRequest), $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listRequest);
}

function updateStatusSupportAdmin($input)
{
    global $controller;

    $modelSupport = $controller->loadModel('SupportRequests');

    if (!empty($_GET['id'])) {
        $data = $modelSupport->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelSupport->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-support-listSupportAdmin.php');
}
