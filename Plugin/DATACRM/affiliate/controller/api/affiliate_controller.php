<?php 
function searchAffiliateAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return= array();
    $modelAffiliaters = $controller->loadModel('Affiliaters');

    $dataSend = $_REQUEST;
        
    $conditions = [];

    if(!empty($dataSend['term'])){
        $conditions['name LIKE'] = '%'.$dataSend['term'].'%';
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    if(!empty($dataSend['phone'])){
        $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        $conditions['phone LIKE'] = '%'.$dataSend['phone'].'%';
    }

    if(!empty($dataSend['email'])){
        $conditions['email'] = $dataSend['email'];
    }

    if(!empty($dataSend['id_father'])){
        $conditions['id_father'] = (int) $dataSend['id_father'];
    }

    $listData= $modelAffiliaters->find()->where($conditions)->all()->toList();
    
    if($listData){
        foreach($listData as $data){
            $return[]= array(   'id'=>$data->id,
                                'label'=>$data->name.' '.$data->phone,
                                'value'=>$data->id,
                                'name'=>$data->name,
                                'avatar'=>$data->avatar,
                                'phone'=>$data->phone,
                                'id_father'=>$data->id_father,
                                'email'=>$data->email,
                                'created_at'=>$data->created_at,
                                'address'=>$data->address,
                            );
        }
    }else{
        $return= array(array(   'id'=>0, 
                                'label'=>'Không tìm được CTV, hãy tạo thông tin cho CTV mới', 
                                'value'=>'', 
                            )
                );
    }

    return $return;
}