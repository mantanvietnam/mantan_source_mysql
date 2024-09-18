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
    if(!empty($_GET['id_test'])){
        $conditions['id_test'] = (int) $_GET['id_test'];
    }
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
    $modelanswerquetions = $controller->loadModel('answerquestion');
    $modelTests = $controller->loadModel('Tests');
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
    }else{
        $data = $modelQuestions->newEmptyEntity();
    }
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['name'])) {
            // Tạo dữ liệu save
            $data->name = trim($dataSend['name']);  
            $data->id_next = !empty($dataSend['id_next'][0]) ? (int)$dataSend['id_next'][0] : 'null';  
            $data->type = $dataSend['type'];
            $data->id_test = $dataSend['id_test'];
            $data->status = $dataSend['status'];
            $namequestion = $dataSend['name'];
            
            $modelQuestions->save($data);
            $idquestion = $data->id;
            if (!empty($dataSend['answername'])) {
                if (isset($dataSend['answername']) && is_array($dataSend['answername'])) {
                    foreach ($dataSend['answername'] as $key => $answername) {
                        $answerData = $modelanswerquetions->newEmptyEntity();
                        $answerData->answername = !empty($dataSend['answername'][$key]) ? trim($dataSend['answername'][$key]) : 'null'; 
                        $answerData->id_next = !empty($dataSend['id_next'][$key]) ? $dataSend['id_next'][$key] : '0';  
                        $answerData->namequestion = $namequestion;
                        $answerData->id_question = $idquestion;
                        $modelanswerquetions->save($answerData);
                    }
                }
            }
            


            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';              
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên câu hỏi</p>';
        }

    }
    
    

    $conditions = array();
    $listTest = $modelTests->find()->where($conditions)->all()->toList();
    $currentAnswerId = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($currentAnswerId)) {
        $conditions = ['id !=' => $currentAnswerId]; 
    } else {
        $conditions = []; 
    }
    $listquestion = $modelQuestions->find()->where($conditions)->all()->toList();

    
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!empty($id)) {
        $listanswerquestion = $modelQuestions->find()
            ->join([
                'answerquestion' => [
                    'table' => 'answerquestion',
                    'type' => 'INNER', 
                    'conditions' => 'Questions.id = answerquestion.id_question',
                ]
            ])
            ->select([
                'Questions.id', 
                'Questions.name', 
                'answerquestion.namequestion',
                'answerquestion.answername'
            ])
            ->where(['Questions.id' => $id]) 
            ->all();
            setVariable('listanswerquestion', $listanswerquestion);
    }

    

    setVariable('listquestion', $listquestion);
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listTest', $listTest);


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
?>