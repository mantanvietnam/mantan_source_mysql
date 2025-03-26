<?php 
function createOrderServiceAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['data_order']) && !empty($dataSend['id_customer']) && !empty($dataSend['id_staff'])){
			$infoUser = getMemberByToken($dataSend['token'], 'orderService','product');
			if(!empty($infoUser)){

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
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
        		$dataSend['data_order'] = json_decode($dataSend['data_order'], true);

        		$infoCustomer = $modelCustomer->find()->where(['id'=>(int)$dataSend['id_customer'], 'id_member'=>$infoUser->id_member])->first();
        		if(empty($infoCustomer)){
        			return apiResponse(3,'khách hàng không tồn tại' );
        		}

        		if(!empty($dataSend['id_card'])){
		            $Prepaycards = $modelCustomerPrepaycards->find()->where(['id'=>$dataSend['id_card'], 'id_customer'=>$infoCustomer->id, 'id_member'=>$infoUser->id_member, 'total >'=>(int)@$dataSend['totalPays']]);
		            if(empty($Prepaycards)){
        				return apiResponse(3,'thẻ trả trước của khách hàng không tồn tại' );
        			}
		        }

		            // tạo đơn hàng 
		        $order = $modelOrder->newEmptyEntity();
		        $order->id_member = $infoUser->id_member;
		        $order->id_spa =$infoUser->id_spa;
		        $order->id_staff =(int)@$infoUser->id;
		        $order->id_customer =@$infoCustomer->id;
		        $order->full_name = @$infoCustomer->name;
		        $order->id_bed =@$dataSend['id_bed'];
		        $order->note =@$dataSend['note'];
		        if($dataSend['typeOrder']==1){
		           $order->status =1;
		       }else{
		           $order->status =0;
		       }
		       $order->promotion =@$dataSend['promotion'];
		       $order->total =@$dataSend['total'];
		       $order->total_pay =@$dataSend['total_pay'];
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
		        $order->created_at = $order->time;
				$order->updated_at = $order->time;
		        $modelOrder->save($order);
		                // tạo chi tiêt dơn hàng 
		        $money = 0;
		        $listDetail = array();
		        foreach($dataSend['data_order'] as $key => $value){
		        	$checkService = $modelService->find()->where(array('id'=>$value['id_service']))->first();
		        	 if(!empty($checkService)){
			            $detail = $modelOrderDetails->newEmptyEntity();

			            $detail->id_member = $infoUser->id_member;
			            $detail->id_order = $order->id;
			            $detail->id_product = $value['id_service'];
			            $detail->price = (int) $value['price'];
			            $detail->quantity = (int) $value['quantity'];
			            $detail->type = $order->type;

			            $modelOrderDetails->save($detail);
		   
		            	$listDetail[$key] = $detail;
		     
		                if(!empty($checkService->commission_affiliate_fix)){
		                    $money += $checkService->commission_affiliate_fix*$detail->quantity;
		                }elseif(!empty($checkService->commission_affiliate_percent)){
		                    $money += (((int)$checkService->commission_affiliate_percent / 100)*$detail->price)*(int)$detail->quantity;
		                }
		            }
		        }
		        $order->list_detail = $listDetail;


		        if($money>0){
		            $agency = $modelAgency->newEmptyEntity();

		            $agency->id_member = @$infoUser->id_member;
		            $agency->id_spa = $session->read('id_spa');
		            $agency->id_staff = $infoUser->id;
		            $agency->id_service = 0;
		            $agency->money = $money;
		            $agency->created_at =time();
		            $agency->note = '';
		            $agency->id_order_detail = 0;
		            $agency->status = 0;
		            $agency->id_order = $order->id;
		            $agency->type = 'sale';

		            $modelAgency->save($agency);

		            $order->agency = $agency;
		        }

            		//sử lý phần thanh toán 
		        if($dataSend['typeOrder']==1){

		            if($dataSend['type_collection_bill']=='cong_no'){
		                $debt =$modelDebts->newEmptyEntity();
		                
		                        // tạo dữ liệu save
		                $debt->id_member = @$infoUser->id_member;
		                $debt->id_spa = $session->read('id_spa');
		                $debt->id_staff = (int)@$dataSend['id_staff'];
		                $debt->total =  $order->total_pay;
		                $debt->note =  'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
		                $debt->type = 0; //0: Thu, 1: chi
		                $debt->created_at =$order->time;
		                $debt->updated_at =$order->time;
		                $debt->id_order = $order->id;
		                $debt->id_customer = (int)@$dataSend['id_customer'];
		                $debt->full_name = @$infoCustomer->name;
		                $debt->time = $order->time;
		                        
		                $modelDebts->save($debt);

		                $order->debt = $debt;
		            }else{
		                        // lưu bill
		                $bill = $modelBill->newEmptyEntity();
		                $bill->id_member = @$infoUser->id_member;
		                $bill->id_spa = $session->read('id_spa');
		                $bill->id_staff = (int)@$infoUser->id_id;
		                $bill->total = (int)@$dataSend['totalPays'];
		                $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
		                $bill->type = 0; //0: Thu, 1: chi
		                $bill->id_order = $order->id;
		                $bill->created_at =$order->time;
		                $bill->updated_at =$order->time;
		                $bill->id_customer = (int)@$dataSend['id_customer'];
		                $bill->full_name =  @$infoCustomer->name;
		                $bill->moneyReturn = @$dataSend['moneyReturn'];
		                if(empty($dataSend['card'])){
		                    $bill->type_card = 0;
		                    $bill->type_collection_bill = @$dataSend['type_collection_bill'];
		                }else{
		                    $bill->type_card = 1;
		                    $bill->type_collection_bill = 'the_tra_truoc';
		                    $bill->id_card = (int)$dataSend['card'];
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

		                $order->bill = $bill;
		            }
		        
		        }elseif($dataSend['typeOrder']==3){  
                    $info = 	addUserserviceHistories($detail->id,$dataSend['id_bed'],$detail->id_product,$order->time,$dataSend['id_staff']);

                    return apiResponse($info['code'],$info['mess'],$order);
                  
                }
            
        		return apiResponse(1,'lấy dữ liệu thành công',$order);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listOrderServiceAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listOrderService','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

		        $conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa, 'type'=>'service');
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('time'=>'desc');

		        if(!empty($dataSend['id'])){
		           $conditions['id']= $dataSend['id']; 
		        }

		        if(!empty($dataSend['id_customer'])){
		           $conditions['id_customer']= $dataSend['id_customer']; 
		        }

		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['time >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['time <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);     
		        }

		        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		              $OrderDetail = $modelOrderDetails->find()->where(['id_order'=>$item->id])->all()->toList();
		              if(!empty($OrderDetail)){
		                foreach($OrderDetail as $k => $value){
		                    $OrderDetail[$k]->service = $modelService->find()->where(['id'=>$value->id_product])->first();
		                }
		                $listData[$key]->OrderDetail = $OrderDetail;
		                $customer = $modelCustomer->find()->where(['id'=>$item->id_customer])->first();
		                if(!empty($customer)){
		                    $conditioncard['id_customer'] = $customer->id;
		                    $conditioncard['total >='] = $item->total_pay;
		                                 
		                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
		                    if(!empty($card)){
		                        foreach($card as $k => $value){
		                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
		                            $card[$k] = $value;
		                        }

		                       $customer->card = $card;
		                    }
		                }
		                $listData[$key]->customer = $customer;
		              }
		            }
		        }
		        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
		        $totalMoney = 0;
		        if(!empty($totalData)){
		            foreach($totalData as $key => $item){
		                $totalMoney += $item->total;
		            }
		        }

		        $totalData = count($totalData);

          		return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');    
}

function detailOrderServiceAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listOrderService','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

		        $conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa, 'type'=>'service');
				$conditions['id']= $dataSend['id']; 
		       

		        $data = $modelOrder->find()->where($conditions)->first();

		        if(!empty($data)){
		              $OrderDetail = $modelOrderDetails->find()->where(['id_order'=>$data->id])->all()->toList();
		              if(!empty($OrderDetail)){
		                foreach($OrderDetail as $k => $value){
		                    $OrderDetail[$k]->service = $modelService->find()->where(['id'=>$value->id_product])->first();
		                }
		                $data->OrderDetail = $OrderDetail;
		                $customer = $modelCustomer->find()->where(['id'=>$data->id_customer])->first();
		                if(!empty($customer)){
		                    $conditioncard['id_customer'] = $customer->id;
		                    $conditioncard['total >='] = $data->total_pay;
		                                 
		                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
		                    if(!empty($card)){
		                        foreach($card as $k => $value){
		                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
		                            $card[$k] = $value;
		                        }

		                       $customer->card = $card;
		                    }
		                }
		                $data->customer = $customer;
		              }
		            }
          		return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');    
}

function createOrderProductAPI($input){
    global $controller;
	global $modelCategories;
   	global $urlCurrent;
   	global $metaTitleMantan;
   	global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['data_order']) && !empty($dataSend['id_customer']) && !empty($dataSend['id_staff']) && !empty($dataSend['id_warehouse'])){
			$infoUser = getMemberByToken($dataSend['token'], 'orderProduct','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $dataSend['data_order'] = json_decode($dataSend['data_order'], true);

		  

		       	foreach($dataSend['data_order'] as $key => $value){
			  		$WarehouseProduct =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value['id_product'], 'inventory_quantity >='=>$value['quantity'],'id_warehouse'=>(int)$dataSend['id_warehouse'],'id_member'=>$infoUser->id_member))->first();
			        if(empty($WarehouseProduct)){
			        	$product = $modelProduct->find()->where(['id'=>$value['id_product'],'id_member'=>$infoUser->id_member])->first();
			           	return apiResponse(3,'Sản phẩm '.$product->name.' trong kho không đủ' );
			        }
			     	
			    }

			    $infoCustomer = $modelCustomer->find()->where(['id'=>(int)$dataSend['id_customer'], 'id_member'=>$infoUser->id_member])->first();
        		if(empty($infoCustomer)){
        			return apiResponse(3,'khách hàng không tồn tại' );
        		}

		    			// tạo đơn hàng 
			    $order = $modelOrder->newEmptyEntity();
			    $order->id_member = $infoUser->id_member;
			    $order->id_spa =$infoUser->id_spa;
			    $order->id_staff = (!empty($dataSend['id_staff']))?(int)$dataSend['id_staff']:$infoUser->id;
			    $order->id_customer =@$infoCustomer->id;
			    $order->full_name = @$infoCustomer->name;
			    $order->id_bed =0;
			    $order->note =@$dataSend['note'];
			    $order->created_at =time();
			    $order->updated_at =time();
			    $order->status =1;
			    $order->promotion =@$dataSend['promotion'];
			    $order->total =@$dataSend['total'];
			    $order->total_pay =@$dataSend['total_pay'];
			    $order->type_order =1;
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

		        $listDetail = array();
			    $money = 0;
			    foreach($dataSend['data_order'] as $key => $value){
			        $detail = $modelOrderDetails->newEmptyEntity();

			        $detail->id_member = $infoUser->id_member;
			        $detail->id_order = $order->id;
			        $detail->id_product = $value['id_product'];
			        $detail->price = (int) $value['price'];
			        $detail->quantity = (int) $value['quantity'];
			        $detail->type = 'product';

			        $modelOrderDetails->save($detail);
			        $listDetail[$key] = $detail;

			        $checkProduct = $modelProduct->find()->where(array('id'=>$value['id_product'], 'id_member'=>$infoUser->id_member))->first();

			        if(!empty($checkProduct)){
			            if(!empty($checkProduct->commission_affiliate_fix)){
			                $money += $checkProduct->commission_affiliate_fix*$detail->quantity;
			            }elseif(!empty($checkProduct->commission_affiliate_percent)){
			                $money += (((int)$checkProduct->commission_affiliate_percent / 100)*$detail->price)*(int)$detail->quantity;
			            }
			        }
			    }
			     $order->list_detail = $listDetail;

			    if($money>0){
			        $agency = $modelAgency->newEmptyEntity();

			        $agency->id_member = @$infoUser->id_member;
			        $agency->id_spa = $infoUser->id_spa;
			        $agency->id_staff = (!empty($dataSend['id_staff']))?(int)$dataSend['id_staff']:$infoUser->id;
			        $agency->id_service = 0;
			        $agency->money = $money;
			        $agency->created_at = $order->time;
			        $agency->note = '';
			        $agency->id_order_detail = 0;
			        $agency->status = 0;
			        $agency->id_order = $order->id;
			        $agency->type = 'sale';

			        $modelAgency->save($agency);
			    }
			     //sử lý phần thanh toán 

			        if($dataSend['type_collection_bill']=='cong_no'){
			            $debt =$modelDebts->newEmptyEntity();

			                            // tạo dữ liệu save
			            $debt->id_member = @$infoUser->id_member;
			            $debt->id_spa = $infoUser->id_spa;
			            $debt->id_staff = (int)@$order->id_staff;
			            $debt->total =  $order->total_pay;
			            $debt->note =  'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
			            $debt->type = 0; //0: Thu, 1: chi
			            $debt->created_at = $order->time;
			            $debt->updated_at = $order->time;
			            $debt->id_order = $order->id;
			            $debt->id_customer = (int)@$dataSend['id_customer'];
			            $debt->full_name = @$infoCustomer->name;
			            $debt->time = time();
			            $modelDebts->save($debt);
			                        
			        }else{
			            // lưu bill
			            $bill = $modelBill->newEmptyEntity();
			            $bill->id_member = @$infoUser->id_member;
			            $bill->id_spa = $session->read('id_spa');
			            $bill->id_staff = (int)@$dataSend['id_staff'];
			            $bill->total = (int)@$dataSend['total_pay'];
			            $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
		                $bill->type = 0; //0: Thu, 1: chi
		                $bill->id_order = $order->id;
		                $bill->created_at = time();
		                $bill->updated_at = time();
		                $bill->id_customer = (int)@$dataSend['id_customer'];
		                $bill->full_name = @$infoCustomer->name;
		                $bill->moneyReturn = @$dataSend['moneyReturn'];
			            if(empty($dataSend['id_card'])){
			                $bill->type_card = 0;
			                $bill->type_collection_bill = @$dataSend['type_collection_bill'];
			            }else{
			                $bill->type_card = 1;
			                $bill->type_collection_bill = 'the_tra_truoc';
			                $bill->id_card = (int)$dataSend['id_card'];
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
			        if(!empty($dataSend['data_order'])){
			        	foreach($dataSend['data_order'] as $key => $value){
			          		$WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$value['id_product'], 'inventory_quantity >='=>$value['quantity'],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();

			        		$WarehouseProductDetail->inventory_quantity -= $value['quantity'];

			        		$modelWarehouseProductDetails->save($WarehouseProductDetail);

			        		$product = $modelProduct->get($value['id_product']);
			       			$product->quantity -= $value['quantity'];
			       			$modelProduct->save($product);
			        	}
			        }

			  
        		return apiResponse(1,'Tạo đơn thành công',$order);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function checkServiceCombo($input){
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

	$return = [];
	$modelCustomer = $controller->loadModel('Customers');
	$modelService = $controller->loadModel('Services');
	$modelMembers = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelOrderDetail = $controller->loadModel('OrderDetails');
	$modelSpas = $controller->loadModel('Spas');
	$modelCombo = $controller->loadModel('Combos');
	$modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'], '','staff');

            if(empty($infoMember)){
            	return apiResponse(3,'Tài khoản không tồn tại hoặc sai token');
           }

           if(empty($dataSend['id_staff'])){
           		$dataSend['id_staff'] = $infoMember->id;
           }
            if(empty($dataSend['id_spa'])){
           		$dataSend['id_spa'] = $infoMember->id_spa;
           }
            if(empty($dataSend['id_member'])){
           		$dataSend['id_member'] = $infoMember->id_member;
           }
       }elseif(!empty($session->read('infoUser'))){
       		$infoMember = $session->read('infoUser');

       		if(empty($dataSend['id_staff'])){
           		$dataSend['id_staff'] = $infoMember->id;
           }
            if(empty($dataSend['id_spa'])){
           		$dataSend['id_spa'] = $infoMember->id_spa;
           }
            if(empty($dataSend['id_member'])){
           		$dataSend['id_member'] = $infoMember->id_member;
           }
       }else{
       		return apiResponse(2,'thếu dữ liệu' );
       }
       $listData = $modelOrder->find()->where(['id_customer'=>$dataSend['id_customer'], 'type'=>'combo','id_member'=>$infoMember->id_member])->all()->toList();
        if(!empty($listData)){
            foreach($listData as $key => $item){
                $order_details = $modelOrderDetail->find()->where(array('id_order'=>$item->id))->all()->toList();
                
                if(!empty($order_details)){
                    foreach($order_details as $k => $value){
                        $combo = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
                        $products = array();
                        $service = array();
                        
                        if(!empty($combo)){
                            $combo->quantity = $value->quantity;
                            $combo_service = json_decode($combo->service);

                            $quantity = $modelUserserviceHistories->find()->where(array('id_order_details'=>$value->id, 'id_services'=> (int)$dataSend['id_service'], 'status'=>2))->count();

                            if(!empty($combo_service)){
                                foreach($combo_service as $idservice => $quantityPro){
                                	if($idservice == $dataSend['id_service']){

                                		 $info_service =  $modelService->find()->where(array('id'=>$idservice))->first();
                                		 if(!empty($info_service)){
                                		 	$quantityAll = $quantityPro*$value->quantity;
                                		 	if($quantity < $quantityAll){
                                		 		$data = array('id_order_detail'=>$value->id,'id_order'=>$item->id, 'id_service'=>$idservice);
                                		 		 return apiResponse(1,'có đơn combo liệu trình dịch vụ này ', $data);
                                		 	}
                                		 }
                                	}
                                }
                            }
                        }
                      
                    }
                }
            }
        }

       return apiResponse(4,'Dịch vụ không tồi tại ');


      }

	return apiResponse(0,'Gửi sai phương thức POST');
}

function listOrderProductAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listOrderProduct','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

		        $conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa, 'type'=>'product');
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('time'=>'desc');

		        if(!empty($dataSend['id'])){
		           $conditions['id']= $dataSend['id']; 
		        }

		        if(!empty($dataSend['id_customer'])){
		           $conditions['id_customer']= $dataSend['id_customer']; 
		        }

		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['time >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['time <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);     
		        }

		        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		              $OrderDetail = $modelOrderDetails->find()->where(['id_order'=>$item->id])->all()->toList();
		              if(!empty($OrderDetail)){
		                foreach($OrderDetail as $k => $value){
		                    $OrderDetail[$k]->product = $modelProduct->find()->where(['id'=>$value->id_product])->first();
		                }
		                $listData[$key]->OrderDetail = $OrderDetail;
		                $customer = $modelCustomer->find()->where(['id'=>$item->id_customer])->first();
		                if(!empty($customer)){
		                	$conditionscatd =[];
		                    $conditioncard['id_customer'] = $customer->id;
		                    $conditioncard['total >='] = $item->total_pay;
		                                 
		                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
		                    if(!empty($card)){
		                        foreach($card as $k => $value){
		                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
		                            $card[$k] = $value;
		                        }

		                       $customer->card = $card;
		                    }
		                }
		                $listData[$key]->customer = $customer;
		              }
		            }
		        }
		        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
		        $totalMoney = 0;
		        if(!empty($totalData)){
		            foreach($totalData as $key => $item){
		                $totalMoney += $item->total;
		            }
		        }

		        $totalData = count($totalData);

          		return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');    
}

function detailOrderProductAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listOrderProduct','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

		        $conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa, 'type'=>'product');
				$conditions['id']= $dataSend['id']; 
		       

		        $data = $modelOrder->find()->where($conditions)->first();

		        if(!empty($data)){
		              $OrderDetail = $modelOrderDetails->find()->where(['id_order'=>$data->id])->all()->toList();
		              if(!empty($OrderDetail)){
		                foreach($OrderDetail as $k => $value){
		                    $OrderDetail[$k]->product = $modelProduct->find()->where(['id'=>$value->id_product])->first();
		                }
		                $data->OrderDetail = $OrderDetail;
		                $customer = $modelCustomer->find()->where(['id'=>$data->id_customer])->first();
		                if(!empty($customer)){
		                    $conditioncard['id_customer'] = $customer->id;
		                    $conditioncard['total >='] = $data->total_pay;
		                                 
		                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
		                    if(!empty($card)){
		                        foreach($card as $k => $value){
		                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
		                            $card[$k] = $value;
		                        }

		                       $customer->card = $card;
		                    }
		                }
		                $data->customer = $customer;
		              }
		            }
          		return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function createComboAPI($input){
    global $controller;
	global $modelCategories;
   	global $urlCurrent;
   	global $metaTitleMantan;
   	global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Tạo đơn hàng';
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['data_order']) && !empty($dataSend['id_customer']) && !empty($dataSend['id_staff']) && !empty($dataSend['id_warehouse'])){
			$infoUser = getMemberByToken($dataSend['token'], 'orderProduct','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $dataSend['data_order'] = json_decode($dataSend['data_order'], true);
		  		
		       	foreach($dataSend['data_order'] as $key => $value){
		       		$combo = $modelCombo->find()->where(['id'=>$value['id_combo'], 'id_member'=>$infoUser->id_member])->first();

	                    if(!empty($combo->quantity>=$value['id_combo'])){
	                  
	                    	$combo->quantity = $combo->quantity - $value['id_combo'];
	                    }else{
	                         return apiResponse(3,'Combo '.$combo->name.' hết' );;
	                    }
	                    if(!empty($combo->product)){
	                        $combo_product = json_decode($combo->product);
	                        foreach($combo_product as $idProduct => $quantityPro){
	                            $WarehouseProduct =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$value['quantity'],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();
	                            if(empty($WarehouseProduct)){
	                                return apiResponse(3,'Sản phẩm '.$product->name.' trong kho không đủ' );
	                            }
	                        }

	                    }
	                    $modelCombo->save($combo);
			  		
			    }

			    $infoCustomer = $modelCustomer->find()->where(['id'=>(int)$dataSend['id_customer'], 'id_member'=>$infoUser->id_member])->first();
        		if(empty($infoCustomer)){
        			return apiResponse(3,'khách hàng không tồn tại' );
        		}

		    			// tạo đơn hàng 
			    $order = $modelOrder->newEmptyEntity();
			    $order->id_member = $infoUser->id_member;
			    $order->id_spa =$infoUser->id_spa;
			    $order->id_staff = (!empty($dataSend['id_staff']))?(int)$dataSend['id_staff']:$infoUser->id;
			    $order->id_customer =@$infoCustomer->id;
			    $order->full_name = @$infoCustomer->name;
			    $order->id_bed =0;
			    $order->note =@$dataSend['note'];
			    $order->created_at =time();
			    $order->updated_at =time();
			    $order->status =1;
			    $order->promotion =@$dataSend['promotion'];
			    $order->total =@$dataSend['total'];
			    $order->total_pay =@$dataSend['total_pay'];
			    $order->type_order =1;
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

		        $listDetail = array();
			    $money = 0;
			    foreach($dataSend['data_order'] as $key => $value){
			        $detail = $modelOrderDetails->newEmptyEntity();

			        $detail->id_member = $infoUser->id_member;
			        $detail->id_order = $order->id;
			        $detail->id_product = $value['id_combo'];
			        $detail->price = (int) $value['price'];
			        $detail->quantity = (int) $value['quantity'];
			        $detail->type = 'combo';

			        $modelOrderDetails->save($detail);
			        $listDetail[$key] = $detail;

			        $checkProduct = $modelCombo->find()->where(array('id'=>$value['id_combo'], 'id_member'=>$infoUser->id_member))->first();

			        if(!empty($checkProduct)){
			            if(!empty($checkProduct->commission_staff_fix)){
			                $money += $checkProduct->commission_staff_fix*$detail->quantity;
			            }elseif(!empty($checkProduct->commission_staff_percent)){
			                $money += (((int)$checkProduct->commission_staff_percent / 100)*$detail->price)*(int)$detail->quantity;
			            }
			        }
			    }
			     $order->list_detail = $listDetail;

			    if($money>0){
			        $agency = $modelAgency->newEmptyEntity();

			        $agency->id_member = @$infoUser->id_member;
			        $agency->id_spa = $infoUser->id_spa;
			        $agency->id_staff = (!empty($dataSend['id_staff']))?(int)$dataSend['id_staff']:$infoUser->id;
			        $agency->id_service = 0;
			        $agency->money = $money;
			        $agency->created_at = $order->time;
			        $agency->note = '';
			        $agency->id_order_detail = 0;
			        $agency->status = 0;
			        $agency->id_order = $order->id;
			        $agency->type = 'sale';

			        $modelAgency->save($agency);
			    }
			     //sử lý phần thanh toán 

			        if($dataSend['type_collection_bill']=='cong_no'){
			            $debt =$modelDebts->newEmptyEntity();

			                            // tạo dữ liệu save
			            $debt->id_member = @$infoUser->id_member;
			            $debt->id_spa = $infoUser->id_spa;
			            $debt->id_staff = (int)@$order->id_staff;
			            $debt->total =  $order->total_pay;
			            $debt->note =  'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
			            $debt->type = 0; //0: Thu, 1: chi
			            $debt->created_at = $order->time;
			            $debt->updated_at = $order->time;
			            $debt->id_order = $order->id;
			            $debt->id_customer = (int)@$dataSend['id_customer'];
			            $debt->full_name = @$infoCustomer->name;
			            $debt->time = time();
			            $modelDebts->save($debt);
			                        
			        }else{
			            // lưu bill
			            $bill = $modelBill->newEmptyEntity();
			            $bill->id_member = @$infoUser->id_member;
			            $bill->id_spa = $session->read('id_spa');
			            $bill->id_staff = (int)@$dataSend['id_staff'];
			            $bill->total = (int)@$dataSend['total_pay'];
			            $bill->note = 'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
		                $bill->type = 0; //0: Thu, 1: chi
		                $bill->id_order = $order->id;
		                $bill->created_at = time();
		                $bill->updated_at = time();
		                $bill->id_customer = (int)@$dataSend['id_customer'];
		                $bill->full_name = @$infoCustomer->name;
		                $bill->moneyReturn = @$dataSend['moneyReturn'];
			            if(empty($dataSend['id_card'])){
			                $bill->type_card = 0;
			                $bill->type_collection_bill = @$dataSend['type_collection_bill'];
			            }else{
			                $bill->type_card = 1;
			                $bill->type_collection_bill = 'the_tra_truoc';
			                $bill->id_card = (int)$dataSend['id_card'];
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
			        	foreach($dataSend['data_order'] as $key => $value){
                        // sản phẩm 
                            // sử lý trử số lương trong kho ở sản phẩm trong combo
			        		$combo = $modelCombo->find()->where(['id'=>$value['id_combo'], 'id_member'=>$infoUser->id_member])->first();
			        		if(!empty($combo->product)){
			        			$combo_product = json_decode($combo->product);
			        			foreach($combo_product as $idProduct => $quantityPro){
			        				$WarehouseProductDetail =   $modelWarehouseProductDetails->find()->where(array('id_product'=>$idProduct, 'inventory_quantity >='=>$quantityPro*$value['quantity'],'id_warehouse'=>$dataSend['id_warehouse'] ))->first();
			        				$WarehouseProductDetail->inventory_quantity -= $quantityPro*$value['quantity'];
			        				$modelWarehouseProductDetails->save($WarehouseProductDetail);
			        				$product = $modelProduct->get($idProduct);
			        				$product->quantity -= $quantityPro*$value['quantity'];
			        				$modelProduct->save($product);
			        			}
			        		}

			        	}
			        }

			  
        		return apiResponse(1,'Tạo đơn thành công',$order);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listOrderComboAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listOrderCombo','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

		        $conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa, 'type'=>'combo');
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('time'=>'desc');

		        if(!empty($dataSend['id'])){
		           $conditions['id']= $dataSend['id']; 
		        }

		        if(!empty($dataSend['id_customer'])){
		           $conditions['id_customer']= $dataSend['id_customer']; 
		        }

		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['time >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['time <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);     
		        }

		        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		              $OrderDetail = $modelOrderDetails->find()->where(['id_order'=>$item->id])->all()->toList();
		              if(!empty($OrderDetail)){
		                foreach($OrderDetail as $k => $value){
		                    $OrderDetail[$k]->combo = $modelCombo->find()->where(['id'=>$value->id_product])->first();
		                }
		                $listData[$key]->OrderDetail = $OrderDetail;
		                $customer = $modelCustomer->find()->where(['id'=>$item->id_customer])->first();
		                if(!empty($customer)){
		                	$conditionscatd =[];
		                    $conditioncard['id_customer'] = $customer->id;
		                    $conditioncard['total >='] = $item->total_pay;
		                                 
		                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
		                    if(!empty($card)){
		                        foreach($card as $k => $value){
		                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
		                            $card[$k] = $value;
		                        }

		                       $customer->card = $card;
		                    }
		                }
		                $listData[$key]->customer = $customer;
		              }
		            }
		        }
		        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
		        $totalMoney = 0;
		        if(!empty($totalData)){
		            foreach($totalData as $key => $item){
		                $totalMoney += $item->total;
		            }
		        }

		        $totalData = count($totalData);

          		return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');    
}

function detailOrderComboAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listOrderCombo','product');
			if(!empty($infoUser)){

		        $modelCombo = $controller->loadModel('Combos');
		        $modelProduct = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelService = $controller->loadModel('Services');
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelBed = $controller->loadModel('Beds');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelAgency = $controller->loadModel('Agencys');
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

		        $conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa, 'type'=>'combo');
				$conditions['id']= $dataSend['id']; 
		       

		        $data = $modelOrder->find()->where($conditions)->first();

		        if(!empty($data)){
		              $OrderDetail = $modelOrderDetails->find()->where(['id_order'=>$data->id])->all()->toList();
		              if(!empty($OrderDetail)){
		                foreach($OrderDetail as $k => $value){
		                    $OrderDetail[$k]->combo = $modelCombo->find()->where(['id'=>$value->id_product])->first();
		                }
		                $data->OrderDetail = $OrderDetail;
		                $customer = $modelCustomer->find()->where(['id'=>$data->id_customer])->first();
		                if(!empty($customer)){
		                    $conditioncard['id_customer'] = $customer->id;
		                    $conditioncard['total >='] = $data->total_pay;
		                                 
		                    $card = $modelCustomerPrepaycards->find()->where($conditioncard)->all()->toList();
		                    if(!empty($card)){
		                        foreach($card as $k => $value){
		                            $value->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$value->id_prepaycard))->first();
		                            $card[$k] = $value;
		                        }

		                       $customer->card = $card;
		                    }
		                }
		                $data->customer = $customer;
		              }
		            }
          		return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}
 ?>

