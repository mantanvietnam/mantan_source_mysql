<?php 
function listImageTreeAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    if(!empty($_GET['id_tree'])){

        $metaTitleMantan = 'Hình ảnh loại cây trồng';

        $modelTrees = $controller->loadModel('Trees');
        $modelImageTrees = $controller->loadModel('ImageTrees');
        $modelLocations = $controller->loadModel('Locations');

    	$conditions = array();
    	$limit = 20;
    	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    	if($page<1) $page = 1;
        $order = array('id'=>'desc');

        $conditions['id_tree'] = (int) $_GET['id_tree'];

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }
        

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }
        
        $listData = $modelImageTrees->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        // phân trang
        $totalData = $modelImageTrees->find()->where($conditions)->all()->toList();
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
    }else{
        return $controller->redirect('/plugins/admin/ngayhoixanh-view-admin-location-listLocationAdmin');
    }
}

function addImageTreeAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    if(!empty($_GET['id_tree'])){
        $metaTitleMantan = 'Thông tin hình ảnh';

    	$modelTrees = $controller->loadModel('Trees');
        $modelImageTrees = $controller->loadModel('ImageTrees');
        $modelLocations = $controller->loadModel('Locations');
    	$mess= '';

    	// lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelImageTrees->get( (int) $_GET['id']);
        }else{
            $data = $modelImageTrees->newEmptyEntity();
        }

    	if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['link'])){

    	        // tạo dữ liệu save
                $data->id_tree = (int) $_GET['id_tree'];
                $data->link = $dataSend['link'];
                $data->name = $dataSend['name'];

                $modelImageTrees->save($data);

    	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    	    }else{
    	    	$mess= '<p class="text-danger">Bạn chưa nhập đủ dữ liệu</p>';
    	    }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/plugins/admin/ngayhoixanh-view-admin-location-listLocationAdmin');
    }
}

function deleteImageTreeAdmin($input){
	global $controller;

	$modelTrees = $controller->loadModel('Trees');
    $modelImageTrees = $controller->loadModel('ImageTrees');
	
	if(!empty($_GET['id'])){
		$data = $modelImageTrees->get($_GET['id']);
		
		if($data){
         	$modelImageTrees->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ngayhoixanh-view-admin-image_tree-listImageTreeAdmin/?id_tree='.@$_GET['id_tree']);
}
?>