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

	                $productDetail = [];

	                foreach ($dataSend['data_order'] as $key => $value) {
	                    $saveDetail = $modelOrderDetails->newEmptyEntity();

	                    $saveDetail->id_product = $value['id_product'];
	                    $saveDetail->id_order = $save->id;
	                    $saveDetail->quantity = $value['quantity'];
	                    $saveDetail->price = $value['price'];
	                    $saveDetail->id_unit = (!empty($value['id_unit']))?(int)$value['id_unit']:0;

	                    $modelOrderDetails->save($saveDetail);

	                    $infoProduct = $modelProducts->find()->where(['id'=>$value])->first();
                    	$productDetail[] = $infoProduct->title;
	                }

	                $productDetail = implode(',', $productDetail);

	                // gửi thông báo Zalo cho khách
	                if(!empty($customer_buy->id)){
	                    sendZaloUpdateOrder($infoMember, $customer_buy, $save, $productDetail);
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
    $modelBill = $controller->loadModel('Bills');
    $modelDebt = $controller->loadModel('Debts');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
    $modelCustomers = $controller->loadModel('Customers'); 
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');

    $return = array('code'=>1);
    
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
            	$system = $modelCategories->find()->where(array('id'=>$infoMember->id_system ))->first();

			    if(!empty($system->description)){
			        $description = json_decode($system->description, true);
			        $convertPoint = (int) $description['convertPoint'];
			    }
                if(!empty($dataSend['id']) && !empty($dataSend['status'])){
		            $order = $modelOrder->find()->where(['id_agency'=>$infoMember->id, 'id'=>(int) $dataSend['id'] ])->first();

		            if(!empty($order)){
	                    $order->status = $dataSend['status'];

	                    

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

	                    // tạo phiêu thu 
		                if(!empty($dataSend['status_pay'])){
		                    $order->status_pay = $dataSend['status_pay'];
		                    $time = time();
		                    if($_GET['status_pay']=='done'){
		                        $customer = $modelCustomers->find()->where(['id'=>(int) $order->id_user])->first();
		                        if($dataSend['type_collection_bill']!='cong_no'){
		                            $bill = $modelBill->newEmptyEntity();
		                            $bill->id_member_sell =  $infoMember->id;
		                            $bill->id_member_buy = 0;
		                            $bill->total = $order->total;
		                            $bill->id_order = $order->id;
		                            $bill->type = 1;
		                            $bill->type_order = 2; 
		                            $bill->created_at = $time;
		                            $bill->updated_at = $time;
		                            $bill->id_debt = 0;
		                            $bill->type_collection_bill =  @$dataSend['type_collection_bill'];
		                            $bill->id_customer = $order->id_user;
		                            $bill->note = 'Thanh toán đơn hàng id:'.$order->id.' của khách '.@$customer->full_name.' '.@$customer->phone.'; '.@$dataSend['note'];
		                            $modelBill->save($bill);

		                            if(!empty($convertPoint)){
		                                $point = intval($order->total / $convertPoint);

		                                $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$infoMember->id, 'id_customer'=>$order->id_user])->first();

		                                if(!empty($checkPointCustomer)){
		                                    $checkPointCustomer->point += (int)$point;
		                                }else{
		                                    $checkPointCustomer= $modelPointCustomer->newEmptyEntity();
		                                    $checkPointCustomer->point = (int) $point;
		                                    $checkPointCustomer->id_member = $infoMember->id;
		                                    $checkPointCustomer->id_customer = $order->id_user;
		                                    $checkPointCustomer->created_at = $time;
		                                    $checkPointCustomer->id_rating = 0;
		                                }
		                                $rating = $modelRatingPointCustomer->find()->where(['point_min <=' => $checkPointCustomer->point])->order(['point_min' => 'DESC'])->first();
		                                if(!empty($rating)){
		                                    $checkPointCustomer->id_rating = $rating->id;
		                                }
		                                $modelPointCustomer->save($checkPointCustomer);
		                            }
		                        }else{
		                            if(!empty($customer)){
		                                $debt = $modelDebt->newEmptyEntity();
		                                $debt->id_member_sell =  $infoMember->id;
		                                $debt->id_member_buy = 0;
		                                $debt->total = $order->total;
		                                $debt->id_order = $order->id;
		                                $debt->number_payment = 0;
		                                $debt->total_payment = 0;
		                                $debt->type = 0;
		                                $debt->status = 0;
		                                $debt->type_order = 2; 
		                                $debt->created_at = $time;
		                                $debt->updated_at = $time;
		                                $debt->id_customer = $order->id_user;
		                                $debt->note = 'Thanh toán đơn hàng id:'.$order->id.' của khách '.@$customer->full_name.' '.@$customer->phone.'; '.@$dataSend['note'];
		                                    $modelDebt->save($debt);
		                            }
		                        }
		                    }
		                }

                		$modelOrder->save($order);

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

// api lấy danh sách đơn hàng khách lẻ hôm nay 
function getListOrderCustomerTodayAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCustomers = $controller->loadModel('Customers');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelUnitConversion = $controller->loadModel('UnitConversions');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
            	// Thời gian đầu ngày
                $startOfDay = strtotime("today 00:00:00");
                // Thời gian cuối ngày
                $endOfDay = strtotime("tomorrow 00:00:00") - 1;
                    

                $conditions = array('id_agency'=>$infoMember->id,  'create_at >='=>$startOfDay,'create_at <='=>$endOfDay);
                $order = array('id'=>'desc');
                $listData = $modelOrders->find()->where($conditions)->order($order)->all()->toList();
		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $detail_order = $modelOrderDetails->find()->where(['id_order'=>$item->id])->all()->toList();
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
		                        if(!empty($product)){
		                            $detail_order[$k]->product = $product->title;

		                            if(!empty($value->id_unit)){
		                            	$unit = $modelUnitConversion->find()->where(['id'=>$value->id_unit ])->first();
		                            	if(!empty($unit)){
		                            		$detail_order->unit = $unit->unit;
		                            	}
			                        }else{
			                        	$detail_order->unit = $product->unit;
			                        }
		                        }
		                    }

		                    $listData[$key]->detail_order = $detail_order;
		                }else{
		                	$listData[$key]->detail_order = [];
		                }

		                $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_user ])->first();
		            }
		        }
                
                $totalData = $modelOrders->find()->where($conditions)->all()->toList();
                
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

