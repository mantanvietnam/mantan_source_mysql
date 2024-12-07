<?php 
// tạo đơn hàng khách lẻ
function addOrderCustomer($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

    $user = checklogin('addOrderCustomer');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }
        $metaTitleMantan = 'Tạo đơn hàng khách lẻ';

        $modelProducts = $controller->loadModel('Products');
        $modelOrders = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelCustomers = $controller->loadModel('Customers');

        $mess = '';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['idHangHoa'])){
                if(!empty($dataSend['id_customer'])){
                    $customer_buy = $modelCustomers->find()->where(array('id'=>(int) $dataSend['id_customer']))->first();
                }else{
                    $customer_buy = $modelCustomers->newEmptyEntity();

                    if(!empty($dataSend['customer_buy'])){
                        $customer_buy = createCustomerNew($dataSend['customer_buy'], '', '', '', 0, 0, $session->read('infoUser')->id);
                    }
                }

                // lưu bảng đại lý
                saveCustomerMember(@$customer_buy->id, $session->read('infoUser')->id);

                if(empty($customer_buy->full_name)) $customer_buy->full_name = 'Khách lẻ';
                if(empty($customer_buy->phone)) $customer_buy->phone = '';
                if(empty($customer_buy->address)) $customer_buy->address = '';
                if(empty($customer_buy->email)) $customer_buy->email = '';

                
                $save = $modelOrders->newEmptyEntity();

                $save->id_user = (int) @$customer_buy->id;
                $save->full_name = @$customer_buy->full_name;
                $save->email = @$customer_buy->email;
                $save->phone = @$customer_buy->phone;
                $save->address = @$customer_buy->address;
                $save->id_staff = @$user->id_staff;
                $save->note_user = $dataSend['note'];
                $save->note_admin = '';
                $save->status = 'new';
                $time_now = explode(' ', $dataSend['time']);
                $time = explode(':', $time_now[0]);
                $date = explode('/', $time_now[1]);
                $save->create_at = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
              //  $save->create_at = time();
                $save->money = (int) $dataSend['total'];
                $save->id_aff = (int) @$dataSend['id_aff'];
                $save->total = (int) $dataSend['totalPays'];
                $save->promotion = (int) $dataSend['promotion'];
                $save->id_agency = $session->read('infoUser')->id;

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

                $modelOrders->save($save);

                $productDetail = [];

                foreach ($dataSend['idHangHoa'] as $key => $value) {
                    $saveDetail = $modelOrderDetails->newEmptyEntity();

                    $saveDetail->id_product = $value;
                    $saveDetail->id_order = $save->id;
                    $saveDetail->quantity = $dataSend['soluong'][$key];
                    $saveDetail->price = $dataSend['money'][$key];
                    $saveDetail->discount = $dataSend['discount'][$key];
                    $saveDetail->id_unit = (int)$dataSend['id_unit'][$key];

                    $modelOrderDetails->save($saveDetail);

                    $infoProduct = $modelProducts->find()->where(['id'=>$value])->first();
                    $productDetail[] = $infoProduct->title;
                }
                $productDetail = implode(',', $productDetail);
                
                $mess= '<p class="text-success">Tạo đơn hàng thành công</p>';

                // tính hoa hồng cho CTV
                if(function_exists('calculateAffiliate') && !empty(@$dataSend['id_aff'])){
                    calculateAffiliate(@$save->total-@$save->total_costsIncurred, $save->id,(int) @$dataSend['id_aff'],$session->read('infoUser')->id);
                }

                // gửi thông báo Zalo cho khách
                if(!empty($customer_buy->id)){
                    sendZaloUpdateOrder($session->read('infoUser'), $customer_buy, $save, $productDetail);
                }

                 $note = $user->type_tv.' '. $user->name.' tạo đơn hàng cho khách hàng '.$customer_buy->full_name.'('.$customer_buy->phone.') có id đơn là:'.$save->id;

                addActivityHistory($user,$note,'addOrderCustomer',$save->id);
                

                return $controller->redirect('/printBillOrderCustomerAgency/?id_order='.$save->id);
            }
        }

        $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        $conditions = array('type' => 'costsIncurred','status'=>'active');
        $costsIncurred = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listProduct', $listProduct);
        setVariable('costsIncurred', $costsIncurred);
        setVariable('listGroupCustomer', $listGroupCustomer);
        setVariable('mess', $mess);
    }
}

