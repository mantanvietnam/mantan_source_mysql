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
	    	$modelAgencyProducts = $controller->loadModel('AgencyProducts');
	    	$modelUserOrderHistories = $controller->loadModel('UserOrderHistories');
	    	$modelUsers = $controller->loadModel('Users');

	    	$total_price = 0;
	    	foreach ($infoCart as $key => $value) {
	    		$total_price += $value->price * $value->amount_sell;
	    	}

	    	$user_id = 0;
	    	if(!empty($_GET['phone'])){
	    		$_GET['phone']= str_replace(array(' ','.','-'), '', @$_GET['phone']);
				$_GET['phone'] = str_replace('+84','0',$_GET['phone']);

				$checkPhone = $modelUsers->find()->where(array('username'=>$_GET['phone']))->first();

				if(!empty($checkPhone)){
					$user_id = $checkPhone->id;
				}
	    	}

	    	// tạo đơn hàng mới
	    	$order = $modelUserOrders->newEmptyEntity();

	    	$order->user_id = $user_id;
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
	    		$orderDetail->amount = (int) $value->amount_sell;
	    		$orderDetail->unit_price = $value->price;
	    		$orderDetail->created_at = date('Y-m-d H:i:s');
	    		$orderDetail->updated_at = date('Y-m-d H:i:s');

	    		$modelUserOrderDetails->save($orderDetail);

	    		// trừ hàng hóa trong kho
	    		$infoProduct = $modelAgencyProducts->find()->where(['agency_id'=>(int) $session->read('infoUser')->id, 'product_id'=>$value->id])->first();

	    		if(!empty($infoProduct)){
		    		$infoProduct->amount -= (int) $value->amount_sell;

		    		$modelAgencyProducts->save($infoProduct);
		    	}
	    	}

	    	// lưu lịch sử tạo đơn
	    	$orderHistory = $modelUserOrderHistories->newEmptyEntity();

	    	$orderHistory->agency_id = $session->read('infoUser')->id;
	    	$orderHistory->order_id = $order->id;
	    	$orderHistory->note = 'Bán lẻ vật tư cho khách hàng';
	    	$orderHistory->created_at = date('Y-m-d H:i:s');
	    	$orderHistory->status = $order->status;

	    	$modelUserOrderHistories->save($orderHistory);
	    }

	    $session->write('cartUser', []);

	    return $controller->redirect('/userCart/?status=create_order_done');
	}else{
		return $controller->redirect('/login');
	}
}

function orderUserProcess($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn hàng đang xử lý';

		$modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>0, 'agency_id'=>$user->id);
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
		return $controller->redirect('/login');
	}
}

function processUserOrder($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thanh toán đơn hàng';

	    $modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');

	    if(!empty($_GET['id'])){
	    	$infoOrder = $modelUserOrders->find()->where(['id'=>(int) $_GET['id'], 'agency_id'=>(int) $session->read('infoUser')->id])->first();

	    	if(!empty($infoOrder)){
	    		$infoOrder->product = $modelUserOrderDetails->find()->where(['order_id'=>$infoOrder->id])->all()->toList();

	    		if(!empty($infoOrder->product)){
					foreach ($infoOrder->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$infoOrder->product[$keyProduct]->name = @$infoProduct->name;
						$infoOrder->product[$keyProduct]->image = @$infoProduct->image;
						$infoOrder->product[$keyProduct]->type = @$infoProduct->type;
					}
				}else{
					return $controller->redirect('/orderUserProcess/?status=orderEmptyProduct');
				}
	    	}else{
	    		return $controller->redirect('/orderUserProcess/?status=orderEmpty');
	    	}

	    	setVariable('infoOrder', $infoOrder);
	    }else{
	    	return $controller->redirect('/orderUserProcess');
	    }
	}else{
		return $controller->redirect('/login');
	}
}

function checkoutOrderUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thanh toán đơn hàng';

	    $modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');
	    $modelUserOrderHistories = $controller->loadModel('UserOrderHistories');

	    if(!empty($_GET['id'])){
	    	$infoOrder = $modelUserOrders->find()->where(['id'=>(int) $_GET['id'], 'agency_id'=>(int) $session->read('infoUser')->id])->first();

	    	if(!empty($infoOrder)){
	    		// cập nhập lại trạng thái đơn hàng
	    		$infoOrder->status = 2;
	    		$infoOrder->updated_at = date('Y-m-d H:i:s');
	    		$modelUserOrders->save($infoOrder);

	    		// hoàn lại sản phẩm
	    		$infoOrder->product = $modelUserOrderDetails->find()->where(['order_id'=>$infoOrder->id])->all()->toList();

	    		if(!empty($infoOrder->product)){
					foreach ($infoOrder->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						// nếu là sản phẩm tái sử dụng
						if($infoProduct->type == 1){
							$product_agency = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'product_id'=>$product->product_id])->first();

							if(!empty($product_agency)){
								$product_agency->amount += $product->amount;
								$product_agency->updated_at = date('Y-m-d H:i:s');

								$modelAgencyProducts->save($product_agency);
							}
						}
					}
				}

				// lưu lịch sử cập nhập đơn
		    	$orderHistory = $modelUserOrderHistories->newEmptyEntity();

		    	$orderHistory->agency_id = $session->read('infoUser')->id;
		    	$orderHistory->order_id = $infoOrder->id;
		    	$orderHistory->note = 'Hoàn thành đơn bán lẻ vật tư cho khách hàng';
		    	$orderHistory->created_at = date('Y-m-d H:i:s');
		    	$orderHistory->status = $infoOrder->status;

		    	$modelUserOrderHistories->save($orderHistory);

				return $controller->redirect('/orderUserProcess/?status=checkoutOrderDone');
	    	}else{
	    		return $controller->redirect('/orderUserProcess/?status=orderEmpty');
	    	}
	    }else{
	    	return $controller->redirect('/orderUserProcess');
	    }
	}else{
		return $controller->redirect('/login');
	}
}

function orderUserDone($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn hàng hoàn thành';

		$modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>2, 'agency_id'=>$user->id);
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
		return $controller->redirect('/login');
	}
}