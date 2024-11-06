<?php 	
function listBill(){

	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listBill');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Danh sách phiếu chi';
		$modelMembers = $controller->loadModel('Members');
    	$modelCustomers = $controller->loadModel('Customers');
    	$modelBill = $controller->loadModel('Bills');
        $modelAffiliaters = $controller->loadModel('Affiliaters');


    	$conditions = array('id_member_buy'=>$user->id, 'type'=>2);
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

        if(!empty($_GET['type_collection_bill'])){
            $conditions['type_collection_bill'] = $_GET['type_collection_bill'];
        }
        if(!empty($_GET['id_debt'])){
            $conditions['id_debt'] = $_GET['id_debt'];
        }
        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();

            $titleExcel =   [
                            ['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
                            ['name'=>'Tên', 'type'=>'text', 'width'=>15],
                            ['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
                            ['name'=>'Đội tượng', 'type'=>'text', 'width'=>15],
                            ['name'=>'Tổng số tiền', 'type'=>'number', 'width'=>15],
                            ['name'=>'Hình thức thanh toán', 'type'=>'number', 'width'=>15],
                            ['name'=>'Nội dung', 'type'=>'text', 'width'=>30],
                        ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $name = '';
                    if(!empty($value->id_member_sell)){
                        $member = $modelMembers->find()->where(['id'=>$value->id_member_sell])->first();
                        $name = $member->name;
                        $phone = $member->phone;
                    }

                    if(!empty($value->id_customer)){
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
                    $type_collection_bill;
                    if($value->type_collection_bill=='tien_mat'){
                        $type_collection_bill = 'Tiền mặt';
                    }elseif($value->type_collection_bill=='chuyen_khoan'){
                        $type_collection_bill = 'Chuyển khoản';
                    }elseif($value->type_collection_bill=='the_tin_dung'){
                        $type_collection_bill = 'Thẻ tin dụng';
                    }elseif($value->type_collection_bill=='vi_dien_tu'){
                        $type_collection_bill = 'ví điện tử';
                    }elseif($value->type_collection_bill=='hinh_thuc_khac'){
                        $type_collection_bill = 'hình thức khác';
                    }
                    $dataExcel[] = [
                                date('d/m/Y H:i', $value->time), 
                                $name,
                                $phone,
                                $type,
                                number_format($value->total),
                                $type_collection_bill,
                                $value->note, 
                            ];
                }
            }
            debug($titleExcel);
            debug($dataExcel);
            die;

            export_excel($titleExcel, $dataExcel, 'phieu-thu-'.date('d-m-Y'));
        }else{

            $listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id_member_sell)){
                	$listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_sell])->first();
                }

                if(!empty($item->id_customer)){
                	$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
                }

                if(!empty($item->id_aff)){
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);        
        setVariable('totalMoney', $totalMoney);
        setVariable('urlPage', $urlPage);
        
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

    $metaTitleMantan = 'Thông tin phiếu chi';
    
    $user = checklogin('addBill');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listBill');
        }
        $modelMembers = $controller->loadModel('Members');
        $modelBill = $controller->loadModel('Bills');
        $mess= '';
        
        // lấy data edit
        $time =time();
        if(!empty($_GET['id'])){
            $bill = $modelBill->get( (int) $_GET['id']);
        }else{
            $bill = $modelBill->newEmptyEntity();
            $bill->created_at = $time;
        }
        $bill->id_member_sell =  0;
        $bill->id_member_buy = $user->id;
        $bill->id_staff_buy = $user->id_staff;
        $bill->total = @$_GET['total'];
        $bill->id_order = 0;
        $bill->type = 2;
        $bill->type_order = 3; 
        $bill->updated_at = $time;
        $bill->id_debt = 0;
        $bill->id_staff_sell = 0;
        $bill->type_collection_bill =  @$_GET['type_collection_bill'];
        $bill->id_customer = 0;
        $bill->note =@$_GET['note'];
       
        $modelBill->save($bill);

        $note = $user->type_tv.' '. $user->name.' tạo phiếu thu nội dung thu là '.@$bill->note.' có id là:'.$bill->id;

        addActivityHistory($user,$note,'addBill',$bill->id);

        return $controller->redirect('/listBill?mess=saveSuccess');
    }else{
        return $controller->redirect('/login');
    }
}

