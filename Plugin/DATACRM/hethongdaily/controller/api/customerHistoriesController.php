<?php 
function getListCustomerHistoriesAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_customer'])){
                    $conditions = array('id_customer'=> (int) $dataSend['id_customer'],'id_staff_now'=>$infoMember->id);
                    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                    if($page<1) $page = 1;
                    $order = array('id'=>'desc');

                    $listData = $modelCustomerHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
                    
                    $totalData = $modelCustomerHistories->find()->where($conditions)->all()->toList();

                    $customer = $modelCustomers->find()->where(['id'=> (int) $dataSend['id_customer']])->first();
                    
                    $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData), 'customer'=>$customer);
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
                }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function saveCustomerHistoryAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $urlHomes;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if( !empty($dataSend['id_customer']) && 
                    !empty($dataSend['note']) &&
                    !empty($dataSend['action']) && 
                    !empty($dataSend['time']) 
                ){
                    $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id_customer']])->first();
                    
                    if(empty($infoCustomer)){
                        return array('code'=>4, 'mess'=>'Không tìm thấy thông tin khách hàng');
                    }

                    $customer_histories = $modelCustomerHistories->newEmptyEntity();

                    $customer_histories->id_customer = $infoCustomer->id;

                    $time_now = explode(" ", $dataSend['time']);
                    $time = explode(":", $time_now[0]);
                    $date = explode("/", $time_now[1]);
                    
                    $customer_histories->time_now = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
                    $customer_histories->note_now = $dataSend['note'];
                    $customer_histories->action_now = $dataSend['action'];
                    $customer_histories->id_staff_now = $infoMember->id;
                    $customer_histories->status = 'new';

                    $modelCustomerHistories->save($customer_histories);

                    $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_customer_history'=>$customer_histories->id);
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function updateStatusCustomerHistoryAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $urlHomes;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if( !empty($dataSend['id_customer_history']) && 
                    !empty($dataSend['status']) 
                ){
                    $infoCustomerHistory = $modelCustomerHistories->find()->where(['id'=>(int) $dataSend['id_customer_history'], 'id_staff_now'=>$infoMember->id])->first();
                    
                    if(empty($infoCustomerHistory)){
                        return array('code'=>4, 'mess'=>'Khách hàng không thuộc quyền quản lý của đại lý');
                    }
                    
                    $infoCustomerHistory->status = $dataSend['status'];

                    $modelCustomerHistories->save($infoCustomerHistory);

                    $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_customer_history'=>$infoCustomerHistory->id);
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getListCustomerHistoriesTodayAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                // Thời gian đầu ngày
                $startOfDay = strtotime("today 00:00:00");
                // Thời gian cuối ngày
                $endOfDay = strtotime("tomorrow 00:00:00") - 1;
                    
                $conditions = array('id_staff_now'=>$infoMember->id, 'time_now >='=>$startOfDay,'time_now <='=>$endOfDay);
                  
                $order = array('id'=>'desc');

                $listData = $modelCustomerHistories->find()->where($conditions)->order($order)->all()->toList();
                    
                $totalData = $modelCustomerHistories->find()->where($conditions)->all()->toList();

                if(empty($listData)){
                    foreach($listData as $key => $item){
                         $listData[$key]->customer = $modelCustomers->find()->where(['id'=> (int) $item->id_customer])->first();
                    }
                }

                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
               
            }else{
                $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>1, 'gửi sai kiểu POST');
        }

    return $return;
}

?>