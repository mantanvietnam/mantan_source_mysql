<?php 	
function getListWarehousesAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');;

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

			// lấy kho 
			$data = $modelWarehouses->find()->where(array('user_id'=>$dataSend['idDesigner']))->all()->toList();
			if(!empty($data)){
				$listData = array();
				foreach($data as $key => $item){
					$item->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
					$listData[] =$item;
				}
				$return = array('code'=>1,
								'data'=> $listData,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'Kho không tồn tại');
			}
		
	}
	return $return;
}

function searchtWarehousesAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');;

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		if(!empty($dataSend['name'])){
			$conditions['name']= $dataSend['name'];
		}

			// lấy kho 
			$data = $modelWarehouses->find()->where($conditions)->all()->toList();
			if(!empty($data)){
				$listData = array();
				foreach($data as $key => $item){
					$item->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
					$listData[] =$item;
				}
				$return = array('code'=>1,
								'data'=> $listData,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'Kho không tồn tại');
			}
		
	}
	return $return;
}

function getProductsWarehousesAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelProduct = $controller->loadModel('Products');
	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

			$data = $modelWarehouseProducts->find()->where(array('warehouse_id'=>$dataSend['idWarehouse']))->all()->toList();
			if(!empty($data)){
				$dataProduct = array();
				foreach($data as $key => $item){
					$Product = $modelProduct->find()->where([	'id'=>$item->product_id,
																'OR' => [
					    													['status'=>1],
					    													['status'=>2]
					    												]
														])->first();
					if(!empty($Product)){
						$dataProduct[] = $Product;
					}	
				}

				if(!empty($dataProduct)){
					$return = array('code'=>1,
									'data'=> $dataProduct,
						 			'mess'=>'Bạn lấy data thành công',
						 		);
				}else{
					$return = array('code'=>0, 'mess'=>'Kho này chưa có sản phẩm');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'Kho này chưa có sản phẩm');
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
				if(!empty($infoUser)){
					if($infoUser->account_balance>=$Warehouse->price){

						// trừ tiền tài khoản người muas
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
					$return = array('code'=>2,
									'mess'=>'Bạn chưa đăng nhập'
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

function getListBuyWarehousesAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelMember = $controller->loadModel('Members');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();


		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
		if(!empty($infoUser)){

			// lấy kho 
			$data = $modelWarehouseUsers->find()->where(array('user_id'=>$infoUser->id,'deadline_at >=' => date('Y-m-d H:i:s')))->all()->toList();
			if(!empty($data)){
				$listData = array();
				foreach($data as $key => $item){
					$dataWarehouse = $modelWarehouses->find()->where(array('id'=>$item->warehouse_id))->first();
					if($dataWarehouse){
						$dataWarehouse->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$dataWarehouse->slug.'-'.$dataWarehouse->id.'.html';
						$dataWarehouse->deadline_at = $item->deadline_at;
						$listData[] = $dataWarehouse;
					}
				}
				$return = array('code'=>1,
								'data'=> $listData,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'Bạn chưa mua kho nào');
			}
		}else{
			$return = array('code'=>2,
							'mess'=>'Bạn chưa đăng nhập'
					);
					}
		
	}
	return $return;
}

function checkBuyWarehousesAPI($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelMember = $controller->loadModel('Members');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();


		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
		if(!empty($infoUser)){

			// lấy kho 
			$conditions = array('warehouse_id'=>$dataSend['idWarehouse']);
			$conditions['user_id'] = $infoUser->id;
			$conditions['deadline_at >='] =date('Y-m-d H:i:s');

			$data = $modelWarehouseUsers->find()->where($conditions)->first();
			if(!empty($data)){
				$listData = array();
					$dataWarehouse = $modelWarehouses->find()->where(array('id'=>$data->warehouse_id))->first();
					if($dataWarehouse){
						$dataWarehouse->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$dataWarehouse->slug.'-'.$dataWarehouse->id.'.html';
						$dataWarehouse->deadline_at = $data->deadline_at;
						$listData = $dataWarehouse;
					}
				
				$return = array('code'=>1,
								'data'=> $listData,
					 			'mess'=>'Bạn đã mua kho này',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'Bạn chưa mua kho này');
			}
		}else{
			$return = array('code'=>2,
							'mess'=>'Bạn chưa đăng nhập'
					);
					}
		
	}
	return $return;
}

function buyProductWarehousesAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelMember = $controller->loadModel('Members');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');

	$dataSend = $input['request']->getData();

	$return = array('code'=>0);
	if($isRequestPost){
		if(!empty($dataSend['idWarehouse']) && !empty($dataSend['token']) && !empty($dataSend['idProduct'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$WarehouseUsers = $modelWarehouseUsers->find()->where(array('warehouse_id'=>$dataSend['idWarehouse'], 'user_id'=>@$infoUser->id, 'deadline_at >=' => date('Y-m-d H:i:s')))->first();
				$Warehouse = $modelWarehouses->find()->where(array('id'=>@$dataSend['idWarehouse']))->first();

				if (!empty($WarehouseUsers) && !empty($Warehouse)) {
				
					$WarehouseProducts = $modelWarehouseProducts->find()->where(array('product_id'=>$dataSend['idProduct'], 'warehouse_id'=>@$Warehouse->id))->first();

					$product = $modelProduct->find()->where(['id'=>(int) $dataSend['idProduct']])->first();

					if(!empty($WarehouseProducts) && !empty($product)){
					
						$infoUserSell = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();
	                    // gửi thông báo về app cho người bán
	                    $dataSendNotification= array('title'=>'Bán mẫu thiết kế trong kho trên Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Có khách hàng mua mẫu thiết kế '.$product->name.' ở trong kho : '.$Warehouse->name.' của bạn với số tiền là 0 đ','action'=>'addMoneySuccess');

	                    if(!empty($infoUserSell->token_device)){
	                        sendNotification($dataSendNotification, $infoUserSell->token_device);
	                    }

	                    // tạo mẫu thiết kế mới
	                    $newproduct = $modelProduct->newEmptyEntity();

	                    $newproduct->name = $product->name;
	                    $newproduct->slug = $product->slug.'-'.time();
	                    $newproduct->price = 0;
	                    $newproduct->sale_price = 0;
	                    $newproduct->content = $product->content;
	                    //$newproduct->desc = $product->desc;
	                    $newproduct->sale = $product->sale;
	                    $newproduct->related_packages = $product->related_packages;
	                    $newproduct->status = 0;
	                    $newproduct->type = 'user_edit';
	                    $newproduct->sold = 0;
	                    $newproduct->image = $product->image;
	                    $newproduct->thumn = $product->thumn;
	                    $newproduct->thumbnail = '';
	                    $newproduct->user_id = $infoUser->id;
	                    $newproduct->product_id = $product->id;
	                    $newproduct->note_admin = '';
	                    $newproduct->created_at = date('Y-m-d H:i:s');
	                    $newproduct->views = 0;
	                    $newproduct->favorites = 0;
	                    $newproduct->category_id = $product->category_id;
	                    $newproduct->width = $product->width;
	                    $newproduct->height = $product->height;

	                    $modelProduct->save($newproduct);

	                    // sao chép layer
	                    $detail = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();

	                    if(!empty($detail)){
		                    foreach($detail as $d){
		                    	$newLayer = $modelProductDetail->newEmptyEntity();	

		                    	$newLayer->products_id = $newproduct->id;
		                    	$newLayer->name = $d->name;
		                    	$newLayer->content = $d->content;
		                    	$newLayer->sort = $d->sort;
		                    	
		                    	$newLayer->created_at = date('Y-m-d H:i:s');
		                        
		                        $modelProductDetail->save($newLayer);
		                    }
		                }

	                    $return = array('code'=>1,
	                    				'product_id'=>$newproduct->id,
										'messages'=>array(array('text'=>'Mua thành công'))
										);
		                
					}else{
						$return = array('code'=>4,
										'messages'=>array(array('text'=>'Mẫu thiết kế này không có trong kho bạn đã mua'))
										);
					}
				}else{
					$return = array('code'=>2,
								'messages'=>array(array('text'=>'Bạn chưa mua kho này'))
								);
				}
			}else{
				$return = array('code'=>0,
								'messages'=>array(array('text'=>'Bạn chưa đăng nhập'))
								);
			}
		}else{
			$return = array('code'=>2,
							'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
							);
		}
	}

	return 	$return;
}

function  getInfoWarehouseAPI($input){
		global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');;

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

			// lấy kho 
			$data = $modelWarehouses->find()->where(array('id'=>$dataSend['idWarehouse']))->first();
			if(!empty($data)){
					$data->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$data->slug.'-'.$data->id.'.html';
				
				$return = array('code'=>1,
								'data'=> $data,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>0, 'mess'=>'Kho không tồn tại');
			}
		
	}
	return $return;
}

?>