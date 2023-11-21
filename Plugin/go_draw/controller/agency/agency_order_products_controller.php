<?php
function addToCartProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Mua lẻ hàng';

	    $modelProducts = $controller->loadModel('Products');

    	if(!empty($_GET['id'])){
    		$infoProduct = $modelProducts->find()->where(['id'=>(int) $_GET['id'], 'status'=>1])->first();

    		if(!empty($infoProduct)){
    			$cartUser = $session->read('cartAgencyProduct');

    			if(empty($cartUser)) $cartUser = [];
    			if(empty($_GET['amount'])) $_GET['amount'] = 1;

    			if(empty($cartUser[$infoProduct->id])){
    				$infoProduct->amount_sell = (int) $_GET['amount'];
    				$cartUser[$infoProduct->id] = $infoProduct;
    			}else{
    				$cartUser[$infoProduct->id]->amount_sell += (int) $_GET['amount'];
    			}

    			$session->write('cartAgencyProduct', $cartUser);

    			return $controller->redirect('/cartAgencyProduct');
    		}else{
    			return $controller->redirect('/listProduct');
    		}
    	}else{
    		return $controller->redirect('/listProduct');
    	}
	    
	}else{
		return $controller->redirect('/login');
	}
}

function cartAgencyProduct($input)
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
	    	if($_GET['status'] == 'create_agency_product_done'){
	    		$mess= '<p class="text-success">Tạo yêu cầu mua hàng thành công</p>';
	    	}
	    }

	    $infoCart = $session->read('cartAgencyProduct');

	    setVariable('infoCart', $infoCart);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function createOrderAgencyProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
		$metaTitleMantan = 'Giỏ hàng';

	    $infoCart = $session->read('cartAgencyProduct');

	    if(!empty($infoCart)){
	    	$modelAgencyOrderProducts = $controller->loadModel('AgencyOrderProducts');
	    	$modelAgencyOrderProductDetails = $controller->loadModel('AgencyOrderProductDetails');
	    	$modelAgencyOrderProductHistories = $controller->loadModel('AgencyOrderProductHistories');
	    	$modelAgencyProducts = $controller->loadModel('AgencyProducts');

	    	$total_price = 0;
	    	foreach ($infoCart as $key => $value) {
	    		$total_price += $value->price * $value->amount_sell;
	    	}

	    	// tạo đơn hàng mới
	    	$order = $modelAgencyOrderProducts->newEmptyEntity();

	    	$order->agency_id = $session->read('infoUser')->id;
	    	$order->total_price  = $total_price;
	    	$order->status = 0; // 0: đơn hàng mới, 1: đã duyệt xuất kho, 2: đã nhập kho, 3: đã thanh toán, 4: hủy bỏ 
	    	$order->created_at  = date('Y-m-d H:i:s');
	    	$order->updated_at  = date('Y-m-d H:i:s');
	    	
	    	$modelAgencyOrderProducts->save($order);

	    	foreach ($infoCart as $key => $value) {
	    		$orderDetail = $modelAgencyOrderProductDetails->newEmptyEntity();

	    		$orderDetail->order_id = $order->id;
	    		$orderDetail->product_id = $value->id;
	    		$orderDetail->amount = (int) $value->amount_sell;
	    		$orderDetail->price = $value->price;
	    		$orderDetail->created_at = date('Y-m-d H:i:s');
	    		$orderDetail->updated_at = date('Y-m-d H:i:s');

	    		$modelAgencyOrderProductDetails->save($orderDetail);
	    	}

	    	// lưu lịch sử tạo đơn
	    	$orderHistory = $modelAgencyOrderProductHistories->newEmptyEntity();

	    	$orderHistory->agency_id = $session->read('infoUser')->id;
	    	$orderHistory->order_id = $order->id;
	    	$orderHistory->note = 'Yêu cầu mua lẻ hàng hóa';
	    	$orderHistory->created_at = date('Y-m-d H:i:s');
	    	$orderHistory->status = $order->status;

	    	$modelAgencyOrderProductHistories->save($orderHistory);
	    }

	    $session->write('cartAgencyProduct', []);

	    return $controller->redirect('/cartAgencyProduct/?status=create_agency_product_done');
	}else{
		return $controller->redirect('/login');
	}
}

function orderProductWait($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn mua lẻ hàng đang xử lý';

		$modelAgencyOrderProducts = $controller->loadModel('AgencyOrderProducts');
    	$modelAgencyOrderProductDetails = $controller->loadModel('AgencyOrderProductDetails');
    	$modelAgencyOrderProductHistories = $controller->loadModel('AgencyOrderProductHistories');
    	$modelAgencyProducts = $controller->loadModel('AgencyProducts');
    	$modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>0, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrderProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelAgencyOrderProductDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}
			}
		}

		$totalData = $modelAgencyOrderProducts->find()->where($conditions)->all()->toList();

	    
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

