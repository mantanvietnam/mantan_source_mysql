<?php
// tạo đơn hàng khách lẻ
function createOrderCustomerAPI($input)
{
	global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $urlHomes;

    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelCustomers = $controller->loadModel('Customers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
	            if(!empty($dataSend['data_order']) && !empty($dataSend['phone'])){
	            	$dataSend['data_order'] = json_decode($dataSend['data_order'], true);
	                
                	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    $customer_buy = $modelCustomers->find()->where(array('phone'=>$dataSend['phone'], 'id_parent'=>$infoMember->id))->first();

                    if(empty($customer_buy)){
                		$customer_buy = $modelCustomers->find()->where(array('phone'=>$dataSend['phone']))->first();

                		if(!empty($customer_buy)){
                			$customer_buy->id_parent = $infoMember->id;

                			$modelCustomers->save($customer_buy);
                		}
                	}
	                

	                if(empty($customer_buy)){
	                    $customer_buy = $modelCustomers->newEmptyEntity();

                        $customer_buy->full_name = $dataSend['phone'];
                        $customer_buy->phone = $dataSend['phone'];
                        $customer_buy->email = '';
                        $customer_buy->address = '';
                        $customer_buy->id_messenger = '';
                        $customer_buy->id_zalo = '';
                        $customer_buy->id_group = 0;
                        $customer_buy->avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";
                        $customer_buy->status = 'active';
                        $customer_buy->pass = '';
                        $customer_buy->id_parent = $infoMember->id;
                        $customer_buy->birthday_date = 0;
                        $customer_buy->birthday_month = 0;
                        $customer_buy->birthday_year = 0;
                        $customer_buy->created_at = time();

                        $modelCustomers->save($customer_buy);
	                }
	                
	                $save = $modelOrders->newEmptyEntity();

	                $save->id_user = (int) @$customer_buy->id;
	                $save->full_name = @$customer_buy->full_name;
	                $save->email = @$customer_buy->email;
	                $save->phone = @$customer_buy->phone;
	                $save->address = @$customer_buy->address;
	                $save->note_user = $dataSend['note'];
	                $save->note_admin = '';
	                $save->status = 'new';
	                $save->create_at = time();
	                $save->money = (int) $dataSend['total'];
	                $save->total = (int) $dataSend['totalPays'];
	                $save->promotion = (int) $dataSend['promotion'];
	                $save->id_agency = $infoMember->id;

	                $modelOrders->save($save);

	                foreach ($dataSend['data_order'] as $key => $value) {
	                    $saveDetail = $modelOrderDetails->newEmptyEntity();

	                    $saveDetail->id_product = $value['id_product'];
	                    $saveDetail->id_order = $save->id;
	                    $saveDetail->quantity = $value['quantity'];
	                    $saveDetail->price = $value['price'];

	                    $modelOrderDetails->save($saveDetail);
	                }

	                $return = array('code'=>0, 'mess'=>'Tạo yêu cầu nhập hàng thành công', 'id_order'=>$save->id);
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

// xóa đơn hàng khách lẻ
function deleteOrderCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id'])){
                	$data = $modelOrder->find()->where(['id_agency'=>$infoMember->id, 'id'=>(int) $dataSend['id']])->first();
            
		            if($data){
		            	$modelOrderDetail->deleteAll(['id_order'=>$data->id]);
		                $modelOrder->delete($data);

		                $return = array('code'=>0, 'mess'=>'Xóa đơn thành công');
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

// lấy thông tin chi tiết đơn hàng
function getInfoOrderAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelCustomers = $controller->loadModel('Customers');
    $modelMembers = $controller->loadModel('Members');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_order'])){
                    $order = $modelOrders->find()->where(['id'=>(int) $dataSend['id_order'], 'id_agency'=>$infoMember->id])->first();

		            if(!empty($order)){
		                $detail_order = $modelOrderDetails->find()->where(['id_order'=>$order->id])->all()->toList();

		                $order->detail = [];
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $value->product = $modelProducts->find()->where(['id'=>(int) $value->id_product])->first();

		                        $order->detail[$k] = $value;
		                    }
		                }

		                $system = $modelCategories->find()->where(['id'=>(int) $infoMember->id_system])->first();

		                $customer = $modelCustomers->find()->where(['id'=>(int) $order->id_user])->first();

		                $member_sell = $modelMembers->find()->where(['id'=>(int) $order->id_agency])->first();

		                $return = array('code'=>0, 'order'=>$order, 'member_sell'=>$member_sell, 'customer'=>$customer, 'system'=>$system);
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

// cập nhập trạng thái đơn hàng
function updateStatusOrderAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id']) && !empty($dataSend['status'])){
		            $order = $modelOrder->find()->where(['id_agency'=>$infoMember->id, 'id'=>(int) $dataSend['id'] ])->first();

		            if(!empty($order)){
	                    $order->status = $dataSend['status'];

	                    $modelOrder->save($order);

	                    // xuất hàng khỏi kho
	                    if($dataSend['status'] == 'done'){
	                        $detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();
            
	                        if(!empty($detail_order)){
	                            foreach ($detail_order as $k => $value) {
	                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_agency])->first();

	                                if(empty($checkProductExits)){
	                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
	                                    $checkProductExits->quantity = 0;
	                                }

	                                $checkProductExits->id_member = $order->id_agency;
	                                $checkProductExits->id_product = $value->id_product;
	                                $checkProductExits->quantity -= $value->quantity;

	                                $modelWarehouseProducts->save($checkProductExits);

	                                // lưu lịch sử xuất kho
	                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

	                                $saveWarehouseHistories->id_member = $order->id_agency;
	                                $saveWarehouseHistories->id_product = $value->id_product;
	                                $saveWarehouseHistories->quantity = $value->quantity;
	                                $saveWarehouseHistories->note = 'Bán cho khách hàng '.$order->full_name.' '.$order->phone;
	                                $saveWarehouseHistories->create_at = time();
	                                $saveWarehouseHistories->type = 'minus';
	                                $saveWarehouseHistories->id_order = $order->id;

	                                $modelWarehouseHistories->save($saveWarehouseHistories);
	                            }
	                        }
	                    }

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