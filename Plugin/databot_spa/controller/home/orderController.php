<?php 
function orderProduct($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';

    if(!empty(checkLoginManager('orderProduct', 'product'))){
      $infoUser = $session->read('infoUser');

      $modelCombo = $controller->loadModel('Combos');
      $modelProduct = $controller->loadModel('Products');
      $modelWarehouses = $controller->loadModel('Warehouses');
      $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
      $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
      $modelService = $controller->loadModel('Services');
      $modelRoom = $controller->loadModel('Rooms');
      $modelBed = $controller->loadModel('Beds');
      $modelDebts = $controller->loadModel('Debts');
      $modelMembers = $controller->loadModel('Members');
      $modelOrder = $controller->loadModel('Orders');
      $modelOrderDetails = $controller->loadModel('OrderDetails');
      $modelBill = $controller->loadModel('Bills');
      $modelAgency = $controller->loadModel('Agencys');
      $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');

      $conditionsService = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
      $listService = $modelService->find()->where($conditionsService)->all()->toList();

      $conditionsProduct = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
      $listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

      if(empty($listProduct)){
        return $controller->redirect('/listProduct/?error=requestProduct');
    }

    $conditionsCombo = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
    $listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();

    $listWarehouse = $modelWarehouses->find()->where($conditionsCombo)->all()->toList();
    $today= getdate();
    $conditionsStaff['OR'] = [ 
       ['id'=>$infoUser->id_member],
       ['id_member'=>$infoUser->id_member],
   ];

   $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

   $conditionsRoom = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
   
   $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
   
   if(!empty($listRoom)){
    foreach($listRoom as $key => $item){
        $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
    }
}
$mess = '';
if(@$_GET['mess']=='kho'){
    $mess  = '<p class="text-danger">Sản phẩm trong kho không đủ</p>';
}

        // sử lý đơn hàng
if($isRequestPost){
 $dataSend = $input['request']->getData();

 foreach($dataSend['idHangHoa'] as $key => $value){
                        // sản phẩm 
    if($dataSend['type'][$key] == 'product'){
       $WarehouseProduct =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value, 'inventory_quantity >='=>$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

       if(empty($WarehouseProduct)){
           return $controller->redirect('/orderProduct?mess=kho');
       }
   }
}

			// tạo đơn hàng 
$order = $modelOrder->newEmptyEntity();
$order->id_member = $infoUser->id_member;
$order->id_spa =$infoUser->id_spa;
$order->id_staff =@$dataSend['id_Staff'];
$order->id_customer =@$dataSend['id_customer'];
$order->full_name = @$dataSend['full_name'];
$order->id_bed =@$dataSend['id_bed'];
$order->note =@$dataSend['note'];
$order->created_at =date('Y-m-d H:i:s');
$order->updated_at =date('Y-m-d H:i:s');
if($dataSend['typeOrder']==1){
    $order->status =1;
}else{
   $order->status =0;
}
$order->promotion =@$dataSend['promotion'];
$order->total =@$dataSend['total'];
$order->total_pay =@$dataSend['totalPays'];
$order->type_order =@$dataSend['typeOrder'];
$order->type ='product';

if(!empty($dataSend['time'])){   

   $time = explode(' ', $dataSend['time']);
   $date = explode('/', $time[0]);
   $hour = explode(':', $time[1]);
   $order->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
}else{
   $order->time = time();
}

$modelOrder->save($order);
            // tạo chi tiêt dơn hàng 
$money = 0;
foreach($dataSend['idHangHoa'] as $key => $value){
    $detail = $modelOrderDetails->newEmptyEntity();

    $detail->id_member = $infoUser->id_member;
    $detail->id_order = $order->id;
    $detail->id_product = $value;
    $detail->price = (int) $dataSend['money'][$key];
    $detail->quantity = (int) $dataSend['soluong'][$key];
    $detail->type = $dataSend['type'][$key];

    $modelOrderDetails->save($detail);

    $checkProduct = $modelProduct->find()->where(array('id'=>$value))->first();
    
    if(!empty($checkProduct)){
        if(!empty($checkProduct->commission_affiliate_fix)){
            $money += $checkProduct->commission_affiliate_fix*$detail->quantity;
        }elseif(!empty($checkProduct->commission_affiliate_percent)){
            $money += (((int)$checkProduct->commission_affiliate_percent / 100)*$detail->price)*(int)$detail->quantity;
        }
    }
}

if($money>0){
    $agency = $modelAgency->newEmptyEntity();

    $agency->id_member = @$infoUser->id_member;
    $agency->id_spa = $session->read('id_spa');
    $agency->id_staff = $infoUser->id;
    $agency->id_service = 0;
    $agency->money = $money;
    $agency->created_at = date('Y-m-d H:i:s');
    $agency->note = '';
    $agency->id_order_detail = 0;
    $agency->status = 0;
    $agency->id_order = $order->id;
    $agency->type = 'sale';

    $modelAgency->save($agency);
}



            //sử lý phần thanh toán 
if($dataSend['typeOrder']==1){

    if($dataSend['type_collection_bill']=='cong_no'){
        $debt =$modelDebts->newEmptyEntity();
        
                    // tạo dữ liệu save
        $debt->id_member = @$infoUser->id_member;
        $debt->id_spa = $session->read('id_spa');
        $debt->id_staff = $data->id_staff;
        $debt->total =  $data->total_pay;
        $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
                    $debt->type = 0; //0: Thu, 1: chi
                    $debt->created_at = date('Y-m-d H:i:s');
                    $debt->updated_at = date('Y-m-d H:i:s');
                    $debt->id_order = $order->id;
                    $debt->id_customer = (int)@$dataSend['id_customer'];
                    $debt->full_name = @$dataSend['full_name'];
                    $debt->time = time();
                    
                    $modelDebts->save($debt);
                }else{
                    // lưu bill
                    $bill = $modelBill->newEmptyEntity();
                    $bill->id_member = @$infoUser->id_member;
                    $bill->id_spa = $session->read('id_spa');
                    $bill->id_staff = (int)@$dataSend['id_staff'];
                    $bill->total = (int)@$dataSend['totalPays'];
                    $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
                    $bill->type = 0; //0: Thu, 1: chi
                    $bill->id_order = $order->id;
                    $bill->created_at = date('Y-m-d H:i:s');
                    $bill->updated_at = date('Y-m-d H:i:s');
                    $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                    $bill->id_customer = (int)@$dataSend['id_customer'];
                    $bill->full_name = @$dataSend['full_name'];
                    if(empty($dataSend['card'])){
                        $bill->type_card = 0;
                    }else{
                        $bill->type_card = 1;
                    }
                    
                    $bill->moneyCustomerPay = @$dataSend['moneyCustomerPay'];

                    if(!empty($dataSend['time'])){
                        $time = explode(' ', $dataSend['time']);
                        $date = explode('/', $time[0]);
                        $hour = explode(':', $time[1]);
                        $bill->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
                    }else{
                        $bill->time = time();
                    }
                    
                    $modelBill->save($bill);

                    if(!empty($dataSend['card'])){
                        $Prepaycards = $modelCustomerPrepaycards->get($dataSend['card']);
                        $Prepaycards->total -= $bill->total;
                        $modelCustomerPrepaycards->save($Prepaycards);
                    }

                }
                

                // trừ số lượng trong kho 
                if(!empty($dataSend['id_warehouse'])){
                    foreach($dataSend['idHangHoa'] as $key => $value){
                        // sản phẩm 
                        if($dataSend['type'][$key] == 'product'){

                            $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value, 'inventory_quantity >='=>$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

                            $WarehouseProductDetail->inventory_quantity -= $dataSend['soluong'][$key];

                            $modelWarehouseProductDetails->save($WarehouseProductDetail);

                            $product = $modelProduct->get($value);
                            $product->quantity -= $dataSend['soluong'][$key];
                            $modelProduct->save($product);


                        }elseif($dataSend['type'][$key] == 'combo'){
                            // sử lý trử số lương trong kho ở sản phẩm trong combo
                            $combo = $modelCombo->get($value);
                            if(!empty($combo->product)){
                                $combo_product = json_decode($combo->product);
                                foreach($combo_product as $idProduct => $quantityPro){
                                    $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

                                    $WarehouseProductDetail->inventory_quantity -= $quantityPro*$dataSend['soluong'][$key];

                                    $modelWarehouseProductDetails->save($WarehouseProductDetail);

                                    $product = $modelProduct->get($idProduct);
                                    $product->quantity -= $quantityPro*$dataSend['soluong'][$key];
                                    $modelProduct->save($product);

                                }
                            }
                        }

                    }
                }

                return $controller->redirect('/printInfoOrder?id='.$order->id);
            }elseif($dataSend['typeOrder']==3){
               $Order = $modelOrder->find()->where(array('id_bed'=>$dataSend['id_bed'], 'status'=>2))->first();
               $bed = $modelBed->find()->where(array('id'=>$dataSend['id_bed'], 'status'=>2))->first();
               if(empty($Order) && empty($bed)){
                $dataOrder = $modelOrder->get($order->id);

                $dataOrder->check_in = time();
                $dataOrder->status = 2;

                $modelOrder->save($dataOrder);

                $dataBed = $modelBed->get($dataOrder->id_bed);
                $dataBed->status = 2;

                $modelBed->save($dataBed);

                return $controller->redirect('/listRoomBed');
            }else{
                return $controller->redirect('/listOrder?mess=conkhach');
            }
        }else{
           return $controller->redirect('/order?mess=1');
           
       }
       
   }

   setVariable('listService', $listService);
   setVariable('listProduct', $listProduct);
   setVariable('listCombo', $listCombo);
   setVariable('today', $today);
   setVariable('listRoom', $listRoom);
   setVariable('listStaffs', $listStaffs);
   setVariable('listWarehouse', $listWarehouse);
   setVariable('user', $infoUser);
   setVariable('mess', $mess);

}else{
  return $controller->redirect('/orderProduct');
}
}

