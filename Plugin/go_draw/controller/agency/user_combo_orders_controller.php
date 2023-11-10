<?php 
function sellComboProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Bán hàng';

		$modelAgencyCombos = $controller->loadModel('AgencyCombos');
	    $modelCombos = $controller->loadModel('Combos');
		
		$user = $session->read('infoUser');

		$conditions = ['agency_id'=>$user->id, 'amount >'=>0];
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelAgencyCombos->find()->where($conditions)->all()->toList();

	    $listCombo = [];

	    if(!empty($listData)){
	    	foreach ($listData as $key => $value) {
	    		$listCombo[$value->combo_id] = $modelCombos->find()->where(['id'=>$value->combo_id])->first();
	    	}
	    }

		$totalData = $modelAgencyCombos->find()->where($conditions)->all()->toList();
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
	    setVariable('listCombo', $listCombo);
	}else{
		return $controller->redirect('/login');
	}
}

function viewOrderCombo($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');
	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyCombos = $controller->loadModel('AgencyCombos');

		if(!empty($_GET['id'])){
			$agency_combo = $modelAgencyCombos->find()->where(['id'=>(int) $_GET['id'], 'agency_id'=>$session->read('infoUser')->id])->first();

			if(!empty($agency_combo)){

				$infoCombo = $modelCombos->find()->where(['id'=>(int) $agency_combo->combo_id])->first();

				if(!empty($infoCombo)){
					$metaTitleMantan = $infoCombo->name;

					$list_products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

					$list_product = [];

					foreach ($list_products as $key => $value) {
						$infoProduct = $modelProducts->find()->where(['id'=>$value->product_id, 'status'=>1])->first();

						if(!empty($infoProduct)){
							$infoProduct->amount_combo = $value->amount;
							$list_product[] = $infoProduct;
						}
					}

					setVariable('infoCombo', $infoCombo);
					setVariable('list_product', $list_product);
					setVariable('agency_combo', $agency_combo);
				}else{
					return $controller->redirect('/sellComboProduct');
				}
			}else{
				return $controller->redirect('/sellComboProduct');
			}
		}else{
			return $controller->redirect('/sellComboProduct');
		}
	}else{
		return $controller->redirect('/login');
	}
}

function addToCartComboUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thêm vào giỏ hàng';

	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');
	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyCombos = $controller->loadModel('AgencyCombos');

	    if(!empty($_GET['idAgencyCombo'])){
	    	$conditions = ['id'=>(int) $_GET['idAgencyCombo'], 'agency_id'=>$session->read('infoUser')->id];

	    	$agency_combo = $modelAgencyCombos->find()->where($conditions)->first();

			if(!empty($agency_combo)){
		    	$infoCombo = $modelCombos->find()->where(['id'=>(int) $agency_combo->combo_id])->first();

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

					$infoCart = $session->read('infoCartCombo');
					
					if(empty($infoCart)) $infoCart = [];
					if(empty($_GET['amount'])) $_GET['amount'] = 1;

					if(empty($infoCart[$infoCombo->id])){
						$infoCombo->amount = (int) $_GET['amount'];
						$infoCart[$infoCombo->id] = $infoCombo;
					}else{
						$infoCart[$infoCombo->id]->amount += (int) $_GET['amount'];
					}

					$session->write('infoCartCombo', $infoCart);

					return $controller->redirect('/userComboCart');
		    	}else{
			    	return $controller->redirect('/sellComboProduct/?status=emptyCombo');
			    }
			}else{
				return $controller->redirect('/sellComboProduct/?status=emptyAgencyCombo');
			}
	    }else{
	    	return $controller->redirect('/sellComboProduct/?status=emptyData');
	    }

	}else{
		return $controller->redirect('/login');
	}
}

