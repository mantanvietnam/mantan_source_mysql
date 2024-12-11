<?php 
function searcBuildingAPI(){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelBuilding = $controller->loadModel('Buildings');

	$dataSend = $_REQUEST;
	
    $conditions = [];

	if(!empty($dataSend['term'])){
        $conditions['name LIKE'] ='%'.$dataSend['term'].'%';
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

   
    $listData= $modelBuilding->find()->where($conditions)->all()->toList();
    
    $positions = [];

    if($listData){
        foreach($listData as $data){
        	if(empty($positions[$data->id_position])){
        		$positions[$data->id_position] = $modelCategories->find()->where(array('id'=>$data->id_position))->first();
        	}

            $return[]= array(   'id'=>$data->id,
                                'label'=>$data->name,
                                'value'=>$data->id,
                                'name'=>$data->name,
                                'description'=>@$data->description,
                            );
        }
    }else{
        $return= array(array(   'id'=>0, 
                                'label'=>'Không tìm thấy dữ liệu', 
                                'value'=>'', 
                            )
                );
    }

	return $return;

}
 ?>