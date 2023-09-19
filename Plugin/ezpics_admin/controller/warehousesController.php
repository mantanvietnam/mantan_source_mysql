<?php 
function listWarehouseAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách kho mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');
	//if(!isset($_GET['status'])) $_GET['status'] = 1;

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
	}

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}

    $listData = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMembers->get($value->user_id);
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

function detailWarehouse($input){
	global $urlCurrent;
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelProduct = $controller->loadModel('Products');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelOrder = $controller->loadModel('Orders');

	if(!empty($input['request']->getAttribute('params')['pass'][1])){
		$slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
		$slug = explode('-', $slug);
		$count = count($slug)-1;
		$id = (int) $slug[$count];

		$Warehouse = $modelWarehouses->find()->where(['id'=>$id])->first();
		$dataSend = $input['request']->getData();

		$designer = $modelMember->find()->where(array('id'=>$Warehouse->user_id))->first();

		if(!empty($Warehouse)){
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

function lockWarehouse($input){
	global $controller;
	global $session;

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelMembers = $controller->loadModel('Members');
		
	if(!empty($_GET['id'])){
		$data = $modelWarehouses->get($_GET['id']);
		
		if($data){
			if($_GET['status']==0){
				$data->status = 0;
				$dataSendNotification= array('title'=>'Thông báo phê duyệt kho mẫu thiết kế','time'=>date('H:i d/m/Y'),'content'=>'Kho mẫu thiết"'.$data->name.'" đã bị khóa nội dung là: '.$_GET['note'].'.','action'=>'adminSendNotification');
			}else{
				$data->status = 1;
				$dataSendNotification= array('title'=>'Thông báo phê duyệt kho mẫu thiết kế','time'=>date('H:i d/m/Y'),'content'=>'Kho mẫu thiết"'.$data->name.'" đã được  phê duyệt','action'=>'adminSendNotification');
			}
         	$modelWarehouses->save($data);
         	
		     $user = $modelMembers->find()->where(array('id'=>$data->user_id))->first();	
            if(!empty($user->token_device)){
               sendNotification($dataSendNotification, $user->token_device);
            }
            if(!empty($user->email)){
            	sendEmailLockWarehouse($user->email,$user->name,$data->name,$_GET['status'],@$_GET['note']);
            }
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseAdmin.php');
}

function listWarehouseTrendAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách xu hướng kho mẫu	 thiết kế';

	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelMember = $controller->loadModel('Members');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['type'])){
		$conditions['type'] = $_GET['type'];
	}

	
		$conditions['status'] = 1;
		

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

	

	$conditions['trend'] = 1;

    $listData = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMember->get($value->user_id);
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
	if(isset($_GET['mess'])){
		if(@$_GET['mess']==0){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Bỏ mẫu thiết kế thành công</p>';
	    }elseif(@$_GET['mess']==1){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mẫu thiết kế thành công</p>';
	    }elseif(@$_GET['mess']==2){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sản phẩm này chưa được duyệt</p>';
	    }
	}

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('mess', $mess);
}

function addTrendWarehouseAdmin($input)
{
	global $controller;

	$modelWarehouses = $controller->loadModel('Warehouses');
	
	if(!empty($_GET['id'])){
		$data = $modelWarehouses->find()->where(array('id'=>$_GET['id'],'status'=>1))->first();
		if($data){
			if(isset($_GET['status'])){
				$data->trend =$_GET['status'];
         		$modelWarehouses->save($data);

         		if(!empty($_GET['page'])){
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseTrendAdmin.php?mess='.$_GET['status'].'&page='.$_GET['page']);
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseTrendAdmin.php?mess='.$_GET['status']);
				}
        	}
        }else{
        	if(!empty($_GET['page'])){
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-warehouses-listWarehouseTrendAdmin.php?mess=2page='.$_GET['page']);
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseTrendAdmin.php?mess=2');
				}
        }
	}	
}

function addWarehouseAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;


	$metaTitleMantan = 'Thông tin kho mẫu thiết kế';

		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelManagerFile = $controller->loadModel('ManagerFile');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelMember = $controller->loadModel('Members');
		$modelOrder = $controller->loadModel('Orders');

		$mess= '';
		if ($isRequestPost){
	        $dataSend = $input['request']->getData();
	        $user = $modelMember->find()->where(array('phone'=>$dataSend['user']))->first();

	        if(!empty($user)){
	        	if ($user->account_balance>$dataSend['price_creates']){
			        if(!empty($dataSend['name'])){
			        	$data = $modelWarehouses->newEmptyEntity();
			        	if(!empty($data->thumbnail)){
			        		$thumbnail = $data->thumbnail;
			        	}else{
			        		$thumbnail = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
			        	}
		        		
			        	if(!empty($_FILES['thumbnail']['name']) && empty($_FILES['thumbnail']["error"])){
				            $thumbnail = uploadImageFTP($user->id, 'thumbnail', $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

				            if(!empty($thumbnail['linkOnline'])){
				                $thumbnail = $thumbnail['linkOnline'];

				                // lưu vào database file
				                $dataFile = $modelManagerFile->newEmptyEntity();

				                $dataFile->link = $thumbnail;
				                $dataFile->user_id = $user->id;
				                $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
				                $dataFile->created_at = date('Y-m-d H:i:s');

				                $modelManagerFile->save($dataFile);
				            }
				        }

				        // tạo dữ liệu save
				        $data->name = $dataSend['name'];
				        $data->user_id = $user->id;
				        $data->price = (int) $dataSend['price'];
				        $data->date_use = (int) $dataSend['date_use'];
				        $data->thumbnail = $thumbnail;
				        $data->link_open_app = '';
				        $data->keyword = $dataSend['keyword'];
				        $data->description = $dataSend['description'];
				        $data->created_at = date('Y-m-d H:i:s');
					    $data->views = 0;
					    $data->status = 0;
		            	$data->slug = createSlugMantan($dataSend['name']);
		            	$data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +365 days'));
		            	
			        	$modelWarehouses->save($data);

				       
				        if($dataSend['price_creates']>0){
				        	$user->account_balance -= $dataSend['price_creates'];
				        	$modelMember->save($user);

				        	$order = $modelOrder->newEmptyEntity();
							$order->code = 'W'.time().$user->id.rand(0,10000);
							$order->member_id = $user->id;
							$order->product_id = (int) $data->id; // id kho mẫu
							$order->total = $dataSend['price_creates'];
							$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
							$order->type = 10; //0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 8: bán kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho
							$order->meta_payment = 'Tạo kho mẫu thiết kế ID '.$data->id;
							$order->created_at = date('Y-m-d H:i:s');
							$modelOrder->save($order);
						}

			        	// tự thêm tác giả vào kho
			        	$dataWarehouseUsers = $modelWarehouseUsers->newEmptyEntity();
				        $dataWarehouseUsers->warehouse_id = (int) $data->id;
				        $dataWarehouseUsers->user_id = $user->id;
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
				            

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Bạn chưa nhập tên kho mẫu thiết kế</p>';
			    }
			}
		}else{
			$mess= '<p class="text-danger">Tài khoản này không tồn tại</p>';
		}
    }

    setVariable('data', @$data);
	setVariable('mess', $mess);
	
}

function Warehousesdeadline(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách kho mẫu thiết kế';

	$modelWarehouses = $controller->loadModel('Warehouses');

	$listData = $modelWarehouses->find()->where()->all()->toList();

	if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$value->deadline_at = date('Y-m-d H:i:s', strtotime($value->created_at . ' +365 days'));
 debug($value);
    		$modelWarehouses->save($value);
    	}
    }
    debug('ok');
    die;


}

function searchMemberApi($input)
{
	global $controller;
	global $session;

		$modelMember = $controller->loadModel('Members');
            $conditions['phone LIKE'] =  '%'.$_GET['key'].'%';
          
            $order = array('name' => 'asc');

            $listData = $modelMember->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->phone,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'phone'=>$data->phone,
                    				'account_balance'=>$data->account_balance,
                    			);
                }
            }
        
	

	return $return;
}

?>
