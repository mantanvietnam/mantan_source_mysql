<?php 	
function getlistWarehousesAPI($input){

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
				$listData = array();
				foreach($data as $key => $item){
					$item->link_share = 'https://designer.ezpics.vn/warehouse/'.$item->slug.'-'.$item->id.'.html';
					$listData[] =$item;
				}
				$return = array('code'=>1,
								'data'=> $listData,
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

function getProductsWarehousesAPI($input){

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
				$data = $modelWarehouseProducts->find()->where(array('warehouse_id'=>$dataSend['idWarehouse'], 'user_id'=>$dataSend['idDesigner']))->all()->toList();
			if(!empty($data)){
				$dataProduct = array();
				foreach($data as $key => $item){
					$Product = $modelProduct->find()->where(array('id'=>$item->product_id,'status'=>2))->first();
					if(!empty($Product)){
						$dataProduct[] = $Product;
					}	
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
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');

	

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['idWarehouse']) && !empty($dataSend['token'])){
			$Warehouse = $modelWarehouses->find()->where(array('id'=>(int) $dataSend['idWarehouse']))->first();

			if(!empty($Warehouse)){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
				$infoUserSell = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();

				if($infoUser->account_balance>=$Warehouse->sale_price){

					// trừ tiền tài khoản người mua
					$infoUser->account_balance -= $Warehouse->price;
					$modelMember->save($infoUser);

					

					// lưu lịch sử mua kho mẫu thiết kế của khách hàng
					$order = $modelOrder->newEmptyEntity();
					$order->code = 'W'.time().$infoUser->id.rand(0,10000);
					$order->member_id = $infoUser->id;
					$order->product_id = (int) $dataSend['idWarehouse']; // id kho mẫu
					$order->total = $Warehouse->price;
					$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
					$order->type = 7; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế
					$order->meta_payment = 'Mua kho mẫu thiết kế ID '.$dataSend['idWarehouse'];
					$order->created_at = date('Y-m-d H:i:s');
					$modelOrder->save($order);

					// lưu lịch sử bán kho mẫu thiết kế của designer
					$order = $modelOrder->newEmptyEntity();
					$order->code = 'W'.time().$infoUserSell->id.rand(0,10000);
					$order->member_id = $infoUserSell->id;
					$order->product_id = (int) $dataSend['idWarehouse']; // id kho mẫu
					if(!empty(@$infoUserSell->commission)){
                    	$order->total = ((int) @$infoUserSell->commission / 100) * $Warehouse->price;
                	}else{
                		$order->total = (70 / 100) * $Warehouse->price;
                	}
					$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
					$order->type = 8; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế , 8: bán kho mẫu thiết kế
					$order->meta_payment = 'Bán kho mẫu thiết kế ID '.$dataSend['idWarehouse'];
					$order->created_at = date('Y-m-d H:i:s');
					$modelOrder->save($order);

					 // cộng tiền tài khoản bán
			        $infoUserSell->account_balance += $order->total;
			        $modelMember->save($infoUserSell);


					// tạo đơn chiết khấu cho Admin (lịch sử giao dịch)
                    if($Warehouse->price > 0){
						$order = $modelOrder->newEmptyEntity();
						$order->code = 'W'.time().$infoUserSell->id.rand(0,10000);
	                    $order->member_id = 0;
	                    $order->product_id = $Warehouse->id;
	                    if(!empty(@$infoUserSell->commission)){
	                    	$order->total = ((100 - (int) @$infoUserSell->commission) / 100) * $Warehouse->price;
	                	}else{
	                		$order->total = (30 / 100) * $Warehouse->price;
	                	}
	                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
	                    $order->type = 5; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu
	                    $order->meta_payment = 'Chiết khấu Kho thiết kế ID '.$Warehouse->id;
	                    $order->created_at = date('Y-m-d H:i:s');
	                    $modelOrder->save($order);
                	}

                	 $data = $modelWarehouseUsers->newEmptyEntity();
                	 // tạo dữ liệu save
				     $data->warehouse_id = (int) $Warehouse->id;
				     $data->user_id = $infoUser->id;
				     $data->designer_id = $infoUserSell->id;
				     $data->price = $Warehouse->price;
				     $data->created_at = date('Y-m-d H:i:s');
				     $data->note ='';
				     $data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +'.@$Warehouse->date_use.' days'));
				        
				     $modelWarehouseUsers->save($data);
				     $return = array('code'=>1, 'mess'=>'Bạn đã mua kho thành công');
				}else{
					$return = array('code'=>4,
									'mess'=>'Tài khoản không đủ tiền'
									);
				}
			}else{
				$return = array('code'=>3,
								'mess'=>'Kho này không tồn tại'
							);
				}
			}
		}
		return $return;
}
?>