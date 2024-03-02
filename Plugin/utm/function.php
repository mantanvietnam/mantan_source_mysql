<?php
	$menus= array();
	$menus[0]['title']= 'Nguồn khách vào';
    $menus[0]['sub'][0]= array('title'=>'Danh sách Nguồn khách vào','classIcon'=>'bx bx-list-ul','url'=>'/plugins/admin/utm-admin-listUtmAdmin','permission'=>'listUtmAdmin',);
    
    addMenuAdminMantan($menus); 


global $session;
	$data = array();
if(!empty($_GET['utm_source'])){
    

    $data['utm_source'] = $_GET['utm_source'];
    $data['utm_id'] = @$_GET['utm_id'];
}

if(!empty($_GET['utm_medium'])){

    $data['utm_medium'] = $_GET['utm_medium'];
}

if(!empty($_GET['utm_campaign'])){

    $data['utm_campaign'] = $_GET['utm_campaign'];
}


if(!empty($_GET['utm_term'])){

    $data['utm_term'] = $_GET['utm_term'];
}

if(!empty($_GET['utm_content'])){

    $data['utm_content'] = $_GET['utm_content'];
}
if(!empty($_GET['utm_name'])){

    $data['utm_name'] = $_GET['utm_name'];
}

$session->write('utm', $data);

function geUtm(){
	global $controller;
	global $session;
	$utm = $session->read('utm');
	$modelUtm = $controller->loadModel('Utms');

	$save = $modelUtm->newEmptyEntity();
	$save->utm_source = @$utm['utm_source'];
	$save->utm_medium = @$utm['utm_medium'];
	$save->utm_campaign = @$utm['utm_campaign'];
	$save->utm_id = @$utm['utm_id'];
	$save->utm_term = @$utm['utm_term'];
	$save->utm_content = @$utm['utm_content'];
	$save->utm_name = @$utm['utm_name'];
	$save->created_at = date('Y-m-d H:i:s');
	if($modelUtm->save($save)){
		$session->write('id_utm', $save->id);
		$session->write('utm', '');

	}

}






	
?>