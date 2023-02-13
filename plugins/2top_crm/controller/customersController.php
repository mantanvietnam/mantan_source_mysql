<?php 
function listCustomerCRM($input)
{
	global $controller;
	global $urlCurrent;

	$modelCustomer = $controller->loadModel('Customers');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;

    $listData = $modelCustomer->find()->limit($limit)->page($page)->where($conditions)->all()->toList();

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

	        $modelCustomer->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
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

	return $controller->redirect('/plugins/admin/2top_crm-view-admin-customer-listCustomerCRM.php');
}
?>