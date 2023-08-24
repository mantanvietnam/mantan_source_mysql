<?php 
function listPartner($input)
{
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách đối tác';

	$modelPartner = $controller->loadModel('Partners');
	$modelProduct = $controller->loadModel('Products');
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		$conditions = array('id_member'=>$infoUser->id_member);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['phone'])){
			$conditions['phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['email'] = $_GET['email'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelPartner->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
								['name'=>'ID', 'type'=>'text', 'width'=>10],
								['name'=>'Họ tên', 'type'=>'text', 'width'=>25],
								['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
								['name'=>'Email', 'type'=>'text', 'width'=>35],
								['name'=>'Địa chỉ', 'type'=>'text', 'width'=>35],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					

					$dataExcel[] = [
									$value->id, 
									$value->name, 
									$value->phone, 
									$value->email, 
									$value->address,
								];
				}
			}
			
			export_excel($titleExcel, $dataExcel, 'danh-sach-doi-tac'.date('d-m-Y'));
	    }else{
	    	$listData = $modelPartner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    $totalData = $modelPartner->find()->where($conditions)->all()->toList();
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
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function addPartner($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin đối tác';

	$modelPartner = $controller->loadModel('Partners');
	$modelMembers = $controller->loadModel('Members');
	
	$mess= '';
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelPartner->get( (int) $_GET['id']);
	    }else{
	        $data = $modelPartner->newEmptyEntity();
			$data->created_at = date('Y-m-d H:i:s');
	    }

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
	        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
	        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id_member];
	        	$checkPhone = $modelPartner->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
			        // tạo dữ liệu save
			        $data->name = $dataSend['name'];
			        $data->phone = $dataSend['phone'];
			        $data->address = $dataSend['address'];
			        $data->email = $dataSend['email'];
			        $data->note = $dataSend['note'];
			        $data->id_member = $infoUser->id_member;
			        $data->updated_at = date('Y-m-d H:i:s');

			        $modelPartner->save($data);

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
	    setVariable('infoUser', $infoUser);
    }else{
		return $controller->redirect('/login');
	}
}

function deletePartner($input){
	global $controller;
	global $session;
	
	$modelPartner = $controller->loadModel('Partners');
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		if(!empty($_GET['id'])){
			$data = $modelPartner->get($_GET['id']);
			
			if(!empty($data)){
	         	$modelPartner->delete($data);
	        }
		}

		return $controller->redirect('/listPartner');
	}else{
		return $controller->redirect('/login');
	}
}


 ?>