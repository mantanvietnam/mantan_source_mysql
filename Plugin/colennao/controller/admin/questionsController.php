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
    $metaTitleMantan = 'Thông tin câu hỏi';
	$modelQuestions = $controller->loadModel('Questions');
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
        if(!empty($dataSend['question'])){
	        // tạo dữ liệu save
	        $data->question = trim($dataSend['question']);
	        $data->option_a = trim($dataSend['option_a']);
	        $data->option_b = trim($dataSend['option_b']);
	        $data->option_c = trim($dataSend['option_c']);
            $data->option_d = trim($dataSend['option_d']);
            // $data->option_true = $dataSend['option_true'];
            $data->id_test = $dataSend['id_test'];
	        $data->status = $dataSend['status'];
	        $modelQuestions->save($data);
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            $_SESSION['id_test_choose'] = $dataSend['id_test'];
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập câu hỏi</p>';
	    }
    }
    $conditions = array();
    $listTest = $modelTests->find()->where($conditions)->all()->toList();
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listTest', $listTest);

}



function deleteQuestionCRM($input){
	global $controller;
	$modelQuestions = $controller->loadModel('Questions');
	if(!empty($_GET['id'])){
		$data = $modelQuestions->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelQuestions->delete($data);
        }
	}
	return $controller->redirect('/plugins/admin/colennao-view-admin-question-listQuestion');

}
?>