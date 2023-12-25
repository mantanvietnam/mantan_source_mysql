<?php
function deleteRoomAdmin($input){
	global $controller;

	$modelRooms = $controller->loadModel('Rooms');
	$modelOrders = $controller->loadModel('Orders');
	$modelZooms = $controller->loadModel('Zooms');
	
	if(!empty($_GET['idOrder'])){
		$order = $modelOrders->find()->where(['id'=>(int)$_GET['idOrder']])->first(); 
		if($order){
			if(!empty($order->idRoom)){
				$room = $modelRooms->find()->where(['id'=>$order->idRoom])->first(); 
				$zoom = $modelZooms->find()->where(['id'=>$order->idZoom])->first(); 

				$order->idRoom = 0;
         		$modelOrders->save($order);

				if(!empty($room)){
					$modelRooms->delete($room);

					$room->info = json_decode($room->info, true);

					closeRoom($zoom->client_id, $zoom->client_secret, $zoom->account_id, $room->info['id']);
				}
			}
        }
	}

	return $controller->redirect('/plugins/admin/zoomcheap-view-admin-order-listOrderZoomAdmin');
}