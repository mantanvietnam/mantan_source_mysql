<?php 
function listCompeteCRM($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Chiến dịch thi đua';

	$modelCompete = $controller->loadModel('Competes');
    $modelTarget = $controller->loadModel('Targets');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;

    $listData = $modelCompete->find()->limit($limit)->page($page)->where($conditions)->all()->toList();

    if(!empty($listData)){
        $listTarget = array();
        foreach ($listData as $key => $value) {
            $conditionsTarget = array('id_compete'=>(int) $value->id);
            $target = $modelTarget->find()->where($conditionsTarget)->all()->toList();
            $listData[$key]->target = count($target);
        }
    }

    // phân trang
    $totalData = $modelCompete->find()->where($conditions)->all()->toList();
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

function addCompeteCRM($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin chiến dịch thi đua';

	$modelCompete = $controller->loadModel('Competes');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCompete->get( (int) $_GET['id']);
    }else{
        $data = $modelCompete->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
	        $data->description = $dataSend['description'];
            $data->image = $dataSend['image'];
            $data->status = $dataSend['status'];

            $time_event_start = explode('/', $dataSend['date_start']);   
            if(!empty($time_event_start))
            {
                $time_event_start= mktime(0, 0, 0, $time_event_start[1], $time_event_start[0], $time_event_start[2]);
            }

            $time_event_end = explode('/', $dataSend['date_end']);   
            if(!empty($time_event_end))
            {
                $time_event_end= mktime(23, 59, 59, $time_event_end[1], $time_event_end[0], $time_event_end[2]);
            }

            $data->date_start = $time_event_start;
            $data->date_end = $time_event_end;

	        // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            $number = 0;
            do{
            	$conditions = array('slug'=>$slugNew);
    			$listData = $modelCompete->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

    			if(!empty($listData)){
    				$number++;
    				$slugNew = $slug.'-'.$number;
    			}
            }while (!empty($listData));

            $data->slug = $slugNew;

	        $modelCompete->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên chiến dịch thi đua</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteCompeteCRM($input){
	global $controller;

	$modelCompete = $controller->loadModel('Competes');
	
	if(!empty($_GET['id'])){
		$data = $modelCompete->get($_GET['id']);
		
		if($data){
         	$modelCompete->delete($data);

         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_compete-view-admin-campain-listCompeteCRM.php');
}
?>