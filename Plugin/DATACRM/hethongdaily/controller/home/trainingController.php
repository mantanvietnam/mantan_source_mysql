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
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');

    $user = checklogin('listCourseAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
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
	            $like = $modelLike->find()->where(['id_object'=>$value->id, 'keyword'=>'course', 'type'=>'like'])->all()->toList();
	            $dislike = $modelLike->find()->where(['id_object'=>$value->id, 'keyword'=>'course', 'type'=>'dislike'])->all()->toList();
	            $comment = $modelComment->find()->where(['id_object'=>$value->id, 'keyword'=>'course'])->all()->toList();
	            $listData[$key]->number_lesson = count($lessons);
	            $listData[$key]->like = count($like);
	            $listData[$key]->dislike = count($dislike);
	            $listData[$key]->comment = count($comment);
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

	    $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }


	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('mess', $mess);
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

    $user = checklogin('addCourseAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCourseAgency');
        }
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

	            if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin khóa học '.$data->title.' có id là:'.$data->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin khóa học '.$data->title.' có id là:'.$data->id;
                }

                addActivityHistory($user,$note,'addCourseAgency',$data->id);

	            return $controller->redirect('/listCourseAgency?mess=saveSuccess');
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
    $user = checklogin('deleteCourseAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCourseAgency');
        }
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
        
	    if(!empty($_GET['id'])){
	        $data = $modelCourses->find()->where(['id'=>(int) $_GET['id']])->first();
	        if($data){
	         	$note = $user->type_tv.' '. $user->name.' xóa thông tin khóa học '.$data->title.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteCourseAgency',$data->id);
	            $modelCourses->delete($data);
	            return $controller->redirect('/listCourseAgency?mess=deleteSuccess');
	        }
	    }
	    return $controller->redirect('/listCourseAgency?mess=deleteError');
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
     $user = checklogin('listCategoryLessonAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCourseAgency');
        }
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
        $mess = '';
	    if ($isRequestPost) {
	    	 $user = checklogin('addCategoryLessonAgency');   
		     if(!empty($user->grant_permission)){
		        
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

		        if(!empty($dataSend['idCategoryEdit'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin nhóm bài học '.$infoCategory->name.' có id là:'.$infoCategory->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin nhóm bài học '.$infoCategory->name.' có id là:'.$infoCategory->id;
                }

                addActivityHistory($user,$note,'addCourseAgency',$infoCategory->id);
		       $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
               $mess= '<p class="text-danger">Bạn không có quyền thêm sửa </p>'; 

            }
	    }
	    $conditions = array('type' => '2top_crm_training', 'status'=>'active');
	    $listData = $modelCategories->find()->where($conditions)->all()->toList();

	    if(!empty($_GET['mess']) && $_GET['mess']=='noPermissiondelete'){
             $mess= '<p class="text-danger">Bạn không có quyền xóa</p>'; 
        }
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	}else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryLessonAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelCategoryConnects;

    $user = checklogin('deleteCategoryLessonAgency');  
    $mess = '';
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCategoryLessonAgency?mess=noPermissiondelete');
        }

        if ($_GET['id']) {
            $infoCategory = $modelCategories->find()->where(['id'=>(int) $_GET['id'],'type'=>'2top_crm_training'])->first();

            if(!empty($infoCategory)){
                $note = $user->type_tv.' '. $user->name.' xóa thông tin nhóm bài học '.$infoCategory->name.' có id là:'.$infoCategory->id;

                 addActivityHistory($user,$note,'deleteCategoryLessonAgency',$infoCategory->id);
                $modelCategories->delete($infoCategory);
                $modelCategoryConnects->deleteAll(['keyword'=>'2top_crm_training', 'id_category'=>(int)$_GET['id']]);
            }
        }
        


        return $controller->redirect('/groupCustomerAgency');
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
    $modelLike = $controller->loadModel('Likes');
    $modelComment = $controller->loadModel('Comments');

    $user = checklogin('listLessonAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCourseAgency');
        }
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
	            $like = $modelLike->find()->where(['id_object'=>$value->id, 'keyword'=>'lesson', 'type'=>'like'])->all()->toList();
	            $dislike = $modelLike->find()->where(['id_object'=>$value->id, 'keyword'=>'lesson', 'type'=>'dislike'])->all()->toList();
	            $comment = $modelComment->find()->where(['id_object'=>$value->id, 'keyword'=>'lesson'])->all()->toList();
	            $listData[$key]->like = count($like);
	            $listData[$key]->dislike = count($dislike);
	            $listData[$key]->comment = count($comment);
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

	    $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('mess', $mess);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('mess', $mess);
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

	$user = checklogin('addLessonAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listLessonAgency');
        }
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

		        if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin bài học '.$data->title.' có id là:'.$data->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin bài học '.$data->title.' có id là:'.$data->id;
                }

                addActivityHistory($user,$note,'addLessonAgency',$data->id);

		        return $controller->redirect('/listLessonAgency?mess=saveSuccess');
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

	$user = checklogin('deleteLessonAgency');  
    $mess = '';
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listLessonAgency');
        }
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }

		$modelLesson = $controller->loadModel('Lessons');
		if(!empty($_GET['id'])){
			$data = $modelLesson->find()->where(['id'=>(int) $_GET['id']])->first();
			if(!empty($data)){
				$note = $user->type_tv.' '. $user->name.' xóa thông tin bài học '.$infoCategory->name.' có id là:'.$infoCategory->id;

                 addActivityHistory($user,$note,'deleteLessonAgency',$infoCategory->id);

	         	$modelLesson->delete($data);
	         	return $controller->redirect('/listLessonAgency?mess=deleteSuccess');
	        }
		}
		return $controller->redirect('/listLessonAgency?mess=deleteError');
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
 	$user = checklogin('listTestAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCourseAgency');
        }
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

	    $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('mess', $mess);
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

   	$user = checklogin('addTestAgency');  
    $mess = '';
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listTestAgency');
        }
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

		        if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin bài thi '.$data->title.' có id là:'.$data->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin bài thi '.$data->title.' có id là:'.$data->id;
                }

                addActivityHistory($user,$note,'addTestAgency',$data->id);

		        return $controller->redirect('/listTestAgency?mess=saveSuccess');
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

    $user = checklogin('deleteTestAgency');  
    $mess = '';
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listTestAgency');
        }
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
	
		if(!empty($_GET['id'])){
			$data = $modelTests->find()->where(['id'=>(int) $_GET['id']])->first();	
			if(!empty($data)){

				$note = $user->type_tv.' '. $user->name.' xóa thông tin bài thi '.$data->name.' có id là:'.$data->id;

                 addActivityHistory($user,$note,'deleteTestAgency',$data->id);
	         	$modelTests->delete($data);
	         	deleteSlugURL($data->slug);
	         	return $controller->redirect('/listTestAgency?mess=deleteSuccess');
	        }
		}
		return $controller->redirect('/listTestAgency?mess=deleteError');
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
    $user = checklogin('listQuestionAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCourseAgency');
        }
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

	    $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

	    setVariable('page', $page);
	    setVariable('mess', $mess);
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
    $user = checklogin('addQuestionAgency');  
    $mess = '';
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listQuestionAgency');
        }
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

	              if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin câu hỏi '.$data->question.' có id là:'.$data->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin câu hỏi '.$data->question.' có id là:'.$data->id;
                }

                addActivityHistory($user,$note,'addQuestionAgency',$data->id);


	            return $controller->redirect('/listQuestionAgency?mess=saveSuccess');
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

	$user = checklogin('deleteQuestionAgency');  
    $mess = '';
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listQuestionAgency');
        }
        if(!empty($user->id_father)){
        	 return $controller->redirect('/');
        }
		if(!empty($_GET['id'])){
			$data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
			if($data){

				$note = $user->type_tv.' '. $user->name.' xóa thông tin câu hỏi '.$data->question.' có id là:'.$data->id;

                 addActivityHistory($user,$note,'deleteQuestionAgency',$data->id);
	         	$modelQuestions->delete($data);
	         	return $controller->redirect('/listQuestionAgency?mess=deleteSuccess');
	        }
		}
		return $controller->redirect('/listQuestionAgency?mess=deleteError');
	}else{
        return $controller->redirect('/login');
    }

}

 ?>