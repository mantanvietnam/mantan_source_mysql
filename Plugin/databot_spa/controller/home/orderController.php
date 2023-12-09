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
		$user = $session->read('infoUser');

		$modelCombo = $controller->loadModel('Combos');
		$modelProduct = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
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

		$conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
		$listService = $modelService->find()->where($conditionsService)->all()->toList();

		$conditionsProduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
		$listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

        if(empty($listProduct)){
            return $controller->redirect('/listProduct/?error=requestProduct');
        }

		$conditionsCombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();

		$listWarehouse = $modelWarehouses->find()->where($conditionsCombo)->all()->toList();
		$today= getdate();
		$conditionsStaff['OR'] = [ 
									['id'=>$user->id_member],
									['id_member'=>$user->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        $conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }
        $mess = '';
        if(@$_GET['mess']=='kho'){
            $mess  = '<p style="color: #00f83a;">&emsp; Sản phẩm trong kho không đủ</p>';
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
			$order->id_member = $user->id_member;
			$order->id_spa =$user->id_spa;
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

                $detail->id_member = $user->id_member;
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

                $agency->id_member = @$user->id_member;
                $agency->id_spa = $session->read('id_spa');
                $agency->id_staff = $user->id;
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
                    $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
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
                    $bill->id_member = @$user->id_member;
                    $bill->id_spa = $session->read('id_spa');
                    $bill->id_staff = (int)@$dataSend['id_staff'];
                    $bill->total = (int)@$dataSend['totalPays'];
                    $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
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
        setVariable('user', $user);
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
        $user = $session->read('infoUser');

        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
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

        $conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
        $listService = $modelService->find()->where($conditionsService)->all()->toList();

        $conditionsProduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
        $listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

        $conditionsCombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
        $listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();


        if(empty($listCombo)){
            return $controller->redirect('/listCombo/?error=requestProduct');
        }

        $listWarehouse = $modelWarehouses->find()->where($conditionsCombo)->all()->toList();
        $today= getdate();
        $conditionsStaff['OR'] = [ 
                                    ['id'=>$user->id_member],
                                    ['id_member'=>$user->id_member],
                                ];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        $conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }

        $mess = '';
        if(@$_GET['mess']=='kho'){
            $mess  = '<p style="color: #00f83a;">&emsp; Sản phẩm trong kho không đủ</p>';
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
            $order->id_member = $user->id_member;
            $order->id_spa =$user->id_spa;
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

                $detail->id_member = $user->id_member;
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

                $agency->id_member = @$user->id_member;
                $agency->id_spa = $session->read('id_spa');
                $agency->id_staff = $user->id;
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
                    $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
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
                    $bill->id_member = @$user->id_member;
                    $bill->id_spa = $session->read('id_spa');
                    $bill->id_staff = (int)@$dataSend['id_staff'];
                    $bill->total = (int)@$dataSend['totalPays'];
                    $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
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
        setVariable('user', $user);
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
        $user = $session->read('infoUser');

        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
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

        $conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
        $listService = $modelService->find()->where($conditionsService)->all()->toList();

         if(empty($listService)){
           return $controller->redirect('/listService/?error=requestService');
        }

        $conditionsProduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
        $listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

        $conditionsCombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
        $listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();

        $listWarehouse = $modelWarehouses->find()->where($conditionsCombo)->all()->toList();
        $today= getdate();
        $conditionsStaff['OR'] = [ 
                                    ['id'=>$user->id_member],
                                    ['id_member'=>$user->id_member],
                                ];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        $conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }

        // sử lý đơn hàng
        if($isRequestPost){
            $dataSend = $input['request']->getData();
             
            // tạo đơn hàng 
            $order = $modelOrder->newEmptyEntity();
            $order->id_member = $user->id_member;
            $order->id_spa =$user->id_spa;
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

                $detail->id_member = $user->id_member;
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

                $agency->id_member = @$user->id_member;
                $agency->id_spa = $session->read('id_spa');
                $agency->id_staff = $user->id;
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
                    $debt->note =  'Bán hàng ID đơn hàng là '.$data->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
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
                    $bill->id_member = @$user->id_member;
                    $bill->id_spa = $session->read('id_spa');
                    $bill->id_staff = (int)@$dataSend['id_staff'];
                    $bill->total = (int)@$dataSend['totalPays'];
                    $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
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
        setVariable('user', $user);

    }else{
        return $controller->redirect('/');
    }
}

