<?php

function listBookingAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách cuốc xe';
    $bookingModel = $controller->loadModel('Bookings');
    $provinceModel = $controller->loadModel('Provinces');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $query = $bookingModel->find()
        ->join([
            [
                'table' => 'users',
                'alias' => 'PostedUsers',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.posted_by = PostedUsers.id',
                ],
            ],
            [
                'table' => 'users',
                'alias' => 'ReceivedUsers',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.received_by = ReceivedUsers.id',
                ],
            ],
            [
                'table' => 'provinces',
                'alias' => 'DepartureProvinces',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.departure_province_id = DepartureProvinces.id',
                ],
            ],
            [
                'table' => 'provinces',
                'alias' => 'DestinationProvinces',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.destination_province_id = DestinationProvinces.id',
                ],
            ]
        ]);

    if (!empty($_GET['departure_province_id'])) {
        $conditions['Bookings.departure_province_id'] = $_GET['departure_province_id'];
    }

    if (!empty($_GET['destination_province_id'])) {
        $conditions['Bookings.destination_province_id'] = $_GET['destination_province_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['Bookings.status'] = $_GET['status'];
    }

    if (!empty($_GET['posted_name'])) {
        $conditions['PostedUsers.name LIKE'] =  '%' . $_GET['posted_name'] . '%';
    }

    if (!empty($_GET['received_name'])) {
        $conditions['ReceivedUsers.name LIKE'] =  '%' . $_GET['received_name'] . '%';
    }

    if (!empty($_GET['posted_date'])) {
        $postedDate = DateTime::createFromFormat('d/m/Y', $_GET['posted_date']);
        $conditions['Bookings.created_at >='] = $postedDate->format('Y-m-d H:i:s');
        $conditions['Bookings.created_at <'] = $postedDate->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
    }

    $listProvince = $provinceModel->find()
        ->all()
        ->toList();
    $listBooking = $query->select([
            'Bookings.id',
            'Bookings.created_at',
            'Bookings.status',
            'PostedUsers.id',
            'PostedUsers.name',
            'ReceivedUsers.id',
            'ReceivedUsers.name',
            'DepartureProvinces.name',
            'DestinationProvinces.name',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalBooking = $query->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalBooking),
        $limit,
        $page
    );

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listProvince', $listProvince);
    setVariable('listBooking', $listBooking);
}
