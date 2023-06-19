<?php 
function chartUserNewAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê';

    $modelmember = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $mess= '';

    $order = array('created_at'=>'asc');


    $conditions = array();
    $conditProduct = array();

    if (!empty($_GET['timeView'])) {
        $conditions['created_at LIKE'] = '%'.$_GET['timeView'].'%';
        $conditProduct['approval_date LIKE'] = '%'.$_GET['timeView'].'%';
        $conditOrder['created_at LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditions['created_at LIKE'] = '%'.date('Y-m').'%';
        $conditProduct['approval_date LIKE'] = '%'.date('Y-m').'%';
        $conditOrder['created_at LIKE'] = '%'.date('Y-m').'%';
    }

    $conditProduct['status'] = 2;
    $conditOrder['type'] = 1;
   

    $listData = $modelmember->find()->where($conditions)->order($order)->all()->toList();
    $listDataProduct = $modelProducts->find()->where($conditProduct)->order($order)->all()->toList();
    $listDataOrder = $modelOrders->find()->where($conditOrder)->order($order)->all()->toList();

        $allDataMembers= array();
        $hourDataMembers= array();
        $dayDataMembers= array();
        $weekDataMembers= array();
        $monthDataMembers= array();
        $yearDataMembers= array();
        $totalRevenueMonth= 0;
        $totalRevenueDay= 0;
    

        $yearTotal= array();
        $monthTotal= array();
        $dayTotal= array();
        $hourTotal= array();
        $totalRevenueMonth = 0;
        $allData = 0;
        $totalRevenueDay = 0;
        
         $today = getdate();
        $listTime= array();
        if(!empty($listData)){
            foreach ($listData as $item) {
                $time= $item->created_at->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

                $allData += 1;
           


                $time+= 25200; // cộng thêm 7 tiếng
                $allDataMember[]= '{ time: '.$time.', value: 1 }';

                // tính doanh thu theo năm
                @$yearTotal[@$todayTime['year']] += 1;

                // tính doanh thu theo tháng
                @$monthTotal[$todayTime['mon'].'-'.$todayTime['year']] +=  1;

                // tính doanh thu theo ngày
               @$dayTotal[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;

      

                // tính doanh thu theo giờ
                @$hourTotal[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year'].' '.$todayTime['hours'].':0'] += 1;
                
                // tính doanh thu tháng hiện tại
                if(@$todayTime['year']==@$today['year'] && @$todayTime['mon']==@$today['mon']){
                    $totalRevenueMonth+= 1;
                }

                // tính doanh thu ngày hiện tại
                if(@$todayTime['year']==$today['year'] && @$todayTime['mon']==$today['mon'] && @$todayTime['mday']==@$today['mday']){
                    $totalRevenueDay+= 1;
                }
            }

            if(!empty($yearTotal)){
                $minYear= 5000;
                foreach($yearTotal as $key=>$item){
                    if($key<$minYear) $minYear= $key;
                    $time= strtotime('1-1-'.$key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $yearDataMembers[]= array('time'=>$time , 'value'=>$item );
                }
                $minYear-=1;
                $time= strtotime('1-1-'.$minYear.' 0:0:0')+25200; // cộng thêm 7 tiếng
                array_unshift($yearDataMembers , array('time'=>$time , 'value'=>0 ));
          }

            if(!empty($monthTotal)){
                foreach($monthTotal as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $monthDataMembers[]= array('time'=>$time , 'value'=>$item );
                }
            }

            if(!empty($dayTotal)){
                foreach($dayTotal as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataMembers[]= array('time'=>$time , 'value'=>$item );
                }
            }

            if(!empty($hourTotal)){
                foreach($hourTotal as $key=>$item){
                    $time= strtotime($key)+25200; // cộng thêm 7 tiếng
                    $hourDataMembers[]= array('time'=>$time , 'value'=> $item );
                }
            }

          
        }

        $dayDataProduct= array();

        if(!empty($listDataProduct)){
            foreach ($listDataProduct as $item) {
                 $time= $item->approval_date->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

                      // tính doanh thu theo ngày
               @$dayTotalProd[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;
    
            }

            if(!empty($dayTotalProd)){
                foreach($dayTotalProd as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataProduct[]= array('time'=>$time , 'value'=>$item );
                }
            }
        }

        $dayDataOrder= array();

        if(!empty($listDataOrder)){
            foreach ($listDataOrder as $item) {
                $time= $item->created_at->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

                      // tính doanh thu theo ngày
               @$dayTotalOrder[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += $item->total;
    
            }

            if(!empty($dayTotalOrder)){
                foreach($dayTotalOrder as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataOrder[]= array('time'=>$time , 'value'=>$item );
                }
            }
        }


        setVariable('today', $today);
        setVariable('monthTotal', $monthTotal);
        setVariable('allDataMembers', $allDataMembers);
        setVariable('yearDataMembers', $yearDataMembers);
        setVariable('monthDataMembers', $monthDataMembers);
        setVariable('dayDataMembers', $dayDataMembers);
        setVariable('dayDataProduct', $dayDataProduct);
        setVariable('dayDataOrder', $dayDataOrder);
        setVariable('hourDataMembers', $hourDataMembers);
}
function chartSampleApprovedAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê';

    $modelProducts = $controller->loadModel('Products');
    $mess= '';

    $order = array('created_at'=>'asc');


    $conditProduct = array();

    if (!empty($_GET['timeView'])) {
        $conditProduct['approval_date LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditProduct['approval_date LIKE'] = '%'.date('Y-m').'%';
    }

    $conditProduct['status'] = 2;

    $listDataProduct = $modelProducts->find()->where($conditProduct)->order($order)->all()->toList();

        $allDataMembers= array();
        $hourDataMembers= array();
        $dayDataMembers= array();
        $weekDataMembers= array();
        $monthDataMembers= array();
        $yearDataMembers= array();
        $totalRevenueMonth= 0;
        $totalRevenueDay= 0;
    

        $yearTotal= array();
        $monthTotal= array();
        $dayTotal= array();
        $hourTotal= array();
        $totalRevenueMonth = 0;
        $allData = 0;
        $totalRevenueDay = 0;
        
         $today = getdate();
        $listTime= array();
     
        $dayDataProduct= array();

        if(!empty($listDataProduct)){
            foreach ($listDataProduct as $item) {
                 $time= $item->approval_date->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

                      // tính doanh thu theo ngày
               @$dayTotalProd[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;
    
            }

            if(!empty($dayTotalProd)){
                foreach($dayTotalProd as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataProduct[]= array('time'=>$time , 'value'=>$item );
                }
            }
        }

       

        setVariable('dayDataProduct', $dayDataProduct);
}
function chartLoadMoneyAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê';

    $modelmember = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $mess= '';

    $order = array('created_at'=>'asc');

    $conditOrder = array();

    if (!empty($_GET['timeView'])) {
        $conditOrder['created_at LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditOrder['created_at LIKE'] = '%'.date('Y-m').'%';
    }

    $conditOrder['type'] = 1;
   
    $listDataOrder = $modelOrders->find()->where($conditOrder)->order($order)->all()->toList();

      
       
        $dayDataOrder= array();

        if(!empty($listDataOrder)){
            foreach ($listDataOrder as $item) {
                $time= $item->created_at->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

                      // tính doanh thu theo ngày
               @$dayTotalOrder[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += $item->total;
    
            }

            if(!empty($dayTotalOrder)){
                foreach($dayTotalOrder as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataOrder[]= array('time'=>$time , 'value'=>$item );
                }
            }
        }


        setVariable('dayDataOrder', $dayDataOrder);
}
 ?>