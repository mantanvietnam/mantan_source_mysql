<?php 
// danh sách yêu cầu nhập hàng vào kho
function requestProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        $conditions = array('id_member_buy'=>$session->read('infoUser')->id);
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
                            $detail_order[$k]->product = $product->title;
                        }
                    }

                    $listData[$key]->detail_order = $detail_order;
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

// tạo yêu cầu nhập hàng vào kho
function addRequestProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelMembers = $controller->loadModel('Members');

        $mess = '';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['idHangHoa'])){
                $save = $modelOrderMembers->newEmptyEntity();

                $save->id_member_sell = $session->read('infoUser')->id_father;
                $save->id_member_buy = $session->read('infoUser')->id;
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

                $mess= '<p class="text-success">Gửi yêu cầu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Không thể tạo đơn do bạn chưa chọn sản phẩm</p>';
            }
        }

        $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        $position = $modelCategories->find()->where(array('id'=>$session->read('infoUser')->id_position))->first();

        $father = $modelMembers->find()->where(array('id'=>$session->read('infoUser')->id_father))->first();

        $listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active'])->all()->toList();

        setVariable('listProduct', $listProduct);
        setVariable('position', $position);
        setVariable('father', $father);
        setVariable('mess', $mess);
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

    if(!empty($session->read('infoUser'))){
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
                    $save = $modelOrderMembers->newEmptyEntity();

                    $save->id_member_sell = $member_buy->id_father;
                    $save->id_member_buy = $member_buy->id;
                    $save->note_sell = '';
                    $save->note_buy = $dataSend['note']; // ghi chú người mua  
                    $save->status = 'new';
                    $save->create_at = time();
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
                    }

                    $mess= '<p class="text-success">Gửi yêu cầu thành công</p>';

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
        
        $listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active'])->all()->toList();

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

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách đơn hàng đại lý';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        $conditions = array('id_member_sell'=>$session->read('infoUser')->id);
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

    if(!empty($session->read('infoUser'))){
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

        if(!empty($_GET['id'])){
            $order = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id'], 'id_member_sell'=>$session->read('infoUser')->id])->first();

            if(!empty($order)){
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
                                $infoMemberBuy = $modelMembers->find()->where(['id'=>$order->id_member_buy])->first();

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

                                // lưu lịch sử nhập kho của người mua
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $order->id_member_buy;
                                $saveWarehouseHistories->id_product = $value->id_product;
                                $saveWarehouseHistories->quantity = $quantity;
                                $saveWarehouseHistories->note = 'Nhập hàng vào kho';
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'plus';
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
                        $infoMemberBuy = $modelMembers->find()->where(['id'=>$order->id_member_buy])->first();

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
                            $bill->id_member_sell =  $session->read('infoUser')->id;
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
                            $billbuy->id_member_sell =  $session->read('infoUser')->id;
                            $billbuy->id_member_buy = $order->id_member_buy;
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
                                $debt->id_member_sell =  $session->read('infoUser')->id;
                                $debt->id_member_buy = $order->id_member_buy;
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
                                $debt->id_member_sell =  $session->read('infoUser')->id;
                                $debt->id_member_buy = $order->id_member_buy;
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
                    }
                }

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

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Cập nhập đơn hàng đại lý';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        if(!empty($_GET['id'])){
            $order = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id'], 'id_member_buy'=>$session->read('infoUser')->id])->first();

            if(!empty($order)){
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

                                // lưu lịch sử nhập kho của người mua
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $order->id_member_buy;
                                $saveWarehouseHistories->id_product = $value->id_product;
                                $saveWarehouseHistories->quantity = $quantity;
                                $saveWarehouseHistories->note = 'Nhập hàng vào kho';
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'plus';
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
                                $saveWarehouseHistories->id_order_member = $order->id;

                                $modelWarehouseHistories->save($saveWarehouseHistories);
                            }
                        }
                    }
                }

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

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Phiếu đơn hàng';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        if(!empty($_GET['id_order_member'])){
            $order = $modelOrderMembers->find()->where(['id'=>(int) $_GET['id_order_member'], 'id_member_sell'=>$session->read('infoUser')->id])->first();

            if(!empty($order)){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();

                $order->detail = [];
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $value->product = $modelProducts->find()->where(['id'=>(int) $value->id_product])->first();

                        $order->detail[$k] = $value;
                    }
                }

                $system = $modelCategories->find()->where(['id'=>(int) $session->read('infoUser')->id_system])->first();

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

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelMembers = $controller->loadModel('Members');
        $modelDiscountProductAgency = $controller->loadModel('DiscountProductAgencys');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        $mess = '';



        $order =$modelOrderMembers->find()->where(array('id'=>(int)$_GET['id'],'status'=>'new'))->first();
        if(empty($order)){
            return $controller->redirect('/orderMemberAgency');
        }

         // mức chiết khấu của đại lý theo chức danh
        $position = [];
         $member_buy = [];
        $father = [];

       
        if(!empty($order->id_member_buy)){
            $member_buy = $modelMembers->find()->where(array('id'=>(int) $order->id_member_buy))->first();

            if(!empty($member_buy)){
                $father = $modelMembers->find()->where(array('id'=>$member_buy->id_father))->first();
                $position = $modelCategories->find()->where(array('id'=>$member_buy->id_position))->first();
            }
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
            }
            $orderDetail = $modelOrderMemberDetails->find()->where(array('id_order_member'=>$order->id))->all()->toList();

            $mess= '<p class="text-success">Sửa đơn hàng thành công</p>';                
        }

         $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

       
        
        $listPositions = $modelCategories->find()->where(['type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active'])->all()->toList();

         $orderDetail = $modelOrderMemberDetails->find()->where(array('id_order_member'=>$order->id))->all()->toList();

        if(!empty($orderDetail)){
            foreach($orderDetail as $key => $item){
                $orderDetail[$key]->product = $modelProducts->find()->where(array('id'=>$item->id_product))->first();

                $orderDetail[$key]->unitConversion = $modelUnitConversion->find()->where(['id_product'=>$item->id_product])->all()->toList();
            }




        }
        $conditions = array('type' => 'costsIncurred','status'=>'active');
        $costsIncurred = $modelCategories->find()->where($conditions)->all()->toList();
        
       
        setVariable('order', $order);
        setVariable('orderDetail', $orderDetail);
        setVariable('member_buy', $member_buy);
        setVariable('listProduct', $listProduct);
        setVariable('position', $position);
        setVariable('father', $father);
        setVariable('costsIncurred', $costsIncurred);
        setVariable('mess', $mess);
        setVariable('listPositions', $listPositions);

    }else{
        return $controller->redirect('/login');
    }
}
?>