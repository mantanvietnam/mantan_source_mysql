<?php 
function listProductAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
	if(!isset($_GET['status'])) $_GET['status'] = 1;

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
	}

	if(!empty($_GET['category_id'])){
		$conditions['category_id'] = $_GET['category_id'];
	}

	if(!empty($_GET['type'])){
		$conditions['type'] = $_GET['type'];
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}

    $listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMembers->get($value->user_id);
    	}
    }

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

    $conditions = array('type'=>'product_categories');
	$order = array('name'=>'asc');
	$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
}

function lockProductAdmin($input){
	global $controller;

	$modelProducts = $controller->loadModel('Products');
	
	if(!empty($_GET['id'])){
		$data = $modelProducts->get($_GET['id']);
		
		if($data){
			$data->status = 0;
         	$modelProducts->save($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
}

function deleteProductAdmin($input){
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	
	if(!empty($_GET['id'])){
		$data = $modelProduct->get($_GET['id']);
		
		if($data){
         	// xóa mẫu thiết kế
			$modelProduct->delete($data);

			// xóa layer
			$conditions = ['products_id'=>$data->id];
			$modelProductDetail->deleteAll($conditions);

			// xóa yêu thích
			$conditions = ['product_id'=>$data->id];
			$modelProductFavorite->deleteAll($conditions);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
}
?>