function listOrderProduct($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách đơn hàng';
    
    if(!empty(checkLoginManager('listOrderProduct', 'product'))){
        $modelCombo = $controller->loadModel('Combos');
        $modelWarehouses = $controller->loadModel('Warehouses');
		$modelProduct = $controller->loadModel('Products');
		$modelCustomer = $controller->loadModel('Customers');
		$modelService = $controller->loadModel('Services');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');

        $user = $session->read('infoUser');

        $conditions = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'type' =>'product' );
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = $_GET['id'];
        }


        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $conditions['time >='] = $date_start;
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $date_end = mktime(0,0,0,$date_end[1],$date_end[0],$date_end[2]);
            $conditions['time <='] = $date_end;
        }

        
        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);


        if(!empty($listData)){
            foreach($listData as $key => $item){
            	if(!empty($item->id_customer)){
            		$listData[$key]->customer = $modelCustomer->find()->where(array('id'=>$item->id_customer))->first();
            	}

                $product = $modelOrderDetails->find()->where(array('id_order'=>$item->id))->all()->toList();
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
                    $listData[$key]->product = $product;
                    if(!empty($item->id_bed)){
                        $listData[$key]->bed = $modelBed->find()->where(array('id'=>$item->id_bed))->first();
                    }
                }
            }
        }


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

        $order = array('name'=>'asc');

        $conditionsWarehouse = array('id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
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

function listOrderCombo($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách đơn hàng';
    
    if(!empty(checkLoginManager('listOrderCombo', 'combo'))){
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

        $conditions = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'),'type' =>'combo' );
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = $_GET['id'];
        }

        if(!empty($_GET['id_Warehouse'])){
            $conditions['id_warehouse'] = $_GET['id_Warehouse'];
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $conditions['time >='] = $date_start;
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $date_end = mktime(0,0,0,$date_end[1],$date_end[0],$date_end[2]);
            $conditions['time <='] = $date_end;
        }

        if(!empty($_GET['idBed'])){
            $conditions['id_bed'] = $_GET['idBed'];
        }

        if(isset($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(empty($_GET['searchProduct'])){
            $_GET['id_product'] = '';
        }
        
        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);


        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id_customer)){
                    $listData[$key]->customer = $modelCustomer->find()->where(array('id'=>$item->id_customer))->first();
                }

                $product = $modelOrderDetails->find()->where(array('id_order'=>$item->id))->all()->toList();
                if(!empty($product)){

                    foreach($product as $k => $value){
                        $prod = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
                        $products = array();
                        $service = array();
                        if(!empty($prod)){
                            $combo_product = json_decode($prod->product);
                            foreach($combo_product as $idProduct => $quantityPro){
                                $pr =  $modelProduct->find()->where(array('id'=>$idProduct))->first();
                                $pr->quantity_Combo =  $quantityPro;
                                $products[] = $pr;
                            }
                            $combo_service = json_decode($prod->service);
                            foreach($combo_service as $idservice => $quantityPro){
                                $pr =  $modelService->find()->where(array('id'=>$idservice))->first();
                                $pr->quantity_Combo =  $quantityPro;
                                $service[] = $pr;
                            }
                            
                        }
                  
                        $prod->combo_product = $products;
                        $prod->combo_service = $service;

                        $product[$k] = $prod;
                    }


                        
                    $listData[$key]->product = $product;
                    if(!empty($item->id_bed)){
                        $listData[$key]->bed = $modelBed->find()->where(array('id'=>$item->id_bed))->first();
                    }
                }
            }
        }

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

        $order = array('name'=>'asc');

        $conditionsWarehouse = array('id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        $listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->all()->toList();

        $mess = '';
        if(@$_GET['mess']=='conkhach'){
            $mess = '<p style="color: #00f83a;">Phòng vẫn có khách không check in được</p>';
        }

        $conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'), 'status'=>1))->all()->toList();
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

function listOrderService($input){
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách đơn hàng';
    
    if(!empty(checkLoginManager('listOrderService', 'product'))){
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

        $conditions = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'),'type' =>'service' );
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = $_GET['id'];
        }
        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $conditions['time >='] = $date_start;
        }
        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $date_end = mktime(0,0,0,$date_end[1],$date_end[0],$date_end[2]);
            $conditions['time <='] = $date_end;
        }
        if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

        
        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);


        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id_customer)){
                    $listData[$key]->customer = $modelCustomer->find()->where(array('id'=>$item->id_customer))->first();
                }

                $product = $modelOrderDetails->find()->where(array('id_order'=>$item->id))->all()->toList();
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
                    $listData[$key]->product = $product;
                    if(!empty($item->id_bed)){
                        $listData[$key]->bed = $modelBed->find()->where(array('id'=>$item->id_bed))->first();
                    }
                }
            }
        }


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

        $order = array('name'=>'asc');

        $conditionsWarehouse = array('id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        $listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->all()->toList();

        $mess = '';
        if(@$_GET['mess']=='conkhach'){
            $mess = '<p style="color: #00f83a;">Phòng vẫn có khách không check in được</p>';
        }

        $conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'), 'status'=>1))->all()->toList();
            }
        }

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
        setVariable('listRoom', $listRoom);
        setVariable('listWarehouse', $listWarehouse);
        setVariable('mess', @$mess);

    }else{
        return $controller->redirect('/');
    }
}

