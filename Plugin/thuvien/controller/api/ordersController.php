<?php

function deleteOrderDetail() {
    global $controller;

    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelWarehouses = $controller->loadModel('Warehouses');

    $return = array();
    $dataSend = $_REQUEST;

    if (!empty($dataSend['id']) && !empty($dataSend['warehouse_id']) && isset($dataSend['quantity'])) {
        $detailId = (int) $dataSend['id'];
        $warehouseId = (int) $dataSend['warehouse_id'];
        $quantity = (int) $dataSend['quantity'];

        $orderDetail = $modelOrderDetails->find()->where(['id' => $detailId])->first();

        if ($orderDetail) {
            if ($modelOrderDetails->delete($orderDetail)) {
                $warehouse = $modelWarehouses->find()->where(['id' => $warehouseId])->first();

                if ($warehouse) {
                    $warehouse->quantity_borrow -= $quantity;
                    if ($warehouse->quantity_borrow < 0) {
                        $warehouse->quantity_borrow = 0;
                    }
                    $modelWarehouses->save($warehouse);
                }

                $return = array(
                    'success' => true,
                    'message' => 'Xóa chi tiết đơn hàng và cập nhật kho thành công.'
                );
            } else {
                $return = array(
                    'success' => false,
                    'message' => 'Không thể xóa chi tiết đơn hàng. Vui lòng thử lại.'
                );
            }
        } else {
            $return = array(
                'success' => false,
                'message' => 'Chi tiết đơn hàng không tồn tại.'
            );
        }
    } else {
        $return = array(
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.'
        );
    }

    return $return;
}

function updateOrderStatus() {
    global $isRequestPost;
    global $controller;

    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelWarehouses = $controller->loadModel('Warehouses');
    $modelOrderHistorys = $controller->loadModel('OrderHistorys');
    
    $return = array();
    $dataSend = $_REQUEST;
    $user = checklogin('updateOrderStatus');
     if(!empty($user)) {
        if (empty($user->grant_permission)) {
            return array(
                'success' => false,
                'message' => 'Bạn không có quyền.'
            );
        }
    if (!empty($dataSend['id']) && isset($dataSend['status'])) {
        $orderId = (int)$dataSend['id'];
        $newStatus = (int)$dataSend['status'];

        $order = $modelOrders->find()->where(['id' => $orderId])->first();

        if ($order) {
            $order->status = $newStatus;
            $order->updated_at = time();
            if ($modelOrders->save($order)) {
                if ($newStatus==2) {
                    $orderDetails = $modelOrderDetails->find()->where(['order_id' => $orderId])->all();

                    foreach ($orderDetails as $detail) {
                        $warehouse = $modelWarehouses->find()->where(['id' => $detail->warehouse_id])->first();
                        $quantity = $detail->quantity;
                        if(!empty($detail->quantity_return) && $detail->quantity_return<$detail->quantity){
                            $quantity = $detail->quantity - $detail->quantity_return;
                        }
                        if ($warehouse) {
                            $warehouse->quantity_borrow -= $quantity;

                            if ($warehouse->quantity_borrow < 0) {
                                $warehouse->quantity_borrow = 0;
                            }

                            $modelWarehouses->save($warehouse);

                            $history = $modelOrderHistorys->newEmptyEntity();
                            $history->order_id = $order->id;
                            $history->book_id = (int)$detail->book_id;
                            $history->warehouse_id = (int)$detail->warehouse_id;
                            $history->order_detail_id = $orderDetail->id;
                            $history->id_building = (int)$dataSend['building_id'];
                            $history->created_at = time();
                            $history->type = 'minus';
                            $history->quantity = $quantity;
                            $history->id_member = (int)$user->id;


                            $history->quantity = (int)$quantity;
                               
                            $modelOrderHistorys->save($history);

                            $detail->quantity_return = $detail->quantity;
                            $modelOrderDetails->save($detail);
                            
                        }
                    }
                }

                 $note = $user->name . ' đã nhận sách khách trả của đơn mượn có ID là: ' . $order->id;
                addActivityHistory($user, $note, 'Order', $order->id);

                $return = array(
                    'success' => true,
                    'message' => 'Cập nhật trạng thái đơn hàng thành công.'
                );
            } else {
                $return = array(
                    'success' => false,
                    'message' => 'Không thể cập nhật trạng thái đơn hàng. Vui lòng thử lại.'
                );
            }
        } else {
            $return = array(
                'success' => false,
                'message' => 'Đơn hàng không tồn tại.'
            );
        }
        } else {
            $return = array(
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.'
            );
        }
    }else{
        array(
                'success' => false,
                'message' => 'chưa đăng nhập.'
            );
    }

    return $return;
}

