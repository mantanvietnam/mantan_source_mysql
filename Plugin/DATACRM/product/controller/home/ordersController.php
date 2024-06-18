<?php 
function cart($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $modelCategories;

	$modelProduct = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$infoUser = $session->read('infoUser');
	$metaTitleMantan = 'Giỏ hàng';

	$list_product = (!empty($session->read('product_order')))?$session->read('product_order'):[];
	//$session = (!empty($session->read('product_order')))?$session->read('product_order'):[];

	$checkproductAll = 'true';

	if(!empty($list_product)){
		$idprodiscount =array();
		foreach($list_product as $key => $product){
			$present = array();

			if(!empty($product->id_product) && @$product->statuscart=='true'){
				$id_product = explode(',', @$product->id_product);

				foreach($id_product as $k => $item){
					$presentf = $modelProduct->find()->where(['code'=>$item])->first();
					if (!empty($product->numberOrder)) {
						$presentf->numberOrder = $product->numberOrder;
					}
					
					if(!empty($presentf)){
						$present[] = $presentf;
					}

				}

			}
			$list_product[$key]->present = $present;


			if(!empty($product->idpro_discount) && @$product->statuscart=='true'){
				$id_prodiscount = explode(',', @$product->idpro_discount);
               // debug($id_prodiscount);
				foreach($id_prodiscount as $item){
					$presentf = $modelProduct->find()->where(['code'=>$item, 'quantity >'=>0])->first();
					// $presentf->numberOrder = $product->numberOrder;
                     // debug($presentf);
					if(!empty($presentf)){

						$idprodiscount[] = $presentf;
					}
				}
			}
			$list_product[$key]->idprodiscount = $idprodiscount;

			if(@$product->statuscart=='false'){
				$checkproductAll = 'false';
			}

		}
	}

	$conditionCategorieProduct = array('type' => 'category_product', 'status'=>'active');
    $categoryDiscountCode = $modelCategories->find()->where($conditionCategorieProduct)->order(['weighty'=>'asc'])->all()->toList();

	$category = array();


	foreach($categoryDiscountCode as $key => $item){
		$data = array();
		$discountCode = $modelDiscountCode->find()->where(array('category'=>$item->id, 'status'=>1))->all()->toList(); 
		$data['name'] = $item->name;
		
		if(!empty($discountCode)){
			foreach(@$discountCode as $k => $value){
				if(!empty($value->id_customers) ){

					$id_customer = explode(',', $value->id_customers);
					
					if(!empty($infoUser) && in_array(@$infoUser->id, $id_customer)){
						$data['discountCode'][$k] = $value;
					}
				}else{
					$data['discountCode'][$k] = $value;
				}
			}
		}

		$category[$item->id] = $data;
	}

	// SẢN PHẨM NGẪU NHIÊN
	$conditions = array('status' => 'active', 'quantity >'=>0);
	$limit = 4;
	$page = 1;
	$order = array('id'=>'desc');

	$new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	if(!empty($idprodiscount)){
		$idprodiscount = array_unique(@$idprodiscount);
	}


	setVariable('list_product', $list_product);
	setVariable('new_product', $new_product);
	setVariable('category', $category);
	setVariable('prodiscount', @$idprodiscount);
	setVariable('checkproductAll', $checkproductAll);
}

