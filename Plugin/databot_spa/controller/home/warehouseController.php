<?php 
function listWarehouse($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $user = $session->read('infoUser');
    $idspa = $session->read('idspa');
    if(!empty($user)){
    	$metaTitleMantan = 'Danh sách khách hàng mua kho';

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');

		$conditions = ['id_member'=>$user->id,'id_spa'=>$idspa];
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['warehouse_id'])){
			$conditions['warehouse_id'] = (int) $_GET['warehouse_id'];
		}

		if(!empty($_GET['name'])){
			$conditions['name'] = '%'.$_GET['warehouse_id'].'%';
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
	    $metaTitleMantan = 'Thông tin kho';


		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');

		$user = $session->read('infoUser');
		$idspa = $session->read('idspa');

		$mess= '';

		// lấy data edit

		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
		}else{
			$data = $modelWarehouses->newEmptyEntity();
		    $dataFile->created_at = date('Y-m-d H:i:s');
		}
	    
	    $infoUser = $session->read('infoUser');

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name'])){
	        	
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->id_member = $infoUser->id;
		        $data->id_spa = $idspa;
		        $data->credit = $credit;
		        $data->description = $dataSend['description'];
		       
			    $conditions = [''=>$user->id,''=>$idspa];
			        
		            $modelWarehouses->save($data);
		        }

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên kho mẫu thiết kế</p>';
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
		
		if(!empty($_GET['id'])){
			$data = $modelWarehouses->get($_GET['id']);
			$user = $session->read('infoUser');
			
			if($data && $data->id_member == $user->id){
	         	// xóa kho mẫu thiết kế
				$modelWarehouses->delete($data);
	        }
		}

		return $controller->redirect('/listWarehouse');
	}else{
		return $controller->redirect('/login');
	}
}

 ?>
