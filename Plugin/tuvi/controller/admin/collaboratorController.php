<?php

function listCollaboratorAdmin($input) {
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

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int) $_GET['id'];
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

    function getCollaboratorLevel($parentId) {
        return ($parentId == 0) ? 1 : 2;
    }

    foreach ($listData as $key => $collaborator) {
        $listData[$key]->level = getCollaboratorLevel($collaborator->parent);
        $listData[$key]->level_text = ($listData[$key]->level == 2) ? 'Bậc 2' : 'Bậc 1';

        if ($listData[$key]->level == 2) {
            $referrer = $modelCollaborators->find()->where(['id' => $collaborator->parent])->first();
            $listData[$key]->referrer_name = (!empty($referrer)) ? $referrer->name : 'Không xác định';
        } else {
            $listData[$key]->referrer_name = '';
        }
    }

    // Phân trang
    $totalData = $modelCollaborators->find()->where($conditions)->count();
    $totalPage = ceil($totalData / $limit);

    $back = max(1, $page - 1);
    $next = min($totalPage, $page + 1);

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }

    $urlPage .= (strpos($urlPage, '?') !== false ? '&' : '?') . 'page=';

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

    $modelCollaborator = $controller->loadModel('Collaborator');
    

    $metaTitleMantan = 'Thông tin Cộng Tác Viên';
    $mess = '';

    $listCollaborators = $modelCollaborator->find()->order(['name' => 'ASC'])->all()->toList();
    
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
            $existingPhone = $modelCollaborator->find()
                ->where([
                    'phone' => $dataSend['phone'],
                    'id !=' => $data->id
                ])
                ->first();

            if ($existingPhone) {
                $mess = '<p class="text-danger">Số điện thoại đã tồn tại. Vui lòng nhập số khác.</p>';
            } else {
                $data->name = $dataSend['name'];
                $data->phone = $dataSend['phone'];
                $data->email = $dataSend['email'];
                if (!empty($dataSend['password'])) {
                    $data->password = md5($dataSend['password']);
                }
                $data->status = $dataSend['status'] ?? 1;
                $data->image = $dataSend['image'] ?? null;
                $data->parent = (int)($dataSend['parent'] ?? 0);

                $slug = createSlugMantan($data->name);
                $slugNew = $slug;
                $number = 0;
                do {
                    $conditions = array('slug' => $slugNew);
                    $listData = $modelCollaborator->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if (!empty($listData)) {
                        $number++;
                        $slugNew = $slug . '-' . $number;
                    }
                } while (!empty($listData));

                $data->slug = $slugNew;

            if ($modelCollaborator->save($data)) {
                return $controller->redirect('/plugins/admin/tuvi-view-admin-collaborator-listCollaboratorAdmin?mess=saveSuccess');
            } else {
                $mess = '<p class="text-danger">Lưu dữ liệu thất bại</p>';
            }
        }
        } else {
            $mess = '<p class="text-danger">Vui lòng nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCollaborators', $listCollaborators);
}

function deleteCollaboratorAdmin($input) {
    global $controller;
    $modelCollaborators = $controller->loadModel('Collaborator');

    if (!empty($_GET['id'])) {
        $collaboratorId = (int) $_GET['id'];

        $modelCollaborators->updateAll(['parent' => 0], ['parent' => $collaboratorId]);

        $data = $modelCollaborators->find()->where(['id' => $collaboratorId])->first();
        if ($data) {
            $modelCollaborators->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tuvi-view-admin-collaborator-listCollaboratorAdmin?mess=deleteSuccess');
}


function settingAffiliateAdmin($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;

    $metaTitleMantan = 'Cài đặt hoa hồng giới thiệu';
    $mess= '';

    $conditions = array('key_word' => 'settingAffiliateAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'percent1' => (double) $dataSend['percent1'],
                        'percent2' => (double) $dataSend['percent2'],
                    );

        $data->key_word = 'settingAffiliateAdmin';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}