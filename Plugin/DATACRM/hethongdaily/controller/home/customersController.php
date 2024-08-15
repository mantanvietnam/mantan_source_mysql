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

        $conditions = array('CategoryConnects.id_category'=>$session->read('infoUser')->id, 'CategoryConnects.keyword'=>'member_customers');
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('Customers.id'=>'desc');
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

        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

        if(!empty($_GET['id'])){
            $conditions['Customers.id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_group'])){
            $conditions['CategoryConnects.id_category'] = (int) $_GET['id_group'];
            $conditions['CategoryConnects.keyword'] = 'group_customers';
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
                    $order = $modelOrders->find()->where(['id_user'=>$value->id, 'id_agency'=>$session->read('infoUser')->id])->all()->toList();
                    $listData[$key]->number_order = count($order);

                    // lịch sử chăm sóc
                    $listData[$key]->history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id, 'id_staff_now'=>$session->read('infoUser')->id])->order(['id'=>'desc'])->first();

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

            $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

            $data = $modelCustomers->find()->join($join)->select($select)->where(['Customers.id'=>(int) $_GET['id'], 'CategoryConnects.id_category'=>$session->read('infoUser')->id, 'CategoryConnects.keyword'=>'member_customers'])->first();

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
                            $data->id_parent = $session->read('infoUser')->id;
                            $data->created_at = time();
                        }
                    }else{
                        $mess= '<p class="text-danger">Nhập thiếu dữ liệu số điện thoại</p>';
                    }
                }

                if(empty($mess)){
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

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        if(!empty($data->id)){
                            $fileName = 'avatar_'.$data->id;
                        }else{
                            $fileName = 'avatar_'.time().rand(0,1000000);
                        }

                        $avatar = uploadImage($session->read('infoUser')->id, 'avatar', $fileName);
                    }

                    if(!empty($avatar['linkOnline'])){
                        $data->avatar = $avatar['linkOnline'].'?time='.time();
                    }else{
                        if(empty($data->avatar)){
                            $data->avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";
                        }
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

                    $modelCustomers->save($data);

                    // bắn thông báo có dữ liệu khách hàng mới
                    if(empty($_GET['id'])){
                        if(!empty($session->read('infoUser')->noti_new_customer)){
                            $dataSendNotification= array('title'=>'Khách hàng mới','time'=>date('H:i d/m/Y'),'content'=>$data->full_name.' đã trở thành khách hàng mới của bạn','action'=>'addCustomer');
                            $token_device = [];

                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$session->read('infoUser')->id])->all()->toList();

                            if(!empty($listTokenDevice)){
                                foreach ($listTokenDevice as $tokenDevice) {
                                    if(!empty($tokenDevice->token_device)){
                                        $token_device[] = $tokenDevice->token_device;
                                    }
                                }

                                if(!empty($token_device)){
                                    $return = sendNotification($dataSendNotification, $token_device);
                                }
                            }
                        }
                    }

                    // lưu bảng đại lý
                    saveCustomerMember($data->id, $session->read('infoUser')->id);

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

