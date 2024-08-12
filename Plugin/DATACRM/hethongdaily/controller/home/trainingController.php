<?php 
// danh sách khóa học	
function listCourseAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $session;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelCourses = $controller->loadModel('Courses');
    $modelLesson = $controller->loadModel('Lessons');

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

	    $conditions = array();

	    if(!empty($_GET['name'])){
	    	$conditions['title LIKE'] = '%'.$_GET['name'].'%';
	    }
	    if(!empty($_GET['id_category'])){
	    	$conditions['id_category'] = (int) $_GET['id_category'];
	    }
	    $limit = 20;
	    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');

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

	    $conditions = array('type' => '2top_crm_training', 'status'=>'active');
	    $categories = $modelCategories->find()->where($conditions)->all()->toList();


	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('categories', $categories);
	    setVariable('listData', $listData);
	}else{
        return $controller->redirect('/login');
    }
}

// thêm sửa khóa học
function addCourseAgency($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $session;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin khóa học';

    $modelCourses = $controller->loadModel('Courses');
    $modelSlugs = $controller->loadModel('Slugs');
    $mess= '';

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

	    // lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelCourses->find()->where(['id'=>(int) $_GET['id']])->first();
	    }else{
	        $data = $modelCourses->newEmptyEntity();
	    }

	    if ($isRequestPost) {
	        $dataSend = $input['request']->getData();
	        if(!empty($dataSend['title'])){
	            // tạo dữ liệu save
	            $data->title = $dataSend['title'];
	            $data->image = $dataSend['image'];
	            $data->description = $dataSend['description'];
	            $data->youtube_code = $dataSend['youtube_code'];
	            $data->id_category = $dataSend['id_category'];
	            $data->status = $dataSend['status'];
	            $data->content = $dataSend['content'];
	            $data->public = $dataSend['public'];
	            // tạo slug
	            $slug = createSlugMantan($dataSend['title']);
	            $slugNew = $slug;
	            $number = 0;
	            if(empty($data->slug) || $data->slug!=$slugNew){
	                do{
	                    $conditions = array('slug'=>$slugNew);
	                    $listData = $modelCourses->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
	                    if(!empty($listData)){
	                        $number++;
	                        $slugNew = $slug.'-'.$number;
	                    }
	                }while (!empty($listData));
	            }
	            $data->slug = $slugNew;
	            $modelCourses->save($data);

	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	        }else{
	            $mess= '<p class="text-danger">Bạn chưa nhập tên bài học</p>';
	        }
	    }
	    $conditions = array('type' => '2top_crm_training', 'status'=>'active');
	    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listCategory', $listCategory);
	}else{
        return $controller->redirect('/login');
    }
}

// xóa khóa học
function deleteCourseAgency($input){
    global $controller;
    global $session;
    $modelCourses = $controller->loadModel('Courses');
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
        
	    if(!empty($_GET['id'])){
	        $data = $modelCourses->find()->where(['id'=>(int) $_GET['id']])->first();
	        if($data){
	            $modelCourses->delete($data);
	        }
	    }
	    return $controller->redirect('/listCourseAgency');
    }else{
        return $controller->redirect('/login');
    }
}

// danh mục đào tạo 
function listCategoryLessonAgency($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục đào tạo';
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

	    if ($isRequestPost) {
	        $dataSend = $input['request']->getData();     

	        // tính ID category
	        if(!empty($dataSend['idCategoryEdit'])){
	            $infoCategory = $modelCategories->find()->where(['id'=>(int) $dataSend['idCategoryEdit']])->first();
	        }else{
	            $infoCategory = $modelCategories->newEmptyEntity();
	        }

	        // tạo dữ liệu save
	        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
	        $infoCategory->parent = 0;
	        $infoCategory->image = $dataSend['image'];
	        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
	        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
	        $infoCategory->type = '2top_crm_training';
	        $infoCategory->status = 'active';

	        // tạo slug 
	        $slug = createSlugMantan($infoCategory->name);
	        $slugNew = $slug;
	        $number = 0;
	        do{
	            $conditions = array('slug'=>$slugNew,'type'=>'2top_crm_training');
	            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
	            if(!empty($listData)){
	                $number++;
	                $slugNew = $slug.'-'.$number;
	            }
	        }while (!empty($listData));
	        $infoCategory->slug = $slugNew;
	        $modelCategories->save($infoCategory);
	    }
	    $conditions = array('type' => '2top_crm_training', 'status'=>'active');
	    $listData = $modelCategories->find()->where($conditions)->all()->toList();
	    setVariable('listData', $listData);
	}else{
        return $controller->redirect('/login');
    }
}

