<?php 
function getNewProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$dataSend = $input['request']->getData();

	$conditions = array('status'=>2, 'type'=>'user_create');
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:8;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('id'=>'desc');

	$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			if(empty($value->thumbnail)){
				$listData[$key]->thumbnail = $value->image;
			}
		}
	}

	return 	array('listData'=>$listData);
}

function searchProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelSearchKeys = $controller->loadModel('SearchKeys');

	$dataSend = $input['request']->getData();

	$conditions = array('status'=>2, 'type'=>'user_create');
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('id'=>'desc');

	if(!empty($dataSend['orderBy'])){
		if(empty($dataSend['orderType'])) $dataSend['orderType'] = 'desc';
		
		switch ($dataSend['orderBy']) {
			case 'price':$order = array('sale_price'=>$dataSend['orderType']);break;
			case 'create':$order = array('id'=>$dataSend['orderType']);break;
			case 'view':$order = array('views'=>$dataSend['orderType']);break;
			case 'favorite':$order = array('favorites'=>$dataSend['orderType']);break;
		}
	}

	if(!empty($dataSend['name'])){
		$conditions['OR'] = [
								['name LIKE'=>'%'.$dataSend['name'].'%'],
								['keyword LIKE'=>'%'.$dataSend['name'].'%']
							];

	}

	if(!empty($dataSend['category_id'])){
		$conditions['category_id'] = (int) $dataSend['category_id'];
	}

	if(!empty($dataSend['color'])){
		$conditions['color'] = $dataSend['color'];
	}

	if(!empty($dataSend['nameDesigner'])){
		$conditionsMember['name LIKE'] = '%'.$dataSend['nameDesigner'].'%';
		$conditionsMember['type'] = 1;
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
	}

	if(!empty($dataSend['price'])){
		$price = explode('-', $dataSend['price']);
		$conditions['sale_price >='] = (int) $price[0];
		$conditions['sale_price <='] = (int) $price[1];
	}

	$listProduct = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



	if(!empty($listProduct)){
		foreach ($listProduct as $key => $value) {
			if(empty($value->thumbnail)){
				$listProduct[$key]->thumbnail = $value->image;
				$listProduct[$key]->ecoin = $value->sale_price/1000;
			}
		}
		if(!empty($dataSend['name'])){
			$SearchKey = $modelSearchKeys->find()->where(array('keyword'=> strtolower($dataSend['name'])))->first();

			if(!empty($SearchKey)){
				$SearchKey->number_search += 1;
				$modelSearchKeys->save($SearchKey);

			}else{
				$Search =  $modelSearchKeys->newEmptyEntity();
				$Search->keyword =mb_strtolower($dataSend['name'], 'UTF-8');
				$Search->slug = createSlugMantan($dataSend['name']);
				$Search->number_search = 1;
				$Search->created_at = date('Y-m-d H:i:s');
				$Search->status = 1;
				$modelSearchKeys->save($Search);
			}
		}


	}

	return 	array('listData'=>$listProduct);
}

function getProductByCategoryAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');

	$dataSend = $input['request']->getData();
	$listProduct = [];

	if(!empty($dataSend['category_id'])){
		$conditions = array('status'=>2, 'type'=>'user_create','category_id'=>(int) $dataSend['category_id']);
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array('id'=>'desc');

		if(!empty($dataSend['orderBy'])){
			if(empty($dataSend['orderType'])) $dataSend['orderType'] = 'desc';
			
			switch ($dataSend['orderBy']) {
				case 'price':$order = array('sale_price'=>$dataSend['orderType']);break;
				case 'create':$order = array('id'=>$dataSend['orderType']);break;
				case 'view':$order = array('views'=>$dataSend['orderType']);break;
				case 'favorite':$order = array('favorites'=>$dataSend['orderType']);break;
			}
		}
		
		$listProduct = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		if(!empty($listProduct)){
			foreach ($listProduct as $key => $value) {
				if(empty($value->thumbnail)){
					$listProduct[$key]->thumbnail = $value->image;
					$listProduct[$key]->ecoin = $value->sale_price/1000;
				}
			}
		}
	}

	return 	array('listData'=>$listProduct);
}

function getProductAllCategoryAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$modelProduct = $controller->loadModel('Products');

	// lấy tất cả danh mục thiết kế
	$conditions = array('type'=>'product_categories');
	$order = array('id'=>'desc');

	$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();
	$listProductCategory = [];

	if(!empty($listCategory)){
		foreach ($listCategory as $category) {
			// lấy tất cả sản phẩm trong danh mục
			$dataSend = $input['request']->getData();

			$conditions = array('status'=>2, 'category_id'=>$category->id, 'type'=>'user_create');
			$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
			$page = 1;
			$order = array('id'=>'desc');

			if(!empty($dataSend['orderBy'])){
				if(empty($dataSend['orderType'])) $dataSend['orderType'] = 'desc';
				
				switch ($dataSend['orderBy']) {
					case 'price':$order = array('sale_price'=>$dataSend['orderType']);break;
					case 'create':$order = array('id'=>$dataSend['orderType']);break;
					case 'view':$order = array('views'=>$dataSend['orderType']);break;
					case 'favorite':$order = array('favorites'=>$dataSend['orderType']);break;
				}
			}

			$listProduct = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			if(!empty($listProduct)){
				foreach ($listProduct as $key => $value) {
					if(empty($value->thumbnail)){
						$listProduct[$key]->thumbnail = $value->image;
						$listProduct[$key]->ecoin = $value->sale_price/1000;
					}
				}
			}

			$listProductCategory[] = ['category' => $category, 'listData' => $listProduct];
		}
	}

	return 	array('listData'=>$listProductCategory);
}

function getTrendProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');

	$dataSend = $input['request']->getData();

	$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'type'=>'user_create', 'status'=>2);
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('views'=>'desc', 'favorites'=>'desc', 'id'=>'desc');

	$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			$infoUser = $modelMember->find()->where(['id'=>(int) $value->user_id])->first();

			$listData[$key]->author = @$infoUser->name;

			if(empty($value->thumbnail)){
				$listData[$key]->thumbnail = $value->image;
			}
		}
	}

	return 	array('listData'=>$listData);
}

function listTrendProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');

	$dataSend = $input['request']->getData();

	$conditions = array('trend' =>1, 'type'=>'user_create', 'status'=>2);
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('views'=>'desc', 'favorites'=>'desc', 'id'=>'desc');

	$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			$infoUser = $modelMember->find()->where(['id'=>(int) $value->user_id])->first();

			$listData[$key]->author = @$infoUser->name;

			if(empty($value->thumbnail)){
				$listData[$key]->thumbnail = $value->image;
			}
		}
	}

	return 	array('listData'=>$listData);
}

function getInfoProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');

	
	$data = $modelProduct->newEmptyEntity();
	$otherData = [];
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['id'])){
			$data = $modelProduct->find()->where(['id'=>(int) $dataSend['id']])->first();

			if(!empty($data)){
				$data->views ++;
				$modelProduct->save($data);

				$infoUser = $modelMember->find()->where(['id'=>(int) $data->user_id])->first();
				$data->author = @$infoUser->name;

				if(empty($data->thumbnail)){
					$data->thumbnail = $data->image;

				}

				$data->ecoin = $data->sale_price/1000;

				if($data->type == 'user_create'){
					$data->link_share = 'https://designer.ezpics.vn/detail/'.$data->slug.'-'.$data->id.'.html';
				}elseif($data->type == 'user_series'){
					$data->link_share = 'https://designer.ezpics.vn/detail-series/'.$data->slug.'-'.$data->id.'.html';
				}else{
					$data->link_share = $data->image;
				}

				$conditions = ['category_id'=>$data->category_id, 'id !='=>$data->id, 'type'=>'user_create', 'status'=>2];
				$limit= 12;
				$page= 1;
				$order = array();
				$otherData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				if(!empty($otherData)){
					foreach ($otherData as $key => $value) {
						if(empty($value->thumbnail)){
							$otherData[$key]->thumbnail = $value->image;
						}
					}
				}
			}
		}
	}

	return 	array('data'=>$data, 'otherData'=>$otherData);
}

function deleteProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');

	$dataSend = $input['request']->getData();

	$return = array('code'=>1);

	if(!empty($dataSend['id']) && !empty($dataSend['token'])){
		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
		$data = $modelProduct->find()->where(['id'=>(int) $dataSend['id']])->first();

		if(!empty($data) && !empty($infoUser) && $data->user_id == $infoUser->id){
			// xóa mẫu thiết kế
			$modelProduct->delete($data);

			// xóa layer
			$conditions = ['products_id'=>$data->id];
			$modelProductDetail->deleteAll($conditions);

			// xóa yêu thích
			$conditions = ['product_id'=>$data->id];
			$modelProductFavorite->deleteAll($conditions);

			$return = array('code'=>0);
		}
	}

	return $return;
}

