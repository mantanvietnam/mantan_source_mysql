<?php
function getListOrderMemberAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
    $modelUnitConversion = $controller->loadModel('UnitConversions');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'orderMemberAgency');

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $conditions = array('id_member_sell'=>$infoMember->id);
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($dataSend['id'])){
		            $conditions['id'] = (int) $dataSend['id'];
		        }

		        if(!empty($dataSend['status_pay'])){
		            $conditions['status_pay'] = $dataSend['status_pay'];
		        }

		        if(!empty($dataSend['status'])){
		            $conditions['status'] = $dataSend['status'];
		        }

		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		                
		        }

		        if(!empty($dataSend['phone'])){
		            $checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone'] ])->first();

		            if(!empty($checkMember)){
		                $conditions['id_member_buy'] = $checkMember->id;
		            }else{
		                $conditions['id_member_buy'] = -1;
		            }
		        }

                $listData = $modelOrderMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
		                        if(!empty($product)){
		                            $detail_order[$k]->product = $product->title;

		                            if(!empty($value->id_unit)){
		                            	$unit = $modelUnitConversion->find()->where(['id'=>$value->id_unit ])->first();
		                            	if(!empty($unit)){
		                            		$detail_order[$k]->unit = @$unit->unit;
		                            	}
			                        }else{
			                        	$detail_order[$k]->unit = @$product->unit;
			                        }
		                        }


		                    }

		                    $listData[$key]->detail_order = $detail_order;
		                }else{
		                	$listData[$key]->detail_order = [];
		                }

		                $listData[$key]->buyer = $modelMembers->find()->where(['id'=>$item->id_member_buy ])->first();
		            }
		        }
                
                $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function updateStatusOrderMemberAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelBill = $controller->loadModel('Bills');
    $modelDebt = $controller->loadModel('Debts');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
    $modelUnitConversion = $controller->loadModel('UnitConversions');
    $modelTokenDevices = $controller->loadModel('TokenDevices');
	$modelTransactionAgencyHistorie = $controller->loadModel('TransactionAgencyHistories');
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'updateOrderMemberAgency');

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($dataSend['id'])){
		            $order = $modelOrderMembers->find()->where(['id'=>(int) $dataSend['id'], 'id_member_sell'=>$infoMember->id])->first();

		            if(!empty($order)){
		            	$infoMemberBuy = $modelMembers->find()->where(['id'=>$order->id_member_buy])->first();
		                if(!empty($dataSend['status'])){
		                    $order->status = $dataSend['status'];

		                    // nhập hàng vào kho
		                    if($dataSend['status'] == 'done'){
		                        $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();
		                
		                        if(!empty($detail_order)){
		                            foreach ($detail_order as $k => $value) {
		                            	$quantity = $value->quantity;
		                            	if(!empty($value->id_unit)){
		                                    $unit = $modelUnitConversion->find()->where(['id_product'=>$value->id_product,'id'=>$value->id_unit])->first();
		                                    if(!empty($unit)){
		                                        $quantity = $value->quantity*$unit->quantity;
		                                    }
		                                }

		                                // cộng hàng vào kho người mua
		                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_buy])->first();

		                                if(empty($checkProductExits)){
		                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
		                                    $checkProductExits->quantity = 0;
		                                }

		                                $checkProductExits->id_member = $order->id_member_buy;
		                                $checkProductExits->id_product = $value->id_product;
		                                $checkProductExits->quantity += $quantity;

		                                $modelWarehouseProducts->save($checkProductExits);

		                                // trừ hàng trong kho người bán
		                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_sell])->first();

		                                if(empty($checkProductExits)){
		                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
		                                    $checkProductExits->quantity = 0;
		                                }

		                                $checkProductExits->id_member = $order->id_member_sell;
		                                $checkProductExits->id_product = $value->id_product;
		                                $checkProductExits->quantity -= $quantity;

		                                $modelWarehouseProducts->save($checkProductExits);

		                                // lưu lịch sử nhập kho của người mua
		                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

		                                $saveWarehouseHistories->id_member = $order->id_member_buy;
		                                $saveWarehouseHistories->id_product = $value->id_product;
		                                $saveWarehouseHistories->quantity = $quantity;
		                                $saveWarehouseHistories->note = 'Nhập hàng vào kho';
		                                $saveWarehouseHistories->create_at = time();
		                                $saveWarehouseHistories->type = 'plus';
		                                $saveWarehouseHistories->id_order_member = $order->id;

		                                $modelWarehouseHistories->save($saveWarehouseHistories);

		                                // lưu lịch sử xuất kho của người bán
		                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

		                                $saveWarehouseHistories->id_member = $order->id_member_sell;
		                                $saveWarehouseHistories->id_product = $value->id_product;
		                                $saveWarehouseHistories->quantity = $quantity;
		                                $saveWarehouseHistories->note = 'Xuất hàng cho đại lý tuyến dưới';
		                                $saveWarehouseHistories->create_at = time();
		                                $saveWarehouseHistories->type = 'minus';
		                                $saveWarehouseHistories->id_order_member = $order->id;

		                                $modelWarehouseHistories->save($saveWarehouseHistories);
		                            }
		                        }
		                    	$note = $infoMember->type_tv.' '. $infoMember->name.' đã xử lý hoàn thành đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;

		                    }elseif($dataSend['status'] == 'browser'){
		                     	$note = $infoMember->type_tv.' '. $infoMember->name.' đã xử lý phê duyệt đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
		                    }elseif($dataSend['status'] == 'delivery'){
		                     	$note = $infoMember->type_tv.' '. $infoMember->name.' đã xử lý giao hàng đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
		                    }elseif($dataSend['status'] == 'cancel'){
		                     	$note = $infoMember->type_tv.' '. $infoMember->name.' đã xử lý hủy đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
		                    }
		                }

		                if(!empty($dataSend['status_pay'])){
		                    $order->status_pay = $dataSend['status_pay'];

		                    // thanh toán 
		                    if($dataSend['status_pay'] == 'done'){
		                        // thông báo cho người mua

		                        if(!empty($infoMemberBuy->noti_new_order)){
		                            $dataSendNotification= array('title'=>'Thanh toán thành công','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của bạn đã được thanh toán thành công số tiền '.number_format($order->total).'đ','action'=>'deleteProductWarehouse','id_order_member'=>$order->id);
		                            $token_device = [];

		                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberBuy->id])->all()->toList();

		                            if(!empty($listTokenDevice)){
		                                foreach ($listTokenDevice as $tokenDevice) {
		                                    if(!empty($tokenDevice->token_device)){
		                                        $token_device[] = $tokenDevice->token_device;
		                                    }
		                                }

		                                if(!empty($token_device)){
		                                    $return = sendNotification($dataSendNotification, $token_device);
		                                }
		                            }
		                        }

		                        // thông báo cho người bán
		                        $infoMemberSell = $modelMembers->find()->where(['id'=>$order->id_member_sell])->first();

		                        if(!empty($infoMemberSell->noti_product_warehouse)){
		                            $dataSendNotification= array('title'=>'Thanh toán thành công','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$order->id.' của đại lý '.$infoMemberBuy->name.' đã được thanh toán thành công số tiền '.number_format($order->total).'đ','action'=>'deleteProductWarehouse','id_order_member'=>$order->id);
		                            $token_device = [];

		                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMemberSell->id])->all()->toList();

		                            if(!empty($listTokenDevice)){
		                                foreach ($listTokenDevice as $tokenDevice) {
		                                    if(!empty($tokenDevice->token_device)){
		                                        $token_device[] = $tokenDevice->token_device;
		                                    }
		                                }

		                                if(!empty($token_device)){
		                                    $return = sendNotification($dataSendNotification, $token_device);
		                                }
		                            }
		                        }
		                        $time= time();
		                        if($dataSend['type_collection_bill']!='cong_no'){

		                            // bill cho người bán 
		                            $bill = $modelBill->newEmptyEntity();
		                            $bill->id_member_sell =  $infoMember->id;
		                            $bill->id_member_buy = $order->id_member_buy;
		                            $bill->total = $order->total;
		                            $bill->id_order = $order->id;
		                            $bill->type = 1;
		                            $bill->type_order = 1; 
		                            $bill->created_at = $time;
		                            $bill->updated_at = $time;
		                            $bill->id_debt = 0;
		                            $bill->type_collection_bill =  @$dataSend['type_collection_bill'];
		                            $bill->id_customer = 0;
		                            $bill->note = 'Thanh toán đơn hàng id:'.$order->id.' bán cho đại lý '.@$infoMemberBuy->name.' '.@$infoMemberBuy->phone.'; '.@$dataSend['note'];
		                            $modelBill->save($bill);

		                            // bill cho người mua
		                            $billbuy = $modelBill->newEmptyEntity();
		                            $billbuy->id_member_sell =  $infoMember->id;
		                            $billbuy->id_member_buy = $order->id_member_buy;
		                            $billbuy->total = $order->total;
		                            $billbuy->id_order = $order->id;
		                            $billbuy->type = 2;
		                            $billbuy->type_order = 1; 
		                            $billbuy->created_at = $time;
		                            $billbuy->updated_at = $time;
		                            $billbuy->id_debt = 0;
		                            $billbuy->type_collection_bill =  @$dataSend['type_collection_bill'];
		                            $billbuy->id_customer = 0;
		                            $billbuy->note = 'Thanh toán đơn hàng id:'.$order->id.' mua của đại lý '.@$infoMemberSell->name.' '.@$infoMemberSell->phone.'; '.@$dataSend['note'];
		                            $modelBill->save($billbuy);
		                        }else{
		                            if(!empty($infoMemberBuy)){
		                                $debt = $modelDebt->newEmptyEntity();
		                                $debt->id_member_sell =  $infoMember->id;
		                                $debt->id_member_buy = $order->id_member_buy;
		                                $debt->total = $order->total;
		                                $debt->id_order = $order->id;
		                                $debt->number_payment = 0;
		                                $debt->total_payment = 0;
		                                $debt->type = 1;
		                                $debt->status = 0;
		                                $debt->type_order = 1; 
		                                $debt->created_at = $time;
		                                $debt->updated_at = $time;
		                                $debt->id_customer = 0;
		                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' bán cho đại lý '.@$infoMemberBuy->name.' '.@$infoMemberBuy->phone.'; '.@$dataSend['note'];
		                                    $modelDebt->save($debt);
		                            }

		                            	$debt = $modelDebt->newEmptyEntity();
		                                $debt->id_member_sell =  $infoMember->id;
		                                $debt->id_member_buy = $order->id_member_buy;
		                                $debt->total = $order->total;
		                                $debt->id_order = $order->id;
		                                $debt->number_payment = 0;
		                                $debt->total_payment = 0;
		                                $debt->type = 2;
		                                $debt->status = 0;
		                                $debt->type_order = 1; 
		                                $debt->created_at = $time;
		                                $debt->updated_at = $time;
		                                $debt->id_customer = 0;
		                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' mua của đại lý '.@$infoMemberSell->name.' '.@$infoMemberSell->phone.'; '.@$dataSend['note'];
		                                    $modelDebt->save($debt);
		                        }

		                        // cộng hoa hông cho đại lý giời thiệu
		                        if(!empty($infoMemberBuy->id_agency_introduce) && !empty($infoMemberBuy->id_father)  && !empty($infoMember->agent_commission) && !empty($order->total)){
		                            if($infoMemberBuy->id_father == $infoMember->id){


		                                $money_back = $infoMember->agent_commission * $order->total / 100;
		                
		                                // lưu lịch sử trích hoa hồng
		                                $saveBack = $modelTransactionAgencyHistorie->newEmptyEntity();
		                
		                                $saveBack->id_agency_introduce = $infoMemberBuy->id_agency_introduce;
		                                $saveBack->money_total = $order->total;
		                                $saveBack->money_back = $money_back;
		                                $saveBack->percent = $infoMember->agent_commission;
		                                $saveBack->id_order_member = $order->id;
		                                $saveBack->create_at = time();
		                                $saveBack->status = 'new';
		                                $saveBack->id_member = $infoMember->id;
		                                $modelTransactionAgencyHistorie->save($saveBack);

		                            }
		                        }

		                        $note = $infoMember->type_tv.' '. $infoMember->name.' đã xử lý Thanh toán đơn hàng cho đại lý '.$infoMemberBuy->name.'('.$infoMemberBuy->phone.') có id đơn là:'.$order->id;
		                    }

		                }

		                addActivityHistory($infoMember,$note,'updateOrderMemberAgency',$order->id);

		                $modelOrderMembers->save($order);

		                $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công');
		            }else{
		            	$return = array('code'=>4, 'mess'=>'Không tìm thấy đơn hàng');
		            }
		        }else{
		            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		        }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu!');
        }
    }

    return $return;
}

function getInfoOrderMemberAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'orderMemberAgency');

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($dataSend['id_order_member'])){
                    $order = $modelOrderMembers->find()->where(['id'=>(int) $dataSend['id_order_member'], 'id_member_sell'=>$infoMember->id])->first();

		            if(!empty($order)){
		                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();

		                $order->detail = [];
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $value->product = $modelProducts->find()->where(['id'=>(int) $value->id_product])->first();

		                        $order->detail[$k] = $value;
		                    }
		                }

		                $system = $modelCategories->find()->where(['id'=>(int) $infoMember->id_system])->first();

		                $member_sell = $modelMembers->find()->where(['id'=>(int) $order->id_member_sell])->first();
		                $member_buy = $modelMembers->find()->where(['id'=>(int) $order->id_member_buy])->first();

		                $return = array('code'=>0, 'order'=>$order, 'member_sell'=>$member_sell, 'member_buy'=>$member_buy, 'system'=>$system);
		            }else{
		                $return = array('code'=>4, 'mess'=>'Không tìm thấy đơn hàng');
		            }
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function createOrderMemberAPI($input)
{
	global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if((!empty($dataSend['token']) && !empty($dataSend['phone'])) && !empty($dataSend['data_order'])){
        	$infoMember = getMemberByToken($dataSend['token'],'addOrderAgency');
        	if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }
        		$dataSend['data_order'] = json_decode($dataSend['data_order'], true);
	        	if(!empty($dataSend['data_order'])){		          
		            	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
		        		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		            	$member_buy = $modelMembers->find()->where(['phone'=>$dataSend['phone']])->first();
		            

		            if(!empty($member_buy)){
		            	$member_sell = $modelMembers->find()->where(['id'=>$member_buy->id_father])->first();

		                $save = $modelOrderMembers->newEmptyEntity();

		                $save->id_member_sell = $member_buy->id_father; // id người bán
		                $save->id_member_buy = $member_buy->id; // id người mua
		                $save->note_sell = '';
		                if($infoMember->id==$member_buy->id_father){
                        	$save->id_staff_sell = $infoMember->id_staff;
                    	}
		                $save->note_buy = @$dataSend['note']; // ghi chú người mua  
		                $save->status = 'new';
		                $save->create_at = time();
		                $save->money = (int) $dataSend['total'];
		                $save->total = (int) $dataSend['totalPays'];
		                $save->status_pay = 'wait';
		                $save->discount = $dataSend['promotion'];

		                $save->costsIncurred = '[]'; // phụ phí
		                $save->total_costsIncurred = 0;

		                $modelOrderMembers->save($save);

		                $productDetail = [];

		                foreach ($dataSend['data_order'] as $key => $value) {
		                    $saveDetail = $modelOrderMemberDetails->newEmptyEntity();

		                    $saveDetail->id_product = (int) $value['id_product'];
		                    $saveDetail->id_order_member = $save->id;
		                    $saveDetail->quantity = (int) @$value['quantity'];
		                    $saveDetail->price = (int) @$value['price'];
		                    $saveDetail->id_unit = (!empty($value['id_unit']))?(int)$value['id_unit']:0;
		                    $saveDetail->discount = (int) @$value['discount'];

		                    $modelOrderMemberDetails->save($saveDetail);

		                    $infoProduct = $modelProducts->find()->where(['id'=>$value['id_product']])->first();

	                    	$productDetail[] = @$infoProduct->title;
		                }
		                $productDetail = implode(',', $productDetail);

		                // gửi thông báo Zalo cho đại lý
		                if(!empty($member_buy->id) && !empty($member_sell->id)){
		                    sendZaloUpdateOrder($member_sell, $member_buy, $save, $productDetail);
		                }

		                $note = $infoMember->type_tv.' '. $infoMember->name.' tạo đơn hàng cho đại lý '.$member_buy->name.'('.$member_buy->phone.') có id đơn là:'.$save->id;

                    	addActivityHistory($infoMember,$note,'addOrderAgency',$save->id);

		                $return = array('code'=>1, 'mess'=>'Tạo đơn hàng đại lý thành công', 'id_order'=>$save->id);
		            }else{
		                 $return = array('code'=>3, 'mess'=>'Sai số điện thoại');
		            }
		        }else{
		        	$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		        }
		    }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getListOrderMemberTodayAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'orderMemberAgency');

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
              
            	// Thời gian đầu ngày
                $startOfDay = strtotime("today 00:00:00");
                // Thời gian cuối ngày
                $endOfDay = strtotime("tomorrow 00:00:00") - 1;
                    

                $conditions = array('id_member_sell'=>$infoMember->id,  'create_at >='=>$startOfDay,'create_at <='=>$endOfDay);
                $order = array('id'=>'desc');
                $listData = $modelOrderMembers->find()->where($conditions)->order($order)->all()->toList();
		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
		                        if(!empty($product)){
		                            $detail_order[$k]->product = $product->title;

		                            if(!empty($value->id_unit)){
		                            	$unit = $modelUnitConversion->find()->where(['id'=>$value->id_unit ])->first();
		                            	if(!empty($unit)){
		                            		$detail_order[$k]->unit = $unit->unit;
		                            	}
			                        }else{
			                        	$detail_order[$k]->unit = $product->unit;
			                        }
		                        }
		                    }

		                    $listData[$key]->detail_order = $detail_order;
		                }else{
		                	$listData[$key]->detail_order = [];
		                }

		                $listData[$key]->buyer = $modelMembers->find()->where(['id'=>$item->id_member_buy ])->first();
		            }
		        }
                
                $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                 $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function listTransactionAgencyHistorieAPI(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Lịch sử giao dịch';

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listTransactionAgencyHistorie');

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }

		        $modelMember = $controller->loadModel('Members');

		        $modelTransactionAgencyHistorie = $controller->loadModel('TransactionAgencyHistories');


		        $conditions = array('id_member'=>$infoMember->id);
		        $limit = 20;
		        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		        if($page<1) $page = 1;
		        $order = array('id'=>'desc');

		        if(!empty($_GET['id'])){
		            $conditions['id'] = (int) $_GET['id'];
		        }

		        if(!empty($_GET['id_agency_introduce'])){
		            $conditions['id_agency_introduce'] = (int) $_GET['id_agency_introduce'];
		        }

		        if(!empty($_GET['id_order_member'])){
		            $conditions['id_order_member'] = (int) $_GET['id_order_member'];
		        }

		        if(!empty($_GET['status'])){
		            $conditions['status'] = $_GET['status'];
		        }

		       
		        $listData = $modelTransactionAgencyHistorie->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach ($listData as $key => $value) {
		                $listData[$key]->agency = $modelMember->find()->where(['id'=>$value->id_agency_introduce])->first();
		            }
		        }
		       
		        // phân trang
		        $totalData = $modelTransactionAgencyHistorie->find()->where($conditions)->all()->toList();
		        $totalData = count($totalData);

         		$return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                 $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

