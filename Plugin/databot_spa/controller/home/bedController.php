<?php 
function listBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách giường';
    
    setVariable('page_view', 'listBed');
    
    if(!empty(checkLoginManager('listBed', 'room'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestBed':
                    $mess= '<p class="text-danger">Bạn cần tạo giường trước</p>';
                    break;
            }
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            if(!empty($dataSend['idEdit'])){
                $data = $modelBed->get( (int) $dataSend['idEdit']);
            }else{
                $data = $modelBed->newEmptyEntity();
            }

            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->status = 1;
            $data->id_room = $dataSend['id_room'];
            $data->id_spa = $session->read('id_spa');
            $data->id_member = $infoUser->id_member;
            $data->created_at = time();

            $modelBed->save($data);

            return $controller->redirect('/listBed');
        }
      
        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listData = $modelBed->find()->where($conditions)->order(['id_room'=>'desc'])->all()->toList();
        
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $room = $modelRoom->find()->where(['id'=>$value->id_room])->first();
                if(!empty($room)){
                    $listData[$key]->room = $room;
                }
            }
        }

        $listRoom = $modelRoom->find()->where($conditions)->all()->toList();

        if(empty($listRoom)){
            return $controller->redirect('/listRoom/?error=requestRoom');
        }

        setVariable('listData', $listData);
        setVariable('listRoom', $listRoom);
    }else{
        return $controller->redirect('/');
    }
}

function deleteBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa giường';
    setVariable('page_view', 'deleteBed');
   if(!empty(checkLoginManager('deleteBed', 'room'))){
        $infoUser = $session->read('infoUser');
        
        $modelBed = $controller->loadModel('Beds');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            
            $data = $modelBed->find()->where($conditions)->first();
            
            if(!empty($data)){
                $modelBed->delete($data);
            }
        }
    }else{
        return $controller->redirect('/');
    }
}

function listRoomBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh Phòng';
    
    setVariable('page_view', 'listRoomBed');
   if(!empty(checkLoginManager('listRoomBed', 'room'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelOrder = $controller->loadModel('Orders');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');
        $modelCustomer = $controller->loadModel('Customers');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listData = $modelRoom->find()->where($conditions)->all()->toList();

        $currentTimestamp = time();

        // Lấy thời gian đầu ngày (00:00:00)
        $startOfDayTimestamp = strtotime("midnight", $currentTimestamp);

        // Lấy thời gian cuối ngày (23:59:59)
        $endOfDayTimestamp = strtotime("tomorrow", $startOfDayTimestamp) - 1;
        // Chuyển đổi thành kiểu int
        
        if(!empty($listData)){
            foreach($listData as $key => $item){
                $databed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
                foreach($databed as $k => $value){
                    if(!empty($value->id_order)){
                        $order = $modelOrder->find()->where(array('id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'),'id'=>$value->id_order))->first();
                        if(!empty($order)){
                        $order->customer = $modelCustomer->find()->where(array('id'=>$order->id_customer))->first();
                            }
                        $databed[$k]->order = $order;

                        $conditionsOrder = array('id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'),'id_bed'=>$value->id,'status'=>0);
                        $conditionsOrder['time >='] = $startOfDayTimestamp;
                        $conditionsOrder['time <='] = $endOfDayTimestamp;
                    }

                    //$order = $modelOrder->find()->where($conditionsOrder)->all()->toList();

                    // if(!empty(@$order)){


                    //     $databed[$k]->status = 3;
                    // }
                }

                $listData[$key]->bed = $databed;

            }
        }else{
            return $controller->redirect('/listBed?error=requestBed');
        }
        
        setVariable('listData', $listData);

    }else{
        return $controller->redirect('/');
    }
}

function infoRoomBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
     setVariable('page_view', 'infoRoomBed');

    if(!empty(checkLoginManager('infoRoomBed', 'room'))){
        $modelCombo = $controller->loadModel('Combos');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelProduct = $controller->loadModel('Products');
        $modelCustomer = $controller->loadModel('Customers');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMember = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

        $user = $session->read('infoUser');

        $mess = '';

        if(!empty($_GET['idBed'])){
            $data = $modelBed->find()->where(['id'=>(int)$_GET['idBed'],'status'=>2])->first();

            if(!empty($data)){
               if(!empty($data->id_userservice)){
                    $id_user_service =  explode(",", $data->id_userservice);
                    $userservice = array();
                    foreach($id_user_service as $id_userservice){
                        if(!empty($id_userservice)){
                            $user_service = $modelUserserviceHistories->find()->where(array('id_bed'=>$data->id,'id'=>$id_userservice, 'status'=>1))->first();
                            $user_service->orderDetail = $modelOrderDetails->find()->where(['id'=>$user_service->id_order_details,'id_order'=>$user_service->id_order])->first();
                            $user_service->service = $modelService->find()->where(array('id'=>$user_service->id_services))->first();

                            $userservice[] =  $user_service;
                        }
                    }
                    $data->userservice = $userservice;
                }
            }else{
                return $controller->redirect('/listRoomBed');
            }

            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
            }

            if(!empty($data->id_order)){
                $data->order = $modelOrder->find()->where(array('id'=>$data->id_order))->first();
            }

            if(!empty($data->id_staff)){
                $data->staff = $modelMember->find()->where(array('id'=>$data->id_staff))->first();
            }
        }

        if(@$_GET['mess']=='done'){
            $mess = '<p class="text-success">Cập nhập thành công</p>';
        }
       
        

        setVariable('data', $data);
        setVariable('mess', @$mess);
        setVariable('modelUserserviceHistories', @$modelUserserviceHistories);

    }else{
        return $controller->redirect('/');
    }
}

function checkinbed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách đơn hàng';
     setVariable('page_view', 'checkinbed');
    if(!empty(checkLoginManager('checkinbed', 'room'))){
        $modelBed = $controller->loadModel('Beds');
        $modelOrder = $controller->loadModel('Orders');
        $user = $session->read('infoUser');

        if(!empty($_GET['id_order'])){
            $Order = $modelOrder->find()->where(array('id_bed'=>$_GET['id_bed'], 'status'=>2))->first();
            $bed = $modelBed->find()->where(array('id'=>$_GET['id_bed'], 'status'=>2))->first();
            if(empty($Order) && empty($bed)){
                $dataOrder = $modelOrder->get($_GET['id_order']);

                $dataOrder->check_in = time();
                $dataOrder->status = 2;

                $modelOrder->save($dataOrder);

                $dataBed = $modelBed->get($_GET['id_bed']);
                $dataBed->status = 2;

                $modelBed->save($dataBed);

                return $controller->redirect('/listRoomBed');
            }else{
                return $controller->redirect('/listOrder?mess=conkhach');
            }
        }

    }else{
        return $controller->redirect('/');
    }
}

function cancelBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
    setVariable('page_view', 'cancelBed');
    if(!empty(checkLoginManager('cancelBed', 'room'))){
        $modelBed = $controller->loadModel('Beds');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelAgency = $controller->loadModel('Agencys');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');
        
        $user = $session->read('infoUser');
         $return = array('code'=>0);
       if($isRequestPost){
            $dataSend = $input['request']->getData();

            $listData = $modelUserserviceHistories->find()->where(array('id_bed'=>$dataSend['idBed'], 'status'=>1))->all()->toList();

            if(!empty($listData)){
                foreach($listData as $key => $item){
                    $item->status = 3;
                    $item->check_out = time();
                    $item->note = @$item->note.', Nội dung hủy là: '.@$dataSend['note'];
                    $modelUserserviceHistories->save($item);

                    $checkOrderDetail = $modelOrderDetails->find()->where(['id'=>$item->id_order_details, 'type'=>'service'])->first();
                    if(!empty($checkOrderDetail)){
                        $checkOrderDetail->number_uses -=1;
                        $modelOrderDetails->save($checkOrderDetail);
                    }
                    $agency = $modelAgency->find()->where(['id_user_service'=>$item->id])->first();
                    if(!empty($agency)){
                        $modelAgency->delete($agency);  
                    }
                }
            }
            $datebed = $modelBed->get($dataSend['idBed']);
            $datebed->status = 1;
            $datebed->id_order = NULL;
            $datebed->id_staff = NULL;
            $datebed->id_customer = NULL;
            $datebed->id_id_userservice = NULL;
            $modelBed->save($datebed);

            $return = array('code'=>1);
        }

       return $return;
    }else{
        return $controller->redirect('/');
    }
}

function checkoutBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
    setVariable('page_view', 'checkoutBed');
    if(!empty(checkLoginManager('checkoutBed', 'room'))){
        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelCustomer = $controller->loadModel('Customers');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMember = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelDebts = $controller->loadModel('Debts');
        $modelBill = $controller->loadModel('Bills');
        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
        $modelPrepayCard = $controller->loadModel('PrepayCards');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

        $user = $session->read('infoUser');

        $mess = '';

        if(!empty($_GET['idBed'])){
          $data = $modelBed->find()->where(['id'=>(int)$_GET['idBed'],'status'=>2])->first();

            if(!empty($data)){
                if(!empty($data->id_userservice)){
                    $id_user_service =  explode(",", $data->id_userservice);
                    $userservice = array();
                    foreach($id_user_service as $id_userservice){
                        if(!empty($id_userservice)){
                            $user_service = $modelUserserviceHistories->find()->where(array('id_bed'=>$data->id,'id'=>$id_userservice, 'status'=>1))->first();
                            $user_service->orderDetail = $modelOrderDetails->find()->where(['id'=>$user_service->id_order_details,'id_order'=>$user_service->id_order])->first();
                            $user_service->service = $modelService->find()->where(array('id'=>$user_service->id_services))->first();

                            $userservice[] =  $user_service;
                        }
                    }
                    $data->userservice = $userservice;
                }
            }else{
                return $controller->redirect('/listRoomBed');
            }

            if(!empty($data->id_order)){
                $data->order = $modelOrder->find()->where(array('id'=>$data->id_order))->first();
            }

            if(!empty($data->id_customer)){
                $customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
                if(!empty($customer)){
                     $customer->card = $modelCustomerPrepaycards->find()->where(['total >= '=>$data->order->total_pay, 'id_customer'=>$customer->id])->all()->toList();
                }
                $data->customer = $customer;
            }
           

            if(!empty($data->id_staff)){
                $data->staff = $modelMember->find()->where(array('id'=>$data->id_staff))->first();
            }

        }

        if(@$_GET['mess']=='done'){
            $mess = '<p class="text-success">Cập nhập thành công</p>';
        }
      
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            $listData = $modelUserserviceHistories->find()->where(array('id_bed'=>$data->id, 'status'=>1))->all()->toList();

            if(!empty($listData)){
                foreach($listData as $key => $item){
                    $item->status = 2;
                    $item->check_out = time();
                    $item->note = @$item->note.', Nội dung hủy là: '.@$dataSend['note'];
                    
                    $modelUserserviceHistories->save($item);

                   
                }
            }
           
            $datebed = $modelBed->get($data->id);
            $datebed->status = 1;
            $datebed->id_order = NULL;
            $datebed->id_staff = NULL;
            $datebed->id_customer = NULL;
            $datebed->id_id_userservice = NULL;
            $modelBed->save($datebed);

            return $controller->redirect('/listRoomBed');
        }

        setVariable('data', $data);
        setVariable('mess', @$mess);
        setVariable('modelUserserviceHistories', @$modelUserserviceHistories);

    }else{
        return $controller->redirect('/');
    }
}