// Danh sách bài học
function listLessonAgency($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
	global $session;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách bài học';

	$modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');
    $modelTests = $controller->loadModel('Tests');

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
	    $order = array('id'=>'desc');

	   if(!empty($_GET['name'])){
		    $conditions['title LIKE'] = '%'.$_GET['name'].'%';
		}

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
	            $tests = $modelTests->find()->where(['id_lesson'=>$value->id])->all()->toList();
	            $listData[$key]->number_test = count($tests);
	    	}
	    }
	    // phân trang
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
	    $category = $modelCourses->find()->where()->order(['id'=>'desc'])->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('listData', $listData);
	    setVariable('category', $category);

    }else{
        return $controller->redirect('/login');
    }
}

// thêm sửa bài học
function addLessonAgency($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Thông tin bài học';

	$modelLesson = $controller->loadModel('Lessons');
	$modelSlugs = $controller->loadModel('Slugs');
    $modelCourses = $controller->loadModel('Courses');
	$mess= '';

	if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

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
	            $data->author = $dataSend['author'];
	            $data->youtube_code = $dataSend['youtube_code'];
	            $data->time_learn = (int) @$dataSend['time_learn'];
		        // tạo slug
	            $slug = createSlugMantan($dataSend['title']);
	            $slugNew = $slug;
	            $number = 0;

	            if(empty($data->slug) || $data->slug!=$slugNew){
	                do{
	                	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelLesson->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
	                }while (!empty($listData));
	            }
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
    }else{
        return $controller->redirect('/login');
    }
}

// xóa khóa học 
function deleteLessonAgency($input){
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

		$modelLesson = $controller->loadModel('Lessons');
		if(!empty($_GET['id'])){
			$data = $modelLesson->find()->where(['id'=>(int) $_GET['id']])->first();
			if($data){
	         	$modelLesson->delete($data);
	        }
		}
		return $controller->redirect('/plugins/admin/2top_crm_training-view-admin-lesson-listLessonCRM');
	}else{
        return $controller->redirect('/login');
    }
}

// Danh sách bài kiểm tra
function listTestAgency($input)
{
	global $controller;
	global $session;
	global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách bài thi';

	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');
    $modelQuestions = $controller->loadModel('Questions');
    $modelCourses = $controller->loadModel('Courses');

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

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
	            if(!empty($value->id_course)){
	                $listData[$key]->name_course = $modelCourses->find()->where(['id' => (int) $value->id_course])->first()->title;
	            }

	            $conditionsQuestion = array('id_test'=>(int) $value->id);
	            $question = $modelQuestions->find()->where($conditionsQuestion)->all()->toList();
	            $listData[$key]->question = count($question);
	    	}
	    }

	    // phân trang
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

	     $conditions = array();
	    $category = $modelCourses->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('listData', $listData);
	    setVariable('category', $category);
	}else{
        return $controller->redirect('/login');
    }
}

