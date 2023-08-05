<?php 
function listAccountZoomAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tài khoản zoom';

	$modelZooms = $controller->loadModel('Zooms');
    $modelOrders = $controller->loadModel('Orders');
    $modelRooms = $controller->loadModel('Rooms');


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

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    $listData = $modelZooms->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    if(!empty($listData)){
        foreach($listData as $key => $value){
            if(!empty($value->idOrder)){
                $infoOrder = $modelOrders->find()->where(['id'=> $value->idOrder])->first();
                if(!empty($infoOrder->idRoom)){
                    $infoRoom = $modelRooms->find()->where(['id'=> $infoOrder->idRoom])->first(); 
                    $infoRoom->info = json_decode($infoRoom->info, true);

                    $listData[$key]->infoRoom = $infoRoom;
                    $listData[$key]->infoOrder = $infoOrder;
                }

                
            }   
           
        }
    }    
   
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
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin sản phẩm';

	$modelZooms = $controller->loadModel('Zooms');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelZooms->get( (int) $_GET['id']);
    }else{
        $data = $modelZooms->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['user'])){
            $data->user = $dataSend['user'];
            $data->type = $dataSend['type'];
	        $data->status = $dataSend['status'];	
            $data->pass = $dataSend['pass'];
            $data->key_host = $dataSend['key_host'];	
            $data->modified = time();
            $data->created = time();
            $data->client_id = $dataSend['client_id'];
            $data->client_secret = $dataSend['client_secret'];
            $data->account_id = $dataSend['account_id'];
            
            $deadline = 0;
            if(!empty($dataSend['deadline'])){
                $deadline = explode('/', $dataSend['deadline']);
                $deadline = mktime(0,0,0,$deadline[1],$deadline[0],$deadline[2]);
            }
	        
            $data->deadline = $deadline;
            
	        $modelZooms->save($data);
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteZoom($input){
	global $controller;

	$modelZooms = $controller->loadModel('Zooms');
	
	if(!empty($_GET['id'])){
		$data= $modelZooms->find()->where(['id'=>(int)$_GET['id']])->first(); 
		if($data){
         	$modelZooms->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/zoomcheap-view-admin-zoom-listAccountZoomAdmin.php');
}
?>