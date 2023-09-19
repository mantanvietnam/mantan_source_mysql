<?php 
function revenueStatistical($input){
	global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

    

    if(!empty($session->read('infoUser'))){

    	$metaTitleMantan = 'Thống kê doanh thu';

	    $modelmember = $controller->loadModel('Members');
	    $modelBill = $controller->loadModel('Bills');
	    $mess= '';
	    $user = $session->read('infoUser');

	    $order = array('created_at'=>'asc');

	    $conditBill = array();

	    if (!empty($_GET['timeView'])) {
	        $conditBill['created_at LIKE'] = '%'.$_GET['timeView'].'%';
	    }else{
	        $conditOrder['created_at LIKE'] = "%".date('Y-m')."%";
	    }

	    $conditBill['type'] = 0;
	    $conditBill['id_member'] = $user->id_member;
	    $conditBill['id_spa'] = $user->id_spa;
	    
	   
	    $listDataBill = $modelBill->find()->where($conditBill)->order($order)->all()->toList();

	      
	       
	        $dayDataBill= array();

	        if(!empty($listDataBill)){
	            foreach ($listDataBill as $item) {
	                $time= @$item->created_at->toDateTimeString();
	                $time = strtotime($time);
	                $todayTime= getdate($time);

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
		return $controller->redirect('/login');
	}
}


?>