function downloadMMTC($input)
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
        $metaTitleMantan = 'Tải thần số học khách hàng';

        $modelCustomers = $controller->loadModel('Customers');

        if(!empty($_GET['id_customer'])){
            $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $_GET['id_customer']])->first();

            if(!empty($infoCustomer->link_download_mmtc)){
                return $controller->redirect($infoCustomer->link_download_mmtc);
            }

            if(!empty($infoCustomer->birthday_date)){
                $birthday = $infoCustomer->birthday_date.'/'.$infoCustomer->birthday_month.'/'.$infoCustomer->birthday_year;
                $linkFull = '';

                if(empty($infoCustomer->email)){
                    $infoCustomer->email = 'datacrmasia@gmail.com';
                }

                if(empty($infoCustomer->address)){
                    $infoCustomer->address = '18 Thanh Bình, Mộ Lao, Hà Đông, Hà Nội';
                }

                if(function_exists('getLinkFullMMTCAPI')){
                    $linkFull = getLinkFullMMTCAPI($infoCustomer->full_name, $birthday, $infoCustomer->phone, $infoCustomer->email, $infoCustomer->address, $infoCustomer->avatar, (int) $infoCustomer->sex);
                }

                if(!empty($linkFull)){
                    $infoCustomer->link_download_mmtc = $linkFull;

                    $modelCustomers->save($infoCustomer);

                    return $controller->redirect($linkFull);
                }else{
                    return $controller->redirect('/listCustomerAgency/?error=emptyLinkDownload');        
                }
            }
        }else{
            return $controller->redirect('/listCustomerAgency/?error=emptyIDCustomer');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function addDataCustomerAgency($input)
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

        $modelCustomer = $controller->loadModel('Customers');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');
        $modelTokenDevices = $controller->loadModel('TokenDevices');

        

        $mess= '';
        
        if($isRequestPost){
            $dataSeries = uploadAndReadExcelData('dataCustomer');

            if($dataSeries){
                unset($dataSeries[0]);

                $double = [];
                $number = 0;
                foreach ($dataSeries as $key => $value) {
                    if(!empty($value[0]) && !empty($value[1])){
              
                        $value[1] = trim(str_replace(array(' ','.','-'), '', $value[1]));
                        $value[1] = str_replace('+84','0',$value[1]);

                        if($value[1][0]!='0'){
                            $value[1] = '0'.$value[1];
                        }
                        
                        $conditions = ['phone'=>$value[1]];
                        $checkPhone = $modelCustomer->find()->where($conditions)->first();

                        if(empty($checkPhone)){
                            $data = $modelCustomer->newEmptyEntity();
                            
                            $data->full_name = $value[0];
                            $data->phone = $value[1];
                            $data->status = 'active';
                            $data->id_messenger = '';
                            $data->id_zalo = '';
                            $data->pass = md5($data->phone);
                            $data->id_parent = $session->read('infoUser')->id;
                            $data->created_at = time();

                            if(!empty($value[2])){
                                $data->email = $value[2];
                            }elseif(empty($data->email)){
                                $data->email = '';
                            }

                            if(!empty($value[3])){
                                $data->address = $value[3];
                            }elseif(empty($data->address)){
                                $data->address = '';
                            }

                            if(isset($value[4]) && $value[4] != ''){
                                $data->sex = (int) $value[4];
                            }elseif(empty($data->sex)){
                                $data->sex = 0;
                            }


                            $data->id_city = 0;
                            
                            $data->avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";

                            if(!empty($value[5])){
                                $date = explode("/", $value[5]);
                                $data->birthday_date = (int) $date[0];
                                $data->birthday_month = (int) $date[1];
                                $data->birthday_year = (int) $date[2];
                            }else{
                                $data->birthday_date = 0;
                                $data->birthday_month = 0;
                                $data->birthday_year = 0;
                            }


                            if(!empty($value[6])){
                                $id_group = explode(",", $value[6]);
                                $data->id_group = (int) $id_group[0];
                            }elseif(empty($data->id_group)){
                                $data->id_group = 0;
                            }

                            if(!empty($value[7])){
                                $data->facebook = $value[7];
                            }elseif(empty($data->facebook)){
                                $data->facebook = '';
                            }

                            $modelCustomer->save($data);
                            $number += 1;
                            // lưu bảng đại lý
                            saveCustomerMember($data->id, $session->read('infoUser')->id);

                            saveCustomerHistorie($data->id);

                            if(!empty($value[6])){
                                $id_group = explode(",", $value[6]);
                                saveCustomerCategory($data->id,$id_group);
                            }

                        }else{
                            $double[] = $value[1];
                        }

                    }else{
                        $mess= '<p class="text-danger">Bạn không được để trống tên và số điện thoại</p>';
                    }
                }

                if(!empty($double)){
                    $mess= '<p class="text-danger">Các khách hàng sau đã có tài khoản từ trước: '.implode(', ', $double).'</p>';
                }

                if(!empty($session->read('infoUser')->noti_new_customer)){
                    $dataSendNotification= array('title'=>'Khách hàng mới','time'=>date('H:i d/m/Y'),'content'=>'Đã nhập file excel dữ liệu khách hàng mới thành công','action'=>'addCustomer');
                    $token_device = [];

                    $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$session->read('infoUser')->id])->all()->toList();

                    if(!empty($listTokenDevice)){
                        foreach ($listTokenDevice as $tokenDevice) {
                            if(!empty($tokenDevice->token_device)){
                                $token_device[] = $tokenDevice->token_device;
                            }
                        }

                        if(!empty($token_device)){
                            $return = sendNotification($dataSendNotification, $token_device);
                        }
                    }
                }

                $mess .= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }
        }

        setVariable('mess', $mess);

    }else{
        return $controller->redirect('/login');
    }
}

