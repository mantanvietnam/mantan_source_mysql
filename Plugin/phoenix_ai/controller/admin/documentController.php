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

	if(!empty($info->id)){
		$listdatacontent = $modelContent->find()->where(['id_member'=>$info->id])->all()->toList();
	}

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