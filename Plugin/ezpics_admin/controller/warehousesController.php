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
			if(!empty($_GET['status']==1)){
				$data->status = 0;
				$dataSendNotification= array('title'=>'thông báo phê duyệt kho mẫu thiết kế','time'=>date('H:i d/m/Y'),'content'=>'kho mẫu thiết"'.$data->name.'" đã bị khóa','action'=>'adminSendNotification');
			}else{
				$data->status = 1;
				$dataSendNotification= array('title'=>'thông báo phê duyệt kho mẫu thiết kế','time'=>date('H:i d/m/Y'),'content'=>'kho mẫu thiết"'.$data->name.'" đã được phê duyệt','action'=>'adminSendNotification');
			}
         	$modelWarehouses->save($data);
         	
		     $user = $modelMembers->find()->where(array('id'=>$data->user_id))->first();	
            if(!empty($user->token_device)){
               sendNotification($dataSendNotification, $user->token_device);
            }
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseAdmin.php');
}

?>
