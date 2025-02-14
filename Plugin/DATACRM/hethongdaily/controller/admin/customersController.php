<?php 
function listCustomerAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    $metaTitleMantan = 'Danh sách khách hàng';

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelMembers = $controller->loadModel('Members');

    // danh sách nhóm khách hàng
    $conditions = array('type' => 'group_customer');
    $listGroup = $modelCategories->find()->where($conditions)->all()->toList();
    $listNameGroup = [];
    if(!empty($listGroup)){
        foreach ($listGroup as $key => $value) {
            $listNameGroup[$value->id] = $value->name;
        }
    }

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('Customers.id'=>'desc');
    $join = [];
    $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo','Customers.token','Customers.blue_check'];

    if(!empty($_GET['id'])){
        $conditions['Customers.id'] = (int) $_GET['id'];
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

    if(!empty($_GET['id_aff'])){
        $conditions['Customers.id_aff'] = $_GET['id_aff'];
    }

    if(!empty($_GET['phone_member'])){
        $checkMember = $modelMembers->find()->where(['phone'=>$_GET['phone_member']])->first();

        if(!empty($checkMember->id)){
            $join = [
                        [
                            'table' => 'category_connects',
                            'alias' => 'CategoryConnects',
                            'type' => 'LEFT',
                            'conditions' => [
                                'Customers.id = CategoryConnects.id_parent'
                            ],
                        ]
                    ];

            $conditions['CategoryConnects.id_category'] = $checkMember->id;
            $conditions['CategoryConnects.keyword'] = "member_customers";
        }
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
            $listMember = [];
            foreach ($listData as $key => $value) {
                $order = $modelOrders->find()->where(['id_user'=>$value->id])->all()->toList();
                $listData[$key]->number_order = count($order);

                if($value->id_parent>0){
                    if(empty($listMember[$value->id_parent])){
                        $listMember[$value->id_parent] = $modelMembers->find()->where(['id'=>$value->id_parent])->first();
                    }

                    $listData[$key]->name_parent = @$listMember[$value->id_parent]->name.' '.@$listMember[$value->id_parent]->phone;
                }

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
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
   
}

function blueCheckCustomerAdmin($input){
    global $controller;

    $modelCustomers = $controller->loadModel('Customers');
    
    if(!empty($_GET['id'])){
        $data = $modelCustomers->get($_GET['id']);   
        if($data){
            $data->blue_check = $_GET['status'];
          
            $modelCustomers->save($data);
        }
        if($_GET['status']=='active'){
                $dataSendNotification= array('title'=>'Lên tích xanh thành công',
                            'time'=>date('H:i d/m/Y'),
                            'content'=>"chúc mừng bạn đã lên tích xanh",
                            'action'=>'sendGreenCheckRequest');

                if(!empty($data->token_device)){
                    sendNotification($dataSendNotification, $data->token_device);
                    saveNotification($dataSendNotification, $data->id,0);
                }
        }
    }
    return $controller->redirect('/plugins/admin/hethongdaily-view-admin-customer-listCustomerAdmin');
}

function infoCustomerAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;
    global $modelCategoryConnects;

    $user = checklogin('editCustomerAgency');   

    $metaTitleMantan = 'Thông tin khách hàng';

    $modelCustomers = $controller->loadModel('Customers');
    $modelActivityHistory = $controller->loadModel('ActivityHistorys');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');
    $modelTokenDevices = $controller->loadModel('TokenDevices');

    if(!empty($_GET['id'])){
        $join = [
            [
                'table' => 'category_connects',
                'alias' => 'CategoryConnects',
                'type' => 'LEFT',
                'conditions' => [
                    'Customers.id = CategoryConnects.id_parent'
                ],
            ]
        ];

        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo','Customers.token','Customers.max_export_mmtc'];

            $data = $modelCustomers->find()->join($join)->select($select)->where(['Customers.id'=>(int) $_GET['id'], 'CategoryConnects.keyword'=>'member_customers'])->first();

            if(empty($data)){
                return $controller->redirect('/listCustomerAgency');
            }
           

            
            $group_customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $data->id])->all()->toList();
            $data->groups = [];

            if(!empty($group_customers)){
                foreach ($group_customers as $key => $value) {
                    $data->groups[] = $value->id_category;
                }
            }
        }else{
            $data = $modelCustomers->newEmptyEntity();
        }

        $mess= '';
        
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['full_name'])){
                if(empty($_GET['id'])){
                    if(!empty($dataSend['phone'])){
                        $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                        if($dataSend['phone'][0]!='0'){
                            $dataSend['phone'] = '0'.$dataSend['phone'];
                        }

                        $checkPhone = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                        if(!empty($checkPhone)){
                            // $mess= '<p class="text-danger">Số điện thoại này đã được sử dụng bởi khách hàng khác</p>';
                            $data = $checkPhone;
                        }else{
                            $data->phone = $dataSend['phone'];
                            $data->status = 'active';
                            $data->id_messenger = '';
                            $data->id_zalo = '';
                            $data->pass = md5($data->phone);
                            $data->id_parent = 1;
                            $data->created_at = time();
                        }
                    }else{
                        $mess= '<p class="text-danger">Nhập thiếu dữ liệu số điện thoại</p>';
                    }
                }
                    $data->full_name = $dataSend['full_name'];

                    if(!empty($dataSend['email'])){
                        $data->email = $dataSend['email'];
                    }elseif(empty($data->email)){
                        $data->email = '';
                    }

                    if(!empty($dataSend['address'])){
                        $data->address = $dataSend['address'];
                    }elseif(empty($data->address)){
                        $data->address = '';
                    }
                    
                    if(isset($dataSend['sex']) && $dataSend['sex'] != ''){
                        $data->sex = (int) $dataSend['sex'];
                    }elseif(empty($data->sex)){
                        $data->sex = 0;
                    }

                    if(!empty($dataSend['id_city'])){
                        $data->id_city = (int) @$dataSend['id_city'];
                    }elseif(empty($data->id_city)){
                        $data->id_city = 0;
                    }

                    if(!empty($dataSend['avatar'])){
                        $data->avatar = $dataSend['avatar'];
                    }

                    if(!empty($dataSend['birthday_date'])){
                        $data->birthday_date = (int) $dataSend['birthday_date'];
                    }elseif(empty($data->birthday_date)){
                        $data->birthday_date = 0;
                    }

                    if(!empty($dataSend['birthday_month'])){
                        $data->birthday_month = (int) $dataSend['birthday_month'];
                    }elseif(empty($data->birthday_month)){
                        $data->birthday_month = 0;
                    }
                    
                    if(!empty($dataSend['birthday_year'])){
                        $data->birthday_year = (int) $dataSend['birthday_year'];
                    }elseif(empty($data->birthday_year)){
                        $data->birthday_year = 0;
                    }

                    if(!empty($dataSend['id_group'][0])){
                        $data->id_group = (int) $dataSend['id_group'][0];
                    }elseif(empty($data->id_group)){
                        $data->id_group = 0;
                    }

                    if(!empty($dataSend['facebook'])){
                        $data->facebook = @$dataSend['facebook'];
                    }elseif(empty($data->facebook)){
                        $data->facebook = '';
                    }

                    if(!empty($dataSend['status'])){
                        $data->status = @$dataSend['status'];
                    }

                    if(isset($dataSend['max_export_mmtc'])){
                        $data->max_export_mmtc = (int)@$dataSend['max_export_mmtc'];
                    }

                    if(!empty($dataSend['password'])){
                        $data->pass = md5($dataSend['password']);
                    }

                    $modelCustomers->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Bạn không được để trống các trường bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
                            
}
?>