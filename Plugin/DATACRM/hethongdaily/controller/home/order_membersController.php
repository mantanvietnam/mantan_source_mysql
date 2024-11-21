<?php 
// danh sách yêu cầu nhập hàng vào kho
function requestProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('requestProductAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        
        $metaTitleMantan = 'Danh sách yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelPartner = $controller->loadModel('Partners');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        $conditions = array('id_member_buy'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status_pay'])){
            $conditions['status_pay'] = $_GET['status_pay'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelOrderMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                            $product->unitConversion =   $modelUnitConversion->find()->where(['id_product'=>$value->id_product])->all()->toList();
                            $detail_order[$k]->product = $product;
                        }
                    }

                    $listData[$key]->detail_order = $detail_order;
                }
                if(!empty($item->id_partner)){
                    $listData[$key]->buyer = $modelPartner->find()->where(['id'=>@$item->id_partner])->first();
                }
            }
        }

        // phân trang
        $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();
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
        if(@$_GET['mess']=='done'){
            $mess= '<p class="text-success">Gửi yêu cầu thành công</p>';
        }

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

// tạo yêu cầu nhập hàng vào kho
function addRequestProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $user = checklogin('addRequestProductAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/requestProductAgency');
        }
        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelMembers = $controller->loadModel('Members');
        $modelPartner = $controller->loadModel('Partners');

        $mess = '';

        if($isRequestPost){
            $dataSend = $input['request']->getData();


            if(!empty($dataSend['idHangHoa'])){
                $save = $modelOrderMembers->newEmptyEntity();

                $save->id_member_sell = $user->id_father;
                if(!empty($user->id_father)){
                     $save->id_member_sell= $user->id_father;
                     $save->type = 1;
                     $save->id_partner = 0;
                }else{
                    $save->id_member_sell= 0;
                    $save->type = 2;
                    $save->id_partner = (int)$dataSend['id_partner'];

                }
                $save->id_member_buy = $user->id;
                $save->id_staff_buy = (int)@$user->id_staff;
                $save->note_sell = ''; // ghi chú người bán
                $save->note_buy = $dataSend['note']; // ghi chú người mua 
                $save->status = 'new';
                $save->create_at = time();
                $save->money = (int) $dataSend['total'];
                $save->total = (int) $dataSend['totalPays'];
                $save->status_pay = 'wait';
                $save->discount = $dataSend['promotion'];
                $modelOrderMembers->save($save);

                foreach ($dataSend['idHangHoa'] as $key => $value) {
                    $saveDetail = $modelOrderMemberDetails->newEmptyEntity();

                    $saveDetail->id_product = $value;
                    $saveDetail->id_order_member = $save->id;
                    $saveDetail->quantity = $dataSend['soluong'][$key];
                    $saveDetail->price = $dataSend['money'][$key];
                    $saveDetail->discount = (int) @$dataSend['discount'][$key];
                    $saveDetail->id_unit = (int)$dataSend['id_unit'][$key];
                    $modelOrderMemberDetails->save($saveDetail);
                }
                $note = $user->type_tv.' '. $user->name.' tạo yêu cầu nhập hàng vào kho có id đơn là:'.$save->id;

                addActivityHistory($user,$note,'addRequestProductAgency',$save->id);

                $mess= '<p class="text-success">Gửi yêu cầu thành công</p>';
                 return $controller->redirect('/requestProductAgency?mess=done');
                
            }else{
                $mess= '<p class="text-danger">Không thể tạo đơn do bạn chưa chọn sản phẩm</p>';
            }
        }

        $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        $position = $modelCategories->find()->where(array('id'=>$user->id_position))->first();

        $father = $modelMembers->find()->where(array('id'=>$user->id_father))->first();

        $listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$user->id_system, 'status'=>'active'])->all()->toList();

        $listPartner= $modelPartner->find()->where()->all()->toList();

        setVariable('listProduct', $listProduct);
        setVariable('position', $position);
        setVariable('father', $father);
        setVariable('mess', $mess);
        setVariable('listPartner', $listPartner);
        setVariable('listPositions', $listPositions);
    }else{
        return $controller->redirect('/login');
    }
}

