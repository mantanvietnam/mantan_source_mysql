<?php 
function listMemberAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách người dùng';
    $mess = '';

	$modelMembers = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$conditions = array();
	$limit = 20;


	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	if(empty(@$_GET['order'])){
		$order = array('id'=>'desc');
	}elseif(@$_GET['order']==1){
		$order = array('last_login'=>'desc');
	}
	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditions['phone'] = $_GET['phone'];
	}

	if(!empty($_GET['email'])){
		$conditions['email'] = $_GET['email'];
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = (int) $_GET['status'];
		}
	}

	if(isset($_GET['pro'])){
		if($_GET['pro']!=''){
			$conditions['member_pro'] = (int) $_GET['pro'];
		}
	}

	if(isset($_GET['type'])){
		if($_GET['type']!=''){
			$conditions['type'] = (int) $_GET['type'];
		}
	}

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

	$conditiontoday['created_at >='] = date('Y-m-d').' 00:00:00';
	$conditiontoday['created_at <='] = date('Y-m-d H:i:s');

	

	$totalDatatoday = $modelMembers->find()->where($conditiontoday)->all()->toList();
    $totalDatatoday = count($totalDatatoday);

    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    	$listData = $modelMembers->find()->where($conditions)->order($order)->all()->toList();

    	$titleExcel = 	[
							['name'=>'Họ tên', 'type'=>'text', 'width'=>25],
							['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
							['name'=>'Email', 'type'=>'text', 'width'=>35],
							['name'=>'Số dư', 'type'=>'number', 'width'=>15],
							['name'=>'Loại tài khoản', 'type'=>'text', 'width'=>15],
							['name'=>'Trạng thái', 'type'=>'text', 'width'=>15],
							['name'=>'Chiết khấu', 'type'=>'number', 'width'=>10],
						];

		$dataExcel = [];
		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$type = 'Người dùng';
				if(!empty($value->type) && $value->type==1) $type = 'Designer';

				$status = 'Kích hoạt';
				if(empty($value->status)) $status = 'Khóa';
				if(!empty($value->type) && $value->type==1) $type = 'Designer';

				$dataExcel[] = [
								$value->name, 
								$value->phone, 
								$value->email, 
								$value->account_balance, 
								$type,
								$status,
								$value->commission, 
							];
			}
		}

		export_excel($titleExcel, $dataExcel);
    }else{
    	$listData = $modelMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }

    if(!empty($listData)){
    	foreach($listData as $key => $item){
    		$listData[$key]->totaProducts  = count($modelProduct->find()->where(array('type'=>'user_create', 'status'=> 2, 'user_id'=> $item->id))->all()->toList());

    		$listData[$key]->totaWarehouse = count($modelWarehouse->find()->where(array('user_id'=> $item->id))->all()->toList());
    		$listData[$key]->totaFollowDesigner = count($modelFollowDesigner->find()->where(array('designer_id'=> $item->id))->all()->toList());
    	}
    }
    

    $totalData = $modelMembers->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0)
        $totalPage+=1;

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }
     if(@$_GET['statuss']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['statuss']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }elseif(@$_GET['statuss']==4){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Cộng tiền thành công</p>';
    }elseif(@$_GET['statuss']==5){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Trừ tiền thành công</p>';
    }elseif(@$_GET['statuss']==6){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Lên bản Pro thành công</p>';
    }elseif(@$_GET['statuss']==7){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Lên bản Pro không thành công</p>';
    }

    setVariable('page', $page);
    setVariable('totalDatatoday', $totalDatatoday);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
}

function listMemberDeadlineProAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách người dùng sắp hết hạn Pro';
    $mess = '';

	$modelMembers = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$conditions = array();
	$limit = 20;


	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	if(empty(@$_GET['order'])){
		$order = array('id'=>'desc');
	}elseif(@$_GET['order']==1){
		$order = array('last_login'=>'desc');
	}
	
	$conditions['member_pro'] = 1;
	$conditions['deadline_pro <'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 8 days'));
    
    $listData = $modelMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    

    if(!empty($listData)){
    	foreach($listData as $key => $item){
    		$listData[$key]->totaProducts  = count($modelProduct->find()->where(array('type'=>'user_create', 'status'=> 2, 'user_id'=> $item->id))->all()->toList());

    		$listData[$key]->totaWarehouse = count($modelWarehouse->find()->where(array('user_id'=> $item->id))->all()->toList());
    		$listData[$key]->totaFollowDesigner = count($modelFollowDesigner->find()->where(array('designer_id'=> $item->id))->all()->toList());
    	}
    }
    

    $totalData = $modelMembers->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0)
        $totalPage+=1;

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }
     

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
}

function addMemberAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin người dùng';

	$modelMembers = $controller->loadModel('Members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelMembers->get( (int) $_GET['id']);
    }else{
        $data = $modelMembers->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone']];
        	$checkPhone = $modelMembers->find()->where($conditions)->first();

        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->avatar = $dataSend['avatar'];
		        $data->phone = $dataSend['phone'];
		        $data->aff = $dataSend['phone'];
				$data->affsource = $dataSend['affsource'];
				$data->email = $dataSend['email'];
				$data->level = $dataSend['level'];
				$data->status = (int) $dataSend['status'];
				$data->commission = (int) $dataSend['commission'];
				$data->type = (int) $dataSend['type'];
				$data->created_at = date('Y-m-d H:i:s');

				if(empty($_GET['id'])){
					$data->account_balance = 10000; // tặng 10k cho tài khoản mới

					if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
					$data->password = md5($dataSend['password']);

					$data->token = '';
				}else{
					if(!empty($dataSend['password'])){
			        	$data->password = md5($dataSend['password']);
			        }
				}

		        $modelMembers->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
		    }
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function lockMemberAdmin($input){
	global $controller;

	$modelMembers = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelMembers->get($_GET['id']);
		
		if($data){
			if(!empty($_GET['status']==1)){
				$data->status = 0;
			}else{
				$data->status = 1;
			}
			$data->token = '';
         	$modelMembers->save($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php');
}

function addMoneyManager($input){
	global $controller;
    global $recommenders;
	global $isRequestPost;

	$modelOrder = $controller->loadModel('Orders');
	$modelMembers = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelMembers->get($_GET['id']);
		if ($isRequestPost) {
			$dataSend = $input['request']->getData();

			if($_GET['type']=='plus'){
				$data->account_balance +=  $dataSend['coin'];

				$order = $modelOrder->newEmptyEntity();
				
				$order->code = 'AM'.time().$data->id.rand(0,10000);
                $order->member_id = $data->id;
                $order->product_id = '';
                $order->meta_payment = $data->phone.' ezpics '.$order->code;
                $order->payment_type = 1;
                $order->total = (int) $dataSend['coin'];
                $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 1; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5 trừ tiền 
                $order->created_at = date('Y-m-d H:i:s');
                $order->payment_kind = $dataSend['payment_kind'];
                $order->note = 'bạn được công tiền trong admin lý do công là:  '.@$dataSend['note'];


                
                $modelOrder->save($order);

                if($order->payment_kind==1){
                	 if(!empty($data->affsource)){
                        $User = $modelMembers->find()->where(array('id'=>$data->affsource))->first();
                        if(!empty($User)){
                            $User->account_balance += ((int) $recommenders / 100) * $dataSend['coin'];
                            $modelMembers->save($User);

                            $save = $modelOrder->newEmptyEntity();
                            $save->code = 'W'.time().$User->id.rand(0,10000);
                            $save->member_id = $User->id;
                            $save->total = ((int) $recommenders / 100) * $dataSend['coin'];
                            $save->status = 2; // 1: chưa xử lý, 2 đã xử lý
                            $save->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
                            $save->meta_payment = 'Bạn được công tiền hoa hồng giới thiệu';
                            $save->created_at = date('Y-m-d H:i:s');

                            $modelOrder->save($save);

                            // gửi thông báo về app
                            $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng giới thiệu','time'=>date('H:i d/m/Y'),'content'=>'- '.$User->name.' ơi. Bạn được cộng '.number_format($save->total).' VND do thành viên '.$data->name.' đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

                            if(!empty($User->token_device)){
                                sendNotification($dataSendNotification, $User->token_device);
                            }
                        }
                    }
                }

			}elseif($_GET['type']=='minus'){
				$data->account_balance -=  $dataSend['coin'];

				$order = $modelOrder->newEmptyEntity();
				
				$order->code = 'MI'.time().$data->id.rand(0,10000);
                $order->member_id = $data->id;
                $order->product_id = '';
                $order->meta_payment = $data->phone.' ezpics '.$order->code;
                $order->payment_type = 1;
                $order->total = (int)  $dataSend['coin'];
                $order->note = 'bạn bị trừ tiền trong admin';
                $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
                $order->type = 5; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5 trừ tiền 
                $order->created_at = date('Y-m-d H:i:s');
                $order->note = 'bạn bị trừ tiền trong admin lý do trừ là:  '.@$dataSend['note'];
                
                $modelOrder->save($order);

			}

				$modelMembers->save($data);
				if($_GET['type']=='plus'){

					 $dataSendNotification= array('title'=>'Bạn được công '.number_format(@$dataSend['coin']).'đ thành công ','content'=>'Lý do bạn được cộng tiền là '.@$dataSend['note'].', vào trong tài khoản ạ','action'=>'addMoneySuccess');

					if(!empty($data->token_device)){
                        sendNotification($dataSendNotification, $data->token_device);
                    }

                    if(!empty($data->email)){
                    	sendEmailAddMoney($data->email, $data->name, $dataSend['coin'], @$dataSend['note']);
                    }



					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=4');	
				}elseif($_GET['type']=='minus'){

					 $dataSendNotification= array('title'=>'Bạn bị trừ '.number_format(@$dataSend['coin']).'đ vào trong tài khoản','time'=>date('H:i d/m/Y'),'content'=>'lý do bạn bị trừ là:  '.$dataSend['note'].' vào trong tài khoản ạ','action'=>'addMoneySuccess',);
					  if(!empty($data->token_device)){
                            sendNotification($dataSendNotification, $data->token_device);
                            
                        }

                        if(!empty($data->email)){
                    		sendEmailMinusMoney($data->email, $data->name, $dataSend['coin'], @$dataSend['note']);
                    	}
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=5');
				}				


		}




		setVariable('data', $data);
	}else{

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php');																									
	}


}

function memberBuyProAdmin($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	$return = array('code'=>0);

	
	$dataSend = $input['request']->getData();	
	$user = $modelMember->find()->where(array('id'=>$_GET['id']))->first();
	if(isset($_GET['date_use'])){
		$date = $_GET['date_use'];
	}else{
		$date = 365;
	}

	if(isset($_GET['price'])){
		$price = $_GET['price'];
	}else{
		$price = 0;
	}



	if(!empty($user)){
		if($user->member_pro!=1){
			if($user->account_balance >=$price){
				if($price>0){
					$user->account_balance -= $price;
				}
				$user->member_pro = 1;
				$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' +'.$date.' days'));
				$modelMember->save($user);
				if($price>0){
					$order = $modelOrder->newEmptyEntity();
					$order->code = 'W'.time().$user->id.rand(0,10000);
					$order->member_id = $user->id;
					$order->total = $price;
					$order->status = 2; // 1: chưa xử lý, 2 đã xử lý 
					$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro
					$order->meta_payment = 'Mua phiêu bản Pro';
					$order->created_at = date('Y-m-d H:i:s');
					$modelOrder->save($order);
				}
				
				$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
				if(empty($WarehouseUser)){
					$data = $modelWarehouseUsers->newEmptyEntity();
			            // tạo dữ liệu save
					$data->warehouse_id = (int) 1;
					$data->user_id = $user->id;
					$data->designer_id = 343;
					$data->price = @$price;
					$data->created_at = date('Y-m-d H:i:s');
					$data->note ='';
					$data->deadline_at = $user->deadline_pro;
					$modelWarehouseUsers->save($data);
				}else{
					$WarehouseUser->deadline_at = $user->deadline_pro;
					$modelWarehouseUsers->save($WarehouseUser);
				}
				$dataSendNotification= array('title'=>'Tài khoản của bạn đã lên bản Pro ','time'=>date('H:i d/m/Y'),'content'=>'Chúc mừng bạn, tài khoản của bạn đã được nâng cấp lên bản Pro!','action'=>'memberBuyPro',);
				if(!empty($user->token_device)){
                    sendNotification($dataSendNotification, $user->token_device);
                            
                }

              	if(!empty($user->email)){
               		sendEmailBuyPro($user->email, $user->name);
              	}
				return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=6');
			}
		}
	}		
	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=7');
}