function orderCombo($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';

    if(!empty(checkLoginManager('orderCombo', 'combo'))){
        $infoUser = $session->read('infoUser');

        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelDebts = $controller->loadModel('Debts');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelBill = $controller->loadModel('Bills');
        $modelAgency = $controller->loadModel('Agencys');
        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');

        $conditionsService = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
        $listService = $modelService->find()->where($conditionsService)->all()->toList();

        $conditionsProduct = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
        $listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

        $conditionsCombo = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
        $listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();


        if(empty($listCombo)){
            return $controller->redirect('/listCombo/?error=requestProduct');
        }

        $listWarehouse = $modelWarehouses->find()->where($conditionsCombo)->all()->toList();
        $today= getdate();
        $conditionsStaff['OR'] = [ 
            ['id'=>$infoUser->id_member],
            ['id_member'=>$infoUser->id_member],
        ];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        $conditionsRoom = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }

        $mess = '';
        if(@$_GET['mess']=='kho'){
            $mess  = '<p class="text-danger">Sản phẩm trong kho không đủ</p>';
        }

        // sử lý đơn hàng
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            foreach($dataSend['idHangHoa'] as $key => $value){
                        // sản phẩm 
                if($dataSend['type'][$key] == 'combo'){
                            // sử lý trử số lương trong kho ở sản phẩm trong combo
                    $combo = $modelCombo->get($value);
                    if(!empty($combo->product)){
                        $combo_product = json_decode($combo->product);
                        foreach($combo_product as $idProduct => $quantityPro){
                            $WarehouseProduct =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();
                            if(empty($WarehouseProduct)){
                                return $controller->redirect('/orderCombo?mess=kho');
                            }
                        }
                    }
                }
            }
            
            // tạo đơn hàng 
            $order = $modelOrder->newEmptyEntity();
            $order->id_member = $infoUser->id_member;
            $order->id_spa =$infoUser->id_spa;
            $order->id_staff =@$dataSend['id_Staff'];
            $order->id_customer =@$dataSend['id_customer'];
            $order->full_name = @$dataSend['full_name'];
            $order->id_bed =@$dataSend['id_bed'];
            $order->note =@$dataSend['note'];
            $order->created_at =date('Y-m-d H:i:s');
            $order->updated_at =date('Y-m-d H:i:s');
            if($dataSend['typeOrder']==1){
               $order->status =1;
           }else{
               $order->status =0;
           }
           $order->promotion =@$dataSend['promotion'];
           $order->total =@$dataSend['total'];
           $order->total_pay =@$dataSend['totalPays'];
           $order->type_order =@$dataSend['typeOrder'];
           $order->type ='combo';

           if(!empty($dataSend['time'])){   

            $time = explode(' ', $dataSend['time']);
            $date = explode('/', $time[0]);
            $hour = explode(':', $time[1]);
            $order->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
        }else{
            $order->time = time();
        }

        $modelOrder->save($order);
            // tạo chi tiêt dơn hàng 
        $money = 0;
        foreach($dataSend['idHangHoa'] as $key => $value){
            $detail = $modelOrderDetails->newEmptyEntity();

            $detail->id_member = $infoUser->id_member;
            $detail->id_order = $order->id;
            $detail->id_product = $value;
            $detail->price = (int) $dataSend['money'][$key];
            $detail->quantity = (int) $dataSend['soluong'][$key];
            $detail->type = $dataSend['type'][$key];

            $modelOrderDetails->save($detail);

            $checkCombo = $modelCombo->find()->where(array('id'=>$value))->first();
            
            if(!empty($checkCombo)){
                if(!empty($checkCombo->commission_staff_fix)){
                    $money += $checkCombo->commission_staff_fix*$detail->quantity;
                }elseif(!empty($checkCombo->commission_staff_percent)){
                    $money += (((int)$checkCombo->commission_staff_percent / 100)*$detail->price)*(int)$detail->quantity;
                }
            }
        }

        if($money>0){
            $agency = $modelAgency->newEmptyEntity();

            $agency->id_member = @$infoUser->id_member;
            $agency->id_spa = $session->read('id_spa');
            $agency->id_staff = $infoUser->id;
            $agency->id_service = 0;
            $agency->money = $money;
            $agency->created_at = date('Y-m-d H:i:s');
            $agency->note = '';
            $agency->id_order_detail = 0;
            $agency->status = 0;
            $agency->id_order = $order->id;
            $agency->type = 'sale';

            $modelAgency->save($agency);
        }


            //sử lý phần thanh toán 
        if($dataSend['typeOrder']==1){

            if($dataSend['type_collection_bill']=='cong_no'){
                $debt =$modelDebts->newEmptyEntity();
                
                    // tạo dữ liệu save
                $debt->id_member = @$infoUser->id_member;
                $debt->id_spa = $session->read('id_spa');
                $debt->id_staff = $data->id_staff;
                $debt->total =  $data->total_pay;
                $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
                    $debt->type = 0; //0: Thu, 1: chi
                    $debt->created_at = date('Y-m-d H:i:s');
                    $debt->updated_at = date('Y-m-d H:i:s');
                    $debt->id_order = $order->id;
                    $debt->id_customer = (int)@$dataSend['id_customer'];
                    $debt->full_name = @$dataSend['full_name'];
                    $debt->time = time();
                    
                    $modelDebts->save($debt);
                }else{
                    // lưu bill
                    $bill = $modelBill->newEmptyEntity();
                    $bill->id_member = @$infoUser->id_member;
                    $bill->id_spa = $session->read('id_spa');
                    $bill->id_staff = (int)@$dataSend['id_staff'];
                    $bill->total = (int)@$dataSend['totalPays'];
                    $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
                    $bill->type = 0; //0: Thu, 1: chi
                    $bill->id_order = $order->id;
                    $bill->created_at = date('Y-m-d H:i:s');
                    $bill->updated_at = date('Y-m-d H:i:s');
                    $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                    $bill->id_customer = (int)@$dataSend['id_customer'];
                    $bill->full_name = @$dataSend['full_name'];
                    if(empty($dataSend['card'])){
                        $bill->type_card = 0;
                    }else{
                        $bill->type_card = 1;
                    }
                    
                    $bill->moneyCustomerPay = @$dataSend['moneyCustomerPay'];

                    if(!empty($dataSend['time'])){
                        $time = explode(' ', $dataSend['time']);
                        $date = explode('/', $time[0]);
                        $hour = explode(':', $time[1]);
                        $bill->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
                    }else{
                        $bill->time = time();
                    }
                    
                    $modelBill->save($bill);

                    if(!empty($dataSend['card'])){
                        $Prepaycards = $modelCustomerPrepaycards->get($dataSend['card']);
                        $Prepaycards->total -= $bill->total;
                        $modelCustomerPrepaycards->save($Prepaycards);
                    }

                }
                

                // trừ số lượng trong kho 
                if(!empty($dataSend['id_warehouse'])){
                    foreach($dataSend['idHangHoa'] as $key => $value){
                        // sản phẩm 
                        if($dataSend['type'][$key] == 'product'){

                            $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value, 'inventory_quantity >='=>$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

                            $WarehouseProductDetail->inventory_quantity -= $dataSend['soluong'][$key];

                            $modelWarehouseProductDetails->save($WarehouseProductDetail);

                            $product = $modelProduct->get($value);
                            $product->quantity -= $dataSend['soluong'][$key];
                            $modelProduct->save($product);


                        }elseif($dataSend['type'][$key] == 'combo'){
                            // sử lý trử số lương trong kho ở sản phẩm trong combo
                            $combo = $modelCombo->get($value);
                            if(!empty($combo->product)){
                                $combo_product = json_decode($combo->product);
                                foreach($combo_product as $idProduct => $quantityPro){
                                    $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

                                    $WarehouseProductDetail->inventory_quantity -= $quantityPro*$dataSend['soluong'][$key];

                                    $modelWarehouseProductDetails->save($WarehouseProductDetail);

                                    $product = $modelProduct->get($idProduct);
                                    $product->quantity -= $quantityPro*$dataSend['soluong'][$key];
                                    $modelProduct->save($product);

                                }
                            }
                        }

                    }
                }

                return $controller->redirect('/printInfoOrder?id='.$order->id);
            }elseif($dataSend['typeOrder']==3){
               $Order = $modelOrder->find()->where(array('id_bed'=>$dataSend['id_bed'], 'status'=>2))->first();
               $bed = $modelBed->find()->where(array('id'=>$dataSend['id_bed'], 'status'=>2))->first();
               if(empty($Order) && empty($bed)){
                $dataOrder = $modelOrder->get($order->id);

                $dataOrder->check_in = time();
                $dataOrder->status = 2;

                $modelOrder->save($dataOrder);

                $dataBed = $modelBed->get($dataOrder->id_bed);
                $dataBed->status = 2;

                $modelBed->save($dataBed);

                return $controller->redirect('/listRoomBed');
            }else{
                return $controller->redirect('/listOrder?mess=conkhach');
            }
        }else{
            return $controller->redirect('/order?mess=1');
            
        }
        
    }

    setVariable('listService', $listService);
    setVariable('listProduct', $listProduct);
    setVariable('listCombo', $listCombo);
    setVariable('today', $today);
    setVariable('listRoom', $listRoom);
    setVariable('listStaffs', $listStaffs);
    setVariable('listWarehouse', $listWarehouse);
    setVariable('user', $infoUser);
    setVariable('mess', $mess);

}else{
    return $controller->redirect('/');
}
}

