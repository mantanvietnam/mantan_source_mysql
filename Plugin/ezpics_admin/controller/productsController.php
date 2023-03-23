<?php 
function listProductAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

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

	if(isset($_GET['status']) && $_GET['status']!=''){
		$conditions['status'] = $_GET['status'];
	}

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function lockProductAdmin($input){
	global $controller;

	$modelMembers = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelMembers->get($_GET['id']);
		
		if($data){
			$data->status = 0;
			$data->token = '';
         	$modelMembers->save($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php');
}

function deleteProductAdmin($input){
	global $controller;

	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');
	
	if(!empty($_GET['id'])){
		$data = $modelTests->get($_GET['id']);
		
		if($data){
         	$modelTests->delete($data);

         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_training-view-admin-test-listTestCRM.php');
}
?>