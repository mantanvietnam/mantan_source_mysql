<?php 
function listPackageAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách mã giảm giá';

    $modelPackage = $controller->loadModel('Packages');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelPackage->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    
    // phân trang
    $totalData = $modelPackage->find()->where($conditions)->all()->toList();
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

function addPackageAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin mã giảm giá';


    $modelPackage = $controller->loadModel('Packages');
    $modelMember = $controller->loadModel('Members');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelPackage->get( (int) $_GET['id']);

    }else{
        $data = $modelPackage->newEmptyEntity();
        $data->created_at = date('Y-m-d H:i:s');
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save 
            $data->name = @$dataSend['name'];
            $data->price = (int)@$dataSend['price'];
            $data->status = @$dataSend['status'];
            $data->point = (int)@$dataSend['point'];
            $data->numerology = (int)@$dataSend['numerology'];
          
            $modelPackage->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/hethongdaily-view-admin-package-listPackageAdmin?status=2');
            }else{
              
                return $controller->redirect('/plugins/admin/hethongdaily-view-admin-package-listPackageAdmin?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deletePackageAdmin($input){
    global $controller;
    $modelPackage = $controller->loadModel('Packages');
    if(!empty($_GET['id'])){
        $data = $modelPackage->get($_GET['id']);
        
        if($data){
            $modelPackage->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/hethongdaily-view-admin-package-listPackageAdmin?status=3');
}
?>