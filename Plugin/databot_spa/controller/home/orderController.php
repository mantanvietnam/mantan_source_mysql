<?php 
function order($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Danh sách đối tác';

    if(!empty($session->read('infoUser'))){
		$user = $session->read('infoUser');

		$modelCombo = $controller->loadModel('Combos');
		$modelProduct = $controller->loadModel('Products');
		$modelService = $controller->loadModel('Services');
		$modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');

		$conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
		$listService = $modelService->find()->where($conditionsService)->all()->toList();

		$conditionsProduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
		$listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

		$conditionsCombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();
		$today= getdate();
		$conditionsStaff['OR'] = [ 
									['id'=>$user->id_member],
									['id_member'=>$user->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        $conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }

        // sử lý đơn hàng
		if($isRequestPost){
			$dataSend = $input['request']->getData();
		

			// tạo đơn hàng 
			$order = $modelOrder->newEmptyEntity();
			$order->id_member = $user->id_member;
			$order->id_spa =$user->id_spa;
			$order->id_staff =@$dataSend['id_Staff'];
			$order->id_customer =@$dataSend['id_customer'];
			$order->full_name = @$dataSend['full_name'];
			$order->id_bed =@$dataSend['id_bed'];
			$order->note =@$dataSend['note'];
			$order->created_at =date('Y-m-d H:i:s');
			$order->updated_at =date('Y-m-d H:i:s');
			$order->status =0;
			$order->promotion =@$dataSend['promotion'];
			$order->total =@$dataSend['total'];
			$order->total_pay =@$dataSend['totalPays'];
			$order->type =@$dataSend['typeOrder'];

			if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$order->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$order->time = time();
            }

            $modelOrder->save($order);
            // tạo chi tiêt dơn hàng 
            foreach($dataSend['idHangHoa'] as $key => $value){
                $detail = $modelOrderDetails->newEmptyEntity();

                $detail->id_member = $user->id_member;
                $detail->id_order = $order->id;
                $detail->id_product = $value;
                $detail->price = (int) $dataSend['money'][$key];
                $detail->quantity = (int) $dataSend['soluong'][$key];
                $detail->type = $dataSend['type'][$key];

                $modelOrderDetails->save($detail);

            }
            return $controller->redirect('/order?mess=1');
		}

	    setVariable('listService', $listService);
	    setVariable('listProduct', $listProduct);
	    setVariable('listCombo', $listCombo);
	    setVariable('today', $today);
	    setVariable('listRoom', $listRoom);
	    setVariable('listStaffs', $listStaffs);
	    setVariable('user', $user);

	}else{
		return $controller->redirect('/login');
	}
}

 ?>