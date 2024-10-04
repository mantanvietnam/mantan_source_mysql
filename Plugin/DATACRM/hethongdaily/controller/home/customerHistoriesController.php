<?php 
function listCustomerHistoriesAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $mess = '';

    $user = checklogin('listCustomerHistoriesAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerAgency');
        }
        
        $metaTitleMantan = 'Lịch sử chăm sóc khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelMembers = $controller->loadModel('Members');
        $modelOrders = $controller->loadModel('Orders');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        $conditions = array('id_staff_now'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = (int) $_GET['id_customer'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['action_now'])){
            $conditions['action_now'] = $_GET['action_now'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelCustomerHistories->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
                ['name'=>'Khách hàng', 'type'=>'text', 'width'=>25],
                ['name'=>'Điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Nội dung', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                ['name'=>'Kiểu hành động', 'type'=>'text', 'width'=>25],
            ];

            $dataExcel = [];
            $listCustomer = [];

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Chưa xử lý';
                    if($value->status=='done'){ 
                        $status= 'Đã hoàn thành';
                    }

                    if(empty($listCustomer[$value->id_customer])){
                        $listCustomer[$value->id_customer] = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                    }

                    $dataExcel[] = [
                                        date('H:i d/m/Y', $value->time_now), 
                                        $listCustomer[$value->id_customer]->full_name,
                                        $listCustomer[$value->id_customer]->phone,
                                        $value->note_now,  
                                        $status,
                                        $value->action_now,  
                                    ];
                }
            }

            export_excel($titleExcel,$dataExcel,'lich_su_cham_soc_khach_hang');
        }else{
            $listData = $modelCustomerHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                $listCustomer = [];

                foreach ($listData as $key => $value) {
                    if(empty($listCustomer[$value->id_customer])){
                        $listCustomer[$value->id_customer] = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                    }

                    // lịch sử chăm sóc
                    $listData[$key]->info_customer = $listCustomer[$value->id_customer];
                }
            }
        }

        // phân trang
        $totalData = $modelCustomerHistories->find()->where($conditions)->all()->toList();
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
        setVariable('mess', $mess);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function addCustomerHistoriesAgency($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

     $user = checklogin('addCustomerHistoriesAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerHistoriesAgency');
        }

        $metaTitleMantan = 'Thông tin chăm sóc khách hàng';

        $modelActivityHistory = $controller->loadModel('ActivityHistorys');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');
        $modelCustomers = $controller->loadModel('Customers');

        $mess= '';


        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCustomerHistories->find()->where(['id'=>(int) $_GET['id'], 'id_staff_now'=>$user->id])->first();

            if(empty($data)){
                return $controller->redirect('/listCustomerHistoriesAgency');
            }
        }else{
            $data = $modelCustomerHistories->newEmptyEntity();
        }

        $checkCustomer = [];
        if(!empty($_GET['id_customer'])){
            $checkCustomer = $modelCustomers->find()->where(['id'=>(int) $_GET['id_customer']])->first();
        }elseif(!empty($data->id_customer)){
            $checkCustomer = $modelCustomers->find()->where(['id'=>(int) $data->id_customer])->first();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['id_customer']) && !empty($dataSend['time_now']) && !empty($dataSend['note_now']) && !empty($dataSend['action_now']) && !empty($dataSend['status'])){
                $checkCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id_customer']])->first();
                
                // tạo dữ liệu save
                if(!empty($checkCustomer)){
                    $data->id_customer = (int) $dataSend['id_customer'];
                    $data->note_now = $dataSend['note_now'];
                    $data->action_now = $dataSend['action_now'];
                    $data->id_staff_now = $user->id;
                    $data->id_staff = $user->id_staff;
                    $data->status = $dataSend['status'];

                    $time_now = explode(' ', $dataSend['time_now']);
                    $time = explode(':', $time_now[0]);
                    $date = explode('/', $time_now[1]);
                    $data->time_now = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);

                    $modelCustomerHistories->save($data);

                    $history = $modelActivityHistory->newEmptyEntity();

                    if(!empty($_GET['id'])){
                        $history->note = $user->type_tv.' '. $user->name.' sửa lịch hẹn khách hàng '.$checkCustomer->full_name.' có id lịch hẹn là:'.$data->id;
                    }else{
                        $history->note = $user->type_tv.' '. $user->name.' tạo mới lịch hẹn khách hàng '.$checkCustomer->full_name.' có id lịch hẹn là:'.$data->id;
                    }

                    $history->type = $user->type;
                    $history->id_staff = $user->id_staff;
                    $history->id_member = $user->id;
                    $history->keyword = 'CustomerHistories';
                    $history->time = time();
                    $history->id_key = $data->id;
                    $modelActivityHistory->save($history);

                    return $controller->redirect('/calendarCustomerHistoriesAgency?mess=saveSuccess');
                }else{
                    $mess= '<p class="text-danger">Đây không phải khách hàng của bạn</p>';
                }
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }

        $conditions = array('type' => 'group_customer', 'parent'=>$user->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('data', $data);
        setVariable('listGroupCustomer', $listGroupCustomer);
        setVariable('mess', $mess);
        setVariable('checkCustomer', $checkCustomer);
    }else{
        return $controller->redirect('/login');
    }
}

