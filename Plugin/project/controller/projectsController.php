<?php 
function listProjectAdmin($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Project';

	$modelProjects = $controller->loadModel('Projects');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}
    
    $listData = $modelProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelProjects->find()->where($conditions)->all()->toList();
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

function addProjectAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Projects';

	$modelProjects = $controller->loadModel('Projects');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProjects->get( (int) $_GET['id']);
    }else{
        $data = $modelProjects->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
            $data->title = $dataSend['title'];
            $data->image = $dataSend['image'];
            $data->slug_drive = $dataSend['slug_drive'];
            $data->status = $dataSend['status'];
            $data->description= $dataSend['description'];
            $modelProjects->save($data);     

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

	$modelProjects = $controller->loadModel('Projects');
	
	if(!empty($_GET['id'])){
		$data = $modelProjects->get($_GET['id']);
		
		if($data){
         	$modelProjects->delete($data);
         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/project-view-admin-listProjectAdmin.php');
}

?>