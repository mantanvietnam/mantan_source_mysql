<?php 
function listWarehouse($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách kho hàng';
    setVariable('page_view', 'listWarehouse');
    if(!empty(checkLoginManager('listWarehouse', 'product'))){
    	$user = $session->read('infoUser');

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');

		$mess= '';
        
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestWarehouset':
                    $mess= '<p class="text-danger">Bạn cần tạo kho trước</p>';
                    break;
                case 'requestDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa Kho này</p>';
                    break;
                case 'requestDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }

		$conditions = ['id_member'=>$user->id_member,'id_spa'=>$user->id_spa];
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['warehouse_id'])){
			$conditions['warehouse_id'] = (int) $_GET['warehouse_id'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

	    $listData = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

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

	    $mess= '';
        
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestWarehouse':
                    $mess= '<p class="text-danger">Bạn cần tạo kho trước</p>';
                    break;
            }
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
    	return $controller->redirect('/');
    }

}

function addWarehouse($input)
{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;

	$metaTitleMantan = 'Thông tin kho';

    setVariable('page_view', 'addWarehouse');
    if(!empty(checkLoginManager('addWarehouse', 'product'))){

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');

		$mess= '';

		// lấy data edit
		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
		}else{
			$data = $modelWarehouses->newEmptyEntity();
		    $data->created_at = time();
		}
	    
	    $infoUser = $session->read('infoUser');

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name'])){
	        	
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->id_member = (int) $infoUser->id_member;
		        $data->id_spa = (int)$session->read('id_spa');
		        $data->description = $dataSend['description'];

			    $modelWarehouses->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên kho mẫu thiết kế</p>';
		    }
		}
		
		setVariable('data', $data);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

function deleteWarehouse($input)
{
	global $controller;
	global $session;

    setVariable('page_view', 'deleteWarehouse');
	if(!empty(checkLoginManager('deleteWarehouse', 'product'))){
		$modelWarehouses = $controller->loadModel('Warehouses');
		$modelWarehouseProducts = $controller->loadModel('WarehouseProductDetails');
		
		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
			$user = $session->read('infoUser');

			$checkWarehouseProducts = $modelWarehouseProducts->find()->where(array('id_warehouse'=>$data->id,'id_member'=>$user->id_member))->all()->toList();

			 if(!empty($checkWarehouseProducts)){
                return $controller->redirect('/listWarehouse?error=requestDelete');

            }
			
			if($data && $data->id_member == $user->id_member){
	         	// xóa kho 
				$modelWarehouses->delete($data);
				return $controller->redirect('/listWarehouse?error=requestDeleteSuccess');
	        }
		}

		return $controller->redirect('/listWarehouse');
	}else{
		return $controller->redirect('/');
	}
}
?>