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
		                $bill->full_name =  @$infoCustomer->name;;
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

 ?>