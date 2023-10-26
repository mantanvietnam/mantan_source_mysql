<?php
	$menus= array();
	$menus[0]['title']= 'Feedback';
    $menus[0]['sub'][0]= array('title'=>'Feedback khách hàng','classIcon'=>'bx bx-list-ul','url'=>'/plugins/admin/feedback-admin-listFeedbackAdmin.php','permission'=>'listFeedbackAdmin',);
    
    addMenuAdminMantan($menus); 

    
	function getListFeedback($limit=10)
	{
		global $controller;

		$modelFeedback = $controller->loadModel('Feedbacks');

		$listData= $modelFeedback->find()->limit($limit)->page(1)->where()->all()->toList();
		
		return $listData;
	}
	
?>