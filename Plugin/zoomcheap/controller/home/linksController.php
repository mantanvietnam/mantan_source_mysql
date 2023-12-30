<?php 
function listLink($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách link cố định';

		$modelManagers = $controller->loadModel('Managers');
		$modelLinks = $controller->loadModel('Links');

		$user = $modelManagers->find()->where(['id'=>$session->read('infoUser')->id])->first();
		$session->write('infoUser',$user);

		$conditions = array('idManager'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

	    $listData = $modelLinks->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelLinks->find()->where($conditions)->all()->toList();
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

function addLink($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $price_link;

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Mua link cố định';

		$modelManagers = $controller->loadModel('Managers');
		$modelLinks = $controller->loadModel('Links');
		$modelHistories = $controller->loadModel('Histories');
		$modelOrders = $controller->loadModel('Orders');
		$modelRooms = $controller->loadModel('Rooms');

		$mess= '';
	    
	    $infoUser = $modelManagers->find()->where(['id'=>$session->read('infoUser')->id])->first();

	    if(!empty($_GET['id'])){
	        $data = $modelLinks->find()->where(['id'=>(int) $_GET['id']])->first();
	    }else{
	        $data = $modelLinks->newEmptyEntity();
	    }

	    if(empty($data->code)){
	    	$data->code = createSlugMantan(randPass(10));
	    }
	    
		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['title']) && !empty($dataSend['code'])){
	        	$dataSend['code'] = createSlugMantan($dataSend['code']);

	        	$conditions = ['code'=>$dataSend['code']];

	        	if(!empty($_GET['id'])){
	        		$conditions['id !='] = (int) $_GET['id'];
	        	}

	        	$checkLink = $modelLinks->find()->where($conditions)->first();

	        	if(empty($checkLink)){
	        		if($infoUser->coin >= $price_link || !empty($data->id)){
			        	if(empty($dataSend['goto'])) $dataSend['goto'] = 'https://app.zoomcheap.com/wait';
			        	
			        	// tạo dữ liệu save link
				        $data->title = $dataSend['title'];
				        $data->code = $dataSend['code'];
				        $data->idManager = $infoUser->id;
				        $data->goto = $dataSend['goto'];
				        $data->idOrder = (int) $dataSend['idOrder'];
				        $data->modified = time();
				        $data->created = time();
				        
				        $modelLinks->save($data);

				        if(empty($_GET['id'])){
					        // trừ tiền tài khoản
					        $infoUser->coin -= $price_link;
					        $modelManagers->save($infoUser);

					        // lưu lịch sử giao dịch
					        $dataHistories = $modelHistories->newEmptyEntity();

					        $dataHistories->time = time();
					        $dataHistories->idManager = $infoUser->id;
					        $dataHistories->numberCoin = $price_link;
					        $dataHistories->numberCoinManager = $infoUser->coin;
					        $dataHistories->type = 'minus';
					        $dataHistories->note = 'Mua link cố định';
					        $dataHistories->type_note = 'minus_link';
					        $dataHistories->modified = time();
					        $dataHistories->created = time();

					        $modelHistories->save($dataHistories);
					    }

				        return $controller->redirect('/listLink');
				    }else{
				    	$mess= '<p class="text-danger">Số dư tài khoản không đủ</p>';
				    }
			    }else{
			    	$mess= '<p class="text-danger">Mã link đã tồn tại</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
		    }
	    }

	    $session->write('infoUser',$infoUser);

	    $listOrder = $modelOrders->find()->where(['idManager'=>$session->read('infoUser')->id])->all()->toList();
	    
	    if(!empty($listOrder)){
	    	foreach ($listOrder as $key => $order) {
	    		$listOrder[$key]->room = $modelRooms->find()->where(['id'=>$order->idRoom])->first();

	    		if(!empty($listOrder[$key]->room->info)){
	    			$listOrder[$key]->room->info = json_decode($listOrder[$key]->room->info, true);
	    		}
	    		
	    	}
	    }

	    setVariable('mess', $mess);
	    setVariable('data', $data);
	    setVariable('infoUser', $infoUser);
	    setVariable('listOrder', $listOrder);
	    setVariable('price_link', $price_link);
	}else{
		return $controller->redirect('/login');
	}
}

function redirectLink($input)
{
	global $controller;

	$modelLinks = $controller->loadModel('Links');

	if(!empty($input['request']->getAttribute('params')['pass'][1])){
		$code = $input['request']->getAttribute('params')['pass'][1];

		$checkLink = $modelLinks->find()->where(['code'=>$code])->first();

		if(!empty($checkLink->goto)){
			return $controller->redirect($checkLink->goto);
		}
	}

	return $controller->redirect('https://zoomcheap.com/trang-thong-bao-mac-dinh/');
}