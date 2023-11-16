<?php 
function listProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser')) && $session->read('infoUser')->type == 1){
		if(empty($session->read('isAgencyBoss'))){
			return $controller->redirect('/checkBoos');
		}

	    $metaTitleMantan = 'Sản phẩm nhà cung cấp';

		$modelProducts = $controller->loadModel('Products');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>1);
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

		$listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$totalData = $modelProducts->find()->where($conditions)->all()->toList();

	    
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
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function viewProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser')) && $session->read('infoUser')->type == 1){
	    $modelProducts = $controller->loadModel('Products');

		if(!empty($_GET['id'])){
			$infoProduct = $modelProducts->find()->where(['id'=>(int) $_GET['id']])->first();

			if(!empty($infoProduct)){
				$metaTitleMantan = $infoProduct->name;

				setVariable('infoProduct', $infoProduct);
			}else{
				return $controller->redirect('/listProduct');
			}
		}else{
			return $controller->redirect('/listProduct');
		}
	}else{
		return $controller->redirect('/login');
	}
}