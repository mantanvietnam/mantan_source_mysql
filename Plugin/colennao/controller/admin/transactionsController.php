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
		$conditionsuser['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$user = $modelUser->find()->where($conditionsuser)->first();
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
    	}
    }

    $totalData = $modelTransactions->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalData),$limit,$page); 
     if(!empty($totalData)){
    	foreach ($totalData as $key => $value) {
    		$totalMoney +=$value->total;
    	}
    }
    

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
    setVariable('totalMoney', $totalMoney);
    setVariable('totalData', count($totalData));
}

function confirmReceiptMoney(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch thanh toán';

	
    $modelTransactions = $controller->loadModel('Transactions');
    $modelUser = $controller->loadModel('Users');


    if(!empty($_GET['id'])){
    	$data = $modelTransactions->find()->where(array('id'=>(int)$_GET['id'], 'status'=>1))->first();

    	 if(!empty($data)){
    	 	 $mess = processAddMoney($data->total, $data->id);
    	 }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-transaction-listTransactionAdmin?page='.@$_GET['page']);
}


function listTransactionRoseAdmin(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách giao dịch thanh toán';

	
    $modelTransactions = $controller->loadModel('Transactions');
    $modelUser = $controller->loadModel('Users');
    $modeTransactionRoses = $controller->loadModel('TransactionRoses');

    $conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['phone'])){
		$conditionsuser['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$user = $modelUser->find()->where($conditionsuser)->first();
		if(!empty($user)){
			$conditions['id_user'] = (int) $user->id;
		}else{
			$conditions['id_user'] = 0;
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


    $listData = $modeTransactionRoses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    $totalMoney = 0;
    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->user = $modelUser->get($value->id_user);
    		
    	}
    }

    $totalData = $modeTransactionRoses->find()->where($conditions)->all()->toList();
     if(!empty($totalData)){
    	foreach ($totalData as $key => $value) {
    		$totalMoney +=$value->total;
    	}
    }
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


function transactioncMoneyAdmin($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;


    $modelUser = $controller->loadModel('Users');
    $modeTransactionRoses = $controller->loadModel('TransactionRoses');

	if(!empty($_GET['id'])){
		$data = $modeTransactionRoses->find()->where(array('id'=>$_GET['id'], 'status'=>'new'))->first();
		if(!empty($data)){
			$user = $modelUser->find()->where(array('id'=>$data->id_user))->first();
			if(!empty($user)){
				if($user->total_coin >= $data->total){
					$user->total_coin -= $data->total;
					$data->status = 'done';
					$data->updated_at = time();
					$modelUser->save($user);
					$modeTransactionRoses->save($data);

					 $dataSendNotification= array('title'=>'Bạn đã rút tiền thành công','time'=>date('H:i d/m/Y'),'content'=>'Số tiền bạn rút là: '.number_format($data->total).'VNĐ','action'=>'productNew');
					 if(!empty($user->token_device)){
                		sendNotificationnew($dataSendNotification, $user->token_device);
            		}
            		 if(!empty($user->email)){
            		  	sendEmailtransactioncMoney($user->email, $user->full_name, $data);
            		 }

            		if(!empty($_GET['page'])){
						return $controller->redirect('/plugins/admin/colennao-view-admin-transaction-listTransactionRoseAdmin?mess=1&page='.$_GET['page']);
					}else{
					return $controller->redirect('/plugins/admin/colennao-view-admin-transaction-listTransactionRoseAdmin?mess=1');
					}
				}else{
					return $controller->redirect('/plugins/admin/colennao-view-admin-transaction-listTransactionRoseAdmin?mess=2');
				}
			}
		}
	}
	if(!empty($_GET['page'])){
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics?page='.$_GET['page']);
	}else{
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics');
	}
}

 ?>
