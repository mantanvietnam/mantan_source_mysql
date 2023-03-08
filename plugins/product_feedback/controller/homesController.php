<?php 
function customerFeedback($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Đánh giá chất lượng sản phẩm dịch vụ';

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

    $data = $modelFeedback->newEmptyEntity();

    $data->point_detail = array();

    if(!empty($_GET['phone'])){
    	$dataSend['phone']= str_replace(array(' ','.','-'), '', @$_GET['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		$data->customer = $modelCustomer->find()->where(array('phone'=>$dataSend['phone']))->first();
    }

    if(!empty($_GET['id_product'])){
		$data->product = $modelProduct->get((int) $_GET['id_product']);
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['point']) && !empty($dataSend['phone']) && !empty($dataSend['full_name']) && !empty($dataSend['id_product'])){
        	

			$checkUser = $modelCustomer->find()->where(array('phone'=>$dataSend['phone']))->first();

			// nếu chưa có tài khoản thì tạo tài khoản mới
			if(empty($checkUser)){
				if(empty($dataSend['sex'])) $dataSend['sex']=1;
				if(empty($dataSend['id_city'])) $dataSend['id_city']=1;
				if(empty($dataSend['status'])) $dataSend['status']='active';
				if(empty($dataSend['pass'])) $dataSend['pass']= $dataSend['phone'];
				if(empty($dataSend['id_parent'])) $dataSend['id_parent']= 0;
				if(empty($dataSend['id_level'])) $dataSend['id_level']= 0;
				if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';
				if(empty($dataSend['full_name'])) $dataSend['full_name']='Khách vãng lai';

				
				$birthday_date = 0;
				$birthday_month = 0;
				$birthday_year = 0;

				$birthday = explode('/', trim($dataSend['birthday']));
				if(count($birthday)==3){
					$birthday_date = (int) $birthday[0];
					$birthday_month = (int) $birthday[1];
					$birthday_year = (int) $birthday[2];
				}

				$dataCustomer = array(	'full_name'=>$dataSend['full_name'],
	    								'phone'=>$dataSend['phone'],
	    								'email'=>@$dataSend['email'],
	    								'address'=>@$dataSend['address'],
	    								'sex'=>(int) @$dataSend['sex'],
	    								'id_city'=>(int) @$dataSend['id_city'],
	    								'id_messenger'=>@$dataSend['id_messenger'],
	    								'avatar'=>@$dataSend['avatar'],
	    								'status'=>@$dataSend['status'],
	    								'pass'=>@$dataSend['pass'],
	    								'id_parent'=>(int) @$dataSend['id_parent'],
	    								'id_level'=>(int) @$dataSend['id_level'],
	    								
	    								'birthday_date'=>(int) @$birthday_date,
	    								'birthday_month'=>(int) @$birthday_month,
	    								'birthday_year'=>(int) @$birthday_year,
	    						);
	    		$id_customer = addCustomer($dataCustomer);

	    		$checkUser = $modelCustomer->get($id_customer);
			}

	        // tạo dữ liệu save
	        $data->id_product = (int) $dataSend['id_product'];
	        $data->id_customer = (int) $checkUser->id;
	        $data->note = $dataSend['note'];
	        $data->time_create = time();

	        $modelFeedback->save($data);

	        // update lại dữ liệu
	        $data->customer = $modelCustomer->get((int) $data->id_customer);
    		$data->product = $modelProduct->get((int) $data->id_product);

	        foreach ($dataSend['point'] as $id_criteria => $point) {
	        	$feedbackInfo = $modelFeedbackinfo->newEmptyEntity();

	        	$feedbackInfo->id_criteria = (int) $id_criteria;
	        	$feedbackInfo->point = (int) $point;
	        	$feedbackInfo->id_feedback = (int) $data->id;
	        	$feedbackInfo->id_customer = (int) $checkUser->id;
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
?>