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
                $time = getdate($value->create_at);

                $staticOrder[$time['mon']] += $value->total;
            }
        }

        // đơn bán đại lý
        // $listOrderMemberSell = $modelOrderMembers->find()->where(['id_member_sell'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $listOrderMemberSell = $modelBill->find()->where(['id_member_sell'=>$infoMember->id, 'type'=>1,'type_order'=> 1,'created_at >='=>$start_day, 'created_at <='=>$end_day])->all()->toList();

        $staticOrderMemberSell = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrderMemberSell)){
            foreach ($listOrderMemberSell as $key => $value) {
                $time = getdate($value->create_at);

                $staticOrderMemberSell[$time['mon']] += $value->total;
            }
        }

        // đơn nhập hệ thống
        $listOrderMemberBuy = $modelOrderMembers->find()->where(['id_member_buy'=>$infoMember->id, 'status'=>'done', 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $staticOrderMemberBuy = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrderMemberBuy)){
            foreach ($listOrderMemberBuy as $key => $value) {
                $time = getdate($value->create_at);

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