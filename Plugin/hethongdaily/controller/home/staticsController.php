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
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelCustomers = $controller->loadModel('Customers');

        $today = getdate();
        $start_day = mktime(0, 0, 0, 1, 1, $today['year']);
        $end_day = mktime(23, 59, 59, 12, 31, $today['year']);

        // đơn bán khách lẻ
        $listOrder = $modelOrders->find()->where(['id_agency'=>$infoMember->id, 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $staticOrder = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrder)){
            foreach ($listOrder as $key => $value) {
                $time = getdate($value->create_at);

                $staticOrder[$time['mon']] += $value->total;
            }
        }

        // đơn bán đại lý
        $listOrderMemberSell = $modelOrderMembers->find()->where(['id_member_sell'=>$infoMember->id, 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $staticOrderMemberSell = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrderMemberSell)){
            foreach ($listOrderMemberSell as $key => $value) {
                $time = getdate($value->create_at);

                $staticOrderMemberSell[$time['mon']] += $value->total;
            }
        }

        // đơn nhập hệ thống
        $listOrderMemberBuy = $modelOrderMembers->find()->where(['id_member_buy'=>$infoMember->id, 'create_at >='=>$start_day, 'create_at <='=>$end_day])->all()->toList();

        $staticOrderMemberBuy = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listOrderMemberBuy)){
            foreach ($listOrderMemberBuy as $key => $value) {
                $time = getdate($value->create_at);

                $staticOrderMemberBuy[$time['mon']] += $value->total;
            }
        }

        // khách hàng mới
        $listCustomer = $modelCustomers->find()->where(['id_parent'=>$infoMember->id, 'created_at >='=>$start_day, 'created_at <='=>$end_day])->all()->toList();

        $staticCustomer = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        if(!empty($listCustomer)){
            foreach ($listCustomer as $key => $value) {
                $time = getdate($value->create_at);

                $staticCustomer[$time['mon']] += $value->total;
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