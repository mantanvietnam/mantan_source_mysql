<?php 
function order($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách đối tác';

    if(!empty($session->read('infoUser'))){
		$user = $session->read('infoUser');

		$modelCombo = $controller->loadModel('Combos');
		$modelProduct = $controller->loadModel('Products');
		$modelService = $controller->loadModel('Services');

		$conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
		$listService = $modelService->find()->where($conditionsService)->all()->toList();

		$conditionsProduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
		$listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

		$conditionsCombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();


	    setVariable('listService', $listService);
	    setVariable('listProduct', $listProduct);
	    setVariable('listCombo', $listCombo);

	}else{
		return $controller->redirect('/login');
	}
}

 ?>