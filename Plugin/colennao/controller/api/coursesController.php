<?php 
function listCoursesAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
	    $conditions= array('public'=>0);

	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');

	    if(!empty($dataSend['title'])){
			$key=createSlugMantan($dataSend['title']);
			$conditions['slug LIKE']= '%'.$key.'%';
		}
		
	    $listData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            if(!empty($value->id_category) && empty($category[$value->id_category])){
	                $category[$value->id_category] = $modelCategories->find()->where(['id' => (int) $value->id_category])->first();
	            }

	            $listData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
	            $lessons = $modelLesson->find()->where(['id_course'=>$value->id])->all()->toList();
	            $listData[$key]->number_lesson = count($lessons);
	        }
	    }

	    // phân trang

	    $totalData = $modelCourses->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);
		
		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
	        
	}else{
	    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}

    return $return;

	
}
function getCoursesAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            	$modelLesson = $controller->loadModel('Lessons');
            	$modelCourses = $controller->loadModel('Courses');
            	$modelTests = $controller->loadModel('Tests');
            	$conditions = array('id'=>(int)$dataSend['id'],'public'=>0);	
            	$data = $modelCourses->find()->where($conditions)->first();
            	if(!empty($data)){
            		$category = $modelCategories->find()->where(['id' => (int) $data->id_category])->first();    
            		$data->name_category = @$category->name;
            		$data->view ++;
            		$modelCourses->save($data);
            		$conditions = array('id !='=>$data->id);
            		$limit = 4;
            		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            		if($page<1) $page = 1;
            		$order = array('id'=>'desc');
            		$otherData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            		if(!empty($otherData)){
            			$category = [];
            			foreach ($otherData as $key => $value) {
            				if(!empty($value->id_category) && empty($category[$value->id_category])){
            					$category[$value->id_category] = $modelCategories->find()->where(['id' => (int) $value->id_category])->first();
            				}
            				$otherData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
            				$lessons = $modelLesson->find()->where(['id_course'=>$value->id])->all()->toList();
            				$otherData[$key]->number_lesson = count($lessons);
            			}
            		}
            		$data->otherData = $otherData;
	            // lấy số bài học
            		$conditions = array('id_course'=>$data->id);
            		$order = array('id'=>'desc');
            		$lesson = $modelLesson->find()->where($conditions)->order($order)->all()->toList();
            		$data->lesson = $lesson;

            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function getlessonAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;

    $modelLesson = $controller->loadModel('Lessons');
	$modelTest = $controller->loadModel('Tests');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $inforuser = getUserByToken($dataSend['token']);

            if(!empty($inforuser)){

		        $conditions = array('id'=>(int)$dataSend['id']);
		        $data = $modelLesson->find()->where($conditions)->first();
		        if(!empty($data)){

		            $metaTitleMantan = $data->title;

		            // tăng lượt xem
		            $data->view ++;
		            $modelLesson->save($data);

		            $conditions = array('id !='=>$data->id);
		            $limit = 4;
		            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		            if($page<1) $page = 1;
		            $order = array('id'=>'desc');

		            $otherData = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		            $data->otherData =$otherData;

					$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
			}else{
		        $return = array('code'=>3, 'mess'=>'Sai mã token');
		    }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listquestionAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestions = $controller->loadModel('Questions');
    $modelTests = $controller->loadModel('Tests'); 

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $conditions = array();
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        if ($page < 1) $page = 1;
        $order = array('id' => 'desc');
        if (!empty($dataSend['type'])) {
            $name = $dataSend['type'];
            $conditions['type LIKE'] = '%'. $name.'%';
        }
        $listData = $modelQuestions->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        $totalData = $modelQuestions->find()->where($conditions)->count(); 
        $return = array('code' => 1, 'mess' => 'Lấy dữ liệu thành công', 'listData' => $listData, 'totalData' => $totalData);
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}



?>