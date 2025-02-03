<?php

function listSamplePhotoAdmin($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách ảnh mẫu';

    $modelSamplePhoto = $controller->loadModel('SamplePhoto');
    $conditions = ['type' => 'sample_category'];
    $sampleCategories = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = array('id' => 'desc');

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int) $_GET['id'];
    }

    if (!empty($_GET['id_sample_cate'])) {
        $conditions['id_sample_cate'] = (int) $_GET['id_sample_cate'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['color'])) {
        $conditions['color LIKE'] = '%' . $_GET['color'] . '%';
    }

    if (!empty($_GET['sex'])) {
        $conditions['sex'] = $_GET['sex'];
    }

    $listData = $modelSamplePhoto->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();

    // Phân trang
    $totalData = $modelSamplePhoto->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
        $totalPage = ($totalData - $balance) / $limit;
        if ($balance > 0)
            $totalPage+=1;

        $back = $page - 1;
        $next = $page + 1;
        if ($back <= 0)
            $back = 1;
        if ($next >= $totalPage)
            $next = $totalPage;

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
        $mess = '<p class="text-success" style="padding: 0px 1.5em;">Xóa ảnh thành công</p>';
    }

    setVariable('page', $page);
    setVariable('mess', $mess);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
    setVariable('sampleCategories', $sampleCategories);
}

function editSamplePhotoAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;

    $modelSamplePhoto = $controller->loadModel('SamplePhoto');

    $metaTitleMantan = 'Thông tin ảnh mẫu';
    $mess = '';

    $conditions = ['type' => 'sample_category'];
    $sampleCategories = $modelCategories->find()->where($conditions)->all()->toList();

    if (!empty($_GET['id'])) {
        $data = $modelSamplePhoto->find()
            ->where(['id' => (int)$_GET['id']])
            ->first();
    } else {
        $data = $modelSamplePhoto->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name']) && !empty($dataSend['image'])) {
            $data->name = $dataSend['name'];
            $data->id_sample_cate = $dataSend['id_sample_cate'] ?? 0;
            $data->sex = $dataSend['sex'] ?? 1;
            $data->color = $dataSend['color'] ?? null;
            $data->image = $dataSend['image'];
            // tạo slug
            $slug = createSlugMantan($data->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew);
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));

            $data->slug = $slugNew;

            if ($modelSamplePhoto->save($data)) {
                return $controller->redirect('/plugins/admin/snaphair-view-admin-sample-listSamplePhotoAdmin?mess=saveSuccess');
            } else {
                $mess = '<p class="text-danger">Lưu dữ liệu thất bại</p>';
            }
        } else {
            $mess = '<p class="text-danger">Vui lòng nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('sampleCategories', $sampleCategories);
    setVariable('mess', $mess);
}

function deleteSamplePhotoAdmin($input) {  
    global $isRequestPost;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Xóa ảnh';

    $modelSamplePhoto = $controller->loadModel('SamplePhoto');

    if (!empty($_GET['id'])) {
        $conditions = array('id' => $_GET['id']);
        
        $photo = $modelSamplePhoto->find()->where($conditions)->first();

        if (!empty($photo)) {

            $modelSamplePhoto->delete($photo);

            return $controller->redirect('/plugins/admin/snaphair-view-admin-sample-listSamplePhotoAdmin?error=requestDeleteSuccess');
        }
    }
}
