<?php 
function listcondition($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách điều kiện';

    $modeltbcondition = $controller->loadModel('tbcondition');
    $modelQuestions = $controller->loadModel('Questions');
    $modelPackageWorkouts = $controller->loadModel('PackageWorkouts');
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $datacondition = $modeltbcondition->find()->order(['id' => 'ASC'])->all();

 
    $idGroupFileList = [];
    $idQuestionList = [];

    foreach ($datacondition as $conditiondata) {
        $idGroupFileList[] = $conditiondata->id_groupfile;
        $idQuestionList[] = $conditiondata->id_question;
    }

    $idGroupFileList = array_unique($idGroupFileList);
    $idQuestionList = array_unique($idQuestionList);


    if(!empty($idGroupFileList)){
        $workoutData = $modelPackageWorkouts->find()->where(['id IN' => $idGroupFileList])->order(['id' => 'asc'])->all()->combine('id', 'title') ->toArray();
    }else{
        $workoutData= [];
    }


    if(!empty($idQuestionList)){
        $questionsData = $modelQuestions->find()->where(['id IN' => $idQuestionList])->order(['id' => 'asc'])->all()->combine('id', 'name') ->toArray();
    }else{
        $questionsData = [];
    }


    $groupconditiondata = [];
    foreach ($datacondition as $conditiondata) {
        $groupconditiondata[$conditiondata->id_groupfile]['title'] = $workoutData[$conditiondata->id_groupfile] ?? 'Unknown';
        

        $questionText = $questionsData[$conditiondata->id_question] ?? 'Câu hỏi không tìm thấy';

        $groupconditiondata[$conditiondata->id_groupfile]['data'][] = [
            'id_question' => $conditiondata->id_question,
            'question' => $questionText, 
            'answer' => $conditiondata->answer,
        ];
    }

    $listData = $modeltbcondition->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modeltbcondition->find()->where($conditions)->all()->toList();
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
    setVariable('groupconditiondata', $groupconditiondata);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
}
function addcondition($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm điều kiện';
    $PackageWorkouts = $controller->loadModel('PackageWorkouts');
    $modelQuestions = $controller->loadModel('Questions');
    $modeltbcondition = $controller->loadModel('tbcondition');
	$mess= '';
    $order = array('id'=>'asc');
    if (!empty($_GET['id'])) {
        $data = $modeltbcondition->get((int) $_GET['id']);
    } else {
        $data = $modeltbcondition->newEmptyEntity();
    }
    
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['id_groupfile']) && !empty($dataSend['id_question'])) {
            foreach ($dataSend['id_question'] as $questionId) {
                $existingData = $modeltbcondition->find()
                    ->where(['id_groupfile' => $dataSend['id_groupfile'], 'id_question' => $questionId])
                    ->first();
                if ($existingData) {
                    $existingData->answer = isset($dataSend['answer'][$questionId]) 
                        ? implode('', $dataSend['answer'][$questionId]) 
                        : ''; 
                    $modeltbcondition->save($existingData);
                } else {
                    $data = $modeltbcondition->newEmptyEntity();
                    $data->id_groupfile = $dataSend['id_groupfile'];
                    $data->id_question = $questionId;
                    $data->answer = isset($dataSend['answer'][$questionId]) 
                        ? implode('', $dataSend['answer'][$questionId]) 
                        : ''; 
                    $modeltbcondition->save($data);
                }
            }
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }
    
    
    
    
    $dataWorkout = $PackageWorkouts->find()->where(array())->order(['id' => 'asc'])->all()->toList();
    $dataquestion = $modelQuestions->find()->where(array())->order(['id' => 'asc'])->all()->toList();
    setVariable('dataWorkout', $dataWorkout);
    setVariable('dataquestion', $dataquestion);
    setVariable('data', $data);
    setVariable('mess', $mess);
}

function listconditioneng($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách điều kiện';

    $modeltbcondition = $controller->loadModel('tbconditionenglish');
    $modelQuestions = $controller->loadModel('Questionsenglish');
    $modelPackageWorkouts = $controller->loadModel('PackageWorkouts');
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $datacondition = $modeltbcondition->find()->order(['id' => 'ASC'])->all();

 
    $idGroupFileList = [];
    $idQuestionList = [];

    foreach ($datacondition as $conditiondata) {
        $idGroupFileList[] = $conditiondata->id_groupfile;
        $idQuestionList[] = $conditiondata->id_question;
    }

    $idGroupFileList = array_unique($idGroupFileList);
    $idQuestionList = array_unique($idQuestionList);


    if(!empty($idGroupFileList)){
        $workoutData = $modelPackageWorkouts->find()->where(['id IN' => $idGroupFileList])->order(['id' => 'asc'])->all()->combine('id', 'title_en') ->toArray();
    }else{
        $workoutData= [];
    }


    if(!empty($idQuestionList)){
        $questionsData = $modelQuestions->find()->where(['id IN' => $idQuestionList])->order(['id' => 'asc'])->all()->combine('id', 'name') ->toArray();
    }else{
        $questionsData = [];
    }


    $groupconditiondata = [];
    foreach ($datacondition as $conditiondata) {
        $groupconditiondata[$conditiondata->id_groupfile]['title_en'] = $workoutData[$conditiondata->id_groupfile] ?? 'chưa có tên tương ứng';
        

        $questionText = $questionsData[$conditiondata->id_question] ?? 'Câu hỏi không tìm thấy';

        $groupconditiondata[$conditiondata->id_groupfile]['data'][] = [
            'id_question' => $conditiondata->id_question,
            'question' => $questionText, 
            'answer' => $conditiondata->answer,
        ];
    }

    $listData = $modeltbcondition->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modeltbcondition->find()->where($conditions)->all()->toList();
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
    setVariable('groupconditiondata', $groupconditiondata);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
}
function addconditioneng($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm điều kiện';
    $PackageWorkouts = $controller->loadModel('PackageWorkouts');
    $modelQuestions = $controller->loadModel('Questionsenglish');
    $modeltbcondition = $controller->loadModel('tbconditionenglish');
	$mess= '';
    $order = array('id'=>'asc');
    if (!empty($_GET['id'])) {
        $data = $modeltbcondition->get((int) $_GET['id']);
    } else {
        $data = $modeltbcondition->newEmptyEntity();
    }
    
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['id_groupfile']) && !empty($dataSend['id_question'])) {
            foreach ($dataSend['id_question'] as $questionId) {
                $existingData = $modeltbcondition->find()
                    ->where(['id_groupfile' => $dataSend['id_groupfile'], 'id_question' => $questionId])
                    ->first();
                if ($existingData) {
                    $existingData->answer = isset($dataSend['answer'][$questionId]) 
                        ? implode('', $dataSend['answer'][$questionId]) 
                        : ''; 
                    $modeltbcondition->save($existingData);
                } else {
                    $data = $modeltbcondition->newEmptyEntity();
                    $data->id_groupfile = $dataSend['id_groupfile'];
                    $data->id_question = $questionId;
                    $data->answer = isset($dataSend['answer'][$questionId]) 
                        ? implode('', $dataSend['answer'][$questionId]) 
                        : ''; 
                    $modeltbcondition->save($data);
                }
            }
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }
    
    
    
    
    $dataWorkout = $PackageWorkouts->find()->where(array())->order(['id' => 'asc'])->all()->toList();
    $dataquestion = $modelQuestions->find()->where(array())->order(['id' => 'asc'])->all()->toList();
    setVariable('dataWorkout', $dataWorkout);
    setVariable('dataquestion', $dataquestion);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
?>