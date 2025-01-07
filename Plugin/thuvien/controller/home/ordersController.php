<?php

function listOrder($input) 
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listOrder');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelMembers = $controller->loadModel('Members');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBuildings = $controller->loadModel('Buildings');
    $modelBook = $controller->loadModel('Books');

    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        $metaTitleMantan = 'Danh sách cho mượn sách';

        $order = ['Orders.id' => 'desc'];
        $limit = 20;
        $conditions = ['Orders.building_id'=>$user->idbuilding];

        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        if(!empty($_GET['id'])){
            $conditions['Orders.id'] = (int)$_GET['id'];
        }

        if(!empty($_GET['id_building'])){
            $conditions['Orders.building_id'] = (int)$_GET['id_building'];
        }

        if (!empty($_GET['id_customer'])) {
            $conditions['Orders.customer_id'] = $_GET['id_customer'];

        }

        if(!empty($_GET['id_book'])){
            $conditions['od.book_id'] = (int)$_GET['id_book'];
        }

        $join = [
            'table' => 'order_details',
            'alias' => 'od',
            'type' => 'INNER',
            'conditions' => 'od.order_id = Orders.id',
        ];

        if (!empty($_GET['status'])) {
            $conditions['Orders.status'] = $_GET['status'];
        }
        if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
            $startDate = $_GET['start_date'];
            $endDate = $_GET['end_date'];
            $conditions['Orders.created_at >='] = date('Y-m-d 00:00:00', strtotime($startDate));
            $conditions['Orders.created_at <='] = date('Y-m-d 23:59:59', strtotime($endDate));
        } elseif (!empty($_GET['start_date'])) {
            $startDate = $_GET['start_date'];
            $conditions['Orders.created_at >='] = date('Y-m-d 00:00:00', strtotime($startDate));
        } elseif (!empty($_GET['end_date'])) {
            $endDate = $_GET['end_date'];
            $conditions['Orders.created_at <='] = date('Y-m-d 23:59:59', strtotime($endDate));
        }

        if (!empty($_GET['action']) && $_GET['action'] == 'Excel') {
            $listData = $modelOrders->find()->where($conditions)->order($order)->all()->toList();

            $titleExcel = [
                ['name' => 'ID', 'type' => 'text', 'width' => 10],
                ['name' => 'Tên khách hàng', 'type' => 'text', 'width' => 25],
                ['name' => 'Số điện thoại', 'type' => 'text', 'width' => 15],
                ['name' => 'Tòa nhà', 'type' => 'text', 'width' => 20],
                ['name' => 'Người phụ trách', 'type' => 'text', 'width' => 20],
                ['name' => 'Chi tiết đơn hàng', 'type' => 'text', 'width' => 50],
                ['name' => 'Trạng thái', 'type' => 'text', 'width' => 15],
                ['name' => 'Ngày tạo', 'type' => 'text', 'width' => 20],
                ['name' => 'Ngày trả', 'type' => 'text', 'width' => 20],
            ];

            $dataExcel = [];
            foreach ($listData as $value) {
                $customer = $modelCustomers->get($value->customer_id);
                $building = $modelBuildings->get($value->building_id);
                $member = $modelMembers->get($value->member_id);
                $orderDetails = $modelOrderDetails->find()->where(['order_id' => $value->id])->all()->toList();
                if(!empty($orderDetails)){
                    $statusText = ($value->status == '1') ? 'Đang mượn' : 'Đã trả';
                    $orderDetailsText = '';
                    foreach ($orderDetails as $detail) {
                        $book = $modelBook->find()->where(['id'=>$detail->book_id])->first();
                       $orderDetailsText .= $book->name . ' (Số lượng: ' . $detail->quantity . '); ';
                   }

                   $dataExcel[] = [
                        $value->id,
                        $customer->name ?? 'N/A',
                        $customer->phone ?? 'N/A',
                        $building->name ?? 'N/A',
                        $member->name ?? 'N/A',
                        $orderDetailsText,
                        $statusText,
                        date('d-m-Y H:i:s', $value->created_at),
                        date('d-m-Y H:i:s', $value->return_deadline),
                    ];
                }
        }

        export_excel($titleExcel, $dataExcel, 'danh_sach_đơn mượnmượn');
    } else {
        $listData = $modelOrders->find()->join($join)
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->group(['Orders.id'])
        ->order($order)
        ->all()
        ->toList();

        foreach ($listData as $key => $order) {
            $listData[$key]->customer = $modelCustomers->get($order->customer_id);
            $listData[$key]->building = $modelBuildings->get($order->building_id);
            $listData[$key]->member = $modelMembers->get($order->member_id);
            $whereOrder = ['order_id'=>$order->id];
            if(!empty($_GET['id_book'])){
                $whereOrder['book_id']=(int)$_GET['id_book'];
            }
            $OrderDetail = $modelOrderDetails->find()->where($whereOrder)->all()->toList();
            if(!empty($OrderDetail)){
                foreach($OrderDetail as $k => $item){
                    $OrderDetail[$k]->book = $modelBook->find()->where(['id'=>$item->book_id])->first();
                }
            }
            $listData[$key]->orderDetail = $OrderDetail;

        }
    }

        $totalData = $modelOrders->find()->join($join)->where($conditions)->count();
        $totalPage = ceil($totalData / $limit);
        $back = max(1, $page - 1);
        $next = min($totalPage, $page + 1);

        $urlPage = $urlCurrent;
        if (isset($_GET['page'])) {
            $urlPage = str_replace('&page=' . $_GET['page'], '', $urlPage);
            $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
        }
        $urlPage .= (strpos($urlPage, '?') !== false ? '&' : '?') . 'page=';

        $mess = '';
        if (@$_GET['mess'] == 'saveSuccess') {
            $mess = '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        } elseif (@$_GET['mess'] == 'deleteSuccess') {
            $mess = '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        } elseif (@$_GET['mess'] == 'deleteError') {
            $mess = '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        setVariable('listData', $listData);
    } else {
        return $controller->redirect('/login');
    }
}