// danh sách đơn hàng khách lẻ
function orderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('orderCustomerAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Danh sách đơn hàng';

        $modelProduct = $controller->loadModel('Products');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $modelCustomers = $controller->loadModel('Customers');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        $conditions = array('id_agency'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['full_name'])){
            $conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['phone'] = $_GET['phone'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['id_user'])){
            $conditions['id_user'] = (int) $_GET['id_user'];
        }

         if(!empty($_GET['status_pay'])){
            $conditions['status_pay'] = $_GET['status_pay'];
        }

        if(!empty($_GET['id_aff'])){
            $conditions['id_aff'] = $_GET['id_aff'];
        }

        

       if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelOrder->find()->where($conditions)->order($order)->all()->toList();
            $titleExcel =   [
                ['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Model', 'type'=>'text', 'width'=>15],
                ['name'=>'Số lượng', 'type'=>'text', 'width'=>35],
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

                    $detail_order = $modelOrderDetail->find()->where(['id_order'=>$value->id])->all()->toList();
                    if(!empty($detail_order)){
                        foreach ($detail_order as $k => $item) {
                            $product = $modelProduct->find()->where(['id'=>$item->id_product ])->first();
                            if(!empty($product)){
                                $dataExcel[] = [
                                                date('H:i d/m/Y', $value->create_at), 
                                                @$value->full_name,   
                                                @$value->phone,   
                                                @$value->address,   
                                                $product->title,
                                                $item->quantity,
                                                '',
                                                $item->price*$item->quantity,
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
            $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$item->id])->all()->toList();
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                             $product->unitConversion =   $modelUnitConversion->find()->where(['id_product'=>$value->id_product])->all()->toList();
                            $detail_order[$k]->product = $product;
                            //$detail_order[$k]->price = $product->price;
                        }
                    }


                    $listData[$key]->detail_order = $detail_order;
                }
                $listData[$key]->customer = $modelCustomers->find()->where(['id'=>(int) $item->id_user])->first();
            }
        }

        // phân trang
        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
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

// xóa đơn hàng khách lẻ
function deleteOrderCustomerAgency($input)
{
    global $controller;
    global $session;

    $user = checklogin('deleteOrderCustomerAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');

        $modelBill = $controller->loadModel('Bills');
        $modelDebt = $controller->loadModel('Debts');
        $modelCustomers = $controller->loadModel('Customers');
        
        if(!empty($_GET['id'])){
            $data = $modelOrder->find()->where(['id_agency'=>$user->id, 'id'=>(int) $_GET['id']])->first();
            
            if(!empty($data)){
                 $customer_buy = $modelCustomers->find()->where(array('id'=>(int) $data->id_user))->first();

                  $note = $user->type_tv.' '. $user->name.' đã xóa đơn hàng của khách hàng '.@$customer_buy->full_name.'('.@$customer_buy->phone.') có id đơn là:'.$data->id;

                addActivityHistory($user,$note,'deleteOrderCustomerAgency',$data->id);

                $modelOrder->delete($data);
                $modelOrderDetail->deleteAll(['id_order'=>$data->id]);
                $modelBill->deleteAll(['id_order'=>$data->id,'type_order'=>2]);
                $modelDebt->deleteAll(['id_order'=>$data->id,'type_order'=>2]);
            }
        }

        return $controller->redirect('/orderCustomerAgency');
    }else{
        return $controller->redirect('/login');
    }
}

// xem chi tiết đơn hàng
function viewOrderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

     $user = checklogin('viewOrderCustomerAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }
        $metaTitleMantan = 'Chi tiết đơn hàng';

        $modelProduct = $controller->loadModel('Products');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');

        if(!empty($_GET['id'])){
            $order = $modelOrder->find()->where(['id'=>(int) $_GET['id'], 'id_agency'=>$session->read('infoUser')->id ])->first();

            if(!empty($order)){
                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();

                if(!empty($detail_order)){
                    foreach ($detail_order as $key => $value) {
                        $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                        

                        $present = array();

                        if(!empty($product->id_product) ){
                            $id_product = explode(',', @$product->id_product);
                            foreach($id_product as $item){
                                $presentf = $modelProduct->find()->where(['code'=>$item])->first();
                                $presentf->numberOrder = $value->quantity;
                                if(!empty($presentf)){
                                    $present[] = $presentf;
                                }
                            }
                            
                        }
                        $product->present = $present;
                        $detail_order[$key]->product = $product;
                    }
                }

                // debug($detail_order);die;

                setVariable('order', $order);
                setVariable('detail_order', $detail_order);
            }else{
                return $controller->redirect('/orderCustomerAgency');
            }
        }else{
            return $controller->redirect('/orderCustomerAgency');
        }
    }else{
        return $controller->redirect('/login');
    }
}

