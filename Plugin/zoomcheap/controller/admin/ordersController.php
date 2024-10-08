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

    if(!empty($_GET['phone'])){
        $infoManagerSearch = $modelManagers->find()->where(['phone'=>$_GET['phone']])->first();

        $conditions['idManager'] = (int) @$infoManagerSearch->id;
    }
    
    $listData = $modelOrders->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    if(!empty($listData)){
        foreach($listData as $key => $value){
            if(!empty($value->idManager)){
                $infoManager = $modelManagers->find()->where(['id'=> $value->idManager])->first(); 
                $listData[$key]->infoManager = $infoManager;
            }
            
            if(!empty($value->idZoom)){
                $infoZoom = $modelZooms->find()->where(['id'=> $value->idZoom])->first(); 
                $listData[$key]->infoZoom = $infoZoom;
            }

            if(!empty($value->idRoom)){
                $infoRoom = $modelRooms->find()->where(['id'=> $value->idRoom])->first(); 
                if(!empty($infoRoom->info)){
                    $infoRoom->info = json_decode($infoRoom->info, true);
                }
                $listData[$key]->infoRoom = $infoRoom;
                
                if(!empty($infoRoom->id_zoom)){
                    $infoZoom = $modelZooms->find()->where(['id'=> $infoRoom->id_zoom])->first(); 
                    $listData[$key]->infoZoom = $infoZoom;
                }
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
}
function numberorderzoomdate($input) {
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách số lượng đơn theo ngày';

    $modelOrders = $controller->loadModel('Orders');
    $modelManagers = $controller->loadModel('Managers');
    $modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');
    $conditions = array();
    $limit = 20; 
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = array('id' => 'desc');

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int)$_GET['id'];
    }

    if (!empty($_GET['phone'])) {
        $infoManagerSearch = $modelManagers->find()->where(['phone' => $_GET['phone']])->first();
        $conditions['idManager'] = (int)@$infoManagerSearch->id;
    }

    $listData = $modelOrders->find()->where($conditions)->order($order)->all()->toList();

    $dailyData = [];

    if (!empty($listData)) {
        foreach ($listData as $order) {
            $date = date('d-m-Y', $order->dateStart); 

            if (!isset($dailyData[$date])) {
                $dailyData[$date] = [
                    'date' => $date,
                    'totalQuantity' => 0,
                ];
            }

            $dailyData[$date]['totalQuantity'] += 1;

            if (!empty($order->idManager)) {
                $infoManager = $modelManagers->find()->where(['id' => $order->idManager])->first();
                $order->infoManager = $infoManager;
            }

            if (!empty($order->idZoom)) {
                $infoZoom = $modelZooms->find()->where(['id' => $order->idZoom])->first();
                $order->infoZoom = $infoZoom;
            }

            if (!empty($order->idRoom)) {
                $infoRoom = $modelRooms->find()->where(['id' => $order->idRoom])->first();
                if (!empty($infoRoom->info)) {
                    $infoRoom->info = json_decode($infoRoom->info, true);
                }
                $order->infoRoom = $infoRoom;

                if (!empty($infoRoom->id_zoom)) {
                    $infoZoom = $modelZooms->find()->where(['id' => $infoRoom->id_zoom])->first();
                    $order->infoZoom = $infoZoom;
                }
            }
        }
    }

    // Phân trang
    $totalData = count($dailyData);
    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0) {
        $totalPage += 1;
    }

  
    $offset = ($page - 1) * $limit; 
    $dailyData = array_slice($dailyData, $offset, $limit); 

    $chartLabels = [];
    $chartData = [];

    foreach ($dailyData as $data) {
        $chartLabels[] = $data['date'];
        $chartData[] = $data['totalQuantity'];
    }

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0) {
        $back = 1;
    }
    if ($next > $totalPage) {
        $next = $totalPage;
    }

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
    setVariable('dailyData', $dailyData);
    setVariable('chartLabels', $chartLabels); 
    setVariable('chartData', $chartData); 
}

