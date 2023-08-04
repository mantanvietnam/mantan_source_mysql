<?php 
function listWarehouseUser($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách khách hàng mua kho mẫu thiết kế';

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');

		$user = $session->read('infoUser');

		$conditions = ['designer_id'=>$user->id];
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['warehouse_id'])){
			$conditions['warehouse_id'] = (int) $_GET['warehouse_id'];
		}

		if(!empty($_GET['phone'])){
			$_GET['phone']= str_replace(array(' ','.','-'), '', @$_GET['phone']);
			$_GET['phone'] = str_replace('+84','0',$_GET['phone']);

			$infoUserSearch = $modelMembers->find()->where(['phone'=>$_GET['phone']])->first();

			if(!empty($infoUserSearch)){
				$conditions['user_id'] = $infoUserSearch->id;
			}else{
				$conditions['user_id'] = -1;
			}
		}

	    $listData = $modelWarehouseUsers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	   

	    if(!empty($listData)){
	    	foreach ($listData as $key => $value) {
	    		$listData[$key]->infoUser = $modelMembers->find()->where(['id'=>$value->user_id])->first();
	    		$listData[$key]->infoWarehouse = $modelWarehouses->find()->where(['id'=>$value->warehouse_id])->first();
	    	}
	    }

	    $totalData = $modelWarehouseUsers->find()->where($conditions)->all()->toList();
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

	    $conditions = array('user_id'=>$user->id);
		$order = array('name'=>'asc');
		$listWarehouse = $modelWarehouses->find()->where($conditions)->order($order)->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('listWarehouse', $listWarehouse);
	}else{
		return $controller->redirect('/login');
	}
}

function addWarehouseUser($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thêm khách hàng vào kho mẫu thiết kế';

		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelMembers = $controller->loadModel('Members');
		$modelOrder = $controller->loadModel('Orders');

		$mess= '';
	    
	    $infoUser = $session->read('infoUser');

	    $data = $modelWarehouseUsers->newEmptyEntity();

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['phone'])){
	        	$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone']);
	    		$info_customer = $modelMembers->find()->where($conditions)->first();

	    		if(!empty($info_customer)){
	    			$conditions = array('user_id'=>$info_customer->id, 'warehouse_id'=>$dataSend['warehouse_id']);
	    			$checkOrder = $modelWarehouseUsers->find()->where($conditions)->first();

	    			if(empty($checkOrder)){
		    			$dataSend['price'] = (int) $dataSend['price'];
		    			$dataSend['date_use'] = (int) $dataSend['date_use'];

	    				// tạo dữ liệu save
				        $data->warehouse_id = (int) $dataSend['warehouse_id'];
				        $data->user_id = @$info_customer->id;
				        $data->designer_id = @$infoUser->id;
				        $data->price = @$dataSend['price'];
				        $data->created_at = date('Y-m-d H:i:s');
				        $data->note = @$dataSend['note'];
				        $data->deadline_at = date('Y-m-d H:i:s', strtotime($data->created_at . ' +'.$dataSend['date_use'].' days'));
				        
				        $modelWarehouseUsers->save($data);

				        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
				    }else{
				    	$mess= '<p class="text-danger">Khách hàng này đã mua kho mẫu thiết kế của bạn</p>';
				    }
			    }else{
			    	$mess= '<p class="text-danger">Không tồn tại tài khoản khách hàng</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên kho mẫu thiết kế</p>';
		    }
	    }

	    $conditions = array('user_id'=>$infoUser->id);
		$order = array('name'=>'asc');
		$listWarehouses = $modelWarehouses->find()->where($conditions)->order($order)->all()->toList();

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listWarehouses', $listWarehouses);
	}else{
		return $controller->redirect('/login');
	}
}

function deleteWarehouseUser($input)
{
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
		$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
		$modelWarehouses = $controller->loadModel('Warehouses');
		
		if(!empty($_GET['id'])){
			$data = $modelWarehouseUsers->find()->where(['id'=>$_GET['id']])->first();

			$user = $session->read('infoUser');

			if(!empty($data) && $user->id == $data->designer_id){
				// xóa khách hàng mua kho mẫu thiết kế
				$modelWarehouseUsers->delete($data);
			}
		}

		return $controller->redirect('/listWarehouseUser/?warehouse_id='.$data->warehouse_id);
	}else{
		return $controller->redirect('/login');
	}
}