<?php 
function listFeedback($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách đánh giá';

	$modelCustomer = $controller->loadModel('Customers');
	$modelProduct = $controller->loadModel('Products');
	$modelFeedback = $controller->loadModel('Feedbacks');
	$modelFeedbackinfo = $controller->loadModel('Feedbackinfos');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

    $listData = $modelFeedback->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $conditions_criteria = array('type' => 'criteria_feedback');
	$list_criteria = $modelCategories->find()->where($conditions_criteria)->all()->toList();

	// danh sách tiêu chí đánh giá
	$criteria = array();
	if(!empty($list_criteria)){
		foreach ($list_criteria as $key => $value) {
			$criteria[$value->id] = $value->name;
		}
	}

	// thông tin chi tiết đánh giá
    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->customer = $modelCustomer->get((int) $value->id_customer);
    		$listData[$key]->product = $modelProduct->get((int) $value->id_product);
    		
    		$conditions_detail = array(	'id_feedback'=>$value->id,
    									'id_customer'=>$value->id_customer,
    									'id_product'=>$value->id_product,
    								);
    		$listData[$key]->point_detail = $modelFeedbackinfo->find()->where($conditions_detail)->all()->toList();

    	}
    }

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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('criteria', $criteria);
}

function addFeedback($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Thông tin đánh giá';

    $modelCustomer = $controller->loadModel('Customers');
	$modelFeedback = $controller->loadModel('Feedbacks');
	$modelFeedbackinfo = $controller->loadModel('Feedbackinfos');
	$modelProduct = $controller->loadModel('Products');
	
	$mess= '';

	$conditions_criteria = array('type' => 'criteria_feedback');
	$list_criteria = $modelCategories->find()->where($conditions_criteria)->all()->toList();

	// danh sách tiêu chí đánh giá
	$criteria = array();
	if(!empty($list_criteria)){
		foreach ($list_criteria as $key => $value) {
			$criteria[$value->id] = $value->name;
		}
	}

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelFeedback->get( (int) $_GET['id']);

        if(!empty($data)){
        	$conditions_detail = array('id_feedback'=>$data->id);
    		$point_details = $modelFeedbackinfo->find()->where($conditions_detail)->all()->toList();
    		$point_detail = array();
    		if(!empty($point_details)){
    			foreach ($point_details as $value) {
    				$point_detail[$value->id_criteria] = $value->point;
    			}
    		}
    		$data->point_detail = $point_detail;

    		$data->customer = $modelCustomer->get((int) $data->id_customer);
    		$data->product = $modelProduct->get((int) $data->id_product);
        }
    }else{
        $data = $modelFeedback->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['point']) && !empty($dataSend['id_customer']) && !empty($dataSend['id_product'])){

	        // tạo dữ liệu save
	        $data->id_product = (int) $dataSend['id_product'];
	        $data->id_customer = (int) $dataSend['id_customer'];
	        $data->note = $dataSend['note'];
	        $data->time_create = time();

	        $modelFeedback->save($data);

	        // update lại dữ liệu
	        $data->customer = $modelCustomer->get((int) $data->id_customer);
    		$data->product = $modelProduct->get((int) $data->id_product);

	        foreach ($dataSend['point'] as $id_criteria => $point) {
	        	$conditions = array('id_feedback'=>$data->id, 
	        						'id_criteria'=> (int) $id_criteria, 
	        						'id_customer'=> (int) $dataSend['id_customer'], 
	        						'id_product'=>(int) $dataSend['id_product']
	        					);
	        	$feedbackInfo = $modelFeedbackinfo->find()->where($conditions)->first();

	        	if(empty($feedbackInfo)){
	        		$feedbackInfo = $modelFeedbackinfo->newEmptyEntity();
	        	}

	        	$feedbackInfo->id_criteria = (int) $id_criteria;
	        	$feedbackInfo->point = (int) $point;
	        	$feedbackInfo->id_feedback = (int) $data->id;
	        	$feedbackInfo->id_customer = (int) $dataSend['id_customer'];
	        	$feedbackInfo->id_product = (int) $dataSend['id_product'];

	        	$modelFeedbackinfo->save($feedbackInfo);

	        	// update lại dữ liệu
	        	$data->point_detail[$id_criteria] = (int) $point;
	        }

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
	    }
    }
    
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('criteria', $criteria);
}

function deleteFeedback($input){
	global $controller;

	$modelFeedback = $controller->loadModel('Feedbacks');
	$modelFeedbackinfo = $controller->loadModel('Feedbackinfos');
	
	if(!empty($_GET['id'])){
		$data = $modelFeedback->get($_GET['id']);
		
		if($data){
         	$modelFeedback->delete($data);

         	$conditions = array('id_feedback'=>$data->id);
         	$modelFeedbackinfo->deleteAll($conditions);
        }
	}

	return $controller->redirect('/plugins/admin/product_feedback-view-admin-feedback-listFeedback');
}
?>