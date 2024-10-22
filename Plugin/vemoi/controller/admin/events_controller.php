<?php 
function listEventAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách sự kiện';
    $mess = '';

	$modelEvents = $controller->loadModel('Events');
	
	$conditions = array();
	$limit = 20;


	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['status'])){
		$conditions['status'] = $_GET['status'];
	}

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

    $listData = $modelEvents->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $totalData = $modelEvents->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
}

function deleteEventAdmin($input){
    global $controller;

    $modelEvents = $controller->loadModel('Events');
    
    if(!empty($_GET['id'])){
        $data = $modelEvents->find()->where(['id'=>(int) $_GET['id']])->first();
        
        if($data){
            $modelEvents->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/vemoi-view-admin-event-listEventAdmin');
}

function searchImageAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;

    if($isRequestPost){
        $listImage = searchFaceImage('tests-20242110');

        debug($listImage);die;
    }
}
?>