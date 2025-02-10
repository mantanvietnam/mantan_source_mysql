<?php

function listCollaboratorAdmin($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cộng Tác Viên';

    $modelCollaborators = $controller->loadModel('Collaborator');
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = array('id' => 'desc');

    // Lọc theo ID
    if (!empty($_GET['id'])) {
        $conditions['id'] = (int) $_GET['id'];
    }

    // Lọc theo tên
    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    // Lọc theo số điện thoại
    if (!empty($_GET['phone'])) {
        $conditions['phone LIKE'] = '%' . $_GET['phone'] . '%';
    }

    // Lọc theo email
    if (!empty($_GET['email'])) {
        $conditions['email LIKE'] = '%' . $_GET['email'] . '%';
    }

    // Lọc theo trạng thái
    if (isset($_GET['status'])) {
        $conditions['status'] = (int) $_GET['status'];
    }

    $listData = $modelCollaborators->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();

    // Phân trang
    $totalData = $modelCollaborators->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0) {
        $totalPage += 1;
    }

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0) $back = 1;
    if ($next >= $totalPage) $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }

    $mess = '';
    if (@$_GET['mess'] == 'saveSuccess') {
        $mess = '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
    } elseif (@$_GET['mess'] == 'deleteSuccess') {
        $mess = '<p class="text-success" style="padding: 0px 1.5em;">Xóa cộng tác viên thành công</p>';
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

function editCollaboratorAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCollaborators;

    $modelCollaborator = $controller->loadModel('Collaborator');

    $metaTitleMantan = 'Thông tin Cộng Tác Viên';
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $modelCollaborator->find()
            ->where(['id' => (int)$_GET['id']])
            ->first();
    } else {
        $data = $modelCollaborator->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['email'])) {
            $data->name = $dataSend['name'];
            $data->phone = $dataSend['phone'];
            $data->email = $dataSend['email'];
            $data->status = $dataSend['status'] ?? 1;
            $data->image = $dataSend['image'] ?? null;

            // Tạo slug từ tên
            $slug = createSlugMantan($data->name);
            $slugNew = $slug;
            $number = 0;
            do {
                $conditions = array('slug' => $slugNew);
                $listData = $modelCollaborators->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if (!empty($listData)) {
                    $number++;
                    $slugNew = $slug . '-' . $number;
                }
            } while (!empty($listData));

            $data->slug = $slugNew;

            if ($modelCollaborator->save($data)) {
                return $controller->redirect('/plugins/admin/snaphair-view-admin-collaborator-listCollaboratorAdmin?mess=saveSuccess');
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
