<?php 
function listAddressCustomer($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách địa chỉ';

	$modelCustomer = $controller->loadModel('Customers');
	$modelAddressCustomer = $controller->loadModel('Address');
    

    $conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'asc');

	if(!empty($_GET['id_customer'])){
		$conditions['id_customer'] = (int) $_GET['id_customer'];
        $customer = $modelCustomer->get((int) $_GET['id_customer']);
	}

    if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['address_type'])){
		$conditions['address_type'] = (int)$_GET['address_type'];
	}

	if(!empty($_GET['address_name'])){
		$conditions['address_name LIKE'] = '%'.$_GET['address_name'].'%';
	}

    $listData = $modelAddressCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    $totalData = $modelAddressCustomer->find()->where($conditions)->all()->toList();


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
    
    setVariable('customer', $customer);
    setVariable('listData', $listData);
}

function addAddress($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin địa chỉ';

	$modelAddress = $controller->loadModel('Address');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelAddress->get( (int) $_GET['id']);
    }else{
        $data = $modelAddress->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['address_name']) && isset($dataSend['address_type'])){
            
            if($dataSend['address_type'] == 1){
                $lists = $modelAddress->find('all');
                foreach ($lists as $item){
                    $item->address_type = 0;
                }
            }

            // tạo dữ liệu save
            $data->address_name = $dataSend['address_name'];
            $data->address_type = $dataSend['address_type'];
            $data->id_customer = (int) $_GET['id_customer'];

            

            $modelAddress->save($data);
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}


function deleteAddress($input){
	global $controller;

	$modelAddress = $controller->loadModel('Address');
	
	if(!empty($_GET['id'])){
		$data = $modelAddress->get($_GET['id']);
		
		if($data){
         	$modelAddress->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm-view-admin-address-listAddressCustomer.php');
}

?>