<?php 
function listTeacherAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách giáo viên';

	$modelTeachers = $controller->loadModel('Teachers');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['position'])){
        $conditions['position'] = (int) $_GET['position'];
    }

    if(isset($_GET['pin']) && $_GET['pin']!=''){
        $conditions['pin'] = (int) $_GET['pin'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    
    $listData = $modelTeachers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelTeachers->find()->where($conditions)->all()->toList();
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

    // danh sách chức danh
    $conditions = array('type' => 'positionTeacher');
    $listPosition = $modelCategories->find()->where($conditions)->all()->toList();
    $listPositionValue = [];

    if(!empty($listPosition)){
        foreach ($listPosition as $value) {
            $listPositionValue[$value->id] = $value->name;
        }
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listPositionValue', $listPositionValue);
}

function addTeacherAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin giáo viên';

	$modelTeachers = $controller->loadModel('Teachers');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelTeachers->get( (int) $_GET['id']);
    }else{
        $data = $modelTeachers->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            if(empty($dataSend['avatar'])) $dataSend['avatar'] = $urlHomes.'/plugins/phongtruyenthong/view/home/assets/img/avatar-default.jpg';

	        // tạo dữ liệu save
	        $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
	        $data->position = $dataSend['position'];
	        $data->introduce = $dataSend['introduce'];
            $data->avatar = $dataSend['avatar'];
            $data->pin = (int) $dataSend['pin'];

	        $modelTeachers->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên giáo viên</p>';
	    }
    }

    $conditions = array('type' => 'positionTeacher');
    $listPositionTeacher = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listPositionTeacher', $listPositionTeacher);
}

function deleteTeacherAdmin($input){
	global $controller;

	$modelTeachers = $controller->loadModel('Teachers');
	
	if(!empty($_GET['id'])){
		$data = $modelTeachers->get($_GET['id']);
		
		if($data){
         	$modelTeachers->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/phongtruyenthong-view-admin-teacher-listTeacherAdmin');
}

function listPositionAdmin($input)
{
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Chức danh';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
        if(!empty($dataSend['idCategoryEdit'])){
            $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
        }else{
            $infoCategory = $modelCategories->newEmptyEntity();
        }

        // tạo dữ liệu save
        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
        $infoCategory->parent = 0;
        $infoCategory->image = $dataSend['image'];
        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
        $infoCategory->type = 'positionTeacher';
        $infoCategory->slug = createSlugMantan($infoCategory->name);

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'positionTeacher');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}
?>