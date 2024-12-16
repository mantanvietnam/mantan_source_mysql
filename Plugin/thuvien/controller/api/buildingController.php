<?php 
function searcBuildingAPI(){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelBuilding = $controller->loadModel('Buildings');
    $user = checklogin();   
    if(!empty($user)){

        $dataSend = $_REQUEST;
        	
        $conditions = [];
        if(!empty($dataSend['term'])){
            $conditions['name LIKE'] ='%'.$dataSend['term'].'%';
        }

           
        if($user->type=='staff'){
            if($user->id_building){
                $conditions['id IN'] =  json_decode($user->id_building, true);
            }else{
                $conditions['id'] =  0;
            }            
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
        }else{
            return array(array(   'id'=>0, 
                                        'label'=>'Không tìm thấy dữ liệu', 
                                        'value'=>'', 
                                    )
                        );
        }
    

}
 ?>