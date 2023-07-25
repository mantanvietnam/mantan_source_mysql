<?php 
function listOrder($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách đăt';

	$modelOrder = $controller->loadModel('Orders');
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){


		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['phone'])){
			$conditions['phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['email'] = $_GET['email'];
		}

		if(!empty($_GET['status'])){
			$conditions['status'] = $_GET['status'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

	    $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelOrder->find()->where($conditions)->all()->toList();
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
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function addOrder($input){
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;



    $metaTitleMantan = 'Thông tin khách hàng';

	$modelCustomer = $controller->loadModel('Customers');
	$modelOrder = $controller->loadModel('Orders');
	$modelService = $controller->loadModel('Services');
	$modelMembers = $controller->loadModel('Members');
	$modelSpa = $controller->loadModel('Spas');
	$mess= '';
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){



	// lấy data edit
    if(!empty($_GET['id'])){
        $save = $modelOrder->get( (int) $_GET['id']);
    }else{
        $save = $modelOrder->newEmptyEntity();
		$save->created_at = date('Y-m-d H:i:s');
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id_member];
        	$checkPhone = $modelCustomer->find()->where($conditions)->first();

        	if(empty($checkPhone)){
        		$data = $modelCustomer->newEmptyEntity();
        		$data->created_at = date('Y-m-d H:i:s');
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->avatar = $dataSend['avatar'];
		        $data->phone = $dataSend['phone'];
		        $data->email = $dataSend['email'];
		        $data->cmnd = $dataSend['cmnd'];
		        $data->avatar = $dataSend['avatar'];
		        $data->birthday = $dataSend['birthday'];
		        $data->id_group = (int) @$dataSend['id_group'];
		        $data->code = @$dataSend['code'];
		        $data->link_facebook = $dataSend['link_facebook'];
		        $data->source = $dataSend['source'];
		        $data->id_spa = (int) $dataSend['id_spa'];
		        $data->medical_history = $dataSend['medical_history'];
		        $data->request_current = $dataSend['request_current'];
		        $data->advise_towards = $dataSend['advise_towards'];
		        $data->drug_allergy_history = $dataSend['drug_allergy_history'];
		        $data->advisory = $dataSend['advisory'];
		        $data->id_service =(int) $dataSend['id_service'];
		        $data->address = $dataSend['address'];
		        $data->note = $dataSend['note'];
		        $data->id_staff = (int) $dataSend['id_staff'];
		        $data->sex = (int) $dataSend['sex'];
		        $data->id_member =(int) $infoUser->id_member;
				$data->updated_at = date('Y-m-d H:i:s');

		        $modelCustomer->save($data);
		    }
		    $conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id_member];
		    $checkCustomer = $modelCustomer->find()->where($conditions)->first();
		    if(!empty($checkCustomer)){
		    	$save->name = $dataSend['name'];
		        $save->phone = $dataSend['phone'];
		        $save->email = $dataSend['email'];
		        $save->id_customers = $checkCustomer->id;
		        $save->id_staff = (int) $dataSend['id_staff'];
		        $save->id_spa = (int) $dataSend['id_spa'];
		        $save->id_member = (int) $infoUser->id_member;
		        $save->id_service =(int) $dataSend['id_service'];
		        $save->status = $dataSend['status'];
		        $save->created_orders = strtotime(@$dataSend['created_orders']);
		        $save->note = $dataSend['note'];
		        $save->apt_step = $dataSend['apt_step'];
		        $save->apt_times = $dataSend['apt_times'];
		        $save->type =  implode(',', $dataSend['at_type']);
		        $save->status = (int)  $dataSend['status'];

		        $thoigian = explode(' ', $dataSend['created_orders']);
                $time_start = explode('/', $thoigian[0]);
                $timeStart= explode(':', $thoigian[1]);
                $save->created_orders = mktime($timeStart[0],$timeStart[1],0,$time_start[1],$time_start[0],$time_start[2]);
		        

		        $modelOrder->save($save);
		        $mess= '<p class="text-danger">Bạn đặt lịch hẹn thành công</p>';
		    }




	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
	    }
    }

    $dataMember = $modelMembers->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();
    $dataSpa = $modelSpa->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

    $category = array('type'=>'category_customer', 'id_member'=>$infoUser->id_member);
    $dataGroup = $modelCategories->find()->where($category)->order(['id' => 'DESC'])->all()->toList();

    $Service = array('id_member'=>$infoUser->id_member);
    $dataService = $modelService->find()->where($Service)->order(['id' => 'DESC'])->all()->toList();

    $source = array('type'=>'category_source_customer', 'id_member'=>$infoUser->id_member);
    $dataSource = $modelCategories->find()->where($source)->order(['id' => 'DESC'])->all()->toList();
   
    setVariable('data', $save);
    setVariable('dataMember', $dataMember);
    setVariable('dataSpa', $dataSpa);
    setVariable('dataGroup', $dataGroup);
    setVariable('dataService', $dataService);
    setVariable('dataSource', $dataSource);
    setVariable('mess', $mess);
    }else{
		return $controller->redirect('/login');
	}
}

function deleteOrder($input){

}

?>