function calendarCustomerHistoriesAgency(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    
     $user = checklogin('calendarCustomerHistoriesAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerHistoriesAgency');
        }
        
        $metaTitleMantan = 'Lịch sử chăm sóc khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelMembers = $controller->loadModel('Members');
        $modelOrders = $controller->loadModel('Orders');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        $conditions = array('id_staff_now'=>$user->id);

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = (int) $_GET['id_customer'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['action_now'])){
            $conditions['action_now'] = $_GET['action_now'];
        }

        
        $listData = $modelCustomerHistories->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            $listCustomer = [];

            foreach ($listData as $key => $value) {
                if(empty($listCustomer[$value->id_customer])){
                    $listCustomer[$value->id_customer] = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                }

                    // lịch sử chăm sóc
                $listData[$key]->info_customer = $listCustomer[$value->id_customer];
            }
        }
        
        $conditions = array('type' => 'group_customer', 'parent'=>$user->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }
       
        
        setVariable('mess', $mess);
        setVariable('listData', $listData);
        setVariable('listGroupCustomer', $listGroupCustomer);
    }else{
        return $controller->redirect('/login');
    }
}

function treatmentCustomerHistoriesAgency(){
     global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    $user = checklogin('treatmentCustomerHistoriesAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/calendarCustomerHistoriesAgency');
        }

        $metaTitleMantan = 'Thông tin chăm sóc khách hàng';

        $modelCustomerHistories = $controller->loadModel('CustomerHistories');
        $modelCustomers = $controller->loadModel('Customers');
        $modelActivityHistory = $controller->loadModel('ActivityHistorys');
        $mess= '';


        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCustomerHistories->find()->where(['id'=>(int) $_GET['id'], 'id_staff_now'=>$user->id])->first();
            $checkCustomer = $modelCustomers->find()->where(['id'=>$data->id_customer])->first();
            if(!empty($data)){
                $data->status= 'done';
                $modelCustomerHistories->save($data);

                $history = $modelActivityHistory->newEmptyEntity();
                $history->note = $user->type_tv.' '. $user->name.' đã sử lý lịch hẹn của khách hàng '.$checkCustomer->full_name.' có id lịch hẹn là:'.$data->id;
                $history->type = $user->type;
                $history->id_staff = $user->id_staff;
                $history->id_member = $user->id;
                $history->keyword = 'CustomerHistories';
                $history->time = time();
                $history->id_key = $data->id;
                $modelActivityHistory->save($history);

            }            
            return $controller->redirect('/calendarCustomerHistoriesAgency?mess=saveSuccess');
        }else{
            return $controller->redirect('/calendarCustomerHistoriesAgency');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function addCustomerHistoriesAjax($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('addCustomerHistoriesAjax');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
           return array('code'=> 0 , 'mess'=>'<p class="text-danger">Bạn không có quyền thêm nhân viên mới</p>');
        }

        $metaTitleMantan = 'Thông tin chăm sóc khách hàng';

        $modelCustomerHistories = $controller->loadModel('CustomerHistories');
        $modelCustomers = $controller->loadModel('Customers');
        $modelActivityHistory = $controller->loadModel('ActivityHistorys');

        $mess= '';


        // lấy data edit
        
        $data = $modelCustomerHistories->newEmptyEntity();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['id_customer']) && !empty($dataSend['time_now']) && !empty($dataSend['note_now']) && !empty($dataSend['action_now']) && !empty($dataSend['status'])){
                $checkCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id_customer']])->first();
                // tạo dữ liệu save
                if(!empty($checkCustomer) && $checkCustomer->id_parent == $user->id){
                    $data->id_customer = (int) $dataSend['id_customer'];
                    $data->note_now = $dataSend['note_now'];
                    $data->action_now = $dataSend['action_now'];
                    $data->id_staff_now = $user->id;
                    $data->id_staff = $user->id_staff;
                    $data->status = $dataSend['status'];

                    $time_now = explode(' ', $dataSend['time_now']);
                    $time = explode(':', $time_now[0]);
                    $date = explode('/', $time_now[1]);
                    $data->time_now = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);

                    $modelCustomerHistories->save($data);

                    $history = $modelActivityHistory->newEmptyEntity();

                    
                    $history->note = $user->type_tv.' '. $user->name.' tạo mới lịch hẹn khách hàng '.$checkCustomer->full_name.' có id lịch hẹn là:'.$data->id;

                    $history->type = $user->type;
                    $history->id_staff = $user->id_staff;
                    $history->id_member = $user->id;
                    $history->keyword = 'CustomerHistories';
                    $history->time = time();
                    $history->id_key = $data->id;
                    $modelActivityHistory->save($history);

                    return array('code'=> 1 , 'mess'=>'<p class="text-success">Lưu dữ liệu thành công</p>','data'=>$data,'customer'=>$checkCustomer);
                }else{
                   return array('code'=> 0 , 'mess'=>'<p class="text-danger">Đây không phải khách hàng của bạn</p>');
                }
            }else{
                return array('code'=> 0 , 'mess'=>'<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>');
            }
        }
        return array('code'=> 0 , 'mess'=>'<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>');
        
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCustomerHistoriesAgency(){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    $user = checklogin('deleteCustomerHistoriesAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
           if(@$_GET['status']=='Calendar'){
                return $controller->redirect('/calendarCustomerHistoriesAgency');
            }else{
                return $controller->redirect('/listCustomerHistoriesAgency');
            }
        }
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        $modelActivityHistory = $controller->loadModel('ActivityHistorys');

        if(!empty($_GET['id'])){
            $data = $modelCustomerHistories->find()->where(['id_staff_now'=>$user->id, 'id'=>(int) $_GET['id']])->first();
              $checkCustomer = $modelCustomers->find()->where(['id'=>(int) $data->id_customer])->first();
            if(!empty($data) && !empty($checkCustomer)){
                 $history = $modelActivityHistory->newEmptyEntity();

                    
                    $history->note = $user->type_tv.' '. $user->name.' tạo mới lịch hẹn khách hàng '.$checkCustomer->full_name.' có nội dung là '.@$data->note.', id lịch hẹn là:'.$data->id;

                    $history->type = $user->type;
                    $history->id_staff = $user->id_staff;
                    $history->id_member = $user->id;
                    $history->keyword = 'CustomerHistories';
                    $history->time = time();
                    $history->id_key = $data->id;
                    $modelActivityHistory->save($history);

                $modelCustomerHistories->delete($data);
            }
        }
        if(@$_GET['status']=='Calendar'){

            return $controller->redirect('/calendarCustomerHistoriesAgency');
        }else{

            return $controller->redirect('/listCustomerHistoriesAgency');
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>