function memberExtendProAdmin($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelOrder = $controller->loadModel('Orders');
	$modelDiscountCode = $controller->loadModel('DiscountCodes');
	$modelWarehouseUsers = $controller->loadModel('WarehouseUsers');

	$return = array('code'=>0);

	
	$dataSend = $input['request']->getData();	
	$user = $modelMember->find()->where(array('id'=>$_GET['id']))->first();
	if(isset($_GET['date_use'])){
		$date = $_GET['date_use'];
	}else{
		$date = 365;
	}

	if(isset($_GET['price'])){
		$price = $_GET['price'];
	}else{
		$price = 0;
	}



	if(!empty($user)){
		if($user->member_pro==1){
			if($user->account_balance >=$price){
				if($price>0){
					$user->account_balance -= $price;
				}
				$user->deadline_pro = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' +'.$date.' days'));
				$modelMember->save($user);
				if($price>0){
					$order = $modelOrder->newEmptyEntity();
					$order->code = 'W'.time().$user->id.rand(0,10000);
					$order->member_id = $user->id;
					$order->total = $price;
					$order->status = 2; // 1: chưa xử lý, 2 đã xử lý 
					$order->type = 9; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro
					$order->meta_payment = 'Gia hạn thêm phiêu bản Pro';
					$order->created_at = date('Y-m-d H:i:s');
					$modelOrder->save($order);
				}
				
				$WarehouseUser = $modelWarehouseUsers->find()->where(array('warehouse_id'=>1, 'user_id'=>@$user->id))->first();
				if(empty($WarehouseUser)){
					$data = $modelWarehouseUsers->newEmptyEntity();
			            // tạo dữ liệu save
					$data->warehouse_id = (int) 1;
					$data->user_id = $user->id;
					$data->designer_id = 343;
					$data->price = @$price;
					$data->created_at = date('Y-m-d H:i:s');
					$data->note ='';
					$data->deadline_at = $user->deadline_pro;
					$modelWarehouseUsers->save($data);
				}else{
					$WarehouseUser->deadline_at = $user->deadline_pro;
					$modelWarehouseUsers->save($WarehouseUser);
				}
				$dataSendNotification= array('title'=>'Tài khoản của bạn đã lên bản Pro ','time'=>date('H:i d/m/Y'),'content'=>'Chúc mừng bạn, tài khoản của bạn đã được nâng cấp lên bản Pro!','action'=>'memberBuyPro',);
				if(!empty($user->token_device)){
                    sendNotification($dataSendNotification, $user->token_device);
                            
                }

              	if(!empty($user->email)){
               		sendEmailBuyPro($user->email, $user->name);
              	}
				return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=6');
			}
		}
	}		
	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=7');
}
function transferManagerAdmin($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelWarehouseUser = $controller->loadModel('WarehouseUsers');
	$modelWarehouseProduct = $controller->loadModel('WarehouseProducts');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$mess = '';
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if($dataSend['user_from']!=$dataSend['user_to']){
			$userFrom =  $modelMember->find()->where(array('phone'=>$dataSend['user_from'],'type'=>1))->first();
			$userTo =  $modelMember->find()->where(array('phone'=>$dataSend['user_to'],'type'=>1))->first();
			if(!empty($userFrom)){
				if(!empty($userTo)){
					if(!empty($dataSend['id_product'])){
						$idProduct = explode(',',$dataSend['id_product']);
						$so = 0;
						foreach($idProduct as $key => $id){
							$product = $modelProduct->find()->where(array('id'=>$id,'user_id'=>$userFrom->id,'OR' => [['type'=>'user_create'],['type'=>'user_series']]))->first();
							if(!empty($product)){
								$modelWarehouseProduct->deleteAll(array('product_id'=>$product->id));
								$product->user_id = $userTo->id;
								$modelProduct->save($product);
								$so += 1; 
								if(!empty($dataSend['warehouse_id'])){
									foreach($dataSend['warehouse_id'] as $keyW => $warehouse_id){
										$warehouse_products = $modelWarehouseProduct->newEmptyEntity();

						        		$warehouse_products->warehouse_id = $warehouse_id;
						        		$warehouse_products->product_id = $product->id;
						        		$warehouse_products->user_id =  $userTo->id;

						        		$modelWarehouseProduct->save($warehouse_products);
									}
								}

							}
						}
						$mess = 'bạn chuyển được '.$so.' mẫu thành công ';
					}else{
						$listProduct = $modelProduct->find()->where(array('user_id'=>$userFrom->id,'OR' => [['type'=>'user_create'],['type'=>'user_series']]))->all()->toList();
						if(!empty($listProduct)){
							$so = 0;
							foreach($listProduct as $key => $item){
								$modelWarehouseProduct->deleteAll(array('product_id'=>$item->id));
								$item->user_id = $userTo->id;
								$modelProduct->save($item);
								$so += 1;
								if(!empty($dataSend['warehouse_id'])){
									foreach($dataSend['warehouse_id'] as $keyW => $warehouse_id){
										$warehouse_products = $modelWarehouseProduct->newEmptyEntity();

						        		$warehouse_products->warehouse_id = $warehouse_id;
						        		$warehouse_products->product_id = $item->id;
						        		$warehouse_products->user_id =  $userTo->id;

						        		$modelWarehouseProduct->save($warehouse_products);
									}
								}
							}
							$mess = 'bạn chuyển được '.$so.' mẫu thành công ';
						}
					}
				}else{
					$mess = 'Tài khoản nhận không dùng';
				}
			}else{
				$mess = 'Tài khoản chuyển không đùng';
			}
		}else{
			$mess = '2 tài khoản không được giống nhau';
		}
	}

	setVariable('mess', $mess);
}

function getWarehouseByUser($input){
	global $isRequestPost;
	global $controller;
	global $price_pro;

	$modelMember = $controller->loadModel('Members');
	$modelWarehouse = $controller->loadModel('Warehouses');

	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$user =  $modelMember->find()->where(array('phone'=>$dataSend['user'],'type'=>1))->first();
		if(!empty($user)){
			$Warehouse =  $modelWarehouse->find()->where(array('user_id'=>$user->id))->all()->toList();
			if(!empty($Warehouse)){
				$return = array('code'=>1, 'data'=>$Warehouse,'mess'=>'bạn lấy data thành công!');
			}else{
				$return = array('code'=>2,'mess'=>'không có kho nào!');
			}
		}else{
			$return = array('code'=>3,'mess'=>'tài khoản sai!');
		}

	}
	return $return;
}

?>