<?php 
function listCharityCRM($input)
{
	global $controller;
	global $urlCurrent;

	$modelCharity = $controller->loadModel('Charities');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

    $listData = $modelCharity->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $totalData = $modelCharity->find()->where($conditions)->all()->toList();
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

function addCharityCRM($input)
{
	global $controller;
	global $isRequestPost;

	$modelCharity = $controller->loadModel('Charities');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCharity->get( (int) $_GET['id']);
    }else{
        $data = $modelCharity->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
	        $data->description = @$dataSend['description'];
	        $data->money_donate = (int) @$dataSend['money_donate'];
	        $data->address = @$dataSend['address'];
	        $data->id_city = (int) @$dataSend['id_city'];
	        $data->person_donate = (int) @$dataSend['person_donate'];
	        $data->status = !empty($dataSend['status'])?$dataSend['status']:'active';

	        $time_event_start = explode('/', $dataSend['time_event_start']);   
            if(count($time_event_start)==3)
            {
	            $time_event_start= mktime(0, 0, 0, $time_event_start[1], $time_event_start[0], $time_event_start[2]);
            }else{
            	$time_event_start= time();
            }

            $time_event_end = explode('/', $dataSend['time_event_end']);   
            if(count($time_event_end)==3)
            {
	            $time_event_end= mktime(23, 59, 59, $time_event_end[1], $time_event_end[0], $time_event_end[2]);
            }else{
            	$time_event_end = time()+7*24*60*60;
            }


	        $data->time_event_start = $time_event_start;
	        $data->time_event_end = $time_event_end;

            // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelCharity->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));
            }

            $data->slug = $slugNew;
            

	        $modelCharity->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên chương trình</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteCharityCRM($input){
	global $controller;

	$modelCharity = $controller->loadModel('Charities');
	
	if(!empty($_GET['id'])){
		$data = $modelCharity->get($_GET['id']);
		
		if($data){
         	$modelCharity->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_donate-view-admin-charity-listCharityCRM.php');
}
?>