<?php 
function getMyFileAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelMember = $controller->loadModel('Members');
	$return = array('listData'=>[]);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token']);

			if(!empty($infoUser)){
				$conditions = array('user_id'=>$infoUser->id);
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(isset($dataSend['type'])){
					$conditions['type'] = (int) $dataSend['type'];
				}

				$listData = $modelManagerFile->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				$return = array('listData'=>$listData);
			}
		}
	}

	return 	$return;
}

function removeBackgroundImageAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $price_remove_background;

	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');

	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token']);

			if(!empty($infoUser)){
				if($infoUser->account_balance >= $price_remove_background){
					$return = uploadImage($infoUser->id, 'image');

					removeBackground($return['linkLocal']);
					// removeFile($return['linkLocal']);

					// lưu vào database
					$data = $modelManagerFile->newEmptyEntity();

					$data->link = $return['linkOnline'];
					$data->user_id = $infoUser->id;
					$data->type = 2; // 0 là user up, 1 là cap, 2 là payment
					$data->created_at = date('Y-m-d H:i:s');

					$modelManagerFile->save($data);

					if($price_remove_background>0){
						// trừ tiền tài khoản
						$infoUser->account_balance -= $price_remove_background;
						$modelMember->save($infoUser);

						// lưu lịch sử giao dịch
						$order = $modelOrder->newEmptyEntity();
						
						$order->code = 'RB'.time().$infoUser->id.rand(0,10000);
	                    $order->member_id = $infoUser->id;
	                    $order->file_id = $data->id;
	                    $order->total = $price_remove_background;
	                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
	                    $order->type = 4; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
	                    $order->meta_payment = 'Xóa ảnh nền';
	                    $order->created_at = date('Y-m-d H:i:s');
	                    
	                    $modelOrder->save($order);
	                }
				}else{
					$return = array('code'=>6, 'mess'=>'Tài khoản không đủ tiền');
				}
			}else{
				$return = array('code'=>5, 'mess'=>'Tài khoản không tồn tại hoặc sai mã token');
			}
		}else{
			$return = array('code'=>4, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return 	$return;
}

function removeBackgroundFromDesignAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $price_remove_background;
	global $urlHomes;

	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');

	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['user_id']) && !empty($dataSend['linkLocal'])){
			$infoUser = $modelMember->find()->where(array('id'=>$dataSend['user_id']))->first();

			if(!empty($infoUser)){
				if($infoUser->account_balance >= $price_remove_background){
					if(empty($dataSend['create_new'])) $dataSend['create_new'] = false;

					$linkImageRemove = removeBackground($dataSend['linkLocal'], $dataSend['create_new']);

					if($price_remove_background>0){
						// trừ tiền tài khoản
						$infoUser->account_balance -= $price_remove_background;
						$modelMember->save($infoUser);

						// lưu lịch sử giao dịch
						$order = $modelOrder->newEmptyEntity();
						
						$order->code = 'RB'.time().$infoUser->id.rand(0,10000);
	                    $order->member_id = $infoUser->id;
	                    $order->file_id = 0;
	                    $order->total = $price_remove_background;
	                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
	                    $order->type = 4; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
	                    $order->meta_payment = 'Xóa ảnh nền từ mẫu in hàng loạt';
	                    $order->created_at = date('Y-m-d H:i:s');
	                    
	                    $modelOrder->save($order);
	                }

	                $return = array('code'=>0, 'mess'=>'Xóa nền thành công', 'linkLocal'=>$linkImageRemove, 'linkOnline'=>$urlHomes.'/'.$linkImageRemove);
				}else{
					$return = array('code'=>6, 'mess'=>'Tài khoản không đủ tiền');
				}
			}else{
				$return = array('code'=>5, 'mess'=>'Tài khoản không tồn tại hoặc sai mã ID');
			}
		}else{
			$return = array('code'=>4, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return 	$return;
}
?>