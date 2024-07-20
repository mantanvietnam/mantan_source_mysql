<?php 
function listAffiliaterAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách người tiếp thị';

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        $modelAffiliaters = $controller->loadModel('Affiliaters');
        $modelOrders = $controller->loadModel('Orders');
        $modelCustomers = $controller->loadModel('Customers');
        $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');

        $conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['phone'] = $_GET['phone'];
        }

        if(!empty($_GET['id_father'])){
            $conditions['id_father'] = $_GET['id_father'];
        }

        if(!empty($_GET['email'])){
            $conditions['email'] = $_GET['email'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelAffiliaters->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Người giới thiệu', 'type'=>'text', 'width'=>35],
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $aff = $modelAffiliaters->find()->where(['id_father'=>$value->id])->first();
                    if(!empty($aff)){
                        $aff = $aff->name.' ('.$aff->phone.')';
                    }else{
                        $aff = '';
                    }

                    $dataExcel[] = [
                                        $value->name,   
                                        $value->phone,   
                                        $value->address,   
                                        $value->email,   
                                        $aff
                                    ];
                }
            }
           export_excel($titleExcel,$dataExcel,'danh_sach_tiep_thi_lien_ket');
        }else{
            $listData = $modelAffiliaters->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $order = $modelOrders->find()->where(['id_aff'=>$value->id])->all()->toList();
                    $customer = $modelCustomers->find()->where(['id_aff'=>$value->id])->all()->toList();
                    $moneys = $modelTransactionAffiliateHistories->find()->where(['id_affiliater'=>$value->id, 'status'=>'new'])->all()->toList();

                    $money_back = 0;
                    if(!empty($moneys)){
                        foreach ($moneys as $item) {
                            $money_back += $item->money_back;
                        }
                    }

                    $listData[$key]->number_order = count($order);
                    $listData[$key]->number_customer = count($customer);
                    $listData[$key]->money_back = $money_back;

                    $listData[$key]->aff = $modelAffiliaters->find()->where(['id_father'=>$value->id])->first();
                }
            }
        }

        // phân trang
        $totalData = $modelAffiliaters->find()->where($conditions)->all()->toList();
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
    }else{
        return $controller->redirect('/login');
    }
}

function addAffiliaterAgency($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;
    global $session;


    if(!empty($session->read('infoUser'))){

        $user = $session->read('infoUser');
        $metaTitleMantan = 'Thông tin người tiếp thị';

        $modelAffiliaters = $controller->loadModel('Affiliaters');
        $modelMembers = $controller->loadModel('Members');
        $modelCustomers = $controller->loadModel('Customers');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelAffiliaters->get( (int) $_GET['id']);
        }else{
            $data = $modelAffiliaters->newEmptyEntity();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $conditions = ['phone'=>$dataSend['phone']];
                $checkPhone = $modelAffiliaters->find()->where($conditions)->first();

                if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
                    if(empty($dataSend['avatar'])){
                        $system = $modelCategories->find()->where(['id'=>(int) $dataSend['id_system']])->first();

                        if(!empty($system->image)){
                            $dataSend['avatar'] = $system->image;
                        }

                        if(empty($dataSend['avatar'])){
                            $dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-ezpics.png';
                        }
                    }

                    $dataSend['phone_father'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_father']));
                    $dataSend['phone_father'] = str_replace('+84','0',$dataSend['phone_father']);

                    $father =  $modelAffiliaters->find()->where(array('phone'=>$dataSend['phone_father']))->first();

                    // tạo dữ liệu save
                    $data->name = $dataSend['name'];
                    $data->address = $dataSend['address'];
                    $data->avatar = $dataSend['avatar'];
                    $data->portrait = $dataSend['portrait'];
                    $data->phone = $dataSend['phone'];
                    $data->email = $dataSend['email'];
                    $data->description = $dataSend['description'];
                    
                    $data->linkedin = $dataSend['linkedin'];
                    $data->web = $dataSend['web'];
                    $data->instagram = $dataSend['instagram'];
                    $data->zalo = $dataSend['zalo'];
                    $data->facebook = $dataSend['facebook'];
                    $data->twitter = $dataSend['twitter'];
                    $data->tiktok = $dataSend['tiktok'];
                    $data->youtube = $dataSend['youtube'];
                    
                    $data->id_father =(int) @$father->id;
                    $data->id_system = $user->id_system;

                    $data->id_customer = 0;
                    $data->id_member = $user->id;

                    if(empty($_GET['id'])){
                        if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
                        $data->password = md5($dataSend['password']);

                        $data->created_at = time();
                    }else{
                        if(!empty($dataSend['password'])){
                            $data->password = md5($dataSend['password']);
                        }
                    }
                    

                    $modelAffiliaters->save($data);

                    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                }else{
                    $mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
                }
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
            }
        }

        $conditions = array('type' => 'system_sales');
        $listSystem = $modelCategories->find()->where($conditions)->all()->toList();

        if(!empty($_GET['id'])){
            $father =  $modelAffiliaters->find()->where(array('id'=>$data->id_father))->first();

            $data->phone_father = (int) @$father->phone;
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listSystem', $listSystem);

    }else{
        return $controller->redirect('/login');
    }
}

