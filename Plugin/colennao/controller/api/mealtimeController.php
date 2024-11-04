<?php 
function listmealtimeAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách chế độ ăn';

    $modelmealtime = $controller->loadModel('mealtime');
    $modelcategorydiet = $controller->loadModel('categorydiet');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        if ($page < 1) $page = 1;
        
        $order = array('id' => 'desc');
        $listData = $modelmealtime->find()->limit($limit)->page($page)->order($order)->all()->toList();

        foreach ($listData as $mealtime) {
            $category = $modelcategorydiet->find()
                                          ->where(['id' => $mealtime->id_level])
                                          ->first();
            $mealtime->category_name = $category ? $category->name : 'Không có tên';
        }

        $return = array('code' => 1, 'mess' => 'Lấy dữ liệu thành công', 'listData' => $listData);
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
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
            $modelcategorydiet = $controller->loadModel('categorydiet');
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
function listcategorydietAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $listfasting;
    $metaTitleMantan = 'Danh sách chế độ ăn';


    $modelcategorydiet = $controller->loadModel('categorydiet');
    if($isRequestPost){
        $dataSend = $input['request']->getData();

	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
        $listData = $modelcategorydiet->find()->limit($limit)->page($page)->where()->order($order)->all()->toList();
		
		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData);
	        
	}else{
	    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}

    return $return;

}
function getcategorydietAPI($input)
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
            $modelcategorydiet = $controller->loadModel('categorydiet');
            $conditions = array('id' => (int)$dataSend['id']);	
            $data = $modelcategorydiet->find()->where($conditions)->first();
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