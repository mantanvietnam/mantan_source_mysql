<?php 
function listdocument($input){
    global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	$info = $session->read('infoUser');
	$modelpersons = $controller->loadModel('persons');
	$modelContent = $controller->loadModel('ContentFacebookAis');
    $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');
	$conditions = array(['id_member'=>$info->id]);
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if(!empty($info->id)){
		$listdatacontent = $modelContent->find()->where(['id_member'=>$info->id])->all()->toList();
	}
	$totalData = $modelContent->find()->where($conditions)->all()->toList();
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
	setvariable('listdatacontent', $listdatacontent);

}
function deletecontent($input){
	global $controller;

	$modelContent = $controller->loadModel('ContentFacebookAis');
    
    if(!empty($_GET['id'])){
        $data = $modelContent->get($_GET['id']);
        
        if($data){
            $modelContent->delete($data);
        }
    }

    return $controller->redirect('/listdocument');
}


?>