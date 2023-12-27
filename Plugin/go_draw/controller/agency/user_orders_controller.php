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
	    		if(empty($dataSend['amount'])) $dataSend['amount'] = 1;

	    		$infoProductAgency = $modelAgencyProducts->find()->where(['product_id'=>(int) $dataSend['product_id'], 'agency_id'=>$session->read('infoUser')->id])->first();
	    		$infoProduct = $modelProducts->find()->where(['id'=>(int) $dataSend['product_id']])->first();

	    		if(!empty($infoProduct) && !empty($infoProductAgency)){
	    			$cartUser = $session->read('cartUser');
	    			$infoProduct->price = $infoProductAgency->price;

	    			if(empty($cartUser)) $cartUser = [];
	    			$cartUser = [];

	    			if(empty($cartUser[$infoProduct->id])){
	    				$infoProduct->amount_sell = $dataSend['amount'];
	    				$cartUser[$infoProduct->id] = $infoProduct;
	    			}else{
	    				$cartUser[$infoProduct->id]->amount_sell += $dataSend['amount'];
	    			}

	    			$session->write('cartUser', $cartUser);

	    			return $controller->redirect('/userCart');
	    		}else{
					return $controller->redirect('/sellProduct');
				}
	    	}else{
				return $controller->redirect('/sellProduct');
			}
	    }else{
			return $controller->redirect('/sellProduct');
		}
	}else{
		return $controller->redirect('/login');
	}
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
	    		if($value->type == 0){
		    		$total_price += $value->price * $value->amount_sell;
		    	}
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
	    	$order->combo_id = (int) @$session->read('idComboUserBuy');
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
	    $session->write('idComboUserBuy', 0);

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
	    $modelCombos = $controller->loadModel('Combos');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>0, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelUserOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$infoCombo = $modelCombos->find()->where(['id'=>$value->combo_id])->first();

				$listData[$key]->name_combo = @$infoCombo->name;

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

