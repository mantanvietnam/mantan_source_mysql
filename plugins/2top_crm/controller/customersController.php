<?php 
function listCustomerCRM($input)
{
	global $controller;

	$modelCustomer = $controller->loadModel('Customers');

	$conditions = array();
    $listData = $modelCustomer->find()->where($conditions)->all()->toList();

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

        if(!empty($dataSend['full_name']) && !empty($data['phone'])){
        	$data['phone'] = trim(str_replace(array(' ','.','-'), '', $data['phone']));

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