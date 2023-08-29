<?php 
function order($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Danh sách đối tác';

    if(!empty($session->read('infoUser'))){
		$user = $session->read('infoUser');

		$modelCombo = $controller->loadModel('Combos');
		$modelProduct = $controller->loadModel('Products');
		$modelService = $controller->loadModel('Services');
		$modelP = $controller->loadModel('Services');
		$modelService = $controller->loadModel('Services');
		$modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');

		$conditionsService = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'1');
		$listService = $modelService->find()->where($conditionsService)->all()->toList();

		$conditionsProduct = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'), 'status'=>'active');
		$listProduct = $modelProduct->find()->where($conditionsProduct)->all()->toList();

		$conditionsCombo = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$listCombo = $modelCombo->find()->where($conditionsCombo)->all()->toList();
		$today= getdate();

		$conditionsStaff['OR'] = [ 
									['id'=>$user->id_member],
									['id_member'=>$user->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

		if($isRequestPost){
			$dataSend = $input['request']->getData();
			debug($dataSend);
			die;
		}

		$conditionsRoom = array( 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        
        $listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
        
        if(!empty($listRoom)){
            foreach($listRoom as $key => $item){
                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa')))->all()->toList();
            }
        }


	    setVariable('listService', $listService);
	    setVariable('listProduct', $listProduct);
	    setVariable('listCombo', $listCombo);
	    setVariable('today', $today);
	    setVariable('listRoom', $listRoom);
	    setVariable('listStaffs', $listStaffs);
	    setVariable('user', $user);

	}else{
		return $controller->redirect('/login');
	}
}

 ?>