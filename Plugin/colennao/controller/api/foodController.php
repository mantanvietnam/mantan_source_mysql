<?php 
function listfoodAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách food';

    $modelfood = $controller->loadModel('food');
    if($isRequestPost){
		    $dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modelfood->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modelfood->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiểu dữ liệu');
    }

    return $return;
}

function listbreakfastAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách breakfast';

    $modelbreakfast = $controller->loadModel('breakfast');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
        $conditions = array();
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
        if (!empty($dataSend['name'])) {
            $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
        }
        $listData = $modelbreakfast->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        $totalData = $modelbreakfast->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);
        
        $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiêu dữ liệu');
    }
    return $return;
}
function getbreakfastAPI($input)
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
        if(!empty($dataSend['id'])){
            	$modelbreakfast = $controller->loadModel('breakfast');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modelbreakfast->find()->where($conditions)->first();
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listlunchAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách lunch';

    $modellunch = $controller->loadModel('lunch');
    if($isRequestPost){
		    $dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modellunch->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modellunch->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
            
            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai dữ liệu kiểu');
    }
    return $return;
}
function getlunchAPI($input)
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
        if(!empty($dataSend['id'])){
            	$modellunch = $controller->loadModel('lunch');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modellunch->find()->where($conditions)->first();
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listdinnerAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách dinner';

    $modeldinner = $controller->loadModel('dinner');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modeldinner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modeldinner->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
            
            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai dữ liệu kiểu');
    }
    return $return;
}
function getdinnerAPI($input)
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
        if(!empty($dataSend['id'])){
            	$modeldinner = $controller->loadModel('dinner');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modeldinner->find()->where($conditions)->first();
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listsnacksAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách snacks';

    $modelsnacks = $controller->loadModel('snacks');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
        $conditions = array();
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
        if (!empty($dataSend['name'])) {
            $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
        }
        $listData = $modelsnacks->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        $totalData = $modelsnacks->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);
        
        $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
                
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai dữ liệu kiểu');
    }
    return $return;
}
function getsnacksAPI($input)
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
        if(!empty($dataSend['id'])){
            	$modelsnacks = $controller->loadModel('snacks');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modelsnacks->find()->where($conditions)->first();
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
?>