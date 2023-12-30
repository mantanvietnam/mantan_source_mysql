<?php 
function listStyleTextAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelStyleTexts = $controller->loadModel('StyleTexts');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		
		// lấy tk người dùng 
		$conditions = array('status'=>'active');
	    if(!empty($dataSend['keyword'])){
	        $conditions['keyword LIKE']= '%'.$dataSend['keyword'].'%';
	    }
	    if(!empty($dataSend['category_id'])){
	        $conditions['category_id']= $dataSend['category_id'];
	    }
	    $limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:20;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $order = array('id'=>'desc');
		$data = $modelStyleTexts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


		$totalData = count($modelStyleTexts->find()->where($conditions)->all()->toList());
		if(!empty($data)){
			foreach($data as $key => $item){
				$data[$key]->content = json_decode($item->content, true);
			}
			$return = array('code'=>1,
							'data'=> $data,
							'totalData'=> $totalData,
			 				'mess'=>'Bạn lấy data thành công'
			 			);
		}else{
			$return = array('code'=>3,
			 				'mess'=>'không có data',
			 			);
		}
	}

	return $return;
}

function getStyleTextAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelStyleTexts = $controller->loadModel('StyleTexts');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id'])){
			$data = $modelStyleTexts->find()->where(array('status'=>'active','id'=>$dataSend['id']))->first();
			
			if(!empty($data)){
				$data->content = json_decode($data->content, true);
				
				$return = array('code'=>1,
								'data'=> $data,
				 				'mess'=>'Bạn lấy dữ liệu thành công',
				 			);
			}else{
				$return = array('code'=>3,
				 				'mess'=>'không có dữ liệu',
				 			);
			}
		}else{
			$return = array('code'=>0,
							'mess'=>'Gửi thiếu dữ liệu'
							);
		}
	}

	return $return;
}
 ?>