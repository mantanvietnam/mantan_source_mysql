<?php 
function listProductProjectAdmin($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Project';

	$modelProductProjects = $controller->loadModel('ProductProjects');

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
    
    $listData = $modelProductProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelProductProjects->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}

function addProductProjectAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Projects';

	$modelProductProjects = $controller->loadModel('ProductProjects');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProductProjects->get( (int) $_GET['id']);
    }else{
        $data = $modelProductProjects->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->image = $dataSend['image'];
            $data->address = $dataSend['address'];
            $data->company_design = $dataSend['company_design'];
            $data->designer = $dataSend['designer'];
            $data->	company_build= $dataSend['	company_build'];
            $data->description= $dataSend['description'];
            $data->city= $dataSend['city'];
            $modelProductProjects->save($data);     

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteProjectAdmin($input){
	global $controller;

	$modelProductProjects = $controller->loadModel('ProductProjects');
	
	if(!empty($_GET['id'])){
		$data = $modelProductProjects->get($_GET['id']);
		
		if($data){
         	$modelProductProjects->delete($data);
         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/project-view-admin-listProjectAdmin.php');
}

?>