function createProductAPI($input)
{
	global $controller;
	global $isRequestPost;

	$return = array('code'=>1,
					'messages'=>array(array('text'=>''))
					);

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelWarehouses = $controller->loadModel('Warehouses');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['name']) && !empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$type = !empty($dataSend['type'])?$dataSend['type']:'user_create';
				$name = $dataSend['name'];
				$price = (int) @$dataSend['price'];
				$sale_price = (int) @$dataSend['sale_price'];
				$category_id = (int) @$dataSend['category_id'];
				$color = @$dataSend['color'];
				$warehouse =  explode(',', @$dataSend['warehouse_id']);

	            return createNewProduct($infoUser, $name, $price, $sale_price, $type, $category_id, $warehouse, $color);
	        }else{
	        	$return = array('code'=>3,
							'messages'=>array(array('text'=>'Không tồn tại tài khoản người dùng'))
							);
	        }
		}else{
			$return = array('code'=>2,
							'messages'=>array(array('text'=>'Bạn chưa nhập tên mẫu thiết kế'))
							);
		}
	}

	return 	$return;
}

function updateProductAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $urlCreateImage;
	global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;
	global $ftp_password_upload_image;

	$return = array('code'=>0);

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['idProduct']) && !empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$product =  $modelProduct->find()->where(array('id'=>$dataSend['idProduct'],'user_id'=>$infoUser->id))->first();
				if(!empty($product)){
					if(!empty($dataSend['name'])){
						$product->name = $dataSend['name'];
					}
					if(!empty($dataSend['price'])){
						$product->price = (int) @$dataSend['price'];
					}
					if(!empty($dataSend['sale_price'])){
						$product->sale_price = (int) @$dataSend['sale_price'];
					}
					if(!empty($dataSend['category_id'])){
						$product->category_id = (int) @$dataSend['category_id'];
					}

					if(!empty($dataSend['color'])){
						$product->color = @$dataSend['color'];
					}

					if(isset($dataSend['status']) && @$dataSend['status']<2){

						$product->status = (int) @$dataSend['status'];
					}

					if(!empty($dataSend['description'])){

						$product->description = @$dataSend['description'];
					}

					if(!empty($dataSend['warehouse_id'])){
						$warehouse =  explode(',', @$dataSend['warehouse_id']);
						$modelWarehouseProducts->deleteAll(array('product_id'=>$product->id));

			        	foreach ($warehouse as $warehouse_id) {
			        		$checkWarehouses = $modelWarehouses->find()->where(array('id'=>$warehouse_id,'user_id'=>$infoUser->id))->first();
			        		if(!empty($checkWarehouses)){
				        		$warehouse_products = $modelWarehouseProducts->newEmptyEntity();

				        		$warehouse_products->warehouse_id = $warehouse_id;
				        		$warehouse_products->product_id = $product->id;
				        		$warehouse_products->user_id = $infoUser->id;

				        		$modelWarehouseProducts->save($warehouse_products);

				        		$totalProducts = count($modelWarehouseProducts->find()->where(['warehouse_id'=>$warehouse_id])->all()->toList());
				        		$listWarehouse = $modelWarehouses->get($warehouse_id);
				        		$listWarehouse->number_product = $totalProducts;
				        		$modelWarehouses->save($listWarehouse);
			        		}
			        	}
					}
					if(!empty($_FILES['background']['name']) && empty($_FILES['background']["error"])){
			            $background = uploadImage($infoUser->id, 'background');


			            if(!empty($background['linkOnline'])){
			                $thumb = $background['linkOnline'];

			                // lưu vào database file
			                $dataFile = $modelManagerFile->newEmptyEntity();

			                $dataFile->link = $background['linkOnline'];
			                $dataFile->user_id = $infoUser->id;
			                $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
			                $dataFile->created_at = date('Y-m-d H:i:s');

			                $modelManagerFile->save($dataFile);

			                $product->thumn = $thumb;
			                $product->image = $thumb;
			            }
			        }
			        if(!empty($_FILES['thumbnail']['name']) && empty($_FILES['thumbnail']["error"])){
			            $thumbnail = uploadImage($infoUser->id, 'thumbnail');
			            
			            if(!empty($thumbnail['linkOnline'])){
			                $thumbnails = $thumbnail['linkOnline'];

			                // lưu vào database file
			                $dataFile = $modelManagerFile->newEmptyEntity();

			                $dataFile->link = $thumbnails;
			                $dataFile->user_id = $infoUser->id;
			                $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
			                $dataFile->created_at = date('Y-m-d H:i:s');

			                $modelManagerFile->save($dataFile);

			                $product->thumbnail = $thumbnails;
			            }
			        }
			        $modelProduct->save($product);
			        $return = array('code'=>1,
							'mess'=>'bạn sửa thành công!'
							);
				}else{
					$return = array('code'=>4,
							'mess'=>'Sản phẩm này không tồn tại!'
							);
				}
	        }else{
	        	$return = array('code'=>3,
							'mess'=>'Không tồn tại tài khoản người dùng'
							);
	        }
		}else{
			$return = array('code'=>2,
							'mess'=>'Bạn chưa nhập tên mẫu thiết kế'
							);
		}
	}

	return 	$return;
}




function buyProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');

	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');
	$dataSend = $input['request']->getData();

	$return = array('code'=>1,
					'messages'=>array(array('text'=>''))
					);
	
	if($isRequestPost){
		if(!empty($dataSend['id']) && !empty($dataSend['token'])){
			$product = $modelProduct->find()->where(['id'=>(int) $dataSend['id']])->first();

			if(!empty($product)){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
				if(!empty($infoUser)){
					$infoUserSell = $modelMember->find()->where(array('id'=>$product->user_id))->first();

					if($product->free_pro == 1 && $infoUser->member_pro == 1){
							// cập nhập số lần bán sản phẩm
							$product->sold ++;

							$modelProduct->save($product);

							// tạo đơn mua hàng của người mua (lịch sử giao dịch)
							$order = $modelOrder->newEmptyEntity();
							$order->code = 'B'.time().$infoUser->id.rand(0,10000);
		                    $order->member_id = $infoUser->id;
		                    $order->product_id = $product->id;
		                    $order->total = 0;
		                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                    $order->type = 0; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
		                    $order->meta_payment = 'Mua mẫu thiết kế ID '.$product->id;
		                    $order->created_at = date('Y-m-d H:i:s');
		                    $modelOrder->save($order);

		                    // tạo đơn bán hàng của người bán (lịch sử giao dịch)
							$order = $modelOrder->newEmptyEntity();
							$order->code = 'B'.time().$infoUserSell->id.rand(0,10000);
		                    $order->member_id = $infoUserSell->id;
		                    $order->product_id = $product->id;
		                    $order->total = 0;
		                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                    $order->type = 3; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
		                    $order->meta_payment = 'Bán mẫu thiết kế ID '.$product->id;
		                    $order->created_at = date('Y-m-d H:i:s');
		                    $modelOrder->save($order);

		                    // gửi thông báo về app cho người bán
		                    $dataSendNotification= array('title'=>'Bán mẫu thiết kế trên Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Có khách hàng mua mẫu thiết kế '.$product->name.'của bạn với số tiền là 0đ','action'=>'addMoneySuccess');

		                    if(!empty($data->token_device)){
		                        sendNotification($dataSendNotification, $data->token_device);
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

		                    $return = array('code'=>0,
		                    				'product_id'=>$newproduct->id,
											'messages'=>array(array('text'=>'Mua thành công'))
											);
					}else{
						if(@$dataSend['type']=='ecoin'){
							if($infoUser->ecoin>=$product->sale_price/1000){
							
								// trừ tiền tài khoản mua
								$infoUser->ecoin -= $product->sale_price/1000;
								$modelMember->save($infoUser);

								// cập nhập số lần bán sản phẩm
								$product->sold ++;

								$modelProduct->save($product);

								// tạo đơn mua hàng của người mua (lịch sử giao dịch)
								$ecoin = $modelTransactionEcoins->newEmptyEntity();
								$ecoin->member_id = $infoUser->id;
								$ecoin->product_id = $product->id;
								$ecoin->ecoin = $product->sale_price/1000;
								$ecoin->note = 'Trừ Ecoin mua mẫu thiết kế có ID là:'.$product->id;
								$ecoin->status = 1;
								$ecoin->type =0;
								$ecoin->created_at =date('Y-m-d 00:00:00');
								$ecoin->updated_at =date('Y-m-d 00:00:00');

								$modelTransactionEcoins->save($ecoin);

			                    // tạo đơn bán hàng của người bán (lịch sử giao dịch)
								/*$ecoin = $modelTransactionEcoins->newEmptyEntity();
								$ecoin->member_id = $infoUserSell->id;
								$ecoin->product_id = $product->id;
								$ecoin->ecoin = (10 / 100) *($product->sale_price/1000);
								$ecoin->note = 'Cộng Ecoin bán mẫu thiết kế có ID là:'.$product->id ;
								$ecoin->status = 1;
								$ecoin->type =1;
								$ecoin->created_at =date('Y-m-d 00:00:00');
								$ecoin->updated_at =date('Y-m-d 00:00:00');

								$modelTransactionEcoins->save($ecoin);

			                    // cộng tiền tài khoản bán
						        $infoUserSell->ecoin += (10 / 100) *($product->sale_price/1000);
						        $modelMember->save($infoUserSell);

			                   

			                    // gửi thông báo về app cho người bán
			                    $dataSendNotification= array('title'=>'Bán mẫu thiết kế trên Ezpics','time'=>date('H:i d/m/Y'),'content'=>$infoUserSell->name.' ơi. Bạn được cộng '.number_format($ecoin->ecoin).' ecoin vào ecoin do thành viên '.$infoUser->name.' đã đăng ký mua mẫu thiết kế '.@$product->name.' Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

			                    if(!empty($data->token_device)){
			                        sendNotification($dataSendNotification, $data->token_device);
			                    }*/

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

			                    $return = array('code'=>0,
			                    				'product_id'=>$newproduct->id,
												'messages'=>array(array('text'=>'Mua thành công'))
												);
				                
							}else{
								$return = array('code'=>6,
												'messages'=>array(array('text'=>'Tài khoản không đủ Ecoin'))
												);
							}

						}else{
							if($infoUser->account_balance>=$product->sale_price){
							
								// trừ tiền tài khoản mua
								$infoUser->ecoin += round((10 / 100) *($product->sale_price/1000));
								$infoUser->account_balance -= $product->sale_price;
								$modelMember->save($infoUser);

								// cập nhập số lần bán sản phẩm
								$product->sold ++;

								$modelProduct->save($product);

								// tạo đơn mua hàng của người mua (lịch sử giao dịch)
								$order = $modelOrder->newEmptyEntity();
								$order->code = 'B'.time().$infoUser->id.rand(0,10000);
			                    $order->member_id = $infoUser->id;
			                    $order->product_id = $product->id;
			                    $order->total = $product->sale_price;
			                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
			                    $order->type = 0; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
			                    $order->meta_payment = 'Mua mẫu thiết kế ID '.$product->id;
			                    $order->created_at = date('Y-m-d H:i:s');
			                    $modelOrder->save($order);

			                    // tạo đơn bán hàng của người bán (lịch sử giao dịch)
								$order = $modelOrder->newEmptyEntity();
								$order->code = 'B'.time().$infoUserSell->id.rand(0,10000);
			                    $order->member_id = $infoUserSell->id;
			                    $order->product_id = $product->id;
			                    if(isset($infoUserSell->commission)){
			                    	$order->total = ((int) @$infoUserSell->commission / 100) * $product->sale_price;
			                	}else{

			                		$order->total = (70 / 100) * $product->sale_price;
			                	}
			                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
			                    $order->type = 3; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
			                    $order->meta_payment = 'Bán mẫu thiết kế ID '.$product->id;
			                    $order->created_at = date('Y-m-d H:i:s');
			                    $modelOrder->save($order);

			                    // cộng tiền tài khoản bán
						        $infoUserSell->account_balance += $order->total;
						        $infoUserSell->sellingMoney += $order->total;
						        $modelMember->save($infoUserSell);

			                    // tạo đơn chiết khấu cho Admin (lịch sử giao dịch)
			                    if($product->sale_price > 0){
									$order = $modelOrder->newEmptyEntity();
									$order->code = 'B'.time().$infoUserSell->id.rand(0,10000);
				                    $order->member_id = 0;
				                    $order->product_id = $product->id;
				                    if(isset($infoUserSell->commission)){
				                    	$order->total = ((100 - (int) @$infoUserSell->commission) / 100) * $product->sale_price;
				                	}else{
				                		$order->total = (30 / 100) * $product->sale_price;
				                	}
				                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
				                    $order->type = 5; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu
				                    $order->meta_payment = 'Chiết khấu mẫu thiết kế ID '.$product->id;
				                    $order->created_at = date('Y-m-d H:i:s');
				                    $modelOrder->save($order);
			                	}

			                    // gửi thông báo về app cho người bán
			                    $dataSendNotification= array('title'=>'Bán mẫu thiết kế trên Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Có khách hàng mua mẫu thiết kế '.$product->name.'của bạn với số tiền là '.number_format($product->sale_price).'đ','action'=>'addMoneySuccess');

			                    if(!empty($infoUserSell->token_device)){
			                        sendNotification($dataSendNotification, $infoUserSell->token_device);
			                    }

			                    // gửi thông báo công ecoin
			                    $dataSendNotificationEcoin= array('title'=>'Cộng thêm Ecoin','time'=>date('H:i d/m/Y'),'content'=>'bạn được cộng Ecoin khi  mua mẫu thiết kế '.$product->name.'của bạn với số ecoin là '.round((10 / 100) *($product->sale_price/1000)).'ecoin','action'=>'addMoneySuccess');

			                    if(!empty($infoUser->token_device)){
			                        sendNotification($dataSendNotificationEcoin, $infoUser->token_device);
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

			                    $return = array('code'=>0,
			                    				'product_id'=>$newproduct->id,
												'messages'=>array(array('text'=>'Mua thành công'))
												);
				                
							}else{
								$return = array('code'=>4,
												'messages'=>array(array('text'=>'Tài khoản không đủ tiền'))
												);
							}
						}
					}
				}else{
					$return = array('code'=>5,
								'messages'=>array(array('text'=>'bạn chưa đằng nhập!'))
								);
			}	
			}else{
				$return = array('code'=>3,
								'messages'=>array(array('text'=>'Mẫu thiết kế bán không tồn tại!'))
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

function getMyProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$return = array('listData'=>[]);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$conditions = array('user_id'=>$infoUser->id);
				if(!empty($dataSend['type'])){
					$conditions['type']= $dataSend['type'];
				}
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				if(!empty($listData)){
					foreach ($listData as $key => $value) {
						if(empty($value->thumbnail)){
							$listData[$key]->thumbnail = $value->image;
						}
					}
				}

				$return = array('listData'=>$listData);
			}
		}
	}

	return 	$return;
}

function getMyProductFavoriteAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	$return = array('listData'=>[]);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$conditions = array('member_id'=>$infoUser->id);
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				$listData = $modelProductFavorite->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
				$listProduct = [];

				if(!empty($listData)){
					foreach ($listData as $key => $value) {
						$product = $modelProduct->find()->where(['id'=>(int) $value->product_id])->first();

						if(!empty($product)){
							if(!empty($product->thumbnail)){
								$product->image = $product->thumbnail;
							}

							$listProduct[] = $product;
						}else{
							$modelProductFavorite->delete($value);
						}
					}
				}

				$return = array('listData'=>$listProduct);
			}
		}
	}

	return 	$return;
}

function saveFavoriteProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['product_id'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$product = $modelProduct->find()->where(['id'=>(int) $dataSend['product_id']])->first();

				if(!empty($product)){
					$checkFavorite = $modelProductFavorite->find()->where(array('member_id'=>$infoUser->id, 'product_id'=>$product->id))->first();

					if(empty($checkFavorite)){
						$favorite = $modelProductFavorite->newEmptyEntity();	

						$favorite->member_id = $infoUser->id;
						$favorite->product_id = $product->id;
						$favorite->created_at = date('Y-m-d H:i:s');

						$modelProductFavorite->save($favorite);

						// cập nhập số lượng được yêu thích của sản phẩm
						$product->favorites ++;
						$modelProduct->save($product);
					}

					$return = array('code'=>0,
									'messages'=>array(array('text'=>'Lưu yêu thích thành công'))
									);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Sản phẩm không tồn tại'))
									);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai mã token'))
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

function deleteFavoriteProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['product_id'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$product = $modelProduct->find()->where(['id'=>(int) $dataSend['product_id']])->first();

				if(!empty($product)){
					$checkFavorite = $modelProductFavorite->find()->where(array('member_id'=>$infoUser->id, 'product_id'=>$product->id))->first();

					if(!empty($checkFavorite)){
						// xóa yêu thích
						$modelProductFavorite->delete($checkFavorite);

						// cập nhập số lượng được yêu thích của sản phẩm
						$product->favorites --;
						$modelProduct->save($product);
					}

					$return = array('code'=>0,
									'messages'=>array(array('text'=>'Xóa mẫu thiết kế yêu thích thành công'))
									);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Sản phẩm không tồn tại'))
									);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai mã token'))
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

function checkFavoriteProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['product_id'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$product = $modelProduct->find()->where(['id'=>(int) $dataSend['product_id']])->first();

				if(!empty($product)){
					$checkFavorite = $modelProductFavorite->find()->where(array('member_id'=>$infoUser->id, 'product_id'=>$product->id))->first();

					if(!empty($checkFavorite)){
						$return = array('code'=>1);
					}
				}
			}
		}
	}

	return 	$return;
}

function getIdProductCloneAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$return = array('product_clone_id'=>0, 'user_id'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['product_id'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$product = $modelProduct->find()->where(['id'=>(int) $dataSend['product_id']])->first();

				$productClone = $modelProduct->find()->where(array('user_id'=>$infoUser->id, 'product_id'=> $product->id))->first();

				if(!empty($productClone)){
					$return = array('product_clone_id'=>$productClone->id, 'user_id'=>$productClone->user_id);
				}else{
					$return = array('product_clone_id'=>$product->id, 'user_id'=>$product->user_id);
				}
			}
		}
	}

	return 	$return;
}

function getMyProductSeriesAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();


		if(!empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$conditions = array('user_id'=>$infoUser->id, 'type'=>'user_series');
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



				if(!empty($listData)){
					foreach ($listData as $key => $value) {
						if(empty($value->thumbnail)){
							$listData[$key]->thumbnail = $value->image;
						}
					}
					$return = array('code'=>1,'listData'=>$listData);
				}else{
					$return = array('code'=>3,
									'mess'=>'Bạn không có mẫu thiết kế'
								);
				}
			}else{
				$return = array('code'=>2,
									'mess'=>'Bạn chưa đăng nhập'
								);
			}
		}
	}

	return 	$return;
}

function getSizeProductAPI($input)
{
	return getSizeProduct();
}

function detailProductSeriesAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;

	$modelProduct = $controller->loadModel('Products');
	$modelMembers = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['idProduct'])){
			$product = $modelProduct->find()->where(array('id'=>(int)$dataSend['idProduct']))->first();


			if(!empty($product) && $product->type == 'user_series' && $product->status == 1){

				$product->views ++;
				$modelProduct->save($product);

				$user = $modelMembers->get($product->user_id);

				if(!empty($product->thumbnail)){
					$product->image = $product->thumbnail;
				}

				$product->link_share = 'https://designer.ezpics.vn/detail-series/'.$product->slug.'-'.$product->id.'.html';

				$metaTitleMantan = 'Mẫu thiết kế: '.$product->name;
				$metaDescriptionMantan = 'Ảnh được tạo từ mẫu thiết kế: '.$product->name.' của tác giả '.$user->name.' trên Ezpics';
				$metaImageMantan = $product->image;

				$listLayer = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();

				$urlChatBot = 'https://designer.ezpics.vn/create-image-series/?id='.$product->id;

                if(!empty($listLayer)){
                    foreach ($listLayer as $key => $layer) {
                        $content = json_decode($layer->content, true);
                        
                        if(!empty($content['variable']) && !empty($content['variableLabel'])){
                            $urlChatBot .= '&'.$content['variable'].'={{'.$content['variable'].'}}';
                        }

                        $content->gradient = (int) @$content->gradient;

                        $listLayer[$key]['content'] = $content;
                    }
                }

                $data = array();
				$data['product'] = $product;
				$data['user'] = $user;
				$data['urlCreateImage'] = $urlChatBot;
				$data['listLayer'] = $listLayer;


				$return = array('code'=>1,
							'data' => $data,
					'mess'=>'Bạn lấy data thành công');
			}else{
				$return = array('code'=>3,
					'mess'=>'sản phẩm này không dúng');
			}
		}else{
			$return = array('code'=>3,
					'mess'=>'thiếu dữ liệu');
		}
	}


	return $return;
}

function createImageSeriesAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $urlCreateImage;
	global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;
	global $response;

	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');

	$dataImage = '';
	$return = array('code'=>0);
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['idProduct'])){
			$id = (int) $dataSend['idProduct'];

			$product = $modelProduct->find()->where(['id'=>$id])->first();

			if(!empty($product) && $product->type == 'user_series' && $product->status == 1){
				$product->export_image ++;
				$modelProduct->save($product);

				$urlThumb = 'https://apis.ezpics.vn/createImageFromTemplate/?id='.$id;

				$listLayer = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();

				$listRemoveImage = [];
				if(!empty($listLayer)){
	        		foreach ($listLayer as $layer) {
	        			$content = json_decode($layer->content, true);

	        			if(!empty($content['variable'])){
	        				if(!empty($dataSend[$content['variable']]) && $content['type'] == 'text'){
	    						 $urlThumb .= '&'.$content['variable'].'='.$dataSend[$content['variable']];
	    					}

	        				if($content['type'] == 'image'){
	        					if(isset($_FILES[$content['variable']]) && empty($_FILES[$content['variable']]["error"])){
						            $image = uploadImage($product->id, $content['variable']);
						            if(!empty($image['linkOnline'])){
						            	$urlThumb .= '&'.$content['variable'].'='.$image['linkOnline'];

						            	$listRemoveImage[] = @$image['linkLocal'];
						            }
						        }
	        				}
	        			}
	        		}
	        	}
	        	
				$url = $urlCreateImage.'?url='.urlencode($urlThumb).'&width='.$product->width.'&height='.$product->height;
			
		        $dataImage = sendDataConnectMantan($url);

		        // xóa ảnh người dùng up lên sau khi chụp xong
		        if(!empty($listRemoveImage)){
		        	foreach ($listRemoveImage as $item) {

		        		removeFile($item);
		        	}
		        }

			    $data = array();
				$data['dataImage'] = $dataImage;
				$data['id'] = $id;
				$data['slug'] = $product->slug;

				$return = array('code'=>1,
								'data' => $data,
						'mess'=>'Bạn lấy data thành công');
			}else{
				$return = array('code'=>2,
						'mess'=>'Không tìm thấy sản phẩm này');
			}
		}else{
			$return = array('code'=>3,
						'mess'=>'bạn chuyền thiếu dữ liệu');
		}
	}
	return $return;

}

