<?php 
function sellProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Bán hàng';

	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');
	    $modelProducts = $controller->loadModel('Products');

	    $listData = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'amount >'=>0])->all()->toList();

	    $listProduct = [];

	    if(!empty($listData)){
	    	foreach ($listData as $key => $value) {
	    		$listProduct[$value->product_id] = $modelProducts->find()->where(['id'=>$value->product_id])->first();
	    	}
	    }

	    setVariable('listData', $listData);
	    setVariable('listProduct', $listProduct);
	}else{
		return $controller->redirect('/login');
	}
}

function addToCartUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Bán hàng';

	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();

	    	if(!empty($dataSend['product_id'])){
	    		$infoProductAgency = $modelAgencyProducts->find()->where(['product_id'=>(int) $dataSend['product_id'], 'agency_id'=>$session->read('infoUser')->id])->first();
	    		$infoProduct = $modelProducts->find()->where(['id'=>(int) $dataSend['product_id']])->first();

	    		if(!empty($infoProduct) && !empty($infoProductAgency)){
	    			$cartUser = $session->read('cartUser');
	    			$infoProduct->price = $infoProductAgency->price;

	    			if(empty($cartUser)) $cartUser = [];

	    			if(empty($cartUser[$infoProduct->id])){
	    				$infoProduct->amount_sell = 1;
	    				$cartUser[$infoProduct->id] = $infoProduct;
	    			}else{
	    				$cartUser[$infoProduct->id]->amount_sell ++;
	    			}

	    			$session->write('cartUser', $cartUser);

	    			return ['code'=>1];
	    		}
	    	}
	    }
	}

	return ['code'=>0];
}

function userCart($input)
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
	    	if($_GET['status'] == 'create_order_done'){
	    		$mess= '<p class="text-success">Tạo đơn thành công</p>';
	    	}
	    }

	    $infoCart = $session->read('cartUser');

	    setVariable('infoCart', $infoCart);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function createOrderUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
		$metaTitleMantan = 'Giỏ hàng';

	    $infoCart = $session->read('cartUser');

	    if(!empty($infoCart)){
	    	$modelUserOrders = $controller->loadModel('UserOrders');
	    	$modelUserOrderDetails = $controller->loadModel('UserOrderDetails');

	    	$total_price = 0;
	    	foreach ($infoCart as $key => $value) {
	    		$total_price += $value->price * $value->amount_sell;
	    	}

	    	$order = $modelUserOrders->newEmptyEntity();

	    	$order->user_id = 0;
	    	$order->agency_id = $session->read('infoUser')->id;
	    	$order->total_price  = $total_price;
	    	$order->status = 0; // 0: đơn hàng mới, 2: đã thanh toán, 3: hủy bỏ
	    	$order->created_at  = date('Y-m-d H:i:s');
	    	$order->updated_at  = date('Y-m-d H:i:s');
	    	
	    	$modelUserOrders->save($order);

	    	foreach ($infoCart as $key => $value) {
	    		$orderDetail = $modelUserOrderDetails->newEmptyEntity();

	    		$orderDetail->order_id = $order->id;
	    		$orderDetail->product_id = $value->id;
	    		$orderDetail->amount = $value->amount_sell;
	    		$orderDetail->unit_price = $value->price;
	    		$orderDetail->created_at = date('Y-m-d H:i:s');
	    		$orderDetail->updated_at = date('Y-m-d H:i:s');

	    		$modelUserOrderDetails->save($orderDetail);
	    	}
	    }

	    $session->write('cartUser', []);

	    return $controller->redirect('/userCart/?status=create_order_done');
	}else{
		return $controller->redirect('/login');
	}
}