function orderService($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';

    if(!empty(checkLoginManager('orderService', 'product'))){
        $infoUser = $session->read('infoUser');

        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelDebts = $controller->loadModel('Debts');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelBill = $controller->loadModel('Bills');
        $modelAgency = $controller->loadModel('Agencys');
        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');

        $conditionsService = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
        $listService = $modelService->find()->where($conditionsService)->all()->toList();

        if(empty($listService)){
         return $controller->redirect('/listService/?error=requestService');
     }

     $conditionsProduct = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
     $listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

     $conditionsCombo = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
     $listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();

     $listWarehouse = $modelWarehouses->find()->where($conditionsCombo)->all()->toList();
     $today= getdate();
     $conditionsStaff['OR'] = [ 
        ['id'=>$infoUser->id_member],
        ['id_member'=>$infoUser->id_member],
    ];

    $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

    $conditionsRoom = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
    
    $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
    
    if(!empty($listRoom)){
        foreach($listRoom as $key => $item){
            $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
        }
    }

        // sử lý đơn hàng
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
            // tạo đơn hàng 
        $order = $modelOrder->newEmptyEntity();
        $order->id_member = $infoUser->id_member;
        $order->id_spa =$infoUser->id_spa;
        $order->id_staff =@$dataSend['id_Staff'];
        $order->id_customer =@$dataSend['id_customer'];
        $order->full_name = @$dataSend['full_name'];
        $order->id_bed =@$dataSend['id_bed'];
        $order->note =@$dataSend['note'];
        $order->created_at =date('Y-m-d H:i:s');
        $order->updated_at =date('Y-m-d H:i:s');
        if($dataSend['typeOrder']==1){
           $order->status =1;
       }else{
           $order->status =0;
       }
       $order->promotion =@$dataSend['promotion'];
       $order->total =@$dataSend['total'];
       $order->total_pay =@$dataSend['totalPays'];
       $order->type_order =@$dataSend['typeOrder'];
       $order->type ='service';

       if(!empty($dataSend['time'])){   

        $time = explode(' ', $dataSend['time']);
        $date = explode('/', $time[0]);
        $hour = explode(':', $time[1]);
        $order->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
    }else{
        $order->time = time();
    }

    $modelOrder->save($order);
            // tạo chi tiêt dơn hàng 
    $money = 0;
    foreach($dataSend['idHangHoa'] as $key => $value){
        $detail = $modelOrderDetails->newEmptyEntity();

        $detail->id_member = $infoUser->id_member;
        $detail->id_order = $order->id;
        $detail->id_product = $value;
        $detail->price = (int) $dataSend['money'][$key];
        $detail->quantity = (int) $dataSend['soluong'][$key];
        $detail->type = $dataSend['type'][$key];

        $modelOrderDetails->save($detail);

        $checkService = $modelService->find()->where(array('id'=>$value))->first();
        
        if(!empty($checkService)){
            if(!empty($checkService->commission_affiliate_fix)){
                $money += $checkService->commission_affiliate_fix*$detail->quantity;
            }elseif(!empty($checkService->commission_affiliate_percent)){
                $money += (((int)$checkService->commission_affiliate_percent / 100)*$detail->price)*(int)$detail->quantity;
            }
        }
    }

    if($money>0){
        $agency = $modelAgency->newEmptyEntity();

        $agency->id_member = @$infoUser->id_member;
        $agency->id_spa = $session->read('id_spa');
        $agency->id_staff = $infoUser->id;
        $agency->id_service = 0;
        $agency->money = $money;
        $agency->created_at = date('Y-m-d H:i:s');
        $agency->note = '';
        $agency->id_order_detail = 0;
        $agency->status = 0;
        $agency->id_order = $order->id;
        $agency->type = 'sale';

        $modelAgency->save($agency);
    }

            //sử lý phần thanh toán 
    if($dataSend['typeOrder']==1){

        if($dataSend['type_collection_bill']=='cong_no'){
            $debt =$modelDebts->newEmptyEntity();
            
                    // tạo dữ liệu save
            $debt->id_member = @$infoUser->id_member;
            $debt->id_spa = $session->read('id_spa');
            $debt->id_staff = $data->id_staff;
            $debt->total =  $data->total_pay;
            $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
                    $debt->type = 0; //0: Thu, 1: chi
                    $debt->created_at = date('Y-m-d H:i:s');
                    $debt->updated_at = date('Y-m-d H:i:s');
                    $debt->id_order = $order->id;
                    $debt->id_customer = (int)@$dataSend['id_customer'];
                    $debt->full_name = @$dataSend['full_name'];
                    $debt->time = time();
                    
                    $modelDebts->save($debt);
                }else{
                    // lưu bill
                    $bill = $modelBill->newEmptyEntity();
                    $bill->id_member = @$infoUser->id_member;
                    $bill->id_spa = $session->read('id_spa');
                    $bill->id_staff = (int)@$dataSend['id_staff'];
                    $bill->total = (int)@$dataSend['totalPays'];
                    $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
                    $bill->type = 0; //0: Thu, 1: chi
                    $bill->id_order = $order->id;
                    $bill->created_at = date('Y-m-d H:i:s');
                    $bill->updated_at = date('Y-m-d H:i:s');
                    $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                    $bill->id_customer = (int)@$dataSend['id_customer'];
                    $bill->full_name = @$dataSend['full_name'];
                    if(empty($dataSend['card'])){
                        $bill->type_card = 0;
                    }else{
                        $bill->type_card = 1;
                    }
                    
                    $bill->moneyCustomerPay = @$dataSend['moneyCustomerPay'];

                    if(!empty($dataSend['time'])){
                        $time = explode(' ', $dataSend['time']);
                        $date = explode('/', $time[0]);
                        $hour = explode(':', $time[1]);
                        $bill->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
                    }else{
                        $bill->time = time();
                    }
                    
                    $modelBill->save($bill);

                    if(!empty($dataSend['card'])){
                        $Prepaycards = $modelCustomerPrepaycards->get($dataSend['card']);
                        $Prepaycards->total -= $bill->total;
                        $modelCustomerPrepaycards->save($Prepaycards);
                    }

                }
                

                // trừ số lượng trong kho 
                if(!empty($dataSend['id_warehouse'])){
                    foreach($dataSend['idHangHoa'] as $key => $value){
                        // sản phẩm 
                        if($dataSend['type'][$key] == 'product'){

                            $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value, 'inventory_quantity >='=>$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

                            $WarehouseProductDetail->inventory_quantity -= $dataSend['soluong'][$key];

                            $modelWarehouseProductDetails->save($WarehouseProductDetail);

                            $product = $modelProduct->get($value);
                            $product->quantity -= $dataSend['soluong'][$key];
                            $modelProduct->save($product);


                        }elseif($dataSend['type'][$key] == 'combo'){
                            // sử lý trử số lương trong kho ở sản phẩm trong combo
                            $combo = $modelCombo->get($value);
                            if(!empty($combo->product)){
                                $combo_product = json_decode($combo->product);
                                foreach($combo_product as $idProduct => $quantityPro){
                                    $WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$dataSend['soluong'][$key],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

                                    $WarehouseProductDetail->inventory_quantity -= $quantityPro*$dataSend['soluong'][$key];

                                    $modelWarehouseProductDetails->save($WarehouseProductDetail);

                                    $product = $modelProduct->get($idProduct);
                                    $product->quantity -= $quantityPro*$dataSend['soluong'][$key];
                                    $modelProduct->save($product);

                                }
                            }
                        }

                    }
                }

                return $controller->redirect('/printInfoOrder?id='.$order->id);
            }elseif($dataSend['typeOrder']==3){

                return $controller->redirect('/addUserService?id='.$detail->id.'&id_bed='.$dataSend['id_bed'].'&id_service='.$detail->id_product);
                /* $Order = $modelOrder->find()->where(array('id_bed'=>$dataSend['id_bed'], 'status'=>2))->first();
                $bed = $modelBed->find()->where(array('id'=>$dataSend['id_bed'], 'status'=>2))->first();
                if(empty($Order) && empty($bed)){
                    $dataOrder = $modelOrder->get($order->id);

                    $dataOrder->check_in = time();
                    $dataOrder->status = 2;

                    $modelOrder->save($dataOrder);

                    $dataBed = $modelBed->get($dataOrder->id_bed);
                    $dataBed->status = 2;

                    $modelBed->save($dataBed);

                    return $controller->redirect('/listRoomBed');
                }else{
                    return $controller->redirect('/listOrder?mess=conkhach');
                }*/
            }else{
                return $controller->redirect('/order?mess=1');
                
            }
            
        }

        setVariable('listService', $listService);
        setVariable('listProduct', $listProduct);
        setVariable('listCombo', $listCombo);
        setVariable('today', $today);
        setVariable('listRoom', $listRoom);
        setVariable('listStaffs', $listStaffs);
        setVariable('listWarehouse', $listWarehouse);
        setVariable('user', $infoUser);

    }else{
        return $controller->redirect('/');
    }
}

