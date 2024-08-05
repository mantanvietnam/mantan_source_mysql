<?php 
function listBillAPI(){

	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

	$modelMembers = $controller->loadModel('Members');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBill = $controller->loadModel('Bills');
    $modelAffiliaters = $controller->loadModel('Affiliaters');
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){

		    	$conditions = array('id_member_buy'=>$infoMember->id, 'type'=>2);
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('id'=>'desc');

		        if(!empty($dataSend['id'])){
		            $conditions['id'] = (int) $dataSend['id'];
		        }

		        if(!empty($dataSend['phone_agency'])){
		            $checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency'] ])->first();

		            if(!empty($checkMember)){
		                $conditions['id_member_sell'] = $checkMember->id;
		            }else{
		                $conditions['id_member_sell'] = -1;
		            }
		        }

		        if(!empty($dataSend['phone_customer'])){
		            $checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer'] ])->first();

		            if(!empty($checkCustomer)){
		                $conditions['id_customer'] = $checkCustomer->id;
		            }else{
		                $conditions['id_customer'] = -1;
		            }
		        }

		        if(!empty($dataSend['type_order'])){
		            $conditions['type_order'] = $dataSend['type_order'];
		        }

		        if(!empty($dataSend['type_collection_bill'])){
		            $conditions['type_collection_bill'] = $dataSend['type_collection_bill'];
		        }
		        if(!empty($dataSend['id_debt'])){
		            $conditions['id_debt'] = $dataSend['id_debt'];
		        }
		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		                
		        }

		        $listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                if(!empty($item->id_member_sell) && $item->type_order==1){
		                	$listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_sell])->first();
		                }

		                if(!empty($item->id_customer) && $item->type_order==2){
		                	$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
		                }

		                if(!empty($item->id_aff) && $item->type_order==4){
		                    $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$item->id_aff])->first();
		                }
		            }
		        }
		        // phân trang
		        $totalData = $modelBill->find()->where($conditions)->all()->toList();

		        $totalMoney = 0;
		        if(!empty($totalData)){
		            foreach ($totalData as $key => $value) {
		                $totalMoney += $value->total;
		            }
		        }

		        $totalData = count($totalData);

		        $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
		    }else{
                 $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function addBillAPI($input){
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
        $time =time();
        if(!empty($dataSend['id'])){
            $bill = $modelBill->get( (int) $dataSend['id']);
        }else{
            $bill = $modelBill->newEmptyEntity();
            $bill->created_at = $time;
        }
        $bill->id_member_sell =  0;
        $bill->id_member_buy = $session->read('infoUser')->id;
        $bill->total = @$dataSend['total'];
        $bill->id_order = 0;
        $bill->type = 2;
        $bill->type_order = 3; 
        $bill->updated_at = $time;
        $bill->id_debt = 0;
        $bill->type_collection_bill =  @$dataSend['type_collection_bill'];
        $bill->id_customer = 0;
        $bill->note =@$dataSend['note'];
       
        $modelBill->save($bill);
        return $controller->redirect('/listBill');
    }else{
        return $controller->redirect('/login');
    }
}

