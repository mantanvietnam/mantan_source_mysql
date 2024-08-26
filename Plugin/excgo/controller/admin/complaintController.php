<?php

function listComplaintAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khiếu nại';
    $complaintModel = $controller->loadModel('Complaints');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['Complaints.id'] = (int) $_GET['id'];
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

    if (isset($_GET['status']) && $_GET['status'] != '') {
        $conditions['Complaints.status'] = $_GET['status'];
    }


    $query = $complaintModel->find()
        ->join([
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => [
                    'Complaints.posted_by = Users.id',
                ],
            ],
            [
                'table' => 'users',
                'alias' => 'ComplainedUsers',
                'type' => 'LEFT',
                'conditions' => [
                    'Complaints.complained_driver_id = ComplainedUsers.id',
                ],
            ],
            [
                'table' => 'bookings',
                'alias' => 'Bookings',
                'type' => 'LEFT',
                'conditions' => [
                    'Complaints.booking_id = Bookings.id',
                ],
            ],
        ]);

    $listComplaint = $query->select([
            'Complaints.id',
            'Complaints.posted_by',
            'Complaints.booking_id',
            'Complaints.complained_driver_id',
            'Complaints.content',
            'Complaints.status',
            'Complaints.type',
            'Complaints.id_order',
            'Complaints.created_at',
            'Complaints.updated_at',
            'Users.id',
            'Users.name',
            'Users.phone_number',
            'Users.email',
            'Users.avatar',
            'ComplainedUsers.id',
            'ComplainedUsers.name',
            'ComplainedUsers.phone_number',
            'ComplainedUsers.email',
            'ComplainedUsers.avatar',
            'Bookings.name',
            'Bookings.description',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['Complaints.created_at' => 'DESC'])
        ->all()
        ->toList();

    $totalComplaint = $query->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(count($totalComplaint), $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listComplaint);
}

function updateStatusComplaintAdmin($input)
{
    global $controller;

    $modelComplaint = $controller->loadModel('Complaints');

    if (!empty($_GET['id'])) {
        $data = $modelComplaint->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelComplaint->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-complaint-listComplaintAdmin.php');
}