// tạo đơn hàng cho đại lý tuyến dưới
function addOrderAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $user = checklogin('addOrderAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderMemberAgency');
        }

        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelMembers = $controller->loadModel('Members');
        $modelDiscountProductAgency = $controller->loadModel('DiscountProductAgencys');

        $mess = '';

        if($isRequestPost){
            $dataSend = $input['request']->getData();
           

            if(!empty($dataSend['idHangHoa']) && !empty($dataSend['id_member_buy'])){
                $member_buy = $modelMembers->find()->where(array('id'=>(int) $dataSend['id_member_buy']))->first();

                if(!empty($member_buy)){
                    $member_sell = $modelMembers->find()->where(['id'=>$member_buy->id_father])->first();

                    $save = $modelOrderMembers->newEmptyEntity();

                    $save->id_member_sell = $member_buy->id_father;
                    $save->id_member_buy = $member_buy->id;
                    $save->note_sell = '';
                    if($member_sell->id==$user->id){
                         $save->id_staff_sell = (int)@$user->id_staff;
                    }
                    $save->note_buy = $dataSend['note']; // ghi chú người mua  
                    $save->status = 'new';
                    $time_now = explode(' ', $dataSend['time']);
                    $time = explode(':', $time_now[1]);
                    $date = explode('/', $time_now[0]);
                    $save->create_at = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
                    $save->money = (int) $dataSend['total'];
                    $save->total = (int) $dataSend['totalPays'];
                    $save->status_pay = 'wait';
                    $save->discount = $dataSend['promotion'];

                    $costsIncurred = array();
                    $total_costsIncurred = 0;
                    if(!empty($dataSend['costsIncurred'])){
                      
                        foreach($dataSend['costsIncurred'] as $key => $item){
                            $costsIncurred[$dataSend['nameCostsIncurred'][$key]]  = (int) $item;

                        $total_costsIncurred += (int) $item;
                        }
                    }
                    $save->costsIncurred = json_encode($costsIncurred);
                    $save->total_costsIncurred = $total_costsIncurred;

                  

                    $modelOrderMembers->save($save);

                    $productDetail = [];

                    foreach ($dataSend['idHangHoa'] as $key => $value) {
                        $saveDetail = $modelOrderMemberDetails->newEmptyEntity();

                        $saveDetail->id_product = $value;
                        $saveDetail->id_order_member = $save->id;
                        $saveDetail->quantity = (int)$dataSend['soluong'][$key];
                        $saveDetail->price = (int)$dataSend['money'][$key];
                        $saveDetail->discount = (int)$dataSend['discount'][$key];
                        $saveDetail->id_unit = (int)$dataSend['id_unit'][$key];

                        if(!empty($dataSend['discount'][$key])){
                            $checkDiscount = $modelDiscountProductAgency->find()->where(['id_product'=>$value,'id_member_buy'=>$member_buy->id,'id_member_sell'=>$member_buy->id_father ])->first();

                            if(empty($checkDiscount)){
                                $Discount = $modelDiscountProductAgency->newEmptyEntity();
                                $Discount->id_product = $value;
                                $Discount->id_member_sell = $member_buy->id_father;
                                $Discount->id_member_buy = $member_buy->id;
                                $Discount->discount = $dataSend['discount'][$key];
                                $modelDiscountProductAgency->save($Discount);
                            }
                        }

                        $modelOrderMemberDetails->save($saveDetail);

                        $infoProduct = $modelProducts->find()->where(['id'=>$value])->first();
                        $productDetail[] = $infoProduct->title;
                    }
                    $productDetail = implode(',', $productDetail);

                    $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';

                    // gửi thông báo Zalo cho đại lý tuyến dưới
                    if(!empty($member_buy->id) && !empty($member_sell->id)){
                        sendZaloUpdateOrder($member_sell, $member_buy, $save, $productDetail);
                    }

                    $note = $user->type_tv.' '. $user->name.' tạo đơn hàng cho đại lý '.$member_buy->name.'('.$member_buy->phone.') có id đơn là:'.$save->id;

                    addActivityHistory($user,$note,'addOrderAgency',$save->id);

                    return $controller->redirect('/printBillOrderMemberAgency/?id_order_member='.$save->id);
                }else{
                    $mess= '<p class="text-danger">Không tìm thấy đại lý mua hàng</p>';
                }
            }else{
                $mess= '<p class="text-danger">Không thể tạo đơn do bạn chưa chọn sản phẩm</p>';
            }
        }

        $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        // mức chiết khấu của đại lý theo chức danh
        $position = [];
        $member_buy = [];
        $father = [];
        
        $listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$user->id_system, 'status'=>'active'])->all()->toList();

        if(!empty($_GET['id_member_buy'])){
            $member_buy = $modelMembers->find()->where(array('id'=>(int) $_GET['id_member_buy']))->first();

            if(!empty($member_buy)){
                $father = $modelMembers->find()->where(array('id'=>$member_buy->id_father))->first();
                $position = $modelCategories->find()->where(array('id'=>$member_buy->id_position))->first();
            }
        }

        $conditions = array('type' => 'costsIncurred','status'=>'active');
        $costsIncurred = $modelCategories->find()->where($conditions)->all()->toList();

        if(!empty($listProduct)){
            foreach($listProduct as $key => $item){
                if(empty($item->price_agency)){
                    $listProduct[$key]->price_agency = $item->price;
                }
            }
        }
        

        setVariable('listProduct', $listProduct);
        setVariable('position', $position);
        setVariable('father', $father);
        setVariable('mess', $mess);
        setVariable('costsIncurred', $costsIncurred);
        setVariable('member_buy', $member_buy);
        setVariable('listPositions', $listPositions);
    }else{
        return $controller->redirect('/login');
    }
}

