<?php 
function listDiscountCodeAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách mã giảm giá';

    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelDiscountCode->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelDiscountCode->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelDiscountCode->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_product');
    $categories = $modelCategories->find()->where($conditions)->all()->toList();
    $listCategory = [];
    if(!empty($categories)){
        foreach ($categories as $key => $value) {
            $listCategory[$value->id] = $value->name;
        }
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
}

function addDiscountCodeAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin mã giảm giá';


    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelDiscountCode->get( (int) $_GET['id']);

    }else{
        $data = $modelDiscountCode->newEmptyEntity();
        $data->created_at = date('Y-m-d H:i:s');
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->status = @$dataSend['status'];
            $data->code = strtoupper(@$dataSend['code']);
            $data->discount = (double) @$dataSend['discount'];
            $data->maximum_price_reduction = @$dataSend['maximum_price_reduction'];
            $data->id_customers = @$dataSend['id_customers'];
            $data->id_products = @$dataSend['id_products'];
            $data->number_user = @$dataSend['number_user'];
            $data->category = @$dataSend['category'];
            if(!empty($dataSend['deadline_at'])){
                $data->deadline_at = DateTime::createFromFormat('d/m/Y', @$dataSend['deadline_at'])->format('Y-m-d 23:59:59');
            }
            
            $data->note = @$dataSend['note'];
            $data->applicable_price = @$dataSend['applicable_price'];
            $modelDiscountCode->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/product-view-admin-discountCode-listDiscountCodeAdmin?status=2');
            }else{
              
                return $controller->redirect('/plugins/admin/product-view-admin-discountCode-listDiscountCodeAdmin?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }

    $conditions = array('type' => 'category_product');
    $categories = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('categories', $categories);
}

function deleteDiscountCodeAdmin($input){
    global $controller;
    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    if(!empty($_GET['id'])){
        $data = $modelDiscountCode->get($_GET['id']);
        
        if($data){
            $modelDiscountCode->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/product-view-admin-discountCode-listDiscountCodeAdmin?status=3');
}
?>