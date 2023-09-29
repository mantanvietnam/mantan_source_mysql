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

        $user = $session->read('infoUser');

        $mess = '';

        if(!empty($_GET['idBed'])){
            $data = $modelOrder->find()->where(array('id_bed'=>$_GET['idBed'], 'status'=>2))->first();

            $data->bed = $modelBed->get($data->id_bed);
          

            $product = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'product'))->all()->toList();
            $service = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'service'))->all()->toList();
            $combo = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'combo'))->all()->toList();

            if(!empty($product)){
                foreach($product as $k => $value){
                    $product[$k]->product = $modelProduct->find()->where(array('id'=>$value->id_product))->first();
                }
                $data->product = $product;
            }

            if(!empty($combo)){
                foreach($combo as $k => $value){
                    $combo[$k]->combo = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
                }
                $data->combo = $combo;
            }

            if(!empty($service)){
                foreach($service as $k => $value){
                    $service[$k]->service = $modelService->find()->where(array('id'=>$value->id_product))->first();
                }
                $data->service = $service;
            }


            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
            }

        }

        if(@$_GET['mess']=='done'){
            $mess = '<p class="text-success">Cập nhập thành công</p>';
        }
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            $order = $modelOrder->find()->where(array('id'=>$data->id))->first();

            $order->total = $dataSend['total'];
            $order->promotion = $dataSend['promotion'];
            $order->total_pay = $dataSend['totalPays'];
            $order->updated_at =date('Y-m-d H:i:s');

            $modelOrder->save($order);

            $modelOrderDetails->deleteAll(array('id_order'=>$order->id));
            if(!empty($dataSend['id_product'])){
                foreach($dataSend['id_product'] as $key => $value){
                    if((int)$dataSend['quantity_product'][$key] >0){
                        $detail = $modelOrderDetails->newEmptyEntity();

                        $detail->id_member = $user->id_member;
                        $detail->id_order = $order->id;
                        $detail->id_product = $value;
                        $detail->price = (int) $dataSend['price_product'][$key];
                        $detail->quantity = (int) $dataSend['quantity_product'][$key];
                        $detail->type = 'product';

                        $modelOrderDetails->save($detail);
                    }
                }
            }

            if(!empty($dataSend['id_service'])){
                foreach($dataSend['id_service'] as $key => $value){
                    if((int)$dataSend['quantity_service'][$key] >0){
                        $detail = $modelOrderDetails->newEmptyEntity();

                        $detail->id_member = $user->id_member;
                        $detail->id_order = $order->id;
                        $detail->id_product = $value;
                        $detail->price = (int) $dataSend['price_service'][$key];
                        $detail->quantity = (int) $dataSend['quantity_service'][$key];
                        $detail->type = 'service';

                        $modelOrderDetails->save($detail);
                    }
                }
            }

            if(!empty($dataSend['id_combo'])){
                foreach($dataSend['id_combo'] as $key => $value){
                    if((int)$dataSend['quantity_combo'][$key] >0){
                        $detail = $modelOrderDetails->newEmptyEntity();

                        $detail->id_member = $user->id_member;
                        $detail->id_order = $order->id;
                        $detail->id_product = $value;
                        $detail->price = (int) $dataSend['price_combo'][$key];
                        $detail->quantity = (int) $dataSend['quantity_combo'][$key];
                        $detail->type = 'combo';

                        $modelOrderDetails->save($detail);
                    }
                }
            }

            return $controller->redirect('/infoRoomBed?mess=done&idBed='.$_GET['idBed']);
            
        }

        setVariable('data', $data);
        setVariable('mess', @$mess);

    }else{
        return $controller->redirect('/login');
    }
}


function cancelBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
    
    if(!empty($session->read('infoUser'))){
        $modelBed = $controller->loadModel('Beds');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');

        
        $user = $session->read('infoUser');
         $return = array('code'=>0);
       if($isRequestPost){
            $dataSend = $input['request']->getData();

            $data = $modelOrder->find()->where(array('id_bed'=>$dataSend['idBed'], 'status'=>2))->first();

            $data->status = 3;
            $data->note = @$data->note.', Nội dung hủy là: '.@$dataSend['note'];
            $modelOrder->save($data);

            $datebed = $modelBed->get($data->id_bed);
            $datebed->status = 1;
            $modelBed->save($datebed);

            $return = array('code'=>1);
        }

       return $return;
    }else{
        return $controller->redirect('/login');
    }
}

function checkoutBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin giường';
    
    if(!empty($session->read('infoUser'))){
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
        $modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');
        $modelPrepayCard = $controller->loadModel('PrepayCards');

        $user = $session->read('infoUser');

        $mess = '';

        if(!empty($_GET['idBed'])){
            $data = $modelOrder->find()->where(array('id_bed'=>$_GET['idBed'], 'status'=>2))->first();

            $data->bed = $modelBed->get($data->id_bed);
          

            $product = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'product'))->all()->toList();
            $service = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'service'))->all()->toList();
            $combo = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'combo'))->all()->toList();

            if(!empty($product)){
                foreach($product as $k => $value){
                    $product[$k]->product = $modelProduct->find()->where(array('id'=>$value->id_product))->first();
                }
                $data->product = $product;
            }

            if(!empty($combo)){
                foreach($combo as $k => $value){
                    $combo[$k]->combo = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
                }
                $data->combo = $combo;
            }

            if(!empty($service)){
                foreach($service as $k => $value){
                    $service[$k]->service = $modelService->find()->where(array('id'=>$value->id_product))->first();
                }
                $data->service = $service;
            }

            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
                $conditionPrepaycard = array('id_member'=>$user->id_member, 'total >' => 0);

                $conditionPrepaycard['id_customer'] = $data->id_customer;
                $conditionPrepaycard['total >='] = $data->total_pay;
                   
                $Prepaycard = $modelCustomerPrepaycard->find()->where($conditionPrepaycard)->all()->toList();

                if(!empty($Prepaycard)){
                    foreach($Prepaycard as $key => $item){

                        $item->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$item->id_prepaycard))->first();
                        $Prepaycard[$key] = $item;
                        
                    }
                }
            }

        }

        if(@$_GET['mess']=='done'){
            $mess = '<p class="text-success">Cập nhập thành công</p>';
        }
      
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            if($dataSend['type_collection_bill']=='cong_no'){
                $debt =$modelDebts->newEmptyEntity();
                     
                // tạo dữ liệu save
                $debt->id_member = @$infoUser->id_member;
                $debt->id_spa = $session->read('id_spa');
                $debt->id_staff = $data->id_staff;
                $debt->total =  $data->total_pay;
                $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
                $debt->type = 0; //0: Thu, 1: chi
                $debt->created_at = date('Y-m-d H:i:s');
                $debt->updated_at = date('Y-m-d H:i:s');
                $debt->id_order = $data->id;
                $debt->id_customer = (int)@$data->id_customer;
                $debt->full_name = @$data->full_name;
                $debt->time = time();
                           
               $modelDebts->save($debt);
            }else{
                $bill = $modelBill->newEmptyEntity();
                $bill->created_at = date('Y-m-d H:i:s');
                $bill->id_member = @$user->id_member;
                $bill->id_spa = $session->read('id_spa');
                $bill->id_staff = $data->id_staff;
                $bill->total = $data->total_pay;
                $bill->note = 'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
                $bill->type = 0; //0: Thu, 1: chi
                $bill->id_order = $data->id;
                $bill->created_at = date('Y-m-d H:i:s');
                $bill->updated_at = date('Y-m-d H:i:s');
                $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                $bill->id_customer = (int)@$data->id_customer;
                $bill->full_name = @$data->full_name;
                if(empty($dataSend['card'])){
                        $bill->type_card = 0;
                    }else{
                        $bill->type_card = 1;
                    }

                if(!empty($dataSend['card'])){
                    $Prepaycards = $modelCustomerPrepaycard->get($dataSend['card']);
                    $Prepaycards->total -= $bill->total;
                    $modelCustomerPrepaycard->save($Prepaycards);
                }

                $bill->time = time();
               
                $modelBill->save($bill);
            }

                // trừ số lượng trong kho 
            if(!empty($data->id_warehouse)){
                if(!empty($data->product)){
                    foreach($data->product as $key => $value){

                        $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value->id_product, 'inventory_quantity >='=>$value->quantity,'id_warehouse'=>$data->id_warehouse ))->first();
 
                        $WarehouseProductDetail->inventory_quantity -= $value->quantity;

                        $modelWarehouseProductDetails->save($WarehouseProductDetail);

                        $product = $modelProduct->get($value->id_product);
                        $product->quantity -= $value->quantity;
                        $modelProduct->save($product);

                    }
                }
                if(!empty($data->combo)){
                    foreach($data->combo as $key => $value){
                                // sử lý trử số lương trong kho ở sản phẩm trong combo
                        $combo = $modelCombo->get($value->id_product);
                        if(!empty($combo->product)){
                            $combo_product = json_decode($combo->product);
                            foreach($combo_product as $idProduct => $quantityPro){
                                $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$value->quantity,'id_warehouse'=>$data->id_warehouse ))->first();

                                $WarehouseProductDetail->inventory_quantity -= $quantityPro*$value->quantity;

                                $modelWarehouseProductDetails->save($WarehouseProductDetail);

                                $product = $modelProduct->get($idProduct);
                                $product->quantity -= $quantityPro*$value->quantity;
                                $modelProduct->save($product);

                            }
                        }
                        $value->number_uses +=1;
                        $modelOrderDetails->save($value);
                    }

                }
                if(!empty($data->service)){
                    foreach($data->service as $key => $value){
                        // sử lý trử số lương trong kho ở sản phẩm trong combo
                        $value->number_uses +=1;
                        $modelOrderDetails->save($value);
                    }

                }
            }
            $order = $modelOrder->find()->where(array('id'=>$data->id))->first();

            $order->status = 1;
            $order->check_out = time();
            $modelOrder->save($order);

            $datebed = $modelBed->get($data->id_bed);
            $datebed->status = 1;
            $modelBed->save($datebed);

            return $controller->redirect('/printInfoOrder?id='.$order->id);
        }

        setVariable('data', $data);
        setVariable('mess', @$mess);
        setVariable('Prepaycard', @$Prepaycard);

    }else{
        return $controller->redirect('/login');
    }
}

 ?>
