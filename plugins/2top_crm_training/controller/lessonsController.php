<?php 
function listLessonCRM($input)
{
	global $controller;

	$modelLesson = $controller->loadModel('Lessons');

	$conditions = array();
    $listData = $modelLesson->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}

function addLessonCRM($input)
{
	global $controller;
	global $isRequestPost;

	$modelLesson = $controller->loadModel('Lessons');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelLesson->get( (int) $_GET['id']);
    }else{
        $data = $modelLesson->newEmptyEntity();
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

function deleteLessonCRM($input){
	global $controller;

	$modelLesson = $controller->loadModel('Lessons');
	
	if(!empty($_GET['id'])){
		$data = $modelLesson->get($_GET['id']);
		
		if($data){
         	$modelLesson->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_training-view-admin-lesson-listLessonCRM.php');
}
?>