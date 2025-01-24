<?php 
function listSpa($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	
	$metaTitleMantan = 'Danh sách cơ sở kinh doanh';

    setVariable('page_view', 'listSpa');
	if(!empty(checkLoginManager('listSpa', 'customer'))){

		$infoUser = $session->read('infoUser');

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$conditions['id_member']= $infoUser->id_member;

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['phone'])){
			$conditions['phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['email'] = $_GET['email'];
		}

		$listData = $modelSpas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		$totalData = $modelSpas->find()->where($conditions)->all()->toList();
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
	    if(@$_GET['status']==1){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

	    }elseif(@$_GET['status']==2){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

	    }elseif(@$_GET['status']==3){

	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
	    }

		
		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    setVariable('infoUser', $infoUser);
	    setVariable('mess', $mess);
	    
	    setVariable('listData', $listData);

	}else{
		return $controller->redirect('/');
	}
} 

function addSpa($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin cơ sở kinh doanh';

    setVariable('page_view', 'addSpa');
	$modelSpas = $controller->loadModel('Spas');
	$modelWarehouse = $controller->loadModel('Warehouses');

	if(!empty(checkLoginManager('addSpa', 'customer'))){
		$infoUser = $session->read('infoUser');

		$conditions = array();
		$conditions['id_member']= $infoUser->id_member;

		$totalData = $modelSpas->find()->where($conditions)->all()->toList();
		$totalData = count($totalData);
		
		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelSpas->get( (int) $_GET['id']);

	    }else{
	    	if ($infoUser->number_spa > $totalData){ 
		        $data = $modelSpas->newEmptyEntity();
		        $data->created_at = time();
	    	}else{
	    		return $controller->redirect('/listSpa');
	    	}
	    }

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	$data->name = $dataSend['name'];
	    	$data->phone = $dataSend['phone'];
	    	$data->address = $dataSend['address'];
	    	$data->email = $dataSend['email'];
	    	$data->note = $dataSend['note'];
	    	$data->updated_at =time();
	    	$data->slug = createSlugMantan($dataSend['name']).'-'.time();
	    	$data->id_member = $infoUser->id_member;

	    	$data->facebook = $dataSend['facebook'];
			$data->website = $dataSend['website'];
			$data->zalo = $dataSend['zalo'];
			$data->image = $dataSend['image'];
	    	
	    	$modelSpas->save($data);
	    	
	    	if(!empty($_GET['id'])){
	    		return $controller->redirect('/listSpa?status=2');
	    	}else{
	    		// tạo kho mới
				$dataWarehouse = $modelWarehouse->newEmptyEntity();
				
				$dataWarehouse->name = $dataSend['address'];
				$dataWarehouse->credit = 1; // 1: cho bán âm, 0: không cho bán âm
				$dataWarehouse->id_member = $infoUser->id_member;
				$dataWarehouse->id_spa = $data->id;
				$dataWarehouse->created_at = time();
				$modelWarehouse->save($dataWarehouse);
				
	    		return $controller->redirect('/managerSelectSpa');
	    	}
	    }

	    setVariable('data', $data);
	}else{
		return $controller->redirect('/');
	}
}

function deleteSpa($input){
	global $controller;
	global $session;
    global $controller;
    global $urlCurrent;

	$modelSpas = $controller->loadModel('Spas');
	
	if(!empty(checkLoginManager('deleteSpa', 'customer'))){
		$infoUser = $session->read('infoUser');

	    if(!empty($_GET['id'])){
	        $data = $modelSpas->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$infoUser->id_member])->first();
	        
	        if($data){
	            $modelSpas->delete($data);
	        }
	    }

		return $controller->redirect('/listSpa?status=3');
	}else{
		return $controller->redirect('/');
	}
}
?>