function lockCustomerAgency($input)
{
    global $controller;
    global $session;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id'])){
            // id_parent: id khách hàng, id_category: id đại lý
            $data = $modelCategoryConnects->find()->where(['keyword'=>'member_customers', 'id_parent'=>(int) $_GET['id'], 'id_category'=>(int) $session->read('infoUser')->id])->first();

            if($data){
                $modelCategoryConnects->delete($data);
            }
        }

        return $controller->redirect('/listCustomerAgency/?status=deleteCustomerDone');
    }else{
        return $controller->redirect('/login');
    }
}

function resultMMTC($input)
{
    global $controller;
    global $isRequestPost;
    global $session;

    $dataSend = $_GET;

    
    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Tải thần số học khách hàng';

        $modelCustomers = $controller->loadModel('Customers');

        if(!empty($_GET['id_customer'])){
              $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $_GET['id_customer']])->first();

            if(!empty($infoCustomer)){
                // chuẩn hóa dữ liệu
                $dataSend['day'] = (int) $infoCustomer->birthday_date;
                $dataSend['month'] = (int) $infoCustomer->birthday_month;
                $dataSend['year'] = (int) $infoCustomer->birthday_year;
                
                $dataSend['birthday'] = $dataSend['day'].'/'.$dataSend['month'].'/'.$dataSend['year'];
                $dataSend['phone']= str_replace(array(' ','.','-'), '', @$infoCustomer->phone);
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                if($dataSend['day']<1 || $dataSend['day']>31 || $dataSend['month']<1 || $dataSend['month']>12 || $dataSend['year']<1900 || $dataSend['year']>2124){
                    return $controller->redirect('/?error=birthday');
                }

                if(strlen($dataSend['phone']) != 10){
                    return $controller->redirect('/?error=phone');
                }

                $age = 0;
                $date = new \DateTime($dataSend['year'].'/'.$dataSend['month'].'/'.$dataSend['day']);
                $now = new \DateTime();
                $diff = $now->diff($date);
                $age = $diff->y + 1;

                $tach_year = str_split($dataSend['year']);
                $data_year = implode(' + ', $tach_year);
                $kq_year = ketquapheptinhcong($tach_year);

                $tach_day = str_split($dataSend['day']);
                $data_day = implode(' + ', $tach_day);
                $kq_day = ketquapheptinhcong($tach_day);

                $tach_month = str_split($dataSend['month']);
                $data_month = implode(' + ', $tach_month);
                $kq_month = ketquapheptinhcong($tach_month);

                $consoduongdoi = ketquapheptinhcong([$kq_day, $kq_month, $kq_year]);

                $url = 'https://quantri.matmathanhcong.vn/api/Calculate?customer_birthdate='.$dataSend['day'].'/'.$dataSend['month'].'/'.$dataSend['year'].'&customer_name='.urlencode($infoCustomer->full_name);
                
                try {
                    $infoNumber = file_get_contents($url);
                } catch (Exception $e) {
                    return $controller->redirect('/?error=api_error');

                    echo "Đã xảy ra lỗi: " . $e->getMessage();
                }
                
                $infoNumber = json_decode($infoNumber, true);

                $full_number = array_merge($tach_year,$tach_month, $tach_day);

                debug($full_number);
                debug($infoNumber);
                die();



                setVariable('age', $age);
                setVariable('data_year', $data_year);
                setVariable('kq_year', $kq_year);
                setVariable('data_day', $data_day);
                setVariable('kq_day', $kq_day);
                setVariable('data_month', $data_month);
                setVariable('kq_month', $kq_month);
                setVariable('consoduongdoi', $consoduongdoi);
                setVariable('full_number', $full_number);
                setVariable('infoNumber', @$infoNumber['Result']);
            }else{
                return $controller->redirect('/?error=empty');
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listPointCustomer($input){
     global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách điểm xếp hạng khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelPointCustomer = $controller->loadModel('PointCustomers');
        $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
        $modelOrders = $controller->loadModel('Orders');

        
        $conditions = array('id_member'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
       

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }


        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['id_rating'])){
            $conditions['id_rating'] = $_GET['id_rating'];
        }

       
        $listData = $modelPointCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $listData[$key]->rating = $modelRatingPointCustomer->find()->where(['id'=>$value->id_rating])->first();
                $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                
            }
        }

        $rating = $modelRatingPointCustomer->find()->where([])->all()->toList();

        // phân trang
        $totalData = $modelPointCustomer->find()->where($conditions)->all()->toList();
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
        setVariable('rating', $rating);
    }else{
        return $controller->redirect('/login');
    }
}
?>