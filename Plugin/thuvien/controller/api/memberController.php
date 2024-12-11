<?php 
function searchMemberAPI(){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelMembers = $controller->loadModel('Members');

	$dataSend = $_REQUEST;
	
    $conditions = [];

	if(!empty($dataSend['term'])){
        $conditions['OR'] = ['name LIKE' => '%'.$dataSend['term'].'%', 'phone LIKE' => '%'.$dataSend['term'].'%'];
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    if(!empty($dataSend['phone'])){
    	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        $conditions['phone'] = $dataSend['phone'];
    }

    if(!empty($dataSend['email'])){
        $conditions['email'] = $dataSend['email'];
    }

    if(!empty($dataSend['status'])){
        $conditions['status'] = $dataSend['status'];
    }

    if(!empty($dataSend['id_father'])){
        $conditions['id_father'] = (int) $dataSend['id_father'];
    }

    $listData= $modelMembers->find()->where($conditions)->all()->toList();
    
    $positions = [];

    if($listData){
        foreach($listData as $data){
        	if(empty($positions[$data->id_position])){
        		$positions[$data->id_position] = $modelCategories->find()->where(array('id'=>$data->id_position))->first();
        	}

            $return[]= array(   'id'=>$data->id,
                                'label'=>$data->name.' '.$data->phone,
                                'value'=>$data->id,
                                'name'=>$data->name,
                                'avatar'=>$data->avatar,
                                'phone'=>$data->phone,
                                'id_father'=>$data->id_father,
                                'email'=>$data->email,
                                'status'=>$data->status,
                                'created_at'=>$data->created_at,
                                'address'=>$data->address,
                                'birthday'=>$data->birthday,
                                'id_position'=>$data->id_position,
                                'name_position'=>@$positions[$data->id_position]->name,
                                'discount'=>@$positions[$data->id_position]->description,
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