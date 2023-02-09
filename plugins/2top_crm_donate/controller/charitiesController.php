<?php 
function listCharityCRM($input)
{
	global $controller;

	$modelCharity = $controller->loadModel('Charities');

	$conditions = array();
    $listData = $modelCharity->find()->where($conditions)->all()->toList();

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
	        $data->description = $dataSend['description'];
	        $data->money_donate = (int) $dataSend['money_donate'];
	        $data->address = $dataSend['address'];
	        $data->id_city = $dataSend['id_city'];
	        $data->person_donate = (int) $dataSend['person_donate'];
	        $data->status = $dataSend['status'];

	        $time_event_start = explode('/', $dataSend['time_event_start']);   
            if(!empty($time_event_start))
            {
	            $time_event_start= mktime(0, 0, 0, $time_event_start[1], $time_event_start[0], $time_event_start[2]);
            }

            $time_event_end = explode('/', $dataSend['time_event_end']);   
            if(!empty($time_event_end))
            {
	            $time_event_end= mktime(23, 59, 59, $time_event_end[1], $time_event_end[0], $time_event_end[2]);
            }


	        $data->time_event_start = $time_event_start;
	        $data->time_event_end = $time_event_end;

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