function listCollectionBill(){

    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listCollectionBill');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Danh sách phiếu thu';
        $modelMembers = $controller->loadModel('Members');
        $modelCustomers = $controller->loadModel('Customers');
        $modelBill = $controller->loadModel('Bills');


        $conditions = array('id_member_sell'=>$user->id, 'type'=>1);
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

        if(!empty($_GET['type_collection_bill'])){
            $conditions['type_collection_bill'] = $_GET['type_collection_bill'];
        }

        if(!empty($_GET['id_debt'])){
            $conditions['id_debt'] = $_GET['id_debt'];
        }
        
        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

       if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();

            $titleExcel =   [
                            ['name'=>'Thời gian', 'type'=>'text', 'width'=>15],
                            ['name'=>'Tên', 'type'=>'text', 'width'=>15],
                            ['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
                            ['name'=>'Đội tượng', 'type'=>'text', 'width'=>15],
                            ['name'=>'Tổng số tiền', 'type'=>'number', 'width'=>15],
                            ['name'=>'Hình thức thanh toán', 'type'=>'number', 'width'=>15],
                            ['name'=>'Nội dung', 'type'=>'text', 'width'=>30],
                        ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $name = '';
                    if(!empty($value->id_member_buy)){
                        $member = $modelMembers->find()->where(['id'=>$value->id_member_buy])->first();
                        $name = $member->name;
                        $phone = $member->phone;
                    }

                    if(!empty($value->id_customer)){
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
                    $type_collection_bill;
                    if($value->type_collection_bill=='tien_mat'){
                        $type_collection_bill = 'Tiền mặt';
                    }elseif($value->type_collection_bill=='chuyen_khoan'){
                        $type_collection_bill = 'Chuyển khoản';
                    }elseif($value->type_collection_bill=='the_tin_dung'){
                        $type_collection_bill = 'Thẻ tin dụng';
                    }elseif($value->type_collection_bill=='vi_dien_tu'){
                        $type_collection_bill = 'ví điện tử';
                    }elseif($value->type_collection_bill=='hinh_thuc_khac'){
                        $type_collection_bill = 'hình thức khác';
                    }
                    $dataExcel[] = [
                                date('d/m/Y H:i', $value->time), 
                                $name,
                                $phone,
                                $type,
                                number_format($value->total),
                                $type_collection_bill,
                                $value->note, 
                            ];
                }
            }
            
            export_excel($titleExcel, $dataExcel, 'phieu-thu-'.date('d-m-Y'));
        }else{

            $listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id_member_buy)){
                    $listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_buy])->first();
                }

                if(!empty($item->id_customer)){
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


         $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('totalMoney', $totalMoney);


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

    $metaTitleMantan = 'Thông tin phiếu chi';
    
     $user = checklogin('listCollectionBill');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $modelMembers = $controller->loadModel('Members');
        $modelCustomer = $controller->loadModel('Customers');
        $modelBill = $controller->loadModel('Bills');

        $mess= '';

        // lấy data edit
        $time =time();

        if($_GET['typeUser']=='customer'){
            if(!empty($_GET['id_customer_buy'])){
                $customer = $modelCustomer->get((int) $_GET['id_customer_buy']);
                $bill = $modelBill->newEmptyEntity();
                $bill->id_member_sell =  $user->id;
                $bill->id_staff_sell = $user->id_staff;
                $bill->id_member_buy = 0;
                $bill->total = (int) @$_GET['total'];
                $bill->id_order = 0;
                $bill->type = 1;
                $bill->type_order = 2; 
                $bill->updated_at = $time;
                $bill->id_debt = 0;
                $bill->type_collection_bill = @$_GET['type_collection_bill'];
                $bill->id_customer =(int) $_GET['id_customer_buy'];
                $bill->note = 'Đã thu tiền của khách hàng' .@$customer->full_name.' '.@$customer->phone.' với số tiền là '.number_format($bill->total).'đ lý do là: '.@$_GET['note'];
                $modelBill->save($bill);
            }
        }elseif($_GET['typeUser']=='member'){
            if(!empty($_GET['idmember_buy'])){
                $member_buy = $modelMembers->get((int) $_GET['idmember_buy']);

                // bill cho người thu
                $bill = $modelBill->newEmptyEntity();
                $bill->id_member_sell =  $user->id;
                $bill->id_staff_sell = $user->id_staff;
                $bill->id_member_buy = (int) $_GET['idmember_buy'];
                $bill->total = (int) @$_GET['total'];
                $bill->id_order = 0;
                $bill->type = 1;
                $bill->type_order = 1; 
                $bill->created_at = $time;
                $bill->updated_at = $time;
                $bill->id_debt = 0;
                $bill->type_collection_bill =  @$_GET['type_collection_bill'];
                $bill->id_customer = 0;
                $bill->note = 'Đã thu tiền của đại lý' .@$member_buy->name.' '.@$member_buy->phone.' với số tiền là '.number_format($bill->total).'đ lý do thu là:'.@$_GET['note'];
                $modelBill->save($bill);

                // bill cho người chi
                $billbuy = $modelBill->newEmptyEntity();
                $billbuy->id_member_sell =  $user->id;
                $billbuy->id_staff_sell = $user->id_staff;
                $billbuy->id_member_buy = (int) $_GET['idmember_buy'];
                $billbuy->total = (int) @$_GET['total'];
                $billbuy->id_order = 0;
                $billbuy->type = 2;
                $billbuy->type_order = 1; 
                $billbuy->created_at = $time;
                $billbuy->updated_at = $time;
                $billbuy->id_debt = 0;
                $billbuy->type_collection_bill =  @$_GET['type_collection_bill'];
                $billbuy->id_customer = 0;
                $billbuy->note = 'Đã trả tiền cho đại lý' .@$user->name.' '.@$user->phone.' với số tiền là '.number_format($billbuy->total).'đ lý do trả là:'.@$_GET['note'];
                $modelBill->save($billbuy);
            }
        }else{
            
            $bill = $modelBill->newEmptyEntity();
            $bill->id_member_sell =  $session->read('infoUser')->id;
            $bill->id_member_buy = 0;
            $bill->total = (int) @$_GET['total'];
            $bill->id_order = 0;
            $bill->type = 1;
            $bill->type_order = 3; 
            $bill->updated_at = $time;
            $bill->id_debt = 0;
            $bill->type_collection_bill =  @$_GET['type_collection_bill'];
            $bill->id_customer = 0;
            $bill->note = @$_GET['note'];
           
            $modelBill->save($bill);

        }

        $note = $user->type_tv.' '. $user->name.' '.@$bill->note.' có id là:'.$bill->id;

        addActivityHistory($user,$note,'addBill',$bill->id);


        return $controller->redirect('/listCollectionBill?mess=saveSuccess');
    }else{
        return $controller->redirect('/login');
    }
}

