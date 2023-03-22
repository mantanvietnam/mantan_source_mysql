<?php 
function getHistoryTransactionAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$return = array('listData'=>[]);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$conditions = array('member_id'=>$infoUser->id);
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				$listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				$return = array('listData'=>$listData);
			}
		}
	}

	return 	$return;
}

function saveRequestBankingAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $name_bank;
	global $number_bank;
	global $link_qr_bank;
	global $account_holders_bank;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['money'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				$order = $modelOrder->newEmptyEntity();
				
				$order->code = 'AM'.time().$infoUser->id.rand(0,10000);
                $order->member_id = $infoUser->id;
                $order->product_id = '';
                $order->meta_payment = $infoUser->phone.' ezpics '.$order->code;
                $order->total = (int) $dataSend['money'];
                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 1; // 0: mua hàng, 1: nạp tiền
                $order->created_at = date('Y-m-d H:i:s');
                
                $modelOrder->save($order);

                $return = array('code'=>0,
                				'number_bank'=>$number_bank,
                				'name_bank'=>$name_bank,
                				'account_holders_bank'=>$account_holders_bank,
                				'link_qr_bank'=>$link_qr_bank,
                				'content'=>$order->meta_payment,
								'messages'=>array(array('text'=>'Tạo yêu cầu nạp tiền thành công'))
							);
			}else{
				$return = array('code'=>3,
								'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai mã token'))
							);
			}
		}else{
			$return = array('code'=>2,
								'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
							);
		}
	}

	return 	$return;
}

function saveRequestWithdrawAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['money'])){
			$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($infoUser)){
				if($infoUser->account_balance >= $dataSend['money']){
					$order = $modelOrder->newEmptyEntity();
					
					$order->code = 'WM'.time().$infoUser->id.rand(0,10000);
	                $order->member_id = $infoUser->id;
	                $order->product_id = '';
	                $order->meta_payment = 'Rút tiền '.$infoUser->phone;
	                $order->total = (int) $dataSend['money'];
	                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
	                $order->type = 0; // 0: mua hàng, 1: nạp tiền
	                $order->created_at = date('Y-m-d H:i:s');
	                $order->note = '<p>Thông tin tài khoản nhận tiền</p>
	                				<p>Ngân hàng: '.@$dataSend['name_bank'].'</p>
	                				<p>Số tài khoản: '.@$dataSend['number_bank'].'</p>
	                				<p>Chủ tài khoản: '.@$dataSend['account_holders_bank'].'</p>
	                				';
	                
	                $modelOrder->save($order);

	                $return = array('code'=>0,
									'messages'=>array(array('text'=>'Tạo yêu cầu rút tiền thành công'))
								);
	            }else{
	            	$return = array('code'=>4,
								'messages'=>array(array('text'=>'Số tiền muốn rút vượt quá số dư tài khoản'))
							);
	            }
			}else{
				$return = array('code'=>3,
								'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai mã token'))
							);
			}
		}else{
			$return = array('code'=>2,
								'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
							);
		}
	}

	return 	$return;
}
?>