function listCollectionBillAPI(){

    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách phiếu thu';
    $modelMembers = $controller->loadModel('Members');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBill = $controller->loadModel('Bills');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){

		        $conditions = array('id_member_sell'=>$infoMember->id, 'type'=>1);
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('id'=>'desc');

		        if(!empty($dataSend['id'])){
		            $conditions['id'] = (int) $dataSend['id'];
		        }

		        if(!empty($dataSend['phone_agency'])){
		            $checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency'] ])->first();

		            if(!empty($checkMember)){
		                $conditions['id_member_buy'] = $checkMember->id;
		            }else{
		                $conditions['id_member_buy'] = -1;
		            }
		        }

		        if(!empty($dataSend['phone_customer'])){
		            $checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer'] ])->first();

		            if(!empty($checkCustomer)){
		                $conditions['id_customer'] = $checkCustomer->id;
		            }else{
		                $conditions['id_customer'] = -1;
		            }
		        }

		        if(!empty($dataSend['type_order'])){
		            $conditions['type_order'] = $dataSend['type_order'];
		        }

		        if(!empty($dataSend['type_collection_bill'])){
		            $conditions['type_collection_bill'] = $dataSend['type_collection_bill'];
		        }

		        if(!empty($dataSend['id_debt'])){
		            $conditions['id_debt'] = $dataSend['id_debt'];
		        }
		        
		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		                
		        }

		        $listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		        

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                if(!empty($item->id_member_buy) && $item->type_order==1){
		                    $listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_buy])->first();
		                }

		                if(!empty($item->id_customer) && $item->type_order==2){
		                    $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
		                }
		            }
		        }
		        // phân trang
		        $totalData = $modelBill->find()->where($conditions)->all()->toList();

		        $totalMoney = 0;
		        if(!empty($totalData)){
		            foreach ($totalData as $key => $value) {
		                $totalMoney += $value->total;
		            }
		        }

		        $totalData = count($totalData);

     
		        $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
		    }else{
                 $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function listCollectionBillTodayAPI(){

    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách phiếu thu';
    $modelMembers = $controller->loadModel('Members');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBill = $controller->loadModel('Bills');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
            	// Thời gian đầu ngày
                $startOfDay = strtotime("today 00:00:00");
                // Thời gian cuối ngày
                $endOfDay = strtotime("tomorrow 00:00:00") - 1;

		        $conditions = array('id_member_sell'=>$infoMember->id, 'type'=>1,  'create_at >='=>$startOfDay,'create_at <='=>$endOfDay);
		        $order = array('id'=>'desc');

		        
		        $listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();
		        

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                if(!empty($item->id_member_buy) && $item->type_order==1){
		                    $listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_buy])->first();
		                }

		                if(!empty($item->id_customer) && $item->type_order==2){
		                    $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
		                }
		            }
		        }
		        // phân trang
		        $totalData = $modelBill->find()->where($conditions)->all()->toList();

		        $totalMoney = 0;
		        if(!empty($totalData)){
		            foreach ($totalData as $key => $value) {
		                $totalMoney += $value->total;
		            }
		        }

		        $totalData = count($totalData);

     
		        $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
		    }else{
                 $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function addCollectionBillAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin phiếu chi';
    
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        $modelMembers = $controller->loadModel('Members');
        $modelCustomer = $controller->loadModel('Customers');
        $modelBill = $controller->loadModel('Bills');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        $time =time();

        if($dataSend['typeUser']=='customer'){
            if(!empty($dataSend['id_customer_buy'])){
                $customer = $modelCustomer->get((int) $dataSend['id_customer_buy']);
                $bill = $modelBill->newEmptyEntity();
                $bill->id_member_sell =  $user->id;
                $bill->id_member_buy = 0;
                $bill->total = (int) @$dataSend['total'];
                $bill->id_order = 0;
                $bill->type = 1;
                $bill->type_order = 2; 
                $bill->updated_at = $time;
                $bill->id_debt = 0;
                $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                $bill->id_customer =(int) $dataSend['id_customer_buy'];
                $bill->note = 'Đã thu tiền của khách hàng' .@$customer->full_name.' '.@$customer->phone.' với số tiền là '.number_format($bill->total).'đ lý do là: '.@$dataSend['note'];
                $modelBill->save($bill);
            }
        }elseif($dataSend['typeUser']=='member'){
            if(!empty($dataSend['idmember_buy'])){
                $member_buy = $modelMembers->get((int) $dataSend['idmember_buy']);

                // bill cho người thu
                $bill = $modelBill->newEmptyEntity();
                $bill->id_member_sell =  $user->id;
                $bill->id_member_buy = (int) $dataSend['idmember_buy'];
                $bill->total = (int) @$dataSend['total'];
                $bill->id_order = 0;
                $bill->type = 1;
                $bill->type_order = 1; 
                $bill->created_at = $time;
                $bill->updated_at = $time;
                $bill->id_debt = 0;
                $bill->type_collection_bill =  @$dataSend['type_collection_bill'];
                $bill->id_customer = 0;
                $bill->note = 'Đã thu tiền của đại lý' .@$member_buy->name.' '.@$member_buy->phone.' với số tiền là '.number_format($bill->total).'đ lý do thu là:'.@$dataSend['note'];
                $modelBill->save($bill);

                // bill cho người chi
                $billbuy = $modelBill->newEmptyEntity();
                $billbuy->id_member_sell =  $user->id;
                $billbuy->id_member_buy = (int) $dataSend['idmember_buy'];
                $billbuy->total = (int) @$dataSend['total'];
                $billbuy->id_order = 0;
                $billbuy->type = 2;
                $billbuy->type_order = 1; 
                $billbuy->created_at = $time;
                $billbuy->updated_at = $time;
                $billbuy->id_debt = 0;
                $billbuy->type_collection_bill =  @$dataSend['type_collection_bill'];
                $billbuy->id_customer = 0;
                $billbuy->note = 'Đã trả tiền cho đại lý' .@$user->name.' '.@$user->phone.' với số tiền là '.number_format($billbuy->total).'đ lý do trả là:'.@$dataSend['note'];
                $modelBill->save($billbuy);
            }
        }else{
            
            $bill = $modelBill->newEmptyEntity();
            $bill->id_member_sell =  $session->read('infoUser')->id;
            $bill->id_member_buy = 0;
            $bill->total = (int) @$dataSend['total'];
            $bill->id_order = 0;
            $bill->type = 1;
            $bill->type_order = 3; 
            $bill->updated_at = $time;
            $bill->id_debt = 0;
            $bill->type_collection_bill =  @$dataSend['type_collection_bill'];
            $bill->id_customer = 0;
            $bill->note = @$dataSend['note'];
           
            $modelBill->save($bill);

        }
        return $controller->redirect('/listCollectionBill');
    }else{
        return $controller->redirect('/login');
    }
}
 
?>