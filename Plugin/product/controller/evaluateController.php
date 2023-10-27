<?php 
function listEvaluate($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đánh giá';

    $modelEvaluate = $controller->loadModel('Evaluates');

    if(!isset($_GET['id_product'])){
        return $controller->redirect('/plugins/admin/product-view-admin-evaluate-listProduct.php');
    }
    
    $conditions = array();
    $conditions['id_product']=$_GET['id_product'];
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');


    
    $listData = $modelEvaluate->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelEvaluate->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelEvaluate->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addEvaluate($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin đánh giá';


    $modelEvaluate = $controller->loadModel('Evaluates');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelEvaluate->get( (int) $_GET['id']);
        $data->image = json_decode($data->image, true);
        $data->created_at = date('Y-m-d H:i:s');
    }else{
        $data = $modelEvaluate->newEmptyEntity();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['full_name'])){
            // tạo dữ liệu save
            $data->full_name = @$dataSend['full_name'];
            $data->avatar = @$dataSend['avatar'];
            $data->id_product = @$dataSend['id_product'];
            $data->content = @$dataSend['content'];
            $data->point = @$dataSend['point'];
            $data->image = json_encode($dataSend['image']);;
            $data->id_product = @$_GET['id_product'];

            $modelEvaluate->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/product-view-admin-evaluate-listEvaluate.php?status=2&id_product='.$_GET['id_product']);
            }else{
                return $controller->redirect('/plugins/admin/product-view-admin-evaluate-listEvaluate.php?status=1&id_product='.$_GET['id_product']);
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteEvaluate($input){
    global $controller;
    $modelEvaluate = $controller->loadModel('Evaluates');
    if(!empty($_GET['id'])){
        $data = $modelEvaluate->get($_GET['id']);
        
        if($data){
            $modelEvaluate->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/product-view-admin-evaluate-listEvaluate.php?status=3&id_product='.$_GET['id_product']);
}
 ?>