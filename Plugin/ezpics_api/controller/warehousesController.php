<?php 	
function getListWarehousesAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProduct = $controller->loadModel('WarehouseProducts');

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

			// lấy kho 
			$data = $modelWarehouses->find()->where(array('user_id'=>$dataSend['idDesigner'],'status'=>1, 'deadline_at >='=> date('Y-m-d H:i:s')))->all()->toList();
			if(!empty($data)){
				$listData = array();
				foreach($data as $key => $item){
					$item->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
					$product =count($modelWarehouseProduct->find()->where(array('warehouse_id'=>$item->id))->all()->toList());
					if($product>0){
						$listData[] =$item;
					}
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

function searchWarehousesAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProduct = $controller->loadModel('WarehouseProducts');

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array('status'=>1, 'number_product >'=>0);
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:20;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array('id'=>'desc');
		if(!empty($dataSend['name'])){
			$conditions['name LIKE']= '%'.$dataSend['name'].'%';
		}
		$conditions['number_product >'] = 0;

			// lấy kho 
			$data = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
			$totalData = count($modelWarehouses->find()->where($conditions)->order($order)->all()->toList());

			if(!empty($data)){
				$listData = array();
				foreach($data as $key => $item){
					$item->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
					$product =count($modelWarehouseProduct->find()->where(array('warehouse_id'=>$item->id))->all()->toList());
					if($product>0){
						$listData[] =$item;
					}
				}
				$return = array('code'=>1,
								'data'=> $listData,
								'totalData'=> $totalData,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>2, 'mess'=>'Kho không tồn tại');
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
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:20;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array('Products.id'=>'desc');
		$conditions = array('OR' => [['Products.status'=>1],['Products.status'=>2]]);
		if(!empty($dataSend['name'])){
			$conditions['Products.name LIKE'] = '%'.$dataSend['name'].'%';
		}
		$conditions['wp.warehouse_id'] = $dataSend['idWarehouse'];
		$conditions['Products.type'] = 'user_create';

		if(!empty($dataSend['color'])){
			$conditions['Products.color'] = $dataSend['color'];
		}

		if(!empty($dataSend['orderBy'])){
			if(empty($dataSend['orderType'])) $dataSend['orderType'] = 'desc';
			
			switch ($dataSend['orderBy']) {
				case 'price':$order = array('Products.sale_price'=>$dataSend['orderType']);break;
				case 'create':$order = array('Products.id'=>$dataSend['orderType']);break;
				case 'view':$order = array('Products.views'=>$dataSend['orderType']);break;
				case 'favorite':$order = array('Products.favorites'=>$dataSend['orderType']);break;
			}
		}

		if(!empty($dataSend['category_id'])){
			$conditions['Products.category_id'] = (int) $dataSend['category_id'];
		}

		$listData = $modelProduct->find()->join([
					        'table' => 'warehouse_products',
					        'alias' => 'wp',
					        'type' => 'INNER',
					        'conditions' => 'wp.product_id = Products.id',
					    ])->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		
		$totalData = $modelProduct->find()->join([
					        'table' => 'warehouse_products',
					        'alias' => 'wp',
					        'type' => 'INNER',
					        'conditions' => 'wp.product_id = Products.id',
					    ])->where($conditions)->all()->toList();	

		$tota = count($totalData);

			if(!empty($listData)){
				if(!empty($dataSend['page'])){
					$return = array('code'=>1,
								'data'=> $listData,
								'totalData'=>$tota,
						 		'mess'=>'Bạn lấy data thành công',
						);
				}else{
					$return = array('code'=>1,
								'data'=> $totalData,
								'totalData'=>$tota,
						 		'mess'=>'Bạn lấy data thành công',
						);
				}
			}else{
				$return = array('code'=>2, 'mess'=>'Kho này không tồn tại');
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
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');

	

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['idWarehouse']) && !empty($dataSend['token'])){
			$Warehouse = $modelWarehouses->find()->where(array('id'=>(int) $dataSend['idWarehouse'],'status'=>1, 'deadline_at >='=> date('Y-m-d H:i:s')))->first();

			if(!empty($Warehouse)){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
				$infoUserSell = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();
				if(!empty($infoUser)){
				$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>$dataSend['idWarehouse'], 'user_id'=>@$infoUser->id))->first();

				
					if(empty($WarehouseUser)){
						if(@$dataSend['type']=='ecoin'){
							if($infoUser->ecoin>=$Warehouse->price/1000){
						
							// trừ tiền tài khoản mua
							$infoUser->ecoin -= $Warehouse->price/1000;
							$modelMember->save($infoUser);

							// tạo đơn mua hàng của người mua (lịch sử giao dịch)
							$ecoin = $modelTransactionEcoins->newEmptyEntity();
							$ecoin->member_id = $infoUser->id;
							$ecoin->product_id = $Warehouse->id;
							$ecoin->ecoin = $Warehouse->price/1000;
							$ecoin->note = 'Trừ Ecoin mua mẫu thiết kế có ID là:'.$Warehouse->id;
							$ecoin->status = 1;
							$ecoin->type =0;
							$ecoin->created_at =date('Y-m-d 00:00:00');
							$ecoin->updated_at =date('Y-m-d 00:00:00');

							$modelTransactionEcoins->save($ecoin);

		                    // tạo đơn bán hàng của người bán (lịch sử giao dịch)
							/*$ecoin = $modelTransactionEcoins->newEmptyEntity();
							$ecoin->member_id = $infoUserSell->id;
							$ecoin->product_id = $Warehouse->id;
							$ecoin->ecoin = (10 / 100) *($Warehouse->price/1000);
							$ecoin->note = 'Cộng Ecoin bán mẫu thiết kế có ID là:'.$Warehouse->id ;
							$ecoin->status = 1;
							$ecoin->type =1;
							$ecoin->created_at =date('Y-m-d 00:00:00');
							$ecoin->updated_at =date('Y-m-d 00:00:00');

							$modelTransactionEcoins->save($ecoin);

		                    // cộng tiền tài khoản bán
					        $infoUserSell->ecoin += (10 / 100) *($Warehouse->price/1000);
					        $modelMember->save($infoUserSell);*/

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

						    /*$dataSendNotification= array('title'=>'Có người đăng ký mua Bộ Sưu Tập của bạn','time'=>date('H:i d/m/Y'),'content'=>$infoUserSell->name.' ơi. Bạn được cộng '.number_format( $Warehouse->price/1000).' ecoin vào ecoin do thành viên '.$infoUser->name.' đã đăng ký mua Bộ Sưu Tập '.@$Warehouse->name.' Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');
		                    if(!empty($infoUserSell->token_device)){
		                        sendNotification($dataSendNotification, $infoUserSell->token_device);
		                    }*/
							}else{
								$return = array('code'=>6,
												'mess'=>'Tài khoản không đủ Ecoin'
												);
							}
						}else{
							if($infoUser->account_balance>=$Warehouse->price){

								// trừ tiền tài khoản người mua
								$infoUser->ecoin += (10 / 100) *($Warehouse->price/1000);
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
								// if(!empty(@$infoUserSell->commission)){
			                    	// $order->total = ((int) @$infoUserSell->commission / 100) * $Warehouse->price;
			                	// }else{
			                		$order->total = (65 / 100) * $Warehouse->price;
			                	// }
								$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
								$order->type = 8; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế , 8: bán kho mẫu thiết kế
								$order->meta_payment = 'Bán kho mẫu thiết kế ID '.$dataSend['idWarehouse'];
								$order->created_at = date('Y-m-d H:i:s');
								$modelOrder->save($order);

								 // cộng tiền tài khoản bán
						        $infoUserSell->account_balance += $order->total;
				        		$infoUserSell->sellingMoney += $order->total;
						        $modelMember->save($infoUserSell);


								// tạo đơn chiết khấu cho Admin (lịch sử giao dịch)
			                    if($Warehouse->price > 0){
									$order = $modelOrder->newEmptyEntity();
									$order->code = 'W'.time().$infoUserSell->id.rand(0,10000);
				                    $order->member_id = 0;
				                    $order->product_id = $Warehouse->id;
				                    // if(!empty(@$infoUserSell->commission)){
				                    	// $order->total = ((100 - (int) @$infoUserSell->commission) / 100) * $Warehouse->price;
				                	// }else{
				                		$order->total = (35 / 100) * $Warehouse->price;
				                	// }
				                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
				                    $order->type = 5; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu
				                    $order->meta_payment = 'Chiết khấu Kho thiết kế ID '.$Warehouse->id;
				                    $order->created_at = date('Y-m-d H:i:s');
				                    $modelOrder->save($order);
			                	}

			                	$data = $modelWarehouseUsers->newEmptyEntity();
			                	// tạo dữ liệu save
							    $data->warehouse_id = (int) $Warehouse->id;
							    $data->user_id = @$infoUser->id;
							    $data->designer_id = $infoUserSell->id;
							    $data->price = $Warehouse->price;
							    $data->created_at = date('Y-m-d H:i:s');
							    $data->note ='';
							    $data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +'.@$Warehouse->date_use.' days'));
							        
							    $modelWarehouseUsers->save($data);
							    $return = array('code'=>1, 'mess'=>'Bạn đã mua kho thành công');

							    $dataSendNotification= array('title'=>'Có người đăng ký mua Bộ Sưu Tập của bạn','time'=>date('H:i d/m/Y'),'content'=>$infoUserSell->name.' ơi. Bạn được cộng '.number_format((65 / 100) * $Warehouse->price).' VND vào ví do thành viên '.$infoUser->name.' đã đăng ký mua Bộ Sưu Tập '.@$Warehouse->name.' Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');
			                    if(!empty($infoUserSell->token_device)){
			                        sendNotification($dataSendNotification, $infoUserSell->token_device);
			                    }
							}else{
								$return = array('code'=>4,
												'mess'=>'Tài khoản không đủ tiền'
												);
							}
						}
					}else{
						$return = array('code'=>5,
										'mess'=>'bạn đã mua kho này rồi'
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
			$data = $modelWarehouseUsers->find()->where(array('user_id'=>$infoUser->id, 'deadline_at >=' => date('Y-m-d H:i:s')))->all()->toList();
			if(!empty($data)){
				// debug($data);

				 // die;
				$listData = array();
				foreach($data as $key => $item){
					$dataWarehouse = $modelWarehouses->find()->where(array('id'=>$item->warehouse_id, 'status'=>1))->first();


					if(!empty($dataWarehouse)){
						if($dataWarehouse->user_id!=$infoUser->id){
							$dataWarehouse->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$dataWarehouse->slug.'-'.$dataWarehouse->id.'.html';
							$dataWarehouse->deadline_at = $item->deadline_at;
							$ngay = date('Y-m-d', strtotime($item->deadline_at));
							$dataWarehouse->date_use = floor((strtotime($ngay) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
							$listData[] = $dataWarehouse;
						}
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
			$checkWarehouses = $modelWarehouses->find()->where(array('id'=>$dataSend['idWarehouse'], 'user_id'=>$infoUser->id))->first();

			if(empty($checkWarehouses)){
				$data = $modelWarehouseUsers->find()->where($conditions)->first();
				if(!empty($data)){
					$listData = array();
						$dataWarehouse = $modelWarehouses->find()->where(array('id'=>$data->warehouse_id,'status'=>1))->first();
						if($dataWarehouse){
							$dataWarehouse->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$dataWarehouse->slug.'-'.$dataWarehouse->id.'.html';
							$dataWarehouse->deadline_at = $data->deadline_at;
							$ngay = date('Y-m-d', strtotime($data->deadline_at));
							$dataWarehouse->date_use = floor((strtotime($ngay) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
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
				$return = array('code'=>3, 'mess'=>'Kho này do bạn tạo');
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

	$modelWarehouses = $controller->loadModel('Warehouses');

	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

			// lấy kho 
			$data = $modelWarehouses->find()->where(array('id'=>$dataSend['idWarehouse'],'status'=>1))->first();
			if(!empty($data)){
					$data->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$data->slug.'-'.$data->id.'.html';
					$data->ecoin = $data->price/1000;
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

function extendWarehousesAPI($input)
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
		$number = (!empty($dataSend['number']))?(int) $dataSend['number']:1;
		if(!empty($dataSend['idWarehouse']) && !empty($dataSend['token'])){
			$Warehouse = $modelWarehouses->find()->where(array('id'=>(int) $dataSend['idWarehouse'],'status'=>1))->first();

			if(!empty($Warehouse)){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
				$infoUserSell = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();
				
				if(!empty($infoUser)){
					$WarehouseUsers = $modelWarehouseUsers->find()->where(array('user_id'=>$infoUser->id,'warehouse_id'=>$Warehouse->id))->first();
					if(!empty($WarehouseUsers)){
						$Warehouse->price = $Warehouse->price*$number;
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
							// if(!empty(@$infoUserSell->commission)){
		                    	// $order->total = ((int) @$infoUserSell->commission / 100) * $Warehouse->price;
		                	// }else{
		                		$order->total = (65 / 100) * $Warehouse->price;
		                	// }
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
			                    // if(!empty(@$infoUserSell->commission)){
			                    	// $order->total = ((100 - (int) @$infoUserSell->commission) / 100) * $Warehouse->price;
			                	// }else{
			                		$order->total = (35 / 100) * $Warehouse->price;
			                	// }
			                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
			                    $order->type = 5; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu
			                    $order->meta_payment = 'Chiết khấu Kho thiết kế ID '.$Warehouse->id;
			                    $order->created_at = date('Y-m-d H:i:s');
			                    $modelOrder->save($order);
		                	}

		                	 // tạo dữ liệu save
						    $WarehouseUsers->warehouse_id = (int) $Warehouse->id;
						    $WarehouseUsers->user_id = $infoUser->id;
						    $WarehouseUsers->designer_id = $infoUserSell->id;
						    $WarehouseUsers->price = $Warehouse->price;
						    $WarehouseUsers->created_at = date('Y-m-d H:i:s');
						    $WarehouseUsers->note ='';
						    if($WarehouseUsers->deadline_at->format('Y-m-d H:i:s') <= date('Y-m-d H:i:s')){
						     	$WarehouseUsers->deadline_at = date('Y-m-d H:i:s', strtotime($WarehouseUsers->created_at . ' +'.@$Warehouse->date_use*$number.' days'));
						    }else{
						    	$WarehouseUsers->deadline_at = date('Y-m-d H:i:s', strtotime($WarehouseUsers->deadline_at . ' +'.@$Warehouse->date_use*$number.' days'));
						    }
						     $modelWarehouseUsers->save($WarehouseUsers);
						     $return = array('code'=>1, 'mess'=>'Bạn đã gia hạn kho thành công');
						      $dataSendNotification= array('title'=>'Có người đăng ký mua Bộ Sưu Tập của bạn','time'=>date('H:i d/m/Y'),'content'=>$infoUserSell->name.' ơi. Bạn được cộng '.number_format((65 / 100) * $Warehouse->price).' VND vào ví do thành viên '.$infoUser->name.' đã đăng ký mua Bộ Sưu Tập '.@$Warehouse->name.' Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');
		                    if(!empty($infoUserSell->token_device)){
		                        sendNotification($dataSendNotification, $infoUserSell->token_device);
		                    }
						}else{
							$return = array('code'=>4,
											'mess'=>'Tài khoản không đủ tiền'
											);
						}
					}else{
						$return = array('code'=>5,
									'mess'=>'Bạn chưa mua kho này '
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

function notificationWarehousesAPI($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelMember = $controller->loadModel('Members');
	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$conditions['deadline_at <='] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 7 days'));
		$conditions['deadline_at >='] = date('Y-m-d H:i:s');

			// lấy kho 
			$data = $modelWarehouseUsers->find()->where($conditions)->all()->toList();
			
			if(!empty($data)){
				foreach($data as $key => $item){
					$ngay = date('Y-m-d', strtotime($item->deadline_at));
					$date_use = floor((strtotime($ngay) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));

					$member =	$modelMember->get($item->user_id);
					$Warehouses =	$modelWarehouses->get($item->warehouse_id);
					$dataSendNotification= array('warehouse_id'=>$item->warehouse_id, 'title'=>'Thông báo hết hạn kho ','time'=>date('H:i d/m/Y'),'content'=>'Kho mẫu thiết kế "'.$Warehouses->name.'" sắp hết hạn. Thời hạn sử dụng của kho mẫu thiết kế sẽ kết thúc vào ngày '.date('d-m-Y', strtotime($item->deadline_at)),'action'=>'extendWarehouseSendNotification');
					
					if(!empty($member->token_device)){
						sendNotification($dataSendNotification, $member->token_device);
					}
				}
				
				$return = array('code'=>1,
					 			'mess'=>'Thông báo thành công',
					 		);
			}else{
				$return = array('code'=>2, 'mess'=>'Kho không tồn tại');
			}
		
	}
	return $return;
}

function addWarehouseAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

	$return = array('code'=>0);
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
	    if(!empty($dataSend['name']) && !empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
			if(!empty($infoUser)){
			    if(isset($_FILES['file']) && empty($_FILES['file']["error"])){
			    	$thumbnail = uploadImage($infoUser->id, 'file');
			    }else{
			    	$thumbnail = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
			    }

		       	if(!empty($thumbnail['linkOnline'])){
			        $thumbnail = $thumbnail['linkOnline'];
				    // lưu vào database file
			        $dataFile = $modelManagerFile->newEmptyEntity();
					$dataFile->link = $thumbnail;
			        $dataFile->user_id = $infoUser->id;
			        $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
			        $dataFile->created_at = date('Y-m-d H:i:s');
					$modelManagerFile->save($dataFile);
			    }
			    $data = $modelWarehouses->newEmptyEntity();
			    // tạo dữ liệu save
			    $data->name = $dataSend['name'];
			    $data->user_id = $infoUser->id;
				$data->price = (int) $dataSend['price'];
			    $data->date_use = (int) $dataSend['date_use'];
			    $data->thumbnail = $thumbnail;
			    $data->link_open_app = '';
			    $data->keyword = $dataSend['keyword'];
			    $data->description = $dataSend['description'];	
			    $data->created_at = date('Y-m-d H:i:s');		      
				// tạo slug
		        $slug = createSlugMantan($dataSend['name']);
		        $slugNew = $slug;
		        $number = 0;
	            $conditions = array('slug'=>$slugNew);
	        	$listData = $modelWarehouses->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
	        	if(!empty($listData)){
	        		$number++;
	        		$slugNew = $slug.'-'.$number;
	        	}
	            $data->slug = $slugNew;
	            $data->status = 0;
	            $data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +365 days'));
				        
		        $modelWarehouses->save($data);

	        	// tự thêm tác giả vào kho
	        	$dataWarehouseUsers = $modelWarehouseUsers->newEmptyEntity();
		        $dataWarehouseUsers->warehouse_id = (int) $data->id;
		        $dataWarehouseUsers->user_id = $infoUser->id;
		        $dataWarehouseUsers->price = 0;
		        $dataWarehouseUsers->created_at = date('Y-m-d H:i:s');
		        $dataWarehouseUsers->note = '';
		        $dataWarehouseUsers->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +3650 days'));
				        
		        $modelWarehouseUsers->save($dataWarehouseUsers);
				sendNotificationAdmin('64d1ca287026d948fbb45a74');

				$return = array('code'=>1,
	                    		'data'=>$data,
								'mess'=>'Bạn thêm kho mới thành công'
								);
			}else{
			    $return = array('code'=>3,
								'mess'=>'Bạn chưa đăng nhập'
								);
			}
		}else{
			$return = array('code'=>2,
							'mess'=>'Gửi thiếu dữ liệu'
							);
		}
	}
	return $return;
}

function addWarehouseLostMoneyAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
	global $price_warehouses;
	global $price_min_create_warehouses;

	$return = array('code'=>0);
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
	    if(!empty($dataSend['name']) && !empty($dataSend['token']) && !empty($dataSend['price'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
			if(!empty($infoUser)){
				if($infoUser->account_balance>$price_warehouses){
					if($dataSend['price']>=$price_min_create_warehouses){
				        if(isset($_FILES['file']) && empty($_FILES['file']["error"])){
				        	$thumbnail = uploadImage($infoUser->id, 'file');
				        }else{
				        	$thumbnail = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
				        }

			        	if(!empty($thumbnail['linkOnline'])){
					        $thumbnail = $thumbnail['linkOnline'];

					        // lưu vào database file
					        $dataFile = $modelManagerFile->newEmptyEntity();
							$dataFile->link = $thumbnail;
					        $dataFile->user_id = $infoUser->id;
					        $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
					        $dataFile->created_at = date('Y-m-d H:i:s');
							$modelManagerFile->save($dataFile);
					    }

					    $data = $modelWarehouses->newEmptyEntity();
					    // tạo dữ liệu save
					    $data->name = $dataSend['name'];
					    $data->user_id = $infoUser->id;
					    $data->price = (int) $dataSend['price'];
					    $data->date_use = (int) $dataSend['date_use'];
					    $data->thumbnail = $thumbnail;
					    $data->link_open_app = '';
					    $data->keyword = $dataSend['keyword'];
					    $data->description = $dataSend['description'];
					      

					        // tạo slug
				        $slug = createSlugMantan($dataSend['name']);
				        $slugNew = $slug;
				        $number = 0;

				        $conditions = array('slug'=>$slugNew);
				        $listData = $modelWarehouses->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

				       	if(!empty($listData)){
				       		$number++;
				       		$slugNew = $slug.'-'.$number;
				       	}
				        $data->slug = $slugNew;
				        $data->status = 0;
					    
				        $modelWarehouses->save($data);

					    $infoUser->account_balance -= $price_warehouses;
				       	$modelMember->save($infoUser);

				    	$order = $modelOrder->newEmptyEntity();
						$order->code = 'W'.time().$infoUser->id.rand(0,10000);
						$order->member_id = $infoUser->id;
						$order->product_id = (int) $data->id; // id kho mẫu
						$order->total = $price_warehouses;
						$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
						$order->type = 10; //0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 8: bán kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho
						$order->meta_payment = 'Tạo kho mẫu thiết kế ID '.$data->id;
						$order->created_at = date('Y-m-d H:i:s');
						$modelOrder->save($order);

				        	// tự thêm tác giả vào kho
				       	$dataWarehouseUsers = $modelWarehouseUsers->newEmptyEntity();
				        $dataWarehouseUsers->warehouse_id = (int) $data->id;
				        $dataWarehouseUsers->user_id = $infoUser->id;
				        $dataWarehouseUsers->price = 0;
				        $dataWarehouseUsers->created_at = date('Y-m-d H:i:s');
				        $dataWarehouseUsers->note = '';
				        $dataWarehouseUsers->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +365 days'));
					        
				        $modelWarehouseUsers->save($dataWarehouseUsers);

						sendNotificationAdmin('64d1ca287026d948fbb45a74');

					    $return = array('code'=>1,
	                    				'data'=>$data,
										'mess'=>'Bạn thêm kho mới thành công'
										);
					}else{
			    		$return = array('code'=>5,
										'mess'=>'Giá kho để trên hoặc bằng 300000đ'
									);
					}
			   }else{
			    	$return = array('code'=>4,
								'mess'=>'Để thực hiện chức năng này, bạn cần có sẵn 1.000.000 VND trong ví. Vui lòng nạp thêm tiền để hoàn thành thao tác'
								);
				}
			}else{
			    $return = array('code'=>3,
								'mess'=>'Bạn chưa đăng nhập'
								);
			}
		}else{
			$return = array('code'=>2,
							'mess'=>'Gửi thiếu dữ liệu'
							);
		}
	}
	return $return;
}

function getListWarehouseDesignerAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelMember = $controller->loadModel('Members');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
		if(!empty($infoUser)){

			// lấy kho 
			$data = $modelWarehouses->find()->where(array('user_id'=>$infoUser->id))->all()->toList();
			if(!empty($data)){
				$listData = array();
				foreach($data as $key => $item){
					$item->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
					$data[$key] =$item;
					$users = $modelWarehouseUsers->find()->where(['warehouse_id'=>$item->id])->all()->toList();
	    			$data[$key]->number_user = count($users);

	    			$products = $modelWarehouseProducts->find()->where(['warehouse_id'=>$item->id])->all()->toList();
	    			$data[$key]->number_product = count($products);
				}
				$return = array('code'=>1,
								'data'=> $data,
					 			'mess'=>'Bạn lấy data thành công',
					 		);
			}else{
				$return = array('code'=>2, 'mess'=>'Kho không tồn tại');
			}
		}else{
				$return = array('code'=>3, 'mess'=>'bạn chưa đăng nhập');
			}
	}
	return $return;
}

function updateWarehouseAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;

	$return = array('code'=>0);
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelMember = $controller->loadModel('Members');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
	    if(!empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
			if(!empty($infoUser)){
		        // lấy kho 
			$data = $modelWarehouses->find()->where(array('id'=>$dataSend['idWarehouse'],'user_id'=>$infoUser->id ))->first();
			if(!empty($data)){
				if(isset($_FILES['file']) && empty($_FILES['file']["error"])){
		        	$thumbnail = uploadImage($infoUser->id, 'file');
		        	if(!empty($thumbnail['linkOnline'])){
				        $thumbnail = $thumbnail['linkOnline'];

				        // lưu vào database file
				        $dataFile = $modelManagerFile->newEmptyEntity();
						$dataFile->link = $thumbnail;
				        $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
				        $dataFile->created_at = date('Y-m-d H:i:s');
						$modelManagerFile->save($dataFile);
						$data->thumbnail = $thumbnail;
			    	}
		        }
		        	$data->name = $dataSend['name'];
			        $data->user_id = $infoUser->id;
			        $data->price = (int) $dataSend['price'];
			        $data->date_use = (int) $dataSend['date_use'];
			        $data->link_open_app = '';
			        $data->keyword = $dataSend['keyword'];
			        $data->description = $dataSend['description'];

			        $modelWarehouses->save($data);

					$data->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$data->slug.'-'.$data->id.'.html';
				
				$return = array('code'=>1,
								'data'=> $data,
					 			'mess'=>'Bạn sửa thành công',
					 		);
			}else{
				$return = array('code'=>4, 'mess'=>'Kho không tồn tại');
			}
			}else{
			    $return = array('code'=>3,
								'mess'=>'Bạn chưa đăng nhập'
								);
			}
		}else{
			$return = array('code'=>2,
							'mess'=>'Gửi thiếu dữ liệu'
							);
		}
	}
	return $return;
}

function addUserWarehouseAPI($input){
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
		if(!empty($dataSend['idWarehouse']) && !empty($dataSend['token']) && !empty($dataSend['phone'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$Warehouse = $modelWarehouses->find()->where(array('id'=>(int) $dataSend['idWarehouse'],'user_id'=>$infoUser->id))->first();

				$infoUserSell = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();
				if(!empty($infoUserSell)){
					$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>$dataSend['idWarehouse'], 'user_id'=>@$infoUserSell->id))->first();


					if(!empty($Warehouse)){
						if(!empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();
			                // tạo dữ liệu save
							$data->warehouse_id = (int) $Warehouse->id;
							$data->user_id = $infoUserSell->id;
							$data->designer_id = $infoUser->id;
							$data->price = 0;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +'.@$Warehouse->date_use.' days'));
							        
							$modelWarehouseUsers->save($data);
							
							$dataSendNotification= array('warehouse_id'=>$Warehouse->id, 'title'=>'Thông báo nhận kho mẫu thiết kế  ','time'=>date('H:i d/m/Y'),'content'=>'Bạn đã nhận kho mẫu thiết kế  "'.$Warehouse->name.'"  từ designer "'.$infoUser->name.'".','action'=>'addUserWarehouseSendNotification');
						
							if(!empty($infoUserSell->token_device)){
								sendNotification($dataSendNotification, $member->token_device);
							}
							$return = array('code'=>1, 'mess'=>'Bạn đã thêm người vào kho thành công');
						
						
						}else{
							$return = array('code'=>5,
											'mess'=>'Người này đã mua kho của bạn rồi'
											);
						}
					}else{
						$return = array('code'=>3,
									'mess'=>'Kho này không tồn tại'
								);
					}
				}else{
							$return = array('code'=>6,
										'mess'=>'Số điện thoại này không đúng'
										);
				}
			}else{
				
				$return = array('code'=>2,
									'mess'=>'Bạn chưa đăng nhập'
								);
			}
		}
	}
	return $return;
}

?>