function listOrderProduct($inpuinfoUser->id_member,'id_spa'=>$session->read('id_spa'));
$listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->all()->toList();

$mess = '';
if(@$_GET['mess']=='conkhach'){
    $mess = '<p style="color: #00f83a;">Phòng vẫn có khách không check in được</p>';
}

setVariable('page', $page);
setVariable('totalPage', $totalPage);
setVariable('back', $back);
setVariable('next', $next);
setVariable('urlPage', $urlPage);
setVariable('totalData', $totalData);

setVariable('listData', $listData);
setVariable('listWarehouse', $listWarehouse);
setVariable('mess', @$mess);

}else{
    return $controller->redirect('/');
}
}

function listOrdrCombo($inpuinfoUserall()->toList();
}
}

setVariable('page', $page);
setVariable('totalPage', $totalPage);
setVariable('back', $back);
setVariable('next', $next);
setVariable('urlPage', $urlPage);
setVariable('totalData', $totalData);

setVariable('listData', $listData);
setVariable('modelUserserviceHistories', $modelUserserviceHistories);
setVariable('listWarehouse', $listWarehouse);
setVariable('listRoom', $listRoom);
setVariable('mess', @$mess);

}else{
    return $controller->redirect('/');
}
}

function listOrderService($inpuinfoUser      
    setVariable('listData', $listData);
    setVariable('listRoom', $listRoom);
    setVariable('listWarehouse', $listWarehouse);
    setVariable('mess', @$mess);

}else{
    return $controller->redirect('/');
}
}

