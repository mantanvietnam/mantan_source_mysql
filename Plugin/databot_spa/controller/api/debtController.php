<?php 
function listCollectionDebtAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;
	global $type_collection_bill;

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCollectionDebt','bill');
			if(!empty($infoUser)){ 

			    $modelMember = $controller->loadModel('Members');
				$modelDebt = $controller->loadModel('Debts');
				

				$conditions = array('type'=>0, 'id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');
				
				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['full_name'])){
					$conditions['full_name LIKE'] = '%'.$dataSend['full_name'].'%';
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['time >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['time <='] = $date_end;
				}

				if(!empty($dataSend['id_customer'])){
					$conditions['id_customer'] = (int) $dataSend['id_customer'];
				}

			
			    $listData = $modelDebt->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
			    

			    if(!empty($listData)){
					foreach($listData as $key =>$item){
						$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
						if(!empty($staff)){
							$listData[$key]->staff = $staff;
						}
					}
				}

				$totalData = $modelDebt->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);

	    		return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');

}

function detailCollectionDebtAPI($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'detailCollectionBill','bill');
			if(!empty($infoUser)){


			    $modelMember = $controller->loadModel('Members');
				$modelDebt = $controller->loadModel('Debts');

				$modelCombo = $controller->loadModel('Combos');
				$modelProduct = $controller->loadModel('Products');
				$modelCustomer = $controller->loadModel('Customers');
				$modelService = $controller->loadModel('Services');
				$modelRoom = $controller->loadModel('Rooms');
		        $modelBed = $controller->loadModel('Beds');
		        $modelMembers = $controller->loadModel('Members');
		        $modelOrder = $controller->loadModel('Orders');
		        $modelOrderDetails = $controller->loadModel('OrderDetails');
		        $modelBill = $controller->loadModel('Bills');

		        $data = $modelDebt->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();

		        if(!empty($data->id_order)){
		        	 $order = $modelOrder->get($data->id_order);

		        	$product = $modelOrderDetails->find()->where(array('id_order'=>$order->id,'type'=>'product'))->all()->toList();
		            $service = $modelOrderDetails->find()->where(array('id_order'=>$order->id,'type'=>'service'))->all()->toList();
		            $combo = $modelOrderDetails->find()->where(array('id_order'=>$order->id,'type'=>'combo'))->all()->toList();

		        	if(!empty($product)){
		                foreach($product as $k => $value){
		                    $product[$k]->product = $modelProduct->find()->where(array('id'=>$value->id_product))->first();
		                }
		                $order->product = $product;
		            }

		            if(!empty($combo)){
		                foreach($combo as $k => $value){
		                    $combo[$k]->combo = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
		                }
		                $order->combo = $combo;
		            }

		            if(!empty($service)){
		                foreach($service as $k => $value){
		                    $service[$k]->service = $modelService->find()->where(array('id'=>$value->id_product))->first();
		                }
		                $order->service = $service;
		            }


		            if(!empty($data->id_customer)){
		                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
		            }
		        }

				return apiResponse(1,'lấy dữ liệu thành công',$data);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addCollectionDebtAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;
	setVariable('page_view', 'addCollectionDebt');

    $metaTitleMantan = 'Thông tin công nợ phải thu';
    
    if(!empty(checkLoginManager('addCollectionDebt', 'bill'))){
        $modelMember

        		 = $controller->loadModel('Members');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($dataSend['id'])){
            $data = $modelDebts->get( (int) $dataSend['id']);
        }else{
            $data = $modelDebts->newEmptyEntity();
            $data->created_at =  time();
            $data->status = 0;
            $data->time = time();
            $data->id_staff = @$infoUser->id;
        }

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMember

	    		->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $infoUser->id_spa;
            $data->id_staff = (int)@$dataSend['id_staff'];
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 0; //0: Thu, 1: chi
            $data->updated_at =  time();
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];

            if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$data->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$data->time = time();
            }
           
            $modelDebts->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listStaffs', $listStaffs);

	    setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/');
    }
}

function paymentCollectionBillAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

     if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'paymentCollectionBill','bill');
			if(!empty($infoUser)){
		        $modelMember = $controller->loadModel('Members');
		        $modelCustomer = $controller->loadModel('Customers');
				$modelBill = $controller->loadModel('Bills');
				$modelDebts = $controller->loadModel('Debts');

		        $mess= '';
		        $debt = $modelDebts->get( (int) $dataSend['id']);

		        if(!empty($debt->id_customer)){
		        	$infoCustomer = $modelCustomer->find()->where(['id'=>$debt->id_customer])->first();
		        }
		       
		        if($debt->total-$debt->total_payment>=(int)$dataSend['total']){
   
		            $data = $modelBill->newEmptyEntity();
		            // tạo dữ liệu save
		            $data->id_member = @$infoUser->id_member;
		            $data->id_spa = $infoUser->id_spa;
		            $data->id_staff = @$infoUser->id;
		            $data->total = (int)@$dataSend['total'];
		            $data->note = @$dataSend['note'];
		            $data->type = 0; //0: Thu, 1: chi
		            $data->updated_at =  time();
		            $data->type_collection_bill = @$dataSend['type_collection_bill'];
		            $data->id_customer = (int)@$debt->id_customer;
		            $data->full_name = @$debt->full_name;
		            $data->id_debt = @$debt->id;
		            $data->time = time();
		           
		            $modelBill->save($data);
		            $debt->total_payment += (int)@$dataSend['total'];
		            $debt->number_payment += 1;
		            if($debt->total_payment==$debt->total){
		            	$debt->status = 1;
		            }
		            $modelDebts->save($debt);

		            $debt->biil = $data;
		            $debt->biil = $infoCustomer;
	           
					return apiResponse(1,'thanh toán thành công',$debt);		  	
				}
				return apiResponse(4,'Số tiền phài nhỏ hơn tiên nợ ');
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}            

function listPayableDebtAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;
	global $type_collection_bill;

     if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPayableDebt','bill');
			if(!empty($infoUser)){
	    		$modelMember = $controller->loadModel('Members');
				$modelDebt = $controller->loadModel('Debts');


				$conditions = array('type'=>1, 'id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');
				
				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['full_name'])){
					$conditions['full_name LIKE'] = '%'.$dataSend['full_name'].'%';
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['time >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['time <='] = $date_end;
				}

				if(!empty($dataSend['id_customer'])){
					$conditions['id_customer'] = (int) $dataSend['id_customer'];
				}

		   		$listData = $modelDebt->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    
			    if(!empty($listData)){
					foreach($listData as $key =>$item){
						$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
						if(!empty($staff)){
							$listData[$key]->staff = $staff;
						}
					}
				}

				$totalData = $modelDebt->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);
			    return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');

}

	   

function addPayableDebtAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;
	setVariable('page_view', 'addPayableDebt');

    $metaTitleMantan = 'Thông tin công nợ phải trả';
    
    if(!empty(checkLoginManager('addPayableDebt', 'bill'))){
        $modelMember= $controller->loadModel('Members');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($dataSend['id'])){
            $data = $modelDebts->get( (int) $dataSend['id']);
        }else{
            $data = $modelDebts->newEmptyEntity();
            $data->created_at =  time();
            $data->status = 0;
            $data->time = time();

            $data->id_staff = @$infoUser->id;
        }

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $infoUser->id_spa;
            $data->id_staff = (int)@$dataSend['id_staff'];
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 1; //0: Thu, 1: chi
            $data->updated_at =  time();
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];

            if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$data->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$data->time = time();
            }
           
            $modelDebts->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/');
    }
}

function paymentBillAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;
	setVariable('page_view', 'paymentBill');

    $metaTitleMantan = 'Thông tin công nợ phải trả';
    
    if(!empty(checkLoginManager('paymentBill', 'bill'))){
        $modelMember= $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');
		$modelDebts = $controller->loadModel('Debts');

        $infoUser = $session->read('infoUser');
        $mess= '';
        $debt = $modelDebts->get( (int) $dataSend['id_debt']);
       
        if($debt->total-$debt->total_payment>=(int)$dataSend['total']){
   
            $data = $modelBill->newEmptyEntity();
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $infoUser->id_spa;
            $data->id_staff = @$infoUser->id;
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 1; //0: Thu, 1: chi
            $data->updated_at =  time();
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];
            $data->id_debt = @$dataSend['id_debt'];
            $data->time = time();
           
            $modelBill->save($data);
            $debt->total_payment += (int)@$dataSend['total'];
            $debt->number_payment += 1;
            if($debt->total_payment==$debt->total){
            	$debt->status = 1;
            }
            $modelDebts->save($debt);
           

            return $controller->redirect('/listPayableDebt?mess=paymentDone');
        }else{
        	return $controller->redirect('/listPayableDebt?mess=paymentError');
        }
    }else{
        return $controller->redirect('/');
    }
}
?>