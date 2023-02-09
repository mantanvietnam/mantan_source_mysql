<?php 
function createTemplate($input){
	global $session;
	global $controller;
	global $modelCategories;

	if(empty($session->read('infoUser'))){
		return $controller->redirect('/login');
	}else{
		$conditions = array('type' => 'ezpics');
    	$category_ezpics = $modelCategories->find()->where($conditions)->all()->toList();

    	setVariable('category_ezpics', $category_ezpics);
	}
}
?>