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
	    $modelCustomers = $controller->loadModel('Customers');
		$modelDebt = $controller->loadModel('Debts');
		
		$user = $session->read('infoUser');

		$conditions = array('id_member_sell'=>$session->read('infoUser')->id, 'type'=>1);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		
		 if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_member_buy'])){
            $conditions['id_member_buy'] = $_GET['id_member_buy'];
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['type_order'])){
            $conditions['type_order'] = $_GET['type_order'];
        }

        if(isset($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelDebt->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
							['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
							['name'=>'Tên', 'type'=>'text', 'width'=>15],
							['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
							['name'=>'Đội tượng', 'type'=>'text', 'width'=>15],
							['name'=>'Tổng số tiền nợ', 'type'=>'number', 'width'=>15],
							['name'=>'đã trả', 'type'=>'number', 'width'=>15],
							['name'=>'Còn lại', 'type'=>'number', 'width'=>15],
							['name'=>'Số lần trả', 'type'=>'text', 'width'=>15],
							['name'=>'trạng thái', 'type'=>'text', 'width'=>15],
							['name'=>'Nội dung', 'type'=>'text', 'width'=>30],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$name = '';
					if(!empty($value->id_member_buy) && $value->type_order==1){
                    $member = $modelMember->find()->where(['id'=>$value->id_member_buy])->first();
                    $name = $member->name;
                    $phone = $member->phone;
                }

                if(!empty($value->id_customer) && $value->type_order==2){
                    $customer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                    $name = $customer->full_name;
                    $phone = $customer->phone;
                }
                 $type = '';
                  if($value->type_order==1){
                    $type = 'Đại lý';
                  }elseif($value->type_order==2){
                    $type = 'Khách hàng';
                  }
					$status = 'Chưa thu hết';
					if(!empty($value->status))$status = 'Đã thu hết';
					$dataExcel[] = [
									date('d/m/Y H:i', $value->created_at), 
									$name,
									$phone,
									$type,
									number_format($value->total), 
									number_format($value->total_payment), 
									number_format($value->total-$value->total_payment), 
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
				if(!empty($item->id_member_buy) && $item->type_order==1){
                    $listData[$key]->member = $modelMember->find()->where(['id'=>$item->id_member_buy])->first();
                }

                if(!empty($item->id_customer) && $item->type_order==2){
                    $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
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

	   

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	}else{
        return $controller->redirect('/login');
    }
}

/*function addCollectionDebt($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin công nợ phải thu';
    
    if(!empty(checkLoginManager('addCollectionDebt', 'bill'))){
        $modelMember

        		 = $controller->loadModel('Members');
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
            $data->id_staff = @$infoUser->id;
        }

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMember

	    		->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = (int)@$dataSend['id_staff'];
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
        setVariable('listStaffs', $listStaffs);

	    setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/');
    }
}*/

function paymentCollectionBill($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin công nợ phải trả';
    
    if(!empty($session->read('infoUser'))){
        $modelMember = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		$modelCustomer = $controller->loadModel('Customers');
		$modelDebts = $controller->loadModel('Debts');
		$modelPointCustomer = $controller->loadModel('PointCustomers');
        $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');

        $infoUser = $session->read('infoUser');
        $time = time();

        $system = $modelCategories->find()->where(array('id'=>$infoUser->id_system ))->first();

	    if(!empty($system->description)){
	        $description = json_decode($system->description, true);
	        $convertPoint = (int) $description['convertPoint'];
	    }

        $mess= '';
        $debtCollection = $modelDebts->get( (int) $_GET['id']);
        if(!empty($debtCollection->id_member_buy)){
        	$conditions = array('id_member_buy'=>$debtCollection->id_member_buy,
        						'id_member_sell'=>$debtCollection->id_member_sell,
        						'id_order'=>$debtCollection->id_order,
        						'type'=>2,
        				);
        	$debtPayable = $modelDebts->find()->where($conditions)->first();
        }
       // debug($debtCollection);
       // debug($debtPayable);
        // info đại lý mua
        $memberbuy = $modelMember->find()->where(['id'=>$debtCollection->id_member_buy])->first();

        //// info đại lý bán
        $membersell = $modelMember->find()->where(['id'=>$debtCollection->id_member_sell])->first();


        if($debtCollection->total-$debtCollection->total_payment>=(int)$_GET['total']){

        	// đại lý thu 
        	if(@$debtCollection->type_order==1 && @$debtPayable->type_order==1){
        		if(@$debtCollection->type==1){
	   				$number =$debtCollection->number_payment+1;
		             // bill cho người thu nợ
	        		$billsell = $modelBill->newEmptyEntity();
	        		$billsell->id_member_sell = $debtCollection->id_member_sell;
	        		$billsell->id_member_buy = $debtCollection->id_member_buy;
	        		$billsell->total = (int)$_GET['total'];
	        		$billsell->id_order = @$debtCollection->id_order;
	        		$billsell->type = 1;
	        		$billsell->type_order = 1; 
	        		$billsell->created_at = $time;
	        		$billsell->updated_at = $time;
	        		$billsell->id_debt = $debtCollection->id;
	        		$billsell->type_collection_bill =  @$_GET['type_collection_bill'];
	        		$billsell->id_customer = 0;
	        		$billsell->note = 'Thu công nợ cho đại lý '.@$memberbuy->name.' '.@$memberbuy->phone.', công nợ có id '.@$debtCollection->id.', của đơn hàng id '.@$debtCollection->id_order.', lần thứ '.@$number.', '.@$_GET['note'];

	        		$modelBill->save($billsell);
		           
		            $debtCollection->total_payment += (int)@$_GET['total'];
		            $debtCollection->number_payment += 1;
		            $debtCollection->updated_at = $time;
		            if($debtCollection->total_payment==$debtCollection->total){
		            	$debtCollection->status = 1;
		            }
		            $modelDebts->save($debtCollection);
	        	}

	        	// đại lý trả
	        	if(@$debtPayable->type==2){
	   				$number =$debtPayable->number_payment+1;
		             // bill cho đại lý trả nợ
	        		$billsell = $modelBill->newEmptyEntity();
	        		$billsell->id_member_sell = $debtPayable->id_member_sell;
	        		$billsell->id_member_buy = $debtPayable->id_member_buy;
	        		$billsell->total = (int)$_GET['total'];
	        		$billsell->id_order = @$debtPayable->id_order;
	        		$billsell->type = 2;
	        		$billsell->type_order = 1; 
	        		$billsell->created_at = $time;
	        		$billsell->updated_at = $time;
	        		$billsell->id_debt = $debtPayable->id;
	        		$billsell->type_collection_bill =  @$_GET['type_collection_bill'];
	        		$billsell->id_customer = 0;
	        		$billsell->note = 'Trả công nợ cho đại lý '.@$membersell->name.' '.@$membersell->phone.', công nợ có id '.@$debtPayable->id.', của đơn hàng id '.@$debtPayable->id_order.', lần thứ '.@$number;

	        		$modelBill->save($billsell);

		            $debtPayable->total_payment += (int)@$_GET['total'];
		            $debtPayable->number_payment += 1;
		            $debtPayable->updated_at = $time;
		            if($debtPayable->total_payment==$debtPayable->total){
		            	$debtPayable->status = 1;
		            }
		            $modelDebts->save($debtPayable);
	        	}
	        }elseif(@$debtCollection->type_order==2 && !empty($debtCollection->id_customer)){
	        	$conditions = $modelCustomer->find()->where(['id'=>$debtCollection->id_customer]);
	        	$number =$debtCollection->number_payment+1;
		             // bill cho người thu nợ
	        	$billsell = $modelBill->newEmptyEntity();
	        	$billsell->id_member_sell = $debtCollection->id_member_sell;
	        	$billsell->id_member_buy = 0;
	        	$billsell->total = (int)$_GET['total'];
	        	$billsell->id_order = @$debtCollection->id_order;
	        	$billsell->type = 1;
	        	$billsell->type_order = 2; 
	        	$billsell->created_at = $time;
	        	$billsell->updated_at = $time;
	        	$billsell->id_debt = $debtCollection->id;
	        	$billsell->type_collection_bill =  @$_GET['type_collection_bill'];
	        	$billsell->id_customer = $debtCollection->id_customer;
	        	$billsell->note = 'Thu công nợ cho khách hàng '.@$conditions->full_name.' '.@$conditions->phone.', công nợ có id '.@$debtCollection->id.', của đơn hàng id '.@$debtCollection->id_order.', lần thứ '.@$number.', '.@$_GET['note'];

	        	$modelBill->save($billsell);

	        	$debtCollection->total_payment += (int)@$_GET['total'];
	        	$debtCollection->number_payment += 1;
	        	$debtCollection->updated_at = $time;
	        	if($debtCollection->total_payment==$debtCollection->total){
	        		$debtCollection->status = 1;

	        		if(!empty($convertPoint)){
	        			$point = intval($debtCollection->total / $convertPoint);

	        			$checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$debtCollection->id_member_sell, 'id_customer'=>$debtCollection->id_customer])->first();

	        			if(!empty($checkPointCustomer)){
	        				$checkPointCustomer->point += (int)$point;
	        			}else{
	        				$checkPointCustomer= $modelPointCustomer->newEmptyEntity();
	        				$checkPointCustomer->point = (int) $point;
	        				$checkPointCustomer->id_member = $debtCollection->id_member_sell;
	        				$checkPointCustomer->id_customer = $debtCollection->id_customer;
	        				$checkPointCustomer->created_at = $time;
	        				$checkPointCustomer->id_rating = 0;
	        			}
	        			$rating = $modelRatingPointCustomer->find()->where(['point_min <=' => $checkPointCustomer->point])->order(['point_min' => 'DESC'])->first();
	        			if(!empty($rating)){
	        				$checkPointCustomer->id_rating = $rating->id;
	        			}
	        			$modelPointCustomer->save($checkPointCustomer);
	        		}
	        	}
	        	$modelDebts->save($debtCollection);

	        }
           

            return $controller->redirect('/listCollectionDebt?mess=paymentDone');
        }else{
        	return $controller->redirect('/listCollectionDebt?mess=paymentError');
        }
    }else{
        return $controller->redirect('/');
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
	    $modelCustomers = $controller->loadModel('Customers');
		$modelDebt = $controller->loadModel('Debts');
		
		$user = $session->read('infoUser');

		$conditions = array('id_member_buy'=>$session->read('infoUser')->id, 'type'=>2);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['id_member_sell'])){
            $conditions['id_member_sell'] = $_GET['id_member_sell'];
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['type_order'])){
            $conditions['type_order'] = $_GET['type_order'];
        }

        if(isset($_GET['status'])){
            $conditions['status'] = $_GET['status'];
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
							['name'=>'Tên', 'type'=>'text', 'width'=>15],
							['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
							['name'=>'Đội tượng', 'type'=>'text', 'width'=>15],
							['name'=>'Tổng số tiền nợ', 'type'=>'number', 'width'=>15],
							['name'=>'đã trả', 'type'=>'number', 'width'=>15],
							['name'=>'Còn lại', 'type'=>'number', 'width'=>15],
							['name'=>'Số lần trả', 'type'=>'text', 'width'=>15],
							['name'=>'trạng thái', 'type'=>'text', 'width'=>15],
							['name'=>'Nội dung', 'type'=>'text', 'width'=>30],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$name = '';
					if(!empty($value->id_member_sell) && $value->type_order==1){
                    $member = $modelMember->find()->where(['id'=>$value->id_member_sell])->first();
                    $name = $member->name;
                    $phone = $member->phone;
                }

                if(!empty($value->id_customer) && $value->type_order==2){
                    $customer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                    $name = $customer->full_name;
                    $phone = $customer->phone;
                }
                 $type = '';
                  if($value->type_order==1){
                    $type = 'Đại lý';
                  }elseif($value->type_order==2){
                    $type = 'Khách hàng';
                  }
					$status = 'Chưa trả hết';
					if(!empty($value->status))$status = 'Đã trả hết';
					$dataExcel[] = [
									date('d/m/Y H:i', $value->created_at), 
									$name,
									$phone,
									$type,
									number_format($value->total), 
									number_format($value->total_payment), 
									number_format($value->total-$value->total_payment), 
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
				if(!empty($item->id_member_sell) && $item->type_order==1){
                	$listData[$key]->member = $modelMember->find()->where(['id'=>$item->id_member_sell])->first();
                }

                if(!empty($item->id_customer) && $item->type_order==2){
                	$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
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
	    	$mess = '<p class="text-success">Số tiền thanh toán nhỏ hơn nợ</p>';
	    }

	   

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	}else{
        return $controller->redirect('/login');
    }
}

/*function addPayableDebt($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin công nợ phải trả';
    
    if(!empty(checkLoginManager('addPayableDebt', 'bill'))){
        $modelMember= $controller->loadModel('Members');
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

            $data->id_staff = @$infoUser->id;
        }

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

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
        setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/');
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
    
    if(!empty(checkLoginManager('paymentBill', 'bill'))){
        $modelMember= $controller->loadModel('Members');
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
        return $controller->redirect('/');
    }
}*/
?>