// danh sách đơn hàng của hệ thống
function orderMemberAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('orderMemberAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Danh sách đơn hàng đại lý';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        $conditions = array('id_member_sell'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status_pay'])){
            $conditions['status_pay'] = $_GET['status_pay'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        if(!empty($_GET['phone'])){
            $checkMember = $modelMembers->find()->where(['phone'=>$_GET['phone'] ])->first();

            if(!empty($checkMember)){
                $conditions['id_member_buy'] = $checkMember->id;
            }else{
                $conditions['id_member_buy'] = -1;
            }
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelOrderMembers->find()->where($conditions)->order($order)->all()->toList();
            $titleExcel =   [
                ['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Model', 'type'=>'text', 'width'=>15],
                ['name'=>'Số lượng', 'type'=>'text', 'width'=>35],
                ['name'=>'Đơn vị', 'type'=>'text', 'width'=>35],
                ['name'=>'Màu sắc ', 'type'=>'text', 'width'=>15],
                ['name'=>'Thành tiền ', 'type'=>'text', 'width'=>10],
                ['name'=>'Thu khách ', 'type'=>'text', 'width'=>15],
                ['name'=>'NV chốt ', 'type'=>'text', 'width'=>15],
                ['name'=>'Chú ý', 'type'=>'text', 'width'=>15],
                ['name'=>'Mã vận đơn', 'type'=>'text', 'width'=>15],
                ['name'=>'phí shíp', 'type'=>'text', 'width'=>15],
                ['name'=>'tình trạng', 'type'=>'text', 'width'=>15],    
            ];
            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $discount = '';
                    if($value->discount){
                       $pay = json_decode($value->discount, true);

                       if(!empty($pay['code1']) && !empty($pay['discount_price1'])){
                            $discount .=  $pay['code1'] .': -'.number_format($pay['discount_price1']).'đ';
                        }
                        if(!empty($pay['code2']) && !empty($pay['discount_price2'])){
                            $discount .=  $pay['code2'] .': -'.number_format($pay['discount_price2']).'đ';
                        }
                        if(!empty($pay['code3']) && !empty($pay['discount_price3'])){
                            $discount .=  $pay['code3'] .': -'.number_format($pay['discount_price3']).'đ';
                        }
                        if(!empty($pay['code4']) && !empty($pay['discount_price4'])){
                            $discount .=  $pay['code4'] .': -'.number_format($pay['discount_price4']).'đ';
                        }
                    }
                    $status= '';
                    if($value->status=='new'){ 
                        $status= 'Đơn mới';
                     }elseif($value->status=='browser'){
                        $status= 'Đã duyệt';
                     }elseif($value->status=='delivery'){
                        $status= 'Đang giao';
                     }elseif($value->status=='done'){
                        $status= 'Đã xong';
                     }else{
                        $status= 'Đã hủy';
                     }
                    $buyer = $modelMembers->find()->where(['id'=>$item->id_member_buy ])->first();
                    $detail_order = $modelOrderMemberDetails->find()->where(['id_order'=>$value->id])->all()->toList();
                    if(!empty($detail_order)){
                        foreach ($detail_order as $k => $item) {
                            $product = $modelProduct->find()->where(['id'=>$item->id_product ])->first();
                            $priceBuy = $item->price;
                            $priceOld = $item->price;
                            $showDiscount = '';

                             if($item->discount > 0){
                              $priceDiscount = $value->discount;

                              if($priceDiscount<=100){
                                  $priceDiscount= $priceBuy*$item->discount/100;
                                  $showDiscount = $value->discount.'%';
                              }else{
                                  $showDiscount = number_format($item->discount).'đ';
                              }

                              $priceBuy -= $priceDiscount;
                            }

                            if($priceBuy != $priceOld){
                              $showPrice = $priceOld;
                            }else{
                              $showPrice = $priceBuy;
                            }

                            if(!empty($product)){
                                $unit = $product->unit;
                                if(!empty($item->id_unit)){
                                    $unit = $modelUnitConversion->find()->where(['id_product'=>$value->id_product])->first()->unit;
                                }
                            
                                $dataExcel[] = [
                                                date('H:i d/m/Y', $value->create_at), 
                                                @$buyer->name,   
                                                @$buyer->phone,   
                                                @$buyer->address,   
                                                $product->title,
                                                $item->quantity,
                                                $unit,
                                                '',
                                                $showPrice*$item->quantity,
                                                '', 
                                                '',
                                                @$value->note_user,
                                                @$value->id,
                                                '',
                                                $status,
                                            ];
                            }
                        }
                    }
                }
            }
           export_excel($titleExcel,$dataExcel,'danh_sach_don_hang');
        }else{
        
            $listData = $modelOrderMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                            $product->unitConversion =   $modelUnitConversion->find()->where(['id_product'=>$value->id_product])->all()->toList();
                            $detail_order[$k]->product = $product;
                        }
                    }

                    $listData[$key]->detail_order = $detail_order;
                }

                $listData[$key]->buyer = $modelMembers->find()->where(['id'=>$item->id_member_buy ])->first();
            }
        }

        // phân trang
        $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();

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
        setVariable('totalMoney', $totalMoney);
    }else{
        return $controller->redirect('/login');
    }
}