function printCollectionBill(){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $session;
    global $type_collection_bill;

    $user = checklogin('printCollectionBill');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCollectionBill');
        }
        $metaTitleMantan = 'Danh sách phiếu thu';

        $modelMember = $controller->loadModel('Members');
        $modelCustomer = $controller->loadModel('Customers');
        $modelBill = $controller->loadModel('Bills');

        $user = $session->read('infoUser');

        $data = $modelBill->get( (int) $_GET['id']);

        if(!empty($data->id_member_buy) && $data->type_order==1){
            $data->member = $modelMember->find()->where(['id'=>$data->id_member_buy])->first();
        }

        if(!empty($item->id_customer) && $data->type_order==2){
            $data->customer = $modelCustomer->find()->where(['id'=>$data->id_customer])->first();
        }

        setVariable('data', $data);

    }else{
        return $controller->redirect('/');
    }
}

function printBill(){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $session;
    global $type_collection_bill;

    $user = checklogin('printBill');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listBill');
        }
       $metaTitleMantan = 'Danh sách phiếu chi';

        $modelMember = $controller->loadModel('Members');
        $modelBill = $controller->loadModel('Bills');
        $modelCustomer = $controller->loadModel('Customers');

        $user = $session->read('infoUser');

        $data = $modelBill->get( (int) $_GET['id']);

        if(!empty($data->id_member_sell) && $data->type_order==1){
            $data->member = $modelMember->find()->where(['id'=>$data->id_member_sell])->first();
        }

        if(!empty($item->id_customer) && $data->type_order==2){
            $data->customer = $modelCustomer->find()->where(['id'=>$data->id_customer])->first();
        }

        setVariable('data', $data);

    }else{
        return $controller->redirect('/');
    }
}