function printInfoOrder($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'In đơn hàng';

    if(!empty(checkLoginManager('printInfoOrder', 'product'))){
        $user = $session->read('infoUser');

        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelBill = $controller->loadModel('Bills');
        $modelCustomer = $controller->loadModel('Customers');


        if(!empty($_GET['id'])){
            $data = $modelOrder->find()->where(array('id'=>$_GET['id'],'status'=>1))->first();

            $product = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'product'))->all()->toList();
            $service = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'service'))->all()->toList();
            $combo = $modelOrderDetails->find()->where(array('id_order'=>$data->id,'type'=>'combo'))->all()->toList();
            $data->bill = $modelBill->find()->where(array('id_order'=>$data->id))->first();

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

            $data->spa = getSpa($user->id_spa);

           /* debug($data);
            die;*/

            setVariable('user', $user);
            setVariable('data', $data);
        }
    }else{
        return $controller->redirect('/');
    }
}

function addUserService($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Nhận khách làm dịch vụ';

    if(!empty(checkLoginManager('addUserService','product'))){
        $user = $session->read('infoUser');

        $modelCombo = $controller->loadModel('Combos');
        $modelProduct = $controller->loadModel('Products');
        $modelService = $controller->loadModel('Services');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelBill = $controller->loadModel('Bills');
        $modelAgency = $controller->loadModel('Agencys');
        $modelCustomer = $controller->loadModel('Customers');
        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');


        if(!empty($_GET['id'])){
            

            $OrderDetails = $modelOrderDetails->get($_GET['id']);
            $Order = $modelOrder->get($OrderDetails->id_order);

            if(empty($_GET['id_bed'])){
                $OrderDetails->number_uses +=1;

                $modelOrderDetails->save($OrderDetails);

                $UserService = $modelUserserviceHistories->newEmptyEntity();
                $UserService->id_member = $user->id_member;
                $UserService->id_staff = $user->id;
                $UserService->id_order_details = $_GET['id'];
                $UserService->id_spa =$session->read('id_spa');
                $UserService->id_services =$_GET['id_service'];
                $UserService->created_at =date('Y-m-d H:i:s');
                $UserService->note =@$_GET['note'];
                $UserService->id_customer = $Order->id_customer;
                $UserService->id_customer = $Order->id_customer;
                $UserService->status = 0;

                 $modelUserserviceHistories->save($UserService);
            }else{
                $OrderDetails->number_uses +=1;

                $modelOrderDetails->save($OrderDetails);

                $UserService = $modelUserserviceHistories->newEmptyEntity();
                $UserService->id_member = $user->id_member;
                $UserService->id_order_details = $_GET['id'];
                $UserService->id_staff = $user->id;
                $UserService->id_spa =$session->read('id_spa');
                $UserService->id_services =$_GET['id_service'];
                $UserService->created_at =date('Y-m-d H:i:s');
                $UserService->note =@$_GET['note'];
                $UserService->id_bed = $_GET['id_bed'];
                $UserService->id_customer = $Order->id_customer;
                $UserService->status = 1;
                $modelUserserviceHistories->save($UserService);

                $bed = $modelBed->find()->where(array('id'=>$_GET['id_bed'], 'status'=>2))->first();
                if(empty($bed)){
                    $dataBed = $modelBed->get($_GET['id_bed']);
                    $dataBed->status = 2;

                    $modelBed->save($dataBed);

                    return $controller->redirect('/listRoomBed');
                }else{
                    return $controller->redirect('/listOrder?mess=conkhach');
                }

            }
            $money = 0;
            $checkService = $modelService->find()->where(array('id'=>$_GET['id_service']))->first();
                 
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
                $agency->id_staff = $user->id;
                $agency->id_service = $_GET['id_service'];
                $agency->id_user_service =  @$UserService->id;
                $agency->money = $money;
                $agency->created_at = date('Y-m-d H:i:s');
                $agency->note = 'lần thứ '.@$OrderDetails->number_uses;
                $agency->id_order_detail = $_GET['id'];
                $agency->status = 0;
                $agency->id_order = $Order->id;
                $agency->type = 'thực hiện';

                $modelAgency->save($agency);
            }

             return $controller->redirect('/listOrderService');
         }
    }else{
        return $controller->redirect('/');
    }
}

?>