// cập nhập trạng thái đơn hàng
function updateStatusOrderAgency($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('updateStatusOrderAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }
        $metaTitleMantan = 'Chi tiết đơn hàng';

        $modelOrder = $controller->loadModel('Orders');
        $modelBill = $controller->loadModel('Bills');
        $modelDebt = $controller->loadModel('Debts');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelCustomers = $controller->loadModel('Customers');
        $modelPointCustomer = $controller->loadModel('PointCustomers');
        $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');

        $time = time();
       
        $system = $modelCategories->find()->where(array('id'=>$user->id_system ))->first();

        if(!empty($system->description)){
        $description = json_decode($system->description, true);
        $convertPoint = (int) $description['convertPoint'];
        }
        if(!empty($_GET['id'])){
            // debug($_GET);
            // die();
            $order = $modelOrder->find()->where(['id_agency'=>$user->id, 'id'=>(int) $_GET['id'] ])->first();
             $note = '';
            if(!empty($order)){
                if(!empty($_GET['status'])){
                    $order->status = $_GET['status'];

                    // xuất hàng khỏi kho
                    if($_GET['status'] == 'done'){
                        $detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();
                
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

                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_agency])->first();

                                if(empty($checkProductExits)){
                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                    $checkProductExits->quantity = 0;
                                }

                                $checkProductExits->id_member = $order->id_agency;
                                $checkProductExits->id_product = $value->id_product;
                                $checkProductExits->quantity -= $quantity;

                                $modelWarehouseProducts->save($checkProductExits);

                                // lưu lịch sử xuất kho
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $order->id_agency;
                                $saveWarehouseHistories->id_product = $value->id_product;
                                $saveWarehouseHistories->quantity = $quantity;
                                $saveWarehouseHistories->note = 'Bán cho khách hàng '.$order->full_name.' '.$order->phone;
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'minus';
                                $saveWarehouseHistories->type_sale = $type_sale;
                                $saveWarehouseHistories->id_order = $order->id;

                                $modelWarehouseHistories->save($saveWarehouseHistories);
                            }
                        }

                        $note = $user->type_tv.' '. $user->name.' đã xử lý hoàn thành đơn hàng cho khách '.$order->full_name.'('.$order->phone.') có id đơn là:'.$order->id;

                    }elseif($_GET['status'] == 'browser'){
                     $note = $user->type_tv.' '. $user->name.' đã xử lý phê duyệt đơn hàng cho khách '.$order->full_name.'('.$order->phone.') có id đơn là:'.$order->id;
                    }elseif($_GET['status'] == 'delivery'){
                     $note = $user->type_tv.' '. $user->name.' đã xử lý giao hàng đơn hàng cho khách '.$order->full_name.'('.$order->phone.') có id đơn là:'.$order->id;
                    }elseif($_GET['status'] == 'cancel'){
                     $note = $user->type_tv.' '. $user->name.' đã xử lý hủy đơn hàng cho khách '.$order->full_name.'('.$order->phone.') có id đơn là:'.$order->id;
                    }
                }

                // tạo phiêu thu 
                if(!empty($_GET['status_pay'])){
                    $order->status_pay = $_GET['status_pay'];
                    if($_GET['status_pay']=='done'){
                        $customer = $modelCustomers->find()->where(['id'=>(int) $order->id_user])->first();
                        if($_GET['type_collection_bill']!='cong_no'){
                            $bill = $modelBill->newEmptyEntity();
                            $bill->id_member_sell = $user->id;
                            $bill->id_member_buy = 0;
                            $bill->id_staff_sell =  $user->id_staff;
                            $bill->total = $order->total;
                            $bill->id_order = $order->id;
                            $bill->type = 1;
                            $bill->type_order = 2; 
                            $bill->created_at = $time;
                            $bill->updated_at = $time;
                            $bill->id_debt = 0;
                            $bill->type_collection_bill =  @$_GET['type_collection_bill'];
                            $bill->id_customer = $order->id_user;
                            $bill->note = 'Thanh toán đơn hàng id:'.$order->id.' của khách '.@$customer->full_name.' '.@$customer->phone.'; '.@$_GET['note'];
                            $modelBill->save($bill);

                             // tính điểm tích lũy
                            if(!empty($convertPoint)){
                                $point = intval($order->total / $convertPoint);

                                $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$user->id, 'id_customer'=>$order->id_user])->first();

                                if(!empty($checkPointCustomer)){
                                    $checkPointCustomer->point += (int)$point;
                                }else{
                                    $checkPointCustomer= $modelPointCustomer->newEmptyEntity();
                                    $checkPointCustomer->point = (int) $point;
                                    $checkPointCustomer->id_member = $user->id;
                                    $checkPointCustomer->id_customer = $order->id_user;
                                    $checkPointCustomer->created_at = $time;
                                    $checkPointCustomer->id_rating = 0;
                                }
                                $rating = $modelRatingPointCustomer->find()->where(['point_min <=' => $checkPointCustomer->point])->order(['point_min' => 'DESC'])->first();
                                if(!empty($rating)){
                                    $checkPointCustomer->id_rating = $rating->id;
                                }
                                $checkPointCustomer->updated_at = $time;
                                $modelPointCustomer->save($checkPointCustomer);
                            }
                        }else{
                            if(!empty($customer)){
                                $debt = $modelDebt->newEmptyEntity();
                                $debt->id_member_sell = $user->id;
                                $debt->id_member_buy = 0;
                                $debt->id_staff_sell =  $user->id_staff;
                                $debt->total = $order->total;
                                $debt->id_order = $order->id;
                                $debt->number_payment = 0;
                                $debt->total_payment = 0;
                                $debt->type = 1;
                                $debt->status = 0;
                                $debt->type_order = 2; 
                                $debt->created_at = $time;
                                $debt->updated_at = $time;
                                $debt->id_customer = $order->id_user;
                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' của khách '.@$customer->full_name.' '.@$customer->phone.'; '.@$_GET['note'];
                                    $modelDebt->save($debt);
                            }
                        }
                         $note = $user->type_tv.' '. $user->name.' đã xử lý Thanh toán đơn hàng cho đại lý '.@$customer->full_name.'('.@$customer->phone.') có id đơn là:'.$order->id;
                    }
                }
                $modelOrder->save($order);

                

                addActivityHistory($user,$note,'updateStatusOrderAgency',$order->id);

                if(!empty($_GET['back'])){
                    return $controller->redirect($_GET['back']);
                }else{
                    return $controller->redirect('/orderCustomerAgency');
                }
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}

