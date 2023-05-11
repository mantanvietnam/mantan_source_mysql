<?php 
function listSellTopDesignerAdmin($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $input['request']->getData();
	$listDesign = [];

	
		// bán được nhiều mẫu hoặc doanh thu cao trong tuần
		$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")));
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array();

		$listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$listDesignStatic = [];

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				if(empty($listDesignStatic[$value->member_id])){
					$listDesignStatic[$value->member_id] = 0;
				}

				
					$listDesignStatic[$value->member_id] ++;
				
			}

			arsort($listDesignStatic);

			foreach ($listDesignStatic as $key => $value) {
				$member = $modelMember->find()->where(['id'=>(int) $key])->first();
				$member->sold = $value;
				unset($member->password);
				unset($member->token);

				$listDesign[] = $member;
			}
		}

	/*setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);*/
    
    setVariable('listData', $listDesign);
    //ssetVariable('listCategory', $listCategory);
}
 ?>