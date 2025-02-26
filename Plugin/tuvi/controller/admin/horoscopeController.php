<?php

function listHoroscopeAdmin($input) {
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Tử Vi';

    $modelHoroscopes = $controller->loadModel('Horoscope');
    $conditions = [];
    $limit = 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = ['year' => 'desc'];

    // Lọc theo năm sinh
    if (!empty($_GET['year'])) {
        $conditions['year'] = (int)$_GET['year'];
    }

    // Lọc theo giới tính
    if (!empty($_GET['gender'])) {
        $conditions['gender'] = $_GET['gender'];
    }


    // Lấy dữ liệu tử vi
    $listData = $modelHoroscopes->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();

    $totalData = $modelHoroscopes->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $totalPage = ceil($totalData / $limit);
    $back = max(1, $page - 1);
    $next = min($totalPage, $page + 1);

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }

    $urlPage .= (strpos($urlPage, '?') !== false) ? '&page=' : '?page=';

    $mess = '';
    if (@$_GET['mess'] == 'saveSuccess') {
        $mess = '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
    } elseif (@$_GET['mess'] == 'deleteSuccess') {
        $mess = '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('page', $page);
    setVariable('mess', $mess);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
}

function addHoroscopeAdmin($input) {
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thêm/Sửa Tử Vi';
    $modelHoroscopes = $controller->loadModel('Horoscope');
    $mess = '';

    if (!empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        $data = $modelHoroscopes->find()->where(['id' => $id])->first();
    } else {
        $data = $modelHoroscopes->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['year']) && !empty($dataSend['gender'])) {
            $data->year          = $dataSend['year'];
            $data->gender        = $dataSend['gender'];
            $data->image         = $dataSend['image'] ?? '';
            $data->price = isset($dataSend['price']) ? (int) str_replace('.', '', $dataSend['price']) : 0;
            $data->overview      = $dataSend['overview'] ?? '';
            $data->description   = $dataSend['description'] ?? '';
            $data->direction     = $dataSend['direction'] ?? '';
            $data->five_elements = $dataSend['five_elements'] ?? '';
            $data->mascot        = $dataSend['mascot'] ?? '';
            $data->name_by_age   = $dataSend['name_by_age'] ?? '';

            $slug = createSlugMantan($data->year . '-' . $data->gender);
            $slugNew = $slug;
            $number = 0;
            do {
                $conditions = ['slug' => $slugNew];
                $listData = $modelHoroscopes->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if (!empty($listData)) {
                    $number++;
                    $slugNew = $slug . '-' . $number;
                }
            } while (!empty($listData));

            $data->slug = $slugNew;

            if ($modelHoroscopes->save($data)) {
                return $controller->redirect('/plugins/admin/tuvi-view-admin-horoscope-listHoroscopeAdmin?mess=saveSuccess');
            } else {
                $mess = '<p class="text-danger">Lưu dữ liệu thất bại</p>';
            }
        } else {
            $mess = '<p class="text-danger">Vui lòng nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteHoroscopeAdmin($input){
    global $controller;

    $modelEvents = $controller->loadModel('Horoscope');
    
    if(!empty($_GET['id'])){
        $data = $modelEvents->find()->where(['id'=>(int) $_GET['id']])->first();
        
        if($data){
            $modelEvents->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tuvi-view-admin-horoscope-listHoroscopeAdmin');
}