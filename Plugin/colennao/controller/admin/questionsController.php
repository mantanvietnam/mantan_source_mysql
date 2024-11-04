<?php 
function listQuestion($input)

{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestions = $controller->loadModel('Questions');
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    $conditions = array();
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
    if(!empty($_GET['id'])){
        $idanswer = $_GET['id'];

    }
   

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
            $data->status = $dataSend['status'];
            $data->answer1 = $dataSend['answer1'];
            $data->answer2 = $dataSend['answer2'];
            $data->answer3 = $dataSend['answer3'];
            $data->answer4 = $dataSend['answer4'];
            $data->answer5 = $dataSend['answer5'];
            $data->answer6 = $dataSend['answer6'];
            $data->answer7 = $dataSend['answer7'];
            $data->answer8 = $dataSend['answer8'];
          

            $modelQuestions->save($data);

            
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>'; 
                        
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên câu hỏi</p>';
        }

    }
    
    

    $currentAnswerId = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($currentAnswerId)) {
        $conditions = ['id !=' => $currentAnswerId]; 
    } else {
        $conditions = []; 
    }
    $listquestion = $modelQuestions->find()->where($conditions)->all()->toList();

    


    

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
function listQuestionenglish($input)

{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestions = $controller->loadModel('Questionsenglish');
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    $conditions = array();
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
function addquestionenglish($input)

{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    $metaTitleMantan = 'Thông tin câu hỏi';
	$modelQuestions = $controller->loadModel('Questionsenglish');

	$mess= '';
    if(!empty($_GET['id'])){
        $idanswer = $_GET['id'];

    }
   

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
            $data->status = $dataSend['status'];
            $data->answer1 = $dataSend['answer1'];
            $data->answer2 = $dataSend['answer2'];
            $data->answer3 = $dataSend['answer3'];
            $data->answer4 = $dataSend['answer4'];
            $data->answer5 = $dataSend['answer5'];
            $data->answer6 = $dataSend['answer6'];
            $data->answer7 = $dataSend['answer7'];
            $data->answer8 = $dataSend['answer8'];
          

            $modelQuestions->save($data);

            
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>'; 
                        
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên câu hỏi</p>';
        }

    }
    
    

    $currentAnswerId = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($currentAnswerId)) {
        $conditions = ['id !=' => $currentAnswerId]; 
    } else {
        $conditions = []; 
    }
    $listquestion = $modelQuestions->find()->where($conditions)->all()->toList();

    


    

    setVariable('listquestion', $listquestion);
    setVariable('data', $data);
    setVariable('mess', $mess);


}



function deleteQuestionenglish($input){
	global $controller;
	$modelQuestions = $controller->loadModel('Questionsenglish');
	if(!empty($_GET['id'])){
		$data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelQuestions->delete($data);
        }
	}
	return $controller->redirect('/plugins/admin/colennao-view-admin-questions-listQuestion');

}

?>