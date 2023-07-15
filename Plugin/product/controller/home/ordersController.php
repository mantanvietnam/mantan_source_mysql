<?php 
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

	$modelProduct = $controller->loadModel('Products');
	$modelOrder = $controller->loadModel('Orders');
	$modelOrderDetail = $controller->loadModel('OrderDetail');

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
    			$settingSmaxBotProduct = $modelOptions->find()->where(['type' => 'settingSmaxBotProduct'])->first();
    			if(!empty($settingSmaxBotProduct->content)){
			        $settingSmaxBotProduct = json_decode($settingSmaxBotProduct->content, true);

			        if(!empty($settingSmaxBotProduct['idBlockNewOrder'])){
			        	sendNotificationAdmin($settingSmaxBotProduct['idBlockNewOrder']);
			        }
			    }
			}

			return $controller->redirect('/cart/?error=create_order_done');
		}else{
			return $controller->redirect('/cart/?error=empty_cart');
		}
	}else{
		return $controller->redirect('/cart/?error=empty_data');
	}
}
?>