// tạo phiếu in bill
function printBillOrderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('printBillOrderCustomerAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }
        $metaTitleMantan = 'Phiếu đơn hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrders = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelCustomers = $controller->loadModel('Customers');
        $modelMembers = $controller->loadModel('Members');

        if(!empty($_GET['id_order'])){
            $order = $modelOrders->find()->where(['id'=>(int) $_GET['id_order'], 'id_agency'=>$session->read('infoUser')->id])->first();

            if(!empty($order)){
                $detail_order = $modelOrderDetails->find()->where(['id_order'=>$order->id])->all()->toList();

                $order->detail = [];
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $value->product = $modelProducts->find()->where(['id'=>(int) $value->id_product])->first();

                        $order->detail[$k] = $value;
                    }
                }

                $system = $modelCategories->find()->where(['id'=>(int) $session->read('infoUser')->id_system])->first();

                $customer = $modelCustomers->find()->where(['id'=>(int) $order->id_user])->first();

                $member_sell = $modelMembers->find()->where(['id'=>(int) $order->id_agency])->first();

                setVariable('order', $order);
                setVariable('system', $system);
                setVariable('customer', $customer);
                setVariable('member_sell', $member_sell);
            }else{
                return $controller->redirect('/orderCustomerAgency');
            }
        }else{
            return $controller->redirect('/orderCustomerAgency');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách sản phẩm';

    $user = checklogin('listProductAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        $modelProduct = $controller->loadModel('Products');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelCategorieProduct = $controller->loadModel('CategorieProducts');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('Products.id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int)  $_GET['id'];
        }

        if(!empty($_GET['title'])){
            $conditions['title LIKE'] = '%'.$_GET['title'].'%';
        }

        if(!empty($_GET['id_manufacturer'])){
            $conditions['id_manufacturer'] = (int) $_GET['id_manufacturer'];
        }

        if(isset($_GET['hot'])){
            if($_GET['hot']!=''){
                $conditions['hot'] = (int) $_GET['hot'];
            }
        }

        if(!empty($_GET['code'])){
            $conditions['code'] = $_GET['code'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }else{
            $conditions['status'] = 'active';
        }

        if(!empty($_GET['id_category'])){
            $conditions['cp.id_category'] = (int)$_GET['id_category'];
                $listData = $modelProduct->find()
                            ->join([
                                'table' => 'categorie_products',
                                'alias' => 'cp',
                                'type' => 'INNER',
                                'conditions' => 'cp.id_product = Products.id',
                            ])
                            ->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
                $totalData = $modelProduct->find()
                            ->join([
                                'table' => 'categorie_products',
                                'alias' => 'cp',
                                'type' => 'INNER',
                                'conditions' => 'cp.id_product = Products.id',
                            ])
                            ->where($conditions)->all()->toList();



        }else{
            $listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modelProduct->find()->where($conditions)->all()->toList();
        }
        if(!empty($listData)){

            foreach ($listData as $key => $value) {

                     $conditionsCategorie = ['id_product'=>$value->id];
                    $category  =    $modelCategorieProduct->find()->where(array($conditionsCategorie))->all()->toList();
                    if(!empty($category)){
                        foreach ($category as $k => $item) {
                            if(!empty($item->id_category)){
                                $category[$k]->name_category = @$modelCategories->find()->where(array('id'=>$item->id_category))->first()->name;
                            }
                        }
                    } 
                    $listData[$key]->category = $category;

                    $listData[$key]->unitConversion = $modelUnitConversion->find()->where(array('id_product'=>$value->id))->all()->toList();
                    
                
                
                
            }
        }
        // phân trang
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

        $conditions = array('type' => 'category_product');
        $categories = $modelCategories->find()->where($conditions)->all()->toList();

        $conditions = array('type' => 'manufacturer_product');
        $manufacturers = $modelCategories->find()->where($conditions)->all()->toList();

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
        setVariable('categories', $categories);
        setVariable('manufacturers', $manufacturers);
    }else{
        return $controller->redirect('/login');
    }
}

