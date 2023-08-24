<?php 
function listCollectionDebt($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách công nợ phải thu';

	    $modelMember = $controller->loadModel('Members');
		$modelDebt = $controller->loadModel('Debts');
		
		$user = $session->read('infoUser');

		$conditions = array('type'=>0, 'id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = (int) $_GET['id_staff'];
		}

		if(!empty($_GET['full_name'])){
			$conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['time >='] = $date_start;
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['time <='] = $date_end;
		}

		if(!empty($_GET['id_customer'])){
			$conditions['id_customer'] = (int) $_GET['id_customer'];
		}

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelDebt->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Người Nợ', 'type'=>'text', 'width'=>15],
							['name'=>'Nhân viên', 'type'=>'text', 'width'=>15],
							['name'=>'Tổng số tiền nợ', 'type'=>'number', 'width'=>15],
							['name'=>'đã trả', 'type'=>'number', 'width'=>15],
							['name'=>'Còn lại', 'type'=>'number', 'width'=>15],
							['name'=>'Số lần trả', 'type'=>'text', 'width'=>15],
							['name'=>'trạng thái', 'type'=>'text', 'width'=>15],
							['name'=>'Nội dung thu', 'type'=>'text', 'width'=>30],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$staff = $modelMember->find()->where(array('id'=>$value->id_staff))->first();
					$name = '';
					if(!empty($staff)){
						$name = $staff->name;
					}

					$status = 'Chưa trả hết';
					if(!empty($value->status))$status = 'Đã trả hết';
					$dataExcel[] = [
									date('d/m/Y H:i', $value->time), 
									$value->full_name, 
									$name,
									$value->total, 
									$value->total_payment, 
									$value->total-$value->total_payment, 
									$value->number_payment, 
									$status, 
									$value->note, 
								];
				}
			}

			export_excel($titleExcel, $dataExcel, 'cong-no-phai-thu-'.date('d-m-Y'));
	    }else{
	    	$listData = $modelDebt->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    if(!empty($listData)){
			foreach($listData as $key =>$item){
				$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
				if(!empty($staff)){
					$listData[$key]->staff = $staff;
				}
			}
		}

		$totalData = $modelDebt->find()->where($conditions)->all()->toList();
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
	    if(@$_GET['mess']=='paymentDone'){
	    	$mess = '<p class="text-success">Bạn thành toán công nợ thành công</p>';
	    }elseif(@$_GET['mess']=='paymentError'){
	    	$mess = '<p class="text-success">Bạn Số tiền thanh toán nhỏ hơn nợ</p>';
	    }

	    $conditionsStaff['OR'] = [ 
									['id'=>$user->id_member],
									['id_member'=>$user->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	    setVariable('listStaffs', $listStaffs);
	}else{
		return $controller->redirect('/login');
	}
}

function addCollectionDebt($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin công nợ phải thu';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelDebts->get( (int) $_GET['id']);
        }else{
            $data = $modelDebts->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
            $data->status = 0;
            $data->time = time();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 0; //0: Thu, 1: chi
            $data->updated_at = date('Y-m-d H:i:s');
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];

            if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$data->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$data->time = time();
            }
           
            $modelDebts->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function paymentCollectionBill($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin phiếu thu';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';
        $debt = $modelDebts->get( (int) $_GET['id_debt']);
       
        if($debt->total-$debt->total_payment>=(int)$_GET['total']){
   
            $data = $modelBill->newEmptyEntity();
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$_GET['total'];
            $data->note = @$_GET['note'];
            $data->type = 0; //0: Thu, 1: chi
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type_collection_bill = @$_GET['type_collection_bill'];
            $data->id_customer = (int)@$_GET['id_customer'];
            $data->full_name = @$_GET['full_name'];
            $data->id_debt = @$_GET['id_debt'];
            $data->time = time();
           
            $modelBill->save($data);
            $debt->total_payment += (int)@$_GET['total'];
            $debt->number_payment += 1;
            if($debt->total_payment==$debt->total){
            	$debt->status = 1;
            }
            $modelDebts->save($debt);
           

            return $controller->redirect('/listCollectionDebt?mess=paymentDone');
        }else{
        	return $controller->redirect('/listCollectionDebt?mess=paymentError');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listPayableDebt($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách công nợ phải trả';

	    $modelMember = $controller->loadModel('Members');
		$modelDebt = $controller->loadModel('Debts');
		
		$user = $session->read('infoUser');

		$conditions = array('type'=>1, 'id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = (int) $_GET['id_staff'];
		}

		if(!empty($_GET['full_name'])){
			$conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['time >='] = $date_start;
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['time <='] = $date_end;
		}

		if(!empty($_GET['id_customer'])){
			$conditions['id_customer'] = (int) $_GET['id_customer'];
		}

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelDebt->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Người Nợ', 'type'=>'text', 'width'=>15],
							['name'=>'Nhân viên', 'type'=>'text', 'width'=>15],
							['name'=>'Tổng số tiền nợ', 'type'=>'number', 'width'=>15],
							['name'=>'đã trả', 'type'=>'number', 'width'=>15],
							['name'=>'Còn lại', 'type'=>'number', 'width'=>15],
							['name'=>'Số lần trả', 'type'=>'text', 'width'=>15],
							['name'=>'trạng thái', 'type'=>'text', 'width'=>15],
							['name'=>'Nội dung thu', 'type'=>'text', 'width'=>30],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$staff = $modelMember->find()->where(array('id'=>$value->id_staff))->first();
					$name = '';
					if(!empty($staff)){
						$name = $staff->name;
					}

					$status = 'Chưa trả hết';
					if(!empty($value->status))$status = 'Đã trả hết';
					$dataExcel[] = [
									date('d/m/Y H:i', $value->time), 
									$value->full_name, 
									$name,
									$value->total, 
									$value->total_payment, 
									$value->total-$value->total_payment, 
									$value->number_payment, 
									$status, 
									$value->note, 
								];
				}
			}

			export_excel($titleExcel, $dataExcel, 'cong-no-phai-tra-'.date('d-m-Y'));
	    }else{
	    	$listData = $modelDebt->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    if(!empty($listData)){
			foreach($listData as $key =>$item){
				$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
				if(!empty($staff)){
					$listData[$key]->staff = $staff;
				}
			}
		}

		$totalData = $modelDebt->find()->where($conditions)->all()->toList();
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
	    if(@$_GET['mess']=='paymentDone'){
	    	$mess = '<p class="text-success">Bạn thành toán công nợ thành công</p>';
	    }elseif(@$_GET['mess']=='paymentError'){
	    	$mess = '<p class="text-success">Bạn Số tiền thanh toán nhỏ hơn nợ</p>';
	    }

	    $conditionsStaff['OR'] = [ 
									['id'=>$user->id_member],
									['id_member'=>$user->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	    setVariable('listStaffs', $listStaffs);
	}else{
		return $controller->redirect('/login');
	}
}

function addPayableDebt($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin công nợ phải trả';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelDebts->get( (int) $_GET['id']);
        }else{
            $data = $modelDebts->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
            $data->status = 0;
            $data->time = time();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 1; //0: Thu, 1: chi
            $data->updated_at = date('Y-m-d H:i:s');
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];

            if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$data->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$data->time = time();
            }
           
            $modelDebts->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function paymentBill($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin công nợ phải trả';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';
        $debt = $modelDebts->get( (int) $_GET['id_debt']);
       
        if($debt->total-$debt->total_payment>=(int)$_GET['total']){
   
            $data = $modelBill->newEmptyEntity();
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$_GET['total'];
            $data->note = @$_GET['note'];
            $data->type = 1; //0: Thu, 1: chi
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type_collection_bill = @$_GET['type_collection_bill'];
            $data->id_customer = (int)@$_GET['id_customer'];
            $data->full_name = @$_GET['full_name'];
            $data->id_debt = @$_GET['id_debt'];
            $data->time = time();
           
            $modelBill->save($data);
            $debt->total_payment += (int)@$_GET['total'];
            $debt->number_payment += 1;
            if($debt->total_payment==$debt->total){
            	$debt->status = 1;
            }
            $modelDebts->save($debt);
           

            return $controller->redirect('/listPayableDebt?mess=paymentDone');
        }else{
        	return $controller->redirect('/listPayableDebt?mess=paymentError');
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>

