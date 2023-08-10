<?php 
function listSpaAdmin($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditions['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
	}
	
	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

	

    $listData = $modelSpas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->member = $modelMember->get($value->id_member);
    	}
    }

    $totalData = $modelSpas->find()->where($conditions)->all()->toList();
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

     $mess = '';
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
       $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }


    setVariable('mess', $mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
}
function addSpaAdmin($input){
        global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelSpas = $controller->loadModel('Spas');
   
         // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelSpas->get( (int) $_GET['id']);

    }else{
        return $controller->redirect('/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin.php');
            
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $data->name = $dataSend['name'];
        $data->phone = $dataSend['phone'];
        $data->address = $dataSend['address'];
        $data->note = $dataSend['note'];
        $data->updated_at =date('Y-m-d H:i:s');
        $data->slug = createSlugMantan($dataSend['name']).'-'.time();
        $modelSpas->save($data);
        if(!empty($_GET['id'])){
            return $controller->redirect('/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin.php?status=2');
        }else{
            return $controller->redirect('/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin.php');
        }
    }
    setVariable('data', $data);

}

function deleteSpaAdmin($input){
    global $controller;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelSpas = $controller->loadModel('Spas');
    $infoUser = $session->read('infoUser');

    $conditions = array();
    $conditions['id_member']= $infoUser->id;

    $totalData = $modelSpas->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);
    if(!empty($_GET['id'])){
        $data = $modelSpas->get($_GET['id']);
        if($data){
            $modelSpas->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin.php?status=3');
}

 ?>