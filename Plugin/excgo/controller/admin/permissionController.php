<?php 
function addPermissionData($input){
	global $permissiondata;
	global $isRequestPost;
	global $controller;
    global $metaTitleMantan;
    global $session;



    $metaTitleMantan = 'Phân Quyền ';
    $bookingModel = $controller->loadModel('Bookings');
    $modelAdmins = $controller->loadModel('Admins');
    $provinceModel = $controller->loadModel('Provinces');
	// debug($_GET);
      $mess= '';
	$admin = $modelAdmins->get((int)$_GET['id']);
	// debug($admin);

	if($isRequestPost){
	    $dataSend = $input['request']->getData();

		$admin->permission_data = json_encode(@$dataSend['permissiondata']);

		$modelAdmins->save($admin);
		  $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	}

	if(!empty($admin->permission_data)){
		$admin->permissiondata = json_decode(@$admin->permission_data, true);
	}
		

	setVariable('admin', $admin);
	setVariable('mess', $mess);
	setVariable('permissiondata', $permissiondata);

	// die;
}
?>