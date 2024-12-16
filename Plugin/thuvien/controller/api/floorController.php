<?php 
function searcFloorAPI(){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelFloor = $controller->loadModel('Floors');
    $user = checklogin();   
    if(!empty($user)){

	$dataSend = $_REQUEST;
    	
        $conditions = [];

    	if(!empty($dataSend['term'])){
            $conditions['name LIKE'] ='%'.$dataSend['term'].'%';
        }

        if(!empty($dataSend['id'])){
            $conditions['id'] = (int) $dataSend['id'];
        }

        if(!empty($dataSend['id_building'])){
            $conditions['id_building'] = (int) $dataSend['id_building'];
        }

        if($user->type=='staff'){
            if($user->id_building){
                $conditions['id_building IN'] =  json_decode($user->id_building, true);
            }else{
                $conditions['id_building'] =  0;
            }
            
        }

       
        $listData= $modelFloor->find()->where($conditions)->all()->toList();
        
       

        if($listData){
            foreach($listData as $data){
            	
                $return[]= array(   'id'=>$data->id,
                                    'label'=>$data->name,
                                    'value'=>$data->id,
                                    'id_building'=>$data->id_building,
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
    }else{
        return array(array(   'id'=>0, 
                                    'label'=>'Không tìm thấy dữ liệu', 
                                    'value'=>'', 
                                )
                    );
    }

}
 ?>