function orderUserPrintBill($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'In hóa đơn';

	    $modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyAccounts = $controller->loadModel('AgencyAccounts');
		$modelAgencies = $controller->loadModel('Agencies');
		$modelUsers = $controller->loadModel('Users');

	    if(!empty($_GET['id'])){
	    	$infoOrder = $modelUserOrders->find()->where(['id'=>(int) $_GET['id'], 'agency_id'=>(int) $session->read('infoUser')->id])->first();

	    	$agencyAcc = $modelAgencyAccounts->get($session->read('infoUser')->id);
			$infoAgency = $modelAgencies->get($agencyAcc->agency_id);

			$infoUser = $modelUsers->find()->where(['id'=>(int) $infoOrder->user_id])->first();

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
	    	setVariable('infoAgency', $infoAgency);
	    	setVariable('infoUser', $infoUser);
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
	global $isRequestPost;
	global $modelOptions;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thanh toán đơn hàng';

	    $modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');
	    $modelUserOrderHistories = $controller->loadModel('UserOrderHistories');
	    $modelUsers = $controller->loadModel('Users');
	    $modelZaloOas = $controller->loadModel('ZaloOas');
	    $modelCombos = $controller->loadModel('Combos');

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();

		    if(!empty($dataSend['id'])){
		    	$infoOrder = $modelUserOrders->find()->where(['id'=>(int) $dataSend['id'], 'agency_id'=>(int) $session->read('infoUser')->id])->first();

		    	if(!empty($infoOrder)){
		    		// combo sản phẩm mua
		    		$infoCombo = $modelCombos->find()->where(['id'=>$infoOrder->combo_id])->first();

		    		// hoàn lại sản phẩm
		    		$infoOrder->product = $modelUserOrderDetails->find()->where(['order_id'=>$infoOrder->id])->all()->toList();
		    		$total_price = 0;

		    		if(!empty($infoOrder->product)){
						foreach ($infoOrder->product as $keyProduct=>$product) {
							$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

							// nếu là sản phẩm tái sử dụng
							if($infoProduct->type == 1){
								$product_agency = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'product_id'=>$product->product_id])->first();

								if(!empty($product_agency)){

									// nếu trả đủ hàng tái sử dụng
									if(empty($dataSend['used'][$product->product_id]) || $dataSend['used'][$product->product_id] == '0'){
										$product_agency->amount += $product->amount;
										$product_agency->updated_at = date('Y-m-d H:i:s');

										$modelAgencyProducts->save($product_agency);
									}else{
										$product_agency->amount += $product->amount - $dataSend['used'][$product->product_id];
										$product_agency->updated_at = date('Y-m-d H:i:s');

										$modelAgencyProducts->save($product_agency);

										// tính tiền sản phẩm làm hỏng
										$total_price += $infoProduct->price * $dataSend['used'][$product->product_id];
									}
								}
							}else{
								$total_price += $product->unit_price * $product->amount;
							}
						}
					}

					// cập nhập lại trạng thái đơn hàng
		    		$infoOrder->status = 2;
		    		$infoOrder->total_price = $total_price;
		    		$infoOrder->updated_at = date('Y-m-d H:i:s');
		    		$modelUserOrders->save($infoOrder);

					// lưu lịch sử cập nhập đơn
			    	$orderHistory = $modelUserOrderHistories->newEmptyEntity();

			    	$orderHistory->agency_id = $session->read('infoUser')->id;
			    	$orderHistory->order_id = $infoOrder->id;
			    	$orderHistory->note = 'Hoàn thành đơn bán lẻ vật tư cho khách hàng';
			    	$orderHistory->created_at = date('Y-m-d H:i:s');
			    	$orderHistory->status = $infoOrder->status;

			    	$modelUserOrderHistories->save($orderHistory);

			    	// cộng điểm tích lũy
			    	$infoUserBuy = $modelUsers->get($infoOrder->user_id);

			    	$infoUserBuy->total_coin += $total_price/1000;

			    	$modelUsers->save($infoUserBuy);

			    	// gửi zalo thông báo
		    		if(function_exists('sendZNSZalo')){
						$money_zalo_zns = $modelOptions->find()->where(['key_word' => 'money_zalo_zns'])->first();
    					$money_zalo = (int) $money_zalo_zns->value;

    					if($money_zalo>=500){
    						$zaloOA = $modelZaloOas->find()->first();

    						if(!empty($zaloOA->access_token)){
    							$template_id = 304484;
    							$params = [	'order_code' => $infoOrder->id,
    										'note'=>'',
    										'list_product'=> $infoCombo->name,
    										'cost'=> number_format($total_price).'đ',
    										'payment_status'=>'Hoàn thành',
    										'customer_name'=> $infoUserBuy->name,
    									];
    							$phone = $infoUserBuy->phone;
    							$id_oa = $zaloOA->id_oa;
    							$app_id = $zaloOA->id_app;

    							$sendZalo = sendZNSZalo($template_id, $params, $phone, $id_oa, $app_id);

    							if($sendZalo['error'] == 0){
    								$money_zalo_zns->value -= 500;

    								$modelOptions->save($money_zalo_zns);
    							}else{
    								$mess = '<p class="text-danger">Lỗi gửi mã xác thực Zalo, mã lỗi '.$sendZalo['error'].'</p>';		

    								//return $controller->redirect('/verified/?status=errorSendZalo&code='.$sendZalo['error']);
    							}
    						}else{
    							$mess = '<p class="text-danger">Lỗi gửi mã xác thực Zalo do chưa có token</p>';	

    							//return $controller->redirect('/verified/?status=errorTokenEmpty');
    						}
    					}else{
    						$mess = '<p class="text-danger">Lỗi gửi mã xác thực Zalo do tài khoản không đủ tiền</p>';	

    						//return $controller->redirect('/verified/?status=errorMoneyEmpty');
    					}
					}

					return $controller->redirect('/orderUserPrintBill/?id='.$dataSend['id']);
		    	}else{
		    		return $controller->redirect('/orderUserProcess/?status=orderEmpty');
		    	}
		    }else{
		    	return $controller->redirect('/orderUserProcess');
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
	    $modelCombos = $controller->loadModel('Combos');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>2, 'agency_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelUserOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$infoCombo = $modelCombos->find()->where(['id'=>$value->combo_id])->first();

				$listData[$key]->name_combo = @$infoCombo->name;
				
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

function staticAgency($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thống kê đơn hàng';

		$modelUserOrders = $controller->loadModel('UserOrders');
	    $modelUserOrderDetails = $controller->loadModel('UserOrderDetails');
	    $modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>2, 'agency_id'=>$user->id);
		
		if (!empty($_GET['from_date'])) {
	        $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from_date']);
	        $conditions['updated_at >='] = $fromDate->format('Y-m-d H:i:s');
	    }

	    if (!empty($_GET['to_date'])) {
	        $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to_date']);
	        $conditions['updated_at <='] = $toDate->format('Y-m-d H:i:s');
	    }


		$order = array('id'=>'desc');

		$listData = $modelUserOrders->find()->where($conditions)->order($order)->all()->toList();

		$total_money = 0;
		
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->product = $modelUserOrderDetails->find()->where(['order_id'=>$value->id])->all()->toList();

				if(!empty($listData[$key]->product)){
					foreach ($listData[$key]->product as $keyProduct=>$product) {
						$infoProduct = $modelProducts->find()->where(['id'=>$product->product_id])->first();

						$listData[$key]->product[$keyProduct]->name = @$infoProduct->name;
					}
				}

				$total_money += $value->total_price;
			}
		}

		
	    
	    setVariable('listData', $listData);
	    setVariable('total_money', $total_money);
	}else{
		return $controller->redirect('/login');
	}
}

