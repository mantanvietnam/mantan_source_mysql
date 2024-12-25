<?php

function listCustomer($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listCustomer');
    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        $metaTitleMantan = 'Danh sách khách hàng';

        $order = ['id' => 'desc'];
        $limit = 20;
        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $conditions = [];

        if (!empty($_GET['id'])) {
            $conditions['id'] = (int)$_GET['id'];
        }

        if (!empty($_GET['name'])) {
            $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
        }

        if (!empty($_GET['phone'])) {
            $conditions['phone LIKE'] = '%' . $_GET['phone'] . '%';
        }

        if (!empty($_GET['status'])) {
            $conditions['status'] = $_GET['status'];
        }

        if (!empty($_GET['action']) && $_GET['action'] == 'Excel') {
            $listData = $modelCustomers->find()->where($conditions)->order($order)->all()->toList();

            $titleExcel = [
                ['name' => 'ID', 'type' => 'text', 'width' => 10],
                ['name' => 'Tên khách hàng', 'type' => 'text', 'width' => 25],
                ['name' => 'Số điện thoại', 'type' => 'text', 'width' => 20],
                ['name' => 'Địa chỉ', 'type' => 'text', 'width' => 35],
                ['name' => 'Email', 'type' => 'text', 'width' => 25],
                ['name' => 'Ngày sinh', 'type' => 'text', 'width' => 15],
                ['name' => 'Trạng thái', 'type' => 'text', 'width' => 15],
                ['name' => 'Ngày tạo', 'type' => 'text', 'width' => 20]
            ];

            $dataExcel = [];
            if (!empty($listData)) {
                foreach ($listData as $value) {
                    $status = ($value->status == 'active') ? 'Kích hoạt' : 'Khóa';
                    $dataExcel[] = [
                        $value->id,
                        $value->name,
                        $value->phone,
                        $value->address,
                        $value->email,
                        !empty($value->birthday) ? date('d-m-Y', strtotime($value->birthday)) : '',
                        $status,
                        date('d-m-Y H:i:s', $value->created_at)
                    ];
                }
            }

            export_excel($titleExcel, $dataExcel, 'danh_sach_khach_hang');
        } else {
            $listData = $modelCustomers->find()
                ->limit($limit)
                ->page($page)
                ->where($conditions)
                ->order($order)
                ->all()
                ->toList();
            
                foreach ($listData as $customer) {
                    $customerId = $customer->id;

                    $customer->borrowedCount = $modelOrders->find()
                        ->where(['customer_id' => $customerId, 'status' => 1])
                        ->count();

                    $customer->returnedCount = $modelOrders->find()
                        ->where(['customer_id' => $customerId, 'status' => 2])
                        ->count();
            }
        }

        $totalData = $modelCustomers->find()->where($conditions)->count();
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

function addCustomer($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    $metaTitleMantan = 'Thêm người mượn sách';
    $modelCustomers = $controller->loadModel('Customers'); 

    $user = checklogin('addCustomer');
    if (!empty($user)) {
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }

        if (!empty($_GET['id'])) {
            $data = $modelCustomers->find()->where(['id' => (int)$_GET['id']])->first();

            if (empty($data)) {
                return $controller->redirect('/listCustomer');
            }
        } else {
            $data = $modelCustomers->newEmptyEntity();
            $data->created_at = time();
        }
        $mess = '';
        // Xử lý khi có request POST
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if (!empty($dataSend['name'])) {
                $phone = $dataSend['phone'];
                $identity = $dataSend['identity'];

                // Kiểm tra trùng số điện thoại hoặc giấy tờ tùy thân
                $existingCustomer = $modelCustomers->find()
                    ->where(['OR' => [
                        'phone' => $phone,
                        'identity' => $identity
                    ]])
                    ->first();

                if ($existingCustomer) {
                    if ($existingCustomer->phone == $phone) {
                        $mess = '<p class="text-danger">Số điện thoại đã tồn tại</p>';
                    } elseif ($existingCustomer->identity == $identity) {
                        $mess = '<p class="text-danger">Giấy tờ tùy thân đã tồn tại</p>';
                    }
                } else {
                    // Lưu dữ liệu mới nếu không trùng lặp
                    $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                    $data->identity = $identity;
                    $data->phone = $phone;
                    $data->address = str_replace(array('"', "'"), '’', $dataSend['address']);
                    $data->email = $dataSend['email'];
                    $data->birthday = strtotime(str_replace("/", "-", $dataSend['birthday']));
                    $data->status = $dataSend['status'];

                    if ($modelCustomers->save($data)) {
                        return $controller->redirect('/listCustomer?mess=saveSuccess');
                    } else {
                        $mess = '<p class="text-danger">Lưu dữ liệu không thành công</p>';
                    }
                }
            } else {
                $mess = '<p class="text-danger">Tên người mượn là bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    } else {
        return $controller->redirect('/login');
    }
}

function deleteCustomer($input){  
    global $isRequestPost;
    global $modelCustomers;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Xóa người mượn sách';
    
    $user = checklogin('deleteCustomer');   
    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        $modelCustomers = $controller->loadModel('Customers');


        if (!empty($_GET['id'])) {
            $conditions = array('id' => $_GET['id']);
            
            $customer = $modelCustomers->find()->where($conditions)->first();

            if (!empty($customer)) {
                $note = $user->name . ' đã xóa thông tin người mượn ' . $customer->name . ' có ID là: ' . $customer->id;
                addActivityHistory($user, $note, 'deleteCustomer', $customer->id);

                $modelCustomers->delete($customer);

                return $controller->redirect('/listCustomer?error=requestDeleteSuccess');
            } else {
                return $controller->redirect('/listCustomer?error=requestDeleteNotFound');
            }
        } else {
            return $controller->redirect('/listCustomer?error=requestDeleteInvalidID');
        }
    } else {
        return $controller->redirect('/');
    }
}

