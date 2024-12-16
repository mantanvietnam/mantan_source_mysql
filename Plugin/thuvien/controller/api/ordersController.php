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
    
    $return = array();
    $dataSend = $_REQUEST;

    if (!empty($dataSend['id']) && isset($dataSend['status'])) {
        $orderId = (int)$dataSend['id'];
        $newStatus = (int)$dataSend['status'];

        $order = $modelOrders->find()->where(['id' => $orderId])->first();

        if ($order) {
            $order->status = $newStatus;
            $order->updated_at = time();

            if ($modelOrders->save($order)) {
                if ($newStatus == 2) {
                    $orderDetails = $modelOrderDetails->find()->where(['order_id' => $orderId])->all();

                    foreach ($orderDetails as $detail) {
                        $warehouse = $modelWarehouses->find()->where(['id' => $detail->warehouse_id])->first();

                        if ($warehouse) {
                            $warehouse->quantity_borrow -= $detail->quantity;

                            if ($warehouse->quantity_borrow < 0) {
                                $warehouse->quantity_borrow = 0;
                            }

                            $modelWarehouses->save($warehouse);
                        }
                    }
                }

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

    return $return;
}