function addProductAgency($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin sản phẩm';
    $user = checklogin('addProductAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listProductAgency');
        }
        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        $modelProduct = $controller->loadModel('Products');
        $modelCategorieProduct = $controller->loadModel('CategorieProducts');
        $mess= '';
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelProduct->get( (int) $_GET['id']);  
        }else{
            $data = $modelProduct->newEmptyEntity();
            $data->quantity = 10000000;
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['title'])){
                $user = $session->read('infoUser');

                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image_product_'.$data->id;
                    }else{
                        $fileName = 'image_product_'.time().rand(0,1000000);
                    }

                    $image = uploadImage($user->id, 'image', $fileName);
                }

                if(!empty($image['linkOnline'])){
                    $data->image = $image['linkOnline'].'?time='.time();
                }else{
                    if(empty($data->image)){
                        $data->image = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/default-thumb.jpg';
                    }
                }
                $image = array();
                if(!empty($_FILES['listImage']['name'][0])){
                    foreach($_FILES['listImage']['name'] as $key => $value){
                        $_FILES['listImages'.$key]['name'] = $value;
                        $_FILES['listImages'.$key]['type'] = $_FILES['listImage']['type'][$key];
                        $_FILES['listImages'.$key]['tmp_name'] = $_FILES['listImage']['tmp_name'][$key];
                        $_FILES['listImages'.$key]['error'] = $_FILES['listImage']['error'][$key];
                        $_FILES['listImages'.$key]['size'] = $_FILES['listImage']['size'][$key];



                    }
                }
                
                $listImage = [];
                if(!empty($data->images)){
                    $listImage = json_decode($data->images, true);
                } 

                $totalImage = count($listImage);
                

                $listImages = [];
                for($y=0;$y<$totalImage;$y++){
                    if(!empty($dataSend['anh'][$y])){
                        $listImages[$y] = $dataSend['anh'][$y];
                    }
                    
                    if(isset($_FILES['image'.$y]) && empty($_FILES['image'.$y]["error"])){
                        if(!empty($data->id)){
                            $fileName = 'image'.$y.'_product_'.$data->id;
                        }else{
                            $fileName = 'image'.$y.'_product_'.time().rand(0,1000000);
                        }

                        $image = uploadImage($user->id, 'image'.$y, $fileName);

                        if(!empty($image['linkOnline'])){
                            $listImages[$y] = $image['linkOnline'].'?time='.time();
                        }
                    }
                }

                $total = count($_FILES['listImage']['name']);
                
                for($i=0;$i<=$total;$i++){
                    if(isset($_FILES['listImages'.$i]) && empty($_FILES['listImages'.$i]["error"])){
                        if(!empty($data->id)){
                            $fileName = 'image'.$i.'_product_'.$data->id;
                        }else{
                            $fileName = 'image'.$i.'_product_'.time().rand(0,1000000);
                        }
                        $image = uploadImage($user->id, 'listImages'.$i, $fileName);
                        if(!empty($image['linkOnline'])){
                            $listImages[$i+$totalImage] = $image['linkOnline'].'?time='.time();
                        }
                    }
                }

                $listanh =array();

                if(!empty($listImages)){
                    foreach($listImages as $key => $image){
                        if(!empty($listImages)){
                            $listanh[] =$image;

                        }  
                    }
                }
            

                
               $dataSend['price_agency'] = (int) @$dataSend['price_agency']; 
                if(empty($dataSend['price_agency'])){

                    $dataSend['price_agency'] =  (int) @$dataSend['price'];
                }
                // tạo dữ liệu save
                $data->title = str_replace(array('"', "'"), '’', @$dataSend['title']);
                $data->description = @$dataSend['description'];
                $data->info = @$dataSend['info'];
                $data->images = json_encode($listanh);
                $data->evaluate = json_encode(@$dataSend['evaluate']);
                $data->code = @strtoupper($dataSend['code']);
                $data->price = (int) @$dataSend['price'];
                $data->price_old = (int) @$dataSend['price_old'];
                $data->quantity = 1000000;
                $data->status = 'active';

                $data->price_agency = @$dataSend['price_agency'];

                $data->unit = @$dataSend['unit'];
                $data->id_category = (int) @$dataSend['id_category'][0];

                $data->hot = 0;
                $data->keyword = '';
                $data->id_manufacturer = 0;

                // tạo slug
                $slug = createSlugMantan($dataSend['title']);
                $slugNew = $slug;
                $number = 0;

                if(empty($data->slug) || $data->slug!=$slugNew){
                    do{
                        $conditions = array('slug'=>$slugNew);
                        $listData = $modelProduct->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                        if(!empty($listData)){
                            $number++;
                            $slugNew = $slug.'-'.$number;
                        }
                    }while (!empty($listData));
                }

                $data->slug = $slugNew;

                $modelProduct->save($data);

                // lưu danh mục sản phẩm
                if(!empty($dataSend['id_category'])){
                    $conditions = ['id_product'=>$data->id];
                    $modelCategorieProduct->deleteAll($conditions);

                    foreach ($dataSend['id_category'] as $id_category) {
                        $category = $modelCategorieProduct->newEmptyEntity();

                        $category->id_product = $data->id;;
                        $category->id_category = $id_category;
                        $modelCategorieProduct->save($category);
                    }
                }else{
                    $conditions = ['id_product'=>$data->id];
                    $modelCategorieProduct->deleteAll($conditions);
                }

                
                if(!empty($dataSend['unitConversion'])){
                    $conditions = ['id_product'=>$data->id, 'id NOT IN'=>$dataSend['id_unit']];
                    $modelUnitConversion->deleteAll($conditions);
                    foreach ($dataSend['unitConversion'] as $key => $unit) {
                        if(!empty($unit)){
                            if(!empty($dataSend['id_unit'][$key])){
                                $save = $modelUnitConversion->get((int)$dataSend['id_unit'][$key]);
                            }else{
                                $save = $modelUnitConversion->newEmptyEntity();
                            }
                            $save->unit = $unit;
                            $save->id_product = $data->id; 
                            $save->quantity = (int) $dataSend['quantityConversion'][$key];
                            $save->price = (int) $dataSend['priceConversion'][$key];

                            $dataSend['price_agencyConversion'][$key] = (int) @$dataSend['price_agencyConversion'][$key]; 
                            if(empty($dataSend['price_agencyConversion'][$key])){
                                $dataSend['price_agencyConversion'][$key] =  (int) @$dataSend['priceConversion'][$key];
                            }
                            $save->price_agency = $dataSend['price_agencyConversion'][$key];
                            $modelUnitConversion->save($save);
                        }
                    }
                }else{
                    $conditions = ['id_product'=>$data->id];
                    $modelUnitConversion->deleteAll($conditions);

                }

                if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin sản phẩm '.$data->title.' có id là:'.$data->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin sản phẩm '.$data->title.' có id là:'.$data->id;
                }


                addActivityHistory($user,$note,'addProductAgency',$data->id);


                 return $controller->redirect('/listProductAgency?mess=saveSuccess');
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên sản phẩm</p>';
            }
        }

                
        if(!empty($data->images)){
            $data->images = json_decode($data->images, true);
        }           


        
        if(!empty($data->evaluate)){
            $data->evaluate = json_decode($data->evaluate, true);
        }
              

        $conditions = array('type' => 'category_product','status'=>'active');
        $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

        $listCategoryCheck = [];
        if(!empty($data->id)){
            $listCheck = $modelCategorieProduct->find()->where(['id_product'=>$data->id])->all()->toList();
            if(!empty($listCheck)){
                foreach ($listCheck as $check) {
                    $listCategoryCheck[] = $check->id_category;
                }
            }
        }

        $listUnitConversion = [];

        if(!empty($data->id)){
            $conditions = array('id_product'=>$data->id);
            $listUnitConversion = $modelUnitConversion->find()->where($conditions)->all()->toList();
        }

        $conditions = array('type' => 'manufacturer_product','status'=>'active');
        $listManufacturer = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listCategory', $listCategory);
        setVariable('listCategoryCheck', $listCategoryCheck);
        setVariable('listUnitConversion', $listUnitConversion);
        setVariable('listManufacturer', $listManufacturer);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteProductAgency($input){
    global $controller;
    global $session;
    $user = checklogin('deleteProductAgency');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listProductAgency');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        $modelProduct = $controller->loadModel('Products');
        
        if(!empty($_GET['id'])){
            $data = $modelProduct->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelProduct->save($data);

                $note = $user->type_tv.' '. $user->name.' xóa thông tin sản phẩm '.$data->title.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteProductAgency',$data->id);

                return $controller->redirect('/listProductAgency?mess=deleteSuccess');
            }
        }

    return $controller->redirect('/listProductAgency?mess=deleteError');

    }else{
        return $controller->redirect('/login');
    }
}

