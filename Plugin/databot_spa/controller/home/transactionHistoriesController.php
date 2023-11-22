<?php
function transactionHistories($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;
	
	if(!empty(checkLoginManager('transactionHistories'))){
	    $metaTitleMantan = 'Lịch sử giao dịch';

	    $modelTransactionHistories = $controller->loadModel('TransactionHistories');
	    $modelMember = $controller->loadModel('Members');
		
		$user = $session->read('infoUser');

		$conditions = array('id_member'=>$user->id_member);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['type'])){
			$conditions['type'] = $_GET['type'];
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['create_at >='] = $date_start;
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['create_at <='] = $date_end;
		}

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelTransactionHistories->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Số tiền', 'type'=>'text', 'width'=>15],
							['name'=>'Kiểu giao dịch', 'type'=>'text', 'width'=>15],
							['name'=>'Ghi chú', 'type'=>'number', 'width'=>15],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$dataExcel[] = [
									date('d/m/Y H:i', $value->create_at), 
									$value->coin, 
									$value->type, 
									$value->total, 
									$value->note, 
								];
				}
			}

			export_excel($titleExcel, $dataExcel, 'lich-su-giao-dich-'.date('d-m-Y'));
	    }else{
	    	$listData = $modelTransactionHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    $totalData = $modelTransactionHistories->find()->where($conditions)->all()->toList();
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
	    $boss_spa = $modelMember->find()->where(['id'=>$session->read('infoUser')->id_member])->first();

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	    setVariable('boss_spa', $boss_spa);
	}else{
		return $controller->redirect('/');
	}
}

function createRequestAddMoney($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;

	if(!empty(checkLoginManager('createRequestAddMoney'))){
	    $metaTitleMantan = 'Yêu cầu nạp tiền';

	    $boss_spa = $modelMember->find()->where(['id'=>$session->read('infoUser')->id_member])->first();
	    setVariable('boss_spa', $boss_spa);
	}else{
		return $controller->redirect('/');
	}
}
?>