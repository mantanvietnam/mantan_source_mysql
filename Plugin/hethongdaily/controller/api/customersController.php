<?php 
function getListCustomerAPI($input)
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
                $conditions = array('id_parent'=>$infoMember->id);
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

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
                
                $totalData = $modelCustomers->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getInfoCustomerAPI($input)
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
                    $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id_customer'], 'id_parent'=>$infoMember->id])->first();

                    if(!empty($infoCustomer)){
                        // thống kê đơn hàng
                        $order = $modelOrders->find()->where(['id_user'=>$infoCustomer->id])->all()->toList();
                        $infoCustomer->number_order = count($order);

                        // lịch sử chăm sóc
                        $infoCustomer->history = $modelCustomerHistories->find()->where(['id_customer'=>$infoCustomer->id])->order(['id'=>'desc'])->first();

                        $return = array('code'=>0, 'infoCustomer'=>$infoCustomer);
                    }else{
                        $return = array('code'=>4, 'mess'=>'Tài khoản khách hàng không tồn tại hoặc bạn khách hàng này không do bạn quản lý nữa');
                    }
                    
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

function saveInfoCustomerAPI($input)
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
                if( !empty($dataSend['full_name']) && 
                    !empty($dataSend['phone'])
                ){
                    $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                    $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    if(!empty($dataSend['id'])){
                        $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id'], 'id_parent'=>$infoMember->id])->first();
                        
                        if(empty($infoCustomer)){
                            return array('code'=>4, 'mess'=>'Khách hàng không thuộc quyền quản lý của đại lý');
                        }
                    }else{
                        $checkPhone = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                        if(!empty($checkPhone)){
                            return array('code'=>5, 'mess'=>'Khách hàng đã có dữ liệu trong hệ thống');
                        }else{
                            $infoCustomer = $modelCustomers->newEmptyEntity();
                        }
                    }

                    // nếu up file ảnh avatar lên
                    $dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        $avatar = uploadImage($infoMember->id, 'avatar');

                        if(!empty($avatar['linkOnline'])){
                            $dataSend['avatar'] = $avatar['linkOnline'];
                        }
                    }

                    $infoCustomer->full_name = $dataSend['full_name'];
                    $infoCustomer->phone = $dataSend['phone'];
                    $infoCustomer->email = @$dataSend['email'];
                    $infoCustomer->address = @$dataSend['address'];
                    $infoCustomer->sex = (int) @$dataSend['sex'];
                    $infoCustomer->id_city = (int) @$dataSend['id_city'];
                    $infoCustomer->id_messenger = '';
                    $infoCustomer->status = 'active';
                    $infoCustomer->avatar = $dataSend['avatar'];
                    $infoCustomer->pass = md5($dataSend['phone']);
                    $infoCustomer->id_parent = $infoMember->id;
                    $infoCustomer->birthday_date = (int) @$dataSend['birthday_date'];
                    $infoCustomer->birthday_month = (int) @$dataSend['birthday_month'];
                    $infoCustomer->birthday_year = (int) @$dataSend['birthday_year'];
                    $infoCustomer->id_aff = (int) @$dataSend['id_aff'];

                    $modelCustomers->save($infoCustomer);

                    // lưu lịch sử chăm sóc khách hàng
                    if(empty($dataSend['id'])){
                        $note_now = 'Đại lý '.$infoMember->name.' ('.$infoMember->phone.') tạo dữ liệu khách hàng';
                        $action_now = 'create';
                    }else{
                        $note_now = 'Đại lý '.$infoMember->name.' ('.$infoMember->phone.') sửa dữ liệu khách hàng';
                        $action_now = 'edit';
                    }

                    $customer_histories = $modelCustomerHistories->newEmptyEntity();

                    $customer_histories->id_customer = $infoCustomer->id;
                    
                    $customer_histories->time_now = time();
                    $customer_histories->note_now = $note_now;
                    $customer_histories->action_now = $action_now;
                    $customer_histories->id_staff_now = $infoMember->id;
                    $customer_histories->status = 'done';

                    $modelCustomerHistories->save($customer_histories);

                    $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_customer'=>$infoCustomer->id);
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
?>