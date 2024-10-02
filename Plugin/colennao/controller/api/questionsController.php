<?php 
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
function listquestionenglishAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestions = $controller->loadModel('Questionsenglish');
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
function groupingexercisesuserAPI($input) {
    global $controller;
    global $isRequestPost;

    $modelTbcondition = $controller->loadModel('tbcondition');
    $modeluserpeople = $controller->loadModel('userpeople');

    if (!$isRequestPost) {
        return [
            'code' => 0,
            'mess' => 'Gửi sai kiểu POST'
        ];
    }

    $dataSend = $input['request']->getData();
    $answers = $dataSend['answers'];
    $validGroupFiles = [];
    $allGroupFileIds = [];

    foreach ($answers as $id_question => $userAnswer) {
        $results = $modelTbcondition->find()->where(['id_question' => $id_question])->all();
        if (!$results) {
            continue; 
        }

        foreach ($results as $result) {
            $groupFileId = $result->id_groupfile;
            $correctAnswers = str_split($result->answer); 
            

            if (!in_array($userAnswer, $correctAnswers)) {

                $allGroupFileIds[$groupFileId] = false; 
            } else {

                if (!isset($allGroupFileIds[$groupFileId])) {
                    $allGroupFileIds[$groupFileId] = true; 
                }
            }
        }
    }

    foreach ($allGroupFileIds as $groupFileId => $isValid) {
        if ($isValid) {
            $validGroupFiles[] = $groupFileId; 
        }
    }

 
    if (!empty($validGroupFiles)) {
        $workouts = $modeluserpeople->find()->where(['id IN' => $validGroupFiles])->all()->combine('id', 'name')->toArray();
        
        if (!empty($workouts)) {

            $validGroupFiles = $workouts[array_rand($workouts)];
            $selectedWorkoutId = array_search($validGroupFiles, $workouts);
        }
    }

    return !empty($validGroupFiles) ? [
        'code' => 1,
        'mess' => 'Lấy dữ liệu thành công',
        'id' => $selectedWorkoutId,
        'groupworkout' => $validGroupFiles
    ] : [
        'code' => 0,
        'mess' => 'Không tìm thấy bài tập phù hợp'
    ];
}






function listuserpeoplePI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách userpeople';

    $modeluserpeople = $controller->loadModel('userpeople');
    if($isRequestPost){
		    $dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modeluserpeople->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modeluserpeople->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);

            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiểu dữ liệu');
    }

    return $return;
}
function getuserpeopleAPI($input) {
    global $controller;
    global $isRequestPost;

    $modeluserpeople = $controller->loadModel('userpeople');


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id']) ) {
            $conditions = array('id' => (int)$dataSend['id']);
            $data = $modeluserpeople->find()->where($conditions)->first();

            if (!empty($data)) {
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$data);

            } else {
                $return = array('code' => 3, 'mess' => 'Id không tồn tại');
            }
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu hoặc ID không hợp lệ');
        }
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}
function listmyplanAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách myplane';

    $modelmyplane = $controller->loadModel('myplane');
    if($isRequestPost){
		    $dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modelmyplane->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modelmyplane->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);

            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiểu dữ liệu');
    }

    return $return;
}

function getmyplaneAPI($input) {
    global $controller;
    global $isRequestPost;

    $modelmyplane = $controller->loadModel('myplane');


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id']) ) {
            $conditions = array('id' => (int)$dataSend['id']);
            $data = $modelmyplane->find()->where($conditions)->first();

            if (!empty($data)) {
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$data);

            } else {
                $return = array('code' => 3, 'mess' => 'Id không tồn tại');
            }
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu hoặc ID không hợp lệ');
        }
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}


?>