function userComboCart($input)
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
	    	switch ($_GET['status']) {
	    		case 'create_order_combo_done':
	    			$mess= '<p class="text-success">Tạo đơn hàng thành công</p>';
	    			break;
	    		
	    		case 'errorAmountCombo':
	    			$mess= '<p class="text-danger">Trong kho không đủ số lượng combo để bán</p>';
	    			break;

	    		case 'errorAmountProduct':
	    			$mess= '<p class="text-danger">Trong kho không đủ số lượng vật tư để bán</p>';
	    			break;
	    	}
	    }

	    $infoCart = $session->read('infoCartCombo');

	    setVariable('infoCart', $infoCart);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function createOrderComboUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Giỏ hàng';

	    $infoCart = $session->read('infoCartCombo');

	    if(!empty($infoCart)){
	    	$modelCombos = $controller->loadModel('Combos');
		    $modelComboProducts = $controller->loadModel('ComboProducts');
		    $modelProducts = $controller->loadModel('Products');
		    $modelAgencyCombos = $controller->loadModel('AgencyCombos');
		    $modelUserOrderComboHistories = $controller->loadModel('UserOrderComboHistories');
		    $modelAgencyProducts = $controller->loadModel('AgencyProducts');
		    $modelUserComboOrders = $controller->loadModel('UserComboOrders');
		    $modelUserComboOrderDetails = $controller->loadModel('UserComboOrderDetails');


		    // kiểm tra hàng trong kho
		    $list_product = [];
		    $total_price = 0;

		    foreach ($infoCart as $key => $infoCombo) {
		    	$total_price += $infoCombo->price * $infoCombo->amount;

	    		$conditions = [	'combo_id' => (int) $infoCombo->id, 
	    						'agency_id' => $session->read('infoUser')->id, 
	    						'amount >=' => $infoCombo->amount
	    					];

	    		$agency_combo = $modelAgencyCombos->find()->where($conditions)->first();

	    		if(empty($agency_combo)){
	    			$session->write('infoCartCombo', []);

	    			return $controller->redirect('/userComboCart/?status=errorAmountCombo');
	    		}else{
		    		$list_products = $infoCombo->list_product;

					foreach ($list_products as $product) {
						if(empty($list_product[$product->id])){
							$list_product[$product->id] = 0;
						}

						$list_product[$product->id] += $product->amount_combo * $infoCombo->amount;
					}
	    		}
	    	}

	    	if(!empty($list_product)){
	    		foreach ($list_product as $product_id => $amount) {
	    			$check_product = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'product_id' => (int) $product_id, 'amount >=' => (int) $amount])->first();

	    			if(empty($check_product)){
	    				$session->write('infoCartCombo', []);

	    				return $controller->redirect('/userComboCart/?status=errorAmountProduct');
	    			}
	    		}
	    	}

	    	// tạo đơn hàng mới
	    	$order = $modelUserComboOrders->newEmptyEntity();

	    	$order->user_id = 0;
	    	$order->agency_id = $session->read('infoUser')->id;
	    	$order->total_price  = $total_price;
	    	$order->status = 0; // 0: đơn hàng mới, 2: đã thanh toán, 3: hủy bỏ
	    	$order->created_at  = date('Y-m-d H:i:s');
	    	$order->updated_at  = date('Y-m-d H:i:s');

	    	$modelUserComboOrders->save($order);

	    	// chi tiết đơn hàng mới
	    	foreach ($infoCart as $infoCombo) {
	    		$orderDetail = $modelUserComboOrderDetails->newEmptyEntity();

	    		$orderDetail->order_combo_id = $order->id;
	    		$orderDetail->combo_id = $infoCombo->id;
	    		$orderDetail->price = $infoCombo->price;
	    		$orderDetail->amount = $infoCombo->amount;
	    		$orderDetail->created_at = date('Y-m-d H:i:s');
	    		$orderDetail->updated_at = date('Y-m-d H:i:s');

	    		$modelUserComboOrderDetails->save($orderDetail);

	    		// trừ số lượng combo trong kho
	    		$conditions = [	'combo_id' => (int) $infoCombo->id, 
	    						'agency_id' => $session->read('infoUser')->id, 
	    						'amount >=' => $infoCombo->amount
	    					];

	    		$agency_combo = $modelAgencyCombos->find()->where($conditions)->first();
	    		$agency_combo->amount -= $infoCombo->amount;
	    		$modelAgencyCombos->save($agency_combo);
	    	}

	    	// lịch sử mua hàng
	    	$orderHistory = $modelUserOrderComboHistories->newEmptyEntity();

	    	$orderHistory->agency_id = $session->read('infoUser')->id;
	    	$orderHistory->order_combo_id = $order->id;
	    	$orderHistory->note = 'Bán combo cho khách hàng';
	    	$orderHistory->created_at = date('Y-m-d H:i:s');
	    	$orderHistory->status = $order->status;

	    	$modelUserOrderComboHistories->save($orderHistory);

	    	// trừ hàng hóa trong kho
	    	foreach ($list_product as $product_id => $amount) {
	    		$agency_product = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'product_id' => (int) $product_id, 'amount >=' => (int) $amount])->first();

	    		if(!empty($agency_product)){
	    			$agency_product->amount -= $amount;

	    			$modelAgencyProducts->save($agency_product);
	    		}
	    	}
	    }

	    $session->write('infoCartCombo', []);

	    return $controller->redirect('/userComboCart/?status=create_order_combo_done');
	}else{
		return $controller->redirect('/login');
	}
}

