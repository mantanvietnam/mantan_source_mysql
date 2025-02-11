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
?>