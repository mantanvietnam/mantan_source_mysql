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

                    $customer_buy = $modelCustomers->find()->where(array('phone'=>$dataSend['phone']))->first();

	                if(empty($customer_buy)){
	                    $customer_buy = createCustomerNew($dataSend['phone'], $dataSend['phone'], '', '', 0, 0, $infoMember->id);
	                }

                    // lưu bảng đại lý
                    saveCustomerMember($customer_buy->id, $infoMember->id);
                    
	                // tạo đơn hàng mới
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


// api tạo đơn hàng ở trang info
function paycreateOrderCustomerPAI($input){
	global $session;
	global $controller;
	global $isRequestPost;
	global $session;
	global $metaTitleMantan;
	
	$modelProduct = $controller->loadModel('Products');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelOrder = $controller->loadModel('Orders');
	$modelOrderDetail = $controller->loadModel('OrderDetails');
	$modelCustomers = $controller->loadModel('Customers');
	
	$pay = array();
	$return = array();

	$list_product = (!empty($session->read('product_order')))?$session->read('product_order'):[];
	

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		$infoUser = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

		if(empty($infoUser)){
			if(function_exists('createCustomerNew')){
				if(!empty($dataSend['birthday'])){
                    $birthday = explode('/', $dataSend['birthday']);

                    if(count($birthday) == 3){
                        $dataSend['birthday_date'] = (int) $birthday[0];
                        $dataSend['birthday_month'] = (int) $birthday[1];
                        $dataSend['birthday_year'] = (int) $birthday[2];
                    }
                }
				
				$infoUser = createCustomerNew(@$dataSend['full_name'], @$dataSend['phone'], @$dataSend['email'], @$dataSend['address'], @$dataSend['sex'], @$dataSend['id_city'], @$dataSend['id_agency'], @$dataSend['id_aff'], @$dataSend['name_agency'], @$dataSend['id_messenger'], @$dataSend['avatar'], @$dataSend['birthday_date'], @$dataSend['birthday_month'], @$dataSend['birthday_year']);
			}
		}

		$data = $modelOrder->newEmptyEntity();

		$data->id_user = (!empty($infoUser->id))?$infoUser->id:0;
		$data->full_name = @$dataSend['full_name'];
		$data->email = @$dataSend['email'];
		$data->phone = @$dataSend['phone'];
		$data->address = @$dataSend['address'];
		$data->note_user = @$dataSend['note_user'];
		$data->payment = @$dataSend['payment'];
		$data->note_admin = '';
		$data->status = 'new';
		$data->create_at = time();
		$data->id_agency = (int) @$dataSend['id_agency'];
		$data->money = (int) @$dataSend['money'];
		$data->total = (int) @$dataSend['total'];
		$data->id_aff = (int) @$dataSend['id_aff'];

	
		if(!empty($dataSend['codeDiscount'])){
			$discount = array( 'code1' => $dataSend['codeDiscount']);
			$data->discount = json_encode($discount);

			$pay = array('code1'=>$dataSend['codeDiscount'],'discount_price1'=>$dataSend['discount']);
		}

		$modelOrder->save($data);

		// tạo chi tiết đơn hàng
		$listproduct = array();
		foreach($list_product as $product){
			if(@$product->statuscart=='true'){
				$listproduct[] = $product;
				$dataDetail = $modelOrderDetail->newEmptyEntity();

				$dataDetail->id_product = $product->id;
				$dataDetail->quantity = $product->numberOrder;
				$dataDetail->id_order = $data->id;
				$dataDetail->price = $product->price;

				$modelOrderDetail->save($dataDetail);

				$prod = $modelProduct->get($product->id);

				$prod->quantity -= $product->numberOrder;
				$prod->sold += $product->numberOrder;

				$modelProduct->save($prod);
			}
		}

		// gửi cho khách 
		if(!empty($dataSend['email'])){
			getContentEmailOrderSuccess(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data);
		}

		// gửi cho admin
		getContentEmailAdmin(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data);
		
		$session->write('product_order', []);

		if(function_exists('getOrderLarkSuite')){
			getOrderLarkSuite($data->id);
		}

		if(function_exists('calculateAffiliate')){
			calculateAffiliate($data->total, $data->id);
		}

		if(function_exists('sendZNSDataBot')){
			$product_name = implode(',', $product_name);
			$product_name = substr($product_name, 0, 100);
			$agency = @$dataSend['name_agency'];
			$name_system = @$dataSend['name_system'];

			sendZNSDataBot($data, $product_name, $name_system, $agency);
		}

		// gửi cho đại lý
        if(!empty($dataSend['id_agency']) && function_exists('sendNotification')){
            $modelTokenDevices = $controller->loadModel('TokenDevices');
            $modelMembers = $controller->loadModel('Members');

            $infoMember = $modelMembers->find()->where(['id'=>$dataSend['id_agency']])->first();

            if(!empty($infoMember->noti_new_order)){
                $dataSendNotification= array('title'=>'Đơn hàng mới','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$data->id.' của khách hàng '.$data->full_name.' trị giá '.number_format($data->total).'đ','action'=>'createOrder','id_order'=>$data->id);
                $token_device = [];

                $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

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

            if(!empty($infoMember->email)){
            	getContentEmailAdmin(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data, $infoMember->email);
            }
        }
        $return = array('code'=>1, 'mess'=>'Gửi đơn hàng thành công');
	}else{
		 $return = array('code'=>2, 'mess'=>'chuyền phương thức POST');
	}
	return $return;

	// setVariable('list_product', $list_product);
	// setVariable('pay', $pay);
	// setVariable('discountCode', $discountCode);

}
?>