<?php 
function orderProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Lịch sử bán sản phẩm';

		$modelMembers = $controller->loadModel('Members');
		$modelProducts = $controller->loadModel('Products');
		$modelOrders = $controller->loadModel('Orders');

		$user = $session->read('infoUser');
		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		//if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
		//if(!isset($_GET['status'])) $_GET['status'] = 1;

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['type'])){
			$conditions['type'] = $_GET['type'];
		}

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = $_GET['status'];
			}
		}
		
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


	    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $conditions = array('type'=>'product_categories');
		$order = array('name'=>'asc');
		$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('listCategory', $listCategory);
	}else{
		return $controller->redirect('/login');
	}
}


function detailOrder($input)
{
	global $controller;
	global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;

	$modelProducts = $controller->loadModel('Products');
	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');

	$mess = '';
	$infoProduct = null;
	$infoMember = null;
	$orderProduct;
	if(!empty($_GET['id'])){
        $orderProduct = $modelOrders->get( (int) $_GET['id']);
		$infoMember = $modelMembers->find()->where(['id' => $orderProduct['member_id']])->first();
		if(!empty($orderProduct['product_id'])) {
			$infoProduct = $modelProducts->find()->where(['product_id' => $orderProduct['product_id']])->first();
		} else {
			$mess = 'Không có thông tin sản phẩm!';
		}
    }else{
        $orderProduct = $modelOrders->newEmptyEntity();
    }

	setVariable('orderProduct', $orderProduct);
	setVariable('infoProduct', $infoProduct);
	setVariable('infoMember', $infoMember);
	setVariable('mess', $mess);
}
?>