// thêm sửa bài kiểm tra 
function addTestAgency($input)
{
	global $controller;
	global $session;
	global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin bài thi';

	$modelLesson = $controller->loadModel('Lessons');
	$modelSlugs = $controller->loadModel('Slugs');
    $modelTests = $controller->loadModel('Tests');
    $modelCourses = $controller->loadModel('Courses');

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
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
	            $data->id_lesson = (int) $dataSend['id_lesson'];
		        $data->time_test = $dataSend['time_test'];
		        $data->status = $dataSend['status'];
	            $data->point_min = $dataSend['point_min'];
		        // tạo slug
	            $slug = createSlugMantan($dataSend['title']);
	            $slugNew = $slug;
	            $number = 0;

	            if(empty($data->slug) || $data->slug!=$slugNew){
	                do{
	     	          	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelTests->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
	                }while (!empty($listData));
	            }
	            $data->slug = $slugNew;

	            // tính thời gian
	            $time_start = explode(' ', $dataSend['time_start']); 
	            $time = explode(':', $time_start[0]);
	            $date = explode('/', $time_start[1]);
	            if(!empty($time) && !empty($date))
	            {
	                $time_start= mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
	            }else{
	                $time_start= time();
	            }
	           	$time_end = explode(' ', $dataSend['time_end']); 
	            $time = explode(':', $time_end[0]);
	            $date = explode('/', $time_end[1]);
	            if(!empty($time) && !empty($date)){
	                $time_end= mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
	            }else{
	                $time_end= time();
	            }

	            $data->time_start = $time_start;
	            $data->time_end = $time_end;
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
	}else{
        return $controller->redirect('/login');
    }
}

// xóa bài kiểm tra
function deleteTestAgency($input){
	global $controller;
	global $session;

	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
	
		if(!empty($_GET['id'])){
			$data = $modelTests->find()->where(['id'=>(int) $_GET['id']])->first();	
			if($data){
	         	$modelTests->delete($data);
	         	deleteSlugURL($data->slug);
	        }
		}
		return $controller->redirect('/listTestAgency');
	}else{
        return $controller->redirect('/login');
    }
}

// danh sách câu hỏi 
function listQuestionAgency($input)
{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
	global $session;

    $metaTitleMantan = 'Danh sách câu hỏi';

    $modelQuestions = $controller->loadModel('Questions');
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

		$conditions = array();
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    if(!empty($_GET['id_test'])){
	        $conditions['id_test'] = (int) $_GET['id_test'];
	    }

	    $listData = $modelQuestions->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    // phân trang
	    $totalData = $modelQuestions->find()->where($conditions)->all()->toList();
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
	}else{
        return $controller->redirect('/login');
    }
}

// thêm sửa câu hỏi
function addQuestionAgency($input)
{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
	global $session;

    $metaTitleMantan = 'Thông tin câu hỏi';
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

		$modelQuestions = $controller->loadModel('Questions');
	    $modelTests = $controller->loadModel('Tests');
		$mess= '';

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
	    }else{
	        $data = $modelQuestions->newEmptyEntity();
	    }

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();
	        if(!empty($dataSend['question'])){
		        // tạo dữ liệu save
		        $data->question = trim($dataSend['question']);
		        $data->option_a = trim($dataSend['option_a']);
		        $data->option_b = trim($dataSend['option_b']);
		        $data->option_c = trim($dataSend['option_c']);
	            $data->option_d = trim($dataSend['option_d']);
	            $data->option_true = $dataSend['option_true'];
	            $data->id_test = $dataSend['id_test'];
		        $data->status = $dataSend['status'];
		        $modelQuestions->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

	            $_SESSION['id_test_choose'] = $dataSend['id_test'];
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập câu hỏi</p>';
		    }
	    }

	    $conditions = array();
	    $listTest = $modelTests->find()->where($conditions)->all()->toList();

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listTest', $listTest);

	 }else{
        return $controller->redirect('/login');
    }

}

// xóa câu hỏi 
function deleteQuestionAgency($input){

	global $controller;
	global $session;

	$modelQuestions = $controller->loadModel('Questions');

	if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
		if(!empty($_GET['id'])){
			$data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
			if($data){
	         	$modelQuestions->delete($data);
	        }
		}

		return $controller->redirect('/listQuestionAgency');
	}else{
        return $controller->redirect('/login');
    }

}

 ?>