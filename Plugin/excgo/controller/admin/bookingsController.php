<?php

function listBookingAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách cuốc xe';
    $bookingModel = $controller->loadModel('Bookings');
    $provinceModel = $controller->loadModel('Provinces');

    $conditions = array();
    $order = ['Bookings.created_at' => 'DESC'];
    $join = [
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
    ];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id'])) {
        $conditions['Bookings.id'] = $_GET['id'];
    }

    if (!empty($_GET['departure_province_id'])) {
        $conditions['Bookings.departure_province_id'] = $_GET['departure_province_id'];
    }

    if (!empty($_GET['destination_province_id'])) {
        $conditions['Bookings.destination_province_id'] = $_GET['destination_province_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['Bookings.status'] = $_GET['status'];
    }

    if (!empty($_GET['id_posted'])) {
        $conditions['PostedUsers.id'] =  $_GET['id_posted'];
    }

    if (!empty($_GET['id_received'])) {
        $conditions['ReceivedUsers.id'] =  $_GET['id_received'];
    }

    /*if (!empty($_GET['posted_date'])) {
        $postedDate = DateTime::createFromFormat('d/m/Y', $_GET['posted_date']);
        $conditions['Bookings.created_at >='] = $postedDate->format('Y-m-d H:i:s');
        $conditions['Bookings.created_at <'] = $postedDate->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
    }*/

    $listProvince = $provinceModel->find()
        ->all()
        ->toList();
    $listBooking = $bookingModel->find()
        ->join($join)
        ->select([
            'Bookings.id',
            'Bookings.created_at',
            'Bookings.status',
            'Bookings.status_free',
            'PostedUsers.id',
            'PostedUsers.name',
            'ReceivedUsers.id',
            'ReceivedUsers.name',
            'DepartureProvinces.name',
            'DestinationProvinces.name',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();
    $totalBooking = $bookingModel->find()
        ->join($join)
        ->where($conditions)
        ->order($order)
        ->all()
        ->count();
    $paginationMeta = createPaginationMetaData(
        $totalBooking,
        $limit,
        $page
    );

    setVariable('page', $page);
    setVariable('paginationMeta', $totalBooking);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listProvince', $listProvince);
    setVariable('listBooking', $listBooking);
}

function viewBookingDetailAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin cuốc xe';
    $bookingModel = $controller->loadModel('Bookings');
    $provinceModel = $controller->loadModel('Provinces');
    $mess = '';
    $listProvince = $provinceModel->find()
        ->where(['status' => 1])
        ->all()
        ->toList();

    if (!empty($_GET['id'])) {
        $data = getDetailBooking($_GET['id']);
    } else {
        $data = $bookingModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])){
            $data->name = $dataSend['name'];
        }
        if(!empty($dataSend['start_time'])){
            $data->start_time = date('Y-m-d H:i:s', strtotime($dataSend['start_time']));
        }
        if(!empty($dataSend['finish_time'])){
            $data->finish_time = date('Y-m-d H:i:s', strtotime($dataSend['finish_time']));
        }
        if(!empty($dataSend['departure'])){
            $data->departure = $dataSend['departure'];
        }
        if(!empty($dataSend['destination'])){
            $data->destination = $dataSend['destination'];
        }
        if(!empty($dataSend['departure_province_id'])){
            $data->departure_province_id = $dataSend['departure_province_id'];
        }
        if(!empty($dataSend['destination_province_id'])){
            $data->destination_province_id = $dataSend['destination_province_id'];
        }
        if(!empty($dataSend['introduce_fee'])){
            $data->introduce_fee = $dataSend['introduce_fee'];
        }
        if(!empty($dataSend['price'])){
            $data->price = $dataSend['price'];
        }
        
            
            $data->status = $dataSend['status'];
            if (isset($dataSend['posted_by'])) {
                $data->posted_by = $dataSend['posted_by'];
            }
            if (isset($dataSend['posted_by'])) {
                $data->received_by = $dataSend['received_by'];
            }

            $bookingModel->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
       
    }

    setVariable('data', $data);
    setVariable('listProvince', $listProvince);
    setVariable('mess', $mess);
}
