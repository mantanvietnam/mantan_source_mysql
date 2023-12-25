<?php 
function listCustomerCRM($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelCustomer = $controller->loadModel('Customers');

	$conditions = array();
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

	if(!empty($_GET['status'])){
		$conditions['status'] = $_GET['status'];
	}

	if(!empty($_GET['full_name'])){
		$conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
	}

    $listData = $modelCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $totalData = $modelCustomer->find()->where($conditions)->all()->toList();
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
}

function addCustomerCRM($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin khách hàng';

	$modelCustomer = $controller->loadModel('Customers');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCustomer->get( (int) $_GET['id']);
    }else{
        $data = $modelCustomer->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['full_name']) && !empty($dataSend['phone'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone']];
        	$checkPhone = $modelCustomer->find()->where($conditions)->first();

        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
		        // tạo dữ liệu save
		        $data->full_name = $dataSend['full_name'];
		        $data->phone = $dataSend['phone'];
		        $data->email = $dataSend['email'];
		        $data->address = $dataSend['address'];
		        $data->sex = $dataSend['sex'];
		        $data->id_city = $dataSend['id_city'];
		        $data->id_messenger = $dataSend['id_messenger'];
		        $data->avatar = $dataSend['avatar'];
		        $data->status = $dataSend['status'];
		        $data->id_parent = (int) @$dataSend['id_parent'];
		        $data->id_level = (int) @$dataSend['id_level'];

		        if(empty($data->pass)){
		        	$data->pass = md5($dataSend['phone']);
		        }

		        if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';
				$birthday_date = 0;
				$birthday_month = 0;
				$birthday_year = 0;

				$birthday = explode('/', trim($dataSend['birthday']));
				if(count($birthday)==3){
					$birthday_date = (int) $birthday[0];
					$birthday_month = (int) $birthday[1];
					$birthday_year = (int) $birthday[2];
				}

				$data->birthday_date = (int) @$birthday_date;
				$data->birthday_month = (int) @$birthday_month;
				$data->birthday_year = (int) @$birthday_year;

		        $modelCustomer->save($data);

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

function deleteCustomerCRM($input){
	global $controller;

	$modelCustomer = $controller->loadModel('Customers');
	
	if(!empty($_GET['id'])){
		$data = $modelCustomer->get($_GET['id']);
		
		if($data){
         	$modelCustomer->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm-view-admin-customer-listCustomerCRM');
}
?>