function orderProductProcess($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn mua lẻ hàng đang xử lý';

		$modelAgencyOrderProducts = $controller->loadModel('AgencyOrderProducts');
    	$modelAgencyOrderProductDetails = $controller->loadModel('AgencyOrderProductDetails');
    	$modelAgencyOrderProductHistories = $controller->loadModel('AgencyOrderProductHistories');
    	$modelAgencyProducts = $controller->loadModel('AgencyProducts');
    	$modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('agency_id'=>$user->id);
		$conditions['OR'] = [['status' => 1], ['status' => 2]];

		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrderProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelAgencyOrderProductDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}
			}
		}

		$totalData = $modelAgencyOrderProducts->find()->where($conditions)->all()->toList();

	    
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

function orderProductDone($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn mua lẻ hàng đã xử lý';

		$modelAgencyOrderProducts = $controller->loadModel('AgencyOrderProducts');
    	$modelAgencyOrderProductDetails = $controller->loadModel('AgencyOrderProductDetails');
    	$modelAgencyOrderProductHistories = $controller->loadModel('AgencyOrderProductHistories');
    	$modelAgencyProducts = $controller->loadModel('AgencyProducts');
    	$modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>3, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyOrderProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelAgencyOrderProductDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}
			}
		}

		$totalData = $modelAgencyOrderProducts->find()->where($conditions)->all()->toList();

	    
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

function addProductToStore($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Nhập hàng vào kho';

	    $modelAgencyOrderProducts = $controller->loadModel('AgencyOrderProducts');
    	$modelAgencyOrderProductDetails = $controller->loadModel('AgencyOrderProductDetails');
    	$modelAgencyOrderProductHistories = $controller->loadModel('AgencyOrderProductHistories');
	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');
	    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
		
		$user = $session->read('infoUser');

		if(!empty($_GET['id'])){
			$order = $modelAgencyOrderProducts->find()->where(['id' => $_GET['id'], 'agency_id'=>$user->id])->first();

			if(!empty($order) && $order->status==1){
	            $order->status = 2; // 0: đơn hàng mới, 1: đã duyệt xuất kho, 2: đã nhập kho, 3: đã thanh toán, 4: hủy bỏ
	            $order->updated_at = date('Y-m-d H:i:s');

	            $modelAgencyOrderProducts->save($order);

	            // lưu lịch sử thay đổi trạng thái đơn hàng
	            $orderHistory = $modelAgencyOrderProductHistories->newEmptyEntity();

	            $orderHistory->agency_id = $order->agency_id;
	            $orderHistory->order_id = $order->id;
	            $orderHistory->note = 'Đại lý đã xác nhận nhập hàng mua lẻ vào kho';
	            $orderHistory->created_at = date('Y-m-d H:i:s');
	            $orderHistory->status = $order->status;

	            $modelAgencyOrderProductHistories->save($orderHistory);

	            // cộng hàng vào kho
				$listItem = $modelAgencyOrderProductDetails->find()->where(['order_id' => $order->id])->all();

	           	if (!empty($listItem)) {
	               	$listAgencyProduct = [];

	               	foreach ($listItem as $item) {
	                   	// thêm sản phẩm vào kho của đại lý
                       	$checkProduct = $modelAgencyProducts->find()->where([
				                           'agency_id' => $order->agency_id,
				                           'product_id' => $item->product_id
				                       	])->first();

                       	if (empty($checkProduct)) {
                           $checkProduct = $modelAgencyProducts->newEmptyEntity();

                           $checkProduct->amount = 0;
                       	}

                       	$checkProduct->agency_id = $order->agency_id;
                       	$checkProduct->product_id = $item->product_id;
                       	$checkProduct->price = $item->price;
                       	$checkProduct->amount += $item->amount;

                       	$listAgencyProduct[] = $checkProduct;

                       	// trừ hàng trong kho admin
                       	$info_product = $modelProducts->get($item->product_id);
			            $info_product->amount_in_stock -= $item->amount;

			            $modelProducts->save($info_product);

			            // tạo phiếu xuất kho
			            $warehouse = $modelWarehouseHistories->newEmptyEntity();

			            $warehouse->product_id = (int) $item->product_id;
			            $warehouse->amount = (int) $item->amount;
			            $warehouse->total_price = $item->amount*$item->price;
			            $warehouse->price_average = $item->price;
			            $warehouse->note = 'Xuất sản phẩm '.$info_product->name.' về kho của đại lý '.$session->read('infoUser')->phone;
			            $warehouse->updated_at = date('Y-m-d H:i:s');
			            $warehouse->type = 'minus';

			            $modelWarehouseHistories->save($warehouse);
	                   
	               	}

	               	$modelAgencyProducts->saveMany($listAgencyProduct);

	               	return $controller->redirect('/orderProductProcess');
	           	}
	        }else{
	        	return $controller->redirect('/orderProductProcess');
	        }
        }else{
        	return $controller->redirect('/orderProductProcess');
        }
	}else{
		return $controller->redirect('/login');
	}
}