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
                $order->meta_payment = $infoUser->phone.' ezpics '.$order->code;
                $order->total = (int) $dataSend['money'];
                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
                $order->created_at = date('Y-m-d H:i:s');
                
                $modelOrder->save($order);

                $link_qr_bank = 'https://img.vietqr.io/image/TPB-'.$number_bank.'-compact2.png?amount='.$dataSend['money'].'&addInfo='.$order->meta_payment.'&accountName='.$account_holders_bank;

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
	                $order->type = 2; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
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


			// $phone = trim(str_replace($keyApp,'',$description));
			$removeSpace = explode(' ', trim($description));
			$phone = $removeSpace[0];

			if(!empty($removeSpace[1]) && $removeSpace[1]==$keyApp){
				// Xóa gạch ngang
				$remove = explode('-', $removeSpace[0]);
				if(count($remove)>=2){
					$removeSpace[0] = $remove[1];
				}

				$phone = $removeSpace[0];

				$description = $phone.' '.$removeSpace[1].' '.$removeSpace[2];
			}elseif(!empty($removeSpace[2]) && $removeSpace[2]==$keyApp){
				// Xóa gạch ngang
				$remove = explode('-', $removeSpace[1]);
				if(count($remove)>=2){
					$removeSpace[1] = $remove[1];
				}

				$phone = $removeSpace[1];
				
				$description = $phone.' '.$removeSpace[2].' '.$removeSpace[3];
			}

			$mess = process_add_money($money, $description);
			
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