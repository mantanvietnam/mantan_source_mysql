<?php 
function checkDeadlineOrderAPI($input)
{
	global $controller;

	$modelOrders = $controller->loadModel('Orders');
	$modelManagers = $controller->loadModel('Managers');
	$modelHistories = $controller->loadModel('Histories');
	$modelZooms = $controller->loadModel('Zooms');

	$timeNow = time();
	$timeNext7p = $timeNow + 7*60;
	$number_extend = 0;
	$number_deadline = 0;

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

		        $number_extend++;
			}
		}
	}

	// khóa phòng hết hạn
	$conditions = ['dateEnd <=' => $timeNow, 'idZoom >'=>0];

	$listData = $modelOrders->find()->where($conditions)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $order) {
			$zoom = $modelZooms->find()->where(['id' => $order->idZoom])->first();

			if(!empty($zoom)){
				$zoom->idOrder = 0;
				$modelZooms->save($zoom);

				$number_deadline++;
			}

			$order->idZoom = 0;
			$modelOrders->save($order);
		}
	}

	return ['number_extend'=>$number_extend,'number_deadline'=>$number_deadline];
}