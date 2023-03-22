<?php 
function listTargetCRM($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Mục tiêu thi đua';

	$modelTarget = $controller->loadModel('Targets');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id_compete'])){
        $conditions['id_compete'] = $_GET['id_compete'];
    }

    $listData = $modelTarget->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelTarget->find()->where($conditions)->all()->toList();
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

function addTargetCRM($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin mục tiêu thi đua';

	$modelCompete = $controller->loadModel('Competes');
    $modelTarget = $controller->loadModel('Targets');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelTarget->get( (int) $_GET['id']);
    }else{
        $data = $modelTarget->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
	        $data->description = $dataSend['description'];
            $data->point = $dataSend['point'];
            $data->status = $dataSend['status'];
            $data->id_compete = $dataSend['id_compete'];
            $data->type = $dataSend['type'];

	        $modelTarget->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên mục tiêu thi đua</p>';
	    }
    }

    $conditions = array();
    $listCompete = $modelCompete->find()->where($conditions)->all()->toList();


    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCompete', $listCompete);
}

function deleteTargetCRM($input){
	global $controller;

	$modelTarget = $controller->loadModel('Targets');
	
	if(!empty($_GET['id'])){
		$data = $modelTarget->get($_GET['id']);
		
		if($data){
         	$modelTarget->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_compete-view-admin-target-listTargetCRM.php');
}
?>