function addOrder($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Tạo hoặc sửa đơn mượn';

    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelBuilding = $controller->loadModel('Buildings');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBooks = $controller->loadModel('Books');
    $modelWarehouses = $controller->loadModel('Warehouses');
    $modelOrderHistorys = $controller->loadModel('OrderHistorys');

    $customer = $modelCustomers->find()->all()->toList();
    $books = $modelBooks->find()->all()->toList();

    $user = checklogin('addOrder');
    if(!empty($user)){
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }
        
        $conditions = [];
        $orderDetails = [];
        $mess = '';
        if(!empty($_GET['id']) ){
            $order = $modelOrders->find()->where(['id' => (int)$_GET['id']])->first();
        }else{
            $order = $modelOrders->newEmptyEntity();
        }

        if (empty($order)){
            return $controller->redirect('/listOrder');
        }

        if (!empty($order->id)) {
            $orderDetails = $modelOrderDetails->find()->where(['order_id' => $order->id])->all()->toList();
        }

        if ($isRequestPost) {
        $dataSend = $input['request']->getData();
            if(!empty($dataSend['customer_id']) && !empty($dataSend['building_id']) && !empty($dataSend['return_deadline'])  && !empty($dataSend['order_books'])  && is_array($dataSend['order_books'])){


                $order->member_id = (int)$user->id;
                $order->customer_id = (int)$dataSend['customer_id'];
                $order->building_id = (int)$dataSend['building_id'];
                $order->status = (int)$dataSend['status'];
                $order->created_at = !empty($order->id) ? $order->created_at : time();
                $order->return_deadline = strtotime(str_replace('/', '-', $dataSend['return_deadline']));
                $order->updated_at = time();

                if ($modelOrders->save($order)) {
                    $id_book = array();
                    foreach ($dataSend['order_books'] as $detail) {
                        if (!empty($detail['book_id']) && !empty($detail['quantity']) && !empty($detail['warehouse_id'])) {
                           $id_book[] = (int)$detail['book_id'];
                           $orderDetail = $modelOrderDetails->find()->where(['order_id' => $order->id, 'book_id' => $detail['book_id']])->first();
                           $oldQuantity = $orderDetail ? $orderDetail->quantity : 0;

                           if ($orderDetail) {
                                $orderDetail->quantity = (int)$detail['quantity'];
                                $orderDetail->warehouse_id = (int)$detail['warehouse_id'];
                                $modelOrderDetails->save($orderDetail);
                            } else {
                                $orderDetail = $modelOrderDetails->newEmptyEntity();
                                $orderDetail->order_id = $order->id;
                                $orderDetail->book_id = (int)$detail['book_id'];
                                $orderDetail->quantity = (int)$detail['quantity'];
                                $orderDetail->warehouse_id = (int)$detail['warehouse_id'];

                                $modelOrderDetails->save($orderDetail);
                            }

                            $warehouse = $modelWarehouses->find()->where(['id' => $detail['warehouse_id']])->first();
                            if ($warehouse) {
                                $quantityDiff = $detail['quantity'] - $oldQuantity;

                                if ($order->status == 1) {
                                    $warehouse->quantity_borrow += $quantityDiff;
                                } elseif ($order->status == 2) {
                                    $warehouse->quantity_borrow -= $quantityDiff;
                                }

                                if ($warehouse->quantity_borrow < 0) {
                                    $warehouse->quantity_borrow = 0;
                                }

                                $modelWarehouses->save($warehouse);
                            }
                            $history = $modelOrderHistorys->find()->where(['order_id'=>$order->id, 'book_id'=>(int)$detail['book_id'], 'warehouse_id'=>@$warehouse->id, 'order_detail_id'=>$orderDetail->id, 'id_building'=>(int)$dataSend['building_id'], 'type'=>'plus'])->first();

                            if(empty($history)){
                                $history = $modelOrderHistorys->newEmptyEntity();
                                $history->order_id = $order->id;
                                $history->book_id = (int)$detail['book_id'];
                                $history->warehouse_id = (int)$detail['warehouse_id'];
                                $history->order_detail_id = $orderDetail->id;
                                $history->id_building = (int)$dataSend['building_id'];
                                $history->created_at = time();
                                $history->type = 'plus';
                            }

                            $history->id_member = (int)$user->id;
                            $history->quantity = (int)$detail['quantity'];


                            $modelOrderHistorys->save($history);
                        }

                    }


                    $checkOrderDetail = $modelOrderDetails->find()->where(['order_id' => $order->id, 'book_id NOT IN' => $id_book])->all()->toList();
                    if(!empty($checkOrderDetail)){
                        foreach($checkOrderDetail as $key => $item){
                            $warehouse = $modelWarehouses->find()->where(['id' => $item->warehouse_id])->first();
                            if (!empty($warehouse)){
                                $warehouse->quantity_borrow -= $item->quantity;

                                if ($warehouse->quantity_borrow < 0) {
                                    $warehouse->quantity_borrow = 0;
                                }
                                $modelWarehouses->save($warehouse);
                            }
                            $modelOrderHistorys->deleteAll(['order_id'=>$order->id, 'book_id'=>$item->book_id, 'warehouse_id'=> $item->warehouse_id, 'order_detail_id'=>$item->id, 'id_building'=>(int)$dataSend['building_id']]);
                            $modelOrderDetails->deleteAll(['order_id' => $order->id, 'book_id NOT IN' => $id_book]);
                        }
                    }


                    if(!empty($_GET['id'])){
                        $note = $user->name . ' sửa đơn mượn có ID là: ' . $order->id;
                    }else{
                        $note = $user->name . ' tạo đơn mượn có ID là: ' . $order->id;
                    }

                    addActivityHistory($user, $note, 'addOrder', $order->id);



                    $mess = '<p class="text-success">Tạo hoặc cập nhật đơn mượn thành công.</p>';
                    return $controller->redirect('/listOrder?mess=saveSuccess');
                }else {
                    $mess = '<p class="text-danger">Lưu đơn mượn không thành công.</p>';
                }
            }else{
                $mess = '<p class="text-danger">Bạn thiếu dữ liệu.</p>';
            }
        }

        $buildings = $modelBuilding->find()->where(['id'=>$user->idbuilding])->all()->toList();

        setVariable('mess', $mess);
        setVariable('buildings', $buildings);
        setVariable('customer', $customer);
        setVariable('order', $order);
        setVariable('books', $books);
        setVariable('orderDetails', $orderDetails);
    }else{
         return $controller->redirect('/login');
    }
}

