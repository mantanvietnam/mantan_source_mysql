<?php 
function listOrderZoomAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đơn hàng';

    $modelOrders = $controller->loadModel('Orders');
    $modelManagers = $controller->loadModel('Managers');
    $modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    
    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    debug($listData);
    if(!empty($listData)){
        foreach($listData as $key => $value){
            if(!empty($value->idManager)){
                $infoManager = $modelManagers->find()->where(['id'=> $value->idManager])->first(); 
            }
            
            if(!empty($value->idZoom)){
                $infoZoom = $modelZooms->find()->where(['id'=> $value->idZoom])->first(); 
                debug($infoZoom);
            
            }

            if(!empty($value->idRoom)){
                $infoRoom = $modelRooms->find()->where(['id'=> $value->idRoom])->first(); 
                $infoRoom->info = json_decode($infoRoom->info, true);
            }
        }
    }    
   
    // phân trang
    $totalData = $modelOrders->find()->where($conditions)->all()->toList();
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
    setVariable('infoManager', $infoManager);
    setVariable('infoRoom', $infoRoom);
    setVariable('infoZoom', $infoZoom);




}


function deleteOrder($input){
	global $controller;

	$modelZooms = $controller->loadModel('Zooms');
	
	if(!empty($_GET['id'])){
		$data = $modelZooms->get($_GET['id']);
		
		if($data){
         	$modelZooms->delete($data);

         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/zoomcheap-view-admin-order-listOrderZoomAdmin.php');
}
?>