<?php 
function searchProductApi($input)
{
	global $controller;
	global $session;
	

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelProducts = $controller->loadModel('Products');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member,'id_spa'=>$session->read('id_spa'));
            $conditions['OR'] = [['name LIKE' => '%'.$_GET['key'].'%'], ['code' => $_GET['key']]];
          
            $order = array('name' => 'asc');

            $listData = $modelProducts->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.number_format($data->price).'đ',
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'price'=>$data->price,
                    				'quantity'=>$data->quantity,
                    				'code'=>$data->code,
                    				'price'=>$data->price,
                    			);
                }
            }
        }
	}

	return $return;
}
?>