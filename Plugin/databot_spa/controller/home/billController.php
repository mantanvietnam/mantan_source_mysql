<?php 
// Danh sách Phiếu thu
function listCollectionBill($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách phiếu thu';

	    $modelMember = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		
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

		if(!empty($_GET['id_debt'])){
			$conditions['id_debt'] = (int) $_GET['id_debt'];
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
    		$listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Người nộp', 'type'=>'text', 'width'=>15],
							['name'=>'Người thu', 'type'=>'text', 'width'=>15],
							['name'=>'Số tiền', 'type'=>'number', 'width'=>15],
							['name'=>'Hình thức', 'type'=>'text', 'width'=>15],
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
					 
					$dataExcel[] = [
									date('d/m/Y H:i', $value->time), 
									$value->full_name, 
									$name,
									$value->total, 
									@$type_collection_bill[$value->type_collection_bill], 
									$value->note, 
								];
				}
			}

			export_excel($titleExcel, $dataExcel, 'phieu-thu-'.date('d-m-Y'));
	    }else{
	    	$listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    if(!empty($listData)){
			foreach($listData as $key =>$item){
				$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
				if(!empty($staff)){
					$listData[$key]->staff = $staff;
				}
			}
		}

		$totalData = $modelBill->find()->where($conditions)->all()->toList();
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
	    if(@$_GET['mess']==3){
	    	$mess = '<p class="text-success">Xóa thành công</p>';
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

function addCollectionBill($input){
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

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelBill->get( (int) $_GET['id']);
        }else{
            $data = $modelBill->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
            $data->time = time();
            $data->id_staff = $infoUser->id;
        }

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = (int)@$dataSend['id_staff'];;
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 0; //0: Thu, 1: chi
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
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
           
            $modelBill->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('user', $infoUser);
        setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/login');
    }
}

// Danh sách Phiếu chi
function listBill($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách phiếu thu';

	    $modelMember = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		
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

		if(!empty($_GET['id_debt'])){
			$conditions['id_debt'] = (int) $_GET['id_debt'];
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
    		$listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Người nhận', 'type'=>'text', 'width'=>15],
							['name'=>'Người chi', 'type'=>'text', 'width'=>15],
							['name'=>'Số tiền', 'type'=>'number', 'width'=>15],
							['name'=>'Hình thức', 'type'=>'text', 'width'=>15],
							['name'=>'Nội dung chi', 'type'=>'text', 'width'=>30],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$staff = $modelMember->find()->where(array('id'=>$value->id_staff))->first();
					$name = '';
					if(!empty($staff)){
						$name = $staff->name;
					}
					 
					$dataExcel[] = [
									date('d/m/Y H:i', $value->time), 
									$value->full_name, 
									$name,
									$value->total, 
									@$type_collection_bill[$value->type_collection_bill], 
									$value->note, 
								];
				}
			}

			export_excel($titleExcel, $dataExcel, 'phieu-chi-'.date('d-m-Y'));
	    }else{
	    	$listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    if(!empty($listData)){
			foreach($listData as $key =>$item){
				$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
				if(!empty($staff)){
					$listData[$key]->staff = $staff;
				}
			}
		}

		$totalData = $modelBill->find()->where($conditions)->all()->toList();
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
	    if(@$_GET['mess']==3){
	    	$mess = '<p class="text-success">Xóa thành công</p>';
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

function addBill($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin phiếu chi';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelBill->get( (int) $_GET['id']);
        }else{
            $data = $modelBill->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
            $data->time = time();
            $data->id_staff = $infoUser->id;
        }

         $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = (int)@$dataSend['id_staff'];
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 1; //0: Thu, 1: chi
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
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
           
            $modelBill->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteBill($input){
	global $controller;
    global $session;
    
    $modelBill = $controller->loadModel('Bills');
    
    if(!empty($session->read('infoUser'))){
    	$infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelBill->get($_GET['id']);
            
            if($data){
                $modelBill->delete($data);
            }
        }
        if($_GET['url']='listCollectionBill'){
        	 return $controller->redirect('/listCollectionBill?mess=3');
        }else{
        	return $controller->redirect('/listBill?mess=3');
        }
       
    }else{
        return $controller->redirect('/login');
    }
}

function printCollectionBill(){

}

?>