// cập nhập trạng thái đơn hàng
function updateOrderMemberAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('updateOrderMemberAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderMemberAgency');
        }
        $metaTitleMantan = 'Cập nhập đơn hàng đại lý';
        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelBill = $controller->loadModel('Bills');
        $modelDebt = $controller->loadModel('Debts');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelTokenDevices = $controller->loadModel('TokenDevices');
        $modelTransactionAgencyHistorie = $controller->loadModel('TransactionAgencyHistories');

        if(!empty($_GET['id'])){
            $order = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id'], 'id_member_sell'=>$user->id])->first();
              $note = '';
            if(!empty($order)){
                $infoMemberBuy = $modelMembers->find()->where(['id'=>$order->id_member_buy])->first();
                if(!empty($_GET['status'])){
                    $order->status = $_GET['status'];
                   
                    // nhập hàng vào kho
                    if($_GET['status'] == 'done'){
                        $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();
                
                        if(!empty($detail_order)){
                            foreach ($detail_order as $k => $value) {
                                $quantity = $value->quantity;
                                if(!empty($value->id_unit)){
                                    $unit = $modelUnitConversion->find()->where(['id_product'=>$value->id_product,'id'=>$value->id_unit])->first();
                                    if(!empty($unit)){
                                        $quantity = $value->quantity*$unit->quantity;
                                    }
                                }


                                // cộng hàng vào kho người mua
                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_buy])->first();

                                if(empty($checkProductExits)){
                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                    $checkProductExits->quantity = 0;
                                }

                                $checkProductExits->id_member = $order->id_member_buy;
                                $checkProductExits->id_product = $value->id_product;
                                $checkProductExits->quantity += $quantity;

                                $modelWarehouseProducts->save($checkProductExits);

                                // thông báo cho người mua

                                if(!empty($infoMemberBuy->noti_product_warehouse)){
                                    $dataSendNotification= array('title'=>'Nhập hàng vào kho','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của bạn đã được nhập kho','action'=>'addProductWarehouse');
                                    $token_device = [];

                                    $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberBuy->id])->all()->toList();

                                    if(!empty($listTokenDevice)){
                                        foreach ($listTokenDevice as $tokenDevice) {
                                            if(!empty($tokenDevice->token_device)){
                                                $token_device[] = $tokenDevice->token_device;
                                            }
                                        }

                                        if(!empty($token_device)){
                                            $return = sendNotification($dataSendNotification, $token_device);
                                        }
                                    }
                                }

                                // trừ hàng trong kho người bán
                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_sell])->first();

                                if(empty($checkProductExits)){
                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                    $checkProductExits->quantity = 0;
                                }

                                $checkProductExits->id_member = $order->id_member_sell;
                                $checkProductExits->id_product = $value->id_product;
                                $checkProductExits->quantity -= $quantity;

                                $modelWarehouseProducts->save($checkProductExits);

                                // thông báo cho người bán
                                $infoMemberSell = $modelMembers->find()->where(['id'=>$order->id_member_sell])->first();

                                if(!empty($infoMemberSell->noti_product_warehouse)){
                                    $dataSendNotification= array('title'=>'Trừ hàng trong kho','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của đại lý '.$infoMemberBuy->name.' đã hoàn thành','action'=>'deleteProductWarehouse','id_order_member'=>$order->id);
                                    $token_device = [];

                                    $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberSell->id])->all()->toList();

                                    if(!empty($listTokenDevice)){
                                        foreach ($listTokenDevice as $tokenDevice) {
                                            if(!empty($tokenDevice->token_device)){
                                                $token_device[] = $tokenDevice->token_device;
                                            }
                                        }

                                        if(!empty($token_device)){
                                            $return = sendNotification($dataSendNotification, $token_device);
                                        }
                                    }
                                }

                                if(!empty($value->price)){
                                    $type_sale = 'paid';
                                }else{
                                    $type_sale = 'free';
                                }

                                // lưu lịch sử nhập kho của người mua
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $order->id_member_buy;
                                $saveWarehouseHistories->id_product = $value->id_product;
                                $saveWarehouseHistories->quantity = $quantity;
                                $saveWarehouseHistories->note = 'Nhập hàng vào kho';
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'plus';
                                $saveWarehouseHistories->type_sale = $type_sale;
                                $saveWarehouseHistories->id_order_member = $order->id;

                                $modelWarehouseHistories->save($saveWarehouseHistories);

                                // lưu lịch sử xuất kho của người bán
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $order->id_member_sell;
                                $saveWarehouseHistories->id_product = $value->id_product;

                                $saveWarehouseHistories->quantity = $quantity;
                                $saveWarehouseHistories->note = 'Xuất hàng cho đại lý tuyến dưới';
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'minus';
                                $saveWarehouseHistories->type_sale = $type_sale;
                                $saveWarehouseHistories->id_order_member = $order->id;

                                $modelWarehouseHistories->save($saveWarehouseHistories);
                            }
                        }

                        $note = $user->type_tv.' '. $user->name.'đã xử lý hoàn thành đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;

                    }elseif($_GET['status'] == 'browser'){
                     $note = $user->type_tv.' '. $user->name.' đã xử lý phê duyệt đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
                    }elseif($_GET['status'] == 'delivery'){
                     $note = $user->type_tv.' '. $user->name.' đã xử lý giao hàng đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
                    }elseif($_GET['status'] == 'cancel'){
                     $note = $user->type_tv.' '. $user->name.' đã xử lý hủy đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
                    }

                    
                }

                if(!empty($_GET['status_pay'])){
                    $order->status_pay = $_GET['status_pay'];

                    if($_GET['status_pay'] == 'done'){
                        // thông báo cho người mua

                        if(!empty($infoMemberBuy->noti_new_order)){
                            $dataSendNotification= array('title'=>'Thanh toán thành công','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của bạn đã được thanh toán thành công số tiền '.number_format($order->total).'đ','action'=>'deleteProductWarehouse','id_order_member'=>$order->id);
                            $token_device = [];

                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberBuy->id])->all()->toList();

                            if(!empty($listTokenDevice)){
                                foreach ($listTokenDevice as $tokenDevice) {
                                    if(!empty($tokenDevice->token_device)){
                                        $token_device[] = $tokenDevice->token_device;
                                    }
                                }

                                if(!empty($token_device)){
                                    $return = sendNotification($dataSendNotification, $token_device);
                                }
                            }
                        }

                        // thông báo cho người bán
                        $infoMemberSell = $modelMembers->find()->where(['id'=>$order->id_member_sell])->first();

                        if(!empty($infoMemberSell->noti_product_warehouse)){
                            $dataSendNotification= array('title'=>'Thanh toán thành công','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của đại lý '.$infoMemberBuy->name.' đã được thanh toán thành công số tiền '.number_format($order->total).'đ','action'=>'deleteProductWarehouse','id_order_member'=>$order->id);
                            $token_device = [];

                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberSell->id])->all()->toList();

                            if(!empty($listTokenDevice)){
                                foreach ($listTokenDevice as $tokenDevice) {
                                    if(!empty($tokenDevice->token_device)){
                                        $token_device[] = $tokenDevice->token_device;
                                    }
                                }

                                if(!empty($token_device)){
                                    $return = sendNotification($dataSendNotification, $token_device);
                                }
                            }
                        }
                        $time= time();
                        if($_GET['type_collection_bill']!='cong_no'){

                            // bill cho người bán 
                            $bill = $modelBill->newEmptyEntity();
                            $bill->id_member_sell =  $user->id;
                            $bill->id_staff_sell =  (int)@$user->id_staff;
                            $bill->id_staff_buy =  $order->id_staff_buy;
                            $bill->id_member_buy = $order->id_member_buy;
                            $bill->total = $order->total;
                            $bill->id_order = $order->id;
                            $bill->type = 1;
                            $bill->type_order = 1; 
                            $bill->created_at = $time;
                            $bill->updated_at = $time;
                            $bill->id_debt = 0;
                            $bill->type_collection_bill =  @$_GET['type_collection_bill'];
                            $bill->id_customer = 0;
                            $bill->note = 'Thanh toán đơn hàng id:'.$order->id.' bán cho đại lý '.@$infoMemberBuy->name.' '.@$infoMemberBuy->phone.'; '.@$_GET['note'];
                            $modelBill->save($bill);

                            // bill cho người mua
                            $billbuy = $modelBill->newEmptyEntity();
                            $billbuy->id_member_sell =  $user->id;
                            $billbuy->id_member_buy = $order->id_member_buy;
                            $billbuy->id_staff_sell =  (int)@$user->id_staff;
                            $billbuy->id_staff_buy =  $order->id_staff_buy;
                            $billbuy->total = $order->total;
                            $billbuy->id_order = $order->id;
                            $billbuy->type = 2;
                            $billbuy->type_order = 1; 
                            $billbuy->created_at = $time;
                            $billbuy->updated_at = $time;
                            $billbuy->id_debt = 0;
                            $billbuy->type_collection_bill =  @$_GET['type_collection_bill'];
                            $billbuy->id_customer = 0;
                            $billbuy->note = 'Thanh toán đơn hàng id:'.$order->id.' mua của đại lý '.@$infoMemberSell->name.' '.@$infoMemberSell->phone.'; '.@$_GET['note'];
                            $modelBill->save($billbuy);
                        }else{
                            if(!empty($infoMemberBuy)){
                                $debt = $modelDebt->newEmptyEntity();
                                $debt->id_member_sell =  $user->id;
                                $debt->id_member_buy = $order->id_member_buy;
                                $debt->id_staff_sell =  (int)@$user->id_staff;
                                $debt->id_staff_buy =  $order->id_staff_buy;
                                $debt->total = $order->total;
                                $debt->id_order = $order->id;
                                $debt->number_payment = 0;
                                $debt->total_payment = 0;
                                $debt->type = 1;
                                $debt->status = 0;
                                $debt->type_order = 1; 
                                $debt->created_at = $time;
                                $debt->updated_at = $time;
                                $debt->id_customer = 0;
                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' bán cho đại lý '.@$infoMemberBuy->name.' '.@$infoMemberBuy->phone.'; '.@$_GET['note'];
                                    $modelDebt->save($debt);
                            }

                            $debt = $modelDebt->newEmptyEntity();
                                $debt->id_member_sell =  $user->id;
                                $debt->id_member_buy = $order->id_member_buy;
                                $debt->id_staff_sell =  (int)@$user->id_staff;
                                $debt->id_staff_buy =  $order->id_staff_buy;
                                $debt->total = $order->total;
                                $debt->id_order = $order->id;
                                $debt->number_payment = 0;
                                $debt->total_payment = 0;
                                $debt->type = 2;
                                $debt->status = 0;
                                $debt->type_order = 1; 
                                $debt->created_at = $time;
                                $debt->updated_at = $time;
                                $debt->id_customer = 0;
                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' mua của đại lý '.@$infoMemberSell->name.' '.@$infoMemberSell->phone.'; '.@$_GET['note'];
                                    $modelDebt->save($debt);
                        }


                        // cộng hoa hông cho đại lý giời thiệu
                        if(!empty($infoMemberBuy->id_agency_introduce) && !empty($infoMemberBuy->id_father)  && !empty($user->agent_commission) && !empty($order->total)){
                            if($infoMemberBuy->id_father == $user->id){


                                $money_back = $user->agent_commission * $order->total / 100;
                
                                // lưu lịch sử trích hoa hồng
                                $saveBack = $modelTransactionAgencyHistorie->newEmptyEntity();
                
                                $saveBack->id_agency_introduce = $infoMemberBuy->id_agency_introduce;
                                $saveBack->money_total = $order->total;
                                $saveBack->money_back = $money_back;
                                $saveBack->percent = $user->agent_commission;
                                $saveBack->id_order_member = $order->id;
                                $saveBack->create_at = time();
                                $saveBack->status = 'new';
                                $saveBack->id_member = $user->id;
                                $modelTransactionAgencyHistorie->save($saveBack);

                            }
                        }

                        $note = $user->type_tv.' '. $user->name.' đã xử lý Thanh toán đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;

                    }
                }

                addActivityHistory($user,$note,'updateOrderMemberAgency',$order->id);

                $modelOrderMembers->save($order);

                if(!empty($_GET['back'])){
                    return $controller->redirect($_GET['back']);
                }else{
                    return $controller->redirect('/orderMemberAgency');
                }
            }
        }else{
            return $controller->redirect('/orderMemberAgency');
        }

    }else{
        return $controller->redirect('/login');
    }
}

