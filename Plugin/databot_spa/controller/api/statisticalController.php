<?php 
function businessReportAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'], '','staff');;

            if(!empty($infoMember)){
		$conditBill['type'] = 0;
		$conditBill['id_member'] = $infoMember->id_member;
		$conditBill['id_spa'] = $infoMember->id_spa;
		$modelBill = $controller->loadModel('Bills');
		$order = array('created_at'=>'asc');
        $modelOrder = $controller->loadModel('Orders');
        $modelBook = $controller->loadModel('Books');

        $conditBill['created_at >='] = strtotime(date("Y-m-d 00:00:00"));
        $conditBill['created_at <='] = time();

		$listDataBill = $modelBill->find()->where($conditBill)->order($order)->all()->toList();

		$conditionproduct = array('id_member'=>$infoMember->id_member, 'id_spa'=>$infoMember->id_spa,'type'=>'product' ,'time >='=> strtotime(date("Y-m-d 00:00:00")));
		$totalOrderproduct = count($modelOrder->find()->where($conditionproduct)->all()->toList());

		$conditioncombo = array('id_member'=>$infoMember->id_member, 'id_spa'=>$infoMember->id_spa,'type'=>'combo' ,'time >='=> strtotime(date("Y-m-d 00:00:00")));
		$totalOrderCombo = count($modelOrder->find()->where($conditioncombo)->all()->toList());

		$conditionServicet = array('id_member'=>$infoMember->id_member, 'id_spa'=>$infoMember->id_spa,'type'=>'service' ,'time >='=> strtotime(date("Y-m-d 00:00:00")));
		$totalOrderService = count($modelOrder->find()->where($conditionServicet)->all()->toList());

		$conditionbook = array('Books.id_member'=>$infoMember->id_member, 'Books.id_spa'=>$infoMember->id_spa ,'Books.time_book >='=> strtotime(date("Y-m-d 00:00:00")));

		$listBooking = $modelBook
	    			->find()
	    			->select([
			            'Books.id',
			            'Books.name',
			            'Books.time_book',
			            'Books.status',
			            'Books.repeat_book',
			            'Books.apt_times',
			            'Books.apt_step',
			            'Services.name',
			            'Members.name',
			            'Members.id',
			            'Beds.name',
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
	    			->where($conditionbook)->all()->toList();

		$totalbook = count($listBooking);

		$days = [];
		$month = date('n');
		$year = date('Y');
		$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for ($day = 1; $day <= $days_in_month; $day++) {
    		$days[] = $day.'-'.$month.'-'.$year;
		}


		
		$total = 0;

		$dayDataBill= array();
		foreach ($days as $item) {
	       	$dayTotalBill[$item] = 0;
	    }


		if(!empty($listDataBill)){
			foreach ($listDataBill as $item) {
				$time= @$item->created_at;
				$todayTime= getdate($time);
	                      // tính doanh thu theo ngày
				@$dayTotalBill[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += $item->total;
				$total += $item->total; 

			}

			if(!empty($dayTotalBill)){
				foreach($dayTotalBill as $key=>$item){
	                $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
	                $dayDataBill[]= array('time'=>$time , 'value'=>$item );
	            }
	        }
	    }


                

                $data = array( //'dayDataBill'=> $dayDataBill,
                                'totalOrderproduct'=> $totalOrderproduct,
                                'totalOrderService'=> $totalOrderService,
                                'totalOrderCombo'=> $totalOrderCombo,
                                'totalbook'=> $totalbook,
                                'listBooking'=> $listBooking,
                                'total'=>$total                            
                            );
                 return apiResponse(1,'lấy dữ liệu Thành công',$data);
                
            }
            return apiResponse(3,'không tồn tại tài khoản đại lý hoặc sai mã token');
            
        }
        return apiResponse(2, 'Gửi thiếu dữ liệu');
        
    }
    return apiResponse(0,' gửi sai kiểu POST ');
}