function checkCombo($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Combo sản phẩm';

		$modelCombos = $controller->loadModel('Combos');
		$modelComboProducts = $controller->loadModel('ComboProducts');
		$modelAgencyProducts = $controller->loadModel('AgencyProducts');

		$conditions = array('status'=>1);

		$listCombo = $modelCombos->find()->where($conditions)->all()->toList();
		$list_combo = [];

		$list_product_agency = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id])->all()->toList();

			
		$product_agency = [];

		if(!empty($list_product_agency)){
			foreach ($list_product_agency as $item) {
				$product_agency[$item->product_id] = $item->amount;
			}
		}
		
		// nếu kho đại lý có sản phẩm
		if(!empty($product_agency)){
			if(!empty($listCombo)){
				foreach ($listCombo as $infoCombo) {
					$list_product_combo = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();
					
					$check = true;
					if(!empty($list_product_combo)){
						foreach ($list_product_combo as $item) {
							if(empty($product_agency[$item->product_id]) || $product_agency[$item->product_id]<$item->amount){
								$check = false;
							}
						}
					}
					
					if($check){
						$list_combo[] = $infoCombo;
					}
				}
			}
		}

		setVariable('list_combo', $list_combo);
	}else{
		return $controller->redirect('/login');
	}
}

function viewComboAgency($input)
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

			$infoCombo = $modelCombos->find()->where(['id'=>(int) $_GET['id']])->first();

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
			}else{
				return $controller->redirect('/checkCombo');
			}
			
		}else{
			return $controller->redirect('/checkCombo');
		}
	}else{
		return $controller->redirect('/login');
	}
}

function addCartComboUser($input)
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
	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');

    	if(!empty($_GET['idCombo'])){
    		if(empty($_GET['amount'])) $_GET['amount'] = 1;

    		$infoCombo = $modelCombos->find()->where(['id'=>(int) $_GET['idCombo']])->first();

    		if(!empty($infoCombo)){
    			$list_products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

    			if(!empty($list_products)){
    				$cartUser = $session->read('cartUser');
    				if(empty($cartUser)) $cartUser = [];
			    	$cartUser = [];

    				foreach ($list_products as $item) {
			    		$infoProductAgency = $modelAgencyProducts->find()->where(['product_id'=>(int) $item->product_id, 'agency_id'=>$session->read('infoUser')->id])->first();
			    		
			    		$infoProduct = $modelProducts->find()->where(['id'=>(int) $item->product_id])->first();

			    		if(!empty($infoProduct) && !empty($infoProductAgency)){
			    			$infoProduct->price = $infoProductAgency->price;

			    			if(empty($cartUser[$infoProduct->id])){
			    				$infoProduct->amount_sell = $_GET['amount'];
			    				$cartUser[$infoProduct->id] = $infoProduct;
			    			}else{
			    				$cartUser[$infoProduct->id]->amount_sell += $_GET['amount'];
			    			}
			    		}else{
							return $controller->redirect('/checkCombo/error=emptyProductAgency');
						}
					}

					$session->write('cartUser', $cartUser);
					$session->write('idComboUserBuy', $infoCombo->id);

			    	return $controller->redirect('/userCart');
				}else{
					return $controller->redirect('/checkCombo/error=emptyComboProduct');
				}
			}else{
				return $controller->redirect('/checkCombo/error=emptyInfoCombo');
			}
    	}else{
			return $controller->redirect('/checkCombo/error=emptyIDCombo');
		}
	}else{
		return $controller->redirect('/login');
	}
}