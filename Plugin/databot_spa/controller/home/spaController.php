<?php 
function listSpa($input){
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

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		

		$conditions['id_member']= $infoUser->id;

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}
		$listData = $modelSpas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
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


	    $listOrders = $modelSpas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		
		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    setVariable('infoUser', $infoUser);
	    
	    setVariable('listData', $listData);

	}else{
		return $controller->redirect('/login');
	}
} 

function addSpa($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

	$modelSpas = $controller->loadModel('Spas');
	$infoUser = $session->read('infoUser');

	$conditions = array();
	$conditions['id_member']= $infoUser->id;

	$totalData = $modelSpas->find()->where($conditions)->all()->toList();
	$totalData = count($totalData);

	if(!empty($infoUser)){


		 // lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelSpas->get( (int) $_GET['id']);

	    }else{
	    	if ($infoUser->number_spa > $totalData){ 
		        $data = $modelSpas->newEmptyEntity();
		        $data->created = getdate()[0];
	    	}else{
	    		return $controller->redirect('/listSpa');
	    	}

	    }





	}else{
		return $controller->redirect('/login');
	}

}

 ?>