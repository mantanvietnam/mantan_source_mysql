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
function statisticalorderbook($input) {
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;

    $user = checklogin('statisticalorderbook');
    if (!empty($user)) {
        $metaTitleMantan = 'Thống kê số lượng sách mượn nhiều nhất';
        $modelmembers = $controller->loadModel('members');
        $modelwarehouses = $controller->loadModel('warehouses');
        $modelbooks = $controller->loadModel('books');
        $modelbuiding = $controller->loadModel('buildings');
        $modelOrders = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        
        $conditions = array();
        if (!empty($_GET['id'])) {
            $conditions['book_id'] = (int)$_GET['id'];
        }

        // Cập nhật truy vấn phân trang
        $limit = 8;
        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        // Sử dụng phương thức page() và limit() của CakePHP
        $query = $modelOrderDetails->find();
        $query->select(['book_id', 'count' => $query->func()->count('book_id')])
              ->where($conditions)
              ->group('book_id')
              ->order(['count' => 'desc'])
              ->limit($limit)
              ->page($page);

        $listData = $query->all()->toList();
        
        // Tính toán tổng số bản ghi và tổng số trang
        $totalData = count($modelOrderDetails->find()->where($conditions)->group('book_id')->all()->toList());
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
        $listDataWithBookNames = [];
        $maxQuantity = 0;
        $maxBookName = '';

        foreach ($listData as $data) {
            $book = $modelbooks->find()->where(['id' => $data->book_id])->first();
            $bookName = $book ? $book->name : 'Không tên';  
            $quantity = $data->count;

            // Cập nhật quyển sách mượn nhiều nhất
            if ($quantity > $maxQuantity) {
                $maxQuantity = $quantity;
                $maxBookName = $bookName;
            }

            $listDataWithBookNames[] = [
                'book_name' => $bookName,  
                'quantity' => $quantity,
            ];
        }

        // Truyền biến vào view
        setVariable('maxBookName', $maxBookName);
        setVariable('maxQuantity', $maxQuantity);
        setVariable('listDataWithBookNames', $listDataWithBookNames);
        setVariable('building', $building);
        setVariable('listData', $listData);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
    }
}





?>