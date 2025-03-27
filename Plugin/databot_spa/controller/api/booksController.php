<?php 
function addBookAPI($input){
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;

    $metaTitleMantan = 'Thông tin lịch hẹn';

	$modelCustomer = $controller->loadModel('Customers');
	$modelBook = $controller->loadModel('Books');
	$modelService = $controller->loadModel('Services');
	$modelMembers = $controller->loadModel('Members');
	$modelSpa = $controller->loadModel('Spas');
	$modelRoom = $controller->loadModel('Rooms');
    $modelBed = $controller->loadModel('Beds');
	
	$mess= '';

	if ($isRequestPost) {
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCategoryService','product');
		}elseif(!empty(checkLoginManager('addBook', 'calendar'))){
			$infoUser = $session->read('infoUser');
		}else{
			return apiResponse(3,'Tài khoản không tồn tại' );
		}

	    // lấy data edit
		if(!empty($dataSend['id'])){
			$save = $modelBook->get( (int) $dataSend['id']);
		}else{
			$save = $modelBook->newEmptyEntity();
			$save->created_at = time();
			$save->time_book = time();
		}

		if(!empty($dataSend['id_service'])){
			$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
			$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
			$conditions = ['id_member'=>$infoUser->id_member];

			if(!empty($dataSend['id_customer'])){
				$conditions['id'] = (int) $dataSend['id_customer'];
			} else {
				$conditions['phone'] = $dataSend['phone'];
			}

			$checkCustomer = $modelCustomer->find()->where($conditions)->first();

			if(!empty($checkCustomer)){
				if(empty($dataSend['apt_step']) || empty($dataSend['apt_times'])){
			   		$dataSend['apt_step'] = 0; // khoảng cách ngày
			   		$dataSend['apt_times'] = 0; // số lần lặp
			   		$dataSend['repeat_book'] = 0;
			   	}
			   	$save->name = $checkCustomer->name;
			   	$save->phone = $checkCustomer->phone;
			   	$save->email = $checkCustomer->email;
			   	$save->id_member = (int) $infoUser->id_member;
		    	$save->id_customer = $checkCustomer->id;
		    	$save->id_service =(int) $dataSend['id_service'];

			    if(!empty($dataSend['time_book'])){
			   		$time = explode(' ', $dataSend['time_book']);
			   		$date = explode('/', $time[0]);
			   		$hour = explode(':', $time[1]);
			   		$save->time_book = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
			   	}else{
			   		$save->time_book = time();
			   	}
		    	$save->time_book_end = $save->time_book + $dataSend['apt_times']*$dataSend['apt_step']*24*60*60;

		    	$save->id_staff = (int) $dataSend['id_staff'];
		    	$save->status = (int)  $dataSend['status'];
		    	$save->id_bed = (int)  $dataSend['id_bed'];
		    	$save->note = @$dataSend['note'];
		    	$save->apt_step = (int) @$dataSend['apt_step'];
		    	$save->apt_times = (int) @$dataSend['apt_times'];
		    	$save->id_spa = (int) $infoUser->id_spa;
		    	$save->type1 = (int) @$dataSend['type1'];
		    	$save->type2 = (int) @$dataSend['type2'];
		    	$save->type3 = (int) @$dataSend['type3'];
		    	$save->type4 = (int) @$dataSend['type4'];
		    	$save->repeat_book = (int) @$dataSend['repeat_book'];

		    	$modelBook->save($save);
		    	return apiResponse(1,'Lưu dữ liệu thành công',$save);
		    }
		    return apiResponse(3,'chưa có thông tin khách hàng ');
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listBookAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Lịch hẹn';

    $modelService = $controller->loadModel('Services');
	$modelBook = $controller->loadModel('Books');
	$modelMembers = $controller->loadModel('Members');
	$modelCustomer = $controller->loadModel('Customers');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBook','calendar');
			if(!empty($infoUser)){

				$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['full_name'])){
					$conditions['name LIKE'] = '%'.$dataSend['full_name'].'%';
				}

				if(!empty($dataSend['phone'])){
					$conditions['phone'] = $dataSend['phone'];
				}

				if(!empty($dataSend['email'])){
					$conditions['email'] = $dataSend['email'];
				}

				if(isset($dataSend['status'])){
		            if($dataSend['status']!=''){
		                $conditions['status'] = (int) $dataSend['status'];
		            }
		        }

		        if(!empty($dataSend['type'])){
					$conditions[$dataSend['type']] = 1;
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['id_service'])){
					$conditions['id_service'] = (int) $dataSend['id_service'];
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['time_book >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['time_book <='] = $date_end;
				}

			    $listData = $modelBook->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    if(!empty($listData)){
			        foreach ($listData as $key => $value) {
			            $listData[$key]->service  = $modelService->find()->where(['id'=>$value->id_service])->first();
			            $listData[$key]->info_customer  = $modelCustomer->find()->where(['id'=>$value->id_customer])->first();
			        }
			    }


			    $totalData = $modelBook->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);

	     		return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listBookCalendarAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Lịch hẹn';

    $modelService = $controller->loadModel('Services');
	$modelBook = $controller->loadModel('Books');
	$modelMembers = $controller->loadModel('Members');
	$modelRoom = $controller->loadModel('Rooms');
	$modelBed = $controller->loadModel('Beds');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBook','calendar');
			if(!empty($infoUser)){
    
				$conditions = array('Books.id_member'=>$infoUser->id_member, 'Books.id_spa'=>$infoUser->id_spa);

				if(!empty($dataSend['id'])){	
					$conditions['Books.id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['full_name'])){
					$conditions['Books.name LIKE'] = '%'.$dataSend['full_name'].'%';
				}

				if(!empty($dataSend['phone'])){
					$conditions['Books.phone'] = $dataSend['phone'];
				}

				if(!empty($dataSend['email'])){
					$conditions['Books.email'] = $dataSend['email'];
				}

				if(isset($dataSend['status'])){
		            if($dataSend['status']!=''){
		                $conditions['Books.status'] = (int) $dataSend['status'];
		            }
		        }

		        if(!empty($dataSend['type'])){
					$conditions['Books.'.$dataSend['type']] = 1;
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['Books.id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['id_service'])){
					$conditions['Books.id_service'] = (int) $dataSend['id_service'];
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['Books.time_book >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['Books.time_book <='] = $date_end;
				}

			    $listData = $modelBook
	    			->find()
	    			->select([
			            'Books.id',
			            'Books.name',
			            'Books.phone',
			            'Books.email',
			            'Books.time_book',
			            'Books.status',
			            'Books.note',
			            'Books.type1',
			            'Books.type2',
			            'Books.type3',
			            'Books.type4',
			            'Books.repeat_book',
			            'Books.apt_times',
			            'Books.apt_step',
			            'Services.name',
			            'Members.name',
			            'Members.id',
			            'Beds.name',
			            'Beds.id',
			        ])
	    			->join([
				            [
				                'table' => 'services',
				                'alias' => 'Services',
				                'type' => 'LEFT',
				                'conditions' => [
				                    'Books.id_service = Services.id',
				                ],
				            ],
				            [
				                'table' => 'members',
				                'alias' => 'Members',
				                'type' => 'LEFT',
				                'conditions' => [
				                    'Books.id_staff = Members.id',
				                ],
				            ],
				            [
				                'table' => 'beds',
				                'alias' => 'Beds',
				                'type' => 'LEFT',
				                'conditions' => [
				                    'Books.id_bed = Beds.id',
				                ],
				            ],
				        ])
	    			->where($conditions)->all()->toList();

	    		return apiResponse(1,'lấy dữ liệu thành công',$listData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteBookAPI($input){
    global $controller;
    global $session;
    global $isRequestPost;
	
	$modelBook = $controller->loadModel('Books');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteBook','calendar');
			if(!empty($infoUser)){
	            $data = $modelBook->get($dataSend['id']);
	            
	            if($data){
	                $modelBook->delete($data);
	            	return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function checkinbetBookAPI($input){
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;

    $metaTitleMantan = 'Thông tin lịch hẹn';

    setVariable('page_view', 'checkinbetBook');
	$modelCustomer = $controller->loadModel('Customers');
	$modelBook = $controller->loadModel('Books');
	$modelService = $controller->loadModel('Services');
	$modelMembers = $controller->loadModel('Members');
	$modelService = $controller->loadModel('Services');
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');
	$modelSpa = $controller->loadModel('Spas');
    $modelAgency = $controller->loadModel('Agencys');
	$modelRoom = $controller->loadModel('Rooms');
    $modelBed = $controller->loadModel('Beds');


	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id_staff']) && !empty($dataSend['id_book']) && !empty($dataSend['id_bed']) && !empty($dataSend['time_checkin'])){
			$infoUser = getMemberByToken($dataSend['token'], 'checkinbetBook','calendar');
			if(!empty($infoUser)){
				$bed = $modelBed->find()->where(array('id'=>(int)$dataSend['id_bed'], 'status'=>2))->first();
	            if(!empty($bed)){
	            	return apiResponse(4,'Phòng '.$bed->name.' vẫn còn khách');
	            }
		        $book = $modelBook->get($dataSend['id_book']);
		        $book->status = 3;
		        $book->id_staff = (int )$dataSend['id_staff'];
		        
		        $customer = $modelCustomer->get($book->id_customer);
		        $service= $modelService->get($book->id_service);
		        $modelBook->save($book);

		        // tạo đơn hàng 
		        $order = $modelOrder->newEmptyEntity();
		        $order->id_member = $infoUser->id_member;
		        $order->id_spa =$infoUser->id_spa;
		        $order->id_staff =@$dataSend['id_staff'];
		        $order->id_customer =@$book->id_customer;
		        $order->full_name = @$customer->name;
		        $order->id_bed =@$dataSend['id_bed'];
		        $order->note =@$dataSend['note'];

		        if(!empty($dataSend['time_checkin'])){   

			     $time = explode(' ', $dataSend['time_checkin']);
			     $date = explode('/', $time[0]);
			     $hour = explode(':', $time[1]);
			     $time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
			    }else{
			     $time = time();
			    }
		        $order->created_at =$time;
		        $order->updated_at =$time;
		   		$order->status =0;
		       	//$order->promotion =@$dataSend['promotion'];
		       	$order->total =@$service->price;
		       	$order->total_pay =@$service->price;
		       	$order->type_order =3;
		       	$order->type ='service';
			    $order->time = $time;

			    $modelOrder->save($order);

			    $detail = $modelOrderDetail->newEmptyEntity();

		        $detail->id_member = $infoUser->id_member;
		        $detail->id_order = $order->id;
		        $detail->id_product = $book->id_service;
		        $detail->price = (int) $service->price;
		        $detail->quantity = 1;
		        $detail->type = 'service';

		        $modelOrderDetail->save($detail);
		        addUserserviceHistories($detail->id,$dataSend['id_bed'],$book->id_service,$time,$dataSend['id_staff']);
	        	return apiResponse(1,'check in thành công');
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailBookAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelService = $controller->loadModel('Services');
	$modelBook = $controller->loadModel('Books');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBook','calendar');
			if(!empty($infoUser)){

	        $data = $modelBook->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
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

?>