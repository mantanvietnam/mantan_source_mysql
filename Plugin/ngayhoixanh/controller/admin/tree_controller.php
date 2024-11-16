<?php 
function listTreeAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách loại cây trồng';

    $modelTrees = $controller->loadModel('Trees');
    $modelImageTrees = $controller->loadModel('ImageTrees');
    $modelLocations = $controller->loadModel('Locations');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['orderby'])){
        if($_GET['orderby'] == 'id_location'){
            $order = array('id_location'=>'asc');
        }
    }

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['id_location'])){
        $conditions['id_location'] = (int) $_GET['id_location'];
    }

    if(!empty($_GET['name_tree'])){
        $conditions['name_tree LIKE'] = '%'.$_GET['name_tree'].'%';
    }

    if(!empty($_GET['name_program'])){
        $conditions['name_program LIKE'] = '%'.$_GET['name_program'].'%';
    }
    
    $listData = $modelTrees->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listImageTree = $modelImageTrees->find()->where(['id_tree'=>$value->id])->all()->toList();

            $listData[$key]->number_image = count($listImageTree);
            $listData[$key]->info_location = $modelLocations->get($value->id_location);
        }
    }

    // phân trang
    $totalData = $modelTrees->find()->where($conditions)->all()->toList();
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

    $listLocation = $modelLocations->find()->where()->all()->toList();
    $listCity = getVietnamProvinces();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listLocation', $listLocation);
    setVariable('listCity', $listCity);
}

function addTreeAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin loại cây';

	$modelTrees = $controller->loadModel('Trees');
    $modelLocations = $controller->loadModel('Locations');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelTrees->get( (int) $_GET['id']);
    }else{
        $data = $modelTrees->newEmptyEntity();

        if(!empty($_GET['id_location'])){
            $data->id_location = (int) $_GET['id_location'];
        }
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name_program']) && !empty($dataSend['number_tree']) && !empty($dataSend['name_tree']) && !empty($dataSend['id_location'])){

	        // tạo dữ liệu save
            $data->id_location = (int) $dataSend['id_location'];
            $data->name_tree = str_replace(array('"', "'"), '’', $dataSend['name_tree']);
            $data->name_program = str_replace(array('"', "'"), '’', $dataSend['name_program']);
            $data->number_tree = $dataSend['number_tree'];
            $data->choose_1 = $dataSend['choose_1'];
            $data->choose_2 = $dataSend['choose_2'];

            $modelTrees->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đủ dữ liệu</p>';
	    }
    }

    $listLocation = $modelLocations->find()->where()->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listLocation', $listLocation);
}

function deleteTreeAdmin($input){
	global $controller;

	$modelTrees = $controller->loadModel('Trees');
    $modelImageTrees = $controller->loadModel('ImageTrees');
	
	if(!empty($_GET['id'])){
		$data = $modelTrees->get($_GET['id']);
		
		if($data){
            $modelImageTrees->deleteAll(['id_tree'=>$_GET['id']]);
         	$modelTrees->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ngayhoixanh-view-admin-tree-listTreeAdmin/?id_location='.@$_GET['id_location']);
}
?>