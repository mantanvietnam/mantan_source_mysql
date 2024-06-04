<?php 
function listCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelOrders = $controller->loadModel('Orders');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        $conditions = array('id_parent'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_group'])){
            $conditions['id_group'] = (int) $_GET['id_group'];
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

        if(!empty($_GET['email'])){
            $conditions['email'] = $_GET['email'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelCustomers->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Giới tính', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                ['name'=>'Ngày sinh', 'type'=>'text', 'width'=>25], 
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Khóa';
                    if($value->status=='active'){ 
                        $status= 'Kích hoạt';
                    }

                    $sex= 'Nữ';
                    if($value->sex==1){ 
                        $sex= 'Nam';
                    }

                    $birthday = '';
                    if(!empty($value->birthday_date) && !empty($value->birthday_month) && !empty($value->birthday_year)){
                        $birthday = $value->birthday_date.'/'.$value->birthday_month.'/'.$value->birthday_year;
                    }

                    $dataExcel[] = [
                                        $value->full_name,   
                                        $value->phone,   
                                        $value->address,   
                                        $value->email,   
                                        $sex,
                                        $status,
                                        $birthday
                                    ];
                }
            }
           export_excel($titleExcel,$dataExcel,'danh_sach_khach_hang');
        }else{
            $listData = $modelCustomers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    // thống kê đơn hàng
                    $order = $modelOrders->find()->where(['id_user'=>$value->id])->all()->toList();
                    $listData[$key]->number_order = count($order);

                    // lịch sử chăm sóc
                    $listData[$key]->history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id])->order(['id'=>'desc'])->first();
                }
            }
        }

        // phân trang
        $totalData = $modelCustomers->find()->where($conditions)->all()->toList();
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

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroup = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

function editCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thông tin khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        if(!empty($_GET['id'])){
            $data = $modelCustomers->find()->where(['id'=>(int) $_GET['id'], 'id_parent'=>$session->read('infoUser')->id])->first();

            if(empty($data)){
                return $controller->redirect('/listCustomerAgency');
            }

            $note_now = 'Đại lý '.$session->read('infoUser')->name.' sửa thông tin khách hàng';
            $action_now = 'edit';
        }else{
            $data = $modelCustomers->newEmptyEntity();

            $note_now = 'Đại lý '.$session->read('infoUser')->name.' tạo mới thông tin khách hàng';
            $action_now = 'create';
        }
            
        $mess= '';
        
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['full_name'])){
                if(empty($_GET['id']) && !empty($dataSend['phone'])){
                    $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                    $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    $checkPhone = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                    if(!empty($checkPhone)){
                        $mess= '<p class="text-danger">Số điện thoại này đã được sử dụng bởi khách hàng khác</p>';
                    }else{
                        $data->phone = $dataSend['phone'];
                        $data->status = 'active';
                        $data->id_messenger = '';
                        $data->pass = md5($data->phone);
                        $data->id_parent = $session->read('infoUser')->id;
                        $data->created_at = time();
                    }
                }

                if(empty($mess)){
                    $data->full_name = $dataSend['full_name'];
                    $data->email = $dataSend['email'];
                    $data->address = $dataSend['address'];
                    $data->sex = (int) $dataSend['sex'];
                    $data->id_city = (int) @$dataSend['id_city'];
                    $data->avatar = (!empty($dataSend['avatar']))?$dataSend['avatar']:$urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";
                    $data->birthday_date = (int) $dataSend['birthday_date'];
                    $data->birthday_month = (int) $dataSend['birthday_month'];
                    $data->birthday_year = (int) $dataSend['birthday_year'];
                    $data->id_group = (int) @$dataSend['id_group'];
                    $data->facebook = @$dataSend['facebook'];

                    $modelCustomers->save($data);

                    // lưu lịch sử khách hàng
                    $customer_histories = $modelCustomerHistories->newEmptyEntity();

                    $customer_histories->id_customer = $data->id;
                    
                    $customer_histories->time_now = time();
                    $customer_histories->note_now = $note_now;
                    $customer_histories->action_now = $action_now;
                    $customer_histories->id_staff_now = $session->read('infoUser')->id;
                    $customer_histories->status = 'done';

                    $modelCustomerHistories->save($customer_histories);

                    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                }
            }else{
                $mess= '<p class="text-danger">Bạn không được để trống các trường bắt buộc</p>';
            }
        }

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listGroupCustomer', $listGroupCustomer);
        
    }else{
        return $controller->redirect('/login');
    }
}

function groupCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $modelCustomers = $controller->loadModel('Customers');

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Nhóm khách hàng';

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
            $infoCategory->parent = $session->read('infoUser')->id;
            $infoCategory->image = '';
            $infoCategory->keyword = '';
            $infoCategory->description = '';
            $infoCategory->type = 'group_customer';
            $infoCategory->slug = createSlugMantan($infoCategory->name);

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $customers = $modelCustomers->find()->where(['id_group'=>$value->id])->all()->toList();
                $listData[$key]->number_customer = count($customers);
            }
        }

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteGroupCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Nhóm khách hàng';

        if ($_GET['id']) {
            $infoCategory = $modelCategories->find()->where(['id'=>(int) $_GET['id'], 'parent'=>$session->read('infoUser')->id])->first();

            if(!empty($infoCategory)){
                $modelCategories->delete($infoCategory);
            }
        }

        return $controller->redirect('/groupCustomerAgency');
    }else{
        return $controller->redirect('/login');
    }
}
?>