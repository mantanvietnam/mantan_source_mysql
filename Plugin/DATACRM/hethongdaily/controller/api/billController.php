<?php 
function listBillAPI($input){

	global $controller;
	global $urlCurrent;
	global $isRequestPost;
	global $modelCategories;
	global $metaTitleMantan;
	global $session;

	$modelMembers = $controller->loadModel('Members');
	$modelCustomers = $controller->loadModel('Customers');
	$modelBill = $controller->loadModel('Bills');
	$modelAffiliaters = $controller->loadModel('Affiliaters');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){

				$conditions = array('id_member_buy'=>$infoMember->id, 'type'=>2);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['phone_agency'])){
					$checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency'] ])->first();

					if(!empty($checkMember)){
						$conditions['id_member_sell'] = $checkMember->id;
					}else{
						$conditions['id_member_sell'] = -1;
					}
				}

				if(!empty($dataSend['phone_customer'])){
					$checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer'] ])->first();

					if(!empty($checkCustomer)){
						$conditions['id_customer'] = $checkCustomer->id;
					}else{
						$conditions['id_customer'] = -1;
					}
				}

				if(!empty($dataSend['phone_affiliate'])){
					$checkAffiliate = $modelAffiliater->find()->where(['phone'=>$dataSend['phone_affiliate'] ])->first();

					if(!empty($checkCustomer)){
						$conditions['id_aff'] = $checkAffiliate->id;
					}else{
						$conditions['id_aff'] = -1;
					}
				}

				if(!empty($dataSend['type_order'])){
					$conditions['type_order'] = $dataSend['type_order'];
				}

				if(!empty($dataSend['type_collection_bill'])){
					$conditions['type_collection_bill'] = $dataSend['type_collection_bill'];
				}
				if(!empty($dataSend['id_debt'])){
					$conditions['id_debt'] = $dataSend['id_debt'];
				}
				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);

				}

				$listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				if(!empty($listData)){
					foreach($listData as $key => $item){
						if(!empty($item->id_member_sell) && $item->type_order==1){
							$listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_sell])->first();
						}

						if(!empty($item->id_customer) && $item->type_order==2){
							$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
						}

						if(!empty($item->id_aff) && $item->type_order==4){
							$listData[$key]->affiliate = $modelAffiliaters->find()->where(['id'=>$item->id_aff])->first();
						}
					}
				}
		        // phân trang
				$totalData = $modelBill->find()->where($conditions)->all()->toList();

				$totalMoney = 0;
				if(!empty($totalData)){
					foreach ($totalData as $key => $value) {
						$totalMoney += $value->total;
					}
				}

				$totalData = count($totalData);

				$return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>1, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;
}

function addBillAPI($input){
	global $isRequestPost;
	global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $controller;
	global $urlCurrent;
	global $urlHomes;

	$metaTitleMantan = 'Thông tin phiếu chi';

	if(!empty($session->read('infoUser'))){
		$modelMembers = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');

		$infoUser = $session->read('infoUser');
		$mess= '';

        // lấy data edit
		$time =time();
		if(!empty($dataSend['id'])){
			$bill = $modelBill->get( (int) $dataSend['id']);
		}else{
			$bill = $modelBill->newEmptyEntity();
			$bill->created_at = $time;
		}
		$bill->id_member_sell =  0;
		$bill->id_member_buy = $session->read('infoUser')->id;
		$bill->total = @$dataSend['total'];
		$bill->id_order = 0;
		$bill->type = 2;
		$bill->type_order = 3; 
		$bill->updated_at = $time;
		$bill->id_debt = 0;
		$bill->type_collection_bill =  @$dataSend['type_collection_bill'];
		$bill->id_customer = 0;
		$bill->note =@$dataSend['note'];

		$modelBill->save($bill);
		return $controller->redirect('/listBill');
	}else{
		return $controller->redirect('/login');
	}
}

