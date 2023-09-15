<?php 
function listIngredientAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelIngredients = $controller->loadModel('Ingredients');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($user)){
			// lấy tk người dùng 
			$conditions = array('status'=>1);
		    if(!empty($dataSend['keyword'])){
		        $conditions['keyword LIKE']= '%'.$dataSend['keyword'].'%';
		    }
		    if(!empty($dataSend['category_id'])){
		        $conditions['category_id']= $dataSend['category_id'];
		    }
		    $limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:20;
			$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		    $order = array('id'=>'desc');
			$data = $modelIngredients->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
			$totalData = count($modelIngredients->find()->where($conditions)->all()->toList());
			if(!empty($data)){
				$return = array('code'=>1,
								'data'=> $data,
								'totalData'=> $totalData,
				 				'mess'=>'Bạn lấy data thành công',
				 			);
			}else{
				$return = array('code'=>3,
				 				'mess'=>'không có data',
				 			);
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}

function getIngredientAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelIngredients = $controller->loadModel('Ingredients');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($user)){
			// lấy tk người dùng 
			$conditions = array();
		   
		    $order = array('id'=>'desc');
			$data = $modelIngredients->find()->where(array('status'=>1,'id'=>$dataSend['id']))->first();
			if(!empty($data)){
				$return = array('code'=>1,
								'data'=> $data,
				 				'mess'=>'Bạn lấy data thành công',
				 			);
			}else{
				$return = array('code'=>3,
				 				'mess'=>'không có data',
				 			);
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}

function categoryIngredientAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;


	$conditions = array('type' => 'ingredient_categories');
	$modelIngredients = $controller->loadModel('Ingredients');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    if(!empty($listData)){
    	foreach($listData as $key => $item){
    		$listData[$key]->listIngredient = $modelIngredients->find()->limit(3)->page(1)->where(array('status'=>1,'category_id'=>$item->id))->all()->toList();
    	}
    }
	return array('code'=>1,
				'data'=> $listData,
				'mess'=>'Bạn lấy data thành công',
			);
}
 ?>