// tự cập nhập trạng thái đơn hàng của mình
function updateMyOrderMemberAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

        $user = checklogin('updateMyOrderMemberAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/requestProductAgency');
        }
        $metaTitleMantan = 'Cập nhập đơn hàng đại lý';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelPartner = $controller->loadModel('Partners');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelTokenDevices = $controller->loadModel('TokenDevices');
        $modelBill = $controller->loadModel('Bills');
        $modelDebt = $controller->loadModel('Debts');

        if(!empty($_GET['id'])){
            $order = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id'], 'id_member_buy'=>$user->id])->first();

            if(!empty($order)){
                $note = '';
                if(!empty($_GET['status'])){
                    $order->status = $_GET['status'];

                    // nhập hàng vào kho
                    if($_GET['status'] == 'done'){
                        $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();
                
                        if(!empty($detail_order)){
                            foreach ($detail_order as $k => $value) {
                                $quantity = $value->quantity;
                                if(!empty($value->id_unit)){
                                    $unit = $modelUnitConversion->find()->where(['id_product'=>$value->id_product,'id'=>$value->id_unit])->first();
                                    if(!empty($unit)){
                                        $quantity = $value->quantity*$unit->quantity;
                                    }
                                }

                                if(!empty($value->price)){
                                    $type_sale = 'paid';
                                }else{
                                    $type_sale = 'free';
                                }

                                // cộng hàng vào kho người mua
                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_buy])->first();

                                if(empty($checkProductExits)){
                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                    $checkProductExits->quantity = 0;
                                }

                                $checkProductExits->id_member = $order->id_member_buy;
                                $checkProductExits->id_product = $value->id_product;
                                $checkProductExits->quantity += $quantity;

                                $modelWarehouseProducts->save($checkProductExits);



                                // trừ hàng trong kho người bán
                                if(!empty($order->id_member_sell)){
                                    $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_sell])->first();

                                    if(empty($checkProductExits)){
                                        $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                        $checkProductExits->quantity = 0;
                                    }

                                    $checkProductExits->id_member = $order->id_member_sell;
                                    $checkProductExits->id_product = $value->id_product;
                                    $checkProductExits->quantity -= $quantity;

                                    $modelWarehouseProducts->save($checkProductExits);

                                    // lưu lịch sử xuất kho của người bán
                                    $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                    $saveWarehouseHistories->id_member = $order->id_member_sell;
                                    $saveWarehouseHistories->id_product = $value->id_product;
                                    $saveWarehouseHistories->quantity = $quantity;
                                    $saveWarehouseHistories->note = 'Xuất hàng cho đại lý tuyến dưới';
                                    $saveWarehouseHistories->create_at = time();
                                    $saveWarehouseHistories->type = 'minus';
                                    $saveWarehouseHistories->type_sale = $type_sale;
                                    $saveWarehouseHistories->id_order_member = $order->id;

                                    $modelWarehouseHistories->save($saveWarehouseHistories);
                                }

                                // lưu lịch sử nhập kho của người mua
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();
                                
                                $saveWarehouseHistories->id_member = $order->id_member_buy;
                                $saveWarehouseHistories->id_product = $value->id_product;
                                $saveWarehouseHistories->quantity = $quantity;
                                $saveWarehouseHistories->note = 'Nhập hàng vào kho';
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'plus';
                                $saveWarehouseHistories->type_sale = $type_sale;
                                
                                $saveWarehouseHistories->id_order_member = $order->id;
                                $modelWarehouseHistories->save($saveWarehouseHistories);
                            }
                        }
                    }
                }        
                if(!empty($_GET['status_pay'])){
                    $order->status_pay = $_GET['status_pay'];


                    if($_GET['status_pay'] == 'done'){
                        // thông báo cho người mua
                        $infoMemberSell = $modelPartner->find()->where(['id'=>@$order->id_partner])->first();
                        $infoMemberBuy = $modelMembers->find()->where(['id'=>@$order->id_member_buy])->first();

                        if(!empty($infoMemberBuy->noti_new_order)){
                            $dataSendNotification= array('title'=>'Thanh toán thành công','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của bạn đã được thanh toán thành công số tiền '.number_format($order->total).'đ','action'=>'deleteProductWarehouse','id_order_member'=>$order->id);
                            $token_device = [];

                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberBuy->id])->all()->toList();

                            if(!empty($listTokenDevice)){
                                foreach ($listTokenDevice as $tokenDevice) {
                                    if(!empty($tokenDevice->token_device)){
                                        $token_device[] = $tokenDevice->token_device;
                                    }
                                }

                                if(!empty($token_device)){
                                    $return = sendNotification($dataSendNotification, $token_device);
                                }
                            }
                        }

                       

                     
                        $time= time();
                        if($_GET['type_collection_bill']!='cong_no'){
                            // bill cho người mua
                            $billbuy = $modelBill->newEmptyEntity();
                            $billbuy->id_member_sell =  0;
                            $billbuy->id_member_buy = $order->id_member_buy;
                            $billbuy->id_staff_sell =  0;
                            $billbuy->id_partner =  (int) @$infoMemberSell->id;
                            $billbuy->id_staff_buy =  0;
                            $billbuy->total = $order->total;
                            $billbuy->id_order = $order->id;
                            $billbuy->type = 2;
                            $billbuy->type_order = 5; 
                            $billbuy->created_at = $time;
                            $billbuy->updated_at = $time;
                            $billbuy->id_debt = 0;
                            $billbuy->type_collection_bill =  @$_GET['type_collection_bill'];
                            $billbuy->id_customer = 0;
                            $billbuy->note = 'Thanh toán đơn hàng id:'.$order->id.' mua của đối tác '.@$infoMemberSell->name.' '.@$infoMemberSell->phone.'; '.@$_GET['note'];
                            $modelBill->save($billbuy);
                        }else{
                            if(!empty($infoMemberBuy)){
                                $debt = $modelDebt->newEmptyEntity();
                                $debt->id_member_sell =  0;
                                $debt->id_member_buy = $order->id_member_buy;
                                $bill->id_staff_buy =  $order->id_staff_buy;
                                $debt->total = $order->total;
                                $debt->id_partner =  (int) @$infoMemberSell->id;
                                $debt->id_order = $order->id;
                                $debt->number_payment = 0;
                                $debt->total_payment = 0;
                                $debt->type = 2;
                                $debt->status = 0;
                                $debt->type_order = 5; 
                                $debt->created_at = $time;
                                $debt->updated_at = $time;
                                $debt->id_customer = 0;
                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' mua của đối tác '.@$infoMemberBuy->name.' '.@$infoMemberBuy->phone.'; '.@$_GET['note'];
                                    $modelDebt->save($debt);
                            }
                        }

                        $note = $user->type_tv.' '. $user->name.' đã xử lý Thanh toán đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
                    }

                }
                



                    $note = $user->type_tv.' '. $user->name.' đã xử lý nhập đơn hàng vào kho, có id đơn là:'.$order->id;


                

                addActivityHistory($user,$note,'updateOrderMemberAgency',$order->id);
               
            
                $modelOrderMembers->save($order);

                if(!empty($_GET['back'])){
                    return $controller->redirect($_GET['back']);
                }else{
                    return $controller->redirect('/requestProductAgency');
                }
            }
        }else{
            return $controller->redirect('/requestProductAgency');
        }

    }else{
        return $controller->redirect('/login');
    }
}