function biilStatisticalAPI($input){
	global $controller;
    global $isRequestPost;
    global $metaTitleMantan;


    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'], 'revenueStatistical','static');

            if(!empty($infoMember)){

    	$metaTitleMantan = 'Thống kê doanh thu';

	    $modelmember = $controller->loadModel('Members');
	    $modelBill = $controller->loadModel('Bills');
	    $mess= '';

	    $order = array('time'=>'asc');

	    $conditBill = array();

	     if(!empty($dataSend['date_start'])){
            $date_start = explode('/', $dataSend['date_start']);
            $conditBill['time >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $start = trim($date_start[2]).'-'.trim($date_start[1]).'-'.trim($date_start[0]);
        }else{
        	$conditBill['time >='] = strtotime('first day of this month 00:00:00');
        }

        if(!empty($dataSend['date_end'])){
            $date_end = explode('/', $dataSend['date_end']);
            $conditBill['time <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
            $end = trim($date_end[2]).'-'.trim($date_end[1]).'-'.trim($date_end[0]);
        }else{
        	$conditBill['time <='] = time();
        }

	    $conditBill['type'] = 0;
	    $conditBill['id_member'] = $infoMember->id_member;
	    $conditBill['id_spa'] = $infoMember->id_spa;
	    
	   
	    $listDataBill = $modelBill->find()->where($conditBill)->order($order)->all()->toList();

	    if(empty($dataSend['date_start']) && empty($dataSend['date_end'])){
	        $days = [];
			$month = date('n');
			$year = date('Y');
			$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			for ($day = 1; $day <= $days_in_month; $day++) {
    			$days[] = $day.'-'.$month.'-'.$year;
			}

		}else{
			$start = new DateTime($start); // Ngày bắt đầu
			$end = new DateTime($end);   // Ngày kết thúc
			$end->modify('+1 day'); // Để bao gồm cả ngày 4/4/2025

			$interval = new DateInterval('P1D'); // Khoảng cách 1 ngày
			$period = new DatePeriod($start, $interval, $end);

			$days = [];
			foreach ($period as $date) {
			    $days[] = $date->format('j-n-Y');
			}

		}
	       
	        $dayDataBill= array();
	         foreach ($days as $item) {
	        	$dayTotalBill[$item] = 0;

	        }

	        if(!empty($listDataBill)){
	            foreach ($listDataBill as $item) {
	                $todayTime= getdate($item->time);

	                      // tính doanh thu theo ngày
	               @$dayTotalBill[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += $item->total;
	    
	            }

	            if(!empty($dayTotalBill)){
	                foreach($dayTotalBill as $key=>$item){
	                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
	                    $dayDataBill[]= array('time'=>$time , 'value'=>$item );
	                }
	            }
	        }

				return apiResponse(1,'lấy dữ liệu Thành công',$dayDataBill);
                
            }
            return apiResponse(3,'không tồn tại tài khoản đại lý hoặc sai mã token');
            
        }
        return apiResponse(2, 'Gửi thiếu dữ liệu');
        
    }
    return apiResponse(0,' gửi sai kiểu POST ');
}

function userServicestatisticalAPI($input){
		global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'], 'revenueStatistical','static');

            if(!empty($infoMember)){

    	$metaTitleMantan = 'Thống kê doanh thu';

	    $modelmember = $controller->loadModel('Members');
	    $modelBill = $controller->loadModel('Bills');
	    $mess= '';
	    $user = $session->read('infoUser');

	    $order = array('created_at'=>'asc');

        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

	    $conditBill = array();

	     if(!empty($dataSend['date_start'])){
            $date_start = explode('/', $dataSend['date_start']);
            $conditBill['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $start = trim($date_start[2]).'-'.trim($date_start[1]).'-'.trim($date_start[0]);
        }else{
        	$conditBill['created_at >='] = strtotime('first day of this month 00:00:00');
        }

        if(!empty($dataSend['date_end'])){
            $date_end = explode('/', $dataSend['date_end']);
            $conditBill['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
            $end = trim($date_end[2]).'-'.trim($date_end[1]).'-'.trim($date_end[0]);
        }else{
        	$conditBill['created_at <='] = time();
        }


        if(empty($dataSend['date_start']) && empty($dataSend['date_end'])){
	        $days = [];
			$month = date('n');
			$year = date('Y');
			$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			for ($day = 1; $day <= $days_in_month; $day++) {
    			$days[] = $day.'-'.$month.'-'.$year;
			}

		}else{
			$start = new DateTime($start); // Ngày bắt đầu
			$end = new DateTime($end);   // Ngày kết thúc
			$end->modify('+1 day'); // Để bao gồm cả ngày 4/4/2025

			$interval = new DateInterval('P1D'); // Khoảng cách 1 ngày
			$period = new DatePeriod($start, $interval, $end);

			$days = [];
			foreach ($period as $date) {
			    $days[] = $date->format('j-n-Y');
			}

		}

	    $conditBill['status'] = 2;
	    $conditBill['id_member'] = $infoMember->id_member;
	    $conditBill['id_spa'] = $infoMember->id_spa;
	    
	   
	    $listDataBill = $modelUserserviceHistories->find()->where($conditBill)->order($order)->all()->toList();
	        $dayTotalBill= array();
	        foreach ($days as $item) {
	        	$dayTotalBill[$item] = 0;

	        }
	        if(!empty($listDataBill)){
	            foreach ($listDataBill as $item) {
	                $todayTime= getdate($item->created_at);

	                      // tính doanh thu theo ngày
	               @$dayTotalBill[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;
	    
	            }

	            if(!empty($dayTotalBill)){
	                foreach($dayTotalBill as $key => $item){
	                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
	                    $dayDataBill[]= array('time'=>$time , 'value'=>$item );
	                }
	            }
	        }
	        return apiResponse(1,'lấy dữ liệu Thành công',$dayDataBill);
                
            }
            return apiResponse(3,'không tồn tại tài khoản đại lý hoặc sai mã token');
            
        }
        return apiResponse(2, 'Gửi thiếu dữ liệu');
        
    }
    return apiResponse(0,' gửi sai kiểu POST ');
}
?>