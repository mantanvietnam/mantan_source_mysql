<?php 
function testOnline($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;

    $modelTests = $controller->loadModel('Tests');
    $modelQuestions = $controller->loadModel('Questions');
    $modelHistoryTests = $controller->loadModel('Historytests');
    $modelCustomers = $controller->loadModel('Customers');

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
                    if(!empty($_GET['id_messenger'])){
                        $conditionsCustomer = array('id_messenger' => $_GET['id_messenger']);
                        $info_customer = $modelCustomers->find()->where($conditionsCustomer)->first();

                        $_GET['id_customer'] = @$info_customer->id;
                    }
                }

                if(!empty($_GET['id_customer'])){
                    $conditionsHistory['id_customer'] = (int) $_GET['id_customer'];
                    $conditionsHistory['id_test'] = (int) $data->id;
                    
                    $history = $modelHistoryTests->find()->where($conditionsHistory)->first();
                    if(empty($history)){
                        $history = $modelHistoryTests->newEmptyEntity();
                    }

                    $history->id_customer = @$_GET['id_customer'];
                    $history->id_test = $data->id;
                    $history->point = $point;
                    $history->total_true = $total_true;
                    $history->number_question = $number_question;
                    $history->time_start = @$dataSend['time_start'];
                    $history->time_end = time();

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

function lessonCategory($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;

    $modelLesson = $controller->loadModel('Lessons');

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
?>