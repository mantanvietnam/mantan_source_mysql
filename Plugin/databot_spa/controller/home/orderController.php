<?php 
function order($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';

    if(!empty($session->read('infoUser'))){
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

		$conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
		$listService = $modelService->find()->where($conditionsService)->all()->toList();

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
			 debug($dataSend);
			die;

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
			$order->type =@$dataSend['typeOrder'];

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
            foreach($dataSend['idHangHoa'] as $key => $value){
                $detail = $modelOrderDetails->newEmptyEntity();

                $detail->id_member = $user->id_member;
                $detail->id_order = $order->id;
                $detail->id_product = $value;
                $detail->price = (int) $dataSend['money'][$key];
                $detail->quantity = (int) $dataSend['soluong'][$key];
                $detail->type = $dataSend['type'][$key];

                $modelOrderDetails->save($detail);

            }
            //sử lý phần thanh toán 
            if($dataSend['typeOrder']==1){
            	// lưu bill
                $bill = $modelBill->newEmptyEntity();
                $bill->created_at = date('Y-m-d H:i:s');
            	$bill->id_member = @$user->id_member;
                $bill->id_spa = $session->read('id_spa');
                $bill->id_staff = (int)@$dataSend['id_staff'];
                $bill->total = (int)@$dataSend['totalPays'];
                $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$user->name.', thời gian '.date('Y-m-d H:i:s');
                $bill->type = 0; //0: Thu, 1: chi
                $bill->id_order = $order->id;
                $bill->updated_at = date('Y-m-d H:i:s');
                $bill->type_collection_bill = @$dataSend['type_collection_bill'];
                $bill->id_customer = (int)@$dataSend['id_customer'];
                $bill->full_name = @$dataSend['full_name'];

                if(!empty($dataSend['time'])){
                    $time = explode(' ', $dataSend['time']);
                    $date = explode('/', $time[0]);
                    $hour = explode(':', $time[1]);
                    $bill->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
                }else{
                    $bill->time = time();
                }
               
                $modelBill->save($bill);

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

                return $controller->redirect('/order?mess=2');
            }elseif($dataSend['typeOrder']==3){
                 $Order = $modelOrder->find()->where(array('id_order'=>$dataSend['id_bed'], 'status'=>2))->first();
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
		return $controller->redirect('/login');
	}
}

function listOrder($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách đơn hàng';
    
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

        $conditions = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
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
        return $controller->redirect('/login');
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
    
    if(!empty($session->read('infoUser'))){
        $modelBed = $controller->loadModel('Beds');
        $modelOrder = $controller->loadModel('Orders');
        $user = $session->read('infoUser');

        if(!empty($_GET['id_order'])){
            $Order = $modelOrder->find()->where(array('id_order'=>$_GET['id_bed'], 'status'=>2))->first();
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
        return $controller->redirect('/login');
    }
}

 ?>