<?php 
function listStudentAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách học sinh';

	$modelStudents = $controller->loadModel('Students');
    $modelClasses = $controller->loadModel('Classes');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    
    $listData = $modelStudents->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $class = $modelClasses->find()->where(['id'=>(int) $value->id_class])->first();

            $listData[$key]->name_class = @$class->name;
        }
    }

    // phân trang
    $totalData = $modelStudents->find()->where($conditions)->all()->toList();
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

    // niên khóa
    $conditions = array('type' => 'school_year');
    $listYear = $modelCategories->find()->where($conditions)->all()->toList();
    $listYearValue = [];

    if(!empty($listYear)){
        foreach ($listYear as $value) {
            $listYearValue[$value->id] = $value->name;
        }
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listYearValue', $listYearValue);
}

function addStudentAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin học sinh';

	$modelStudents = $controller->loadModel('Students');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelStudents->get( (int) $_GET['id']);
    }else{
        $data = $modelStudents->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            if(empty($dataSend['image'])) $dataSend['image'] = $urlHomes.'/plugins/phongtruyenthong/view/home/assets/img/avatar-default.jpg';

	        // tạo dữ liệu save
	        $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
	        $data->id_year = (int) $dataSend['id_year'];
            $data->id_class = (int) $dataSend['id_class'];
	        $data->achievement = $dataSend['achievement'];
            $data->image = $dataSend['image'];

	        $modelStudents->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên học sinh</p>';
	    }
    }

    $conditions = array('type' => 'school_year');
    $listYear = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listYear', $listYear);
}

function deleteStudentAdmin($input){
	global $controller;

	$modelStudents = $controller->loadModel('Students');
	
	if(!empty($_GET['id'])){
		$data = $modelStudents->get($_GET['id']);
		
		if($data){
         	$modelStudents->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/phongtruyenthong-view-admin-student-listStudentAdmin');
}

?>