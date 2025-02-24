<?php 
function revenueStatistical($input){
	global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

    
    setVariable('page_view', 'revenueStatistical');
    if(!empty(checkLoginManager('revenueStatistical', 'static'))){

    	$metaTitleMantan = 'Thống kê doanh thu';

	    $modelmember = $controller->loadModel('Members');
	    $modelBill = $controller->loadModel('Bills');
	    $mess= '';
	    $user = $session->read('infoUser');

	    $order = array('time'=>'asc');

	    $conditBill = array();

	     if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditBill['time >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $start = trim($date_start[2]).'-'.trim($date_start[1]).'-'.trim($date_start[0]);
        }else{
        	$conditBill['time >='] = strtotime('first day of this month 00:00:00');
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditBill['time <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
            $end = trim($date_end[2]).'-'.trim($date_end[1]).'-'.trim($date_end[0]);
        }else{
        	$conditBill['time <='] = time();
        }

	    $conditBill['type'] = 0;
	    $conditBill['id_member'] = $user->id_member;
	    $conditBill['id_spa'] = $user->id_spa;
	    
	   
	    $listDataBill = $modelBill->find()->where($conditBill)->order($order)->all()->toList();

	    if(empty($_GET['date_start']) && empty($_GET['date_end'])){
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

	        setVariable('dayDataBill', $dayDataBill);
	}else{
		return $controller->redirect('/');
	}
}

function userServicestatistical($input){
		global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

    
    setVariable('page_view', 'userServicestatistical');
    if(!empty(checkLoginManager('revenueStatistical', 'static'))){

    	$metaTitleMantan = 'Thống kê doanh thu';

	    $modelmember = $controller->loadModel('Members');
	    $modelBill = $controller->loadModel('Bills');
	    $mess= '';
	    $user = $session->read('infoUser');

	    $order = array('created_at'=>'asc');

        $modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

	    $conditBill = array();

	     if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditBill['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            $start = trim($date_start[2]).'-'.trim($date_start[1]).'-'.trim($date_start[0]);
        }else{
        	$conditBill['created_at >='] = strtotime('first day of this month 00:00:00');
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditBill['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
            $end = trim($date_end[2]).'-'.trim($date_end[1]).'-'.trim($date_end[0]);
        }else{
        	$conditBill['created_at <='] = time();
        }


        if(empty($_GET['date_start']) && empty($_GET['date_end'])){
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
	    $conditBill['id_member'] = $user->id_member;
	    $conditBill['id_spa'] = $user->id_spa;
	    
	   
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

	        setVariable('dayDataBill', $dayDataBill);
	}else{
		return $controller->redirect('/');
	}
}
?>