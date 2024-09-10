<?php 
function listChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();
	    $conditions = array('status'=>'active');
	    $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
	    $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
	    if ($page < 1) $page = 1;
	    if (!empty($dataSend['id']) && is_numeric($dataSend['id'])) {
	        $conditions['id'] = $dataSend['id'];
	    }

	    if (!empty($dataSend['title'])) {
	        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
	    }

	    
	    $listData = $modelChallenge->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
	    
	    
	    $totalData = count($modelChallenge->find()->where($conditions)->all()->toList());
	        
	    return apiResponse(0, 'lấy láy dữ liệu thành công', $listData, $totalData);
	}
}

function getChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');

    $modelTipChallenges = $controller->loadModel('TipChallenges');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	if(!empty($dataSend['id'])){
    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
    		
	    	$data = $modelChallenge->find()->where($conditions)->first();

	    	if(!empty($data->id)){
            $data->Feedback = $modelFeedbackChallenge->find()->where(['id_challenge'=>$data->id])->all()->toList();
            $data->Result = $modelResultChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
            $data->Tip = $modelTipChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
        	}
	   
	        
	    	return apiResponse(0, 'lấy láy dữ liệu thành công', $data);
		}else{
			return apiResponse(2, 'Gửi thiếu dữ liệu');
		}
    }else{
    	return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
    }
	    
}

 ?>