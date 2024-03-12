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

function editCustomerAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Sửa thông tin khách hàng';

        $modelCustomers = $controller->loadModel('Customers');

        if(!empty($_GET['id'])){
            $data = $modelCustomers->find()->where(['id'=>(int) $_GET['id'], 'id_parent'=>$session->read('infoUser')->id])->first();

            if(!empty($data)){
                $mess= '';
                
                if($isRequestPost){
                    $dataSend = $input['request']->getData();

                    if(!empty($dataSend['full_name'])){
                        $data->full_name = $dataSend['full_name'];
                        $data->email = $dataSend['email'];
                        $data->address = $dataSend['address'];
                        $data->sex = (int) $dataSend['sex'];
                        $data->id_city = (int) @$dataSend['id_city'];
                        $data->avatar = $dataSend['avatar'];
                        $data->birthday_date = (int) $dataSend['birthday_date'];
                        $data->birthday_month = (int) $dataSend['birthday_month'];
                        $data->birthday_year = (int) $dataSend['birthday_year'];

                        $modelCustomers->save($data);

                        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                    }else{
                        $mess= '<p class="text-danger">Bạn không được để trống các trường bắt buộc</p>';
                    }
                }

                setVariable('data', $data);
                setVariable('mess', $mess);
            }else{
                return $controller->redirect('/listCustomerAgency');
            }
        }else{
            return $controller->redirect('/listCustomerAgency');
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>