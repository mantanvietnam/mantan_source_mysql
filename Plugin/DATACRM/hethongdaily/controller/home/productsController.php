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
                $save->note_user = $dataSend['note'];
                $save->note_admin = '';
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
                    $saveDetail->price = $dataSend['money'][$key];
                    $saveDetail->discount = $dataSend['discount'][$key];

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

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listProduct', $listProduct);
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

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách đơn hàng';

        $modelProduct = $controller->loadModel('Products');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $modelCustomers = $controller->loadModel('Customers');

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

// xóa đơn hàng khách lẻ
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

// xem chi tiết đơn hàng
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

// cập nhập trạng thái đơn hàng
function updateStatusOrderAgency($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Chi tiết đơn hàng';

        $modelOrder = $controller->loadModel('Orders');
        $modelBill = $controller->loadModel('Bills');
        $modelDebt = $controller->loadModel('Debts');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        $modelCustomers = $controller->loadModel('Customers');
        $time = time();

        if(!empty($_GET['id'])){
            // debug($_GET);
            // die();
            $order = $modelOrder->find()->where(['id_agency'=>$session->read('infoUser')->id, 'id'=>(int) $_GET['id'] ])->first();

            if(!empty($order)){
                if(!empty($_GET['status'])){
                    $order->status = $_GET['status'];

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

                // tạo phiêu thu 
                if(!empty($_GET['status_pay'])){
                    $order->status_pay = $_GET['status_pay'];
                    if($_GET['status_pay']=='done'){
                        $customer = $modelCustomers->find()->where(['id'=>(int) $order->id_user])->first();
                        if($_GET['type_collection_bill']!='cong_no'){
                            $bill = $modelBill->newEmptyEntity();
                            $bill->id_member_sell =  $session->read('infoUser')->id;
                            $bill->id_member_buy = 0;
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
                        }else{
                            if(!empty($customer)){
                                $debt = $modelDebt->newEmptyEntity();
                                $debt->id_member_sell =  $session->read('infoUser')->id;
                                $debt->id_member_buy = 0;
                                $debt->total = $order->total;
                                $debt->id_order = $order->id;
                                $debt->number_payment = 0;
                                $debt->total_payment = 0;
                                $debt->type = 0;
                                $debt->status = 0;
                                $debt->type_order = 2; 
                                $debt->created_at = $time;
                                $debt->updated_at = $time;
                                $debt->id_customer = $order->id_user;
                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' của khách '.@$customer->full_name.' '.@$customer->phone.'; '.@$_GET['note'];
                                    $modelDebt->save($debt);
                            }
                        }
                    }
                }
                $modelOrder->save($order);
                

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

function listProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách sản phẩm';

    if(!empty($session->read('infoUser'))){

        if(!empty($session->read('infoUser')->id_father)){
            return $controller->redirect('/');
        }

        $modelProduct = $controller->loadModel('Products');

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

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
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
    $metaTitleMantan = 'Thông tin sản phẩm';
    if(!empty($session->read('infoUser'))){
        if(!empty($session->read('infoUser')->id_father)){
            return $controller->redirect('/');
        }

        $modelProduct = $controller->loadModel('Products');
        $modelCategorieProduct = $controller->loadModel('CategorieProducts');
        $mess= '';

        if(!empty($session->read('infoUser')->id_father)){
            return $controller->redirect('/');
        }

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
                // tạo dữ liệu save
                $data->title = str_replace(array('"', "'"), '’', @$dataSend['title']);
                // $data->id_category = (int) @$dataSend['id_category'];
                $data->description = @$dataSend['description'];
                $data->info = @$dataSend['info'];
                $data->image = @$dataSend['image'];
                $data->images = json_encode(@$dataSend['images']);
                $data->evaluate = json_encode(@$dataSend['evaluate']);
                $data->code = @strtoupper($dataSend['code']);
                $data->price = (int) @$dataSend['price'];
                $data->price_old = (int) @$dataSend['price_old'];
                $data->quantity = (int) @$dataSend['quantity'];
                $data->status = 'active';
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




                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
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
              

        $conditions = array('type' => 'category_product');
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

        $conditions = array('type' => 'manufacturer_product');
        $listManufacturer = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listCategory', $listCategory);
        setVariable('listCategoryCheck', $listCategoryCheck);
        setVariable('listManufacturer', $listManufacturer);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteProductAgency($input){
    global $controller;
    global $session;
    if(!empty($session->read('infoUser'))){

        if(!empty($session->read('infoUser')->id_father)){
            return $controller->redirect('/');
        }

        $modelProduct = $controller->loadModel('Products');
        
        if(!empty($_GET['id'])){
            $data = $modelProduct->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelProduct->save($data);
                //deleteSlugURL($data->slug);
            }
        }

    return $controller->redirect('/listProductAgency');

    }else{
        return $controller->redirect('/login');
    }
}

function listCategoryProductAgency($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
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
            $infoCategory->status = @$dataSend['status'];
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

        }

        $conditions = array('type' => 'category_product');
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}
?>