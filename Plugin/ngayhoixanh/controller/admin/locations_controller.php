<?php 
function listLocationAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách địa điểm';

	$modelLocations = $controller->loadModel('Locations');
    $modelTrees = $controller->loadModel('Trees');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['orderby'])){
        if($_GET['orderby'] == 'id_city'){
            $order = array('id_city'=>'asc');
        }
    }

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['id_city'])){
        $conditions['id_city'] = (int) $_GET['id_city'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    
    $listData = $modelLocations->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listTree = $modelTrees->find()->where(['id_location'=>$value->id])->all()->toList();

            $listData[$key]->number_tree = count($listTree);
        }
    }

    // phân trang
    $totalData = $modelLocations->find()->where($conditions)->all()->toList();
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

    $listCity = getVietnamProvinces();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listCity', $listCity);
}

function addLocationsAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin địa điểm';

	$modelLocations = $controller->loadModel('Locations');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelLocations->get( (int) $_GET['id']);
    }else{
        $data = $modelLocations->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){

	        // tạo dữ liệu save
	        $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $data->image = $dataSend['image'];
            $data->description = $dataSend['description'];
            $data->id_city = (int) $dataSend['id_city'];

            $modelLocations->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đủ dữ liệu</p>';
	    }
    }

    $listCity = getVietnamProvinces();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCity', $listCity);
}

function deleteLocationsAdmin($input){
	global $controller;

	$modelLocations = $controller->loadModel('Locations');
	
	if(!empty($_GET['id'])){
		$data = $modelLocations->get($_GET['id']);
		
		if($data){
         	$modelLocations->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ngayhoixanh-view-admin-location-listLocationAdmin');
}
?>