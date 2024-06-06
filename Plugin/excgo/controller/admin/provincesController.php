<?php
function listProvinceAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tỉnh thành';
    $modelProvinces = $controller->loadModel('Provinces');

    $conditions = ['parent_id' => 0];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int) $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['bsx'])) {
        $conditions['bsx LIKE'] = '%' . $_GET['bsx'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelProvinces->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalProvince = $modelProvinces->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalProvince),
        $limit,
        $page
    );

    if(!empty($listData)){
        foreach($listData as $key =>  $item){
            $listData[$key]->count =  count($modelProvinces->find()->where(['parent_id' => $item->id])->all()->toList());
        }

    }

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function updateStatusProvinceAdmin($input)
{
    global $controller;

    $modelProvinces = $controller->loadModel('Provinces');

    if (!empty($_GET['id'])) {
        $data = $modelProvinces->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelProvinces->save($data);
        }
    }
     if (!empty($_GET['parent_id'])) {
        
        return $controller->redirect('/plugins/admin/excgo-view-admin-province-listProvinceGroupAdmin?parent_id='.$_GET['parent_id']);
    }else{
        return $controller->redirect('/plugins/admin/excgo-view-admin-province-listProvinceAdmin');
    }

}



function addProvinceAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin khu vực';
    $modelProvinces = $controller->loadModel('Provinces');
    $mess = '';

    if(!empty($_GET['id'])){
        $data = $modelProvinces->get($_GET['id']);
    }else{
        $data = $modelProvinces->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            $data->parent_id = 0;
            $data->status = (int) $dataSend['status'] ?? 1;
            $data->ghim = (int) @$dataSend['ghim'];
            $modelProvinces->save($data);

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

     // debug($listChildProvince);die;

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function listProvinceGroupAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách nhóm';
    $modelProvinces = $controller->loadModel('Provinces');

    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['parent_id'])) {
        $conditions['parent_id'] = (int) $_GET['parent_id'];
        $data = $modelProvinces->find()->where(['id' => $_GET['parent_id']])->first();
    }else{
        return $controller->redirect('/plugins/admin/excgo-view-admin-province-listProvinceAdmin');
    }

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int) $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['bsx'])) {
        $conditions['bsx LIKE'] = '%' . $_GET['bsx'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelProvinces->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->all()
        ->toList();
    $totalProvince = $modelProvinces->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalProvince),
        $limit,
        $page
    );

    if(!empty($listData)){
        foreach($listData as $key =>  $item){
            $listData[$key]->count =  count($modelProvinces->find()->where(['parent_id' => $item->id])->all()->toList());
        }

    }

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
    setVariable('data', $data);
}

function addProvinceGroupAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin khu vực';
    $modelProvinces = $controller->loadModel('Provinces');
    $mess = '';


     if (!empty($_GET['parent_id'])) {
        $conditions['parent_id'] = (int) $_GET['parent_id'];
        $province = $modelProvinces->find()->where(['id' => $_GET['parent_id']])->first();
    }else{
        return $controller->redirect('/plugins/admin/excgo-view-admin-province-listProvinceAdmin');
    }


    if(!empty($_GET['id'])){
        $data = $modelProvinces->get($_GET['id']);
    }else{
        $data = $modelProvinces->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            $data->parent_id = $province->id;
            $data->status = (int) $dataSend['status'] ?? 1;
            $data->ghim = (int) @$dataSend['ghim'];
            $modelProvinces->save($data);

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

     // debug($listChildProvince);die;

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('province', $province);
}