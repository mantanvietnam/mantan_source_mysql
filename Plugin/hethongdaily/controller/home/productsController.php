<?php 
function addOrderCustomer($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
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
                    $customer_buy = $modelCustomers->find()->where(array('id'=>(int) $dataSend['id_customer'], 'id_parent'=>$session->read('infoUser')->id))->first();
                }else{
                    $customer_buy = $modelCustomers->newEmptyEntity();

                    if(!empty($dataSend['customer_buy'])){
                        $customer_buy->full_name = $dataSend['customer_buy'];
                        $customer_buy->phone = '';
                        $customer_buy->email = '';
                        $customer_buy->address = '';
                        $customer_buy->id_messenger = '';
                        $customer_buy->avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";
                        $customer_buy->status = 'active';
                        $customer_buy->pass = '';
                        $customer_buy->id_parent = $session->read('infoUser')->id;
                        $customer_buy->birthday_date = 0;
                        $customer_buy->birthday_month = 0;
                        $customer_buy->birthday_year = 0;
                        $customer_buy->created_at = time();

                        $modelCustomers->save($customer_buy);
                    }
                }

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
                $save->note_user = '';
                $save->note_admin = $dataSend['note'];
                $save->status = 'new';
                $save->create_at = time();
                $save->money = (int) $dataSend['total'];
                $save->total = (int) $dataSend['totalPays'];
                $save->promotion = (int) $dataSend['promotion'];
                $save->id_agency = $session->read('infoUser')->id;

                $modelOrders->save($save);

                foreach ($dataSend['idHangHoa'] as $key => $value) {
                    $saveDetail = $modelOrderDetails->newEmptyEntity();

                    $saveDetail->id_product = $value;
                    $saveDetail->id_order = $save->id;
                    $saveDetail->quantity = $dataSend['soluong'][$key];

                    $modelOrderDetails->save($saveDetail);
                }

                $mess= '<p class="text-success">Tạo đơn hàng thành công</p>';

                return $controller->redirect('/printBillOrderCustomerAgency/?id_order='.$save->id);
            }
        }

        $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        setVariable('listProduct', $listProduct);
        setVariable('mess', $mess);
    }
}

function orderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách đơn hàng';

        $modelProduct = $controller->loadModel('Products');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');

        $conditions = array('id_agency'=>$session->read('infoUser')->id);
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
                            $detail_order[$k]->product = $product->title;
                            $detail_order[$k]->price = $product->price;
                        }
                    }

                    $listData[$key]->detail_order = $detail_order;
                }
            }
        }

        // phân trang
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

function deleteOrderCustomerAgency($input)
{
    global $controller;
    global $session;

    if(!empty($session->read('infoUser'))){
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        
        if(!empty($_GET['id'])){
            $data = $modelOrder->find()->where(['id_agency'=>$session->read('infoUser')->id, 'id'=>(int) $_GET['id']])->first();
            
            if($data){
                $modelOrder->delete($data);
                $modelOrderDetail->deleteAll(['id_order'=>$data->id]);
            }
        }

        return $controller->redirect('/orderCustomerAgency');
    }else{
        return $controller->redirect('/login');
    }
}

function viewOrderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
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

function updateStatusOrderAgency($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Chi tiết đơn hàng';

        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

        if(!empty($_GET['id'])){
            $order = $modelOrder->find()->where(['id_agency'=>$session->read('infoUser')->id, 'id'=>(int) $_GET['id'] ])->first();

            if(!empty($order)){
                if(!empty($_GET['status'])){
                    $order->status = $_GET['status'];

                    $modelOrder->save($order);

                    // xuất hàng khỏi kho
                    if($_GET['status'] == 'done'){
                        $detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();
                
                        if(!empty($detail_order)){
                            foreach ($detail_order as $k => $value) {
                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_agency])->first();

                                if(empty($checkProductExits)){
                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                    $checkProductExits->quantity = 0;
                                }

                                $checkProductExits->id_member = $order->id_agency;
                                $checkProductExits->id_product = $value->id_product;
                                $checkProductExits->quantity -= $value->quantity;

                                $modelWarehouseProducts->save($checkProductExits);

                                // lưu lịch sử xuất kho
                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $order->id_agency;
                                $saveWarehouseHistories->id_product = $value->id_product;
                                $saveWarehouseHistories->quantity = $value->quantity;
                                $saveWarehouseHistories->note = 'Bán cho khách hàng '.$order->full_name.' '.$order->phone;
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'minus';
                                $saveWarehouseHistories->id_order = $order->id;

                                $modelWarehouseHistories->save($saveWarehouseHistories);
                            }
                        }
                    }
                }

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

function printBillOrderCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
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
?>