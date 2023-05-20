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
		if(empty($_GET['date_start']) && empty($_GET['date_end']) ){
			$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")));
		}else{
			if(!empty($_GET['date_start'])){
					$date_start = explode('/', $_GET['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
			}if(!empty($_GET['date_end'])){
					$date_end = explode('/', $_GET['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
			}
		}
		
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

function listIncomeTopDesignerAdmin($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $input['request']->getData();
	$listDesign = [];

	
		// bán được nhiều mẫu hoặc doanh thu cao trong tuần
		if(empty($_GET['date_start']) && empty($_GET['date_end']) ){
			$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")));
		}else{
			if(!empty($_GET['date_start'])){
					$date_start = explode('/', $_GET['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
			}if(!empty($_GET['date_end'])){
					$date_end = explode('/', $_GET['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
			}
		}
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

				$listDesignStatic[$value->member_id] += $value->total;
				
				
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

function listCreateTopDesignerAdmin($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $input['request']->getData();
	$listDesign = [];

	
		// tạo nhiều mẫu bán trong tuần
		if(empty($_GET['date_start']) && empty($_GET['date_end']) ){
			$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")));
		}else{
			if(!empty($_GET['date_start'])){
					$date_start = explode('/', $_GET['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
			}if(!empty($_GET['date_end'])){
					$date_end = explode('/', $_GET['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
			}
		}
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array();

		$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$listDesignStatic = [];

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				if(empty($listDesignStatic[$value->user_id ])){
					$listDesignStatic[$value->user_id ] = 0;
				}

				$listDesignStatic[$value->user_id] ++;
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

    setVariable('listData', $listDesign);
}
 ?>