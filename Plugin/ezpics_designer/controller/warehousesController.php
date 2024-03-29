<?php 
function listWarehouse($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách kho mẫu thiết kế';

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');

		$user = $session->read('infoUser');

		$conditions = array('user_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

	    $listData = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    if(!empty($listData)){
	    	foreach ($listData as $key => $value) {
	    		$users = $modelWarehouseUsers->find()->where(['warehouse_id'=>$value->id])->all()->toList();
	    		$listData[$key]->number_user = count($users);

	    		$products = $modelWarehouseProducts->find()->where(['warehouse_id'=>$value->id])->all()->toList();
	    		$listData[$key]->number_product = count($products);
	    	}
	    }

	    $totalData = $modelWarehouses->find()->where($conditions)->all()->toList();
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

	    $mess = '';
	    if(@$_GET['mess']==1){
	    	$mess = '<p class="text-success">Để thực hiện chức năng này, bạn cần có sẵn 1.000.000 VND trong ví. Vui lòng nạp thêm tiền để hoàn thành thao tác</p>';
	    }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('mess', $mess);
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function addWarehouse($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;
	global $price_warehouses;

    if(!empty($session->read('infoUser'))){

	    $metaTitleMantan = 'Thông tin kho mẫu thiết kế';

		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelManagerFile = $controller->loadModel('ManagerFile');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelMember = $controller->loadModel('Members');
		$modelOrder = $controller->loadModel('Orders');

		$mess= '';

		$infoUser = $session->read('infoUser');

		// lấy data edit
		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
		}else{
			if($infoUser->account_balance>$price_warehouses){
				$data = $modelWarehouses->newEmptyEntity();
			}else{
				return $controller->redirect('/listWarehouse?mess=1');
			}
		}

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name']) && !empty($dataSend['price'])){
	        	if($dataSend['price']>=300000){
		        	if(!empty($data->thumbnail)){
		        		$thumbnail = $data->thumbnail;
		        	}else{
		        		$thumbnail = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
		        	}
	        		
		        	if(!empty($_FILES['thumbnail']['name']) && empty($_FILES['thumbnail']["error"])){
			            $thumbnail = uploadImageFTP($infoUser->id, 'thumbnail', $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

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
			        }

			        // tạo dữ liệu save
			        $data->name = $dataSend['name'];
			        $data->user_id = $infoUser->id;
			        $data->price = (int) $dataSend['price'];
			        $data->date_use = (int) $dataSend['date_use'];
			        $data->thumbnail = $thumbnail;
			        $data->link_open_app = '';
			        $data->keyword = $dataSend['keyword'];
			        $data->description = $dataSend['description'];

			        
			        if(empty($_GET['id'])){
				        $data->created_at = date('Y-m-d H:i:s');
				        $data->views = 0;
				        $data->status = 0;
				    }
				    $data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +365 days'));

			        // tạo slug
		            $slug = createSlugMantan($dataSend['name']);
		            $slugNew = $slug;
		            $number = 0;

		            if(empty($data->slug) || $data->slug!=$slugNew){
		                do{
		                	$conditions = array('slug'=>$slugNew);
		        			$listData = $modelWarehouses->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

		        			if(!empty($listData)){
		        				$number++;
		        				$slugNew = $slug.'-'.$number;
		        			}
		                }while (!empty($listData));
		            }

		            $data->slug = $slugNew;

			        $modelWarehouses->save($data);

			       
			        if(empty($_GET['id'])){
			        	$User = $modelMember->get($infoUser->id);
			        	$User->account_balance -= $price_warehouses;
			        	$modelMember->save($User);
			        	$session->write('infoUser', $User);

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
				        $dataWarehouseUsers->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +3650 days'));
				        
				        $modelWarehouseUsers->save($dataWarehouseUsers);
				    
				        // tạo link deep
			            $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
			            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
			                                                'link'=>'https://ezpics.page.link/warehouse?id='.$data->id,
			                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
			                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
			                                        ]
			                        ];
			            $header_deep = ['Content-Type: application/json'];
			            $typeData='raw';
			            $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
			            $deep_link = json_decode($deep_link);

			            $data->link_open_app = @$deep_link->shortLink;
			            $modelWarehouses->save($data);
			            
			            sendNotificationAdmin('64d1ca287026d948fbb45a74');
			        }

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
		    		$mess= '<p class="text-danger">Giá bán tối thiểu 300,000đ </p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên kho mẫu và giá thiết kế</p>';
		    }
	    }

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function lockWarehouse($input)
{
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		
		if(!empty($_GET['id'])){
		$data = $modelWarehouses->get($_GET['id']);
		
		if($data){
			if(!empty($_GET['status']==1)){
				$data->status = 0;
			}else{
				$data->status = 1;
			}
			$data->token = '';
         	$modelWarehouses->save($data);
        }
	}

		return $controller->redirect('/listWarehouse');
	}else{
		return $controller->redirect('/login');
	}
}

