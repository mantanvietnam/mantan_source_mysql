<?php 
function getHistoryTransactionAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelManagerFile = $controller->loadModel('ManagerFile');

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

				if(!empty($listData)){
					foreach ($listData as $key => $value) {
						$listData[$key]->image = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
						if($value->type == 0){
							if(!empty($value->product_id)){
								$product = $modelProduct->find()->where(['id'=>$value->product_id])->first();
								if(!empty($product)){
									$listData[$key]->image = $product->image;
								}
							}elseif(!empty($value->file_id)){
								$file = $modelManagerFile->find()->where(['id'=>$value->file_id])->first();
								if(!empty($file)){
									$listData[$key]->image = $file->link;
								}
							}
						}
					}
				}

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
                $order->meta_payment = 'Nạp tiền qua chuyển khoản ngân hàng';
                $order->payment_type = 1; // 1:Banking, 2:Apple
                $order->total = (int) $dataSend['money'];
                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 8: bán kho mẫu thiết kế 
                $order->created_at = date('Y-m-d H:i:s');
                $order->payment_kind = 1; //0: tiền thưởng, 1 tiền thật 
                
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
		                $order->product_id = '';
		                $order->meta_payment = 'Rút tiền '.$infoUser->phone;
		                $order->total = (int) $dataSend['money'];
		                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
		                $order->type = 2; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
		                $order->created_at = date('Y-m-d H:i:s');
		                $order->note = '<p>Thông tin tài khoản nhận tiền</p>
		                				<p>Ngân hàng: '.@$dataSend['name_bank'].'</p>
		                				<p>Số tài khoản: '.@$dataSend['number_bank'].'</p>
		                				<p>Chủ tài khoản: '.@$dataSend['account_holders_bank'].'</p>
		                				';
		                
		                $modelOrder->save($order);
		                sendNotificationAdmin('64b65562b2efeb42a68a4f8a');

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
            $order->product_id = ''; 
            $order->meta_payment = 'Nạp tiền qua Apple Pay. Mã giao dịch '.$dataSend['purchaseID']; // id giao dịch của Apple
            $order->payment_type = 2;
            $order->note = 'Thời gian giao dịch với Apple: '.date('H:i d/m/Y',$transactionDate).' ('.$transactionDate.')';
            $order->total = $dataSend['money'];
            $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
            $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
            $order->created_at = date('Y-m-d H:i:s');
            
            $modelOrder->save($order);

			// bắn thông báo về điện thoại
			$dataSendNotification= array('title'=>'Nạp tiền thành công Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Nạp thành công '.number_format($dataSend['money']).'đ vào tài khoản '.$infoUser->phone,'action'=>'addMoneySuccess');

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

function orderCreateContentAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;
	global $name_bank;
	global $number_bank;
	global $link_qr_bank;
	global $account_holders_bank;
	global $price_create_content;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
		if(!empty($infoUser)){
			if($infoUser->account_balance >= $price_create_content){
				$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idProduct']))->first();
				if(!empty($dataProduct)){


					$order = $modelOrder->newEmptyEntity();
					$order->code = 'CC'.time().$infoUser->id.rand(0,10000);
                    $order->member_id = $infoUser->id;
                    $order->product_id = $dataProduct->id;
                    $order->total = $price_create_content;
                    $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
                    $order->type = 6; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền,5 chiết khấu,6 tạo nội dung
                    $order->meta_payment = 'Bạn mua nội dung mẫu ID '.$dataProduct->id;
                    $order->created_at = date('Y-m-d H:i:s');
                    $modelOrder->save($order);

                    $infoUser->account_balance -= $price_create_content;
					$modelMember->save($infoUser);
					$return = array('code'=>1, 'mess'=>'Bạn đã mua nội dung thành công');
				}else{
					$return = array('code'=>0, 'mess'=>'Mẫu này không đúng');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'Bạn không đủ tiền');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
		}
	}


	return $return;
}

function memberBuyProAPI($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		$user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($dataSend['discountCode'])){

		$discountCode = $modelDiscountCode->find()->where(array('code'=>$dataSend['discountCode']))->first();

			if(!empty($discountCode)){
				$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
			}else{
				return array('code'=>4, 'mess'=>'Bạn nhập mã không dùng');
			}

		}

		if(!empty($user)){
			if($user->account_balance >=$price_pro){
				$user->account_balance -= $price_pro;
				$user->member_pro = 1;
				$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 365 days'));
				$modelMember->save($user);

				$order = $modelOrder->newEmptyEntity();
				$order->code = 'W'.time().$user->id.rand(0,10000);
				$order->member_id = $user->id;
				$order->total = $price_pro;
				$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
				$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro
				$order->meta_payment = 'Mua phiêu bản Pro';
				$order->created_at = date('Y-m-d H:i:s');
				$modelOrder->save($order);
				$return = array('code'=>1, 'mess'=>'bạn nâng lên câp Pro thành công');
			}else{
				$return = array('code'=>3, 'mess'=>'Tài khoản không đủ tiền');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
		
	}

	return $return;
}

?>