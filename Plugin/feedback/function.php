<?php
	$menus= array();
	$menus[0]['title']= 'Feedback';
    $menus[0]['sub'][0]= array('title'=>'Feedback khách hàng','classIcon'=>'fa-link','url'=>'/plugins/admin/feedback-admin-listFeedbackAdmin.php','permission'=>'listFeedbackAdmin',);
    
    addMenuAdminMantan($menus); 




    
	function showFeedback()
	{
		global $modelOption;
		global $controller;
		$modelFeedback = $controller->loadModel('Feedbacks');
		$dem= 0;
		$demRow= 0;
		$class= '';

		$listData= $modelFeedback->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();
		
		return $listData;
	}
	

?>