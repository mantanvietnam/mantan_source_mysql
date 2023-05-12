<?php 
function listCustomer($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách khách hàng';

	    $modelMembers = $controller->loadModel('Members');
		$modelProducts = $controller->loadModel('Products');
		$modelOrders = $controller->loadModel('Orders');
		$user = $session->read('infoUser');

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		$conditions['type'] = 3;
		$conditions['member_id']= $user->id;

		$totalData = $modelOrders->find()->where($conditions)->all()->toList();
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


	    $listOrders = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		$listData = array();
		if(!empty($listOrders)){
			foreach($listOrders as $item){
				$data = $modelOrders->find()->where(array('type'=> 0,'id'=>$item->id-1 ))->first();
				$listData[] = $modelMembers->find()->where(array('id'=>$data->member_id ))->first();
				
			}
		}
		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);

	}else{
		return $controller->redirect('/login');
	}
}


 ?>