function listCollectionBillAPI($input){

	global $controller;
	global $urlCurrent; 
	global $modelCategories;
	global $isRequestPost;
	global $metaTitleMantan;
	global $session;

	$metaTitleMantan = 'Danh sách phiếu thu';
	$modelMembers = $controller->loadModel('Members');
	$modelCustomers = $controller->loadModel('Customers');
	$modelBill = $controller->loadModel('Bills');
	$modelAffiliater = $controller->loadModel('Affiliaters');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){

				$conditions = array('id_member_sell'=>$infoMember->id, 'type'=>1);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['phone_agency'])){
					$checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency'] ])->first();

					if(!empty($checkMember)){
						$conditions['id_member_buy'] = $checkMember->id;
					}else{
						$conditions['id_member_buy'] = -1;
					}
				}

				if(!empty($dataSend['phone_customer'])){
					$checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer'] ])->first();

					if(!empty($checkCustomer)){
						$conditions['id_customer'] = $checkCustomer->id;
					}else{
						$conditions['id_customer'] = -1;
					}
				}

				if(!empty($dataSend['type_order'])){
					$conditions['type_order'] = $dataSend['type_order'];
				}

				if(!empty($dataSend['type_collection_bill'])){
					$conditions['type_collection_bill'] = $dataSend['type_collection_bill'];
				}

				if(!empty($dataSend['id_debt'])){
					$conditions['id_debt'] = $dataSend['id_debt'];
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);

				}

				$listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


				if(!empty($listData)){
					foreach($listData as $key => $item){
						if(!empty($item->id_member_buy) && $item->type_order==1){
							$listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_buy])->first();
						}

						if(!empty($item->id_customer) && $item->type_order==2){
							$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
						}
					}
				}
		        // phân trang
				$totalData = $modelBill->find()->where($conditions)->all()->toList();

				$totalMoney = 0;
				if(!empty($totalData)){
					foreach ($totalData as $key => $value) {
						$totalMoney += $value->total;
					}
				}

				$totalData = count($totalData);


				$return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}

	return $return;
}

function listCollectionBillTodayAPI($input){

	global $controller;
	global $urlCurrent;
	global $modelCategories;
	global $isRequestPost;
	global $metaTitleMantan;
	global $session;

	$metaTitleMantan = 'Danh sách phiếu thu';
	$modelMembers = $controller->loadModel('Members');
	$modelCustomers = $controller->loadModel('Customers');
	$modelBill = $controller->loadModel('Bills');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){
            	// Thời gian đầu ngày
				$startOfDay = strtotime("today 00:00:00");
                // Thời gian cuối ngày
				$endOfDay = strtotime("tomorrow 00:00:00") - 1;

				$conditions = array('id_member_sell'=>$infoMember->id, 'type'=>1,  'create_at >='=>$startOfDay,'create_at <='=>$endOfDay);
				$order = array('id'=>'desc');


				$listData = $modelBill->find()->where($conditions)->order($order)->all()->toList();


				if(!empty($listData)){
					foreach($listData as $key => $item){
						if(!empty($item->id_member_buy) && $item->type_order==1){
							$listData[$key]->member = $modelMembers->find()->where(['id'=>$item->id_member_buy])->first();
						}

						if(!empty($item->id_customer) && $item->type_order==2){
							$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
						}
					}
				}
		        // phân trang
				$totalData = $modelBill->find()->where($conditions)->all()->toList();

				$totalMoney = 0;
				if(!empty($totalData)){
					foreach ($totalData as $key => $value) {
						$totalMoney += $value->total;
					}
				}

				$totalData = count($totalData);


				$return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>1, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;
}

