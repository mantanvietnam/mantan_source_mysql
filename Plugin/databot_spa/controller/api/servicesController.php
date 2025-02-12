<?php 
function searchServicesApi($input)
{
	global $controller;
	global $session;
	

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelServices = $controller->loadModel('Services');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member, 'id_spa'=>$session->read('id_spa'));
            $conditions['OR'] = [['name LIKE' => '%'.$_GET['key'].'%'], ['code' => $_GET['key']]];
          
            $order = array('name' => 'asc');

            $listData = $modelServices->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->price,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'price'=>$data->price,
                    				'duration'=>$data->duration,
                    				'code'=>$data->code,
                    				'price'=>$data->price,
                    			);
                }
            }
        }
	}

	return $return;
}

function getbyServicesApi($input)
{
	global $controller;
	global $session;
	

	$return = ['code'=>0];

	if(!empty($session->read('infoUser'))){
		$modelServices = $controller->loadModel('Services');

		if(!empty($_GET['id'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member, 'id_spa'=>$session->read('id_spa'));
            $conditions['id'] =$_GET['id'];
          
            $order = array('name' => 'asc');

            $data = $modelServices->find()->where($conditions)->first();
            
            if(!empty($data)){
               $return = array('code'=>1,'data'=>$data);
            }
        }
	}

	return $return;
}
?>