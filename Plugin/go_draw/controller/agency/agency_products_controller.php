<?php 
function warehouse($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Kho hàng';

	    $modelAgencyProducts = $controller->loadModel('AgencyProducts');
	    $modelProducts = $controller->loadModel('Products');

	    $listData = $modelAgencyProducts->find()->where(['agency_id'=>$session->read('infoUser')->id, 'amount >'=>0])->all()->toList();

	    $listProduct = [];

	    if(!empty($listData)){
	    	foreach ($listData as $key => $value) {
	    		$listProduct[$value->product_id] = $modelProducts->find()->where(['id'=>$value->product_id])->first();
	    	}
	    }

	    setVariable('listData', $listData);
	    setVariable('listProduct', $listProduct);
	}else{
		return $controller->redirect('/login');
	}
}