function addCollectionBillAPI($input){
	global $isRequestPost;
	global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $isRequestPost;
	global $controller;
	global $urlCurrent;
	global $urlHomes;

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){

				$modelMembers = $controller->loadModel('Members');
				$modelCustomer = $controller->loadModel('Customers');
				$modelBill = $controller->loadModel('Bills');

				$infoUser = $session->read('infoUser');
				$mess= '';

		        // lấy data edit
				$time =time();

				if($dataSend['typeUser']=='customer'){
					if(!empty($dataSend['phone_customer'])){
						$customer = $modelCustomer->find()->where(['phone'=>$dataSend['phone_customer']])->first();
						if(empty($customer)){
							return array('code'=>4, 'mess'=>'số điện thoại khách hàng không tồn tại');
						}

						$bill = $modelBill->newEmptyEntity();
						$bill->id_member_sell =  $infoMember->id;
						$bill->id_member_buy = 0;
						$bill->total = (int) @$dataSend['total'];
						$bill->id_order = 0;
						$bill->type = 1;
						$bill->type_order = 2; 
						$bill->updated_at = $time;
						$bill->id_debt = 0;
						$bill->type_collection_bill = @$dataSend['type_collection_bill'];
						$bill->id_customer =(int) @$customer->id;
						$bill->note = 'Đã thu tiền của khách hàng' .@$customer->full_name.' '.@$customer->phone.' với số tiền là '.number_format($bill->total).'đ lý do là: '.@$dataSend['note'];
						$modelBill->save($bill);
					}else{
						return array('code'=>4, 'mess'=>'số điện thoại khách hàng không tồn tại');
					}
				}elseif($dataSend['typeUser']=='agency'){
					if(!empty($dataSend['phone_agency'])){
						$member_buy = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency']])->first();;
						if(empty($member_buy)){
							return array('code'=>5, 'mess'=>'số điện thoại đại lý không tồn tại');
						}
		                // bill cho người thu
						$bill = $modelBill->newEmptyEntity();
						$bill->id_member_sell =  $infoMember->id;
						$bill->id_member_buy = $member_buy->id;
						$bill->total = (int) @$dataSend['total'];
						$bill->id_order = 0;
						$bill->type = 1;
						$bill->type_order = 1; 
						$bill->created_at = $time;
						$bill->updated_at = $time;
						$bill->id_debt = 0;
						$bill->type_collection_bill =  @$dataSend['type_collection_bill'];
						$bill->id_customer = 0;
						$bill->note = 'Đã thu tiền của đại lý' .@$member_buy->name.' '.@$member_buy->phone.' với số tiền là '.number_format($bill->total).'đ lý do thu là:'.@$dataSend['note'];
						$modelBill->save($bill);

		                // bill cho người chi
						$billbuy = $modelBill->newEmptyEntity();
						$billbuy->id_member_sell =  $infoMember->id;
						$billbuy->id_member_buy = $member_buy->id;
						$billbuy->total = (int) @$dataSend['total'];
						$billbuy->id_order = 0;
						$billbuy->type = 2;
						$billbuy->type_order = 1; 
						$billbuy->created_at = $time;
						$billbuy->updated_at = $time;
						$billbuy->id_debt = 0;
						$billbuy->type_collection_bill =  @$dataSend['type_collection_bill'];
						$billbuy->id_customer = 0;
						$billbuy->note = 'Đã trả tiền cho đại lý' .@$infoMember->name.' '.@$infoMember->phone.' với số tiền là '.number_format($billbuy->total).'đ lý do trả là:'.@$dataSend['note'];
						$modelBill->save($billbuy);
					}else{
						return array('code'=>5, 'mess'=>'số điện thoại đại lý không tồn tại');
					}
				}else{

					$bill = $modelBill->newEmptyEntity();
					$bill->id_member_sell =  $session->read('infoUser')->id;
					$bill->id_member_buy = 0;
					$bill->total = (int) @$dataSend['total'];
					$bill->id_order = 0;
					$bill->type = 1;
					$bill->type_order = 3; 
					$bill->updated_at = $time;
					$bill->id_debt = 0;
					$bill->type_collection_bill =  @$dataSend['type_collection_bill'];
					$bill->id_customer = 0;
					$bill->note = @$dataSend['note'];

					$modelBill->save($bill);

				}
				$return = array('code'=>0, 'mess'=>'Bạn thêm phiếu thu thành công');
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>1, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;
}

function listCollectionDebtAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;
	global $type_collection_bill;

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){

				$modelMember = $controller->loadModel('Members');
				$modelCustomers = $controller->loadModel('Customers');
				$modelDebt = $controller->loadModel('Debts');

				$conditions = array('id_member_sell'=>$infoMember->id, 'type'=>1);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['phone_agency'])){
					$checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency'] ])->first();

					if(!empty($checkMember)){
						$conditions['id_member_buy'] = $checkMember->id;
					}else{
						$conditions['id_member_buy'] = -1;
					}
				}

				if(!empty($dataSend['phone_customer'])){
					$checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer'] ])->first();

					if(!empty($checkCustomer)){
						$conditions['id_customer'] = $checkCustomer->id;
					}else{
						$conditions['id_customer'] = -1;
					}
				}

				if(!empty($dataSend['type_order'])){
					$conditions['type_order'] = $dataSend['type_order'];
				}

				if(isset($dataSend['status'])){
					$conditions['status'] = $dataSend['status'];
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);

				}


				$listData = $modelDebt->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


				if(!empty($listData)){
					foreach($listData as $key =>$item){
						if(!empty($item->id_member_buy) && $item->type_order==1){
							$listData[$key]->member = $modelMember->find()->where(['id'=>$item->id_member_buy])->first();
						}

						if(!empty($item->id_customer) && $item->type_order==2){
							$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
						}
					}
				}

				$totalData = $modelDebt->find()->where($conditions)->all()->toList();
				
				$totalMoney = 0;
				if(!empty($totalData)){
					foreach ($totalData as $key => $value) {
						$totalMoney += $value->total;
					}
				}
				$totalData = count($totalData);

				$return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>1, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;
}

