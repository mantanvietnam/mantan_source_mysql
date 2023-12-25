<?php
function listMemberAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thành viên';

	$modelMembers = $controller->loadModel('Members');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['email'])){
        $conditions['email'] = $_GET['email'];
    }

    if(!empty($_GET['type'])){
        $conditions['type'] = $_GET['type'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    $listData = $modelMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
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


    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);    
    setVariable('listData', $listData);

}

function addMemberAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin thành viên';

	$modelMembers = $controller->loadModel('Members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelMembers->get( (int) $_GET['id']);
    }else{
        $data = $modelMembers->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            $data->name = $dataSend['name'];
            $data->avatar = $dataSend['avatar'];
            $data->phone = $dataSend['phone'];
            $data->status = $dataSend['status'];
            $data->type = $dataSend['type'];
            $data->password = $dataSend['password'];
            $data->email = $dataSend['email'];

	        $modelMembers->save($data);
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
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
			if(isset($_GET['status'])){
				$data->status =$_GET['status'];
         		$modelMembers->save($data);
            }
        }
	}

	return $controller->redirect('/plugins/admin/exc_go-view-admin-member-listMemberAdmin');
}


?>