function detailWarehouse($input){
	global $urlCurrent;
	global $isRequestPost;
	global $controller;
	global $modelCategories;
	global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;

	$modelMember = $controller->loadModel('Members');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelProduct = $controller->loadModel('Products');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelOrder = $controller->loadModel('Orders');

	if(!empty($input['request']->getAttribute('params')['pass'][1])){
		$slug = explode('.html', $input['request']->getAttribute('params')['pass'][1]);
		$slug = $slug[0];
		$slug = explode('-', $slug);
		$count = count($slug)-1;
		$id = (int) $slug[$count];

		$Warehouse = $modelWarehouses->find()->where(['id'=>$id,'status'=>1])->first();
		$dataSend = $input['request']->getData();

		

		if(!empty($Warehouse)){
			if(!empty($Warehouse->name)) $metaTitleMantan = $Warehouse->name;
			if(!empty($Warehouse->thumbnail)) $metaImageMantan = $Warehouse->thumbnail;
			if(!empty($Warehouse->keyword)) $metaKeywordsMantan = $Warehouse->keyword;
			if(!empty($Warehouse->description)) $metaDescriptionMantan = $Warehouse->description;

			$designer = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();
			$limit = 20;
			$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
			if($page<1) $page = 1;
			$order = array('created_at'=>'desc');
			
			$conditions = [	'Products.user_id'=>$designer->id,  
							'Products.type'=>'user_create',
							'OR' => [
										['Products.status'=>1],
										['Products.status'=>2]
									]
						];

			if(!empty($_GET['name'])){
				$conditions['name LIKE'] = '%'.$_GET['name'].'%';
			}

			$conditions['wp.warehouse_id'] = $Warehouse->id;
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

		    $pro = $modelProduct->find()->where([	'user_id' => $designer->id, 
		    										'type'=>'user_create', 
		    										'OR' => [
		    													['status'=>1],
		    													['status'=>2]
		    												]
		    									])->all()->toList();
				
			$quantityProduct = count(@$pro);

			$order = $modelOrder->find()->where(array('member_id' => $designer->id, 'type'=>3))->all()->toList();
			$quantitySell  = count(@$order);

			$follow = $modelFollowDesigner->find()->where(array('designer_id' => $designer->id))->all()->toList();
			$quantityFollow  = count(@$follow);

			$Warehouses = $modelWarehouses->find()->where(array('user_id' => $designer->id))->all()->toList();
			$quantityWarehouse  = count(@$Warehouses);

		    setVariable('page', $page);
	    	setVariable('totalPage', $totalPage);
	    	setVariable('back', $back);
	   	 	setVariable('next', $next);
	    	setVariable('urlPage', $urlPage);
	    	setVariable('totalData', $totalData);
	    	setVariable('listData', $listData);
	    	setVariable('Warehouse', $Warehouse);
	    	setVariable('designer', $designer);

	    	setVariable('quantityProduct', $quantityProduct);
	    	setVariable('quantitySell', $quantitySell);
	    	setVariable('quantityFollow', $quantityFollow);
	    	setVariable('quantityWarehouse', $quantityWarehouse);

			
		}else{
			return $controller->redirect('https://ezpics.page.link/vn1s');
		}
	}else{
		return $controller->redirect('https://ezpics.page.link/vn1s');
	}
}

function listAllWarehouses($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProduct = $controller->loadModel('WarehouseProducts');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	
	$return = array('code'=>0);

	$dataSend = $input['request']->getData();
	$conditions = array('status'=>1, 'number_product >'=>0);
	$limit = (!empty($_GET['limit']))?(int) $_GET['limit']:20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if(!empty($_GET['name'])){
		$conditions['name LIKE']= '%'.$_GET['name'].'%';
	}

	if(!empty($_GET['order'])){
		if($_GET['order']==1){
			$order = array('price'=>'asc');	
		}elseif($_GET['order']==2){
			$order = array('price'=>'desc');
		}elseif($_GET['order']==3){
			$order = array('created_at'=>'asc');
		}elseif($_GET['order']==4){
			$order = array('created_at'=>'desc');
		}
	}else{
		$order = array('id'=>'desc');
	}

	if(!empty($_GET['price'])){
		$price = explode('-', $_GET['price']);
		$conditions['sale_price >='] = (int) $price[0];
		$conditions['sale_price <='] = (int) $price[1];
	}

			// lấy kho 
	$listData = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	$totalData = count($modelWarehouses->find()->where($conditions)->order($order)->all()->toList());

	if(!empty($listData)){
		foreach($listData as $key => $item){
			$listData[$key]->link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
	    	$users = $modelWarehouseUsers->find()->where(['warehouse_id'=>$item->id])->all()->toList();
	    	$listData[$key]->number_user = count($users);

	    	$products = $modelWarehouseProduct->find()->where(['warehouse_id'=>$item->id])->all()->toList();
	    	$listData[$key]->number_product = count($products);   	
		}
	}
		
	$totalData = $modelWarehouses->find()->where($conditions)->all()->toList();
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
}

?>