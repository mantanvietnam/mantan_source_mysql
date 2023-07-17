<?php 
function listSaff($input)
{
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){

		$modelMembers = $controller->loadModel('Members');
		$conditions = array('id_member'=>$infoUser->id_member);
		$limit = 20;

		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		
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

	    
	    $listData = $modelMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    

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
	     if(@$_GET['statuss']==1){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

	    }elseif(@$_GET['status']==2){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

	    }elseif(@$_GET['statuss']==3){

	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
	    }elseif(@$_GET['statuss']==4){

	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Cộng tiền thành công</p>';
	    }elseif(@$_GET['statuss']==5){

	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Trừ tiền thành công</p>';
	    }

	    setVariable('page', $page);
	    setVariable('totalDatatoday', $totalDatatoday);
	    setVariable('totalPage', $totalPage);
	    setVariable('totalData', $totalData);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('mess', $mess);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}
 ?>