<?php 
function listBook($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Lịch hẹn';

    $modelService = $controller->loadModel('Services');
	$modelBook = $controller->loadModel('Books');
	$modelMembers = $controller->loadModel('Members');

	
    setVariable('page_view', 'listBook');
	if(!empty(checkLoginManager('listBook', 'calendar'))){
		$infoUser = $session->read('infoUser');

		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['full_name'])){
			$conditions['name LIKE'] = '%'.$_GET['full_name'].'%';
		}

		if(!empty($_GET['phone'])){
			$conditions['phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['email'] = $_GET['email'];
		}

		if(isset($_GET['status'])){
            if($_GET['status']!=''){
                $conditions['status'] = (int) $_GET['status'];
            }
        }

        if(!empty($_GET['type'])){
			$conditions[$_GET['type']] = 1;
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = (int) $_GET['id_staff'];
		}

		if(!empty($_GET['id_service'])){
			$conditions['id_service'] = (int) $_GET['id_service'];
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['time_book >='] = $date_start;
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['time_book <='] = $date_end;
		}

	    $listData = $modelBook->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $listData[$key]->service  = $modelService->find()->where(['id'=>$value->id_service])->first();
	        }
	    }

	    $totalData = $modelBook->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);

	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }

	    // danh sách nhân viên
	    $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

	    // danh sách dịch vụ
	    $service = array('id_member'=>$infoUser->id_member, 'id_spa'=>(int) $session->read('id_spa'),'status'=>1);
	    $listService = $modelService->find()->where($service)->order(['name' => 'ASC'])->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    
	    setVariable('listData', $listData);
	    setVariable('listStaffs', $listStaffs);
	    setVariable('listService', $listService);
	}else{
		return $controller->redirect('/');
	}
}

function listBookCalendar($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
    global $session;

    $metaTitleMantan = 'Lịch hẹn';

    $modelService = $controller->loadModel('Services');
	$modelBook = $controller->loadModel('Books');
	$modelMembers = $controller->loadModel('Members');
	$modelRoom = $controller->loadModel('Rooms');
	$modelBed = $controller->loadModel('Beds');

	
    setVariable('page_view', 'listBookCalendar');
	if(!empty(checkLoginManager('listBook', 'calendar'))){
		$infoUser = $session->read('infoUser');

		$conditions = array('Books.id_member'=>$infoUser->id_member, 'Books.id_spa'=>$session->read('id_spa'));

		if(!empty($_GET['id'])){
			$conditions['Books.id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['full_name'])){
			$conditions['Books.name LIKE'] = '%'.$_GET['full_name'].'%';
		}

		if(!empty($_GET['phone'])){
			$conditions['Books.phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['Books.email'] = $_GET['email'];
		}

		if(isset($_GET['status'])){
            if($_GET['status']!=''){
                $conditions['Books.status'] = (int) $_GET['status'];
            }
        }

        if(!empty($_GET['type'])){
			$conditions['Books.'.$_GET['type']] = 1;
		}

		if(!empty($_GET['id_staff'])){
			$conditions['Books.id_staff'] = (int) $_GET['id_staff'];
		}

		if(!empty($_GET['id_service'])){
			$conditions['Books.id_service'] = (int) $_GET['id_service'];
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['Books.time_book >='] = $date_start;
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
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
			            'Books.id_service',
			            'Books.id_customer',
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

	    // danh sách nhân viên
	    $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();
	    $order = array('name'=>'asc');
	    
	    // danh sách giường
	    $conditionsRoom = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
	   	$listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'), 'status'=>1))->all()->toList();
            }
        }

        $conditionsCategorieService = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $CategoryService = $modelCategories->find()->where($conditionsCategorieService)->order($order)->all()->toList();

        if(!empty($CategoryService)){
	    	foreach ($CategoryService as $key => $Service) {
	    		$CategoryService[$key]->service = $modelService->find()->where(array('id_category'=>$Service->id, 'id_spa'=>(int) $session->read('id_spa'),'status'=>1))->order($order)->all()->toList();
	    	}
	    }

	    setVariable('listData', $listData);
	    setVariable('listStaffs', $listStaffs);
	    setVariable('CategoryService', $CategoryService);
	    setVariable('listRoom', $listRoom);
	    setVariable('user', $infoUser);
	}else{
		return $controller->redirect('/');
	}
}

function addBook($input){
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;

    $metaTitleMantan = 'Thông tin lịch hẹn';

    setVariable('page_view', 'addBook');
	$modelCustomer = $controller->loadModel('Customers');
	$modelBook = $controller->loadModel('Books');
	$modelService = $controller->loadModel('Services');
	$modelMembers = $controller->loadModel('Members');
	$modelSpa = $controller->loadModel('Spas');
	$modelRoom = $controller->loadModel('Rooms');
    $modelBed = $controller->loadModel('Beds');
	
	if(!empty(checkLoginManager('addBook', 'calendar'))){
		$infoUser = $session->read('infoUser');

		$mess= '';

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $save = $modelBook->get( (int) $_GET['id']);
	    }else{
	        $save = $modelBook->newEmptyEntity();
			$save->created_at =time();
			$save->time_book = time();
	    }

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();
	        
	        if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['id_service'])){
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

			    	$save->name = $dataSend['name'];
			        $save->phone = $dataSend['phone'];
			        $save->email = $dataSend['email'];
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
			        $save->note = $dataSend['note'];
			        $save->apt_step = (int) @$dataSend['apt_step'];
			        $save->apt_times = (int) @$dataSend['apt_times'];
			        $save->id_spa = (int) $session->read('id_spa');
			        $save->type1 = (int) @$dataSend['type1'];
			        $save->type2 = (int) @$dataSend['type2'];
			        $save->type3 = (int) @$dataSend['type3'];
			        $save->type4 = (int) @$dataSend['type4'];
			        $save->repeat_book = (int) @$dataSend['repeat_book'];
			        
			        $modelBook->save($save);

			        $mess= '<p class="text-success">Đặt lịch hẹn thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Không tồn tại thông tin khách hàng</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		    }
	    }

	    $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $dataMember = $modelMembers->find()->where($conditionsStaff)->all()->toList();


	   	$order = array('name'=>'asc');
	   	$conditionsRoom = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
	   	$listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }

        $conditionsCategorieService = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $CategoryService = $modelCategories->find()->where($conditionsCategorieService)->order($order)->all()->toList();

        if(!empty($CategoryService)){
	    	foreach ($CategoryService as $key => $Service) {
	    		$CategoryService[$key]->service = $modelService->find()->where(array('id_category'=>$Service->id, 'id_spa'=>(int) $session->read('id_spa'), 'status'=>1))->order($order)->all()->toList();
	    	}
	    }

	    setVariable('data', $save);
	    setVariable('CategoryService', $CategoryService);
	    setVariable('dataMember', $dataMember);
	    setVariable('mess', $mess);
	    setVariable('infoUser', $infoUser);
	    setVariable('listRoom', $listRoom);
    }else{
		return $controller->redirect('/');
	}
}

