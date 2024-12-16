<?php

function listOrder($input) 
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listOrder');
    $modelOrders = $controller->loadModel('Orders');
    $modelMembers = $controller->loadModel('Members');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBuildings = $controller->loadModel('Buildings');

    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        $metaTitleMantan = 'Danh sách cho mượn sách';

        $order = ['id' => 'desc'];
        $limit = 20;
        $conditions = [];

        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        if(!empty($_GET['id'])){
            $conditions['id'] = (int)$_GET['id'];
        }

        if (!empty($_GET['name']) || !empty($_GET['phone'])) {
            $customerConditions = [];
            if (!empty($_GET['name'])) {
                $customerConditions['name LIKE'] = '%' . $_GET['name'] . '%';
            }
            if (!empty($_GET['phone'])) {
                $customerConditions['phone LIKE'] = '%' . $_GET['phone'] . '%';
            }

            $matchingCustomers = $modelCustomers->find()
                ->where($customerConditions)
                ->select(['id'])
                ->all()
                ->toList();

            if (!empty($matchingCustomers)) {
                $customerIds = array_map(function ($customer) {
                    return $customer->id;
                }, $matchingCustomers);
                $conditions['customer_id IN'] = $customerIds;
            } else {
                $conditions['customer_id'] = -1;
            }
        }

        if (!empty($_GET['status'])) {
            $conditions['status'] = $_GET['status'];
        }

        if (!empty($_GET['action']) && $_GET['action'] == 'Excel') {
            $listData = $modelOrders->find()->where($conditions)->order($order)->all()->toList();

            $titleExcel = [
                ['name' => 'ID', 'type' => 'text', 'width' => 10],
                ['name' => 'Mã đơn hàng', 'type' => 'text', 'width' => 20],
                ['name' => 'Tên khách hàng', 'type' => 'text', 'width' => 25],
                ['name' => 'Số điện thoại', 'type' => 'text', 'width' => 15],
                ['name' => 'Tòa nhà', 'type' => 'text', 'width' => 20],
                ['name' => 'Người phụ trách', 'type' => 'text', 'width' => 20],
                ['name' => 'Trạng thái', 'type' => 'text', 'width' => 15],
                ['name' => 'Ngày tạo', 'type' => 'text', 'width' => 20],
            ];

            $dataExcel = [];
            foreach ($listData as $value) {
                // Fetch related data
                $customer = $modelCustomers->get($value->customer_id);
                $building = $modelBuildings->get($value->building_id);
                $member = $modelMembers->get($value->member_id);

                $statusText = ($value->status == 'active') ? 'Hoạt động' : 'Đã khóa';

                $dataExcel[] = [
                    $value->id,
                    $value->order_id,
                    $customer->name ?? 'N/A',
                    $customer->phone ?? 'N/A',
                    $building->name ?? 'N/A',
                    $member->name ?? 'N/A',
                    $statusText,
                    date('d-m-Y H:i:s', strtotime($value->created_at)),
                ];
            }

            export_excel($titleExcel, $dataExcel, 'danh_sach_don_hang');
        } else {
            $listData = $modelOrders->find()
                ->limit($limit)
                ->page($page)
                ->where($conditions)
                ->order($order)
                ->all()
                ->toList();

            foreach ($listData as $key => $order) {
                $listData[$key]->customer = $modelCustomers->get($order->customer_id);
                $listData[$key]->building = $modelBuildings->get($order->building_id);
                $listData[$key]->member = $modelMembers->get($order->member_id);
            }
        }

        $totalData = $modelOrders->find()->where($conditions)->count();
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

    $metaTitleMantan = 'Tạo hoặc Chỉnh sửa Đơn hàng';

    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelBuilding = $controller->loadModel('Buildings');
    $modelCustomers = $controller->loadModel('Customers');
    $modelBooks = $controller->loadModel('Books');
    $modelWarehouses = $controller->loadModel('Warehouses');

    $buildings = $modelBuilding->find()->all()->toList();
    $customer = $modelCustomers->find()->all()->toList();
    $books = $modelBooks->find()->all()->toList();

    $user = checklogin('addOrder');
    if (empty($user) || empty($user->grant_permission)) {
        return $controller->redirect('/');
    }

    $orderDetails = [];
    $mess = '';
    $order = !empty($_GET['id']) 
        ? $modelOrders->find()->where(['id' => (int)$_GET['id']])->first() 
        : $modelOrders->newEmptyEntity();

    if (!$order) {
        return $controller->redirect('/listOrder');
    }

    if (!empty($order->id)) {
        $orderDetails = $modelOrderDetails->find()->where(['order_id' => $order->id])->all()->toList();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $order->member_id = (int)$user->id;
        $order->customer_id = (int)$dataSend['customer_id'];
        $order->building_id = (int)$dataSend['building_id'];
        $order->status = (int)$dataSend['status'];
        $order->created_at = !empty($order->id) ? $order->created_at : time();
        $order->return_deadline = strtotime(str_replace('/', '-', $dataSend['return_deadline']));
        $order->updated_at = time();

        if ($modelOrders->save($order)) {

            if (isset($dataSend['order_books']) && is_array($dataSend['order_books'])) {
                foreach ($dataSend['order_books'] as $detail) {
                    if (!empty($detail['book_id']) && !empty($detail['quantity']) && !empty($detail['warehouse_id'])) {
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
                    }
                }
            } else {
                $mess = '<p class="text-warning">Không có chi tiết đơn hàng nào được thêm.</p>';
            }

            $mess = '<p class="text-success">Tạo hoặc cập nhật đơn hàng thành công.</p>';
            return $controller->redirect('/listOrder?mess=saveSuccess');
        } else {
            $mess = '<p class="text-danger">Lưu đơn hàng không thành công.</p>';
        }
    }

    setVariable('mess', $mess);
    setVariable('buildings', $buildings);
    setVariable('customer', $customer);
    setVariable('order', $order);
    setVariable('books', $books);
    setVariable('orderDetails', $orderDetails);
}