function addProductToCart($input)
{
	global $session;
	global $controller;

	//$setting = setting();
	$setting['targetTime'] = time();

	$modelProduct = $controller->loadModel('Products');

	if(!empty($_REQUEST['id_product'])){
		if(empty($_REQUEST['quantity'])) $_REQUEST['quantity'] = 1;
		$product = $modelProduct->find()->where(['id'=>$_REQUEST['id_product']])->first();

		if($setting['targetTime']>time() && @$product->flash_sale==1 && !empty($product->price_flash)){
			$product->price = $product->price_flash;
		}

		$list_product = $session->read('product_order');

		if(!empty($product)){
			if(!empty($list_product[$product->id])){
				$list_product[$product->id]->numberOrder += (int) $_REQUEST['quantity'];

			}else{
				$product->statuscart=$_REQUEST['status']; // true hoặc false
				$product->numberOrder = (int) $_REQUEST['quantity'];
				$list_product[$product->id] = $product;
			}
			$count =count($list_product);
			$session->write('product_order', $list_product);

			return array('code'=>1,'count'=>$count);
		}else{
			return $controller->redirect('/cart/?error=empty_product');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}

	return $controller->redirect('/cart');
}

function updateProductToCart($input)
{
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');

	if(!empty($_REQUEST['id_product'])){
		if(empty($_REQUEST['quantity'])) $_REQUEST['quantity'] = 1;
		$product = $modelProduct->find()->where(['id'=>$_REQUEST['id_product']])->first();

		$list_product = $session->read('product_order');

		if(!empty($product)){
			if(!empty($list_product[$product->id])){
				$list_product[$product->id]->numberOrder = (int) $_REQUEST['quantity'];
			}else{
				$product->numberOrder = (int) $_REQUEST['quantity'];
				$list_product[$product->id] = $product;
			}

			$session->write('product_order', $list_product);

			return $controller->redirect('/cart/?error=addDone');
		}else{
			return $controller->redirect('/cart/?error=empty_product');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}

	return $controller->redirect('/cart');
}

function deleteProductCart($input)
{
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');

	if(!empty($_REQUEST['id_product'])){
		$list_product = $session->read('product_order');

		if(!empty($list_product[$_REQUEST['id_product']])){
			unset($list_product[$_REQUEST['id_product']]);

			$session->write('product_order', $list_product);

			return $controller->redirect('/cart/?error=deleteDone');
		}else{
			return $controller->redirect('/cart/?error=empty_product');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}

	return $controller->redirect('/cart');
}

function clearCart($input)
{
	global $session;
	global $controller;

	$session->write('product_order', []);

	if(empty($_GET['callAPI'])){
		return $controller->redirect('/cart');
	}else{
		return '';
	}
}

function createOrder($input)
{
	global $isRequestPost;
	global $session;
	global $controller;
	global $modelOptions;

	$modelProduct = $controller->loadModel('Products');
	$modelOrder = $controller->loadModel('Orders');
	$modelOrderDetail = $controller->loadModel('OrderDetails');

	if(!empty($_POST['full_name']) && !empty($_POST['phone']) && !empty($_POST['address'])){
		$dataSend = $input['request']->getData();

		$dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
		$dataSend['phone'] = str_replace(array(' ','-','.'), '', $dataSend['phone']);

		$list_product = $session->read('product_order');

		if(!empty($list_product)){
		// tạo đơn hàng mới
			$data = $modelOrder->newEmptyEntity();

			$data->id_user = @$dataSend['id_user'];
			$data->full_name = @$dataSend['full_name'];
			$data->email = @$dataSend['email'];
			$data->phone = @$dataSend['phone'];
			$data->address = @$dataSend['address'];
			$data->note_user = @$dataSend['note_user'];
			$data->note_admin = '';
			$data->status = 'new';
			$data->create_at = time();

			$money = 0;
			foreach($list_product as $product){
				$money += $product->price * $product->numberOrder;
			}
			$data->money = $money;

			$modelOrder->save($data);

			// tạo chi tiết đơn hàng
			foreach($list_product as $product){
				$dataDetail = $modelOrderDetail->newEmptyEntity();

				$dataDetail->id_product = $product->id;
				$dataDetail->quantity = $product->numberOrder;
				$dataDetail->price = $product->price;
				$dataDetail->id_order = $data->id;

				$modelOrderDetail->save($dataDetail);
			}

			// gửi thông báo cho admin qua Smax bot
			if(function_exists('sendNotificationAdmin')){
				$settingSmaxBotProduct = $modelOptions->find()->where(['key_word' => 'settingSmaxBotProduct'])->first();
				if(!empty($settingSmaxBotProduct->value)){
					$settingSmaxBotProduct = json_decode($settingSmaxBotProduct->value, true);

					if(!empty($settingSmaxBotProduct['idBlockNewOrder'])){
						sendNotificationAdmin($settingSmaxBotProduct['idBlockNewOrder']);
					}
				}
			}

			$session->write('product_order', []);

			return $controller->redirect('/cart/?error=create_order_done');
		}else{
			return $controller->redirect('/cart/?error=empty_cart');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}
}

function addDiscountCode($input){
	global $session;
	global $controller;

	$pay = array();


	$pay['discountCode'] = @$_GET['discountCode'];
	$pay['code1'] = @$_GET['code1'];
	$pay['code2'] = @$_GET['code2'];
	$pay['code3'] = @$_GET['code3'];
	$pay['code4'] = @$_GET['code4'];
	$pay['totalPays'] = @$_GET['totalPays'];
	$pay['discount_price'] = @$_GET['discount_price'];
	$pay['discount_price1'] = @$_GET['discount_price1'];
	$pay['discount_price2'] = @$_GET['discount_price2'];
	$pay['discount_price3'] = @$_GET['discount_price3'];
	$pay['discount_price4'] = @$_GET['discount_price4'];
	$pay['total'] = @$_GET['total'];

	$session->write('pay', $pay);
	if($pay['total']>0){
		return $controller->redirect('/pay');
	}else{
		return $controller->redirect('/cart');
	}

}



function checkUpdateCart(){
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');

	if(!empty($_REQUEST['id_product'])){

		$product = $modelProduct->find()->where(['id'=>$_REQUEST['id_product']])->first();

		$list_product = $session->read('product_order');

		if(!empty($product)){
			if(!empty($list_product[$product->id])){
				$list_product[$product->id]->statuscart =  $_REQUEST['status'];

			}

			if($list_product[$product->id]->statuscart=='false' && !empty($list_product[$product->id]->idpro_discount)){
				$id_prodiscount = explode(',', @$list_product[$product->id]->idpro_discount);
				foreach($id_prodiscount as $key => $item){
					$code_check = $modelProduct->find()->where(['code'=>$item])->first();

					if(!empty($list_product[$code_check->id])){
						unset($list_product[$code_check->id]);
					}
				}

			}

			$session->write('product_order', $list_product);

			return $controller->redirect('/cart/?error=addDone');
		}else{
			return $controller->redirect('/cart/?error=empty_product');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}

	return $controller->redirect('/cart');
}

function checkproductAll(){
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');

	if(!empty($_REQUEST['status'])){

	//$product = $modelProduct->find()->where(['id'=>$_REQUEST['id_product']])->first();

		$list_product = $session->read('product_order');

		if(!empty($list_product)){
			foreach($list_product as $k =>$value){
				if(!empty($list_product[$value->id])){
					$list_product[$value->id]->statuscart =  $_REQUEST['status'];

				}

				if($list_product[$value->id]->statuscart=='false' && !empty($list_product[$value->id]->idpro_discount)){
					$id_prodiscount = explode(',', @$list_product[$value->id]->idpro_discount);
					foreach($id_prodiscount as $key => $item){
						$code_check = $modelProduct->find()->where(['code'=>$item])->first();

						if(!empty($list_product[$code_check->id])){
							unset($list_product[$code_check->id]);
						}
					}

				}

				$session->write('product_order', $list_product);
			}

			return array('code' => 1);
		}else{
			return array('code' => 2);
		}
	}else{
		return array('code' => 3);
	}

	return array('code' => 4);
}

function addProductdiscountCart($input)
{
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');

	if(!empty($_REQUEST['id_product'])){
		if(empty($_REQUEST['quantity'])) $_REQUEST['quantity'] = 1;
		$product = $modelProduct->find()->where(['id'=>$_REQUEST['id_product']])->first();

		$list_product = $session->read('product_order');

		if(!empty($product)){
			if(!empty($list_product[$product->id])){
				$list_product[$product->id]->numberOrder += (int) $_REQUEST['quantity'];

			}else{
				$product->statuscart=$_REQUEST['status'];
				if(!empty($product->pricepro_discount)){
					$product->price=@$product->pricepro_discount;
				}

				$product->numberOrder = (int) $_REQUEST['quantity'];
				$list_product[$product->id] = $product;
			}

			$session->write('product_order', $list_product);

			return $controller->redirect('/cart/?error=addDone');
		}else{
			return $controller->redirect('/cart/?error=empty_product');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}

	return $controller->redirect('/cart');
}

function pay($input){
	global $session;
	global $controller;
	global $isRequestPost;
	global $session;
	global $metaTitleMantan;


	$infoUser = $session->read('infoUser');
	
	$modelProduct = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelAddress = $controller->loadModel('Address');
	$modelOrder = $controller->loadModel('Orders');
	$modelOrderDetail = $controller->loadModel('OrderDetails');

	//$modelCustomers = $controller->loadModel('Customers');
	

	$metaTitleMantan = 'Thanh toán';

	$list_product = (!empty($session->read('product_order')))?$session->read('product_order'):[];

	$pay = (!empty($session->read('pay')))?$session->read('pay'):[];
	$money = 0;
	$product_name = [];

	if(!empty($list_product)){

		foreach($list_product as $key => $product){
			$present = array();
			$money += $product->numberOrder * $product->price;
			$product_name[] = $product->title;
			
			if($product->quantity+1>$product->numberOrder){
				if(!empty($product->id_product) && @$product->statuscart=='true'){
					$id_product = explode(',', @$product->id_product);

					foreach($id_product as $item){
						$presentf = $modelProduct->find()->where(['code'=>$item])->first();
						$presentf->numberOrder = $product->numberOrder;
						if(!empty($presentf)){
							$present[] = $presentf;
						}
					}

				}
				$list_product[$key]->present = $present;
			}else{
				if(empty($_GET['callAPI'])){
					return $controller->redirect('/san-pham/'.$product->slug.'.html?error=quantity');
				}else{
					return '';
				}
			}
		}
	}else{
		if(empty($_GET['callAPI'])){
			return $controller->redirect('/cart');
		}else{
			return '';
		}
	}

	if(!empty($pay['discountCode'])){
		$discountCode = $modelDiscountCode->find()->where(array('code'=>$pay['discountCode']))->first(); 
	}else{
		$discountCode = $modelDiscountCode->newEmptyEntity();
	}
	

	// SẢN PHẨM NGẪU NHIÊN
	$conditions = array();
	$limit = 4;
	$page = 1;
	$order = array('id'=>'desc');

	$new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(empty($infoUser)){
			if(function_exists('createCustomerNew')){
				$infoUser = createCustomerNew(@$dataSend['full_name'], @$dataSend['phone'], @$dataSend['email'], @$dataSend['address'], @$dataSend['sex'], @$dataSend['id_city'], @$dataSend['id_agency'], @$dataSend['id_aff'], @$dataSend['name_agency'], @$dataSend['id_messenger'], @$dataSend['avatar'], @$dataSend['birthday_date'], @$dataSend['birthday_month'], @$dataSend['birthday_year']);
			}
		}
		
		if(empty($dataSend['id_address']) && !empty($infoUser)){
			$address = $modelAddress->newEmptyEntity();
			$address->address_name = $dataSend['address'];
			$address->id_customer = @$infoUser->id;
			$address->address_type = 1;

			$modelAddress->save($address);
		}

		$data = $modelOrder->newEmptyEntity();

		$data->id_user = (!empty($infoUser->id))?$infoUser->id:0;
		$data->full_name = @$dataSend['full_name'];
		$data->email = @$dataSend['email'];
		$data->phone = @$dataSend['phone'];
		$data->address = @$dataSend['address'];
		$data->note_user = @$dataSend['note_user'];
		$data->payment = @$dataSend['payment'];
		$data->note_admin = '';
		$data->status = 'new';
		$data->create_at = time();
		$data->id_agency = (int) @$dataSend['id_agency'];
		$data->id_aff = (int) @$dataSend['id_aff'];

		// giá trước khi giảm giá
		if(!empty($pay['totalPays'])){
			$data->money = (int) $pay['totalPays'];
		}else{
			$data->money = (int) $money;
		}

		// giá sau giảm giá
		if(!empty($pay['total'])){
			$data->total = (int) $pay['total'];
		}else{
			$data->total = (int) $money;
		}

		$discount = array( 'code1' => @$pay['code1'],
			'code2' => @$pay['code2'],
			'code3' => @$pay['code3'],
			'code4' => @$pay['code4'],
			'discount_price1' => @$pay['discount_price1'],
			'discount_price2' => @$pay['discount_price2'],
			'discount_price3' => @$pay['discount_price3'],
			'discount_price4' => @$pay['discount_price4'],
		);
		$data->discount = json_encode($discount);

		$modelOrder->save($data);

		// tạo chi tiết đơn hàng
		$listproduct = array();
		foreach($list_product as $product){
			if(@$product->statuscart=='true'){
				$present = array();
				if(!empty(@$product->id_product)){
					$id_product = explode(',', @$product->id_product);

					foreach($id_product as $k => $item){
						$presentf = $modelProduct->find()->where(['code'=>$item])->first();
						$presentf->numberOrder = $product->numberOrder;
						if(!empty($presentf)){
							$present[] = $presentf;
						}
					}
				}
				$product->present = $present;

				$listproduct[] = $product;
				$dataDetail = $modelOrderDetail->newEmptyEntity();

				$dataDetail->id_product = $product->id;
				$dataDetail->quantity = $product->numberOrder;
				//$dataDetail->present = $product->id_product;
				$dataDetail->id_order = $data->id;
				$dataDetail->price = $product->price;

				$modelOrderDetail->save($dataDetail);

				$prod = $modelProduct->get($product->id);

				$prod->quantity -= $product->numberOrder;
				$prod->sold += $product->numberOrder;

				$modelProduct->save($prod);
			}
		}

		// gửi cho khách 
		if(!empty($dataSend['email'])){
			getContentEmailOrderSuccess(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data);
		}

		// gửi cho admin
		getContentEmailAdmin(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data);
		
		$session->write('product_order', []);

		if(function_exists('getOrderLarkSuite')){
			getOrderLarkSuite($data->id);
		}

		if(function_exists('calculateAffiliate')){
			calculateAffiliate($data->total, $data->id);
		}

		if(function_exists('sendZNSDataBot')){
			$product_name = implode(',', $product_name);
			$product_name = substr($product_name, 0, 100);
			$agency = @$dataSend['name_agency'];
			$name_system = @$dataSend['name_system'];

			sendZNSDataBot($data, $product_name, $name_system, $agency);
		}

		// gửi cho đại lý
        if(!empty($dataSend['id_agency']) && function_exists('sendNotification')){
            $modelTokenDevices = $controller->loadModel('TokenDevices');
            $modelMembers = $controller->loadModel('Members');

            $infoMember = $modelMembers->find()->where(['id'=>$dataSend['id_agency']])->first();

            if(!empty($infoMember->noti_new_order)){
                $dataSendNotification= array('title'=>'Đơn hàng mới','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$data->id.' của khách hàng '.$data->full_name.' trị giá '.number_format($data->total).'đ','action'=>'createOrder','id_order'=>$data->id);
                $token_device = [];

                $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                if(!empty($listTokenDevice)){
                    foreach ($listTokenDevice as $tokenDevice) {
                        if(!empty($tokenDevice->token_device)){
                            $token_device[] = $tokenDevice->token_device;
                        }
                    }

                    if(!empty($token_device)){
                        $return = sendNotification($dataSendNotification, $token_device);
                    }
                }
            }

            if(!empty($infoMember->email)){
            	getContentEmailAdmin(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data, $infoMember->email);
            }
        }

        if(empty($_GET['callAPI'])){
			return $controller->redirect('/completeOrder?id='.$data->id);
		}else{
			return '';
		}
	}

	setVariable('list_product', $list_product);
	setVariable('pay', $pay);
	setVariable('discountCode', $discountCode);

}
function completeOrder(){
	global $session;
	global $controller;
	global $isRequestPost;
	global $session;


	$infoUser = $session->read('infoUser');
	$modelProduct = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelAddress = $controller->loadModel('Address');
	$modelOrder = $controller->loadModel('Orders');

	$data = $modelOrder->find()->where(['id'=>$_GET['id']])->first();

	if(!empty($data)){

		setVariable('data', $data);
	}else{
		return $controller->redirect('/');
	}

}

function listOrder($input){
	global $controller;
	global $session;


	$metaTitleMantan = 'đơn hàng';

	$modelProduct = $controller->loadModel('Products');
	$modelLike = $controller->loadModel('Likes');

	$modelOrder = $controller->loadModel('Orders');

	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');
		$listData = $modelOrder->find()->where(['id_user'=>$infoUser->id])->all()->toList();

		setVariable('listData', $listData);
	}else{
		$controller->redirect('/');
	}
}


function detailOrder(){
	global $controller;
	global $urlCurrent;
	global $modelCategories;
	global $metaTitleMantan;
	global $session;

	$metaTitleMantan = 'Chi tiết đơn hàng';
	if(!empty($session->read('infoUser'))){
		$modelProduct = $controller->loadModel('Products');
		$modelOrder = $controller->loadModel('Orders');
		$modelOrderDetail = $controller->loadModel('OrderDetails');

		if(!empty($_GET['id'])){
			$order = $modelOrder->find()->where(['id'=>(int) $_GET['id'] ])->first();

			if(!empty($order)){
				$detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();

				if(!empty($detail_order)){
					foreach ($detail_order as $key => $value) {
						$product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();


						$present = array();

						if(!empty($product->id_product) ){
							$id_product = explode(',', @$product->id_product);

							foreach($id_product as $item){
								$presentf = $modelProduct->find()->where(['code'=>$item])->first();

								;
								if(!empty($presentf)){
									$present[] = $presentf;
								}
							}
							$product->present = @$present; 
						}

						$detail_order[$key]->product = $product;
					}
				}
				setVariable('order', $order);
				setVariable('detail_order', $detail_order);
			}else{
				return $controller->redirect('/listOrder');
			}
		}else{
			return $controller->redirect('/listOrder');
		}
	}else{
		$controller->redirect('/');
	}
}

function cancelOrder(){
	global $controller;
	global $urlCurrent;
	global $modelCategories;
	global $metaTitleMantan;

	$metaTitleMantan = 'Chi tiết đơn hàng';


	$modelOrder = $controller->loadModel('Orders');

	if(!empty($_GET['id'])){
		$order = $modelOrder->find()->where(['id'=>(int) $_GET['id'] ])->first();

		$order->status = $_GET['status'];

		$modelOrder->save($order);
		return $controller->redirect('/listOrder');

	}
}

function discount($input){
	global $controller;
	global $urlCurrent;
	global $session;
	global $modelCategories;
	global $metaTitleMantan;


	if(!empty($session->read('infoUser'))){
		$modelDiscountCode = $controller->loadModel('DiscountCodes');
		$infoUser = $session->read('infoUser');
		
		$conditionCategorieProduct = array('type' => 'category_product', 'status'=>'active');
	    $categoryDiscountCode = $modelCategories->find()->where($conditionCategorieProduct)->order(['weighty'=>'asc'])->all()->toList();

		$category = array();


		foreach($categoryDiscountCode as $key => $item){
			$data = array();
			$discountCode = $modelDiscountCode->find()->where(array('category'=>$item->id, 'status'=>1))->all()->toList(); 
			$data['name'] = $item->name;
			
			if(!empty($discountCode)){
				foreach(@$discountCode as $k => $value){
					if(!empty($value->id_customers) ){

						$id_customer = explode(',', $value->id_customers);
						
						if(!empty($infoUser) && in_array(@$infoUser->id, $id_customer)){
							$data['discountCode'][$k] = $value;
						}
					}else{
						$data['discountCode'][$k] = $value;
					}
				}
			}

			$category[$item->id] = $data;
		}

		setVariable('data', $category);
	}else{
		return $controller->redirect('/cart');
	}
}

function getOrderAPI($input){
	 
    global $isRequestPost;
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		return getOrderLarkSuite($dataSend['id']);
	}
	
}

?>