function numberorderzoommonth($input) {
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách số lượng đơn theo tháng';

    $modelOrders = $controller->loadModel('Orders');
    $modelManagers = $controller->loadModel('Managers');
    $modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');
    
    // Điều kiện tìm kiếm và thiết lập phân trang
    $conditions = array();
    $limit = 20; // Giới hạn số lượng tháng trên mỗi trang (20 tháng)
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    
    $listData = $modelOrders->find()->where($conditions)->all()->toList();

    $groupedData = [];
    if (!empty($listData)) {
        foreach ($listData as $order) {
            $monthYear = date('m-Y', $order->dateStart); 
            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [
                    'monthYear' => $monthYear,
                    'totalQuantity' => 0,
                ];
            }
            $groupedData[$monthYear]['totalQuantity'] += 1;
        }
    }

    // Tính tổng số trang
    $totalData = count($groupedData);
    $totalPage = ceil($totalData / $limit);
    
    // Phân trang dữ liệu (cắt dữ liệu theo trang hiện tại)
    $groupedData = array_slice($groupedData, ($page - 1) * $limit, $limit);

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0) $back = 1;
    if ($next > $totalPage) $next = $totalPage;

    // URL phân trang
    $urlPage = $urlCurrent;
    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlPage);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    }
    if (strpos($urlPage, '?') !== false) {
        $urlPage = $urlPage . '&page=';
    } else {
        $urlPage = $urlPage . '?page=';
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('groupedData', $groupedData); // Dữ liệu đã phân trang
}

function numberorderzoomhouse($input) {
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách số lượng đơn theo giờ';

    $modelOrders = $controller->loadModel('Orders');
    $modelManagers = $controller->loadModel('Managers');
    $modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');
    $conditions = array();
    $limit = 15;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $order = array('id' => 'desc');


    if (!empty($_GET['id'])) {
        $conditions['id'] = (int)$_GET['id'];
    }

    if (!empty($_GET['phone'])) {
        $infoManagerSearch = $modelManagers->find()->where(['phone' => $_GET['phone']])->first();
        $conditions['idManager'] = (int)@$infoManagerSearch->id;
    }


    $listData = $modelOrders->find()->where($conditions)->order($order)->all()->toList();

    $groupedData = [];

    if (!empty($listData)) {
        foreach ($listData as $order) {
            $hourDate = date('d-m-Y H', $order->dateStart); 
            if (!isset($groupedData[$hourDate])) {
                $groupedData[$hourDate] = [
                    'hourDate' => $hourDate,
                    'totalQuantity' => 0,
                ];
            }

            $groupedData[$hourDate]['totalQuantity'] += 1; 

            if (!empty($order->idManager)) {
                $infoManager = $modelManagers->find()->where(['id' => $order->idManager])->first();
                $order->infoManager = $infoManager;
            }

            if (!empty($order->idZoom)) {
                $infoZoom = $modelZooms->find()->where(['id' => $order->idZoom])->first();
                $order->infoZoom = $infoZoom;
            }

            if (!empty($order->idRoom)) {
                $infoRoom = $modelRooms->find()->where(['id' => $order->idRoom])->first();
                if (!empty($infoRoom->info)) {
                    $infoRoom->info = json_decode($infoRoom->info, true);
                }
                $order->infoRoom = $infoRoom;

                if (!empty($infoRoom->id_zoom)) {
                    $infoZoom = $modelZooms->find()->where(['id' => $infoRoom->id_zoom])->first();
                    $order->infoZoom = $infoZoom;
                }
            }
        }
    }

    // Phân trang
    $totalData = count($groupedData); 
    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0) {
        $totalPage += 1;
    }

    $offset = ($page - 1) * $limit;
    $groupedDataPaginated = array_slice($groupedData, $offset, $limit, true);

    // Thiết lập biến cho JavaScript
    $hourLabels = [];
    $totalQuantities = [];

    foreach ($groupedDataPaginated as $hour => $data) {
        $hourLabels[] = $data['hourDate'];
        $totalQuantities[] = $data['totalQuantity'];
    }

    // Thiết lập biến cho JavaScript
    setVariable('hourLabels', json_encode($hourLabels));
    setVariable('totalQuantities', json_encode($totalQuantities));

    // Tính toán trang
    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0) {
        $back = 1;
    }
    if ($next >= $totalPage) {
        $next = $totalPage;
    }

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
    setVariable('groupedData', $groupedData); 
}




?>