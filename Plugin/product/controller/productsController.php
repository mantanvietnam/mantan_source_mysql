<?php 
function listProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách sản phẩm';

	$modelProduct = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('Products.id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int)  $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    $listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelProduct->find()->where($conditions)->all()->toList();
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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);

    setVariable('listData', $listData);
    setVariable('totalData', $totalData);
}

function addProduct($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin dụng cụ';

    $modelProduct = $controller->loadModel('Products');

	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProduct->get( (int) $_GET['id']);  
    }else{
        $data = $modelProduct->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
	        $data->name = @$dataSend['name'];
	        $data->image = @$dataSend['image'];
            $data->description = @$dataSend['description'];
            $data->keyword = @$dataSend['keyword'];
            $data->id_product = @$dataSend['id_product'];
            $data->id_category = (int) @$dataSend['id_category'][0];

            $modelProduct->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên sản phẩm</p>';
        }
    }
    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteProduct($input){
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	
	if(!empty($_GET['id'])){
		$data = $modelProduct->get($_GET['id']);
		
		if($data){
         	$modelProduct->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/product-view-admin-product-listProduct');
}
?>