function updateOrderOuantity($input){
    global $isRequestPost;
    global $controller;
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelWarehouses = $controller->loadModel('Warehouses');
    $modelOrderHistorys = $controller->loadModel('OrderHistorys');
    
    $return = array();
      $user = checklogin('updateOrderStatus');
    if(!empty($user)) {
        if (empty($user->grant_permission)) {
            return array(
                'success' => false,
                'message' => 'Bạn không có quyền.'
            );
        }
      
        if($isRequestPost){
            $dataSend = $input['request']->getData();
                if(!empty($dataSend['id']) && !empty($dataSend['quantity'])){
                    $orderDetails = $modelOrderDetails->find()->where(['id' => $dataSend['id']])->first();
                    if(!empty($orderDetails)){
                        $order = $modelOrder->find()->where(['id' => $orderDetails->order_id])->first();

                        $quantity =  $orderDetails->quantity - $orderDetails->quantity_return;
                        if($quantity>=(int)$dataSend['quantity']){
                            $orderDetails->quantity_return += $dataSend['quantity'];

                            $modelOrderDetails->save($orderDetails);
                              $warehouse = $modelWarehouses->find()->where(['id' => $orderDetails->warehouse_id])->first();
                           
                            if ($warehouse) {
                                $warehouse->quantity_borrow -= (int)$dataSend['quantity'];

                                if ($warehouse->quantity_borrow < 0) {
                                    $warehouse->quantity_borrow = 0;
                                }

                                $modelWarehouses->save($warehouse);
                            }

                                $history = $modelOrderHistorys->newEmptyEntity();
                                $history->order_id = $order->id;
                                $history->book_id = (int)$orderDetails->book_id;
                                $history->warehouse_id = (int)$orderDetails->warehouse_id;
                                $history->order_detail_id = $orderDetails->id;
                                $history->id_building = (int)$order->building_id;
                                $history->created_at = time();
                                $history->type = 'minus';
                                $history->quantity = $quantity;
                                $history->id_member = (int)$user->id;


                                $history->quantity = (int)$quantity;
                                   
                                $modelOrderHistorys->save($history);

                                $checkOrderDetail = $modelOrderDetails->find()->where(['order_id' => $order->id])->all()->toList();
                                $totalData = count($checkOrderDetail);
                                $check = 0;
                                if(!empty($checkOrderDetail)){
                                    foreach($checkOrderDetail as $key => $item){
                                        if($orderDetails->quantity_return == $orderDetails->quantity){
                                            $check +=1;
                                        }
                                    }
                                }
                                if($totalData==$check){
                                    $order->status = 2; 
                                }else{
                                    $order->status = 3;
                                }
                                $modelOrder->save($order);
                                return array(
                                'success' => true,
                                'message' => 'bạn thao tác trả sách thành công.'
                            );

                        }else{
                            return array(
                                'success' => false,
                                'message' => 'Số lượng sách nhỏ hơn hoặc bằng số lượng sách đang mượn.'
                            );
                        }
                    }else{
                        return array(
                        'success' => false,
                        'message' => 'đơn không tồn tại.'
                        );
                    }
                }else{
                    return array(
                        'success' => false,
                        'message' => 'Thiếu dữ liệu.'
                    );
                }

        }else{
            $return = array(
                'success' => false,
                'message' => 'bạn chuyển phươi thức POST.'
            );
        }

    }else{
        $return = array(
                'success' => false,
                'message' => 'chưa đăng nhập.'
            );
    }

    return $return;

}


