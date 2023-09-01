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

/*function plusMoneyEzpics(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

	$modelMembers = $controller->loadModel('Members');
	$modelOrders = $controller->loadModel('Orders');

	$listData = $modelMembers->find()->where()->all()->toList();


	foreach($listData as $key => $item){
		$listOrder = $modelOrders->find()->where(['member_id'=>$item->id, 'status'=>2])->all()->toList();
		$item->sellingMoney = 0;
		$item->buyingMoney = 0;
		if(!empty($listOrder)){
			
			foreach($listOrder as $k => $Order){
				if($Order->type==3 || $Order->type==8){
					$item->sellingMoney += $Order->total;
				}elseif($Order->type== 1 ){
					$item->buyingMoney += $Order->total;
				}
			}
			
		}
		$modelMembers->save($item);
			$listData[$key] = $item;
	}

	debug('ok');
	debug($listData);
	die();
}*/

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

?>