function listCategoryProductAgency($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    $user = checklogin('listCategoryProductAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listProductAgency');
        }

         if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        if ($isRequestPost) {
            $checluser = checklogin('editCategoryCustomerAgency'); 
            if(!empty($checluser->grant_permission)){
                $dataSend = $input['request']->getData();
                
                // tính ID category
                if(!empty($dataSend['idCategoryEdit'])){
                    $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
                }else{
                    $infoCategory = $modelCategories->newEmptyEntity();
                }

                // tạo dữ liệu save
                $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $infoCategory->parent = 0;
                $infoCategory->image = @$dataSend['image'];
                $infoCategory->status = 'active';
                $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
                $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
                $infoCategory->type = 'category_product';

                // tạo slug
                $slug = createSlugMantan($infoCategory->name);
                $slugNew = $slug;
                $number = 0;
                do{
                    $conditions = array('slug'=>$slugNew,'type'=>'category_product');
                    $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));

                $infoCategory->slug = $slugNew;

                $modelCategories->save($infoCategory);

                if(!empty($dataSend['idCategoryEdit'])){
                        $note = $user->type_tv.' '. $user->name.' sửa thông tin nhóm sản phẩm '.$infoCategory->name.' có id là:'.$infoCategory->id;
                    
                }else{
                    $note = $user->type_tv.' '. $user->name.' tạo mới thông tin nhóm sản phẩm '.$infoCategory->name.' có id là:'.$infoCategory->id;
                }

            addActivityHistory($user,$note,'listCategoryProductAgency',$infoCategory->id);


             $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
               $mess= '<p class="text-danger">Bạn không có quyền thêm sửa </p>'; 
            }

        }

        if(!empty($_GET['mess']) && $_GET['mess']=='noPermissiondelete'){
             $mess= '<p class="text-danger">Bạn không có quyền xóa</p>'; 
        }

        $conditions = array('type' => 'category_product','status'=>'active');
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', @$mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryProductAgency($input){
    global $controller;
    global $session;

    global $modelCategories;
     $user = checklogin('deleteCategoryProductAgency');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCategoryProductAgency?mess=noPermissiondelete');
        }


        if(!empty($_GET['id'])){
            $data = $modelCategories->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelCategories->save($data);
                $note = $user->type_tv.' '. $user->name.' xóa thông tin nhóm sản phẩm '.$data->name.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deleteCategoryProductAgency',$data->id);
                //deleteSlugURL($data->slug);
            }
        }

     return $controller->redirect('/listCategoryProductAgency');

    }else{
        return $controller->redirect('/login');
    }
}

