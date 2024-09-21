<?php 
function listfastingAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách các kiểu giảm cân';
    $modelfasting = $controller->loadModel('fasting');
    if($isRequestPost){
		$dataSend = $input['request']->getData();

	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    if (!empty($dataSend['name'])) {
            $name = $dataSend['name'];
            $conditions['name LIKE'] = '%'. $name.'%';
        }
	    $listData = $modelfasting->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    // phân trang

	    $totalData = $modelfasting->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);
		
		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
	        
	}else{
	    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}
    return $return;

	
}

?>