function paymentCollectionBillAPI($input){
	global $isRequestPost;
	global $modelCategories;
	global $metaTitleMantan;
	global $controller;
	global $urlCurrent;
	global $urlHomes;

	$metaTitleMantan = 'Thông tin công nợ phải trả';

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){
				$modelMember = $controller->loadModel('Members');
				$modelBill = $controller->loadModel('Bills');
				$modelCustomer = $controller->loadModel('Customers');
				$modelDebts = $controller->loadModel('Debts');
				$time = time();

				$mess= '';
				$debtCollection = $modelDebts->get( (int) $dataSend['id']);
				if(!empty($debtCollection->id_member_buy)){
					$conditions = array('id_member_buy'=>$debtCollection->id_member_buy,
						'id_member_sell'=>$debtCollection->id_member_sell,
						'id_order'=>$debtCollection->id_order,
						'type'=>2,
					);
					$debtPayable = $modelDebts->find()->where($conditions)->first();
				}
		       // debug($debtCollection);
		       // debug($debtPayable);
		        // info đại lý mua
				$memberbuy = $modelMember->find()->where(['id'=>$debtCollection->id_member_buy])->first();

		        //// info đại lý bán
				$membersell = $modelMember->find()->where(['id'=>$debtCollection->id_member_sell])->first();


				if($debtCollection->total-$debtCollection->total_payment>=(int)$dataSend['total']){

		        	// đại lý thu 
					if(@$debtCollection->type_order==1 && @$debtPayable->type_order==1){
						if(@$debtCollection->type==1){
							$number =$debtCollection->number_payment+1;
				             // bill cho người thu nợ
							$billsell = $modelBill->newEmptyEntity();
							$billsell->id_member_sell = $debtCollection->id_member_sell;
							$billsell->id_member_buy = $debtCollection->id_member_buy;
							$billsell->total = (int)$dataSend['total'];
							$billsell->id_order = @$debtCollection->id_order;
							$billsell->type = 1;
							$billsell->type_order = 1; 
							$billsell->created_at = $time;
							$billsell->updated_at = $time;
							$billsell->id_debt = $debtCollection->id;
							$billsell->type_collection_bill =  @$dataSend['type_collection_bill'];
							$billsell->id_customer = 0;
							$billsell->note = 'Thu công nợ cho đại lý '.@$memberbuy->name.' '.@$memberbuy->phone.', công nợ có id '.@$debtCollection->id.', của đơn hàng id '.@$debtCollection->id_order.', lần thứ '.@$number.', '.@$dataSend['note'];

							$modelBill->save($billsell);

							$debtCollection->total_payment += (int)@$dataSend['total'];
							$debtCollection->number_payment += 1;
							$debtCollection->updated_at = $time;
							if($debtCollection->total_payment==$debtCollection->total){
								$debtCollection->status = 1;
							}
							$modelDebts->save($debtCollection);
						}

			        	// đại lý trả
						if(@$debtPayable->type==2){
							$number =$debtPayable->number_payment+1;
				             // bill cho đại lý trả nợ
							$billsell = $modelBill->newEmptyEntity();
							$billsell->id_member_sell = $debtPayable->id_member_sell;
							$billsell->id_member_buy = $debtPayable->id_member_buy;
							$billsell->total = (int)$dataSend['total'];
							$billsell->id_order = @$debtPayable->id_order;
							$billsell->type = 2;
							$billsell->type_order = 1; 
							$billsell->created_at = $time;
							$billsell->updated_at = $time;
							$billsell->id_debt = $debtPayable->id;
							$billsell->type_collection_bill =  @$dataSend['type_collection_bill'];
							$billsell->id_customer = 0;
							$billsell->note = 'Trả công nợ cho đại lý '.@$membersell->name.' '.@$membersell->phone.', công nợ có id '.@$debtPayable->id.', của đơn hàng id '.@$debtPayable->id_order.', lần thứ '.@$number;

							$modelBill->save($billsell);

							$debtPayable->total_payment += (int)@$dataSend['total'];
							$debtPayable->number_payment += 1;
							$debtPayable->updated_at = $time;
							if($debtPayable->total_payment==$debtPayable->total){
								$debtPayable->status = 1;
							}
							$modelDebts->save($debtPayable);
						}
					}elseif(@$debtCollection->type_order==2 && !empty($debtCollection->id_customer)){
						$conditions = $modelCustomer->find()->where(['id'=>$debtCollection->id_customer]);
						$number =$debtCollection->number_payment+1;
				             // bill cho người thu nợ
						$billsell = $modelBill->newEmptyEntity();
						$billsell->id_member_sell = $debtCollection->id_member_sell;
						$billsell->id_member_buy = 0;
						$billsell->total = (int)$dataSend['total'];
						$billsell->id_order = @$debtCollection->id_order;
						$billsell->type = 1;
						$billsell->type_order = 2; 
						$billsell->created_at = $time;
						$billsell->updated_at = $time;
						$billsell->id_debt = $debtCollection->id;
						$billsell->type_collection_bill =  @$dataSend['type_collection_bill'];
						$billsell->id_customer = $debtCollection->id_customer;
						$billsell->note = 'Thu công nợ cho khách hàng '.@$conditions->full_name.' '.@$conditions->phone.', công nợ có id '.@$debtCollection->id.', của đơn hàng id '.@$debtCollection->id_order.', lần thứ '.@$number.', '.@$dataSend['note'];

						$modelBill->save($billsell);

						$debtCollection->total_payment += (int)@$dataSend['total'];
						$debtCollection->number_payment += 1;
						$debtCollection->updated_at = $time;
						if($debtCollection->total_payment==$debtCollection->total){
							$debtCollection->status = 1;
						}
						$modelDebts->save($debtCollection);
					}
					$return = array('code'=>1, 'mess'=>'Đã thu thành công');
				}else{
					$return = array('code'=>4, 'mess'=>'Đã thu xong');
				}
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>1, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;
}

function listPayableDebtAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $type_collection_bill;

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoMember = getMemberByToken($dataSend['token']);

			if(!empty($infoMember)){
				$modelMember = $controller->loadModel('Members');
				$modelCustomers = $controller->loadModel('Customers');
				$modelDebt = $controller->loadModel('Debts');


				$conditions = array('id_member_buy'=>$$infoMember->id, 'type'=>2);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['phone_agency'])){
					$checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone_agency'] ])->first();

					if(!empty($checkMember)){
						$conditions['id_member_sell'] = $checkMember->id;
					}else{
						$conditions['id_member_sell'] = -1;
					}
				}

				if(!empty($dataSend['phone_customer'])){
					$checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer'] ])->first();

					if(!empty($checkCustomer)){
						$conditions['id_customer'] = $checkCustomer->id;
					}else{
						$conditions['id_customer'] = -1;
					}
				}

				if(!empty($dataSend['type_order'])){
					$conditions['type_order'] = $dataSend['type_order'];
				}

				if(isset($dataSend['status'])){
					$conditions['status'] = $dataSend['status'];
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['time >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['time <='] = $date_end;
				}

				if(!empty($dataSend['id_customer'])){
					$conditions['id_customer'] = (int) $dataSend['id_customer'];
				}


				$listData = $modelDebt->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				if(!empty($listData)){
					foreach($listData as $key =>$item){
						if(!empty($item->id_member_sell) && $item->type_order==1){
							$listData[$key]->member = $modelMember->find()->where(['id'=>$item->id_member_sell])->first();
						}

						if(!empty($item->id_customer) && $item->type_order==2){
							$listData[$key]->customer = $modelCustomers->find()->where(['id'=>$item->id_customer])->first();
						}
					}
				}

				$totalData = $modelDebt->find()->where($conditions)->all()->toList();
				$totalMoney = 0;
				if(!empty($totalData)){
					foreach ($totalData as $key => $value) {
						$totalMoney += $value->total;
					}
				}
				$totalData = count($totalData);

				$return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData, 'totalMoney'=>$totalMoney);
			}else{
				$return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>1, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;
}



?>