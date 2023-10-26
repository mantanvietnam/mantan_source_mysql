<?php 
// Danh sách giao dịch nạp tiền
function listTransactionHistoryBankingEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch nạp tiền';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');

	$conditions = array('type'=>1);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}


	if(isset($_GET['payment_kind'])){
		if($_GET['payment_kind']!=''){
			$conditions['payment_kind'] = (int) $_GET['payment_kind'];
		}
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


    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }

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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch mua mẫu thiết kế
function listTransactionHistoryBuyProductEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch mua mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array('type'=>0);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['product_id'])){
		$conditions['product_id'] = $_GET['product_id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		$listData[$key]->product = $modelProducts->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch rút tiền
function listTransactionHistoryWithdrawMoneyEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch rút tiền';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');

	$conditions = array('type'=>2);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    if(@$_GET['mess']==1){
    	$mess = '<span class="text-success">Đã xử lý giao dịch thành công</span>';
    }
    if(@$_GET['mess']==2){
    	$mess = '<span class="text-success">Tài khoản này không đủ tiền</span>';
    } 
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
    setVariable('mess', $mess);
}

//Danh sách giao dịch bán mẫu thiết kế
function listTransactionHistorySellingDesignsEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch bán mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array('type'=>3);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['product_id'])){
		$conditions['product_id'] = $_GET['product_id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		$listData[$key]->product = $modelProducts->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch Xóa ảnh nền
function listTransactionHistoryRemoveImageEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch Xóa ảnh nền';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array('type'=>4);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		//$listData[$key]->product = $modelProducts->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch chiết khấu mẫu thiết kế
function listTransactionHistoryDiscountProductEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch chiết khấu mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array('type'=>5);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	$conditions['member_id'] = 0;

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		
    		$product = $modelProducts->find()->where(['id'=>$value->product_id])->first();
    		if(!empty($product)){
    			$listData[$key]->member = $modelMembers->get($product->user_id);
    			$listData[$key]->product = $product;
    		}
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch mua kho mẫu thiết kế
function listTransactionHistoryBuyWarehouseEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch mua kho mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelWarehouses = $controller->loadModel('Warehouses');

	$conditions = array('type'=>7);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		$listData[$key]->warehouses = $modelWarehouses->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch bán kho mẫu thiết kế
function listTransactionHistorySellingWarehouseEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch bán kho mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelWarehouses = $controller->loadModel('Warehouses');

	$conditions = array('type'=>8);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		$listData[$key]->warehouses = $modelWarehouses->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

function transactioncMoneyEzpics($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');

	if(!empty($_GET['id'])){
		$data = $modelOrders->find()->where(array('id'=>$_GET['id'], 'type'=> 2))->first();
		if(!empty($data)){
			$member = $modelMembers->find()->where(array('id'=>$data->member_id))->first();
			if(!empty($member)){
				if($member->sellingMoney >= $data->total){
					$member->account_balance = $member->account_balance -  $data->total;
					$member->sellingMoney = $member->sellingMoney -  $data->total;
					$data->status = 2;
					$modelMembers->save($member);
					$modelOrders->save($data);

					 $dataSendNotification= array('title'=>'Bạn đã rút tiền thành công','time'=>date('H:i d/m/Y'),'content'=>'Số tiền bạn rút là: '.number_format($data->total).'VNĐ','action'=>'productNew');
					 if(!empty($member->token_device)){
                		sendNotification($dataSendNotification, $member->token_device);
            		}
            		if(!empty($member->email)){
            		 	sendEmailtransactioncMoney($member->email, $member->name, $data);
            		}

            		if(!empty($_GET['page'])){
						return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics.php?mess=1&page='.$_GET['page']);
					}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics.php?mess=1');
					}
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics.php?mess=2');
				}
			}
		}
	}
	if(!empty($_GET['page'])){
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics.php?page='.$_GET['page']);
	}else{
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics.php');
	}
}

function confirmReceiptMoneyEzpics($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $recommenders;

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');

	if(!empty($_GET['id'])){
		$data = $modelOrders->find()->where(array('id'=>$_GET['id'], 'type'=>1))->first();

		if(!empty($data)){
			$member = $modelMembers->find()->where(array('id'=>$data->member_id))->first();
			if(!empty($member)){
					$member->account_balance = $member->account_balance +  $data->total;
					$data->status = 2;
					$modelMembers->save($member);
					$modelOrders->save($data);



					 $dataSendNotification= array('title'=>'Nạp tiền thành công Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Nạp thành công '.number_format($data->total).'đ vào tài khoản ','action'=>'addMoneySuccess');
					 if(!empty($member->token_device)){
                		sendNotification($dataSendNotification, $member->token_device);
            		}
            		if(!empty($member->email)){
            		 	sendEmailAddMoney($member->email, $member->name, $data->total);
            		}

            		// Cộng tiền cho thằng giới thiệu 
		            if(!empty($member->affsource)){
		                $User = $modelMembers->find()->where(array('id'=>$member->affsource))->first();
		       	        if(!empty($User)){
		                    $User->account_balance += ((int) $recommenders / 100) * $data->total;
		                    $modelMembers->save($User);

		                    $order = $modelOrders->newEmptyEntity();
		                    $order->code = 'W'.time().$User->id.rand(0,10000);
		                    $order->member_id = $User->id;
		                    $order->total = ((int) $recommenders / 100) * $data->total;
		                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                    $order->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
		                    $order->meta_payment = 'Bạn được công tiền hoa hồng giới thiệu';
		                    $order->created_at = date('Y-m-d H:i:s');

		                    $modelOrders->save($order);

		                    // gửi thông báo về app
		                    $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng giới thiệu','time'=>date('H:i d/m/Y'),'content'=>'- '.$User->name.' ơi. Bạn được cộng '.number_format($order->total).' VND do thành viên '.$member->name.' đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

		                    if(!empty($User->token_device)){
		                        sendNotification($dataSendNotification, $User->token_device);
		                    }
		                }
		            }

            		if(!empty($_GET['page'])){
						return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBankingEzpics.php?mess=1&page='.$_GET['page']);
					}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBankingEzpics.php?mess=1');
					}
				
			}
		}
	}
	if(!empty($_GET['page'])){
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBankingEzpics.php?page='.$_GET['page']);
	}else{
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBankingEzpics.php');
	}
}

