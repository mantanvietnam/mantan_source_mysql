<?php 
function chartUserNewAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê đăng ký';

    $modelmember = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $mess= '';

    $order = array('created_at'=>'asc');


    $conditions = array();
    $conditProduct = array();

    if (!empty($_GET['timeView'])) {
        $conditions['created_at LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditions['created_at LIKE'] = "%".date('Y-m')."%";
    }

    $listData = $modelmember->find()->where($conditions)->order($order)->all()->toList();



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
            $total = count($listData);
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
        setVariable('total',$total);
        setVariable('today', $today);
        setVariable('monthTotal', $monthTotal);
        setVariable('allDataMembers', $allDataMembers);
        setVariable('yearDataMembers', $yearDataMembers);
        setVariable('monthDataMembers', $monthDataMembers);
        setVariable('dayDataMembers', $dayDataMembers);
        setVariable('hourDataMembers', $hourDataMembers);
}
function chartSampleApprovedAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê duyệt mẫu';

    $modelProducts = $controller->loadModel('Products');
    $mess= '';

    $order = array('approval_date'=>'asc');


    $conditProduct = array();

    if (!empty($_GET['timeView'])) {
        $conditProduct['approval_date LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditProduct['approval_date LIKE'] = "%".date('Y-m').'%';
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

    $metaTitleMantan = 'Thống kê mạp tiền';

    $modelmember = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $mess= '';

    $order = array('created_at'=>'asc');

    $conditOrder = array();

    if (!empty($_GET['timeView'])) {
        $conditOrder['created_at LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditOrder['created_at LIKE'] = "%".date('Y-m')."%";
    }

    $conditOrder['type'] = 1;
    $conditOrder['status'] = 2;
    
    $conditOrder['payment_kind'] = 1;
   
    $listDataOrder = $modelOrders->find()->where($conditOrder)->order($order)->all()->toList();

      
       
        $dayDataOrder= array();

        if(!empty($listDataOrder)){
            foreach ($listDataOrder as $item) {
                $time= @$item->created_at->toDateTimeString();
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
function chartUserLastloginAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê đăng ký';

    $modelmember = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $mess= '';

    $order = array('last_login'=>'asc');


    $conditions = array();
    $conditProduct = array();

    if (!empty($_GET['timeView'])) {
        $conditions['created_at LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditions['created_at LIKE'] = "%".date('Y-m')."%";
    }

    $listData = $modelmember->find()->where($conditions)->order($order)->all()->toList();



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
                if(!empty($item->last_login)){
                $time= @$item->last_login->toDateTimeString();
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

       

        setVariable('today', $today);
        setVariable('dayDataMembers', $dayDataMembers);
}
function chartOrberProductAdmin() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê mạp tiền';

    $modelmember = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $mess= '';

    $order = array('created_at'=>'asc');

    $conditOrder = array();

    if (!empty($_GET['timeView'])) {
        $conditOrder['created_at LIKE'] = '%'.$_GET['timeView'].'%';
    }else{
        $conditOrder['created_at LIKE'] = "%".date('Y-m')."%";
    }

    $conditOrder['type'] = 0;
    $conditOrder['status'] = 2;
    
   
    $listDataOrder = $modelOrders->find()->where($conditOrder)->order($order)->all()->toList();

      
       
        $dayDataOrder= array();

        if(!empty($listDataOrder)){
            foreach ($listDataOrder as $item) {
                $time= @$item->created_at->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

                      // tính doanh thu theo ngày
               @$dayTotalOrder[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;
    
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

function statisticalAdmin($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê nhanh';

    $modelMember = $controller->loadModel('Members');
    $modelOrder = $controller->loadModel('Orders');
    $modelContact = $controller->loadModel('Contact');
    $modelProduct = $controller->loadModel('Products');
    $modelWarehouse = $controller->loadModel('Warehouses');

    $return = array('code'=>0);

     $conditionUser = array('type'=> 0, 'status'=> 1);
     $conditionMember = array('status'=> 1);
     $conditionDesigner = array('type'=> 1, 'status'=> 1);
     $conditionWarehouse = array();

    $conditionOrderBanking = array('payment_type'=> 1,'type'=>1, 'payment_kind'=> 1, 'status'=>2);
    $conditionOrderApple = array('payment_type'=> 2,'type'=>1, 'payment_kind'=> 1, 'status'=>2);
     $conditionOrder = array('payment_kind'=> 1, 'status'=>2);

     $conditionDesignerNew = array('type'=> 1, 'status'=> 0);
     $conditionDesignerApproved = array('type'=> 1, 'status'=> 1);

    $conditionlastlogin['last_login <='] = date('Y-m-d H:i:s');
    $conditionlastlogin['last_login >='] = date('Y-m-d H:i:s', strtotime('-7 days', strtotime(date('Y-m-d 00:00:00'))));
    

    if(!empty($_GET['date_start'])){
        $date_start = explode('/', $_GET['date_start']);
        $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        $conditionMember['created_at >='] = date('Y-m-d H:i:s', $date_start);

        $conditionUser['created_at >='] = date('Y-m-d H:i:s', $date_start);
        $conditionDesigner['created_at >='] = date('Y-m-d H:i:s', $date_start);
        $conditionDesignerNew['created_at >='] = date('Y-m-d H:i:s', $date_start);
        $conditionDesignerApproved['updated_at >='] = date('Y-m-d H:i:s', $date_start);

        $conditionOrderBanking['created_at >='] = date('Y-m-d H:i:s', $date_start);
        $conditionOrderApple['created_at >='] = date('Y-m-d H:i:s', $date_start);
        $conditionProduct['approval_date >='] = date('Y-m-d H:i:s', $date_start);


        $conditionWarehouse['created_at >='] = date('Y-m-d H:i:s', $date_start);

    }

    if(!empty($_GET['date_end'])){
        $date_end = explode('/', $_GET['date_end']);
        $date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
        $conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);

        $conditionUser['created_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionMember['created_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionDesigner['created_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionDesignerNew['created_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionDesignerApproved['updated_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionOrderBanking['updated_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionOrderApple['created_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionProduct['created_at <='] = date('Y-m-d H:i:s', $date_end);
        $conditionWarehouse['created_at <='] = date('Y-m-d H:i:s', $date_end);

    }


    $totaUser = $modelMember->find()->where($conditionUser)->all()->toList();
    $totaUser = count($totaUser);
    $totaUserlastlogin = $modelMember->find()->where($conditionlastlogin)->all()->toList();

    
    $totaUserlastlogin = count($totaUserlastlogin);
    
    $totaDesignerApproved = $modelContact->find()->where($conditionDesignerApproved)->all()->toList();
    $totaDesignerApproved = count($totaDesignerApproved);

    $totaDesignerNew = $modelContact->find()->where($conditionDesignerNew)->all()->toList();
    $totaDesignerNew = count($totaDesignerNew);


    $totalDataOrderBanking = $modelOrder->find()->where(@$conditionOrderBanking)->all()->toList();
   $OrderBanking = 0;

     if(!empty($totalDataOrderBanking)){
        foreach ($totalDataOrderBanking as $item) {
           @$OrderBanking += $item->total;
        }
    }

    $totalDataOrderApple = $modelOrder->find()->where(@$conditionOrderApple)->all()->toList();
   $OrderApple = 0;

     if(!empty($totalDataOrderApple)){
        foreach ($totalDataOrderApple as $item) {
           @$OrderApple += $item->total;
        }
    }

    
    $conditionProduct['status'] = 2;
    $conditionProduct['type'] = 'user_create';

    $totalDataProduct = $modelProduct->find()->where($conditionProduct)->all()->toList();
    $totalDataProduct = count($totalDataProduct);

    $conditionProduct['status'] = 1;
    $conditionProduct['type'] = 'user_create';

    $totalDataProductPen = $modelProduct->find()->where($conditionProduct)->all()->toList();
    $totalDataProductPen = count($totalDataProductPen);

    $totalDataWarehouse = $modelWarehouse->find()->where($conditionWarehouse)->all()->toList();
    $totalDataWarehouse = count($totalDataWarehouse);


    setVariable('totaUser', $totaUser);
    setVariable('totaDesignerApproved', $totaDesignerApproved);
    setVariable('totaDesignerNew', $totaDesignerNew);
    setVariable('OrderBanking', $OrderBanking);
    setVariable('OrderApple', $OrderApple);
    setVariable('totalDataProduct', $totalDataProduct);
    setVariable('totalDataProductPen', $totalDataProductPen);
    setVariable('totalDataWarehouse', $totalDataWarehouse);
    setVariable('totaUserlastlogin', $totaUserlastlogin);

}
?>