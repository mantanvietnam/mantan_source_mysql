<?php 
function statisticalnumberbook($input) {
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $user = checklogin('statisticalnumberbooks');
    if (!empty($user)) {
        $metaTitleMantan = 'Thống kê số lượng sách';
        $modelmembers = $controller->loadModel('members');
        $modelwarehouses = $controller->loadModel('warehouses');
        $modelbooks = $controller->loadModel('books');
        $modelbuiding = $controller->loadModel('buildings');

        $order = array('id' => 'desc');
        $conditions = array();
        $limit = 8; 
        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        // if ($user->type == 'staff') {
        //     if ($user->idbuilding) {
        //         $conditions['id_building IN'] =$user->idbuilding;
        //     } else {
        //         $conditions['id'] = 0;
        //     }
        // } else {
        //     if (!empty($_GET['id'])) {
        //         $conditions['id'] = (int)$_GET['id'];
        //     }
        // }
        if ($user->idbuilding) {
            $conditions['id_building IN'] =$user->idbuilding;
        } else {
            $conditions['id'] = 0;
        }
        $listData = $modelwarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        foreach ($listData as &$warehouse) {
            $book = $modelbooks->find()->where(['id' => $warehouse->id_book])->first(); 
            if ($book) {
                $warehouse->book_name = $book->name; 
            }
        }

        $totalData = $modelwarehouses->find()->where($conditions)->count();
        $totalPage = ceil($totalData / $limit);

        $back = ($page > 1) ? $page - 1 : 1;
        $next = ($page < $totalPage) ? $page + 1 : $totalPage;

 
        if (isset($_GET['page'])) {
            $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
            $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
        } else {
            $urlPage = $urlCurrent;
        }
        if (strpos($urlPage, '?') !== false) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . '?page=';
        }
   
        $building = $modelbuiding->find()->where(['id' => $user->idbuilding])->first();
        setVariable('building', $building);
        setVariable('listData', $listData);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
    }
}
function statisticalorderbookborrow($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $user = checklogin('statisticalorderbook');
    if (!empty($user)) {
        $metaTitleMantan = 'Thống kê số lượng sách mượn theo tháng';
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelOrders = $controller->loadModel('Orders');
        $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

        $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
        $limit = 10; 

        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $startDate = strtotime("$year-$month-01 00:00:00"); 
        $today = strtotime('today 23:59:59'); 
        if(!empty($user->idbuilding)){
            $idbuiding = $user->idbuilding;
        }

        $endDate = min($today, strtotime("$year-$month-" . date('t', $startDate) . " 23:59:59")); 
        $orders = $modelOrders->find()
            ->where(['Orders.created_at >=' => $startDate, 'Orders.created_at <=' => $endDate,'Orders.building_id' => $idbuiding])
            ->page($page)
            ->limit($limit)
            ->toArray();
        $orderIds = array_map(function ($order) {
            return $order->id;
        }, $orders);

    
        if (!empty($orderIds)) {
        
            $orderDetails = $modelOrderDetails->find()
                ->where(['OrderDetails.order_id IN' => $orderIds])
                ->toArray();
        } else {

            $orderDetails = [];
        }

        $orderDateMap = [];
        foreach ($orders as $order) {
            $orderDateMap[$order->id] = $order->created_at;
        }
  
        $listDataWithCreatedAt = [];
        $dateCounts = [];
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $date = date('Y-m-d', $currentDate);
            $dateCounts[$date] = 0; 
            $currentDate = strtotime("+1 day", $currentDate);
        }
     
        foreach ($orderDetails as $detail) {
           
            $createdAt = isset($orderDateMap[$detail->order_id])
                ? date('Y-m-d', $orderDateMap[$detail->order_id])
                : 'Không xác định';
            if (isset($dateCounts[$createdAt])) {
                $dateCounts[$createdAt]++;
            }
            $listDataWithCreatedAt[] = [
                'book_id' => $detail->book_id,
                'created_at' => $createdAt,
            ];
        }
        $totalData = $modelOrders->find()
            ->where(['Orders.created_at >=' => $startDate, 'Orders.created_at <=' => $endDate])
            ->count();

        $totalPage = ceil($totalData / $limit);
        $back = ($page > 1) ? $page - 1 : 1;
        $next = ($page < $totalPage) ? $page + 1 : $totalPage;
        $urlPage = preg_replace('/([&?])page=\d+/', '', $urlCurrent);
        $urlPage = strpos($urlPage, '?') !== false ? $urlPage . '&page=' : $urlPage . '?page=';
        setVariable('listDataWithCreatedAt', $listDataWithCreatedAt);
      
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('chartDates', array_keys($dateCounts));
        setVariable('chartCounts', array_values($dateCounts));
        setVariable('year', $year);
        setVariable('month', $month);
    }
}
function statisticalorderbookpay($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $user = checklogin('statisticalorderbook');
    if (!empty($user)) {
        $metaTitleMantan = 'Thống kê số lượng sách trả theo tháng';
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelOrders = $controller->loadModel('Orders');
        $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
        $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
        $month = sprintf('%02d', $month);
        $limit = 10;

        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

    
        $startDate = strtotime("$year-$month-01 00:00:00");

        if(!empty($user->idbuilding)){
            $idbuiding = $user->idbuilding;
        }
        $orders = $modelOrders->find()
            ->where(['Orders.updated_at >=' => $startDate, 'Orders.status' => 2,'Orders.building_id' => $idbuiding])
            ->page($page)
            ->limit($limit)
            ->toArray();
 
        $orderIds = array_map(function ($order) {
            return $order->id;
        }, $orders);
   
        if (!empty($orderIds)) {
           
            $orderDetails = $modelOrderDetails->find()
                ->where(['OrderDetails.order_id IN' => $orderIds])
                ->toArray();
           
        } else {
            $orderDetails = [];
        }

        $orderDateMap = [];
        foreach ($orders as $order) {
            $orderDateMap[$order->id] = $order->updated_at; 
        }
    
    
        $listDataWithUpdatedAt = [];
        $dateCounts = [];
        $currentDate = $startDate;
      
        while (date('Y-m', $currentDate) == "$year-$month") {
            $date = date('Y-m-d', $currentDate);
         
           
            $dateCounts[$date] = 0;
            $currentDate = strtotime("+1 day", $currentDate);
        }
      
   
     
        foreach ($orderDetails as $detail) {
            $updatedAt = isset($orderDateMap[$detail->order_id])
                ? date('Y-m-d', $orderDateMap[$detail->order_id])
                : 'Không xác định';
                
                
            if (isset($dateCounts[$updatedAt])) {
                $dateCounts[$updatedAt]++;
            }
            $listDataWithUpdatedAt[] = [
                'book_id' => $detail->book_id,
                'updated_at' => $updatedAt,
            ];
        }
   

        $totalData = $modelOrders->find()
            ->where(['Orders.updated_at >=' => $startDate, 'Orders.status' => 2])
            ->count();

        $totalPage = ceil($totalData / $limit);
        $back = ($page > 1) ? $page - 1 : 1;
        $next = ($page < $totalPage) ? $page + 1 : $totalPage;
        $urlPage = preg_replace('/([&?])page=\d+/', '', $urlCurrent);
        $urlPage = strpos($urlPage, '?') !== false ? $urlPage . '&page=' : $urlPage . '?page=';
    
 
        setVariable('listDataWithUpdatedAt', $listDataWithUpdatedAt);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('chartDates', array_keys($dateCounts));
        setVariable('chartCounts', array_values($dateCounts));
        setVariable('year', $year);
        setVariable('month', $month);
    }
}