// tạo phiếu in bill 
function printBillOrderMemberAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('printBillOrderMemberAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderMemberAgency');
        }
        $metaTitleMantan = 'Phiếu đơn hàng';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        if(!empty($_GET['id_order_member'])){
            $order = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id_order_member'], 'id_member_sell'=>$user->id])->first();

            if(!empty($order)){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();

                $order->detail = [];
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $value->product = $modelProducts->find()->where(['id'=>(int) $value->id_product])->first();

                        $order->detail[$k] = $value;
                    }
                }

                $system = $modelCategories->find()->where(['id'=>(int) $user->id_system])->first();

                $member_sell = $modelMembers->find()->where(['id'=>(int) $order->id_member_sell])->first();
                $member_buy = $modelMembers->find()->where(['id'=>(int) $order->id_member_buy])->first();

                setVariable('order', $order);
                setVariable('system', $system);
                setVariable('member_sell', $member_sell);
                setVariable('member_buy', $member_buy);
            }else{
                return $controller->redirect('/orderMemberAgency');
            }
        }else{
            return $controller->redirect('/orderMemberAgency');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function AjaxDiscountProductAgency($input){
    global $controller;
    global $isRequestPost;

    $modelDiscountProductAgency = $controller->loadModel('DiscountProductAgencys');
    $modelMembers = $controller->loadModel('Members');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id_product']) && !empty($dataSend['id_member_buy'])){
            
            $member_buy = $modelMembers->find()->where(array('id'=>(int) $dataSend['id_member_buy']))->first();
            
            $checkDiscount = $modelDiscountProductAgency->find()->where(['id_product'=>$dataSend['id_product'],'id_member_buy'=>$dataSend['id_member_buy'],'id_member_sell'=>$member_buy->id_father])->first();
            
            if(!empty($checkDiscount->discount)){
                return array('code'=>1, 'mess'=>'lấy dữ liệu thành công' ,'discount'=> $checkDiscount->discount);
            }

             return array('code'=>1, 'mess'=>'lấy dữ liệu thành công' ,'discount'=>0);
        }
        return array('code'=>2, 'mess'=>'nhập thiếu dữ liệu');

    }
}

function editOrderMemberAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

        $user = checklogin('editOrderMemberAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderMemberAgency');
        }
        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelMembers = $controller->loadModel('Members');
        $modelPartner = $controller->loadModel('Partners');
        $modelDiscountProductAgency = $controller->loadModel('DiscountProductAgencys');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        $mess = '';
        $order =$modelOrderMembers->find()->where(array('id'=>(int)$_GET['id'],'status'=>'new'))->first();
        if(empty($order)){
            return $controller->redirect('/orderMemberAgency');
        }

        if($user->id==$order->id_member_sell){
            $type = 'sell';
        }elseif($user->id==$order->id_member_buy){
            $type = 'buy';
        }

         // mức chiết khấu của đại lý theo chức danh
        $position = [];
         $member_buy = [];
         $id_member_sell = [];
         $member_sell = [];
        $father = [];

       
        if(!empty($order->id_member_buy)){
            $member_buy = $modelMembers->find()->where(array('id'=>(int) $order->id_member_buy))->first();
            if(!empty($member_buy)){
                $father = $modelMembers->find()->where(array('id'=>$member_buy->id_father))->first();
                $position = $modelCategories->find()->where(array('id'=>$member_buy->id_position))->first();
            }
        }

        if(!empty($order->id_member_sell)){
            $member_sell = $modelMembers->find()->where(array('id'=>(int) $order->id_member_sell))->first();

        }
        $infoParent = [];
        if(!empty($order->id_partner)){
            $infoParent = $modelPartner->find()->where(array('id'=>(int) $order->id_partner))->first();            
        }

     


        if($isRequestPost){
            $dataSend = $input['request']->getData();
            
            $order->note_buy = $dataSend['note']; // ghi chú người mua  
            $order->status = 'new';
            $order->money = (int) $dataSend['total'];
            $order->total = (int) $dataSend['totalPays'];
            $order->status_pay = 'wait';
            $order->discount = $dataSend['promotion'];
            $costsIncurred = array();
            $total_costsIncurred = 0;
            
            if(!empty($dataSend['costsIncurred'])){
                
                foreach($dataSend['costsIncurred'] as $key => $item){
                    $costsIncurred[$dataSend['nameCostsIncurred'][$key]]  = (int) $item;
                    $total_costsIncurred += (int) $item;
                }
            }
            $order->costsIncurred = json_encode($costsIncurred);
            $order->total_costsIncurred = $total_costsIncurred;

            $modelOrderMembers->save($order);


            $modelOrderMemberDetails->deleteAll(array('id_order_member'=>(int) $order->id));
            foreach ($dataSend['idHangHoa'] as $key => $value) {
                $saveDetail = $modelOrderMemberDetails->newEmptyEntity();

                $saveDetail->id_product = $value;
                $saveDetail->id_order_member = $order->id;
                $saveDetail->quantity = (int)$dataSend['soluong'][$key];
                $saveDetail->price = (int)$dataSend['money'][$key];
                $saveDetail->discount = (int)$dataSend['discount'][$key];
                $saveDetail->id_unit = (int)$dataSend['id_unit'][$key];

                if(!empty($dataSend['discount'][$key])){
                    $checkDiscount = $modelDiscountProductAgency->find()->where(['id_product'=>$value,'id_member_buy'=>$order->id_member_sell,'id_member_sell'=>$order->id_member_sell ])->first();

                    if(empty($checkDiscount)){
                        $Discount = $modelDiscountProductAgency->newEmptyEntity();
                        $Discount->id_product = $value;
                        $Discount->id_member_sell = $order->id_member_sell;
                        $Discount->id_member_buy = $order->id_member_buy;
                        $Discount->discount = $dataSend['discount'][$key];
                        $modelDiscountProductAgency->save($Discount);
                    }
                }

                $modelOrderMemberDetails->save($saveDetail);
            }
            $orderDetail = $modelOrderMemberDetails->find()->where(array('id_order_member'=>$order->id))->all()->toList();

            $note = $user->type_tv.' '. $user->name.' đã xử lý sửa đơn hàng cho đại lý '.$member_buy->name.'('.$member_buy->phone.') có id đơn là:'.$order->id;

            addActivityHistory($user,$note,'editOrderMemberAgency',$order->id);

            if($type=='sell'){
                return $controller->redirect('/orderMemberAgency?id='.$order->id);
            }else{
                return $controller->redirect('/requestProductAgency?id='.$order->id);
            }              
        }

         $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

       
        
        $listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$user->id_system, 'status'=>'active'])->all()->toList();

         $orderDetail = $modelOrderMemberDetails->find()->where(array('id_order_member'=>$order->id))->all()->toList();

        if(!empty($orderDetail)){
            foreach($orderDetail as $key => $item){
                $orderDetail[$key]->product = $modelProducts->find()->where(array('id'=>$item->id_product))->first();

                $orderDetail[$key]->unitConversion = $modelUnitConversion->find()->where(['id_product'=>$item->id_product])->all()->toList();
            }




        }
        $conditions = array('type' => 'costsIncurred','status'=>'active');
        $costsIncurred = $modelCategories->find()->where($conditions)->all()->toList();

       
        $readonly = '';
        if($type=='buy' && $user->id_father!=0){
            $readonly = 'readonly';
        }
     
        setVariable('order', $order);
        setVariable('orderDetail', $orderDetail);
        setVariable('member_buy', $member_buy);
        setVariable('member_sell', $member_sell);
        setVariable('infoParent', $infoParent);
        setVariable('type', $type);
        setVariable('listProduct', $listProduct);
        setVariable('readonly', $readonly);
        setVariable('position', $position);
        setVariable('father', $father);
        setVariable('costsIncurred', $costsIncurred);
        setVariable('mess', $mess);
        setVariable('listPositions', $listPositions);

    }else{
        return $controller->redirect('/login');
    }
}

