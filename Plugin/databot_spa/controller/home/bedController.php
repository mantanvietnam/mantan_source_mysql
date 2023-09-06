<?php 
function listBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách giường';
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');

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
        return $controller->redirect('/login');
    }
}

function deleteBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa giường';
    
    if(!empty($session->read('infoUser'))){
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
        return $controller->redirect('/login');
    }
}

function listRoomBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh Phòng';
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelOrder = $controller->loadModel('Orders');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
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
                    $databed[$k]->order = $modelOrder->find()->where(array('id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'),'id_bed'=>$value->id,'status'=>2))->first();
                    $conditionsOrder = array('id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'),'id_bed'=>$value->id,'status'=>0);
                    $conditionsOrder['time >='] = $startOfDayTimestamp;
                    $conditionsOrder['time <='] = $endOfDayTimestamp;

                    $order = $modelOrder->find()->where($conditionsOrder)->all()->toList();

                    if(!empty(@$order)){


                        $databed[$k]->status = 3;
                    }
                }

                $listData[$key]->bed = $databed;

            }
        }
        
        setVariable('listData', $listData);

    }else{
        return $controller->redirect('/login');
    }
}

function infoRoomBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
    
    if(!empty($session->read('infoUser'))){
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

        if(!empty($_GET['idBed'])){
            $data = $modelOrder->find()->where(array('id_bed'=>$_GET['idBed'], 'status'=>2))->first();

            $data->bed = $modelBed->get($data->id_bed);
          

            $product = $modelOrderDetails->find()->where(array('id_order'=>$data->id))->all()->toList();

            if(!empty($product)){

                foreach($product as $k => $value){
                    if($value->type=='product'){
                        $product[$k]->prod = $modelProduct->find()->where(array('id'=>$value->id_product))->first();
                    }elseif($value->type=='service') {
                        $product[$k]->prod = $modelService->find()->where(array('id'=>$value->id_product))->first();
                    }elseif($value->type=='combo'){
                        $product[$k]->prod = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
                    }

                }
                $data->product = $product;
            }
            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
            }

        }

        setVariable('data', $data);

    }else{
        return $controller->redirect('/login');
    }
}



 ?>
