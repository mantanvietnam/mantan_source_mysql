<?php 
function searcShelfAPI(){
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return= array();
    $modelShelf = $controller->loadModel('Shelfs');
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

        if(!empty($dataSend['id_floor'])){
            $conditions['id_floor'] = (int) $dataSend['id_floor'];
        }

        if(!empty($dataSend['id_room'])){
            $conditions['id_room'] = (int) $dataSend['id_room'];
        }

        if($user->type=='staff'){
            if($user->id_building){
                $conditions['id_building IN'] =  json_decode($user->id_building, true);
            }else{
                $conditions['id'] =  0;
            }
            
        }
       
        $listData= $modelShelf->find()->where($conditions)->all()->toList();
        
        

        if($listData){
            foreach($listData as $data){
                
                $return[]= array(   'id'=>$data->id,
                                    'label'=>$data->name,
                                    'value'=>$data->id,
                                    'id_building'=>$data->id_building,
                                    'id_floor'=>$data->id_floor,
                                    'id_room'=>$data->id_room,
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
    else{
        return array(array(   'id'=>0, 
            'label'=>'Không tìm thấy dữ liệu', 
            'value'=>'', 
            )
        );
    }

}
 ?>