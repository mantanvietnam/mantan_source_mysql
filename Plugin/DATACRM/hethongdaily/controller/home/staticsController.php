<?php
function businessReport($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Báo cáo kinh doanh';

        $infoMember = $session->read('infoUser');

        $modelOrders = $controller->loadModel('Orders');
        $modelBill = $controller->loadModel('Bills');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelCustomers = $controller->loadModel('Customers');

        $today = getdate();
        $start_day = mktime(0, 0, 0, 1, 1, $today['year']);
        $end_day = mktime(23, 59, 59, 12, 31, $today['year']);

        // đơn bán khách lẻ
        // $listOrder = $modelOrders->find()->where(['id_agency'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();
        $listOrder = $modelBill->find()->where(['id_member_sell'=>$infoMember->id, 'type'=>1,'type_order'=> 2,'created_at >='=>$start_day, 'created_at <='=>$end_day])->all()->toList();


        $staticOrder = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrder)){
            foreach ($listOrder as $key => $value) {
                // $time = getdate($value->created_at);

                // debug($item);

                $staticOrder[(int) date('m', @$value->created_at)] += $value->total;
            }
        }
    

        // đơn bán đại lý
        // $listOrderMemberSell = $modelOrderMembers->find()->where(['id_member_sell'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $listOrderMemberSell = $modelBill->find()->where(['id_member_sell'=>$infoMember->id, 'type'=>1,'type_order'=> 1,'created_at >='=>$start_day, 'created_at <='=>$end_day])->all()->toList();

        $staticOrderMemberSell = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrderMemberSell)){
            foreach ($listOrderMemberSell as $key => $value) {
                $time = getdate($value->create_at);
                 $staticOrderMemberSell[(int)date('m', @$value->created_at)] += $value->total;

                // $staticOrderMemberSell[$time['mon']] += $value->total;
            }
        }

        // đơn nhập hệ thống
        $listOrderMemberBuy = $modelOrderMembers->find()->where(['id_member_buy'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $staticOrderMemberBuy = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrderMemberBuy)){
            foreach ($listOrderMemberBuy as $key => $value) {
                $time = getdate($value->create_at);

                // $staticOrderMemberBuy[$time['mon']] += $value->total;
                $staticOrderMemberBuy[$time['mon']] += $value->total;
            }
        }

        // khách hàng mới
        $join = [
                    [
                        'table' => 'category_connects',
                        'alias' => 'CategoryConnects',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Customers.id = CategoryConnects.id_parent',
                        ],
                    ]
                ];
                
        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

        $listCustomer = $modelCustomers->find()->join($join)->select($select)->where(['Customers.created_at >='=>$start_day, 'Customers.created_at <='=>$end_day, 'CategoryConnects.id_category'=>$infoMember->id, 'CategoryConnects.keyword'=>'member_customers'])->all()->toList();

        $staticCustomer = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listCustomer)){
            foreach ($listCustomer as $key => $value) {
                $time = getdate($value->created_at);
                $staticCustomer[$time['mon']] += 1;
            }
        }
        
        setVariable('today', $today);
        setVariable('staticOrder', $staticOrder);
        setVariable('staticOrderMemberSell', $staticOrderMemberSell);
        setVariable('staticOrderMemberBuy', $staticOrderMemberBuy);
        setVariable('staticCustomer', $staticCustomer);
        
    }else{
        return $controller->redirect('/login');
    }
}


