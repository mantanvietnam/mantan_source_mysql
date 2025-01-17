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
            $data->created_at = date('Y-m-d H:i:s');

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
                    $Userservice = $modelUserserviceHistories->find()->where(array('id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'),'id_bed'=>$value->id,'status'=>1))->first();
                    if(!empty($Userservice)){
                    $Userservice->customer = $modelCustomer->find()->where(array('id'=>$Userservice->id_customer))->first();
                        }
                    $databed[$k]->Userservice = $Userservice;

                    $conditionsOrder = array('id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'),'id_bed'=>$value->id,'status'=>0);
                    $conditionsOrder['time >='] = $startOfDayTimestamp;
                    $conditionsOrder['time <='] = $endOfDayTimestamp;

                    $order = $modelOrder->find()->where($conditionsOrder)->all()->toList();

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
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

        $user = $session->read('infoUser');

        $mess = '';

        if(!empty($_GET['idBed'])){
            $data = $modelUserserviceHistories->find()->where(array('id_bed'=>$_GET['idBed'], 'status'=>1))->first();

            $data->bed = $modelBed->get($data->id_bed);
          
            
            $data->service = $modelService->find()->where(array('id'=>$data->id_services))->first();
              

            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
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
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');
        
        $user = $session->read('infoUser');
         $return = array('code'=>0);
       if($isRequestPost){
            $dataSend = $input['request']->getData();

            $data = $modelUserserviceHistories->find()->where(array('id_bed'=>$dataSend['idBed'], 'status'=>1))->first();
            
            $data->status = 3;
            // /$data->note = @$data->note.', Nội dung hủy là: '.@$dataSend['note'];
            $modelUserserviceHistories->save($data);

            $datebed = $modelBed->get($dataSend['idBed']);
            $datebed->status = 1;
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
        $modelMembers = $controller->loadModel('Members');
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
            $data = $modelUserserviceHistories->find()->where(array('id_bed'=>$_GET['idBed'], 'status'=>1))->first();
          /*  debug($data);
        die();*/
            if(!empty($data->id_bed)){
                $data->bed = $modelBed->get($data->id_bed);
            }else{
                return $controller->redirect('/listRoomBed');
            }
          
            
            $data->service = $modelService->find()->where(array('id'=>$data->id_services))->first();

            if(empty($data->id_order)){
                $data->id_order = $modelOrderDetails->find()->where(['id'=>$data->id_order_details])->first()->id_order;    
            }
              
            $data->order = $modelOrder->find()->where(array('id'=>$data->id_order))->first();
            if(!empty($data->id_customer)){
                $customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();

                $conditioncard['id_customer'] = $data->id_customer;
                    $conditioncard['total >='] = $data->order->total_pay;
                                 
                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
                    if(!empty($card)){
                        foreach($card as $k => $value){

                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
                            $card[$k] = $value;
                            
                        }

                       $customer->card = $card;
                    }

                    $data->customer = $customer;
            }

        }

        if(@$_GET['mess']=='done'){
            $mess = '<p class="text-success">Cập nhập thành công</p>';
        }
      
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            $data->note =@$dataSend['note'];
            $data->status = 2;

            $modelUserserviceHistories->save($data);
           
            $datebed = $modelBed->get($data->id_bed);
            $datebed->status = 1;
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

?>