// api lấy danh sách đơn hàng khách lẻ 
function getListOrderCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCustomers = $controller->loadModel('Customers');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelUnitConversion = $controller->loadModel('UnitConversions');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                $conditions = array('id_agency'=>$infoMember->id);
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

		        if(!empty($dataSend['full_name'])){
		            $conditions['full_name'] = $dataSend['full_name'];
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
		            $checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone'] ])->first();

		            if(!empty($checkCustomer)){
		                $conditions['id_user'] = $checkCustomer->id;
		            }else{
		                $conditions['id_user'] = -1;
		            }
		        }

                $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $detail_order = $modelOrderDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
		                        if(!empty($product)){
		                            $detail_order[$k]->product = $product->title;

		                            if(!empty($value->id_unit)){
		                            	$unit = $modelUnitConversion->find()->where(['id'=>$value->id_unit ])->first();
		                            	if(!empty($unit)){
		                            		$detail_order->unit = $unit->unit;
		                            	}
			                        }else{
			                        	$detail_order->unit = $product->unit;
			                        }
		                        }
		                    }

		                    $listData[$key]->detail_order = $detail_order;
		                }else{
		                	$listData[$key]->detail_order = [];
		                }

		                $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_user ])->first();
		            }
		        }
                
                $totalData = $modelOrderDetails->find()->where($conditions)->all()->toList();
                
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

?>