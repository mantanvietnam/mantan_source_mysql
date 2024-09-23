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

?>