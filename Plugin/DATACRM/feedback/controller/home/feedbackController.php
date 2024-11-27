<?php 
function listFeedback($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Feedback';
    if(function_exists('checklogin')){
    	$user = checklogin('listFeedback');  
    } 
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }

	    $modelFeedback = $controller->loadModel('Feedbacks');
	    $modelCustomer = $controller->loadModel('Customers');
	    
	    $conditions = array();
	    if(!empty($_GET['name'])){
	        $key=createSlugMantan($_GET['name']);

	        $conditions['urlSlug LIKE']= '%'.$key.'%';
	    }

	    $limit = 20;
	    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    
	    $listData = $modelFeedback->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $listData[$key]->infoCustomer = $modelCustomer->find()->where(['id'=>$value->id])->first();	
	        }
	    }

	    // phân trang
	    $totalData = $modelFeedback->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);

	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }
	    
	    if(@$_GET['status']==1){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Mở khóa dữ liệu thành công</p>';

	    }elseif(@$_GET['status']==2){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">đòng khóa  dữ liệu thành công</p>';

	    }elseif(@$_GET['status']==3){

	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
	    }

	    setVariable('mess', @$mess);
	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    
	    setVariable('listData', $listData);
	}else{
        return $controller->redirect('/login');
    }
}


function lockFeedback($input){
	global $controller;
	if(function_exists('checklogin')){
		$user = checklogin('lockFeedback');
	}  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listFeedback');
        }

	    $modelFeedback = $controller->loadModel('Feedbacks');
	    if(!empty($_GET['id'])){
	        $data = $modelFeedback->get($_GET['id']);
	        
	        if($data){
	        	 $data->status = $_GET['status'];
	            $modelFeedback->save($data);
	        }
	    }
	    if($_GET['status']=='lock'){
	    	return $controller->redirect('/listFeedback?status=2');
	    }else{
	    	return $controller->redirect('/listFeedback?status=1');
	    }
    }else{
        return $controller->redirect('/login');
    }
    
}

function deleteFeedback($input){
    global $controller;
    if(function_exists('checklogin')){
    	$user = checklogin('deleteFeedback');   
    }
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listFeedback');
        }

	    $modelFeedback = $controller->loadModel('Feedbacks');
	    if(!empty($_GET['id'])){
	        $data = $modelFeedback->get($_GET['id']);
	        
	        if($data){
	            $modelFeedback->delete($data);
	        }
	    }

	    return $controller->redirect('/listFeedback?status=3');
    }else{
        return $controller->redirect('/login');
    }
}
 ?>