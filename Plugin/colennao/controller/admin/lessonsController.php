<?php 
function listLesson($input)

{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách bài học';
	$modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    if(!empty($_GET['id_course'])){
        $conditions['id_course'] = (int) $_GET['id_course'];
    }
    $listData = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		if(!empty($value->id_course) && empty($category[$value->id_course])){
                $category[$value->id_course] = $modelCourses->find()->where(['id' => (int) $value->id_course])->first();
            }
    		$listData[$key]->name_course = (!empty($category[$value->id_course]->title))?$category[$value->id_course]->title:'';
           
          
    	}
    }
    $totalData = $modelLesson->find()->where($conditions)->all()->toList();
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
function addLesson($input)

{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin bài học';
	$modelLesson = $controller->loadModel('Lessons');
	$modelSlugs = $controller->loadModel('Slugs');
    $modelCourses = $controller->loadModel('Courses');
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelLesson->find()->where(['id'=>(int) $_GET['id']])->first();
    }else{
        $data = $modelLesson->newEmptyEntity();
    }
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
	        $data->content = $dataSend['content'];
	        $data->id_course = $dataSend['id_course'];
	        $data->image = $dataSend['image'];
	        $data->status = $dataSend['status'];
	        $data->description = $dataSend['description'];

            $data->titleen = $dataSend['titleen'];
	        $data->contenten = $dataSend['contenten'];
	        $data->descriptionen = $dataSend['descriptionen'];
	        $data->id_courseen = $dataSend['id_courseen'];
            // $data->author = $dataSend['author'];
            $data->youtube_code = $dataSend['youtube_code'];
            // $data->time_learn = (int) @$dataSend['time_learn'];
	        // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            // $number = 0;
            // if(empty($data->slug) || $data->slug!=$slugNew){
            //     do{
            //     	$conditions = array('slug'=>$slugNew);
        	// 		$listData = $modelLesson->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
        	// 		if(!empty($listData)){
        	// 			$number++;
        	// 			$slugNew = $slug.'-'.$number;
        	// 		}
            //     }while (!empty($listData));
            // }
            $data->slug = $slugNew;
	        $modelLesson->save($data);
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên bài học</p>';
	    }
    }
    $listCategory = $modelCourses->find()->where()->order(['id'=>'desc'])->all()->toList();
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCategory', $listCategory);

}



function deleteLesson($input){
	global $controller;
	$modelLesson = $controller->loadModel('Lessons');
	if(!empty($_GET['id'])){
		$data = $modelLesson->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelLesson->delete($data);
        }
	}
	return $controller->redirect('/plugins/admin/colennao-view-admin-lesson-listLesson');

}
?>