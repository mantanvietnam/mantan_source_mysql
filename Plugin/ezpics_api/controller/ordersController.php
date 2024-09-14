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
			$infoUser = getMemberByToken($dataSend['token']);

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
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['money'])){
			$infoUser = getMemberByToken($dataSend['token']);

			if(!empty($dataSend['discountCode'])){

				$discountCode = $modelDiscountCode->find()->where(array('code'=>$dataSend['discountCode'],'type'=>2))->first();

				$discount_id = '';

				if(!empty($discountCode) && @$discountCode->discount<100){
					if(!empty($discountCode->deadline_at)){
						if($discountCode->deadline_at->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s')){
							if(isset($discountCode->number_user)){
								if($discountCode->number_user>0){
									$discount_id = $discountCode->id;
								}else{
									return array('code'=>7, 'mess'=>'Mã này số lượng đã hết ');
								}	
							}else{
									$discount_id = $discountCode->id;
							}
						}else{
							return array('code'=>6, 'mess'=>'Mã này đã hết hạn ');
						}
					}else{
						$discount_id = $discountCode->id;
					}
				}else{
					return array('code'=>5, 'mess'=>'Bạn nhập mã không dùng');
				}
			}

			if(!empty($infoUser)){
				$order = $modelOrder->newEmptyEntity();
				
				$order->code = 'AM'.time().$infoUser->id.rand(0,10000);
                $order->member_id = $infoUser->id;
                $order->product_id = '';
                $order->meta_payment = 'Nạp tiền qua chuyển khoản ngân hàng ';
                $order->payment_type = 1; // 1:Banking, 2:Apple
                $order->total = (int) $dataSend['money'];
                $order->status = 1; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 8: bán kho mẫu thiết kế 
                $order->created_at = date('Y-m-d H:i:s');
                if(!empty($discount_id)){
                	$order->discount_id = @$discount_id; // id mã khuyến mại
                }
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
				$infoUser = getMemberByToken($dataSend['token']);

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
    global $recommenders;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');

	$return['messages']= array(array('text'=>''));

	if(!empty($_POST['token']) && !empty($_POST['money']) && !empty($_POST['purchaseID']) && !empty($_POST['transactionDate'])){
		$dataSend = $input['request']->getData();

		$infoUser = getMemberByToken($dataSend['token']);

		if(!empty($infoUser)){
			$transactionDate = $dataSend['transactionDate']/1000;

			// cộng tiền vào tài khoản
			//$dataSend['money'] = (int) $dataSend['money'] * 0.7;
			$dataSend['money'] = (int) $dataSend['money'];
			$infoUser->account_balance += $dataSend['money'];
			$modelMember->save($infoUser);

			// lưu lịch sử nạp tiền
			$order = $modelOrder->newEmptyEntity();
				
			$order->code = 'AM'.time().$infoUser->id.rand(0,10000);
            $order->member_id = $infoUser->id;
            $order->product_id = ''; 
            $order->meta_payment = 'Nạp tiền qua tài khoản Apple. Mã giao dịch '.$dataSend['purchaseID']; // id giao dịch của Apple
            $order->payment_type = 2;
            $order->note = 'Thời gian giao dịch với Apple: '.date('H:i d/m/Y',$transactionDate).' ('.$transactionDate.')';
            $order->total = $dataSend['money'];
            $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
            $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
            $order->created_at = date('Y-m-d H:i:s');
            
            $modelOrder->save($order);

            // Cộng tiền cho thằng giới thiệu 
            if(!empty($infoUser->affsource)){
                $User = $modelMember->find()->where(array('id'=>$infoUser->affsource))->first();
       	        if(!empty($User)){
                    $User->account_balance += ((int) $recommenders / 100) * $dataSend['money'];
                    $modelMember->save($User);

                    $data = $modelOrder->newEmptyEntity();
                    $data->code = 'W'.time().$User->id.rand(0,10000);
                    $data->member_id = $User->id;
                    $data->total = ((int) $recommenders / 100) * $dataSend['money'];
                    $data->status = 2; // 1: chưa xử lý, 2 đã xử lý
                    $data->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
                    $data->meta_payment = 'Bạn được công tiền hoa hồng giới thiệu';
                    $data->created_at = date('Y-m-d H:i:s');

                    $modelOrder->save($data);

                    // gửi thông báo về app
                    $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng giới thiệu','time'=>date('H:i d/m/Y'),'content'=>'- '.$user->name.' ơi. Bạn được cộng '.number_format($data->total).' VND do thành viên '.$infoUser->name.' đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

                    if(!empty($User->token_device)){
                        sendNotification($dataSendNotification, $User->token_device);
                    }
                }
            }

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
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');
	$modelProduct = $controller->loadModel('Products');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		
		if(!empty($dataSend['token']) && !empty($dataSend['idProduct'])){
			$infoUser = getMemberByToken($dataSend['token']);

			if(!empty($infoUser)){
				$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idProduct']))->first();
				if(!empty($dataProduct)){
					if($infoUser->member_pro==1 && $infoUser->deadline_pro->format('Y-m-d H:i:s') > date('Y-m-d H:i:s') ){
						$return = array('code'=>1, 'mess'=>'Bạn đã mua nội dung thành công');
					}else{
						if(@$dataSend['type']=='ecoin'){
							if($infoUser->ecoin >=1){
								// trừ tiền tài khoản mua
								$infoUser->ecoin -= 1;
								$modelMember->save($infoUser);

								// tạo đơn mua hàng của người mua (lịch sử giao dịch)
								$ecoin = $modelTransactionEcoins->newEmptyEntity();
								$ecoin->member_id = $infoUser->id;
								$ecoin->product_id = '';
								$ecoin->ecoin = 1;
								$ecoin->note = 'Trừ Ecoin mua nội dung mẫu thiết kế là:'.$dataProduct->id;
								$ecoin->status = 1;
								$ecoin->type =0;
								$ecoin->created_at =date('Y-m-d 00:00:00');
								$ecoin->updated_at =date('Y-m-d 00:00:00');

								$modelTransactionEcoins->save($ecoin);
								$return = array('code'=>1, 'mess'=>'Bạn đã mua nội dung thành công');

								// gửi thông báo công ecoin
						        $dataSendNotificationEcoin= array('title'=>'Trừ thêm Ecoin','time'=>date('H:i d/m/Y'),'content'=>'bạn được trừ Ecoin khi mua nội dung mẫu thiết kế bằng Ecoin bị trừ 1 ecoin','action'=>'addMoneySuccess');

						        if(!empty($infoUser->token_device)){
						            sendNotification($dataSendNotificationEcoin, $infoUser->token_device);
						        }

							}else{
								$return = array('code'=>0, 'mess'=>'Bạn không đủ Ecoin');
							}
						}else{
							if($infoUser->account_balance >= $price_create_content){

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
								$return = array('code'=>0, 'mess'=>'Bạn không đủ tiền');
							}
						}
					}
				}else{
					$return = array('code'=>3, 'mess'=>'Mẫu này không đúng');
				}
			}else{
				$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'Gửi thiếu dữ liệu');
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
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');
	$modelExtendProHistorie = $controller->loadModel('ExtendProHistories');
	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		if(empty($dataSend['token'])){
			return array('code'=>8, 'mess'=>'bạn nhập thiếu dữ liệu');
		}
		
		$user = getMemberByToken($dataSend['token']);

		$pricepro = $price_pro;
		$ecoin = $price_pro/1000;

		if(!empty($dataSend['discountCode'])){

			$discountCode = $modelDiscountCode->find()->where(array('code'=>$dataSend['discountCode']))->first();


			if(!empty($discountCode) && @$discountCode->discount<$price_pro){
				if(!empty($discountCode->deadline_at)){
					if($discountCode->deadline_at->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s')){
						if(isset($discountCode->number_user)){
							if($discountCode->number_user>0){

								if($discountCode->discount<= 100){
									$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
								}else{
									$price_pro = $price_pro - $discountCode->discount;
								}
							}else{
								return array('code'=>7, 'mess'=>'Mã này số lượng đã hết ');
							}	
						}else{
							if($discountCode->discount<= 100){
								$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
							}else{
								$price_pro = $price_pro - $discountCode->discount;
							}
						}
					}else{
						return array('code'=>6, 'mess'=>'Mã này đã hết hạn ');
					}
				}else{
					if($discountCode->discount<= 100){
						$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
					}else{
						$price_pro = $price_pro - $discountCode->discount;
					}
				}
			}else{
				return array('code'=>5, 'mess'=>'Bạn nhập mã không dùng');
			}
		}

		if(!empty($user)){
			if($user->member_pro!=1){
				if(@$dataSend['type']=='ecoin'){
					if($user->ecoin >=$ecoin){
						$user->ecoin -= $ecoin;
						$user->member_pro = 1;
						$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 365 days'));
						$modelMember->save($user);

						$ecoin = $modelTransactionEcoins->newEmptyEntity();
						$ecoin->member_id = $user->id;
						$ecoin->ecoin = $ecoin;
						$ecoin->note = 'trừ Ecoin Nâng cấm bản EZPICS PRO';
						$ecoin->status = 1;
						$ecoin->type =0;
						$ecoin->created_at =date('Y-m-d 00:00:00');
						$ecoin->updated_at =date('Y-m-d 00:00:00');

						$modelTransactionEcoins->save($ecoin);

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $ecoin;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						$data = $modelExtendProHistorie->newEmptyEntity();
			            // tạo dữ liệu sav
						$data->user_id = $user->id;
						$data->price = 0;
						$data->created_at = date('Y-m-d H:i:s');
						$data->deadline_pro = $user->deadline_pro;
						$data->type = 2;
						$data->ecoin = $ecoin;
						$modelExtendProHistorie->save($data);

						$return = array('code'=>1, 'mess'=>'bạn nâng lên câp Pro thành công');
					}else{
						$return = array('code'=>7, 'mess'=>'Tài khoản của bạn chưa đủ Ecoin để thực hiện chức năng này.');
					}
				}else{
					if($user->account_balance >=$price_pro){
						$user->account_balance -= $price_pro;
						$user->member_pro = 1;
						$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 365 days'));
						$modelMember->save($user);

						$order = $modelOrder->newEmptyEntity();
						$order->code = 'W'.time().$user->id.rand(0,10000);
						$order->member_id = $user->id;
						$order->total = $price_pro;
						if(!empty($discountCode)){
							$order->discount_id = $discountCode->id;
						}
						$order->status = 2; // 1: chưa xử lý, 2 đã xử lý 
						$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 8: bán kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho
						$order->meta_payment = 'Mua phiêu bản Pro';
						$order->created_at = date('Y-m-d H:i:s');
						$modelOrder->save($order);

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $price_pro;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						if(!empty($discountCode->number_user)){
							$discountCode->number_user -= 1;
							$modelDiscountCode->save($discountCode);
						}
						if(!empty($discountCode->user) && $pricepro > $price_pro){
							$checkPhone = $modelMember->find()->where(array('phone'=>$discountCode->user))->first();
							if(!empty($checkPhone)){
								$checkPhone->account_balance += (20 / 100) * $price_pro;
								$modelMember->save($checkPhone);

								$save = $modelOrder->newEmptyEntity();
		                        $save->code = 'P'.time().$checkPhone->id.rand(0,10000);
		                        $save->member_id = $checkPhone->id;
		                        $save->total = (20 / 100) * $price_pro;
		                        $save->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                        $save->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
		                        $save->meta_payment = 'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"';
		                        $save->created_at = date('Y-m-d H:i:s');

		                        $modelOrder->save($save);

								// gửi thông báo về app
		                        $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"','time'=>date('H:i d/m/Y'),'content'=> $checkPhone->name.' ơi. Bạn được cộng '.number_format((20/100)*$price_pro).' VND do thành viên '.$user->name.' đã nâng cấp tài khoản PRO. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

		                        if(!empty($checkPhone->token_device)){
		                            sendNotification($dataSendNotification, $checkPhone->token_device);
		                        }

							}
						}

						$data = $modelExtendProHistorie->newEmptyEntity();
			            // tạo dữ liệu sav
						$data->user_id = $user->id;
						$data->price = $price_pro;
						$data->created_at = date('Y-m-d H:i:s');
						$data->deadline_pro = $user->deadline_pro;
						$data->type = 1;
						$data->ecoin = 0;
						$modelExtendProHistorie->save($data);

						$return = array('code'=>1, 'mess'=>'bạn nâng lên câp Pro thành công');
					}else{
						$return = array('code'=>3, 'mess'=>'Tài khoản của bạn chưa đủ tiền để thực hiện chức năng này. Vui lòng nạp thêm tiền để hoàn thành thao tác.');
					}
				}
			}else{
				$return = array('code'=>4, 'mess'=>'Tài khoản đã lên cấp Pro rồi');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
		
	}

	return $return;
}

function memberExtendProAPI($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');
	$modelExtendProHistorie = $controller->loadModel('ExtendProHistories');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		if(empty($dataSend['token'])){
			return array('code'=>8, 'mess'=>'bạn nhập thiếu dữ liệu');
		}
		$user = getMemberByToken($dataSend['token']);
		$pricepro = $price_pro;
		$ecoin = $price_pro/1000;
		if(!empty($dataSend['discountCode'])){

			$discountCode = $modelDiscountCode->find()->where(array('code'=>$dataSend['discountCode']))->first();

			if(!empty($discountCode) && @$discountCode->discount<$price_pro){
				if(!empty($discountCode->deadline_at)){
					if($discountCode->deadline_at->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s')){
						if(isset($discountCode->number_user)){
							if($discountCode->number_user>0){
								if($discountCode->discount<= 100){
									$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
								}else{
									$price_pro = $price_pro - $discountCode->discount;
								}
								
							}else{
								return array('code'=>7, 'mess'=>'Mã này số lượng đã hết ');
							}	
						}else{
							if($discountCode->discount<= 100){
								$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
							}else{
								$price_pro = $price_pro - $discountCode->discount;
							}
						}
					}else{
						return array('code'=>6, 'mess'=>'Mã này đã hết hạn ');
					}
				}else{
					if($discountCode->discount<= 100){
						$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
					}else{
						$price_pro = $price_pro - $discountCode->discount;
					}
				}
			}else{
				return array('code'=>5, 'mess'=>'Bạn nhập mã không dùng');
			}
		}

		if(!empty($user)){
			if($user->member_pro==1){
				if(@$dataSend['type']=='ecoin'){
					if($user->ecoin >=$ecoin){
						$user->ecoin -= $ecoin;
						$user->member_pro = 1;
						if($user->deadline_pro->format('Y-m-d H:i:s') > date('Y-m-d H:i:s')){
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime($user->deadline_pro . ' + 365   days'));
						}else{
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 365 days'));
						}
						
						$modelMember->save($user);

						$ecoin = $modelTransactionEcoins->newEmptyEntity();
						$ecoin->member_id = $user->id;
						$ecoin->ecoin = $ecoin;
						$ecoin->note = 'trừ Ecoin Nâng cấm bản EZPICS PRO';
						$ecoin->status = 1;
						$ecoin->type =0;
						$ecoin->created_at =date('Y-m-d 00:00:00');
						$ecoin->updated_at =date('Y-m-d 00:00:00');

						$modelTransactionEcoins->save($ecoin);

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $price_pro;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						$data = $modelExtendProHistorie->newEmptyEntity();
			            // tạo dữ liệu sav
						$data->user_id = $user->id;
						$data->price = 0;
						$data->created_at = date('Y-m-d H:i:s');
						$data->deadline_pro = $user->deadline_pro;
						$data->type = 2;
						$data->ecoin = $ecoin;
						$modelExtendProHistorie->save($data);

						$return = array('code'=>1, 'mess'=>'bạn ra hạn Pro thành Công');
					}else{
						$return = array('code'=>7, 'mess'=>'Tài khoản của bạn chưa đủ Ecoin để thực hiện chức năng này.');
					}
				}else{
					if($user->account_balance >=$price_pro){
						$user->account_balance -= $price_pro;
						$user->member_pro = 1;
						if($user->deadline_pro->format('Y-m-d H:i:s') > date('Y-m-d H:i:s')){
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime($user->deadline_pro . ' + 365   days'));
						}else{
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 365 days'));
						}
						
						$modelMember->save($user);

						$order = $modelOrder->newEmptyEntity();
						$order->code = 'P'.time().$user->id.rand(0,10000);
						$order->member_id = $user->id;
						$order->total = $price_pro;
						if(!empty($discountCode)){
							$order->discount_id = $discountCode->id;
						}
						$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
						$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro
						$order->meta_payment = 'Mua phiêu bản Pro';
						$order->created_at = date('Y-m-d H:i:s');
						$modelOrder->save($order);

						if(!empty($discountCode->number_user)){
							$discountCode->number_user -= 1;
							$modelDiscountCode->save($discountCode);
						}

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $price_pro;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						// cộng hao hồng mã giảm giá 
						if(!empty($discountCode->user) && $pricepro > $price_pro){
							$checkPhone = $modelMember->find()->where(array('phone'=>$discountCode->user))->first();
							if(!empty($checkPhone)){
								$checkPhone->account_balance += (20 / 100) * $price_pro;
								$modelMember->save($checkPhone);

								$save = $modelOrder->newEmptyEntity();
		                        $save->code = 'W'.time().$checkPhone->id.rand(0,10000);
		                        $save->member_id = $checkPhone->id;
		                        $save->total = (20 / 100) * $price_pro;
		                        $save->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                        $save->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
		                        $save->meta_payment = 'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"';
		                        $save->created_at = date('Y-m-d H:i:s');

		                        $modelOrder->save($save);

								// gửi thông báo về app
		                        $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng từ mã giảm giá là "'.$dataSend['discountCode'].'"','time'=>date('H:i d/m/Y'),'content'=> $checkPhone->name.' ơi. Bạn được cộng '.number_format((20/100)*$price_pro).' VND do thành viên '.$user->name.' đã nâng cấp tài khoản PRO. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

		                        if(!empty($checkPhone->token_device)){
		                            sendNotification($dataSendNotification, $checkPhone->token_device);
		                        }

							}
						}

						$data = $modelExtendProHistorie->newEmptyEntity();
			            // tạo dữ liệu sav
						$data->user_id = $user->id;
						$data->price = $price_pro;
						$data->created_at = date('Y-m-d H:i:s');
						$data->deadline_pro = $user->deadline_pro;
						$data->type = 1;
						$data->ecoin = 0;
						$modelExtendProHistorie->save($data);


						$return = array('code'=>1, 'mess'=>'bạn ra hạn Pro thành Công');
					}else{
						$return = array('code'=>3, 'mess'=>'Tài khoản của bạn chưa đủ tiền để thực hiện chức năng này. Vui lòng nạp thêm tiền để hoàn thành thao tác.');
					}
				}
			}else{
				$return = array('code'=>4, 'mess'=>'Tài khoản chưa lên cấp Pro');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
		
	}

	return $return;
}

function getPriceAPI(){
	global $price_remove_background;
	global $price_create_content;
	global $price_pro;
	global $price_warehouses;
	global $recommenders;
	global $price_min_create_warehouses;

	$price = array();

	$price['price_remove_background'] = $price_remove_background;
	$price['price_create_content'] = $price_create_content;
	$price['price_pro'] = $price_pro;
	$price['price_pro_month'] = 200000;
	$price['price_warehouses'] = $price_warehouses;
	$price['price_min_create_warehouses'] = $price_min_create_warehouses;
	$price['ecoin_pro_year'] = 2000;
	$price['ecoin_pro_month'] = 200;
	return array('price'=>$price);

}

function memberTrialProAPI($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		if(empty($dataSend['token'])){
			return array('code'=>3, 'mess'=>'bạn nhập thiếu dữ liệu');
		}
		$user = getMemberByToken($dataSend['token']);
		

		if(!empty($user)){
			if ($user->is_use_trial!=1) {
				if( $user->member_pro!=1){
					$user->member_pro = 1;
					$user->is_use_trial = 1;
					$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 7 days'));
					$modelMember->save($user);

					$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
					if(empty($WarehouseUser)){
						$data = $modelWarehouseUsers->newEmptyEntity();
				            // tạo dữ liệu save
						$data->warehouse_id = (int) 1;
						$data->user_id = $user->id;
						$data->designer_id = 343;
						$data->price = $price_pro;
						$data->created_at = date('Y-m-d H:i:s');
						$data->note ='';
						$data->deadline_at = $user->deadline_pro;
						$modelWarehouseUsers->save($data);
					}else{
						$WarehouseUser->deadline_at = $user->deadline_pro;
						$modelWarehouseUsers->save($WarehouseUser);
					}
					if(!empty($discountCode->number_user)){
						$discountCode->number_user -= 1;
						$modelDiscountCode->save($discountCode);
					}

					$return = array('code'=>1, 'mess'=>'Bạn đăng ký dùng thử phiên bản Pro thành công');
					
				}else{
					$return = array('code'=>4, 'mess'=>'Tài khoản đã lên cấp Pro rồi');
				}
			}else{
					$return = array('code'=>5, 'mess'=>'Tài khoản bạn dùng thử cấp Pro rồi');
				}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
		
	}

	return $return;
}

function checkDeadline($input){
	global $controller;
	global $isRequestPost;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		if(empty($dataSend['token'])){
			return array('code'=>3, 'mess'=>'bạn nhập thiếu dữ liệu');
		}
		$user = getMemberByToken($dataSend['token']);

		if(!empty($user)){
			$data = $modelMember->find()->where(array('OR'=>[['token'=>$dataSend['token']],['token_web'=>$dataSend['token']]], 'deadline_pro <='=> date('Y-m-d H:i:s'),"member_pro" => 1))->first();
			
			if(!empty($data)){
				$data->member_pro = 0;
				$modelMember->save($data);
				$return = array('code'=>1, 'mess'=>'tài khoản của bạn đã hết hạn Pro');
			}else{
				$return = array('code'=>3, 'mess'=>'tài khoản của bạn chưa hết hạn Pro ');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'bạn chưa đăng nhập ');
		}


	}

	return $return;

}

function checkDeadlineProAllMember($input){
	global $controller;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);	
		$listData = $modelMember->find()->where(array('deadline_pro <=' => date('Y-m-d H:i:s'),"member_pro" => 1 ))->all()->toList();

		if(!empty($listData)){
			foreach($listData as $key => $user){
				$user->member_pro = 0;
				$modelMember->save($user);

				
				
				// gửi thông báo về app
	            $dataSendNotification= array('title'=>'Tài khoản của bạn dã hết hạn PRO','time'=>date('H:i d/m/Y'),'content'=> 'Tài khoản của bạn đã hết hạn PRO, vui lòng gia hạn để tiếp tục sử dụng các chức năng nâng cao của EZPICS','action'=>'addMoneySuccess');


	            if(!empty($user->token_device)){
	                sendNotification($dataSendNotification, $user->token_device);
	            }
			}
		}
		$return = array('code'=>1, 'mess'=>'Bạn đã hết hạn Pro');

	return $return;

}

function fixProWarehouse($input){
	global $controller;
	$modelMember = $controller->loadModel('Members');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	$listData = $modelMember->find()->where(array('deadline_pro >=' => date('Y-m-d H:i:s'),"member_pro" => 1 ))->all()->toList();	
	foreach($listData as $key => $user){

		$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
					if(empty($WarehouseUser)){
						$data = $modelWarehouseUsers->newEmptyEntity();
				            // tạo dữ liệu save
						$data->warehouse_id = (int) 1;
						$data->user_id = $user->id;
						$data->designer_id = 343;
						$data->price = 0;
						$data->created_at = date('Y-m-d H:i:s');
						$data->note ='';
						$data->deadline_at = $user->deadline_pro;
						$modelWarehouseUsers->save($data);
					}else{
						$WarehouseUser->deadline_at = $user->deadline_pro;
						$modelWarehouseUsers->save($WarehouseUser);
					}
	}
	debug('ok em ');
	die;

}

function showDiscountCodeAPI($input){
	global $controller;

	$modelDiscountCode = $controller->loadModel('DiscountCodes');

	$listData = $modelDiscountCode->find()->where(array('user IS NULL','deadline_at >='=>date('Y-m-d H:i:s'),'number_user >='=>1))->all()->toList();

	return array('data'=>$listData);
}

function memberBuyProMonthAPI($input){
	global $isRequestPost;
	global $controller;

	$price_pro = 200000;
	$ecoin = 200;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		if(empty($dataSend['token'])){
			return array('code'=>8, 'mess'=>'bạn nhập thiếu dữ liệu');
		}
		$user = getMemberByToken($dataSend['token']);

		$pricepro = $price_pro;

		if(!empty($dataSend['discountCode'])){

			$discountCode = $modelDiscountCode->find()->where(array('code'=>$dataSend['discountCode']))->first();


			if(!empty($discountCode) && @$discountCode->discount<$price_pro){
				if(!empty($discountCode->deadline_at)){
					if($discountCode->deadline_at->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s')){
						if(isset($discountCode->number_user)){
							if($discountCode->number_user>0){

								if($discountCode->discount<= 100){
									$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
								}else{
									$price_pro = $price_pro - $discountCode->discount;
								}
							}else{
								return array('code'=>7, 'mess'=>'Mã này số lượng đã hết ');
							}	
						}else{
							if($discountCode->discount<= 100){
								$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
							}else{
								$price_pro = $price_pro - $discountCode->discount;
							}
						}
					}else{
						return array('code'=>6, 'mess'=>'Mã này đã hết hạn ');
					}
				}else{
					if($discountCode->discount<= 100){
						$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
					}else{
						$price_pro = $price_pro - $discountCode->discount;
					}
				}
			}else{
				return array('code'=>5, 'mess'=>'Bạn nhập mã không dùng');
			}
		}

		if(!empty($user)){
			if($user->member_pro!=1){
				if($dataSend['type']=='ecoin'){
					if($user->ecoin >=$ecoin){
						$user->ecoin -= $ecoin;
						$user->member_pro = 1;
						$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 30 days'));
						$modelMember->save($user);

						$ecoin = $modelTransactionEcoins->newEmptyEntity();
						$ecoin->member_id = $user->id;
						$ecoin->ecoin = $ecoin;
						$ecoin->note = 'trừ Ecoin Nâng cấm bản EZPICS PRO';
						$ecoin->status = 1;
						$ecoin->type =0;
						$ecoin->created_at =date('Y-m-d 00:00:00');
						$ecoin->updated_at =date('Y-m-d 00:00:00');

						$modelTransactionEcoins->save($ecoin);

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $ecoin;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						$return = array('code'=>1, 'mess'=>'bạn nâng lên câp Pro thành công');
					}else{
						$return = array('code'=>7, 'mess'=>'Tài khoản của bạn chưa đủ Ecoin để thực hiện chức năng này.');
					}
				}else{
					if($user->account_balance >=$price_pro){
						$user->account_balance -= $price_pro;
						$user->member_pro = 1;
						$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 30 days'));
						$modelMember->save($user);

						$order = $modelOrder->newEmptyEntity();
						$order->code = 'W'.time().$user->id.rand(0,10000);
						$order->member_id = $user->id;
						$order->total = $price_pro;
						if(!empty($discountCode)){
							$order->discount_id = $discountCode->id;
						}
						$order->status = 2; // 1: chưa xử lý, 2 đã xử lý 
						$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 8: bán kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho
						$order->meta_payment = 'Mua phiêu bản Pro';
						$order->created_at = date('Y-m-d H:i:s');
						$modelOrder->save($order);

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $price_pro;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						if(!empty($discountCode->number_user)){
							$discountCode->number_user -= 1;
							$modelDiscountCode->save($discountCode);
						}
						if(!empty($discountCode->user) && $pricepro > $price_pro){
							$checkPhone = $modelMember->find()->where(array('phone'=>$discountCode->user))->first();
							if(!empty($checkPhone)){
								$checkPhone->account_balance += (20 / 100) * $price_pro;
								$modelMember->save($checkPhone);

								$save = $modelOrder->newEmptyEntity();
		                        $save->code = 'P'.time().$checkPhone->id.rand(0,10000);
		                        $save->member_id = $checkPhone->id;
		                        $save->total = (20 / 100) * $price_pro;
		                        $save->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                        $save->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
		                        $save->meta_payment = 'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"';
		                        $save->created_at = date('Y-m-d H:i:s');

		                        $modelOrder->save($save);

								// gửi thông báo về app
		                        $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"','time'=>date('H:i d/m/Y'),'content'=> $checkPhone->name.' ơi. Bạn được cộng '.number_format((20/100)*$price_pro).' VND do thành viên '.$user->name.' đã nâng cấp tài khoản PRO. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

		                        if(!empty($checkPhone->token_device)){
		                            sendNotification($dataSendNotification, $checkPhone->token_device);
		                        }

							}
						}

						$return = array('code'=>1, 'mess'=>'bạn nâng lên câp Pro thành công');
					}else{
						$return = array('code'=>3, 'mess'=>'Tài khoản của bạn chưa đủ tiền để thực hiện chức năng này. Vui lòng nạp thêm tiền để hoàn thành thao tác.');
					}
				}
			}else{
				$return = array('code'=>4, 'mess'=>'Tài khoản đã lên cấp Pro rồi');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
		
	}

	return $return;
}

function memberExtendProMonthAPI($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$price_pro = 200000;
	$ecoin = 200;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');

	$return = array('code'=>0);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();	
		if(empty($dataSend['token'])){
			return array('code'=>8, 'mess'=>'bạn nhập thiếu dữ liệu');
		}
		$user = getMemberByToken($dataSend['token']);
		$pricepro = $price_pro;
		if(!empty($dataSend['discountCode'])){

			$discountCode = $modelDiscountCode->find()->where(array('code'=>$dataSend['discountCode']))->first();

			if(!empty($discountCode) && @$discountCode->discount<$price_pro){
				if(!empty($discountCode->deadline_at)){
					if($discountCode->deadline_at->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s')){
						if(isset($discountCode->number_user)){
							if($discountCode->number_user>0){
								if($discountCode->discount<= 100){
									$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
								}else{
									$price_pro = $price_pro - $discountCode->discount;
								}
								
							}else{
								return array('code'=>7, 'mess'=>'Mã này số lượng đã hết ');
							}	
						}else{
							if($discountCode->discount<= 100){
								$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
							}else{
								$price_pro = $price_pro - $discountCode->discount;
							}
						}
					}else{
						return array('code'=>6, 'mess'=>'Mã này đã hết hạn ');
					}
				}else{
					if($discountCode->discount<= 100){
						$price_pro = ((100 - (int) @$discountCode->discount) / 100) * $price_pro;
					}else{
						$price_pro = $price_pro - $discountCode->discount;
					}
				}
			}else{
				return array('code'=>5, 'mess'=>'Bạn nhập mã không dùng');
			}
		}

		if(!empty($user)){
			if($user->member_pro==1){
				if(@$dataSend['type']=='ecoin'){
					if($user->ecoin >=$ecoin){
						$user->ecoin -= $ecoin;
						$user->member_pro = 1;
						if($user->deadline_pro->format('Y-m-d H:i:s') > date('Y-m-d H:i:s')){
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime($user->deadline_pro . ' + 30   days'));
						}else{
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 30 days'));
						}
						
						$modelMember->save($user);

						$ecoin = $modelTransactionEcoins->newEmptyEntity();
						$ecoin->member_id = $user->id;
						$ecoin->ecoin = $ecoin;
						$ecoin->note = 'trừ Ecoin Nâng cấm bản EZPICS PRO';
						$ecoin->status = 1;
						$ecoin->type =0;
						$ecoin->created_at =date('Y-m-d 00:00:00');
						$ecoin->updated_at =date('Y-m-d 00:00:00');

						$modelTransactionEcoins->save($ecoin);

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $price_pro;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						// cộng hao hồng mã giảm giá 
						if(!empty($discountCode->user) && $pricepro > $price_pro){
							$checkPhone = $modelMember->find()->where(array('phone'=>$discountCode->user))->first();
							if(!empty($checkPhone)){
								$checkPhone->account_balance += (20 / 100) * $price_pro;
								$modelMember->save($checkPhone);

								$save = $modelOrder->newEmptyEntity();
		                        $save->code = 'W'.time().$checkPhone->id.rand(0,10000);
		                        $save->member_id = $checkPhone->id;
		                        $save->total = (20 / 100) * $price_pro;
		                        $save->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                        $save->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
		                        $save->meta_payment = 'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"';
		                        $save->created_at = date('Y-m-d H:i:s');

		                        $modelOrder->save($save);

								// gửi thông báo về app
		                        $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng từ mã giảm giá là "'.$dataSend['discountCode'].'"','time'=>date('H:i d/m/Y'),'content'=> $checkPhone->name.' ơi. Bạn được cộng '.number_format((20/100)*$price_pro).' VND do thành viên '.$user->name.' đã nâng cấp tài khoản PRO. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

		                        if(!empty($checkPhone->token_device)){
		                            sendNotification($dataSendNotification, $checkPhone->token_device);
		                        }

							}
						}


						$return = array('code'=>1, 'mess'=>'bạn ra hạn Pro thành Công');
					}else{
						$return = array('code'=>7, 'mess'=>'Tài khoản của bạn chưa đủ Ecoin để thực hiện chức năng này.');
					}
				}else{
					if($user->account_balance >=$price_pro){
						$user->account_balance -= $price_pro;
						$user->member_pro = 1;
						if($user->deadline_pro->format('Y-m-d H:i:s') > date('Y-m-d H:i:s')){
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime($user->deadline_pro . ' + 30   days'));
						}else{
							$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 30 days'));
						}
						
						$modelMember->save($user);

						$order = $modelOrder->newEmptyEntity();
						$order->code = 'P'.time().$user->id.rand(0,10000);
						$order->member_id = $user->id;
						$order->total = $price_pro;
						if(!empty($discountCode)){
							$order->discount_id = $discountCode->id;
						}
						$order->status = 2; // 1: chưa xử lý, 2 đã xử lý
						$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro
						$order->meta_payment = 'Mua phiêu bản Pro';
						$order->created_at = date('Y-m-d H:i:s');
						$modelOrder->save($order);

						if(!empty($discountCode->number_user)){
							$discountCode->number_user -= 1;
							$modelDiscountCode->save($discountCode);
						}

						$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
						if(empty($WarehouseUser)){
							$data = $modelWarehouseUsers->newEmptyEntity();

				            // tạo dữ liệu save
							$data->warehouse_id = (int) 1;
							$data->user_id = $user->id;
							$data->designer_id = 343;
							$data->price = $price_pro;
							$data->created_at = date('Y-m-d H:i:s');
							$data->note ='';
							$data->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($data);
						}else{
							$WarehouseUser->deadline_at = $user->deadline_pro;
							$modelWarehouseUsers->save($WarehouseUser);
						}

						// cộng hao hồng mã giảm giá 
						if(!empty($discountCode->user) && $pricepro > $price_pro){
							$checkPhone = $modelMember->find()->where(array('phone'=>$discountCode->user))->first();
							if(!empty($checkPhone)){
								$checkPhone->account_balance += (20 / 100) * $price_pro;
								$modelMember->save($checkPhone);

								$save = $modelOrder->newEmptyEntity();
		                        $save->code = 'W'.time().$checkPhone->id.rand(0,10000);
		                        $save->member_id = $checkPhone->id;
		                        $save->total = (20 / 100) * $price_pro;
		                        $save->status = 2; // 1: chưa xử lý, 2 đã xử lý
		                        $save->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
		                        $save->meta_payment = 'Bạn được cộng tiền hoa hồng mã giảm giá là "'.$dataSend['discountCode'].'"';
		                        $save->created_at = date('Y-m-d H:i:s');

		                        $modelOrder->save($save);

								// gửi thông báo về app
		                        $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng từ mã giảm giá là "'.$dataSend['discountCode'].'"','time'=>date('H:i d/m/Y'),'content'=> $checkPhone->name.' ơi. Bạn được cộng '.number_format((20/100)*$price_pro).' VND do thành viên '.$user->name.' đã nâng cấp tài khoản PRO. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

		                        if(!empty($checkPhone->token_device)){
		                            sendNotification($dataSendNotification, $checkPhone->token_device);
		                        }

							}
						}


						$return = array('code'=>1, 'mess'=>'bạn ra hạn Pro thành Công');
					}else{
						$return = array('code'=>3, 'mess'=>'Tài khoản của bạn chưa đủ tiền để thực hiện chức năng này. Vui lòng nạp thêm tiền để hoàn thành thao tác.');
					}
				}
			}else{
				$return = array('code'=>4, 'mess'=>'Tài khoản chưa lên cấp Pro');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
		
	}

	return $return;
}


function getHistoryTransactionEcoinAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelTransactionEcoins = $controller->loadModel('TransactionEcoins');
	$modelProduct = $controller->loadModel('Products');
	$modelManagerFile = $controller->loadModel('ManagerFile');

	$return = array('listData'=>[]);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token']);

			if(!empty($infoUser)){
				$conditions = array('member_id'=>$infoUser->id);
				$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:24;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(isset($dataSend['type'])){
					$conditions['type']=$dataSend['type'];
				}

				$listData = $modelTransactionEcoins->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

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

function test(){

	$mess = process_add_money(1000, 498);
	debug($mess);
	die();
}
?>