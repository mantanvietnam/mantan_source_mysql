<?php 
function testOnline($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $session;

    $modelTests = $controller->loadModel('Tests');
    $modelQuestions = $controller->loadModel('Questions');
    $modelHistoryTests = $controller->loadModel('Historytests');
    $modelCustomers = $controller->loadModel('Members');

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }
        
        $data = $modelTests->find()->where($conditions)->order(['id' => 'DESC'])->first();

        if(!empty($data)){
            if(empty($dataSend['answer'])) $dataSend['answer'] = [];

            $conditionsSetting = array('key_word' => 'settingTraining2TOPCRM');
            $settingTraining2TOPCRM = $modelOptions->find()->where($conditionsSetting)->first();
            if(empty($settingTraining2TOPCRM)){
                $settingTraining2TOPCRM = $modelOptions->newEmptyEntity();
            }

            $setting_value = array();
            if(!empty($settingTraining2TOPCRM->value)){
                $setting_value = json_decode($settingTraining2TOPCRM->value, true);
            }

            $conditionsQuestion = array('id_test'=>(int) $data->id);
            $questions = $modelQuestions->find()->where($conditionsQuestion)->all()->toList();

            $total_true = 0;
            $point = 0;
            $number_question = count($questions);
            $answer_true= [];

            if(!empty($questions)){
                // đảo ngẫu nhiên câu hỏi
                shuffle($questions);

                foreach ($questions as $key => $value) {
                    $answer_true[$value->id] = $value->option_true;
                }
            }

            $submit = false;
            if($isRequestPost){
                $submit = true;
                $dataSend = $input['request']->getData();

                if(!empty($dataSend['answer'])){
                    foreach ($dataSend['answer'] as $idQuestion => $option_choose) {
                        if($option_choose == $answer_true[$idQuestion]){
                            $total_true++;
                        }
                    }
                }

                $point = $total_true * 10/$number_question;

                // lưu lịch sử thi
                if(!empty($_GET['id_customer'])){
                    $info_customer = $modelCustomers->get($_GET['id_customer']);
                }

                if(empty($info_customer)){
                    if(!empty($session->read('infoUser'))){
                        $info_customer = $modelCustomers->get($session->read('infoUser')->id);

                        $_GET['id_customer'] = @$info_customer->id;
                    }
                }

                if(empty($info_customer)){
                    if(!empty($_GET['id_messenger'])){
                        $conditionsCustomer = array('id_messenger' => $_GET['id_messenger']);
                        $info_customer = $modelCustomers->find()->where($conditionsCustomer)->first();

                        $_GET['id_customer'] = @$info_customer->id;
                    }
                }

                if(!empty($_GET['id_customer'])){
                    /*
                    $conditionsHistory['id_customer'] = (int) $_GET['id_customer'];
                    $conditionsHistory['id_test'] = (int) $data->id;
                    
                    $history = $modelHistoryTests->find()->where($conditionsHistory)->first();
                    if(empty($history)){
                        $history = $modelHistoryTests->newEmptyEntity();
                    }
                    */

                    $history = $modelHistoryTests->newEmptyEntity();

                    $history->id_customer = @$_GET['id_customer'];
                    $history->id_test = $data->id;
                    $history->point = $point;
                    $history->total_true = $total_true;
                    $history->number_question = $number_question;
                    $history->time_start = @$dataSend['time_start'];
                    $history->time_end = time();

                    if($point >= $data->point_min){
                        $history->status = 'pass';
                    }else{
                        $history->status = 'fail';
                    }

                    $modelHistoryTests->save($history);
                }

                // gửi thông báo cho smax.bot
                $idMessenger = @$_GET['idMessenger'];
                if(!empty($setting_value['idBot']) && !empty($setting_value['tokenBot']) && !empty($setting_value['idBlock']) && !empty($idMessenger) ){
                    $attributesSmax['point_true'] = $total_true;
                    $attributesSmax['point_total'] = $number_question;
                    $attributesSmax['point'] = $point*10;

                    $urlSmax = 'https://api.smax.bot/bots/' . $setting_value['idBot'] . '/users/' . $idMessenger . '/send?bot_token=' . $setting_value['tokenBot'] . '&block_id=' . $setting_value['idBlock'] . '&messaging_tag="CONFIRMED_EVENT_UPDATE"';

                    $sendSmax = sendDataConnectMantan($urlSmax, $attributesSmax);
                }

                setVariable('answer', $dataSend['answer']);
                setVariable('answer_true', $answer_true);
            }


            
            setVariable('data', $data);
            setVariable('questions', $questions);
            setVariable('submit', $submit);
            setVariable('point', $point);
            setVariable('total_true', $total_true);
            setVariable('number_question', $number_question);
            setVariable('setting_value', $setting_value);
        }else{
            return $controller->redirect('/?error=emptyDataTest');
        }
    }else{
        return $controller->redirect('/?error=emptySlugTest');
    }
}

