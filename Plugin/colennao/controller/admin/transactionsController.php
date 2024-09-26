<?php 
// Danh sách giao dịch nạp tiền
function listTransactionAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch thanh toán';

	
    $modelTransactions = $controller->loadModel('Transactions');
    $modelUser = $controller->loadModel('Users');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['code'])){
		$conditions['code'] = $_GET['code'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$user = $modelUser->find()->where($conditionsMember)->first();
		if(!empty($user)){
			$conditions['id_user'] = (int) $user->id;
		}else{
			$conditions['id_user'] = 0;
		}
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}

	if(isset($_GET['type'])){
		if($_GET['type']!=''){
			$conditions['type'] = $_GET['type'];
		}
	}


	

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = $date_start;
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = $date_end;
	}


    $listData = $modelTransactions->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    $totalMoney = 0;
    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->user = $modelUser->get($value->id_user);
    		$totalMoney +=$value->total;
    	}
    }

    $totalData = $modelTransactions->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalData),$limit,$page); 

    

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
    setVariable('totalData', count($totalData));
}
 ?>