<?php
	$menus= array();
	$menus[0]['title']= 'Feedback';
    $menus[0]['sub'][0]= array('title'=>'Feedback Học Viên','classIcon'=>'bx bx-list-ul','url'=>'/plugins/admin/feedback-view-admin-listFeedbackAdmin','permission'=>'listFeedbackAdmin',);
  
    addMenuAdminMantan($menus); 

    
	
	function getListFeedback($limit=10)
	{
		global $controller;

		$modelFeedback = $controller->loadModel('Feedbacks');

		$listData= $modelFeedback->find()->limit($limit)->page(1)->where()->all()->toList();
		
		return $listData;
	}
?>