function getOrderDetailsByOrderIdAPI() {
    global $controller;

    $return = array();

    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelOrders = $controller->loadModel('Orders');
    $modelBooks = $controller->loadModel('Books');
    $modelCustomers = $controller->loadModel('Customers');

    $modelOrderHistorys = $controller->loadModel('OrderHistorys');
    $dataSend = $_REQUEST;
    $orderId = !empty($dataSend['order_id']) ? (int) $dataSend['order_id'] : null;

        if (empty($orderId) || !is_numeric($orderId)) {
            $return[] = array(
                'id' => 0,
                'label' => 'ID đơn hàng không hợp lệ.',
                'value' => ''
            );
            return $return;
        }

        $order = $modelOrders->find()->where(['id' => $orderId])->first();
        if (empty($order)) {
            $return[] = array(
                'id' => 0,
                'label' => 'Không tìm thấy đơn hàng.',
                'value' => ''
            );
            return $return;
        }

        $customer = $modelCustomers->find()->where(['id' => $order->customer_id])->first();
        $return[] = array(
            'order_id' => $order->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'customer_email' => $customer->email,
            'status' => $order->status,
            'return_deadline' => date('d-m-Y H:i:s', date($order->return_deadline)),
            'return_created' => date('d-m-Y H:i:s', date($order->created_at))
        );

        $orderDetails = $modelOrderDetails->find()->where(['order_id' => $orderId])->all()->toList();

        $orderDetailData = [];
        foreach ($orderDetails as $detail) {
            $book = $modelBooks->find()->where(['id' => $detail->book_id])->first();
            $total = $modelOrderHistorys->find()->where(['order_id'=>$orderId, 'book_id'=>(int)$detail->book_id, 'order_detail_id'=>$detail->id, 'type'=>'minus'])->count();
            $orderDetailData[] = array(
                'id' => $detail->id,
                'book_name' => $book ? $book->name : 'N/A',
                'quantity' => $detail->quantity,
                'quantity_return' => $detail->quantity_return,
                'total' => $total,
            );
        }

        return array(
            'order_info' => $return,
            'order_details' => $orderDetailData
        );
}



function getOrderDetailsByOrderDetailsIdAPI() {
    global $controller;

    $return = array();

    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelOrders = $controller->loadModel('Orders');
    $modelBooks = $controller->loadModel('Books');
    $modelCustomers = $controller->loadModel('Customers');
    $modelMember = $controller->loadModel('Members');
    $modelOrderHistorys = $controller->loadModel('OrderHistorys');
    $dataSend = $_REQUEST;
    $id_order_detail = !empty($dataSend['id_order_detail']) ? (int) $dataSend['id_order_detail'] : null;

        if (empty($id_order_detail) || !is_numeric($id_order_detail)) {
            $return[] = array(
                'id' => 0,
                'label' => 'ID đơn hàng không hợp lệ.',
                'value' => ''
            );
            return $return;
        }

        $history = $ $modelOrderHistorys->find()->where(['order_id'=>$orderId, 'book_id'=>(int)$detail->book_id, 'order_detail_id'=>$detail->id, 'type'=>'minus'])->all();
        if (empty($order)) {
            $return[] = array(
                'id' => 0,
                'label' => 'Không tìm thấy đơn hàng.',
                'value' => ''
            );
            return $return;
        }

        $customer = $modelCustomers->find()->where(['id' => $order->customer_id])->first();

        $historyData = [];
        foreach ($history as $detail) {
            $member = $modelMember->find()->where(['id'=>$detail->id_member])->first();
           
            $historyData[] = array(
                'id' => $detail->id,
                'name' => $member ? $member->name : 'N/A',
                'quantity' => $detail->quantity,
                'created_at' =>  date('d-m-Y H:i:s', date($order->created_at),
                'type' =>  $detail->type,
            );
        }

        return array(
            'order_info' => $return,
            'historyData' => $historyData
        );
}