function deleteOrder($input){  
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa đơn mượn';
    
    $user = checklogin('deleteOrder');   
    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        $modelOrders = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelWarehouses = $controller->loadModel('Warehouses');

        if (!empty($_GET['id'])) {
            $orderId = (int)$_GET['id'];

            $order = $modelOrders->find()->where(['id' => $orderId])->first();

            if (!empty($order)) {
                $orderDetails = $modelOrderDetails->find()->where(['order_id' => $orderId])->all()->toList();

                foreach ($orderDetails as $detail) {
                    $warehouse = $modelWarehouses->find()->where(['id' => $detail->warehouse_id])->first();
                    if(@$order==1){
                        if ($warehouse) {
                            $warehouse->quantity_borrow -= $detail->quantity;

                            if ($warehouse->quantity_borrow < 0) {
                                $warehouse->quantity_borrow = 0;
                            }

                            $modelWarehouses->save($warehouse);
                        }
                    }
                    $modelOrderDetails->delete($detail);
                }

                $note = $user->name . ' xóa đơn mượn có ID là: ' . $order->id;
                addActivityHistory($user, $note, 'deleteOrder', $order->id);

                $modelOrders->delete($order);

                return $controller->redirect('/listOrder?error=requestDeleteSuccess');
            }
        }
    } else {
        return $controller->redirect('/');
    }
}