function statisticAgency($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin();   

    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/statisticAgency');
      }
        $metaTitleMantan = 'Báo cáo kinh doanh';


        $modelOrders = $controller->loadModel('Orders');
        $modelMembers = $controller->loadModel('Members');
        $modelBill = $controller->loadModel('Bills');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelCustomers = $controller->loadModel('Customers');
        $modelProducts = $controller->loadModel('Products');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        $today = getdate();
        $start_day = mktime(0, 0, 0, $today['mon'], 1, $today['year']);
        $end_day = time();

        // đơn bán khách lẻ
        // $listOrder = $modelOrders->find()->where(['id_agency'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();
        $listOrder = $modelBill->find()->where(['id_member_sell'=>$user->id, 'type'=>1,'type_order'=> 2,'created_at >='=>$start_day, 'created_at <='=>$end_day])->all()->toList();


        $staticOrder = array();
        if(!empty($listOrder)){
            foreach ($listOrder as $key => $value) {
                @$staticOrder[(int) date('d', @$value->created_at)] += $value->total;
            }
        }

        

    

        // đơn bán đại lý
        // $listOrderMemberSell = $modelOrderMembers->find()->where(['id_member_sell'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $listOrderMemberSell = $modelBill->find()->where(['id_member_sell'=>$user->id, 'type'=>1,'type_order'=> 1,'created_at >='=>$start_day, 'created_at <='=>$end_day])->all()->toList();

        $staticOrderMemberSell = array();
        if(!empty($listOrderMemberSell)){
            foreach ($listOrderMemberSell as $key => $value) {
                $time = getdate($value->create_at);
                 @$staticOrderMemberSell[(int) date('d', @$value->created_at)] += $value->total;

                // $staticOrderMemberSell[$time['mon']] += $value->total;
            }
        }

        // đơn nhập hệ thống
        $listOrderMemberBuy = $modelOrderMembers->find()->where(['id_member_buy'=>$user->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $staticOrderMemberBuy = array();
        if(!empty($listOrderMemberBuy)){
            foreach ($listOrderMemberBuy as $key => $value) {
                $time = getdate($value->create_at);

                // $staticOrderMemberBuy[$time['mon']] += $value->total;
                @$staticOrderMemberBuy[(int) date('d', @$value->created_at)] += $value->total;
            }
        }

        // khách hàng mới
        $join = [
                    [
                        'table' => 'category_connects',
                        'alias' => 'CategoryConnects',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Customers.id = CategoryConnects.id_parent',
                        ],
                    ]
                ];
                
        $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

        $listCustomer = $modelCustomers->find()->join($join)->select($select)->where(['Customers.created_at >='=>$start_day, 'Customers.created_at <='=>$end_day, 'CategoryConnects.id_category'=>$user->id, 'CategoryConnects.keyword'=>'member_customers'])->all()->toList();

        $staticCustomer = array();
        if(!empty($listCustomer)){
            foreach ($listCustomer as $key => $value) {
                $time = getdate($value->created_at);
                @$staticCustomer[(int) date('d', @$value->created_at)] += 1;
            }
        }

        // Thời gian đầu ngày
        $startOfDay = strtotime("today 00:00:00");
        // Thời gian cuối ngày
        $endOfDay = strtotime("tomorrow 00:00:00") - 1;
                    

        $conditions = array('id_agency'=>$user->id,  'create_at >='=>$startOfDay,'create_at <='=>$endOfDay);
        $order = array('id'=>'desc');
        // lấy danh sách đơn hàng khách hàng trong ngày hôn nay
        $listDataOrder = $modelOrders->find()->where($conditions)->order($order)->all()->toList();
        if(!empty($listDataOrder)){
            foreach($listDataOrder as $key => $item){
                $detail_order = $modelOrderDetails->find()->where(['id_order'=>$item->id])->all()->toList();

                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                            $detail_order[$k]->product = $product->title;

                            if(!empty($value->id_unit)){
                                $unit = $modelUnitConversion->find()->where(['id'=>$value->id_unit ])->first();
                                if(!empty($unit)){
                                    $detail_order[$k]->unit = $unit->unit;
                                }
                            }else{
                                if(!empty($product->unit)){
                                    $detail_order[$k]->unit = @$product->unit;
                                }   
                            }
                        }
                    }

                    $listDataOrder[$key]->detail_order = $detail_order;
                }else{
                    $listDataOrder[$key]->detail_order = [];
                }

                $listDataOrder[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_user ])->first();
            }
        }

        $totalDataOrder = count($listDataOrder);

        // lấy danh sách đơn hang của đại lý 
        $conditions = array('id_member_sell'=>$user->id,  'create_at >='=>$startOfDay,'create_at <='=>$endOfDay);
        $order = array('id'=>'desc');
        $listDataOrderMembers = $modelOrderMembers->find()->where($conditions)->order($order)->all()->toList();
        if(!empty($listDataOrderMembers)){
            foreach($listDataOrderMembers as $key => $item){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();

                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                            $detail_order[$k]->product = $product->title;

                            if(!empty($value->id_unit)){
                                $unit = $modelUnitConversion->find()->where(['id'=>$value->id_unit ])->first();
                                if(!empty($unit)){
                                    $detail_order->unit = $unit->unit;
                                }
                            }else{
                                if(!empty($product->unit)){
                                    $detail_order[$k]->unit = @$product->unit;
                                }
                            }
                        }
                    }

                    $listDataOrderMembers[$key]->detail_order = $detail_order;
                }else{
                    $listDataOrderMembers[$key]->detail_order = [];
                }

                $listDataOrderMembers[$key]->buyer = $modelMembers->find()->where(['id'=>$item->id_member_buy ])->first();
            }
            
        }

        $totalDataOrderMembers = count($listDataOrderMembers);

        $conditions = array('id_parent'=>$user->id, 'created_at >='=>$startOfDay,'created_at <='=>$endOfDay);
                  
        $order = array('id'=>'desc');

        $listDataCustomer = $modelCustomers->find()->where($conditions)->order($order)->all()->toList();
                    
        $totalDataCustomer = count($listDataCustomer);
        
        setVariable('today', $today);
        setVariable('user', $user);
        setVariable('staticOrder', $staticOrder);
        setVariable('staticOrderMemberSell', $staticOrderMemberSell);
        setVariable('staticOrderMemberBuy', $staticOrderMemberBuy);
        setVariable('staticCustomer', $staticCustomer);
        setVariable('listDataOrder', $listDataOrder);
        setVariable('totalDataOrder', $totalDataOrder);
        setVariable('listDataOrderMembers', $listDataOrderMembers);
        setVariable('totalDataOrderMembers', $totalDataOrderMembers);
        setVariable('listDataCustomer', $listDataCustomer);
        setVariable('totalDataCustomer', $totalDataCustomer);
        
    }else{
        return $controller->redirect('/login');
    }
}

