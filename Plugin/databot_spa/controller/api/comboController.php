<?php 
function searchComboApi($input)
{
	global $controller;
	global $session;
	

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelCombo = $controller->loadModel('Combos');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member, 'id_spa'=>$session->read('id_spa'));
            $conditions['name LIKE'] =  '%'.$_GET['key'].'%';
          
            $order = array('name' => 'asc');

            $listData = $modelCombo->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->price,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'price'=>$data->price,
                    			);
                }
            }
        }
	}

	return $return;
}
?>