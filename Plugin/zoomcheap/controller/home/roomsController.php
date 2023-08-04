<?php


function createRoom($input)
{
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
		if(!empty($_GET['idOrder'])){
			$modelManagers = $controller->loadModel('Managers');
			$modelOrders = $controller->loadModel('Orders');
			$modelRooms = $controller->loadModel('Rooms');
			$modelZooms = $controller->loadModel('Zooms');

			$order = $modelOrders->find()->where(['id'=> (int) $_GET['idOrder'], 'idManager'=>$session->read('infoUser')->id, 'idRoom'=>0, 'dateEnd >='=>time()])->first();

			if(!empty($order)){
				$zoom = $modelZooms->find()->where(['id'=> $order->idZoom, 'status'=>'active'])->first();

				if(empty($zoom)){
					// tìm tài khoản zoom khác thay thế
					$zoomNew = $modelZooms->find()->where(['type'=>$order->type, 'status'=>'active', 'idOrder'=>0])->first();

					if(!empty($zoomNew)){
						// sửa ở đơn hàng
						$order->idZoom = $zoomNew->id;
						$modelOrders->save($order);

						// cập nhập tài khoản zoom mới
				        $zoomNew->idOrder = $order->id;
				        $modelZooms->save($zoomNew);

				        $zoom = $zoomNew;
					}
				}

				if(!empty($zoom)){
					$room = createNewRoom($zoom->client_id, $zoom->client_secret, $zoom->account_id);

					if(empty($room['id'])){
						// khóa tài khoản zoom
						$zoom->status = 'lock';
						$zoom->idOrder = 0;
				        $modelZooms->save($zoom);

				        // sửa ở đơn hàng
						$order->idZoom = 0;
						$modelOrders->save($order);

				        // tìm tài khoản zoom khác thay thế
						$zoomNew = $modelZooms->find()->where(['type'=>$order->type, 'status'=>'active', 'idOrder'=>0])->first();

						if(!empty($zoomNew)){
							// sửa ở đơn hàng
							$order->idZoom = $zoomNew->id;
							$modelOrders->save($order);

							// cập nhập tài khoản zoom mới
					        $zoomNew->idOrder = $order->id;
					        $modelZooms->save($zoomNew);

					        $room = createNewRoom($zoomNew->client_id, $zoomNew->client_secret, $zoomNew->account_id);

					        $zoom = $zoomNew;
						}else{
							return $controller->redirect('/listOrder/?status=zoomError');
						}
					}

					if(!empty($room['id'])){
						// sửa ở đơn hàng
						$order->idRoom = $room['id'];
						$modelOrders->save($order);

						// lưu phòng họp mới
						$dataRoom = $modelRooms->newEmptyEntity();

						$dataRoom->idManager = $session->read('infoUser')->id;
						$dataRoom->id_order = $order->id;
						$dataRoom->id_zoom = $zoom->id;
						$dataRoom->info = json_decode($room);

						$modelRooms->save($dataRoom);

						return $controller->redirect('/room/?id='.$dataRoom->id);
					}else{
						return $controller->redirect('/listOrder/?status=roomError');
					}
				}else{
					return $controller->redirect('/listOrder/?status=zoomError');
				}
			}else{
				return $controller->redirect('/listOrder/?status=orderError');
			}
		}else{
			return $controller->redirect('/listOrder/');
		}
	}else{
		return $controller->redirect('/login');
	}
}