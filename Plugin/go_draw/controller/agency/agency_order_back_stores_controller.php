<?php
function addToCartBackStore($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Trả hàng';

	    if(empty($session->read('isAgencyBoss'))){
			return $controller->redirect('/checkBoos');
		}

	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();

	    	if(!empty($dataSend['product_id'])){
	    		if(empty($dataSend['amount'])) $dataSend['amount'] = 1;

	    		$infoProductAgency = $modelAgencyProducts->find()->where(['product_id'=>(int) $dataSend['product_id'], 'agency_id'=>$session->read('infoUser')->id])->first();
	    		$infoProduct = $modelProducts->find()->where(['id'=>(int) $dataSend['product_id']])->first();

	    		if(!empty($infoProduct) && !empty($infoProductAgency)){
	    			$cartUser = $session->read('cartBackStore');
	    			$infoProduct->price = $infoProductAgency->price;

	    			if(empty($cartUser)) $cartUser = [];

	    			if(empty($cartUser[$infoProduct->id])){
	    				$infoProduct->amount_sell = $dataSend['amount'];
	    				$cartUser[$infoProduct->id] = $infoProduct;
	    			}else{
	    				$cartUser[$infoProduct->id]->amount_sell += $dataSend['amount'];
	    			}

	    			$session->write('cartBackStore', $cartUser);

	    			return $controller->redirect('/agencyCartBackStore');
	    		}else{
					return $controller->redirect('/warehouse');
				}
	    	}else{
				return $controller->redirect('/warehouse');
			}
	    }else{
			return $controller->redirect('/warehouse');
		}
	}else{
		return $controller->redirect('/login');
	}
}

function agencyCartBackStore($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Giỏ hàng';
	    $mess = '';

	    if(!empty($_GET['status'])){
	    	if($_GET['status'] == 'create_back_store_done'){
	    		$mess= '<p class="text-success">Tạo yêu cầu trả hàng thành công</p>';
	    	}
	    }

	    $infoCart = $session->read('cartBackStore');

	    setVariable('infoCart', $infoCart);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function createOrderBackStore($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
		$metaTitleMantan = 'Giỏ hàng';

	    $infoCart = $session->read('cartBackStore');

	    if(!empty($infoCart)){
	    	$modelAgencyOrderBackStores = $controller->loadModel('AgencyOrderBackStores');
	    	$modelAgencyOrderBackStoreDetails = $controller->loadModel('AgencyOrderBackStoreDetails');
	    	$modelAgencyOrderBackStoreHistories = $controller->loadModel('AgencyOrderBackStoreHistories');
	    	$modelAgencyProducts = $controller->loadModel('AgencyProducts');

	    	$total_price = 0;
	    	foreach ($infoCart as $key => $value) {
	    		$total_price += $value->price * $value->amount_sell;
	    	}

	    	// tạo đơn hàng mới
	    	$order = $modelAgencyOrderBackStores->newEmptyEntity();

	    	$order->agency_id = $session->read('infoUser')->id;
	    	$order->total_price  = $total_price;
	    	$order->status = 0; // 0: yêu cầu mới, 2: đã xử lý, 3: hủy bỏ 
	    	$order->created_at  = date('Y-m-d H:i:s');
	    	$order->updated_at  = date('Y-m-d H:i:s');
	    	
	    	$modelAgencyOrderBackStores->save($order);

	    	foreach ($infoCart as $key => $value) {
	    		$orderDetail = $modelAgencyOrderBackStoreDetails->newEmptyEntity();

	    		$orderDetail->order_id = $order->id;
	    		$orderDetail->product_id = $value->id;
	    		$orderDetail->amount = (int) $value->amount_sell;
	    		$orderDetail->price = $value->price;
	    		$orderDetail->created_at = date('Y-m-d H:i:s');
	    		$orderDetail->updated_at = date('Y-m-d H:i:s');

	    		$modelAgencyOrderBackStoreDetails->save($orderDetail);

	    		// trừ hàng hóa trong kho
	    		$infoProduct = $modelAgencyProducts->find()->where(['agency_id'=>(int) $session->read('infoUser')->id, 'product_id'=>$value->id])->first();

	    		if(!empty($infoProduct)){
		    		$infoProduct->amount -= (int) $value->amount_sell;

		    		$modelAgencyProducts->save($infoProduct);
		    	}
	    	}

	    	// lưu lịch sử tạo đơn
	    	$orderHistory = $modelAgencyOrderBackStoreHistories->newEmptyEntity();

	    	$orderHistory->agency_id = $session->read('infoUser')->id;
	    	$orderHistory->order_id = $order->id;
	    	$orderHistory->note = 'Yêu cầu trả lại hàng cho hệ thống';
	    	$orderHistory->created_at = date('Y-m-d H:i:s');
	    	$orderHistory->status = $order->status;

	    	$modelAgencyOrderBackStoreHistories->save($orderHistory);
	    }

	    $session->write('cartBackStore', []);

	    return $controller->redirect('/agencyCartBackStore/?status=create_back_store_done');
	}else{
		return $controller->redirect('/login');
	}
}

function orderBackStore($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn trả hàng đang xử lý';

		$modelAgencyOrderBackStores = $controller->loadModel('AgencyOrderBackStores');
    	$modelAgencyOrderBackStoreDetails = $controller->loadModel('AgencyOrderBackStoreDetails');
    	$modelAgencyOrderBackStoreHistories = $controller->loadModel('AgencyOrderBackStoreHistories');
    	$modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>0, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrderBackStores->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelAgencyOrderBackStoreDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}
			}
		}

		$totalData = $modelAgencyOrderBackStores->find()->where($conditions)->all()->toList();

	    
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
		return $controller->redirect('/login');
	}
}

function orderBackStoreDone($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn trả hàng đang xử lý';

		$modelAgencyOrderBackStores = $controller->loadModel('AgencyOrderBackStores');
    	$modelAgencyOrderBackStoreDetails = $controller->loadModel('AgencyOrderBackStoreDetails');
    	$modelAgencyOrderBackStoreHistories = $controller->loadModel('AgencyOrderBackStoreHistories');
    	$modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>2, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrderBackStores->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelAgencyOrderBackStoreDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}
			}
		}

		$totalData = $modelAgencyOrderBackStores->find()->where($conditions)->all()->toList();

	    
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
		return $controller->redirect('/login');
	}
}