// danh sách các khóa học cùng chủ đề
function training($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;

    $modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');

    $category = $modelCategories->newEmptyEntity();

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }
        
        $category = $modelCategories->find()->where($conditions)->first();
    }

    $conditions= array();

    if(!empty($category->id)){
    	$conditions = array('id_category'=>$category->id);
    }
	$limit = 12;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('category', $category);
}

function searchLesson($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;

    $modelLesson = $controller->loadModel('Lessons');

    $category = $modelCategories->newEmptyEntity();

    $conditions= array();
    if(!empty($_GET['key'])){
        $conditions= array('title LIKE'=>'%'.$_GET['key'].'%');
    }

    $limit = 12;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listLessons', $listData);
}

function lesson($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin bài học';

    if(!empty($session->read('infoUser'))){
        $modelLesson = $controller->loadModel('Lessons');
        $modelTest = $controller->loadModel('Tests');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('slug'=>$slug);
            }
        }

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

            // lấy số bài thi
            $conditions = array('id_lesson'=>$data->id);
            $order = array('id'=>'desc');

            $tests = $modelTest->find()->where($conditions)->order($order)->all()->toList();

            setVariable('data', $data);
            setVariable('otherData', $otherData);
            setVariable('tests', $tests);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function course($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin khóa học';

    if(!empty($session->read('infoUser'))){
        $modelLesson = $controller->loadModel('Lessons');
        $modelCourses = $controller->loadModel('Courses');
        $modelTests = $controller->loadModel('Tests');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('slug'=>$slug);
            }
        }

        $data = $modelCourses->find()->where($conditions)->first();

        if(!empty($data)){
            $metaTitleMantan = $data->title;

            $category = $modelCategories->find()->where(['id' => (int) $data->id_category])->first();
            
            $data->name_category = @$category->name;

            // tăng lượt xem
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

            // lấy số bài học
            $conditions = array('id_course'=>$data->id);
            $order = array('id'=>'desc');

            $lesson = $modelLesson->find()->where($conditions)->order($order)->all()->toList();

            // lấy số bài thi
            $conditions = array('id_course'=>$data->id, 'id_lesson'=>0);
            $order = array('id'=>'desc');

            $tests = $modelTests->find()->where($conditions)->order($order)->all()->toList();

            setVariable('data', $data);
            setVariable('otherData', $otherData);
            setVariable('lesson', $lesson);
            setVariable('tests', $tests);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/login');
    }
}

// danh sách khóa học
function courses($input)
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

    $conditions= array();
    $limit = 12;
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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function getLessonsAPI($input)
{
    global $isRequestPost;
    global $controller;

    $modelLesson = $controller->loadModel('Lessons');

    $return = [];

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id_course'])){
            $conditions = array('id_course'=> (int) $dataSend['id_course']);
            $order = array('id'=>'desc');

            $return = $modelLesson->find()->where($conditions)->order($order)->all()->toList();
        }
    }

    return $return;
}

function historyTest($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){

        $metaTitleMantan = 'Lịch sử thi';

        $modelHistoryTests = $controller->loadModel('Historytests');
        $modelTests = $controller->loadModel('Tests');

        $conditions= array('id_customer'=>$session->read('infoUser')->id);
        $limit = 12;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
        
        $listData = $modelHistoryTests->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if(!empty($value->id_test) && empty($category[$value->id_test])){
                    $category[$value->id_test] = $modelTests->find()->where(['id' => (int) $value->id_test])->first();
                }
                
                $listData[$key]->name_test = (!empty($category[$value->id_test]->title))?$category[$value->id_test]->title:'';
            }
        }
        
        // phân trang
        $totalData = $modelHistoryTests->find()->where($conditions)->all()->toList();
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

function courses_public($input)
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

    $conditions= array('public'=>1);
    $limit = 12;
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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}
?>