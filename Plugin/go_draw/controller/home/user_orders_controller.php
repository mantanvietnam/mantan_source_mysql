<?php
function myOrder($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoMember'))){
	    $metaTitleMantan = 'Đơn hàng của bạn';

		$modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoMember');

		$conditions = array('status'=>2, 'user_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelUserOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelUserOrderDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}
			}
		}

		$totalData = $modelUserOrders->find()->where($conditions)->all()->toList();

	    
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
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/');
	}
}