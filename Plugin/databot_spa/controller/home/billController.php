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
	    $metaTitleMantan = 'Danh sách Phiếu thu';

	    $modelMember = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		$user = $session->read('infoUser');

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		$conditions['type'] = 0;
		$conditions['id_member']= $user->id;
		$conditions['id_spa']= $user->id_spa;
		if(!empty($_GET['id_spa'])){
			$conditions['id_spa'] = $_GET['id_spa'];
		}

		if(!empty($_GET['status'])){
			$conditions['status'] = $_GET['status'];
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = $_GET['id_staff'];
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

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Người nội', 'type'=>'text', 'width'=>15],
							['name'=>'Người thu', 'type'=>'text', 'width'=>15],
							['name'=>'Số tiền', 'type'=>'text', 'width'=>15],
							['name'=>'Hình thức', 'type'=>'text', 'width'=>15],
							['name'=>'Trạng thái', 'type'=>'text', 'width'=>10],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$staff = $modelMember->find()->where(array('id'=>$value->id_staff))->first();
					$name = '';
					if(!empty($staff)){
						$name = $staff->name;
					}
					 $status = 'đã sử lý';
                    if($value->status==0)$status = 'chưa sử lý';
					$dataExcel[] = [
									$value->created_at->format('d/m/Y H:i'), 
									$value->full_name, 
									$name,
									$value->total, 
									$type_collection_bill[$value->type_collection_bill], 
									$status, 
								];
				}
			}

			export_excel($titleExcel, $dataExcel);
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
	    if(@$_GET['mess']==1){
	    	$mess = '<p class="text-success">thêm thành công</p>';
	    }elseif(@$_GET['mess']==2){
	    	$mess = '<p class="text-success">sửa thành công</p>';
	    }elseif(@$_GET['mess']==3){
	    	$mess = '<p class="text-success">xóa thành công</p>';
	    }

		setVariable('mess', $mess);
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

function addCollectionBill($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin sản phẩm';
    
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
        }
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->created_at = DateTime::createFromFormat('d/m/Y H:i', @$dataSend['created_at'])->format('Y-m-d H:i:s'); 
            $data->id_spa = @$infoUser->id_spa;
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$dataSend['total'];
            $data->full_name = @$dataSend['full_name'];
            $data->type = 0;
            $data->note = @$dataSend['note'];
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
            $data->status = 0;

           
            $modelBill->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

            if(!empty($_GET['id'])){
                return $controller->redirect('/listCollectionBill?mess=2');
            }else{
                return $controller->redirect('/listCollectionBill?mess=1');
            }
        }	

        setVariable('data', $data);
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

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách Phiếu chi';

	    $modelMember = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		$user = $session->read('infoUser');


		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		$conditions['type'] = 1;
		$conditions['id_member']= $user->id;
		$conditions['id_spa']= $user->id_spa;
		if(!empty($_GET['id_spa'])){
			$conditions['id_spa'] = $_GET['id_spa'];
		}

		if(!empty($_GET['status'])){
			$conditions['status'] = $_GET['status'];
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = $_GET['id_staff'];
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

		if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
							['name'=>'Người nhận', 'type'=>'text', 'width'=>25],
							['name'=>'Người chi', 'type'=>'text', 'width'=>25],
							['name'=>'Số tiền', 'type'=>'text', 'width'=>25],
							['name'=>'Hình thức', 'type'=>'text', 'width'=>25],
							['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$staff = $modelMember->find()->where(array('id'=>$value->id_staff))->first();
					$name = '';
					if(!empty($staff)){
						$name = $staff->name;
					}
					 $status = 'đã sử lý';
                    if($value->status==0)$status = 'chưa sử lý';
					$dataExcel[] = [
									@$value->created_at->format('d/m/Y H:i'), 
									@$value->full_name, 
									@$name, 
									@$value->total, 
									$type_collection_bill[$value->type_collection_bill], 
									$status,
								];
				}
			}

			export_excel($titleExcel, $dataExcel);
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
	    if(@$_GET['mess']==1){
	    	$mess = '<p class="text-success">thêm thành công</p>';
	    }elseif(@$_GET['mess']==2){
	    	$mess = '<p class="text-success">sửa thành công</p>';
	    }elseif(@$_GET['mess']==3){
	    	$mess = '<p class="text-success">xóa thành công</p>';
	    }

		setVariable('mess', $mess);

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

function addBill($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin sản phẩm';
    
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
        }
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save 
            $data->id_member = @$infoUser->id_member;
            $data->created_at = DateTime::createFromFormat('d/m/Y H:i', @$dataSend['created_at'])->format('Y-m-d H:i:s'); 
            $data->id_spa = @$infoUser->id_spa;
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$dataSend['total'];
            $data->full_name = $dataSend['full_name'];
            $data->type = 1;
            $data->note = @$dataSend['note'];
            $data->updated_at = date('Y-m-d H:i:s');
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
            $data->status = 0;

           
            $modelBill->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

            if(!empty($_GET['id'])){
                return $controller->redirect('/listBill?mess=2');
            }else{
                return $controller->redirect('/listBill?mess=1');
            }
        }	

        setVariable('data', $data);
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
        if($_GET['url']=1){
        	 return $controller->redirect('/listCollectionBill?mess=3');
        }else{
        	return $controller->redirect('/listBill?mess=3');
        }
       
    }else{
        return $controller->redirect('/login');
    }
}
 ?>

