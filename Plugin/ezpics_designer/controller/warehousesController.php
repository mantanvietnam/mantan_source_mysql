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
	    		$users = $modelWarehouseUsers->find()->where(['warehouses_id'=>$value->id])->all()->toList();
	    		$listData[$key]->number_user = count($users);
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

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thông tin kho mẫu thiết kế';

		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelManagerFile = $controller->loadModel('ManagerFile');
		$mess= '';

		// lấy data edit

		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
		}else{
			$data = $modelWarehouses->newEmptyEntity();
		}
	    
	    $infoUser = $session->read('infoUser');

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name'])){
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
		        $data->thumbnail = $thumbnail;
		        $data->link_open_app = '';
		        $data->keyword = $dataSend['keyword'];
		        $data->description = $dataSend['description'];
		        
		        if(empty($_GET['id'])){
			        $data->created_at = date('Y-m-d H:i:s');
			        $data->views = 0;
			    }

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

		        /*
		        // tạo link deep
	            $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
	            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
	                                                'link'=>'https://ezpics.page.link/detailProduct?id='.$data->id,
	                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
	                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
	                                        ]
	                        ];
	            $header_deep = ['Content-Type: application/json'];
	            $typeData='raw';
	            $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
	            $deep_link = json_decode($deep_link);

	            $data->link_open_app = @$deep_link->shortLink;
	            $modelProduct->save($data);
	        	*/

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên kho mẫu thiết kế</p>';
		    }
	    }

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function deleteWarehouse($input)
{
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		
		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
			$user = $session->read('infoUser');
			
			if($data && $data->user_id == $user->id){
	         	// xóa kho mẫu thiết kế
				$modelWarehouses->delete($data);

				// xóa danh sách user mua kho
				$conditions = ['warehouses_id'=>$data->id];
				$modelWarehouseUsers->deleteAll($conditions);
	        }
		}

		return $controller->redirect('/listWarehouse');
	}else{
		return $controller->redirect('/login');
	}
}