function orderUserComboProcess($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn hàng đang xử lý';

		$modelUserComboOrders = $controller->loadModel('UserComboOrders');
		$modelUserComboOrderDetails = $controller->loadModel('UserComboOrderDetails');
		$modelCombos = $controller->loadModel('Combos');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>0, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelUserComboOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->combo = $modelUserComboOrderDetails->find()->where(['order_combo_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->combo)){
					foreach ($listData[$key]->combo as $keyCombo=>$combo) {
						$infoCombo = $modelCombos->find()->where(['id'=>$combo->combo_id])->first();

						$listData[$key]->combo[$keyCombo]->name = @$infoCombo->name;
					}
				}
			}
		}

		$totalData = $modelUserComboOrders->find()->where($conditions)->all()->toList();

	    
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

function processUserComboOrder($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thanh toán đơn hàng';

	    $modelUserComboOrders = $controller->loadModel('UserComboOrders');
		$modelUserComboOrderDetails = $controller->loadModel('UserComboOrderDetails');
		$modelCombos = $controller->loadModel('Combos');
		$modelComboProducts = $controller->loadModel('ComboProducts');
		$modelProducts = $controller->loadModel('Products');

	    if(!empty($_GET['id'])){
	    	$infoOrder = $modelUserComboOrders->find()->where(['id'=>(int) $_GET['id'], 'agency_id'=>(int) $session->read('infoUser')->id])->first();

	    	if(!empty($infoOrder)){
	    		$infoOrder->combo = $modelUserComboOrderDetails->find()->where(['order_combo_id'=>$infoOrder->id])->all()->toList();

	    		if(!empty($infoOrder->combo)){
	    			foreach ($infoOrder->combo as $keyCombo=>$combo) {
			    		$infoOrder->combo[$keyCombo]->product = $modelComboProducts->find()->where(['combo_id'=>$combo->combo_id])->all()->toList();

			    		$infoOrder->combo[$keyCombo]->info = $modelCombos->find()->where(['id'=>$combo->combo_id])->first();

			    		if(!empty($infoOrder->combo[$keyCombo]->product)){
							foreach ($infoOrder->combo[$keyCombo]->product as $keyProduct=>$product) {
								$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

								$infoOrder->combo[$keyCombo]->product[$keyProduct]->name = @$infoProduct->name;
							}
						}else{
							return $controller->redirect('/orderUserComboProcess/?status=orderEmptyProduct');
						}
					}
				}else{
					return $controller->redirect('/orderUserComboProcess/?status=orderEmptyProduct');
				}
	    	}else{
	    		return $controller->redirect('/orderUserComboProcess/?status=orderEmpty');
	    	}

	    	setVariable('infoOrder', $infoOrder);
	    }else{
	    	return $controller->redirect('/orderUserComboProcess');
	    }
	}else{
		return $controller->redirect('/login');
	}
}

function checkoutOrderComboUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thanh toán đơn hàng';

	    $modelUserComboOrders = $controller->loadModel('UserComboOrders');
		$modelUserComboOrderDetails = $controller->loadModel('UserComboOrderDetails');
		$modelCombos = $controller->loadModel('Combos');
		$modelComboProducts = $controller->loadModel('ComboProducts');
		$modelProducts = $controller->loadModel('Products');
		$modelAgencyProducts = $controller->loadModel('AgencyProducts');
		$modelUserOrderComboHistories = $controller->loadModel('UserOrderComboHistories');

	    if(!empty($_GET['id'])){
	    	$infoOrder = $modelUserComboOrders->find()->where(['id'=>(int) $_GET['id'], 'agency_id'=>(int) $session->read('infoUser')->id])->first();

	    	if(!empty($infoOrder)){
	    		// cập nhập lại trạng thái đơn hàng
	    		$infoOrder->status = 2;
	    		$infoOrder->updated_at = date('Y-m-d H:i:s');
	    		$modelUserComboOrders->save($infoOrder);

	    		// hoàn lại sản phẩm
	    		$combo_detail = $modelUserComboOrderDetails->find()->where(['order_combo_id'=>$infoOrder->id])->all()->toList();

	    		if(!empty($combo_detail)){
	    			$list_product = [];

	    			foreach ($combo_detail as $detail_order) {

			    		$products = $modelComboProducts->find()->where(['combo_id'=>$detail_order->combo_id])->all()->toList();

			    		if(!empty($products)){
			    			foreach ($products as $combo) {
			    				if(empty($list_product[$combo->product_id])){
			    					$infoProduct = $modelProducts->find()->where(['id'=>$combo->product_id])->first();

			    					$list_product[$combo->product_id] = ['amount'=>0, 'type'=>$infoProduct->type];
			    				}

			    				$list_product[$combo->product_id]['amount'] += $detail_order->amount * $combo->amount;
							}
						}
					}

					
					if(!empty($list_product)){
						foreach ($list_product as $keyProduct => $product) {
							// nếu là sản phẩm tái sử dụng
							if($product['type'] == 1){
								$product_agency = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'product_id'=>$keyProduct])->first();

								if(!empty($product_agency)){
									$product_agency->amount += $product['amount'];
									$product_agency->updated_at = date('Y-m-d H:i:s');

									$modelAgencyProducts->save($product_agency);
								}
							}
						}
					}
				}

				// lịch sử mua hàng
		    	$orderHistory = $modelUserOrderComboHistories->newEmptyEntity();

		    	$orderHistory->agency_id = $session->read('infoUser')->id;
		    	$orderHistory->order_combo_id = $infoOrder->id;
		    	$orderHistory->note = 'Thanh toán combo cho khách hàng';
		    	$orderHistory->created_at = date('Y-m-d H:i:s');
		    	$orderHistory->status = $infoOrder->status;

		    	$modelUserOrderComboHistories->save($orderHistory);

				return $controller->redirect('/orderUserComboProcess/?status=checkoutOrderDone');
	    	}else{
	    		return $controller->redirect('/orderUserComboProcess/?status=orderEmpty');
	    	}
	    }else{
	    	return $controller->redirect('/orderUserComboProcess');
	    }
	}else{
		return $controller->redirect('/login');
	}
}

function orderUserComboDone($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Đơn hàng đang xử lý';

		$modelUserComboOrders = $controller->loadModel('UserComboOrders');
		$modelUserComboOrderDetails = $controller->loadModel('UserComboOrderDetails');
		$modelCombos = $controller->loadModel('Combos');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>2, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelUserComboOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->combo = $modelUserComboOrderDetails->find()->where(['order_combo_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->combo)){
					foreach ($listData[$key]->combo as $keyCombo=>$combo) {
						$infoCombo = $modelCombos->find()->where(['id'=>$combo->combo_id])->first();

						$listData[$key]->combo[$keyCombo]->name = @$infoCombo->name;
					}
				}
			}
		}

		$totalData = $modelUserComboOrders->find()->where($conditions)->all()->toList();

	    
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