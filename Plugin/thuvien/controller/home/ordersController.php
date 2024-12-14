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

function updateOrderStatus($input) {  
    global $modelOrders;
    global $controller;

    $user = checklogin('updateOrderStatus');   
    if (empty($user)) {
        echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để thực hiện thao tác này.']);
        exit;
    }

    if (!empty($_POST['id']) && isset($_POST['status'])) {
        $orderId = $_POST['id'];
        $newStatus = $_POST['status'];

        $modelOrder = $controller->loadModel('Orders');
        $order = $modelOrder->find()->where(['id' => $orderId])->first();

        if (!empty($order)) {
            $order->status = $newStatus;

            if ($modelOrder->save($order)) {
                $note = $user->name . ' cập nhật trạng thái đơn hàng ID ' . $orderId . ' thành ' . $newStatus;
                addActivityHistory($user, $note, 'updateOrderStatus', $orderId);

                echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Lỗi khi lưu dữ liệu!']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy đơn hàng!']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ!']);
        exit;
    }
}

function addOrder($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Thêm hoặc Chỉnh sửa Đơn hàng';
    $modelOrders = $controller->loadModel('Orders'); 
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelbuilding = $controller->loadModel('Buildings');
    $buildings = $modelbuilding->find()->all()->toList();

    $user = checklogin('addOrder');
    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        // Lấy thông tin đơn hàng nếu có ID
        if (!empty($_GET['id'])) {
            $order = $modelOrders->find()->where(['id' => (int)$_GET['id']])->first();
            if (empty($order)) {
                return $controller->redirect('/listOrders');
            }
        } else {
            $order = $modelOrders->newEmptyEntity();
            $order->created_at = time();
        }

        $mess = '';
        // Xử lý khi có request POST
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            // Kiểm tra đầu vào
            if (
                isset($dataSend['customer_id'], $dataSend['building_id'], $dataSend['return_deadline']) &&
                is_numeric($dataSend['customer_id']) && 
                is_numeric($dataSend['building_id'])
            ) {
                $order->member_id = (int)$user->id;
                $order->customer_id = (int)$dataSend['customer_id'];
                $order->building_id = (int)$dataSend['building_id'];
                $order->status = 1; // Trạng thái mặc định
                $order->return_deadline = strtotime($dataSend['return_deadline']);
                $order->updated_at = time();

                // Lưu đơn hàng
                if ($modelOrders->save($order)) {
                    // Thêm hoặc cập nhật chi tiết đơn hàng
                    if (!empty($dataSend['order_details'])) {
                        foreach ($dataSend['order_details'] as $detail) {
                            addOrderDetail([
                                'request' => (object)[
                                    'getData' => function () use ($detail, $order) {
                                        return array_merge($detail, ['order_id' => $order->id]);
                                    },
                                ],
                            ]);
                        }
                    }
                    return $controller->redirect('/listOrders?mess=saveSuccess');
                } else {
                    $mess = '<p class="text-danger">Lưu đơn hàng không thành công</p>';
                }
            } else {
                $mess = '<p class="text-danger">Vui lòng nhập đầy đủ thông tin bắt buộc</p>';
            }
        }

        setVariable('mess', $mess);
        setVariable('buildings', $buildings);
        setVariable('mess', $mess);
    } else {
        return $controller->redirect('/login');
    }
}

function addOrderDetail($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Thêm hoặc Chỉnh sửa Chi tiết Đơn hàng';
    $modelOrderDetails = $controller->loadModel('OrderDetails'); 

    $user = checklogin('addOrderDetail');
    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        // Tạo hoặc chỉnh sửa dữ liệu
        if (!empty($_GET['id'])) {
            $data = $modelOrderDetails->find()->where(['id' => (int)$_GET['id']])->first();
            if (empty($data)) {
                return $controller->redirect('/listOrder');
            }
        } else {
            $data = $modelOrderDetails->newEmptyEntity();
            $data->created_at = time();
        }

        $mess = '';
        // Xử lý khi có request POST
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            // Kiểm tra đầu vào
            if (
                isset($dataSend['order_id'], $dataSend['book_id'], $dataSend['quantity'], $dataSend['warehouse_id']) &&
                is_numeric($dataSend['order_id']) &&
                is_numeric($dataSend['book_id']) &&
                is_numeric($dataSend['quantity']) &&
                is_numeric($dataSend['warehouse_id'])
            ) {
                $data->order_id = (int)$dataSend['order_id'];
                $data->book_id = (int)$dataSend['book_id'];
                $data->quantity = (int)$dataSend['quantity'];
                $data->warehouse_id = (int)$dataSend['warehouse_id'];
                $data->updated_at = time();

                // Lưu dữ liệu
                if ($modelOrderDetails->save($data)) {
                    return $controller->redirect('/listOrder?mess=saveSuccess');
                } else {
                    $mess = '<p class="text-danger">Lưu dữ liệu không thành công</p>';
                }
            } else {
                $mess = '<p class="text-danger">Tất cả các trường là bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    } else {
        return $controller->redirect('/login');
    }
}

