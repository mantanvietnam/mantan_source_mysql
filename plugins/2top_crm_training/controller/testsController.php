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

    if(!empty($_GET['id_lesson'])){
        $conditions['id_lesson'] = (int) $_GET['id_lesson'];
    }

    $listData = $modelTests->find()->limit($limit)->page($page)->where($conditions)->all()->toList();

    
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

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);

        $conditions = array('slug'=>$slug);
        $data = $modelTests->find()->where($conditions)->order(['id' => 'DESC'])->first();

        if(!empty($data)){
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

                // gửi thông báo cho smax.bot
                $idMessenger = @$_GET['idMessenger'];
                if(!empty($setting_value['idBot']) && !empty($setting_value['tokenBot']) && !empty($setting_value['idBlock']) && !empty($idMessenger) ){
                    $attributesSmax['point_true'] = $total_true;
                    $attributesSmax['point_total'] = $number_question;
                    $attributesSmax['point'] = $point;

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