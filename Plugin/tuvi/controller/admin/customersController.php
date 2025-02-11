<?php 
 
 function listCustomersAdmin($input) // hiển thị danh danh sách khách hàng
 {
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách khách hàng';
    $modelCustomers = $controller->loadModel('Customers');
   
    $conditions = [];  
    //tìm kiếm theo tên 
    if (!empty($_GET['name']) && is_string($_GET['name'])) {
        $conditions['name LIKE'] = '%' . htmlspecialchars($_GET['name']) . '%';
    }
    // tìm kiếm theo ID
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = (int)$_GET['id'];
    }
    //tìm kiếm theo số điện thoại
    if (!empty($_GET['phone']) && is_numeric($_GET['phone'])) {
        $conditions['phone'] = (int)$_GET['phone'];
    }
    //tìm kiếm theo email
    if (!empty($_GET['email']) && is_string($_GET['email'])) {
        $conditions['email'] = htmlspecialchars($_GET['email']);
    }
    //phân trang
    $limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelCustomers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelCustomers ->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }
    //tính tổng số trang
    $totalData = $modelCustomers->find()->where($conditions)->all()->toList();
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