function updateInfoProductAPI($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelWarehouses = $controller->loadModel('Warehouses');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
    $modelMember = $controller->loadModel('Members');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
        if(!empty($user)){
	        $pro = $modelProduct->find()->where(array('id'=>$dataSend['id'], 'user_id'=>$user->id))->first();

	        if (empty($pro)) {
	            return ['code'=>4, 'mess' => 'Sản phẩm của bạn đã bị xóa khỏi hệ thống']; 
	        }else{
	            if(!empty($dataSend['field']) && isset($dataSend['value'])){
	                switch ($dataSend['field']) {
	                    case 'category_id':
	                        $pro->category_id = (int) $dataSend['value'];
	                        break;
	                    
	                    case 'price':
	                        $pro->price = (int) str_replace(',','',$dataSend['value']);
	                        break;
	                    
	                    case 'sale_price':
	                        $pro->sale_price = (int) str_replace(',','',$dataSend['value']);
	                        break;
	                    
	                    case 'name':
	                        $pro->name = $dataSend['value'];

	                        // tạo slug
	                        $slug = createSlugMantan($dataSend['value']);
	                        $slugNew = $slug;
	                        $number = 0;

	                        if(empty($pro->slug) || $pro->slug!=$slugNew){
	                            do{
	                                $conditions = array('slug'=>$slugNew);
	                                $listData = $modelProduct->find()->where($conditions)->all()->toList();

	                                if(!empty($listData)){
	                                    $number++;
	                                    $slugNew = $slug.'-'.$number;
	                                }
	                            }while (!empty($listData));
	                        }

	                        $pro->slug = $slugNew;

	                        break;

	                    case 'status':
	                        $pro->status = (int) $dataSend['value'];
	                        if($pro->status == 1){
	                            sendNotificationAdmin('6479b6f4b4a51d8bb38fc547');
	                            $warehouseProducts = $modelWarehouseProducts->find()->where(['product_id'=>$pro->id])->all()->toList();
	                            if(!empty($warehouseProducts)){
	                                foreach($warehouseProducts as $keywp => $product){
	                                    $Warehouses = $modelWarehouses->find()->where(['id'=>$product->warehouse_id])->first();
	                                    $warehouseUser = $modelWarehouseUsers->find()->where(['warehouse_id'=>$Warehouses->id])->all()->toList();
	                                    foreach($warehouseUser as $keyus => $item){
	                                        $user = $modelMember->find()->where(['id'=>$item->user_id])->first();
	                                        $dataSendNotification= array('product_id'=>$pro->id, 'title'=>'Thông báo có mẫu thiết kế mới trong kho ','time'=>date('H:i d/m/Y'),'content'=>'Kho mẫu thiết kế "'.$Warehouses->name.'" có mẫu mới là "'.$pro->name.'"!','action'=>'productNewWarehouseNotification');
	                                        if(!empty($user->token_device)){
	                                            sendNotification($dataSendNotification, $user->token_device);
	                                        }
	                                    }
	                                }
	                            }

	                        }
	                    	break;
	                    default:
   						return ['code' => 5, 'mess' => 'field không tồn tại'];
	                }

	                $modelProduct->save($pro);

	                return ['code' => 1, 'mess' => 'Bạn sửa thông tin thành công ' ];
	            }else{
	                return ['code' => 3, 'mess' => 'Không được để trống dữ liệu']; 
	            }
	        } 
	    }else{
	        return ['code' => 2, 'mess' => 'Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn'];
	    }
    } 
}

function getMainColorAPI(){
	return getColor();
}
?>