<?php 
function listDesignRegistrationAdmin($input){
	 global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
    
    $conditions = array();

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


     $conditions['type']= 1;


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelmember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelmember->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelmember->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addDesignRegistrationAdmin($input){


	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelmember->get( (int) $_GET['id']);
    }else{
        $data = $modelmember->newEmptyEntity();
    }

     // debug($data);
     // die;

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
		        // tạo dữ liệu save
		$data->name = @$dataSend['name'];
		$data->email = @$dataSend['email'];
		$data->id_facebook = @$dataSend['id_facebook'];
		$data->avatar = @$dataSend['avatar'];
		$data->status = @$dataSend['status'];
		$data->updated_at = date('Y-m-d H:i:s');
		$data->id_google = @$dataSend['id_google'];
		$data->id_apple = @$dataSend['id_apple'];
		if(!empty($dataSend['pass'])){
			$data->password = md5($dataSend['pass']);
		}
		$modelmember->save($data);

		return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-designRegistration-listDesignRegistrationAdmin.php?status=2');

		  
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteDesignRegistrationAdmin($input){
	global $controller;

	$modelmember = $controller->loadModel('members');
	
	if(!empty($_GET['id'])){
		$data = $modelmember->get($_GET['id']);
		
		if($data){
         	$modelmember->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-designRegistration-listDesignRegistrationAdmin.php?status=3');
}

function listMemberAdmin($input){
	 global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
    
    $conditions = array();

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


     $conditions['type']= 0;


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelmember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelmember->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelmember->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addMemberAdmin($input){


	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelmember->get( (int) $_GET['id']);
    }else{
        $data = $modelmember->newEmptyEntity();
    }

     // debug($data);
     // die;

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
		        // tạo dữ liệu save
		$data->name = @$dataSend['name'];
		$data->email = @$dataSend['email'];
		$data->id_facebook = @$dataSend['id_facebook'];
		$data->avatar = @$dataSend['avatar'];
		$data->status = @$dataSend['status'];
		$data->updated_at = date('Y-m-d H:i:s');
		$data->id_google = @$dataSend['id_google'];
		$data->id_apple = @$dataSend['id_apple'];
		if(!empty($dataSend['pass'])){
			$data->password = md5($dataSend['pass']);
		}
		$modelmember->save($data);

		return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php?status=2');

		  
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteMemberAdmin($input){
	global $controller;

	$modelmember = $controller->loadModel('members');
	
	if(!empty($_GET['id'])){
		$data = $modelmember->get($_GET['id']);
		
		if($data){
         	$modelmember->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php?status=3');
}


function listOrderProductAdmin($input){
	 global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelContact = $controller->loadModel('contact');
    
    $conditions = array();

  /*  if(!empty($_GET['id'])){
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
	}*/


     $conditions['type']= 0;


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelContact->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelContact->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelContact->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addOrderProductAdmin($input){


	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelmember->get( (int) $_GET['id']);
    }else{
        $data = $modelmember->newEmptyEntity();
    }

     // debug($data);
     // die;

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
		        // tạo dữ liệu save
		$data->name = @$dataSend['name'];
		$data->email = @$dataSend['email'];
		$data->id_facebook = @$dataSend['id_facebook'];
		$data->avatar = @$dataSend['avatar'];
		$data->status = @$dataSend['status'];
		$data->updated_at = date('Y-m-d H:i:s');
		$data->id_google = @$dataSend['id_google'];
		$data->id_apple = @$dataSend['id_apple'];
		if(!empty($dataSend['pass'])){
			$data->password = md5($dataSend['pass']);
		}
		$modelmember->save($data);

		return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php?status=2');

		  
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteOrderProductAdmin($input){
	global $controller;

	$modelmember = $controller->loadModel('members');
	
	if(!empty($_GET['id'])){
		$data = $modelmember->get($_GET['id']);
		
		if($data){
         	$modelmember->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php?status=3');
}
?>