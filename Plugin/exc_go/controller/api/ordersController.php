<?php 
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
                $order->user_id = $infoUser->id;
                $order->book_id = '';
                $order->meta_payment = 'Nạp tiền qua chuyển khoản ngân hàng';
                $order->payment_type = 1; // 1:Banking, 2:Apple
                $order->total = (int) $dataSend['money'];
                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 1; // 0: user thanh toán, 1: nạp tiền, 2: rút tiền, 3: tài xế nhận,	
                $order->created_at = date('Y-m-d H:i:s');
                
                $modelOrder->save($order);

                $sms = $order->id.' ezpics';

                $link_qr_bank = 'https://img.vietqr.io/image/TPB-'.$number_bank.'-compact2.png?amount='.$dataSend['money'].'&addInfo='.$sms.'&accountName='.$account_holders_bank;

                $return = array('code'=>0,
                				'number_bank'=>$number_bank,
                				'name_bank'=>$name_bank,
                				'account_holders_bank'=>$account_holders_bank,
                				'link_qr_bank'=>$link_qr_bank,
                				'content'=>$sms,
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
			if($dataSend['money']>=500000){
				$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

				if(!empty($infoUser)){
					if($infoUser->account_balance >= $dataSend['money']){
						$order = $modelOrder->newEmptyEntity();
						
						$order->code = 'WM'.time().$infoUser->id.rand(0,10000);
		                $order->member_id = $infoUser->id;
		                $order->book_id = '';
		                $order->meta_payment = 'Rút tiền '.$infoUser->phone;
		                $order->total = (int) $dataSend['money'];
		                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
		                $order->type = 2; // 0: user thanh toán, 1: nạp tiền, 2: rút tiền, 3: tài xế nhận,
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
				$return = array('code'=>5,
									'messages'=>array(array('text'=>'Số tiền rút phải tối thiểu là 500.000đ'))
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

function addMoneyApplePayAPI($input)
{
	global $controller;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');

	$return['messages']= array(array('text'=>''));

	if(!empty($_POST['token']) && !empty($_POST['money']) && !empty($_POST['purchaseID']) && !empty($_POST['transactionDate'])){
		$dataSend = $input['request']->getData();

		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($infoUser)){
			$transactionDate = $dataSend['transactionDate']/1000;

			// cộng tiền vào tài khoản
			$dataSend['money'] = (int) $dataSend['money'] * 0.7;
			$infoUser->account_balance += $dataSend['money'];
			$modelMember->save($infoUser);

			// lưu lịch sử nạp tiền
			$order = $modelOrder->newEmptyEntity();
				
			$order->code = 'AM'.time().$infoUser->id.rand(0,10000);
            $order->member_id = $infoUser->id;
            $order->book_id = ''; 
            $order->meta_payment = 'Nạp tiền qua Apple Pay. Mã giao dịch '.$dataSend['purchaseID']; // id giao dịch của Apple
            $order->payment_type = 2;
            $order->note = 'Thời gian giao dịch với Apple: '.date('H:i d/m/Y',$transactionDate).' ('.$transactionDate.')';
            $order->total = $dataSend['money'];
            $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
            $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
            $order->created_at = date('Y-m-d H:i:s');
            
            $modelOrder->save($order);

			// bắn thông báo về điện thoại
			$dataSendNotification= array('title'=>'Nạp tiền thành công EXC GO','time'=>date('H:i d/m/Y'),'content'=>'Nạp thành công '.number_format($dataSend['money']).'đ vào tài khoản '.$infoUser->phone,'action'=>'addMoneySuccess');

            if(!empty($infoUser->token_device)){
                sendNotification($dataSendNotification, $infoUser->token_device);
            }

			// gửi email xác nhận
			if(!empty($infoUser->email) && !empty($infoUser->name)){
                sendEmailAddMoney($infoUser->email, $infoUser->name, $dataSend['money']);
            }

            $return = array('code'=>0,
								'messages'=>array(array('text'=>'Cộng tiền thành công'))
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

	return 	$return;
}

function addMoneyTPBankAPI($input)
{
	global $modelOptions;
	global $key_transaction;

	$return['messages']= array(array('text'=>''));

	if(!empty($_POST['message'])){

	 	$keyApp= strtoupper($key_transaction);

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
			$order_id = $removeSpace[0];

			$mess = process_add_money($money, $order_id);
			
			$return['messages']= array(array('text'=>$mess));
		} else {
			$return['messages']= array(array('text'=>'Sai cú pháp hoặc số tiền không đủ'));
		}
   	 	
	}else{
		$return['messages']= array(array('text'=>'Gửi thiếu nội dung SMS'));
	}

	return $return;
}

function getNameBankAPI()
{
	return listBank();
}

?>