function statisticalorderbookborrowten($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $user = checklogin('statisticalorderbook');
    if (!empty($user)) {
        $metaTitleMantan = 'Thống kê số lượng sách mượn nhiều nhất';

 
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelOrders = $controller->loadModel('Orders');
        $modelBooks = $controller->loadModel('Books');  
        if(!empty($user->idbuilding)){
            $idbuiding = $user->idbuilding;
        }
       
        $orders = $modelOrders->find()
            ->where(['Orders.building_id' => $idbuiding])  
            ->toArray();


        $bookBorrowCount = [];


        foreach ($orders as $order) {
            $orderDetails = $modelOrderDetails->find()
                ->where(['OrderDetails.order_id' => $order->id])
                ->toArray();

            foreach ($orderDetails as $detail) {
                $bookId = $detail->book_id;
                if (!isset($bookBorrowCount[$bookId])) {
                    $bookBorrowCount[$bookId] = 0;
                }
                $bookBorrowCount[$bookId]++;
            }
        }


        arsort($bookBorrowCount);

   
        $topBooks = array_slice($bookBorrowCount, 0, 10, true);


        $bookNames = [];
        foreach (array_keys($topBooks) as $bookId) {
            $book = $modelBooks->find()->where(['Books.id' => $bookId])->first();
            if ($book) {
                $bookNames[$bookId] = $book->name; 
            }
        }

 
        setVariable('topBooks', $topBooks);
        setVariable('urlCurrent', $urlCurrent);

      
        $bookNamesArray = array_values($bookNames);  
        $borrowCounts = array_values($topBooks);  

        setVariable('chartBookNames', json_encode($bookNamesArray)); 
        setVariable('chartBorrowCounts', json_encode($borrowCounts));  
    }
}





































?>