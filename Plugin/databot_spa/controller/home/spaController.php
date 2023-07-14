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
	$infoUser = $session->read('infoUser');



	if(!empty($infoUser)){

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		

		$conditions['id_member']= $infoUser->id;

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
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


	    $listOrders = $modelSpas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

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
		return $controller->redirect('/login');
	}
} 

function addSpa($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

	$modelSpas = $controller->loadModel('Spas');
	$infoUser = $session->read('infoUser');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$conditions = array();
	$conditions['id_member']= $infoUser->id;

	$totalData = $modelSpas->find()->where($conditions)->all()->toList();
	$totalData = count($totalData);

	if(!empty($infoUser)){


		 // lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelSpas->get( (int) $_GET['id']);

	    }else{
	    	if ($infoUser->number_spa > $totalData){ 
		        $data = $modelSpas->newEmptyEntity();
		        $data->created_at = date('Y-m-d H:i:s');
		        $data->id_member = $infoUser->id;
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
	    	$data->updated_at =date('Y-m-d H:i:s');
	    	$data->slug = createSlugMantan($dataSend['name']);
	    	$modelSpas->save($data);
	    	if(!empty($_GET['id'])){
	    		return $controller->redirect('/listSpa?status=2');
	    	}else{
	    		$checkspa = $modelSpas->find()->where(array('phone'=>$data->phone, 'name'=>$data->name, 'id_member' => $infoUser->id, 'address'=>$data->address ))->first();
						if($checkspa){
							$dataWarehouse = $modelWarehouse->newEmptyEntity();
							$dataWarehouse->name = $dataSend['address'];
							$dataWarehouse->credit = 1;
							$dataWarehouse->id_member = $infoUser->id;
							$dataWarehouse->id_spa = $checkspa->id;
							$dataWarehouse->created_at = date('Y-m-d H:i:s');
							$modelWarehouse->save($dataWarehouse);
						}

	    		return $controller->redirect('/managerSelectSpa');
	    	}



	    }


	    setVariable('data', $data);

	    
	}else{
		return $controller->redirect('/login');
	}

}

function deleteSpa($input){
	global $controller;
	global $session;
    global $controller;
    global $urlCurrent;

	$modelSpas = $controller->loadModel('Spas');
	$infoUser = $session->read('infoUser');

	$conditions = array();
	$conditions['id_member']= $infoUser->id;

	$totalData = $modelSpas->find()->where($conditions)->all()->toList();
	$totalData = count($totalData);

	if(!empty($infoUser)){
	    if(!empty($_GET['id'])){
	        $data = $modelSpas->get($_GET['id']);
	        
	        if($data){
	            $modelSpas->delete($data);
	        }
	    }
		return $controller->redirect('/listSpa?status=3');
	}else{
		return $controller->redirect('/login');
	}
}

?>