function editBebOrder($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
     setVariable('page_view', 'editBebOrder');

    if(!empty(checkLoginManager('editBebOrder', 'room'))){
        $modelCombo = $controller->loadModel('Combos');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelProduct = $controller->loadModel('Products');
        $modelCustomer = $controller->loadModel('Customers');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMember = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelAgency = $controller->loadModel('Agencys');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

        $user = $session->read('infoUser');

        $mess = '';

        if(!empty($_GET['idBed'])){
            $data = $modelBed->find()->where(['id'=>(int)$_GET['idBed'],'status'=>2])->first();

            if(!empty($data)){
                if(!empty($data->id_userservice)){
                    $id_user_service =  explode(",", $data->id_userservice);
                    $userservice = array();
                    foreach($id_user_service as $id_userservice){
                        if(!empty($id_userservice)){
                            $user_service = $modelUserserviceHistories->find()->where(array('id_bed'=>$data->id,'id'=>$id_userservice, 'status'=>1))->first();
                            $user_service->orderDetail = $modelOrderDetails->find()->where(['id'=>$user_service->id_order_details,'id_order'=>$user_service->id_order])->first();
                            $user_service->service = $modelService->find()->where(array('id'=>$id_userservice))->first();

                            $userservice[] =  $user_service;
                        }
                    }
                    $data->userservice = $userservice;
                }
            }else{
                return $controller->redirect('/listRoomBed');
            }

            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
            }
            if(!empty($data->id_order)){
                $data->order = $modelOrder->find()->where(array('id'=>$data->id_order))->first();
            }

            if(!empty($data->id_staff)){
                $data->staff = $modelMember->find()->where(array('id'=>$data->id_staff))->first();
            }

        }

        if($isRequestPost){
            $dataSend = $input['request']->getData();
         // /   debug($dataSend);die;
            $order = $modelOrder->find()->where(array('id'=>$data->id_order))->first();
            $datebed = $modelBed->get($_GET['idBed']);
            $datebed->id_staff =(int) $dataSend['id_staff'];

            $datebed->id_customer = (int)$dataSend['id_customer'];
            $id_user_service =array();
            if(!empty($dataSend['idService'])){
                $conditions = ['id_order'=>$data->id_order, 'id_product NOT IN'=>$dataSend['idService'], 'type'=>'service'];
                $conditionsService = ['id_order'=>$data->id_order, 'id_services NOT IN'=>$dataSend['idService'], 'status'=>1];
                $modelOrderDetails->deleteAll($conditions);
                $modelUserserviceHistories->deleteAll($conditionsService);
                foreach($dataSend['idService'] as $key => $value){
                    $checkOrderDetail = $modelOrderDetails->find()->where(['id_product'=>(int)$value,'id_order'=>$data->id_order, 'type'=>'service'])->first();
                    if(empty($checkOrderDetail)){
                        $checkOrderDetail = $modelOrderDetails->newEmptyEntity();
                        $checkOrderDetail->type = 'service';
                        $checkOrderDetail->id_order = $data->id_order;
                        $checkOrderDetail->id_order = $data->id_order;
                        $checkOrderDetail->id_product = (int)$value;
                        $checkOrderDetail->number_uses +=1;
                        $checkOrderDetail->id_member = $user->id_member;
                    }
                    $checkOrderDetail->price = (int)$dataSend['price'][$key];
                    $checkOrderDetail->quantity = (int)$dataSend['quantityService'][$key];
                    $modelOrderDetails->save($checkOrderDetail);
                

                    $UserService = $modelUserserviceHistories->find()->where(['id_services'=>(int)$value,'id_order'=>$data->id_order, 'status'=>1])->first();
                    if(empty($UserService)){
                        $UserService = $modelUserserviceHistories->newEmptyEntity();
                        $UserService->id_member = $user->id_member;
                        $UserService->id_order_details = $checkOrderDetail->id;
                        $UserService->id_order =  $data->id_order;
                        $UserService->id_staff = $dataSend['id_staff'];
                        $UserService->id_spa =$session->read('id_spa');
                        $UserService->id_services =(int)$value;
                        $UserService->created_at =time();
                        $UserService->note =@$data['note'];
                        $UserService->id_bed = $datebed->id;
                        $UserService->id_customer = $datebed->id_customer;
                        $UserService->status = 1;

                        $modelUserserviceHistories->save($UserService);

                        $money = 0;
                        $checkService = $modelService->find()->where(array('id'=>$UserService->id_services))->first();
                             
                        if(!empty($checkService)){
                            if(!empty($checkService->commission_staff_fix)){
                                $money += $checkService->commission_staff_fix;
                            }elseif(!empty($checkService->commission_staff_percent)){
                                $money += ((int)$checkService->commission_staff_percent / 100)*$checkService->price;
                            }
                        }

                        if($money>0){
                            $agency = $modelAgency->newEmptyEntity();

                            $agency->id_member = @$user->id_member;
                            $agency->id_spa = $session->read('id_spa');
                            $agency->id_staff = $UserService->id_staff;
                            $agency->id_service = $UserService->id_services;
                            $agency->id_user_service =  @$UserService->id;
                            $agency->money = $money;
                            $agency->created_at =time();
                            $agency->note = 'lần thứ '.@$OrderDetails->number_uses;
                            $agency->id_order_detail = $UserService->id_order_details;
                            $agency->status = 0;
                            $agency->id_order = $data->id_order;
                            $agency->type = 'thực hiện';

                            $modelAgency->save($agency);
                        }

                    }
                    $id_user_service[]= $UserService->id;
                }

            }
            $datebed->id_userservice = implode(',', $id_user_service);

           
            $order->total_pay = (int)$dataSend['total'];
            $modelBed->save($datebed);
            $modelOrder->save($order);
             return $controller->redirect('/checkoutBed?idBed='.$_GET['idBed']);
        }

        if(@$_GET['mess']=='done'){
            $mess = '<p class="text-success">Cập nhập thành công</p>';
        }
        $conditionsStaff['OR'] = [ 
                                    ['id'=>$user->id_member],
                                    ['id_member'=>$user->id_member],
                                ];
        $dataMember = $modelMember->find()->where($conditionsStaff)->all()->toList();

        $order = array('name'=>'asc');
        $conditionsCategorieService = array('type' => 'category_service', 'id_member'=>$user->id_member);
        $CategoryService = $modelCategories->find()->where($conditionsCategorieService)->order($order)->all()->toList();

        if(!empty($CategoryService)){
            foreach ($CategoryService as $key => $Service) {
                $CategoryService[$key]->service = $modelService->find()->where(array('id_category'=>$Service->id, 'id_spa'=>(int) $session->read('id_spa')))->order($order)->all()->toList();
            }
        }

        setVariable('data', $data);
        setVariable('mess', @$mess);
        setVariable('dataMember',$dataMember);
        setVariable('modelUserserviceHistories', @$modelUserserviceHistories);
        setVariable('CategoryService', @$CategoryService);

    }else{
        return $controller->redirect('/');
    }
}

?>