<?php 
function chartFollow() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

  

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thống kê follow';

        $modelmember = $controller->loadModel('Members');

        $modelFollowDesigner = $controller->loadModel('FollowDesigners');

        $order = array('created_at'=>'asc');
        $user = $session->read('infoUser');


        $conditOrder = array();

        $conditOrder['designer_id']= $user->id;

        if (!empty($_GET['timeView'])) {
            $conditOrder['created_at LIKE'] = '%'.$_GET['timeView'].'%';
        }else{
            $conditOrder['created_at LIKE'] = '%'.date('Y-m').'%';
        }
   
        $listDataFollow = $modelFollowDesigner->find()->where($conditOrder)->order($order)->all()->toList();

       
        $dayDataFollow= array();
        $dayTotalFollow= array();

        if(!empty($listDataFollow)){
            foreach ($listDataFollow as $item) {
                $time= $item->created_at->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

               @$dayTotalFollow[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += 1;
    
            }

            if(!empty($dayTotalFollow)){
                foreach($dayTotalFollow as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataFollow[]= array('time'=>$time , 'value'=>$item );
                }
            }
        }


        setVariable('dayDataFollow', $dayDataFollow);
    }else{
        return $controller->redirect('/login');
    }
}

function chartSellProduct() {

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;

  

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thống kê';

        $modelmember = $controller->loadModel('Members');

        $modelOrders = $controller->loadModel('Orders');

        $order = array('created_at'=>'asc');
        $user = $session->read('infoUser');


        $conditOrder = array();

        $conditOrder['member_id']= $user->id;
        $conditOrder['type']= 3;

        if (!empty($_GET['timeView'])) {
            $conditOrder['created_at LIKE'] = '%'.$_GET['timeView'].'%';
        }else{
            $conditOrder['created_at LIKE'] = '%'.date('Y-m').'%';
        }
   
        $listDataOrders = $modelOrders->find()->where($conditOrder)->order($order)->all()->toList();

        $dayDataOrders= array();
        $dayTotalOrders= array();

        if(!empty($listDataOrders)){
            foreach ($listDataOrders as $item) {
                $time= $item->created_at->toDateTimeString();
                $time = strtotime($time);
                $todayTime= getdate($time);

               @$dayTotalOrders[$todayTime['mday'].'-'.$todayTime['mon'].'-'.$todayTime['year']] += $item->total;
    
            }

            if(!empty($dayTotalOrders)){
                foreach($dayTotalOrders as $key=>$item){
                    $time= strtotime($key.' 0:0:0')+25200; // cộng thêm 7 tiếng
                    $dayDataOrders[]= array('time'=>$time , 'value'=>$item );
                }
            }
        }

        setVariable('dayDataOrders', $dayDataOrders);
    }else{
        return $controller->redirect('/login');
    }
}
?>