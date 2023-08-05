<?php 
function listPriceAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cài đặt giá';

	$modelPrices = $controller->loadModel('prices');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['type'])){
        $conditions['type'] = (int) $_GET['type'];
    }

    
    $listData = $modelPrices->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
   
    // phân trang
    $totalData = $modelPrices->find()->where($conditions)->all()->toList();
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

}

function addPriceAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Cài đặt giá';

	$modelPrices = $controller->loadModel('Prices');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelPrices->get( (int) $_GET['id']);
    }else{
        $data = $modelPrices->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['type'])){
            $data->price = $dataSend['price'];
            $data->type = $dataSend['type'];
	        $data->hour = $dataSend['hour'];	
	                    
	        $modelPrices->save($data);
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deletePriceAdmin($input){
	global $controller;

	$modelPrices = $controller->loadModel('Prices');
	
	if(!empty($_GET['id'])){
		$data= $modelPrices->find()->where(['id'=>(int)$_GET['id']])->first(); 
		if($data){
         	$modelPrices->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/zoomcheap-view-admin-price-listPriceAdmin.php');
}
?>