<?php 
function fixCategoryProduct($input)
{	
	/*
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	$modelProductCategory = $controller->loadModel('ProductCategory');

	$listProducts = $modelProduct->find()->all()->toList();

	foreach ($listProducts as $key => $value) {
		$conditions = ['product_id'=>$value->id];
		$category = $modelProductCategory->find()->where($conditions)->first();
		$value->category_id = $category->category_id;
		$modelProduct->save($value);
	}
	*/
}

function getNewProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$dataSend = $input['request']->getData();

	$conditions = array('status'=>1, 'type'=>'user_create');
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:8;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('id'=>'desc');

	$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			if(!empty($value->thumbnail)){
				$listData[$key]->image = $value->thumbnail;
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

	$dataSend = $input['request']->getData();

	$conditions = array('status'=>1, 'type'=>'user_create');
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
		$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
	}

	if(!empty($dataSend['category_id'])){
		$conditions['category_id'] = (int) $dataSend['category_id'];
	}

	if(!empty($dataSend['price'])){
		$price = explode('-', $dataSend['price']);
		$conditions['sale_price >='] = (int) $price[0];
		$conditions['sale_price <='] = (int) $price[1];
	}

	$listProduct = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listProduct)){
		foreach ($listProduct as $key => $value) {
			if(!empty($value->thumbnail)){
				$listProduct[$key]->image = $value->thumbnail;
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
	$modelProductCategory = $controller->loadModel('ProductCategory');

	$dataSend = $input['request']->getData();
	$listProduct = [];

	if(!empty($dataSend['category_id'])){
		$conditions = array('status'=>1, 'type'=>'user_create','category_id'=>(int) $dataSend['category_id']);
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
				if(!empty($value->thumbnail)){
					$listProduct[$key]->image = $value->thumbnail;
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
	$modelProductCategory = $controller->loadModel('ProductCategory');

	// lấy tất cả danh mục thiết kế
	$conditions = array('type'=>'product_categories');
	$order = array('id'=>'desc');

	$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();
	$listProductCategory = [];

	if(!empty($listCategory)){
		foreach ($listCategory as $category) {
			// lấy tất cả sản phẩm trong danh mục
			$dataSend = $input['request']->getData();

			$conditions = array('status'=>1, 'category_id'=>$category->id, 'type'=>'user_create');
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
					if(!empty($value->thumbnail)){
						$listProduct[$key]->image = $value->thumbnail;
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

	$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'type'=>'user_create', 'status'=>1);
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('views'=>'desc', 'favorites'=>'desc', 'id'=>'desc');

	$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			$infoUser = $modelMember->find()->where(['id'=>(int) $value->user_id])->first();

			$listData[$key]->author = @$infoUser->name;

			if(!empty($value->thumbnail)){
				$listData[$key]->image = $value->thumbnail;
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

	$dataSend = $input['request']->getData();
	$data = $modelProduct->newEmptyEntity();
	$otherData = [];

	if(!empty($dataSend['id'])){
		$data = $modelProduct->find()->where(['id'=>(int) $dataSend['id']])->first();

		if(!empty($data)){
			$data->views ++;
			$modelProduct->save($data);

			$infoUser = $modelMember->find()->where(['id'=>(int) $data->user_id])->first();
			$data->author = @$infoUser->name;

			if(!empty($data->thumbnail)){
				$data->image = $data->thumbnail;
			}

			if($data->type == 'user_create'){
				$data->link_share = 'https://designer.ezpics.vn/detail/'.$data->slug.'-'.$data->id.'.html';
			}else{
				$data->link_share = $data->image;
			}

			$conditions = ['category_id'=>$data->category_id, 'id !='=>$data->id];
			$limit= 12;
			$page= 1;
			$order = array();
			$otherData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			if(!empty($otherData)){
				foreach ($otherData as $key => $value) {
					if(!empty($value->thumbnail)){
						$otherData[$key]->image = $value->thumbnail;
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

	            return createNewProduct($infoUser, $name, $price, $sale_price, $type, $category_id);
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

function buyProductAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');

	$dataSend = $input['request']->getData();

	$return = array('code'=>1,
					'messages'=>array(array('text'=>''))
					);
	
	if($isRequestPost){
		if(!empty($dataSend['id']) && !empty($dataSend['token'])){
			$product = $modelProduct->find()->where(['id'=>(int) $dataSend['id']])->first();

			if(!empty($product)){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
				$infoUserSell = $modelMember->find()->where(array('id'=>$product->user_id))->first();

				if(!empty($infoUser->account_balance) && $infoUser->account_balance>=$product->sale_price){
					$checkOrder = $modelOrder->find()->where(array('member_id'=>$infoUser->id, 'product_id'=>$product->id))->first();

					if(empty($checkOrder)){
						// trừ tiền tài khoản
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
	                    $order->total = $product->sale_price;
	                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
	                    $order->type = 3; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
	                    $order->meta_payment = 'Bán mẫu thiết kế ID '.$product->id;
	                    $order->created_at = date('Y-m-d H:i:s');
	                    $modelOrder->save($order);

	                    // gửi thông báo về app cho người bán
                        $dataSendNotification= array('title'=>'Bán mẫu thiết kế trên Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Có khách hàng mua mẫu thiết kế '.$product->name.'của bạn với số tiền là '.number_format($product->sale_price).'đ','action'=>'addMoneySuccess');

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

	                    $modelProduct->save($newproduct);

	                    // sao chép layer
	                    $detail = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();

	                    if(!empty($detail)){
		                    foreach($detail as $d){
		                    	$newLayer = $modelProductDetail->newEmptyEntity();	

		                    	$newLayer->products_id = $newproduct->id;
		                    	$newLayer->name = $d->name;
		                    	$newLayer->content = $d->content;
		                    	$newLayer->wight = $d->wight;
		                    	$newLayer->height = $d->height;
		                    	$newLayer->sort = $d->sort;
		                    	$newLayer->postion_x = $d->postion_x;
		                    	$newLayer->postion_y = $d->postion_y;
		                    	$newLayer->type = $d->type;
		                    	$newLayer->status = $d->status;
		                    	$newLayer->banner = $d->banner;
		                    	$newLayer->created_at = $d->created_at;
		                    	$newLayer->updated_at = $d->updated_at;
		                    	$newLayer->text = $d->text;
		                    	$newLayer->size = $d->size;
		                    	$newLayer->font = $d->font;
		                    	$newLayer->color = $d->color;
		                    	$newLayer->gachchan = $d->gachchan;
		                    	$newLayer->innghieng = $d->innghieng;
		                    	$newLayer->gianchu = $d->gianchu;
		                    	$newLayer->brightness = $d->brightness;
		                    	$newLayer->contrast = $d->contrast;
		                    	$newLayer->saturate = $d->saturate;
		                    	$newLayer->sepia = $d->sepia;
		                    	$newLayer->invert = $d->sepinvertia;
		                    	$newLayer->grayscale = $d->grayscale;
		                    	$newLayer->blur = $d->blur;
		                    	$newLayer->vien = $d->vien;
		                    	$newLayer->opacity = $d->opacity;
		                    	$newLayer->linear_position = $d->linear_position;
		                    	$newLayer->gradient_color1 = $d->gradient_color1;
		                    	$newLayer->gradient_color2 = $d->gradient_color2;
		                    	$newLayer->gradient = $d->gradient;
		                    	$newLayer->rotate = $d->rotate;
		                    	$newLayer->deleted_at = $d->deleted_at;
		                        
		                        $modelProductDetail->save($newLayer);
		                    }
		                }

	                    $return = array('code'=>0,
	                    				'product_id'=>$newproduct->id,
										'messages'=>array(array('text'=>'Mua thành công'))
										);
	                }else{
	                	$return = array('code'=>5,
										'messages'=>array(array('text'=>'Bạn đã mua sản phẩm này'))
										);
	                }
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
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				if(!empty($listData)){
					foreach ($listData as $key => $value) {
						if(!empty($value->thumbnail)){
							$listData[$key]->image = $value->thumbnail;
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
	$return = array('listData'=>[]);

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
						if(!empty($value->thumbnail)){
							$listData[$key]->image = $value->thumbnail;
						}
					}
				}

				$return = array('listData'=>$listData);
			}
		}
	}

	return 	$return;
}