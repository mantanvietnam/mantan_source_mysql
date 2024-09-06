<?php 
function listTest($input)

{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách bài thi';
	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');
    $modelQuestions = $controller->loadModel('Questions');
    $modelCourses = $controller->loadModel('Courses');
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    if(!empty($_GET['id_lesson'])){
        $conditions['id_lesson'] = (int) $_GET['id_lesson'];
    }
    $listData = $modelTests->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    if(!empty($listData)){
        $listLesson = array();
    	foreach ($listData as $key => $value) {
            /*
            if(empty($listLesson[$value->id_lesson])){
                $listLesson[$value->id_lesson] = $modelLesson->get( (int) $value->id_lesson);
            }
    		$listData[$key]->name_lesson = (!empty($listLesson[$value->id_lesson]->title))?$listLesson[$value->id_lesson]->title:'';
            */
            $conditionsQuestion = array('id_test'=>(int) $value->id);
            $question = $modelQuestions->find()->where($conditionsQuestion)->all()->toList();
            $listData[$key]->question = count($question);
    	}
    }
    $totalData = $modelTests->find()->where($conditions)->all()->toList();
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
function addTest($input)

{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin bài thi';
	$modelLesson = $controller->loadModel('Lessons');
	$modelSlugs = $controller->loadModel('Slugs');
    $modelTests = $controller->loadModel('Tests');
    $modelCourses = $controller->loadModel('Courses');
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelTests->find()->where(['id'=>(int) $_GET['id']])->first();
    }else{
        $data = $modelTests->newEmptyEntity();
    }
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
	        $data->description = $dataSend['description'];
	        $data->id_course = (int) $dataSend['id_course'];
            // $data->id_lesson = (int) $dataSend['id_lesson'];
	        $data->status = $dataSend['status'];
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
      
            $data->slug = $slugNew;
	        $modelTests->save($data);
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên bài thi</p>';
	    }
    }
    $conditions = array();
    $listCourse = $modelCourses->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCourse', $listCourse);
}

function deleteTest($input){
	global $controller;
	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');
	if(!empty($_GET['id'])){
		$data = $modelTests->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelTests->delete($data);
         	deleteSlugURL($data->slug);
        }
	}
	return $controller->redirect('/plugins/admin/colennao-view-admin-tests-listTest');

}
?>