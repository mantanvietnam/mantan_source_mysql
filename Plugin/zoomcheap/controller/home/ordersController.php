<?php 
function listOrder($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách đơn hàng';

		$modelManagers = $controller->loadModel('Managers');
		$modelOrders = $controller->loadModel('Orders');

		$user = $session->read('infoUser');

		$conditions = array('idManager'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['type'])){
			$conditions['type'] = (int) $_GET['type'];
		}

	    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
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

function addOrder($input)
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
	    $metaTitleMantan = 'Thuê tài khoản Zoom';

		$modelManagers = $controller->loadModel('Managers');
		$modelOrders = $controller->loadModel('Orders');
		$modelZooms = $controller->loadModel('Zooms');
		$modelPrices = $controller->loadModel('Prices');
		$modelHistories = $controller->loadModel('Histories');

		$mess= '';
	    
	    $infoUser = $modelManagers->find()->where(['id'=>$session->read('infoUser')->id])->first();
	    

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['type']) && !empty($dataSend['id_price'])){
	        	$checkZoom = $modelZooms->find()->where(['type'=>(int) $dataSend['type'], 'status'=>'active', 'idOrder'=>0])->first();

	        	if(!empty($checkZoom)){
	        		$checkPrice = $modelPrices->find()->where(['id'=> (int) $dataSend['id_price']])->first();

	        		if(!empty($checkPrice)){
	        			if($infoUser->coin >= $checkPrice->price){
				        	$data = $modelOrders->newEmptyEntity();

					        // tạo dữ liệu save order
					        $data->numberHour = (int) $checkPrice->hour;
					        $data->dateStart = time();
					        $data->dateEnd = time() + $data->numberHour * 60 * 60;
					        $data->price = (int) $checkPrice->price;
					        $data->idManager = $infoUser->id;
					        $data->type = (int) $dataSend['type'];
					        $data->extend_time_use = (int) $dataSend['extend_time_use'];
					        $data->modified = time();
					        $data->created = time();
					        $data->idZoom = $checkZoom->id;
					        
					        $modelOrders->save($data);

					        // cập nhập tài khoản zoom
					        $checkZoom->idOrder = $data->id;
					        $modelZooms->save($checkZoom);

					        // trừ tiền tài khoản
					        $infoUser->coin -= $checkPrice->price;
					        $modelManagers->save($infoUser);

					        // lưu lịch sử giao dịch
					        $dataHistories = $modelHistories->newEmptyEntity();

					        $dataHistories->time = time();
					        $dataHistories->idManager = $infoUser->id;
					        $dataHistories->numberCoin = $checkPrice->price;
					        $dataHistories->numberCoinManager = $infoUser->coin;
					        $dataHistories->type = 'minus';
					        $dataHistories->note = 'Thuê Zoom '.$dataSend['type'];
					        $dataHistories->type_note = 'minus_order';
					        $dataHistories->modified = time();
					        $dataHistories->created = time();

					        $modelHistories->save($dataHistories);

					        return $controller->redirect('/listOrder');
					    }else{
					    	$mess= '<p class="text-danger">Số dư tài khoản không đủ</p>';
					    }
				    }else{
				    	$mess= '<p class="text-danger">Thời gian bạn thuê không đúng</p>';
				    }
			    }else{
			    	$mess= '<p class="text-danger">Hệ thống đã hết tài khoản Zoom loại '.$dataSend['type'].'</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa chọn loại Zoom</p>';
		    }
	    }

	    $session->write('infoUser',$infoUser);

	    $listPrices = $modelPrices->find()->where()->all()->toList();

	    setVariable('mess', $mess);
	    setVariable('listPrices', $listPrices);
	    setVariable('infoUser', $infoUser);
	}else{
		return $controller->redirect('/login');
	}
}