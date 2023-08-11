<?php 
function checkDeadlineOrderAPI($input)
{
	global $controller;

	$modelOrders = $controller->loadModel('Orders');
	$modelManagers = $controller->loadModel('Managers');
	$modelHistories = $controller->loadModel('Histories');
	$modelZooms = $controller->loadModel('Zooms');
	$modelRooms = $controller->loadModel('Rooms');

	$timeNow = time();
	$timeNext7p = $timeNow + 7*60;
	$number_extend = [];
	$number_deadline = [];
	$number_deadline_zoom = [];

	// gia hạn tự động
	$conditions = ['dateEnd >=' => $timeNow, 'dateEnd <='=>$timeNext7p, 'extend_time_use'=>1];

	$listData = $modelOrders->find()->where($conditions)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $order) {
			$infoManager = $modelManagers->find()->where(['id' => $order->idManager])->first();

			if(!empty($infoManager->coin) && $infoManager->coin >= $order->price){
				// trừ tiền tài khoản
				$infoManager->coin -= $order->price;
				$modelManagers->save($infoManager);

				// lưu lịch sử giao dịch
				$dataHistories = $modelHistories->newEmptyEntity();

		        $dataHistories->time = time();
		        $dataHistories->idManager = $infoManager->id;
		        $dataHistories->numberCoin = $order->price;
		        $dataHistories->numberCoinManager = $infoManager->coin;
		        $dataHistories->type = 'minus';
		        $dataHistories->note = 'Tự động gia hạn đơn hàng thuê Zoom '.$dataSend['type'];
		        $dataHistories->type_note = 'minus_order';
		        $dataHistories->modified = time();
		        $dataHistories->created = time();

		        $modelHistories->save($dataHistories);

		        // thêm thời gian cho đơn hàng
		        $order->dateEnd += $order->numberHour * 60 * 60;
		        $modelOrders->save($order);

		        $number_extend[] = $order->id;
			}
		}
	}

	// khóa phòng hết hạn
	$conditions = ['dateEnd <=' => $timeNow, 'idZoom >'=>0];

	$listData = $modelOrders->find()->where($conditions)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $order) {
			$zoom = $modelZooms->find()->where(['id' => $order->idZoom])->first();

			$order->idZoom = 0;
			$modelOrders->save($order);
			
			if(!empty($zoom)){
				$zoom->idOrder = 0;
				$modelZooms->save($zoom);

				$number_deadline[] = $order->id;

				// báo sang Zoom để khóa phòng
				$room = $modelRooms->find()->where(['id' => $order->idRoom])->first();
				$room->info = json_decode($room->info, true);

				closeRoom($zoom->client_id, $zoom->client_secret, $zoom->account_id, $room->info['id']);
			}
		}
	}

	// khóa tài khoản Zoom hết hạn
	$listDeadlineZoom = $modelZooms->find()->where(['deadline >'=>0, 'deadline <'=>time(), 'status'=>'active'])->all()->toList();

	if(!empty($listDeadlineZoom)){
		foreach ($listDeadlineZoom as $key => $value) {
			$value->status = 'lock';

			$modelZooms->save($value);

			$number_deadline_zoom[] = $value->id;
		}
	}

	return ['number_extend'=>$number_extend, 'number_deadline_order'=>$number_deadline, 'number_deadline_zoom'=>$number_deadline_zoom];
}

function addMoneyTPBankAPI($input)
{
	global $controller;

	$return['messages']= array(array('text'=>''));

	$modelManagers = $controller->loadModel('Managers');
	$modelHistories = $controller->loadModel('Histories');

	if(!empty($_POST['message'])){

	 	$keyApp= 'THUEZOOM';

		$message = strtoupper($_POST['message']);

		$description = explode('ND: ', $message);
		$description = trim($description[1]);
		$description = str_replace(array('IBFT ','THANH TOAN QR ','QR - '), '', $description);

		$money = explode('PS:+', $message);
		$money = explode('SD:', $money[1]);
		$money = (int) str_replace(array('.','VND'), '', $money[0]);

		if($money>0 && strlen(strstr($description, $keyApp)) > 0){
			// xóa dấu chấm
			$removeDot = explode('.', $description);
			if(count($removeDot)>1){
				for($i=0;$i<count($removeDot);$i++){
					if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
						$description = $removeDot[$i];
						break;
					}
				}
			}

			// xóa dấu chấm phẩy
			$removeDot = explode(';', $description);
			if(count($removeDot)>1){
				for($i=0;$i<count($removeDot);$i++){
					if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
						$description = $removeDot[$i];
						break;
					}
				}
			}

			// xóa dấu gạch ngang
			$removeDot = explode('-', $description);
			if(count($removeDot)>1){
				for($i=0;$i<count($removeDot);$i++){
					if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
						$description = $removeDot[$i];
						break;
					}
				}
			}


			$removeSpace = explode(' ', trim($description));
			$phone = $removeSpace[0];
			$phone= str_replace(array(' ','.','-'), '', $phone);
			$phone = str_replace('+84','0',$phone);

			$infoUser = $modelManagers->find()->where(['phone'=>$phone])->first();

			if(!empty($infoUser)){
				// cộng tiền tài khoản
				$infoUser->coin += $money;
				$modelManagers->save($infoUser);

				// lưu lịch sử giao dịch
				$dataHistories = $modelHistories->newEmptyEntity();

		        $dataHistories->time = time();
		        $dataHistories->idManager = $infoUser->id;
		        $dataHistories->numberCoin = $money;
		        $dataHistories->numberCoinManager = $infoUser->coin;
		        $dataHistories->type = 'plus';
		        $dataHistories->note = 'Nạp tiền tài khoản qua chuyển khoản';
		        $dataHistories->type_note = 'plus_banking';
		        $dataHistories->modified = time();
		        $dataHistories->created = time();

		        $modelHistories->save($dataHistories);

		        if(!empty($infoUser->email)){
		        	sendEmailAddMoney($infoUser->email, $infoUser->fullname, $money);
		    	}

		        $mess = 'Cộng thành công '.number_format($money).'đ cho tài khoản '.$phone;
			}else{
				$mess = 'Không tìm thấy tài khoản khách hàng';
			}

			$return['messages']= array(array('text'=>$mess));
		} else {
			$return['messages']= array(array('text'=>'Sai cú pháp hoặc số tiền không đủ'));
		}
   	 	
	}else{
		$return['messages']= array(array('text'=>'Gửi thiếu nội dung SMS'));
	}

	return $return;
}

function updateInfoRoomAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelManagers = $controller->loadModel('Managers');
	$modelOrders = $controller->loadModel('Orders');
	$modelRooms = $controller->loadModel('Rooms');
	$modelZooms = $controller->loadModel('Zooms');

	if(!empty($session->read('infoUser'))){
		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['idRoom'])){
				$room = $modelRooms->find()->where(['id'=>(int) $dataSend['idRoom'], 'idManager'=>$session->read('infoUser')->id])->first();

				if(!empty($room)){
					$order = $modelOrders->find()->where(['id'=>$room->id_order, 'idManager'=>$session->read('infoUser')->id])->first();

					if(!empty($order)){
						$order->extend_time_use = (int) $dataSend['extend_time_use'];

						$modelOrders->save($order);
					}
				}
			}
		}
	}

	return ['code'=>1, 'order'=>$order, 'room'=>$room];
}