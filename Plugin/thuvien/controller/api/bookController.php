<?php 
function searchBookAPI(){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$return= array();
	$modelBook = $controller->loadModel('Books');

	$dataSend = $_REQUEST;
	
    $conditions = [];

	if(!empty($dataSend['term'])){
        $conditions['OR'] = ['name LIKE' => '%'.$dataSend['term'].'%', 'book_code LIKE' => '%'.$dataSend['term'].'%'];
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    

    if(!empty($dataSend['id_category'])){
        $conditions['id_category'] = (int) $dataSend['id_category'];
    }

    $listData= $modelBook->find()->where($conditions)->all()->toList();
    
   

    if($listData){
        foreach($listData as $data){
        	
            $return[]= array(   'label'=>$data->name.' ('.$data->book_code.')',
                                'id'=>$data->id,
                                'value'=>$data->id,
                                'name'=>$data->name,
                                'author'=>$data->author,
                                'slug'=>$data->slug,
                                'quantity'=>$data->quantity,
                                'description'=>$data->description,
                                'price'=>$data->price,
                                'published_date'=>$data->published_date,
                                'publisher_id'=>$data->publisher_id,
                                'status'=>$data->status,
                                'image'=>$data->image,
                                'id_category'=>$data->id_category,
                                'book_code'=>$data->book_code,
                                
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


