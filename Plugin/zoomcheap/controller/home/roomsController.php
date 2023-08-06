<?php
function createRoom($input)
{
	global $controller;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoUser'))){
		if(!empty($_GET['idOrder'])){
			$modelManagers = $controller->loadModel('Managers');
			$modelOrders = $controller->loadModel('Orders');
			$modelRooms = $controller->loadModel('Rooms');
			$modelZooms = $controller->loadModel('Zooms');

			$order = $modelOrders->find()->where(['id'=> (int) $_GET['idOrder'], 'idManager'=>$session->read('infoUser')->id, 'idRoom'=>0, 'dateEnd >='=>time()])->first();

			if(!empty($order)){
				$mess = '';

				if($isRequestPost){
					$dataSend = $input['request']->getData();

					if(!empty($dataSend['topic']) && !empty($dataSend['pass']) && !empty($dataSend['start_time'])){
						$start_time = explode(' ', $dataSend['start_time']);
						$time= explode(':', $start_time[0]);
						$date= explode('/', $start_time[1]);
						$start_time = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);

						$duration = floor(($order->dateEnd - $start_time)/60);

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
							$room = createNewRoom($zoom->client_id, $zoom->client_secret, $zoom->account_id, $dataSend['topic'], $start_time, $duration, $dataSend['pass']);

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

							        $room = createNewRoom($zoomNew->client_id, $zoomNew->client_secret, $zoomNew->account_id, $dataSend['topic'], $start_time, $duration, $dataSend['pass']);

							        $zoom = $zoomNew;
								}else{
									return $controller->redirect('/listOrder/?status=zoomError');
								}
							}

							if(!empty($room['id'])){
								if(!empty($dataSend['input_pass'])){
									$join_url = explode('?', $room['join_url']);
									$room['join_url'] = $join_url[0];
								}

								// lưu phòng họp mới
								$dataRoom = $modelRooms->newEmptyEntity();

								$dataRoom->idManager = $session->read('infoUser')->id;
								$dataRoom->id_order = $order->id;
								$dataRoom->id_zoom = $zoom->id;
								$dataRoom->info = json_encode($room);

								$modelRooms->save($dataRoom);

								// sửa ở đơn hàng
								$order->idRoom = $dataRoom->id;
								$modelOrders->save($order);

								return $controller->redirect('/room/?id='.$dataRoom->id);
							}else{
								$mess= '<p class="text-danger">Không tạo được phòng họp</p>';
							}
						}else{
							$mess= '<p class="text-danger">Không tìm thấy tài khoản Zoom phù hợp</p>';
						}
					}else{
						$mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
					}
				}

				setVariable('order', $order);
				setVariable('mess', $mess);
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

function room($input)
{
	global $controller;
	global $session;
	global $metaTitleMantan;

	if(!empty($session->read('infoUser'))){
		$modelManagers = $controller->loadModel('Managers');
		$modelOrders = $controller->loadModel('Orders');
		$modelRooms = $controller->loadModel('Rooms');
		$modelZooms = $controller->loadModel('Zooms');

		if(!empty($_GET['id'])){
			$room = $modelRooms->find()->where(['id'=>(int) $_GET['id'], 'idManager'=>$session->read('infoUser')->id])->first();

			if(!empty($room)){
				$order = $modelOrders->find()->where(['id'=>$room->id_order, 'dateEnd >'=>time()])->first();

				if(!empty($order)){
					$zoom = $modelZooms->find()->where(['id'=>$room->id_zoom])->first();
					
					$room = json_decode($room->info, true);

					$metaTitleMantan = $room['topic'];

					setVariable('room', $room);
					setVariable('order', $order);
					setVariable('zoom', $zoom);
				}else{
					return $controller->redirect('/listOrder/?status=orderDeadline');
				}
			}else{
				return $controller->redirect('/listOrder/?status=roomError');
			}
		}else{
			return $controller->redirect('/listOrder/');
		}
	}
}