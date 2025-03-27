<?php 
function listPrepayCardAPI($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thẻ dịch vụ';

	$modelPrepayCard = $controller->loadModel('PrepayCards');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPrepayCard','prepaid_cards');
			if(!empty($infoUser)){

				$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['status'])){
					$conditions['status'] = $dataSend['status'];
				}

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}

				if(!empty($dataSend['price'])){
					$conditions['price'] = (int) $dataSend['price'];
				}

				if(!empty($dataSend['price_sell'])){
					$conditions['price_sell'] = (int) $dataSend['price_sell'];
				}

				$listData = $modelPrepayCard->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				$totalData = $modelPrepayCard->find()->where($conditions)->count();
				return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailPrepayCardAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
	
	$modelPrepayCard = $controller->loadModel('PrepayCards');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPrepayCard','prepaid_cards');
			if(!empty($infoUser)){

	        $data = $modelPrepayCard->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addPrepayCardAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelPrepayCard = $controller->loadModel('PrepayCards');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addPrepayCard','prepaid_cards');
			if(!empty($infoUser)){
		        $modelMembers = $controller->loadModel('Members');
				$modelPrepayCard = $controller->loadModel('PrepayCards');
				$modelTrademarks = $controller->loadModel('Trademarks');

		        // lấy data edit
		        if(!empty($dataSend['id'])){
		            $data = $modelPrepayCard->get( (int) $dataSend['id']);

		        }else{
		            $data = $modelPrepayCard->newEmptyEntity();
		            $data->created_at = time();
		        }

                // tạo dữ liệu save
                if(!empty($dataSend['name'])){
                	$data->name = @$dataSend['name'];
                }
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $infoUser->id_spa;
                if(!empty($dataSend['status'])){
                	$data->status = @$dataSend['status'];
                }
                if(!empty($dataSend['price'])){
                	$data->price =  @$dataSend['price'];
                }
                if(!empty($dataSend['price_sell'])){
                	$data->price_sell = @$dataSend['price_sell'];
				}
                if(!empty($dataSend['note'])){
                	$data->note = @$dataSend['note'];
				}
                if(!empty($dataSend['use_time'])){
                	$data->use_time = (int) $dataSend['use_time']; 
				}
                if(!empty($dataSend['commission_staff_fix'])){               
                	$data->commission_staff_fix = (int) $dataSend['commission_staff_fix']; 
				}
                if(!empty($dataSend['commission_staff_percent'])){               
                	$data->commission_staff_percent = (int) $dataSend['commission_staff_percent'];                
                }

                $modelPrepayCard->save($data);

               return apiResponse(1,'Lưu dữ liệu thành công',$data);
			     
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function deletePrepayCardAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;


    $modelPrepayCard = $controller->loadModel('PrepayCards');
    $modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deletePrepayCard','prepaid_cards');
			if(!empty($infoUser)){
	            $conditions = array('id'=> $dataSend['id'],'id_member'=>$infoUser->id_member);
	            
	            $data = $modelPrepayCard->find()->where($conditions)->first();

	            $checkSevice = $modelCustomerPrepaycard->find()->where(array('id_prepaycard'=>$data->id))->all()->toList();
	            if(empty($checkSevice)){
	                if(!empty($data)){
	                    $modelCategories->delete($data);
	                    return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(5,'không xóa được dữ liệu' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function buyPrepayCardAPI($input){
	global $controller;
	global $isRequestPost;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Bán Thẻ trả trước';

    $mess = "";
    setVariable('page_view', 'buyPrepayCard');
	$modelPrepayCard = $controller->loadModel('PrepayCards');
	$modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');
	$modelBill = $controller->loadModel('Bills');
	$modelMembers = $controller->loadModel('Members');
	$modelCustomer = $controller->loadModel('Customers');


	if($isRequestPost){
		$dataSend = $input['request']->getData();
			if(!empty($dataSend['token']) && !empty($dataSend['data_order']) && !empty($dataSend['id_customer']) && $dataSend['id_staff']!=''){
			$infoUser = getMemberByToken($dataSend['token'], 'buyPrepayCard','prepaid_cards');
			if(!empty($infoUser)){
        		$dataSend['data_order'] = json_decode($dataSend['data_order'], true);

        		

        		$infoCustomer = $modelCustomer->find()->where(['id'=>(int)$dataSend['id_customer'], 'id_member'=>$infoUser->id_member])->first();
        		if(empty($infoCustomer)){
        			return apiResponse(3,'khách hàng không tồn tại' );
        		}

				$bill = $modelBill->newEmptyEntity();
	            $bill->id_member = @$infoUser->id_member;
    	        $bill->id_spa = $infoUser->id_spa;
        	    $bill->id_staff = (int)@$dataSend['id_staff'];
            	$bill->total = (int)@$dataSend['total_pay'];
	            $bill->note = 'Bán hàng Mã thẻ trả trước, thời gian '.date('Y-m-d H:i:s');
    	        $bill->type = 0; //0: Thu, 1: chi
        	    $bill->created_at = time();
            	$bill->updated_at = time();
	            $bill->type_collection_bill = @$dataSend['type_collection_bill'];
    	        $bill->id_customer = (int)@$dataSend['id_customer'];
        	    $bill->full_name =  @$infoCustomer->name;
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

            	$info_card = array();
	            foreach($dataSend['data_order'] as $key => $value){
	                $card = $modelCustomerPrepaycard->newEmptyEntity();

	                $card->id_member = $infoUser->id_member;
	                $card->id_bill = $bill->id;
	                $card->id_spa = $infoUser->id_spa;
	                $card->id_prepaycard = $value['id_prepaycard'];
	                $card->id_customer = @$dataSend['id_customer'];
	                $card->price = (int) $value['price'];
	                $card->price_sell = (int) $value['price_sell'];
	                $card->total = (int) $value['price_sell'] *(int) $value['quantity'];
	                $card->quantity = (int) $value['quantity'];
	            	$card->created_at = time();
	            	$card->updated_at = time();
	            	$card->status = 'active';

	                $modelCustomerPrepaycard->save($card);
	                $info_card[] = $card;
	            }

	            $bill->info_card = $info_card;
	            return apiResponse(1,'lấy dữ liệu thành công',$bill);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listCustomerCardAPI($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $session;

   
    if($isRequestPost){
		$dataSend = $input['request']->getData();
			if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCustomerPrepayCard','prepaid_cards');
			if(!empty($infoUser)){
		        $modelBill = $controller->loadModel('Bills');
		        $modelCustomer = $controller->loadModel('Customers');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');
		        $modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');

		        $conditions = array('id_member'=>$user->id_member);
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('id'=>'desc');

		        if(!empty($dataSend['id'])){
		            $conditions['id'] = $dataSend['id'];
		        }

		        if(!empty($dataSend['id_customer'])){
		           $conditions['id_customer'] = $dataSend['id_customer'];
		        }

		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		            $conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		            $conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
		        } 

		           
		        $listData = $modelCustomerPrepaycard->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach($listData as $key => $item){

		                $item->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$item->id_prepaycard))->first();
		                $item->infoCustomer = $modelCustomer->find()->where(array('id'=>$item->id_customer))->first();
		                $listData[$key] = $item;
		                
		            }
		        }
		        $totalData = $modelCustomerPrepaycard->find()->where($conditions)->all()->toList();
		        $totalData = count($totalData);

        		return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}



      
function listCustomerUserCardAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Danh sách thẻ trước';
      
    if($isRequestPost){
		$dataSend = $input['request']->getData();
			if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCustomerPrepayCard','prepaid_cards');
			if(!empty($infoUser)){
        
		        $modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');
		        $modelPrepayCard = $controller->loadModel('PrepayCards');

		        $conditions = array('id_member'=>$user->id_member);


		        $conditions['id_customer'] = $dataSend['id_customer'];
		        $conditions['total >='] = $dataSend['total'];
		        
		           
		        $listData = $modelCustomerPrepaycard->find()->where($conditions)->all()->toList();
		            foreach($listData as $key => $item){

		                $item->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$item->id_prepaycard))->first();
		                $listData[$key] = $item;
		                
		            }

		            $return =  array('code'=>1, 'data'=>$listData);
		       return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

 ?>