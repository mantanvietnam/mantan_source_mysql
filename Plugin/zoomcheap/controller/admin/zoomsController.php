<?php 
function listAccountZoomAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tài khoản zoom';

	$modelZooms = $controller->loadModel('Zooms');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['user'])){
        $conditions['user'] = (int) $_GET['user'];
    }

    if(!empty($_GET['type'])){
        $conditions['type'] = $_GET['type'];
    }

    if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = (int) $_GET['status'];
		}
	}
    
    $listData = $modelZooms->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelZooms->find()->where($conditions)->all()->toList();
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

function addZoom($input)
{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin sản phẩm';

	$modelZoom = $controller->loadModel('Zooms');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelZoom->get( (int) $_GET['id']);

        $data->images = json_decode($data->images, true);
    }else{
        $data = $modelZoom->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
            $data->status = $dataSend['type'];
	        $data->status = $dataSend['user'];
            $data->status = $dataSend['pass'];
	        $data->status = $dataSend['key_host'];
	        $data->status = $dataSend['status'];

	        
            

	        $modelZooms->save($data);

            $data->images = json_decode($data->images, true);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên sản phẩm</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteZoom($input){
	global $controller;

	$modelZooms = $controller->loadModel('Zooms');
	
	if(!empty($_GET['id'])){
		$data = $modelZooms->get($_GET['id']);
		
		if($data){
         	$modelZooms->delete($data);

         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/zoomcheap-view-admin-zoom-listAccountZoomAdmin.php');
}
?>