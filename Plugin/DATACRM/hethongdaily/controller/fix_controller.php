<?php
function fixBug()
{
	global $modelCategoryConnects;
	global $controller ;

	//$modelCampaigns = $controller->loadModel('Campaigns');
    //$modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');
    /*
    // fix lỗi thời gian đăng ký chiến dịch
    $all = $modelCampaignCustomers->find()->where(['create_at'=>0])->all()->toList();

    foreach ($all as $key => $value) {
    	$history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id_customer])->order(['id'=>'desc'])->first();

    	if(!empty($history->time_now)){
    		$value->create_at = $history->time_now;

    		$modelCampaignCustomers->save($value);
    	}
    	
    }

	// fix lỗi id nhóm khách hàng
	$all = $modelCustomers->find()->where()->all()->toList();

	foreach ($all as $key => $value) {
		if(!empty($value->id_group)){
			$categoryConnects = $modelCategoryConnects->newEmptyEntity();

	        $categoryConnects->keyword = 'group_customers';
	        $categoryConnects->id_parent = $value->id;
	        $categoryConnects->id_category = (int) $value->id_group;

	        $modelCategoryConnects->save($categoryConnects);
	    }
	}
	*/
	// fix lỗi 1 khách hàng thuộc nhiều đại lý
	$all = $modelCustomers->find()->where()->all()->toList();

	foreach ($all as $key => $value) {
		if(!empty($value->id_parent)){
			$categoryConnects = $modelCategoryConnects->newEmptyEntity();

	        $categoryConnects->keyword = 'member_customers';
	        $categoryConnects->id_parent = $value->id;
	        $categoryConnects->id_category = (int) $value->id_parent;

	        $modelCategoryConnects->save($categoryConnects);
	    }
	}
	
	// fix lỗi đội nhóm

}
?>