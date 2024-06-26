<?php 	
function listBill(){

	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách phiếu chi';
		$modelMembers = $controller->loadModel('Members');
    	$modelCustomers = $controller->loadModel('Customers');
    	$modelBill = $controller->loadModel('Bills');


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
                    if(!empty($value->id_member_sell) && $value->type_order==1){
                        $member = $modelMembers->find()->where(['id'=>$value->id_member_sell])->first();
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
                if(!empty($item->id_member_sell) && $item->type_order==1){
                	$listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_sell])->first();
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
        $time =time();
        if(!empty($_GET['id'])){
            $bill = $modelBill->get( (int) $_GET['id']);
        }else{
            $bill = $modelBill->newEmptyEntity();
            $bill->created_at = $time;
        }
        $bill->id_member_sell =  0;
        $bill->id_member_buy = $session->read('infoUser')->id;
        $bill->total = @$_GET['total'];
        $bill->id_order = 0;
        $bill->type = 2;
        $bill->type_order = 3; 
        $bill->updated_at = $time;
        $bill->id_debt = 0;
        $bill->type_collection_bill =  @$_GET['type_collection_bill'];
        $bill->id_customer = 0;
        $bill->note =@$_GET['note'];
       
        $modelBill->save($bill);
        return $controller->redirect('/listBill');
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

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách phiếu thu';
        $modelMembers = $controller->loadModel('Members');
        $modelCustomers = $controller->loadModel('Customers');
        $modelBill = $controller->loadModel('Bills');


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
                    if(!empty($value->id_member_buy) && $value->type_order==1){
                        $member = $modelMembers->find()->where(['id'=>$value->id_member_buy])->first();
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

function addCollectionBill($input){
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
        if(!empty($_GET['id'])){
            $bill = $modelBill->get( (int) $_GET['id']);
        }else{
            $bill = $modelBill->newEmptyEntity();
            $bill->created_at = $time;
        }
        $bill->id_member_sell =  $session->read('infoUser')->id;
        $bill->id_member_buy = 0;
        $bill->total = @$_GET['total'];
        $bill->id_order = 0;
        $bill->type = 1;
        $bill->type_order = 3; 
        $bill->updated_at = $time;
        $bill->id_debt = 0;
        $bill->type_collection_bill =  @$_GET['type_collection_bill'];
        $bill->id_customer = 0;
        $bill->note =@$_GET['note'];
       
        $modelBill->save($bill);
        return $controller->redirect('/listCollectionBill');
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

     if(!empty($session->read('infoUser'))){
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

     if(!empty($session->read('infoUser'))){
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

?>