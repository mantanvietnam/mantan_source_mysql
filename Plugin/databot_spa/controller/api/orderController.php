<?php 
function orderService($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
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
		        $modelCustomerPrepaycards = $controller->loadModel('CustomerPrepaycards');
        
		            // tạo đơn hàng 
		        $order = $modelOrder->newEmptyEntity();
		        $order->id_member = $infoUser->id_member;
		        $order->id_spa =$infoUser->id_spa;
		        $order->id_staff =(int)@$dataSend['id_staff'];
		        $order->id_customer =@$dataSend['id_customer'];
		        $order->full_name = @$dataSend['full_name'];
		        $order->id_bed =@$dataSend['id_bed'];
		        $order->note =@$dataSend['note'];
		        $order->created_at =time();
		        $order->updated_at =time();
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
		            $agency->created_at =time();
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
		                $debt->id_staff = (int)@$dataSend['id_staff'];
		                $debt->total =  $order->total_pay;
		                $debt->note =  'Bán hàng ID đơn hàng là '.$order->id.', người bán là '.$infoUser->name.', thời gian '.date('Y-m-d H:i:s');
		                $debt->type = 0; //0: Thu, 1: chi
		                $debt->created_at =time();
		                $debt->updated_at =time();
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
		                $bill->created_at =time();
		                $bill->updated_at =time();
		                $bill->id_customer = (int)@$dataSend['id_customer'];
		                $bill->full_name = @$dataSend['full_name'];
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
		            }
		        
		        }elseif($dataSend['typeOrder']==3){


  
                    addUserserviceHistories($detail->id,$dataSend['id_bed'],$detail->id_product,$order->time,$dataSend['id_staff']);
                  
                }
            
        		return apiResponse(1,'lấy dữ liệu thành công',$listData,);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}
 ?>