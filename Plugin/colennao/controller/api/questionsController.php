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
    $modelPackageWorkouts = $controller->loadModel('PackageWorkouts');
    
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $answers = $dataSend['answers']; 
        $conditions = [];
        foreach ($answers as $id_question => $answer) {
            $conditions[] = [
                'id_question' => $id_question,
                'answer' => $answer
            ];
        }
        $groupFiles = [];
        foreach ($conditions as $condition) {
            $results = $modelTbcondition->find()->where(['id_question' => $condition['id_question'], 'answer' => $condition['answer']])->all();
            foreach ($results as $result) {
                $groupFiles[$result->id_groupfile] = true;
            }
        }
        $validGroupFiles = [];
        $selectedWorkoutId = null;
        if (!empty($groupFiles)) {
            $groupFileIds = array_keys($groupFiles);
            $workouts = $modelPackageWorkouts->find()->where(['id IN' => $groupFileIds])->all()->combine('id', 'title')->toArray();
            if (!empty($workouts)) {
                $validGroupFiles = $workouts[array_rand($workouts)];
                $selectedWorkoutId = array_search($validGroupFiles, $workouts);
            }
        }
        if (!empty($validGroupFiles)) {
            return [
                'code' => 1,
                'mess' => 'Lấy dữ liệu thành công',
                'id'=>$selectedWorkoutId,
                'groupworkout' => $validGroupFiles
            ];
        } else {
            return [
                'code' => 0,
                'mess' => 'Không tìm thấy bài tập phù hợp'
            ];
        }
    } else {
        return [
            'code' => 0,
            'mess' => 'Gửi sai kiểu POST'
        ];
    }
}


function groupingexercisesuserenglishAPI($input) {
    global $controller;
    global $isRequestPost;
    
    $modelTbcondition = $controller->loadModel('tbconditionenglish');
    $modelPackageWorkouts = $controller->loadModel('PackageWorkouts');
    
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $answers = $dataSend['answers']; 
        $conditions = [];
        foreach ($answers as $id_question => $answer) {
            $conditions[] = [
                'id_question' => $id_question,
                'answer' => $answer
            ];
        }
        $groupFiles = [];
        foreach ($conditions as $condition) {
            $results = $modelTbcondition->find()->where(['id_question' => $condition['id_question'], 'answer' => $condition['answer']])->all();
            foreach ($results as $result) {
                $groupFiles[$result->id_groupfile] = true;
            }
        }
        $validGroupFiles = [];
        $selectedWorkoutId = null;
        if (!empty($groupFiles)) {
            $groupFileIds = array_keys($groupFiles);
            $workouts = $modelPackageWorkouts->find()->where(['id IN' => $groupFileIds])->all()->combine('id', 'title_en')->toArray();
            if (!empty($workouts)) {
                $validGroupFiles = $workouts[array_rand($workouts)];
                $selectedWorkoutId = array_search($validGroupFiles, $workouts);
            }
        }
        if (!empty($validGroupFiles)) {
            return [
                'code' => 1,
                'mess' => 'Lấy dữ liệu thành công',
                'id'=>$selectedWorkoutId,
                'groupworkout' => $validGroupFiles
            ];
        } else {
            return [
                'code' => 0,
                'mess' => 'Không tìm thấy bài tập phù hợp'
            ];
        }
    } else {
        return [
            'code' => 0,
            'mess' => 'Gửi sai kiểu POST'
        ];
    }
}



?>