function checkBillOrderMember($input){

    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $session;
    global $type_collection_bill;
    $return = ['code'=>0];
    $metaTitleMantan = 'Danh sách phiếu chi';

    $modelMember = $controller->loadModel('Members');
    $modelBill = $controller->loadModel('Bills');
    $modelDebt = $controller->loadModel('Debts');
    $modelOrderMembers = $controller->loadModel('OrderMembers');

    $listData = $modelOrderMembers->find()->where(array('status_pay'=>'done'))->all()->toList();
    $check = 0;

    if(!empty($listData)){
        foreach($listData as $key =>$item){
            $checkbill = $modelBill->find()->where(array('id_order'=>$item->id,'type_order'=>1,'id_customer'=>0))->all()->toList();
            $checkDebt = $modelDebt->find()->where(array('id_order'=>$item->id,'type_order'=>1,'id_customer'=>0))->all()->toList();

            if(!empty($checkbill)){
                 $check += 0;
            }elseif(!empty($checkDebt)){
                 $check += 0;
            }else{
                $infoMemberBuy = $modelMember->find()->where(['id'=>$item->id_member_buy])->first();
                $infoMemberSell = $modelMember->find()->where(['id'=>$item->id_member_sell])->first();
                 // bill cho người bán 
                $bill = $modelBill->newEmptyEntity();
                $bill->id_member_sell =  $item->id_member_sell;
                $bill->id_member_buy = $item->id_member_buy;
                $bill->total = $item->total;
                $bill->id_order = $item->id;
                $bill->type = 1;
                $bill->type_order = 1; 
                $bill->created_at = $item->create_at;
                $bill->updated_at = $item->create_at;
                $bill->id_debt = 0;
                $bill->type_collection_bill = 'tien_mat';
                $bill->id_customer = 0;
                $bill->note = 'Thanh toán đơn hàng id:'.$item->id.' bán cho đại lý '.@$infoMemberBuy->name.' '.@$infoMemberBuy->phone.';';
                $modelBill->save($bill);

                            // bill cho người mua
                $billbuy = $modelBill->newEmptyEntity();
                $billbuy->id_member_sell =  $item->id_member_sell;
                $billbuy->id_member_buy = $item->id_member_buy;
                $billbuy->total = $item->total;
                $billbuy->id_order = $item->id;
                $billbuy->type = 2;
                $billbuy->type_order = 1; 
                $billbuy->created_at = $item->create_at;
                $billbuy->updated_at = $item->create_at;
                $billbuy->id_debt = 0;
                $billbuy->type_collection_bill = 'tien_mat';
                $billbuy->id_customer = 0;
                $billbuy->note = 'Thanh toán đơn hàng id:'.$item->id.' mua của đại lý '.@$infoMemberSell->name.' '.@$infoMemberSell->phone.';';
                $modelBill->save($billbuy);
                $check += 1;
            }


        }
    }
    echo  'tạo thành '.$check.' đơn chưa có bill';
    die;
}

function checkBillOrderCustomer($input){

    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $session;
    global $type_collection_bill;
    $return = ['code'=>0];
    $metaTitleMantan = 'Danh sách phiếu chi';

    $modelMember = $controller->loadModel('Members');
    $modelBill = $controller->loadModel('Bills');
    $modelDebt = $controller->loadModel('Debts');
    $modelCustomers = $controller->loadModel('Customers');
    $modelOrder = $controller->loadModel('Orders');

    $listData = $modelOrder->find()->where(array('status_pay'=>'done'))->all()->toList();
    $check = 0;

    if(!empty($listData)){
        foreach($listData as $key =>$item){
            $checkbill = $modelBill->find()->where(array('id_order'=>$item->id,'type_order'=>2,'id_member_buy'=>0))->all()->toList();
            $checkDebt = $modelDebt->find()->where(array('id_order'=>$item->id,'type_order'=>2,'id_member_buy'=>0))->all()->toList();



            if(!empty($checkbill)){
                $check += 0;
            }elseif(!empty($checkDebt)){
                $check += 0;
            }else{
                $customer = $modelCustomers->find()->where(['id'=>$item->id_user])->first();
                $infoMemberSell = $modelMember->find()->where(['id'=>$item->id_agency])->first();
                
                $bill = $modelBill->newEmptyEntity();
                $bill->id_member_sell = $infoMemberSell->id;
                $bill->id_member_buy = 0;
                $bill->total = $item->total;
                $bill->id_order = $item->id;
                $bill->type = 1;
                $bill->type_order = 2; 
                $bill->created_at = $item->create_at;
                $bill->updated_at = $item->create_at;
                $bill->id_debt = 0;
                $bill->type_collection_bill =  'tien_mat';
                $bill->id_customer = $item->id_user;
                $bill->note = 'Thanh toán đơn hàng id:'.$item->id.' của khách '.@$customer->full_name.' '.@$customer->phone.';';
                $modelBill->save($bill);
                $check += 1;
                
            }


        }
    }

    echo  'tạo thành '.$check.' đơn chưa có bill';
    die;
}

?>