function staticProfitAgency($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

   $user = checklogin('staticProfitAgency');   

    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/statisticAgency');
      }
        $metaTitleMantan = 'Báo cáo kinh doanh';

        $modelOrders = $controller->loadModel('Orders');
        $modelBill = $controller->loadModel('Bills');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelCustomers = $controller->loadModel('Customers');

        $today = getdate();
        $start_day = mktime(0, 0, 0, 1, 1, $today['year']);
        $end_day = mktime(23, 59, 59, 12, 31, $today['year']);

       // $conditions = array('created_at >='=>$start_day, 'created_at <='=>$end_day);
        $conditions = array();
        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        $conditions['OR'] = [
                            ['id_member_sell'=>$user->id,'type'=>1],
                            ['id_member_buy'=>$user->id,'type'=>2],
                    ];
        // đơn bán khách lẻ
        // $listOrder = $modelOrders->find()->where(['id_agency'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();
        $listOrder = $modelBill->find()->where($conditions)->order(['created_at' => 'desc'])->all()->toList();


        $staticOrder = array();

        if(!empty($listOrder)){
            foreach ($listOrder as $key => $value) {
                 $todayTime= date('m/Y',$value->created_at);
                $thu = 0;
                $chi = 0;
                if($value->type==1){
                     $thu = $value->total;
                }else{
                     $chi = $value->total;                 
                }
             $staticOrder[@$todayTime]['thu'] = @$staticOrder[@$todayTime]['thu']+$thu;
             $staticOrder[@$todayTime]['chi'] = @$staticOrder[@$todayTime]['chi']+$chi;
             $staticOrder[@$todayTime]['profit'] = @$staticOrder[@$todayTime]['profit']+ ($thu - $chi);
              //  $staticOrder[(int) date('m', @$value->created_at)] += $value->total;

            }
        }        
        
        setVariable('today', $today);
        setVariable('staticOrder', $staticOrder);
        
    }else{
        return $controller->redirect('/login');
    }
}
?>