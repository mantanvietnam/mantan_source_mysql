<?php 
function listquestionyogaAPI($input)
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
        $order = array('id' => 'asc');
        if (!empty($dataSend['type'])) {
            $name = $dataSend['type'];
            $conditions['type LIKE'] = '%'. $name.'%';
        }
        $listData = $modelQuestions->find()->limit($limit)->page($page)->where(['type'=>'yoga'])->order($order)->all()->toList();
        $totalData = $modelQuestions->find()->where($conditions)->count(); 
        $return = array('code' => 1, 'mess' => 'Lấy dữ liệu thành công', 'listData' => $listData, 'totalData' => $totalData);
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}
function listquestionkarateAPI($input)
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
        $listData = $modelQuestions->find()->limit($limit)->page($page)->where(['type'=>'karate'])->order($order)->all()->toList();
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
    $modelHistoryResultUser = $controller->loadModel('HistoryResultUsers');

    if (!$isRequestPost) {
        return [
            'code' => 0,
            'mess' => 'Gửi sai kiểu POST'
        ];
    }
    $dataSend = $input['request']->getData();
    $answers = $dataSend['answers'] ?? []; 

    $groupedConditions = $modelTbcondition->find()->order(['id_groupfile', 'id_question'])->where(['type'=>'yoga'])->all();

    $validGroupFiles = [];
    $groupConditions = [];
    
    foreach ($groupedConditions as $condition) {
        $groupConditions[$condition->id_groupfile][] = $condition;
    }

    $token = createToken();

    if(!empty($answers)){
        $save = $modelHistoryResultUser->newEmptyEntity();
        $save->answers = json_encode($answers);
        $save->token = $token;
        $save->created_at = time();
        $modelHistoryResultUser->save($save);
    }
    
    if(empty($save)) {
        $token = '';
      }   

    foreach ($groupConditions as $id_groupfile => $conditions) {
        $isValidGroup = true;

        foreach ($conditions as $condition) {
            $id_question = $condition->id_question;
            $correctAnswers = str_split($condition->answer);  
            if (!isset($answers[$id_question]) || !in_array($answers[$id_question], $correctAnswers)) {
                $isValidGroup = false;  
                break;
            }
        }

        if ($isValidGroup) {
   
            $groupTitle = $modeluserpeople->find()->where(['id' => $id_groupfile])->first();
            $validGroupFiles[$id_groupfile] = [
                'id_groupfile' => $id_groupfile,
                'name' => $groupTitle ? $groupTitle->name : 'Không có tên' 
            ];
        }
    }




    if (!empty($validGroupFiles)) {
     
        $randomKey = array_rand($validGroupFiles);
        $selectedGroup = $validGroupFiles[$randomKey];

        return [
            'code' => 1,
            'mess' => 'Lấy dữ liệu thành công',
            'valid_groups' => [$selectedGroup],
            'token'=> $token
        ];
    } else {

        $activeGroup = $modelTbcondition->find()
            ->select(['id_groupfile'])
            ->where(['status' => 'active'])
            ->first(); 

        if ($activeGroup) {
            $groupTitle = $modeluserpeople->find()->where(['id' => $activeGroup->id_groupfile])->first();

            $activeGroupFile = [
                'id_groupfile' => $activeGroup->id_groupfile,
                'name' => $groupTitle ? $groupTitle->name : 'Không có tên'
            ];

            return [
                'code' => 0,
                'mess' => 'Bài tập nhóm này là mặc định',
                'valid_groups' => [$activeGroupFile] ,
                'token'=> $token
            ];
        } else {
            return [
                'code' => 0,
                'mess' => 'Không tìm thấy nhóm bài tập phù hợp và không có nhóm nào active',
                'valid_groups' => [] 
            ];
        }
    }
}
function groupingexercisesuserkarateAPI($input) {
    global $controller;
    global $isRequestPost;

    $modelTbcondition = $controller->loadModel('tbcondition');
    $modeluserpeople = $controller->loadModel('userpeople'); 
    $modelHistoryResultUser = $controller->loadModel('HistoryResultUsers');


    if (!$isRequestPost) {
        return [
            'code' => 0,
            'mess' => 'Gửi sai kiểu POST'
        ];
    }

    $dataSend = $input['request']->getData();
    $answers = $dataSend['answers'] ?? []; 

  
    $groupedConditions = $modelTbcondition->find()
        ->order(['id_groupfile', 'id_question'])
        ->where(['type' => 'karate'])
        ->all();

    $validGroupFiles = [];
    $groupConditions = [];
    
    
    foreach ($groupedConditions as $condition) {
        $groupConditions[$condition->id_groupfile][] = $condition;
    }

    
    $token = createToken();
    if (!empty($answers)) {
        $save = $modelHistoryResultUser->newEmptyEntity();
        $save->answers = json_encode($answers);
        $save->token = $token;
        $save->created_at = time();
        $modelHistoryResultUser->save($save);
    }

 
    if (empty($save)) {
        $token = '';
    }

    
    foreach ($groupConditions as $id_groupfile => $conditions) {
        $isValidGroup = true;

        foreach ($conditions as $condition) {
            $id_question = $condition->id_question;
            $correctAnswers = str_split($condition->answer);

            if (!isset($answers[$id_question]) || !in_array($answers[$id_question], $correctAnswers)) {
                $isValidGroup = false;
                break;
            }
        }

      
        if ($isValidGroup) {
            $groupTitle = $modeluserpeople->find()->where(['id' => $id_groupfile])->first();
            $validGroupFiles[$id_groupfile] = [
                'id_groupfile' => $id_groupfile,
                'name' => $groupTitle ? $groupTitle->name : 'Không có tên'
            ];
        }
    }

   
    if (!empty($validGroupFiles)) {
        $randomKey = array_rand($validGroupFiles);
        $selectedGroup = $validGroupFiles[$randomKey];

        return [
            'code' => 1,
            'mess' => 'Lấy dữ liệu thành công',
            'valid_groups' => [$selectedGroup],
            'token' => $token
        ];
    } else {
        
        $activeGroup = $modelTbcondition->find()
            ->select(['id_groupfile'])
            ->where(['status' => 'active', 'type' => 'karate'])
            ->first();

        if ($activeGroup) {
            $groupTitle = $modeluserpeople->find()->where(['id' => $activeGroup->id_groupfile])->first();

            $activeGroupFile = [
                'id_groupfile' => $activeGroup->id_groupfile,
                'name' => $groupTitle ? $groupTitle->name : 'Không có tên'
            ];

            return [
                'code' => 0,
                'mess' => 'Bài tập nhóm này là mặc định',
                'valid_groups' => [$activeGroupFile],
                'token' => $token
            ];
        } else {
          
            return [
                'code' => 0,
                'mess' => 'Không tìm thấy nhóm bài tập phù hợp và không có nhóm nào active thuộc karate',
                'valid_groups' => [],
                'token' => $token
            ];
        }
    }
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
            foreach ($listData as $key => $data){
                $listData[$key]->id_lesson = json_decode($data->id_lesson, true);
            }

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
            $listData = $modeluserpeople->find()->where($conditions)->first();
            if ($listData) {
                $listData->id_lesson = json_decode($listData->id_lesson, true);
            }
            if (!empty($listData)) {
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData);

            }else{
                $return = array('code'=>0, 'mess'=>'id không hợp lệ ');
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
            if( !empty($dataSend['id_userpeople'])){
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
                    foreach ($listData as $key => $data){
                        $listData[$key]->alldata = json_decode($data->alldata, true);
                    }
                    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
            }

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

        if (!empty($dataSend['id'])) {
                $conditions = array('id' => (int)$dataSend['id']);
                $listData = $modelmyplane->find()->where($conditions)->first();
                if ($listData) {
                    $listData->alldata = json_decode($listData->alldata, true);
                }
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData);
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu hoặc ID không hợp lệ');
        }
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}

?>