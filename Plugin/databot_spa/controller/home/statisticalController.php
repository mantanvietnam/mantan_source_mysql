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

	    $order = array('created_at'=>'asc');

	    $conditBill = array();

	     if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditBill['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }else{
        	$conditBill['created_at >='] = strtotime('first day of this month 00:00:00');
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditBill['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
        }else{
        	$conditBill['created_at <='] = time();
        }

	    $conditBill['type'] = 0;
	    $conditBill['id_member'] = $user->id_member;
	    $conditBill['id_spa'] = $user->id_spa;
	    
	   
	    $listDataBill = $modelBill->find()->where($conditBill)->order($order)->all()->toList();

	      
	       
	        $dayDataBill= array();

	        if(!empty($listDataBill)){
	            foreach ($listDataBill as $item) {
	                $time= @
	                $todayTime= getdate($item->created_at);

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
        }else{
        	$conditBill['created_at >='] = strtotime('first day of this month 00:00:00');
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditBill['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
        }else{
        	$conditBill['created_at <='] = time();
        }

	    $conditBill['status'] = 2;
	    $conditBill['id_member'] = $user->id_member;
	    $conditBill['id_spa'] = $user->id_spa;
	    
	   
	    $listDataBill = $modelUserserviceHistories->find()->where($conditBill)->order($order)->all()->toList();

	      
	       
	        $dayDataBill= array();

	        if(!empty($listDataBill)){
	            foreach ($listDataBill as $item) {
	                $time= @
	                $todayTime= getdate($item->created_at);

	                      // tính doanh thu theo ngày
	               @$dayTotalBill[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;
	    
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
?>