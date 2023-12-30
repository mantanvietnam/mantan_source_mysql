<?php 
function listZaloOAAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $modelOptions;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tài khoản Zalo OA';

	$modelZaloOas = $controller->loadModel('ZaloOas');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id_oa'])){
        $conditions['id_oa'] = trim($_GET['id_oa']);
    }

    if(!empty($_GET['id_app'])){
        $conditions['id_app'] = trim($_GET['id_app']);
    }
    
    $listData = $modelZaloOas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelZaloOas->find()->where($conditions)->all()->toList();
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

    $money_zalo_zns = $modelOptions->find()->where(['key_word' => 'money_zalo_zns'])->first();
    $money_zalo_zns = (int) @$money_zalo_zns->value;

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('money_zalo_zns', $money_zalo_zns);
}

function addZaloOAAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Thông tin Zalo OA';

	$modelZaloOas = $controller->loadModel('ZaloOas');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelZaloOas->get( (int) $_GET['id']);
    }else{
        $data = $modelZaloOas->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id_oa']) && !empty($dataSend['id_app']) && !empty($dataSend['secret_key'])){
            
	        // tạo dữ liệu save
	        $data->id_oa = trim($dataSend['id_oa']);
	        $data->id_app = trim($dataSend['id_app']);
	        $data->secret_key = trim($dataSend['secret_key']);

	        $modelZaloOas->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đủ dữ liệu</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteZaloOAAdmin($input){
	global $controller;

	$modelZaloOas = $controller->loadModel('ZaloOas');
	
	if(!empty($_GET['id'])){
		$data = $modelZaloOas->get($_GET['id']);
		
		if($data){
         	$modelZaloOas->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/zalo_zns-view-admin-listZaloOAAdmin');
}