function printInfoOrer($inpuinfoUser);
setVariable('data', $data);
}
}else{
    return $controller->redirect('/');
}
}

function addUserService($inpuinfoUserturn $controller->redirect('/');
}
}

fnction paymentOrders($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';

    if(!empty(checkLoginManager('paymentOrders', 'product'))){
        $infoUser = $session->read('infoUser');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelBill = $controller->loadModel('Bills');
        $modelDebts = $controller->loadModel('Debts');
        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');

        if(!empty($_GET['id'])){
            $ = $modelOrder->get($_GET['id']); 


            if($daaSend['type_collection_bill']=='cong_no'){
                $debt =$modelDebt->newEmptyEntity();

               // tạo dữ liệu save
                $debt->id_mmber = @$infoUser->id_membr;
                $debt->id_spa = $session->read('id_spa');
                $debt->id_staff = $infoUser->id;
                $debt->total =  $order->total;
                $debt->note =  'án hàng ID đơn hàng là '.$data->id.', người bán là '.$infoUser>name.', thời gian '.date('Y-m-d H:i:s');
               $debt->type = 0; //0: Thu, 1: chi
               $debt->ceated_at = date('Y-m-d H:i:s');
               $debt->updated_a = date('Y-m-d H:i:s');
               $debt->id_order = $order->id;
               $debt->id_customer = (int)@$dataSend['id_customer'];
               $debt->full_name = @$dataSend['full_name'];
               $debt->time = time);

$modelDebts->save($debt);
}else{
               // lưu bill
 $bill = $modelBill->newEmptEntity();
 $bill->id_member = @$infoUser->id_mmber;
 $bll->id_spa = $session->rea('id_spa');
 $bill->id_staff = (int)@$infoUser->d;;
 $bill->total = $order->total;
 $bill->note = 'Bán hàng IDđơn hàng là '.$order->id.', ngườibán là '.$infoUser->name.', thời gian '.date('Y-m-dH:i:s');
                $bill->type = 0; //0: Thu, 1: hi
                $bill->id_order = $order->id;
                $bill->created_at = date('Y-m-d H:i:s');
                $bill->updated_at= date('Y-m-d H:i:s');
                $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                $bill->id_customer = (int)@$dataSend['id_customer'];
                $bill->full_name = @$dataSend['full_name'];
                if(empty($dataSend['card'])){
                    $bill->type_card = 0;
                }else{
                    $bill->type_card = 1;
                }
                $bill->moneyCustomerPay = @$dataSend['moneyCustomerPay'];
                $bill->time = time();
                $modelBill->save($bill);

                if(!empty($dataSend['card'])){
                    $Prepaycards = $modelCustomerPrepaycards->get($dataSend['card']);
                    $Prepaycards->total -= $bill->total;
                    $modelCustomerPrepaycards->save($Prepaycards);
                }
            }
        }
        return $controller->redirect('/listService');
    }else{
        return $controller->redirect('/');
    }
}