function addDataProductAgency(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;
    global $modelCategoryConnects;

    $user = checklogin('addDataProductAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listProductAgency');
        }
        $metaTitleMantan = 'Thêm thông tin sản phẩm ';

        $modelProduct = $controller->loadModel('Products');
        $modelCategorieProduct = $controller->loadModel('CategorieProducts');        

        $mess= '';
        
        if($isRequestPost){
            $dataSeries = uploadAndReadExcelData('dataProduct');

            if($dataSeries){
                unset($dataSeries[0]);

                $double = [];
                $number = 0;
                $numbers = 0;
                foreach ($dataSeries as $key => $value) {
                    if(!empty($value[0]) && !empty($value[1])){
                        $data = $modelProduct->newEmptyEntity();
                        $id_category = explode(',' , $value[5]);
                        $data->title = str_replace(array('"', "'"), '’', @$value[0]);
                        $data->description = @$value[6];
                        $data->info = @$value[7];
                        $data->image = $value[8];
                        $data->unit = $value[4];
                        $data->evaluate = '';
                        $data->code = @strtoupper($value[1]);
                        $data->price = (int) @$value[2];
                        $data->price_old = (int) @$value[3];
                        $data->quantity = 1000000;
                        $data->status = 'active';
                        $data->id_category = (int) @$id_category[0];

                        $data->hot = 0;
                        $data->keyword = '';
                        $data->id_manufacturer = 0;

                        // tạo slug
                        $slug = createSlugMantan($value[0]);
                        $slugNew = $slug;
                        $number = 0;

                        if(empty($data->slug) || $data->slug!=$slugNew){
                            do{
                                $conditions = array('slug'=>$slugNew);
                                $listData = $modelProduct->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                                if(!empty($listData)){
                                    $number++;
                                    $slugNew = $slug.'-'.$number;
                                }
                            }while (!empty($listData));
                        }

                        $data->slug = $slugNew;
                        $numbers++;
                        $modelProduct->save($data);

                        // lưu danh mục sản phẩm
                        if(!empty($id_category)){
                            foreach ($id_category as $item) {
                                $category = $modelCategorieProduct->newEmptyEntity();

                                $category->id_product = $data->id;;
                                $category->id_category = $item;
                                $modelCategorieProduct->save($category);
                            }
                        }
                    }
                    
                    
                }
                $note = $user->type_tv.' '. $user->name.' thêm thông tin sản phẩm bằng Excel số lượng sản phẩm Lưu là: '.$numbers.' sản phẩm';
                

                addActivityHistory($user,$note,'addDataProductAgency',0);
                $mess .= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }
        }


        setVariable('mess', $mess);

    }else{
        return $controller->redirect('/login');
    }
}

function editOrderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $user = checklogin('editOrderCustomerAgency');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/orderCustomerAgency');
        }
        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrders = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelCustomers = $controller->loadModel('Customers');
        $modelUnitConversion = $controller->loadModel('UnitConversions');

        $mess = '';

        $order =$modelOrders->find()->where(array('id'=>(int)$_GET['id'],'status'=>'new'))->first();
        if(empty($order)){
            return $controller->redirect('/orderMemberAgency');
        }

        $customer = [];
       
        if(!empty($order->id_user)){
            $customer = $modelCustomers->find()->where(array('id'=>(int) $order->id_user))->first();
        }

        $orderDetail = $modelOrderDetails->find()->where(array('id_order'=>$order->id))->all()->toList();

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            $time_now = explode(' ', $dataSend['time']);
            $time = explode(':', $time_now[0]);
            $date = explode('/', $time_now[1]);
            $order->create_at = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
            
            $order->note_user = $dataSend['note']; // ghi chú người mua  
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

            $modelOrders->save($order);

            $modelOrderDetails->deleteAll(array('id_order'=>(int) $order->id));
            foreach ($dataSend['idHangHoa'] as $key => $value) {
                $saveDetail = $modelOrderDetails->newEmptyEntity();

                $saveDetail->id_product = $value;
                $saveDetail->id_order = $order->id;
                $saveDetail->quantity = (int)$dataSend['soluong'][$key];
                $saveDetail->price = (int)$dataSend['money'][$key];
                $saveDetail->discount = (int)$dataSend['discount'][$key];
                $saveDetail->id_unit = (int)$dataSend['id_unit'][$key];

                $modelOrderDetails->save($saveDetail);
            }
            $orderDetail = $modelOrderDetails->find()->where(array('id_order'=>$order->id))->all()->toList();

            $mess= '<p class="text-success">Sửa đơn hàng thành công</p>'; 

            $note = $user->type_tv.' '. $user->name.' đã xử lý sửa đơn hàng cho đại lý '.$customer->name.'('.$customer->phone.') có id đơn là:'.$order->id;

            addActivityHistory($user,$note,'editOrderCustomerAgency',$order->id);


        }

         $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }
    
        if(!empty($orderDetail)){
            foreach($orderDetail as $key => $item){
                $orderDetail[$key]->product = $modelProducts->find()->where(array('id'=>$item->id_product))->first();
                $orderDetail[$key]->unitConversion = $modelUnitConversion->find()->where(['id_product'=>$item->id_product])->all()->toList();
            }
        }

         $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        $conditions = array('type' => 'costsIncurred','status'=>'active');
        $costsIncurred = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listProduct', $listProduct);
        setVariable('listGroupCustomer', $listGroupCustomer);
        
        setVariable('order', $order);
        setVariable('costsIncurred', $costsIncurred);
        setVariable('orderDetail', $orderDetail);
        setVariable('customer', $customer);
        setVariable('mess', $mess);

    }else{
        return $controller->redirect('/login');
    }
}

function listCostsIncurred($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách chi phí phát sinh';
    if(!empty($session->read('infoUser'))){

         if(!empty($session->read('infoUser')->id_father)){
            return $controller->redirect('/');
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
                $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->parent = 0;
            $infoCategory->image = @$dataSend['image'];
            $infoCategory->status = 'active';
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'costsIncurred';

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew,'type'=>'costsIncurred');
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'costsIncurred','status'=>'active');
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function listUnitConversionAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    $return =array();
    $metaTitleMantan = 'Danh sách danh mục sản phẩm';

        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelProduct = $controller->loadModel('Products');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            if(!empty($dataSend['id_product'])){
               $conditions = array('id_product'=>$dataSend['id_product']);
                $data = $modelUnitConversion->find()->where($conditions)->all()->toList();
                if(!empty($data)){
                 $return = array('code'=>1, 'mess'=>'lấy dữ liệu thành công', 'data'=> $data);
                }else{
                    $return = array('code'=>2, 'mess'=>'lấy dữ liệu không thành công');
                }
            }else{
                $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    return $return;
}

function unitgetPriceAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    $return =array();

        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelProduct = $controller->loadModel('Products');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            if(!empty($dataSend['id_product']) &&  !empty($dataSend['id_unit'])){
               $conditions = array('id_product'=>$dataSend['id_product'],'id'=>$dataSend['id_unit']);
                $data = $modelUnitConversion->find()->where($conditions)->first();
                if(!empty($data)){
                 $return = array('code'=>1, 'mess'=>'lấy dữ liệu thành công', 'data'=> $data);
                }else{
                    $return = array('code'=>2, 'mess'=>'lấy dữ liệu không thành công');
                }
            }else{
                $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    return $return;
}


?>