<?php 
function listTestCRM($input)
{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách bài thi';

	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');
    $modelQuestions = $controller->loadModel('Questions');

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

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addTestCRM($input)
{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin bài thi';

	$modelLesson = $controller->loadModel('Lessons');
	$modelSlugs = $controller->loadModel('Slugs');
    $modelTests = $controller->loadModel('Tests');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelTests->get( (int) $_GET['id']);
    }else{
        $data = $modelTests->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
	        $data->description = $dataSend['description'];
	        $data->id_lesson = $dataSend['id_lesson'];
	        $data->time_test = $dataSend['time_test'];
	        $data->status = $dataSend['status'];

	        // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            $number = 0;
            do{
            	$conditions = array('slug'=>$slugNew);
    			$listData = $modelTests->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

    			if(!empty($listData)){
    				$number++;
    				$slugNew = $slug.'-'.$number;
    			}
            }while (!empty($listData));

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


            if(!empty($time) && !empty($date))
            {
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
    $listLesson = $modelLesson->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listLesson', $listLesson);
}

function deleteTestCRM($input){
	global $controller;

	$modelLesson = $controller->loadModel('Lessons');
    $modelTests = $controller->loadModel('Tests');
	
	if(!empty($_GET['id'])){
		$data = $modelTests->get($_GET['id']);
		
		if($data){
         	$modelTests->delete($data);

         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_training-view-admin-test-listTestCRM.php');
}

// for home
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
?>