function deleteAffiliaterAgency($input){
    global $controller;
    global $session;

    if(!empty($session->read('infoUser'))){

        $modelAffiliaters = $controller->loadModel('Affiliaters');
        
        if(!empty($_GET['id'])){
            $data = $modelAffiliaters->get($_GET['id']);
            
            if($data){
                $modelAffiliaters->delete($data);
            }
        }

        return $controller->redirect('/listAffiliaterAgency');

    }else{
        return $controller->redirect('/login');
    }
}

function listTransactionAffiliaterAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Lịch sử giao dịch';

    if(!empty($session->read('infoUser'))){

        $user = $session->read('infoUser');

        $modelAffiliaters = $controller->loadModel('Affiliaters');
        $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');


        $conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_affiliater'])){
            $conditions['id_affiliater'] = (int) $_GET['id_affiliater'];
        }

        if(!empty($_GET['id_order'])){
            $conditions['id_order'] = (int) $_GET['id_order'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelTransactionAffiliateHistories->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'ID đơn hàng', 'type'=>'text', 'width'=>25],
                ['name'=>'Giá trị đơn hàng', 'type'=>'text', 'width'=>25],
                ['name'=>'Tiền hoa hồng', 'type'=>'text', 'width'=>25],
                ['name'=>'Phần trăm chiết khấu', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $aff = $modelAffiliaters->find()->where(['id'=>$value->id_affiliater])->first();

                    $status = 'Chưa thanh toán';
                    if($value->status == 'done'){
                        $status = 'Đã thanh toán';
                    }

                    $dataExcel[] = [
                                        @$aff->name,   
                                        $aff->phone,   
                                        $value->id_order,   
                                        $value->money_total,   
                                        $value->money_back,   
                                        $value->percent,   
                                        $status
                                    ];
                }
            }
           export_excel($titleExcel,$dataExcel,'danh_sach_lich_su_giao_dich_tiep_thi_lien_ket');
        }else{
            $listData = $modelTransactionAffiliateHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$value->id_affiliater])->first();
                }
            }
        }

       
        // phân trang
        $totalData = $modelTransactionAffiliateHistories->find()->where($conditions)->all()->toList();
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
    }else{
        return $controller->redirect('/login');
    }
   
}

function payTransactionAffiliaterAgency($input)
{
    global $controller;

    $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');
    
    if(!empty($_GET['id'])){
        $data = $modelTransactionAffiliateHistories->get($_GET['id']);
        
        if($data){
            $data->status = 'done';

            $modelTransactionAffiliateHistories->save($data);
        }
    }

    return $controller->redirect('/listTransactionAffiliaterAgency');
}
?>