<?php 
function listCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelOrders = $controller->loadModel('Orders');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        // danh sách nhóm khách hàng
        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroup = $modelCategories->find()->where($conditions)->all()->toList();
        $listNameGroup = [];
        if(!empty($listGroup)){
            foreach ($listGroup as $key => $value) {
                $listNameGroup[$value->id] = $value->name;
            }
        }

        $conditions = array('Customers.id_parent'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('Customers.id'=>'desc');
        $join = [];
        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

        if(!empty($_GET['id'])){
            $conditions['Customers.id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_group'])){
            $join = [
                        [
                            'table' => 'category_connects',
                            'alias' => 'CategoryConnects',
                            'type' => 'LEFT',
                            'conditions' => [
                                'Customers.id = CategoryConnects.id_parent',
                                'CategoryConnects.keyword = "group_customers"'
                            ],
                        ]
                    ];

            $conditions['CategoryConnects.id_category'] = (int) $_GET['id_group'];
        }

        if(!empty($_GET['full_name'])){
            $conditions['Customers.full_name LIKE'] = '%'.$_GET['full_name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['Customers.phone'] = $_GET['phone'];
        }

        if(!empty($_GET['status'])){
            $conditions['Customers.status'] = $_GET['status'];
        }

        if(!empty($_GET['email'])){
            $conditions['Customers.email'] = $_GET['email'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelCustomers->find()->join($join)->select($select)->where($conditions)->order($order)->all()->toList();
            
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
            $listData = $modelCustomers->find()->join($join)->select($select)->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    // thống kê đơn hàng
                    $order = $modelOrders->find()->where(['id_user'=>$value->id])->all()->toList();
                    $listData[$key]->number_order = count($order);

                    // lịch sử chăm sóc
                    $listData[$key]->history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id])->order(['id'=>'desc'])->first();

                    // nhóm khách hàng
                    $group_customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $value->id])->all()->toList();
                    $value->groups = [];

                    if(!empty($group_customers)){
                        foreach ($group_customers as $group) {
                            if(!empty($listNameGroup[$group->id_category])){
                                $value->groups[] = $listNameGroup[$group->id_category];
                            }
                        }
                    }

                    if(!empty($value->groups)){
                        $listData[$key]->groups = implode('<br/>', $value->groups);
                    }else{
                        $listData[$key]->groups = '';
                    }
                    
                }
            }
        }

        // phân trang
        $totalData = $modelCustomers->find()->join($join)->select($select)->where($conditions)->all()->toList();
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
    global $modelCategoryConnects;

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

            
            $group_customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $data->id])->all()->toList();
            $data->groups = [];

            if(!empty($group_customers)){
                foreach ($group_customers as $key => $value) {
                    $data->groups[] = $value->id_category;
                }
            }
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
                        $data->id_zalo = '';
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
                    $data->id_group = (int) @$dataSend['id_group'][0];
                    $data->facebook = @$dataSend['facebook'];

                    $modelCustomers->save($data);

                    // tạo dữ liệu bảng chuyên mục
                    $modelCategoryConnects->deleteAll(['id_parent'=>$data->id, 'keyword'=>'group_customers']);

                    if(!empty($dataSend['id_group'])){
                        foreach ($dataSend['id_group'] as $id_group) {
                            $categoryConnects = $modelCategoryConnects->newEmptyEntity();

                            $categoryConnects->keyword = 'group_customers';
                            $categoryConnects->id_parent = $data->id;
                            $categoryConnects->id_category = (int) $id_group;

                            $modelCategoryConnects->save($categoryConnects);
                        }
                    }

                    $data->groups = !empty($dataSend['id_group'])?$dataSend['id_group']:[];

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
    global $modelCategoryConnects;

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
            $ezpics_config = [];
            $ezpics_config['id_ezpics'] = $dataSend['id_ezpics'];
            $ezpics_config['ezpics_full_name'] = $dataSend['ezpics_full_name'];
            $ezpics_config['ezpics_phone'] = $dataSend['ezpics_phone'];
            $ezpics_config['ezpics_code'] = $dataSend['ezpics_code'];
            $ezpics_config['ezpics_avatar'] = $dataSend['ezpics_avatar'];
            $ezpics_config['ezpics_name_member'] = $dataSend['ezpics_name_member'];


            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->parent = $session->read('infoUser')->id;
            $infoCategory->image = '';
            $infoCategory->keyword = '';
            $infoCategory->description = json_encode($ezpics_config);
            $infoCategory->type = 'group_customer';
            $infoCategory->slug = createSlugMantan($infoCategory->name);

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listData = $modelCategories->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers','id_category'=>$value->id])->all()->toList();
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
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Nhóm khách hàng';

        if ($_GET['id']) {
            $infoCategory = $modelCategories->find()->where(['id'=>(int) $_GET['id'], 'parent'=>$session->read('infoUser')->id])->first();

            if(!empty($infoCategory)){
                $modelCategories->delete($infoCategory);
                $modelCategoryConnects->deleteAll(['keyword'=>'group_customers', 'id_category'=>(int)$_GET['id']]);
            }
        }

        return $controller->redirect('/groupCustomerAgency');
    }else{
        return $controller->redirect('/login');
    }
}
?>