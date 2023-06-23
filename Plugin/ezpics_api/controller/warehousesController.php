<?php 	
function getlistWarehousesAPI(){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');

	$modelWarehouses = $controller->loadModel('Warehouses');;

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataMember = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($dataMember)){
			// lấy kho 
			$data = $modelWarehouses->find()->where(array('user_id'=>$dataSend['idDesigner']))->all()->toList();
			if(!empty($data)){
				$return = array('code'=>1,
								'data'=> $data,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'không có kho ');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}

function getProductsWarehousesAPI(){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelProduct = $controller->loadModel('Products');
	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataMember = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($dataMember)){
			// lấy kho 
			$Warehouse = $modelWarehouses->find()->where(array('user_id'=>$dataSend['idDesigner']))->first();
			if(!empty($Warehouse)){
				$data = $modelWarehouseProducts->find()->where(array('warehouse_id'=>$Warehouse->id))->all()->toList();

				$dataProduct = array();
				foreach($data as $key => $item){
					$modelProduct = $modelProduct->find()->where(array('id'=>$item->product_id))->first();
					$dataProduct[] = $modelProduct;
				}
				$return = array('code'=>1,
								'data'=> $dataProduct,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'không có kho');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}
function buyWarehousesAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');

	$dataSend = $input['request']->getData();

	$return = array('code'=>1,
					'messages'=>array(array('text'=>''))
					);
	
	if($isRequestPost){
		if(!empty($dataSend['id']) && !empty($dataSend['token'])){
			$Warehouse = $modelWarehouses->find()->where(array('id'=>(int) $dataSend['idDesigner']))->first();

			if(!empty($Warehouse)){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
				$infoUserSell = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();

				if($infoUser->account_balance>=$Warehouse->sale_price){
					$dataSend['price'] = (int) $dataSend['price'];
					$dataSend['date_use'] = (int) $dataSend['date_use'];

					// trừ tiền tài khoản người mua
					$info_customer->account_balance -= $dataSend['price'];
					$modelMembers->save($info_customer);

					// cộng tiền tài khoản bán
					$info_sell = $modelMembers->find()->where(['id'=>$infoUser->id])->first();
					$info_sell->account_balance += $dataSend['price'];
					$modelMembers->save($info_sell);

					// lưu lịch sử mua kho mẫu thiết kế của khách hàng
					$order = $modelOrder->newEmptyEntity();
					$order->code = 'W'.time().$infoUser->id.rand(0,10000);
					$order->member_id = $infoUser->id;
					$order->product_id = (int) $dataSend['warehouses_id']; // id kho mẫu
					$order->total = $dataSend['price'];
					$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
					$order->type = 7; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế
					$order->meta_payment = 'Mua kho mẫu thiết kế ID '.$dataSend['warehouses_id'];
					$order->created_at = date('Y-m-d H:i:s');
					$modelOrder->save($order);

					// lưu lịch sử bán kho mẫu thiết kế của designer
					$order = $modelOrder->newEmptyEntity();
					$order->code = 'W'.time().$infoUserSell->id.rand(0,10000);
					$order->member_id = $infoUserSell->id;
					$order->product_id = (int) $dataSend['warehouses_id']; // id kho mẫu
					$order->total = $dataSend['price'];
					$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
					$order->type = 8; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế , 8: bán kho mẫu thiết kế
					$order->meta_payment = 'Bán kho mẫu thiết kế ID '.$dataSend['warehouses_id'];
					$order->created_at = date('Y-m-d H:i:s');
					$modelOrder->save($order);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Tài khoản không đủ tiền'))
									);
				}
			}else{
				$return = array('code'=>3,
								'messages'=>array(array('text'=>'Mẫu thiết kế bán không tồn tại'))
							);
				}
			}
		}
}
?>