function deleteOrderMemberAgency($input){
    global $controller;
    global $session;

    $user = checklogin('deleteOrderMemberAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        $modelBill = $controller->loadModel('Bills');
        $modelDebt = $controller->loadModel('Debts');
        $modelCustomers = $controller->loadModel('Customers');
        $modelMembers = $controller->loadModel('Members');
        
        if(!empty($_GET['id'])){
            $data = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id']])->first();
            
            if(!empty($data)){
                if(!empty($data->id_member_sell)){
                    $member_sell =  $modelMembers->find()->where(array('id'=>(int) $data->id_member_sell))->first();
                }
                if(!empty($data->id_member_buy)){
                    $member_buy = $modelMembers->find()->where(array('id'=>(int) $data->id_member_buy))->first();
                }
                if(!empty($member_sell) && $user->id==$member_sell->id){
                    $note = $user->type_tv.' '. $user->name.' đã xóa đơn hàng của đại lý '.@$customer_buy->full_name.'('.@$customer_buy->phone.') có id đơn là:'.$data->id;
                }elseif(!empty($member_buy) && $user->id==$member_buy->id){
                    $note = $user->type_tv.' '. $user->name.' đã xóa đơn hàng có id đơn là:'.$data->id;
                }else{
                   return $controller->redirect('/statisticAgency'); 
                }
                

                addActivityHistory($user,$note,'deleteOrderMemberAgency',$data->id);

                $modelOrderMembers->delete($data);
                $modelOrderMemberDetails->deleteAll(['id_order_member'=>$data->id]);
                $modelBill->deleteAll(['id_order'=>$data->id,'type_order'=>1]);
                $modelDebt->deleteAll(['id_order'=>$data->id,'type_order'=>1]);

                if(!empty($member_sell) && $user->id==$member_sell->id){
                    return $controller->redirect('/orderMemberAgency');
                }elseif(!empty($member_buy) && $user->id==$member_buy->id){
                    return $controller->redirect('/requestProductAgency');
                }
            }
        }

        return $controller->redirect('/statisticAgency');
    }else{
        return $controller->redirect('/login');
    }
}

function listTransactionAgencyHistorie(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Lịch sử giao dịch';

   $user = checklogin('listTransactionAgencyHistorie');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderMemberAgency');
        }


        $modelMember = $controller->loadModel('Members');

        $modelTransactionAgencyHistorie = $controller->loadModel('TransactionAgencyHistories');


        $conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_agency_introduce'])){
            $conditions['id_agency_introduce'] = (int) $_GET['id_agency_introduce'];
        }

        if(!empty($_GET['id_order_member'])){
            $conditions['id_order_member'] = (int) $_GET['id_order_member'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelTransactionAgencyHistorie->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'ID đơn hàng', 'type'=>'text', 'width'=>25],
                ['name'=>'Giá trị đơn hàng', 'type'=>'text', 'width'=>25],
                ['name'=>'Tiền hoa hồng', 'type'=>'text', 'width'=>25],
                ['name'=>'Phần trăm chiết khấu', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $agency = $modelMember->find()->where(['id'=>$value->id_agency_introduce])->first();

                    $status = 'Chưa thanh toán';
                    if($value->status == 'done'){
                        $status = 'Đã thanh toán';
                    }

                    $dataExcel[] = [
                                        @$agency->name,   
                                        $agency->phone,   
                                        $value->id_order_member,   
                                        $value->money_total,   
                                        $value->money_back,   
                                        $value->percent,   
                                        $status
                                    ];
                }
            }
           export_excel($titleExcel,$dataExcel,'danh_sach_lich_su_giao_dich_hoa_hong_dai_ly_gioi_thieu');
        }else{
            $listData = $modelTransactionAgencyHistorie->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $listData[$key]->agency = $modelMember->find()->where(['id'=>$value->id_agency_introduce])->first();
                }
            }
        }

       
        // phân trang
        $totalData = $modelTransactionAgencyHistorie->find()->where($conditions)->all()->toList();
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

function payTransactionAgency($input)
{
    global $controller;
    global $session;
    $modelMember = $controller->loadModel('Members');
    $modelTransactionAgencyHistorie = $controller->loadModel('TransactionAgencyHistories');
    $modelBill = $controller->loadModel('Bills');
    $user = checklogin('payTransactionAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderMemberAgency');
        }
        if(!empty($_GET['id'])){
            $data = $modelTransactionAgencyHistorie->get($_GET['id']);
            
            if(!empty($data)){
                $aff = $modelMember->get($data->id_agency_introduce);
                $data->status = 'done';

                $modelTransactionAgencyHistorie->save($data);
                $time= time();
                 // bill cho người mua
                $billbuy = $modelBill->newEmptyEntity();
                $billbuy->id_member_sell = $data->id_agency_introduce;
                $billbuy->id_member_buy =  $user->id;
                $billbuy->total = $data->money_back;
                $billbuy->id_order = $data->id;
                $billbuy->type = 2;
                $billbuy->type_order = 6; 
                $billbuy->created_at = $time;
                $billbuy->updated_at = $time;
                $billbuy->id_debt = 0;
                $billbuy->type_collection_bill =  @$_GET['type_collection_bill'];
                $billbuy->id_customer = 0;
                $billbuy->id_aff = 0;
                $billbuy->note = 'Thanh toán chiết khấu hoa hông cho đại lý giới thiệu tên là '.@$aff->name.' '.@$aff->phone.'  giao dịch có id '.$data->id;
                $modelBill->save($billbuy);

                 $billbuy = $modelBill->newEmptyEntity();
                $billbuy->id_member_sell = $data->id_agency_introduce;
                $billbuy->id_member_buy =  $user->id;
                $billbuy->total = $data->money_back;
                $billbuy->id_order = $data->id;
                $billbuy->type = 1;
                $billbuy->type_order = 6; 
                $billbuy->created_at = $time;
                $billbuy->updated_at = $time;
                $billbuy->id_debt = 0;
                $billbuy->type_collection_bill =  @$_GET['type_collection_bill'];
                $billbuy->id_customer = 0;
                $billbuy->id_aff = 0;
                $billbuy->note = 'Bạn nhận hoa hồng của người đại lý '.@$user->name.' '.@$user->phone.', do bạn giới thiệu giao dịch có id '.$data->id;
                $modelBill->save($billbuy);
            }
        }

        return $controller->redirect('/listTransactionAgencyHistorie');
    }else{
        return $controller->redirect('/login');
    }
}

?>