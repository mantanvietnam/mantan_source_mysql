<?php 
function listmealtimeAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $listfasting;
    $metaTitleMantan = 'Danh sách chế độ ăn';

    $modelmealtime = $controller->loadModel('mealtime');
    if($isRequestPost){
        foreach ($listfasting as $key => $item){
            $listfasting[$key]['mealtime'] = $modelmealtime->find()->where(['id_level'=>(int)$item['id']])->all()->toList();
        }
		
		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listfasting);
	        
	}else{
	    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}

    return $return;

	
}
function getmealtimeAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['id'])) {
			$modelmealtime = $controller->loadModel('mealtime');
            $conditions = array('id' => (int)$dataSend['id']);	
            $data = $modelmealtime->find()->where($conditions)->first();
            if (!empty($data)) { 

                $return = array('code' => 1, 'mess' => 'Lấy dữ liệu thành công', 'data' => $data,);
            } else {
                $return = array('code' => 3, 'mess' => 'Id không tồn tại');
            }
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu');
        }
        
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}


?>