// tự cập nhập trạng thái đơn hàng của mình
function updateMyOrderMemberAgencyAPI($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
	global $metaTitleMantan;
	global $isRequestPost;

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token'],'updateMyOrderMemberAgency');
			if(!empty($infoMember)){
				if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }

				$modelMembers = $controller->loadModel('Members');
				$modelProducts = $controller->loadModel('Products');
				$modelOrderMembers = $controller->loadModel('OrderMembers');
				$modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
				$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
				$modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
				$modelUnitConversion = $controller->loadModel('UnitConversions');

				if(!empty($dataSend['id'])){
					$order = $modelOrderMembers->find()->where(['id'=>(int) $dataSend['id'], 'id_member_buy'=>$infoMember->id])->first();

					if(!empty($order)){
						$note = '';
						if(!empty($dataSend['status'])){
							$order->status = $dataSend['status'];

                    // nhập hàng vào kho
							if($dataSend['status'] == 'done'){
								$detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();

								if(!empty($detail_order)){
									foreach ($detail_order as $k => $value) {
										$quantity = $value->quantity;
										if(!empty($value->id_unit)){
											$unit = $modelUnitConversion->find()->where(['id_product'=>$value->id_product,'id'=>$value->id_unit])->first();
											if(!empty($unit)){
												$quantity = $value->quantity*$unit->quantity;
											}
										}

                                // cộng hàng vào kho người mua
										$checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_buy])->first();

										if(empty($checkProductExits)){
											$checkProductExits = $modelWarehouseProducts->newEmptyEntity();
											$checkProductExits->quantity = 0;
										}

										$checkProductExits->id_member = $order->id_member_buy;
										$checkProductExits->id_product = $value->id_product;
										$checkProductExits->quantity += $quantity;

										$modelWarehouseProducts->save($checkProductExits);

                                // trừ hàng trong kho người bán
										$checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_sell])->first();

										if(empty($checkProductExits)){
											$checkProductExits = $modelWarehouseProducts->newEmptyEntity();
											$checkProductExits->quantity = 0;
										}

										$checkProductExits->id_member = $order->id_member_sell;
										$checkProductExits->id_product = $value->id_product;
										$checkProductExits->quantity -= $quantity;

										$modelWarehouseProducts->save($checkProductExits);

                                // lưu lịch sử nhập kho của người mua
										$saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

										$saveWarehouseHistories->id_member = $order->id_member_buy;
										$saveWarehouseHistories->id_product = $value->id_product;
										$saveWarehouseHistories->quantity = $quantity;
										$saveWarehouseHistories->note = 'Nhập hàng vào kho';
										$saveWarehouseHistories->create_at = time();
										$saveWarehouseHistories->type = 'plus';
										$saveWarehouseHistories->id_order_member = $order->id;

										$modelWarehouseHistories->save($saveWarehouseHistories);

                                // lưu lịch sử xuất kho của người bán
										$saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

										$saveWarehouseHistories->id_member = $order->id_member_sell;
										$saveWarehouseHistories->id_product = $value->id_product;
										$saveWarehouseHistories->quantity = $quantity;
										$saveWarehouseHistories->note = 'Xuất hàng cho đại lý tuyến dưới';
										$saveWarehouseHistories->create_at = time();
										$saveWarehouseHistories->type = 'minus';
										$saveWarehouseHistories->id_order_member = $order->id;

										$modelWarehouseHistories->save($saveWarehouseHistories);
									}
								}
							}

						}
						$modelOrderMembers->save($order);

						$return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công');
					}else{
						$return = array('code'=>4, 'mess'=>'Không tìm thấy đơn hàng');
					}
				}else{
					$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
				}
			}else{
				$return = array('code'=>3, 'mess'=>'Sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

       

function payTransactionAgencyAPI($input)
{
    global $controller;
    global $session;
    $modelMember = $controller->loadModel('Members');
    $modelTransactionAgencyHistorie = $controller->loadModel('payTransactionAgency');
    $modelBill = $controller->loadModel('Bills');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'payTransactionAgencys');

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }
		        $data = $modelTransactionAgencyHistorie->get($dataSend['id']);
		        
		        if(!empty($data)){
		            $aff = $modelMember->get($data->id_agency_introduce);
		            $data->status = 'done';

		            $modelTransactionAgencyHistorie->save($data);
		            $time= time();
		             // bill cho người mua
		            $billbuy = $modelBill->newEmptyEntity();
		            $billbuy->id_member_sell = $data->id_agency_introduce;
		            $billbuy->id_member_buy =  $infoMember->id;
		            $billbuy->total = $data->money_back;
		            $billbuy->id_order = $data->id;
		            $billbuy->type = 2;
		            $billbuy->type_order = 6; 
		            $billbuy->created_at = $time;
		            $billbuy->updated_at = $time;
		            $billbuy->id_debt = 0;
		            $billbuy->type_collection_bill =  @$dataSend['type_collection_bill'];
		            $billbuy->id_customer = 0;
		            $billbuy->id_aff = 0;
		            $billbuy->note = 'Thanh toán chiết khấu hoa hông cho đại lý giới thiệu tên là '.@$aff->name.' '.@$aff->phone.'  giao dịch có id '.$data->id;
		            $modelBill->save($billbuy);

		             $billbuy = $modelBill->newEmptyEntity();
		            $billbuy->id_member_sell = $data->id_agency_introduce;
		            $billbuy->id_member_buy =  $infoMember->id;
		            $billbuy->total = $data->money_back;
		            $billbuy->id_order = $data->id;
		            $billbuy->type = 1;
		            $billbuy->type_order = 6; 
		            $billbuy->created_at = $time;
		            $billbuy->updated_at = $time;
		            $billbuy->id_debt = 0;
		            $billbuy->type_collection_bill =  @$dataSend['type_collection_bill'];
		            $billbuy->id_customer = 0;
		            $billbuy->id_aff = 0;
		            $billbuy->note = 'Bạn nhận hoa hồng của người đại lý '.@$infoMember->name.' '.@$infoMember->phone.', do bạn giới thiệu giao dịch có id '.$data->id;
		            $modelBill->save($billbuy);
		        }
		    }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

?>