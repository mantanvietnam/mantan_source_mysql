<?php 
function listMemberAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách người dùng';
    $mess = '';

	$modelMembers = $controller->loadModel('Members');
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
				$type = 'Nhận viên';
				if(!empty($value->type) && $value->type==1) $type = 'Members';

				$status = 'Kích hoạt';
				if(empty($value->status)) $status = 'Khóa';
				if(!empty($value->type) && $value->type==1) $type = 'Designer';

				$dataExcel[] = [
								$value->name, 
								$value->phone, 
								$value->email, 
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
        $data->created_at = date('Y-m-d H:i:s');
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', @$dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone']];
        	$checkPhone = $modelMembers->find()->where($conditions)->first();

        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->avatar = $dataSend['avatar'];
				$data->email = $dataSend['email'];
				$data->status = (int) $dataSend['status'];
				$data->updated_at = date('Y-m-d H:i:s');
				$data->dateline_at = @$dataSend['dateline_at'];

				if(empty($_GET['id'])){

		        	$data->phone = $dataSend['phone'];

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

	global $isRequestPost;

	$modelOrder = $controller->loadModel('Orders');
	$modelMembers = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelMembers->get($_GET['id']);
		if ($isRequestPost) {
			$dataSend = $input['request']->getData();

			if($_GET['type']=='plus'){
				$data->account_balance = $data->account_balance + $dataSend['coin'];

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

			}elseif($_GET['type']=='minus'){
				$data->account_balance = $data->account_balance - $dataSend['coin'];

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

					 $dataSendNotification= array('title'=>'Bạn được công tiền thành công ','content'=>'lý do bạn được cộng tiền là '.@$dataSend['note'].'đ vào trong tài khoản ạ','action'=>'addMoneySuccess');

					if(!empty($data->token_device)){
                        sendNotification($dataSendNotification, $data->token_device);
                    }

                    if(!empty($data->email)){
                    	sendEmailAddMoney($data->email, $data->name, $dataSend['coin'], @$dataSend['note']);
                    }



					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php?statuss=4');	
				}elseif($_GET['type']=='minus'){

					 $dataSendNotification= array('title'=>'Bạn bị trừ tiền ','time'=>date('H:i d/m/Y'),'content'=>'lý do bạn bị trừ là:  '.$dataSend['note'].'đ vào trong tài khoản ạ','action'=>'addMoneySuccess',);
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

?>