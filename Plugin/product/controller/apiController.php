<?php 
function searchProductAPI($input)
{
	global $isRequestPost;
	global $controller;

	$return= array();
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $_REQUEST;

	if(!empty($dataSend['term'])){
		/*
		$conditions['OR'] = [
        						['phone'=>$dataSend['term']], 
        						['full_name LIKE'=>'%'.$dataSend['term'].'%']
        					];
		*/
        $conditions = ['title LIKE'=>'%'.$dataSend['term'].'%'];

        $listData= $modelProduct->find()->where($conditions)->all()->toList();
        
        if($listData){
            foreach($listData as $data){
                $return[]= array('id'=>$data->id,'label'=>$data->title,'value'=>$data->id,'title'=>$data->title);
            }
        }else{
        	$return= array(array('id'=>0, 'label'=>'Không tìm được sản phẩm', 'value'=>'', 'title'=>''));
        }
    }
	

	return $return;
}

function searchEvaluateAPI($input)
{
	global $isRequestPost;
	global $controller;

	$return= array();
	$modelEvaluate = $controller->loadModel('Evaluates');

	$dataSend = $_REQUEST;

	if(!empty($dataSend['id_product'])){
		
        $conditions = ['id_product'=>$dataSend['id_product']];
        if(!empty($dataSend['point'])){
        	$conditions['point'] = $dataSend['point'];
        }

        $listData= $modelEvaluate->find()->where($conditions)->all()->toList();
        
        if(!empty($listData)){
            $return = array('code'=>1, 'data'=>$listData);
        }else{
        	$return= array('code'=>0, 'label'=>'Không tìm được sản phẩm', 'value'=>'', 'title'=>'');
        }
    }
	

	return $return;
}
?>