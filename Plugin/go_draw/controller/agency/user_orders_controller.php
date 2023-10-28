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

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();

	    	if(!empty($dataSend['product_id'])){
	    		$infoProduct = $modelProducts->find()->where(['id'=>(int) $dataSend['product_id']])->first();

	    		if(!empty($infoProduct)){
	    			$cartUser = $session->read('cartUser');

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
	
}