function deleteBook($input){
    global $controller;
    global $session;
	
	$modelBook = $controller->loadModel('Books');
    
    if(!empty(checkLoginManager('deleteBook', 'calendar'))){
    	$infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelBook->get($_GET['id']);
            
            if($data){
                $modelBook->delete($data);
            }
        }

        return $controller->redirect('listBook');
    }else{
        return $controller->redirect('/');
    }
}


function checkinbetBook($input){
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
	
	if(!empty(checkLoginManager('checkinbetBook', 'calendar'))){
		$infoUser = $session->read('infoUser');

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();
	        $book = $modelBook->get($dataSend['id_book']);
	        $book->status = 3;
	        $book->id_staff = (int )$dataSend['idStaff'];
	        
	        $customer = $modelCustomer->get($book->id_customer);
	        $service= $modelService->get($book->id_service);
	        $modelBook->save($book);
	         if(!empty($dataSend['time_checkin'])){   

		     $time = explode(' ', $dataSend['time_checkin']);
		     $date = explode('/', $time[0]);
		     $hour = explode(':', $time[1]);
		     $time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
		    }else{
		     $time = time();
		    }
	        if(@$dataSend['type_order']=='service'){
	        // tạo đơn hàng 
	        $order = $modelOrder->newEmptyEntity();
	        $order->id_member = $infoUser->id_member;
	        $order->id_spa =$infoUser->id_spa;
	        $order->id_staff =@$dataSend['idStaff'];
	        $order->id_customer =@$book->id_customer;
	        $order->full_name = @$customer->name;
	        $order->id_bed =@$dataSend['id_bed'];
	        $order->note =@$dataSend['note'];

	       
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
	    	}else{
	    		$detail = $modelOrderDetail->find()->where(['id'=>(int)$dataSend['id_order_detail'],'id_member'=>$infoUser->id_member])->first();
	        }

	        return $controller->redirect('/addUserService?id='.$detail->id.'&id_bed='.$dataSend['id_bed'].'&id_service='.$book->id_service.'&time='.$time.'&id_staff='.@$dataSend['idStaff']);

	    }

	}else{
		return $controller->redirect('/');
	}
}
?>