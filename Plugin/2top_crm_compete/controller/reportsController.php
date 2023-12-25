<?php 
function listReportCRM($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Báo cáo thi đua';

	$modelReport = $controller->loadModel('Reports');
    $modelTarget = $controller->loadModel('Targets');
    $modelCustomer = $controller->loadModel('Customers');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id_compete'])){
        $conditions['id_compete'] = $_GET['id_compete'];
    }

    if(!empty($_GET['id_target'])){
        $conditions['id_target'] = $_GET['id_target'];
    }

    if(!empty($_GET['id_customer'])){
        $conditions['id_customer'] = $_GET['id_customer'];
    }

    $listData = $modelReport->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        $listTarget = array();
        $listCustomer = array();
        foreach ($listData as $key => $value) {
            if(empty($listTarget[$value->id_target])){
                $listTarget[$value->id_target] = $modelTarget->get($value->id_target);
            }

            if(empty($listCustomer[$value->id_customer])){
                $listCustomer[$value->id_customer] = $modelCustomer->get($value->id_customer);
            }

            $listData[$key]->name_target = $listTarget[$value->id_target]->title;
            $listData[$key]->name_customer = $listCustomer[$value->id_customer]->full_name;
            $listData[$key]->phone_customer = $listCustomer[$value->id_customer]->phone;
            $listData[$key]->email_customer = $listCustomer[$value->id_customer]->email;
        }
    }

    // phân trang
    $totalData = $modelReport->find()->where($conditions)->all()->toList();
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
}

function addReportCRM($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin báo cáo thi đua';

	$modelReport = $controller->loadModel('Reports');
    $modelTarget = $controller->loadModel('Targets');
    $modelCompete = $controller->loadModel('Competes');
    $modelCustomer = $controller->loadModel('Customers');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelReport->get( (int) $_GET['id']);
    }else{
        $data = $modelReport->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id_customer']) && !empty($dataSend['id_target']) && !empty($dataSend['point'])){
            $info_target = $modelTarget->get((int) $dataSend['id_target']);
            $checkData= true;
            if($info_target->type == 'one' && empty($_GET['id'])){
                $conditionsReport = array('id_customer'=>$dataSend['id_customer'], 'id_target'=>$dataSend['id_target']);
                $checkReport = $modelReport->find()->where($conditionsReport)->first();

                if(!empty($checkReport)){
                    $checkData= false;
                }
            }

            if($checkData){
    	        // tạo dữ liệu save
    	        $data->id_customer = $dataSend['id_customer'];
    	        $data->id_target = $dataSend['id_target'];
                $data->id_compete = $dataSend['id_compete'];
                $data->image = $dataSend['image'];
                $data->note = $dataSend['note'];
                $data->point = (int) $dataSend['point'];

                $time_report = explode(' ', $dataSend['time_report']); 

                $time = explode(':', $time_report[0]);
                $date = explode('/', $time_report[1]);


                if(!empty($time) && !empty($date))
                {
                    $time_report= mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
                }else{
                    $time_report = time();
                }

                
                $data->time_report = $time_report;

    	        $modelReport->save($data);

    	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Người dùng này đã báo cáo mục tiêu này rồi</p>';
            }
	    }else{
	    	$mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
	    }
    }

    $conditions = array();
    $listCompete = $modelCompete->find()->where($conditions)->all()->toList();

    if(!empty($listCompete)){
        foreach ($listCompete as $key => $compete) {
            $conditions = array('id_compete'=>$compete->id);
            $listCompete[$key]->targets = $modelTarget->find()->where($conditions)->all()->toList();
        }
    }

    $conditions = array();
    $listCustomer = $modelCustomer->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    
    setVariable('listCustomer', $listCustomer);
    setVariable('listCompete', $listCompete);

}

function deleteReportCRM($input){
	global $controller;

	$modelReport = $controller->loadModel('Reports');
	
	if(!empty($_GET['id'])){
		$data = $modelReport->get($_GET['id']);
		
		if($data){
         	$modelReport->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_compete-view-admin-report-listReportCRM');
}
?>