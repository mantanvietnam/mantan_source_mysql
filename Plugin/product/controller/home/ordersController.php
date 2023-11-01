<?php 
function cart($input)
{
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');

	$list_product = (!empty($session->read('product_order')))?$session->read('product_order'):[];

	if(!empty($list_product)){

		foreach($list_product as $key => $product){
	 		$present = array();

            if(!empty($product->id_product)){
                $id_product = explode(',', @$product->id_product);
               
                foreach($id_product as $item){
                    $presentf = $modelProduct->find()->where(['id'=>$item])->first();
                    if(!empty($presentf)){
                        $present[] = $presentf;
                    }
                }
            }
            $list_product[$key]->present = $present;

            $idprodiscount =array();
            if(!empty($product->idpro_discount)){
                $idprodiscount = explode(',', @$product->idpro_discount);
               
                foreach($idprodiscount as $item){
                    $presentf = $modelProduct->find()->where(['id'=>$item])->first();
                    if(!empty($presentf)){
                        $idprodiscount[] = $presentf;
                    }
                }
            }
            $list_product[$key]->idprodiscount = $idprodiscount;
        }
    }
    $categoryDiscountCode = categoryDiscountCode();
    $category = array();
    foreach($categoryDiscountCode as $key => $item){
    	$data = array();
    	$discountCode = $modelDiscountCode->find()->where(array('category'=>$key))->all()->toList(); 
    	$data['name'] = $item;
    	if(!empty($discountCode)){
    		$data['discountCode'] = $discountCode;
    	}
    	 
   		$category[$key]=$data;
    }
	// SẢN PHẨM NGẪU NHIÊN
    $conditions = array();
    $limit = 4;
    $page = 1;
    $order = array('id'=>'desc');

    $new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	setVariable('list_product', $list_product);
	setVariable('new_product', $new_product);
	setVariable('category', $category);
}

function addProductToCart($input)
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

	return $controller->redirect('/cart');
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

function searchDiscountCodeAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $return= array();
    $return = array('code'=>0);

    $modelDiscountCode = $controller->loadModel('DiscountCodes');

        $conditions = array();
        if(!empty($_GET['code'])){
        	$conditions['code'] = $_GET['code'];
        	$conditions['category'] = $_GET['category'];

        	
        

		$data = $modelDiscountCode->find()->where($conditions)->first();
		if(!empty($data)){
			return array('code'=>1, 'data'=>$data);
		}else{
			$return = array('code'=>0);
		}
	}else{
			$return = array('code'=>0);
		}
		
	return $return;
}

function addDiscountCode($input){
	global $session;
	global $controller;

	$pay = array();

	$pay['discountCode'] = @$_GET['discountCode'];
	$pay['code'] = @$_GET['code'];
	$pay['totalPays'] = @$_GET['totalPays'];
	$pay['discount_price'] = @$_GET['discount_price'];
	$pay['total'] = @$_GET['total'];

	$session->write('pay', $pay);
	return $controller->redirect('/pay');
}

function pay(){
	global $session;
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');

	$list_product = (!empty($session->read('product_order')))?$session->read('product_order'):[];

	$pay = (!empty($session->read('pay')))?$session->read('pay'):[];

	if(!empty($list_product)){

		foreach($list_product as $key => $product){
	 		$present = array();

            if(!empty($product->id_product)){
                $id_product = explode(',', @$product->id_product);
               
                foreach($id_product as $item){
                    $presentf = $modelProduct->find()->where(['id'=>$item])->first();
                    if(!empty($presentf)){
                        $present[] = $presentf;
                    }
                }
            }
            $list_product[$key]->present = $present;
        }
    }else{
    	return $controller->redirect('/cart');
    }


    $discountCode = $modelDiscountCode->find()->where(array('code'=>$pay['discountCode']))->first(); 


	// SẢN PHẨM NGẪU NHIÊN
    $conditions = array();
    $limit = 4;
    $page = 1;
    $order = array('id'=>'desc');

    $new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

   

	setVariable('list_product', $list_product);
	setVariable('pay', $pay);
	setVariable('discountCode', $discountCode);
}
?>
