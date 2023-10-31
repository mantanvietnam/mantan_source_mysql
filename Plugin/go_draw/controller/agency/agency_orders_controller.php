<?php
function addToCart($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser')) && $session->read('infoUser')->type == 1){
	    $metaTitleMantan = 'Thêm vào giỏ hàng';

	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');
	    $modelProducts = $controller->loadModel('Products');

	    if(!empty($_GET['idCombo'])){
	    	$infoCombo = $modelCombos->find()->where(['id'=>(int) $_GET['idCombo']])->first();

	    	if(!empty($infoCombo)){
	    		$list_products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

				$list_product = [];

				foreach ($list_products as $key => $value) {
					$infoProduct = $modelProducts->find()->where(['id'=>$value->product_id, 'status'=>1])->first();

					if(!empty($infoProduct)){
						$infoProduct->amount_combo = $value->amount;
						$list_product[] = $infoProduct;
					}
				}

				$infoCombo->list_product = $list_product;

				$infoCart = $session->read('infoCart');
				if(empty($infoCart)) $infoCart = [];

				if(empty($infoCart[$infoCombo->id])){
					$infoCombo->amount = 1;
					$infoCart[$infoCombo->id] = $infoCombo;
				}else{
					$infoCart[$infoCombo->id]->amount ++;
				}

				$session->write('infoCart', $infoCart);

				return $controller->redirect('/cart');
	    	}else{
		    	return $controller->redirect('/listCombo');
		    }
	    }else{
	    	return $controller->redirect('/listCombo');
	    }

	}else{
		return $controller->redirect('/login');
	}
}

function cart($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser')) && $session->read('infoUser')->type == 1){
	    $metaTitleMantan = 'Giỏ hàng';
	    $mess = '';

	    if(!empty($_GET['status'])){
	    	if($_GET['status'] == 'create_order_done'){
	    		$mess= '<p class="text-success">Đặt hàng thành công</p>';
	    	}
	    }

	    $infoCart = $session->read('infoCart');

	    setVariable('infoCart', $infoCart);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function createOrder($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser')) && $session->read('infoUser')->type == 1){
	    $metaTitleMantan = 'Giỏ hàng';

	    $infoCart = $session->read('infoCart');

	    if(!empty($infoCart)){
	    	$modelAgencyOrders = $controller->loadModel('AgencyOrders');
	    	$modelAgencyOrderDetails = $controller->loadModel('AgencyOrderDetails');

	    	$total_price = 0;
	    	foreach ($infoCart as $key => $value) {
	    		$total_price += $value->price * $value->amount;
	    	}

	    	$order = $modelAgencyOrders->newEmptyEntity();

	    	$order->agency_id = $session->read('infoUser')->id;
	    	$order->status = 0; // 0: đơn hàng mới, 1: đã duyệt, 2: đã thanh toán, 3: hủy bỏ
	    	$order->created_at  = date('Y-m-d H:i:s');
	    	$order->updated_at  = date('Y-m-d H:i:s');
	    	$order->total_price  = $total_price;

	    	$modelAgencyOrders->save($order);

	    	foreach ($infoCart as $key => $value) {
	    		$orderDetail = $modelAgencyOrderDetails->newEmptyEntity();

	    		$orderDetail->order_id = $order->id;
	    		$orderDetail->combo_id = $value->id;
	    		$orderDetail->amount = $value->amount;
	    		$orderDetail->unit_price = $value->price;
	    		$orderDetail->created_at = date('Y-m-d H:i:s');
	    		$orderDetail->updated_at = date('Y-m-d H:i:s');

	    		$modelAgencyOrderDetails->save($orderDetail);
	    	}
	    }

	    $session->write('infoCart', []);

	    return $controller->redirect('/cart/?status=create_order_done');
	}else{
		return $controller->redirect('/login');
	}
}

function orderAgencyProcess($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn hàng mua chưa thanh toán';

		$modelAgencyOrders = $controller->loadModel('AgencyOrders');
	    $modelAgencyOrderDetails = $controller->loadModel('AgencyOrderDetails');
	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');
	    $modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>1, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->combos = $modelAgencyOrderDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->combos)){
					foreach ($listData[$key]->combos as $keyCombo=>$combo) {
						$infoCombo = $modelCombos->find()->where(['id'=>$combo->combo_id])->first();

						if(!empty($infoCombo)){
							$listData[$key]->combos[$keyCombo]->name = $infoCombo->name;

							$listData[$key]->combos[$keyCombo]->products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

							if(!empty($listData[$key]->combos[$keyCombo]->products)){
								foreach ($listData[$key]->combos[$keyCombo]->products as $keyProduct => $product) {
									$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

									if(!empty($infoProduct)){
										$listData[$key]->combos[$keyCombo]->products[$keyProduct]->name = $infoProduct->name;
									}
								}
							}
						}
					}
				}
			}
		}

		$totalData = $modelAgencyOrders->find()->where($conditions)->all()->toList();

	    
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

function orderAgencyDone($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn hàng mua đã thanh toán';

		$modelAgencyOrders = $controller->loadModel('AgencyOrders');
	    $modelAgencyOrderDetails = $controller->loadModel('AgencyOrderDetails');
	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');
	    $modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>2, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->combos = $modelAgencyOrderDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->combos)){
					foreach ($listData[$key]->combos as $keyCombo=>$combo) {
						$infoCombo = $modelCombos->find()->where(['id'=>$combo->combo_id])->first();

						if(!empty($infoCombo)){
							$listData[$key]->combos[$keyCombo]->name = $infoCombo->name;

							$listData[$key]->combos[$keyCombo]->products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

							if(!empty($listData[$key]->combos[$keyCombo]->products)){
								foreach ($listData[$key]->combos[$keyCombo]->products as $keyProduct => $product) {
									$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

									if(!empty($infoProduct)){
										$listData[$key]->combos[$keyCombo]->products[$keyProduct]->name = $infoProduct->name;
									}
								}
							}
						}
					}
				}
			}
		}

		$totalData = $modelAgencyOrders->find()->where($conditions)->all()->toList();

	    
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
?>