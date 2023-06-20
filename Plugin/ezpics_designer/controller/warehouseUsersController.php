<?php 
function listWarehouseUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách khách hàng mua kho mẫu thiết kế';

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');

		$user = $session->read('infoUser');

		$conditions = [];
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['warehouses_id'])){
			$conditions['warehouses_id'] = (int) $_GET['warehouses_id'];
		}

		if(!empty($_GET['user_id'])){
			$conditions['user_id'] = (int) $_GET['user_id'];
		}


	    $listData = $modelWarehouseUsers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelWarehouseUsers->find()->where($conditions)->all()->toList();
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

	    $conditions = array('user_id'=>$user->id);
		$order = array('name'=>'asc');
		$listWarehouse = $modelWarehouses->find()->where($conditions)->order($order)->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('listWarehouse', $listWarehouse);
	}else{
		return $controller->redirect('/login');
	}
}