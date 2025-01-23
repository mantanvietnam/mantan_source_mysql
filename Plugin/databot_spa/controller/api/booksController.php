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
	
	if(!empty(checkLoginManager('addBook', 'calendar'))){
		$infoUser = $session->read('infoUser');

		$mess= '';

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        // lấy data edit
		    if(!empty($dataSend['id'])){
		        $save = $modelBook->get( (int) $dataSend['id']);
		    }else{
		        $save = $modelBook->newEmptyEntity();
				$save->created_at = time();
				$save->time_book = time();
		    }
	        
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

			        $return = ['code'=>1, 'mess'=>'Đặt lịch hẹn thành công', 'id'=>$save->id];
			    }else{
			    	$return = ['code'=>-1, 'mess'=>'Không tồn tại thông tin khách hàng'];
			    }
		    }else{
		    	$return = ['code'=>-2, 'mess'=>'Gửi thiếu dữ liệu'];
		    }
	    }else{
	    	$return = ['code'=>-2, 'mess'=>'Gửi thiếu dữ liệu'];
	    }
    }else{
		$return = ['code'=>-3, 'mess'=>'Mất phiên đăng nhập'];
	}

	return $return;
}
?>