//Danh sách giao dịch tạo conent
function listTransactionHistoryCreateConnetnEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch tạo conent';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array('type'=>6);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		//$listData[$key]->product = $modelProducts->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}



function listTransactionProEzpics(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch nâng cấp Pro';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array('type'=>9);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		//$listData[$key]->product = $modelProducts->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

//Danh sách giao dịch tạo kho
function listTransactionHistoryCreateWarehousesEzpics(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch tạo kho ';

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelWarehouse = $controller->loadModel('Warehouses');

	$conditions = array('type'=>10);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
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

    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    		$listData[$key]->warehouses = $modelWarehouse->find()->where(['id'=>$value->product_id])->first();
    	}
    }

    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->total;
    	}
    }
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
    setVariable('totalData', $totalData);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
}

function tixmoney($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelProducts = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	$listMembers = $modelMembers->find()->where(array())->all()->toList();
	$listOrders = $modelOrders->find()->where(array())->all()->toList();
	$listWarehouses = $modelWarehouses->find()->where(array())->all()->toList();
	$listWarehouseUsers = $modelWarehouseUsers->find()->where(array())->all()->toList();
	$listProducts = $modelProducts->find()->where(array())->all()->toList();
	$listDiscountCode = $modelDiscountCode->find()->where(array())->all()->toList();
	$muber = 0;
	foreach($listMembers as $key => $value){
		if(!empty($value)){
			$value->account_balance = $value->account_balance/1000;
			$value->sellingMoney = $value->sellingMoney/1000;
			$value->buyingMoney = $value->buyingMoney/1000;

			$modelMembers->save($value);

			$muber += 1;

		}
	}

	foreach($listOrders as $key => $value){
		if(!empty($value)){
			$value->total = $value->total/1000;
			$modelOrders->save($value);

			$muber += 1;

		}
	}

	foreach($listWarehouses as $key => $value){
		if(!empty($value)){
			$value->price = $value->price/1000;
			$modelWarehouses->save($value);

			$muber += 1;

		}
	}

	foreach($listProducts as $key => $value){
		if(!empty($value)){
			$value->price = $value->price/1000;
			$value->sale_price = $value->sale_price/1000;
			$modelProducts->save($value);

			$muber += 1;

		}
	}

	foreach($listDiscountCode as $key => $value){
		if(!empty($value)){
			if($value->discount >100){
				$value->discount = $value->discount/1000;
				$modelDiscountCode->save($value);
				$muber += 1;
			}
		}
	}
	debug('dã chuyển dồi dc '.$muber);
	die();

	
}

//Danh sách giao dịch cộng Ecoin
function listTransactionHistoryPlusEcoinEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch Cộng Ecoin';

	$modelMembers = $controller->loadModel('Members');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');

	$conditions = array('type'=>1);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}

	if(!empty($_GET['id'])){
		$conditions['id'] = $_GET['id'];
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

    $listData = $modelTransactionEcoins->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    	}
    }

    $totalData = $modelTransactionEcoins->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->ecoin;
    	}
    }
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
    if(@$_GET['mess']==1){
    	$mess = '<span class="text-success">Đã xử lý giao dịch thành công</span>';
    }
    if(@$_GET['mess']==2){
    	$mess = '<span class="text-success">Tài khoản này không đủ tiền</span>';
    } 
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
    setVariable('mess', $mess);
}

// //Danh sách giao dịch trừ Ecoin
function listTransactionHistoryMinusEcoinEzpics($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch trừ Ecoin';

	$modelMembers = $controller->loadModel('Members');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');

	$conditions = array('type'=>0);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['member_id'] = (int) $member->id;
		}else{
			$conditions['member_id'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}

	if(!empty($_GET['id'])){
		$conditions['id'] = $_GET['id'];
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

    $listData = $modelTransactionEcoins->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMembers->get($value->member_id);
    	}
    }

    $totalData = $modelTransactionEcoins->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
    	foreach($totalData as $key => $item){
    		$totalMoney += $item->ecoin;
    	}
    }
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
    if(@$_GET['mess']==1){
    	$mess = '<span class="text-success">Đã xử lý giao dịch thành công</span>';
    }
    if(@$_GET['mess']==2){
    	$mess = '<span class="text-success">Tài khoản này không đủ tiền</span>';
    } 
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
    setVariable('mess', $mess);
}

?>