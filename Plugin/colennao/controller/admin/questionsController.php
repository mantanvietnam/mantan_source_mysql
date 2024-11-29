<?php 
function listQuestion($input)

{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestions = $controller->loadModel('Questions');
    $conditions = ['type' => 'yoga'];
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    $listData = $modelQuestions->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
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
    $conditions = array();
    $listquestion = $modelQuestions->find()->where($conditions)->all()->toList();

    setVariable('listquestion', $listquestion);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listData', $listData);
}
function addQuestion($input)

{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    $metaTitleMantan = 'Thông tin câu hỏi';
	$modelQuestions = $controller->loadModel('Questions');

	$mess= '';


	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
        // debug($data);
        // die();
    }else{
        $data = $modelQuestions->newEmptyEntity();
    }
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['name'])) {
            // Tạo dữ liệu save
            $data->name = trim($dataSend['name']);  
            $data->nameen = trim($dataSend['nameen']);
            $data->type = trim($dataSend['type']);
            $data->status = $dataSend['status'];
            $answer1_vi = html_entity_decode(strip_tags(trim($dataSend['answer1_vi'])), ENT_QUOTES, 'UTF-8');
            $answer1_en = html_entity_decode(strip_tags(trim($dataSend['answer1_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer1_vi) || !empty($answer1_en)) {
                $data->answer1 = json_encode([
                    'vi' => $answer1_vi,
                    'en' => $answer1_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer1 = null; 
            }

            $answer2_vi = html_entity_decode(strip_tags(trim($dataSend['answer2_vi'])), ENT_QUOTES, 'UTF-8');
            $answer2_en = html_entity_decode(strip_tags(trim($dataSend['answer2_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer2_vi) || !empty($answer2_en)) {
                $data->answer2 = json_encode([
                    'vi' => $answer2_vi,
                    'en' => $answer2_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer2 = null;
            }

            $answer3_vi = html_entity_decode(strip_tags(trim($dataSend['answer3_vi'])), ENT_QUOTES, 'UTF-8');
            $answer3_en = html_entity_decode(strip_tags(trim($dataSend['answer3_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer3_vi) || !empty($answer3_en)) {
                $data->answer3 = json_encode([
                    'vi' => $answer3_vi,
                    'en' => $answer3_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer3 = null; 
            }

         
            $answer4_vi = html_entity_decode(strip_tags(trim($dataSend['answer4_vi'])), ENT_QUOTES, 'UTF-8');
            $answer4_en = html_entity_decode(strip_tags(trim($dataSend['answer4_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer4_vi) || !empty($answer4_en)) {
                $data->answer4 = json_encode([
                    'vi' => $answer4_vi,
                    'en' => $answer4_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer4 = null; 
            }

            $answer5_vi = html_entity_decode(strip_tags(trim($dataSend['answer5_vi'])), ENT_QUOTES, 'UTF-8');
            $answer5_en = html_entity_decode(strip_tags(trim($dataSend['answer5_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer5_vi) || !empty($answer5_en)) {
                $data->answer5 = json_encode([
                    'vi' => $answer5_vi,
                    'en' => $answer5_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer5 = null; 
            }

     
            $answer6_vi = html_entity_decode(strip_tags(trim($dataSend['answer6_vi'])), ENT_QUOTES, 'UTF-8');
            $answer6_en = html_entity_decode(strip_tags(trim($dataSend['answer6_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer6_vi) || !empty($answer6_en)) {
                $data->answer6 = json_encode([
                    'vi' => $answer6_vi,
                    'en' => $answer6_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer6 = null; 
            }

          
            $answer7_vi = html_entity_decode(strip_tags(trim($dataSend['answer7_vi'])), ENT_QUOTES, 'UTF-8');
            $answer7_en = html_entity_decode(strip_tags(trim($dataSend['answer7_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer7_vi) || !empty($answer7_en)) {
                $data->answer7 = json_encode([
                    'vi' => $answer7_vi,
                    'en' => $answer7_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer7 = null; 
            }
    

            $answer8_vi = html_entity_decode(strip_tags(trim($dataSend['answer8_vi'])), ENT_QUOTES, 'UTF-8');
            $answer8_en = html_entity_decode(strip_tags(trim($dataSend['answer8_en'])), ENT_QUOTES, 'UTF-8');
   
            if (!empty($answer8_vi) || !empty($answer8_en)) {
                $data->answer8 = json_encode([
                    'vi' => $answer8_vi,
                    'en' => $answer8_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
    
                $data->answer8 = null;
            }
            
          

            $modelQuestions->save($data);

            
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>'; 
                        
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên câu hỏi</p>';
        }

    }
    
    

    $listquestion = $modelQuestions->find()->where()->all()->toList();

    


    

    setVariable('listquestion', $listquestion);
    setVariable('data', $data);
    setVariable('mess', $mess);


}



function deleteQuestion($input){
	global $controller;
	$modelQuestions = $controller->loadModel('Questions');
	if(!empty($_GET['id'])){
		$data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelQuestions->delete($data);
        }
	}
	return $controller->redirect('/plugins/admin/colennao-view-admin-questions-listQuestion');

}
function deleteanswerquestion($input) {
    global $controller;
    $modelanswerquestion = $controller->loadModel('answerquestion');

    if (!empty($_GET['id'])) {
        $data = $modelanswerquestion->find()->where(['id' => (int) $_GET['id']])->first();
        if ($data) {
            $idurl = $data->id_question;
            $modelanswerquestion->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-questions-addQuestion/?id='.$idurl);
}
function listquestionkarate($input)

{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestions = $controller->loadModel('Questions');
    $conditions = ['type' => 'karate'];
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    $listData = $modelQuestions->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
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
    $conditions = array();
    $listquestion = $modelQuestions->find()->where($conditions)->all()->toList();

    setVariable('listquestion', $listquestion);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listData', $listData);
}
function addquestionkarate($input)

{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    $metaTitleMantan = 'Thông tin câu hỏi';
	$modelQuestions = $controller->loadModel('Questions');

	$mess= '';


	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
        // debug($data);
        // die();
    }else{
        $data = $modelQuestions->newEmptyEntity();
    }
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['name'])) {
            // Tạo dữ liệu save
            $data->name = trim($dataSend['name']);  
            $data->nameen = trim($dataSend['nameen']);
            $data->type = trim($dataSend['type']);
            $data->status = $dataSend['status'];
            $answer1_vi = html_entity_decode(strip_tags(trim($dataSend['answer1_vi'])), ENT_QUOTES, 'UTF-8');
            $answer1_en = html_entity_decode(strip_tags(trim($dataSend['answer1_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer1_vi) || !empty($answer1_en)) {
                $data->answer1 = json_encode([
                    'vi' => $answer1_vi,
                    'en' => $answer1_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer1 = null; 
            }

            $answer2_vi = html_entity_decode(strip_tags(trim($dataSend['answer2_vi'])), ENT_QUOTES, 'UTF-8');
            $answer2_en = html_entity_decode(strip_tags(trim($dataSend['answer2_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer2_vi) || !empty($answer2_en)) {
                $data->answer2 = json_encode([
                    'vi' => $answer2_vi,
                    'en' => $answer2_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer2 = null;
            }

            $answer3_vi = html_entity_decode(strip_tags(trim($dataSend['answer3_vi'])), ENT_QUOTES, 'UTF-8');
            $answer3_en = html_entity_decode(strip_tags(trim($dataSend['answer3_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer3_vi) || !empty($answer3_en)) {
                $data->answer3 = json_encode([
                    'vi' => $answer3_vi,
                    'en' => $answer3_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer3 = null; 
            }

         
            $answer4_vi = html_entity_decode(strip_tags(trim($dataSend['answer4_vi'])), ENT_QUOTES, 'UTF-8');
            $answer4_en = html_entity_decode(strip_tags(trim($dataSend['answer4_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer4_vi) || !empty($answer4_en)) {
                $data->answer4 = json_encode([
                    'vi' => $answer4_vi,
                    'en' => $answer4_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer4 = null; 
            }

            $answer5_vi = html_entity_decode(strip_tags(trim($dataSend['answer5_vi'])), ENT_QUOTES, 'UTF-8');
            $answer5_en = html_entity_decode(strip_tags(trim($dataSend['answer5_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer5_vi) || !empty($answer5_en)) {
                $data->answer5 = json_encode([
                    'vi' => $answer5_vi,
                    'en' => $answer5_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer5 = null; 
            }

     
            $answer6_vi = html_entity_decode(strip_tags(trim($dataSend['answer6_vi'])), ENT_QUOTES, 'UTF-8');
            $answer6_en = html_entity_decode(strip_tags(trim($dataSend['answer6_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer6_vi) || !empty($answer6_en)) {
                $data->answer6 = json_encode([
                    'vi' => $answer6_vi,
                    'en' => $answer6_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer6 = null; 
            }

          
            $answer7_vi = html_entity_decode(strip_tags(trim($dataSend['answer7_vi'])), ENT_QUOTES, 'UTF-8');
            $answer7_en = html_entity_decode(strip_tags(trim($dataSend['answer7_en'])), ENT_QUOTES, 'UTF-8');

            if (!empty($answer7_vi) || !empty($answer7_en)) {
                $data->answer7 = json_encode([
                    'vi' => $answer7_vi,
                    'en' => $answer7_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
                $data->answer7 = null; 
            }
    

            $answer8_vi = html_entity_decode(strip_tags(trim($dataSend['answer8_vi'])), ENT_QUOTES, 'UTF-8');
            $answer8_en = html_entity_decode(strip_tags(trim($dataSend['answer8_en'])), ENT_QUOTES, 'UTF-8');
   
            if (!empty($answer8_vi) || !empty($answer8_en)) {
                $data->answer8 = json_encode([
                    'vi' => $answer8_vi,
                    'en' => $answer8_en
                ], JSON_UNESCAPED_UNICODE);
            } else {
    
                $data->answer8 = null;
            }
            
          

            $modelQuestions->save($data);

            
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>'; 
                        
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên câu hỏi</p>';
        }

    }
    

    $listquestion = $modelQuestions->find()->where()->all()->toList();
    setVariable('listquestion', $listquestion);
    setVariable('data', $data);
    setVariable('mess', $mess);

}



function deleteQuestionkarate($input){
	global $controller;
	$modelQuestions = $controller->loadModel('Questions');
	if(!empty($_GET['id'])){
		$data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelQuestions->delete($data);
        }
	}
	return $controller->redirect('/plugins/admin/colennao-view-admin-questions-listQuestion');

}

?>