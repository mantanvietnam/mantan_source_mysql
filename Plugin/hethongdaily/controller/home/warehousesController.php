<?php 
function warehouseProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Kho hàng đại lý';

        $modelProducts = $controller->loadModel('Products');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

        $conditions = array('id_member'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id_product'])){
            $conditions['id_product'] = (int) $_GET['id_product'];
        }

        $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->product = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
                $listData[$key]->history = $modelWarehouseHistories->find()->where(['id_product'=>$item->id_product, 'id_member'=>$item->id_member ])->first();
            }
        }

        // phân trang
        $totalData = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
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
    }else{
        return $controller->redirect('/login');
    }
}

function historyWarehouseProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Lịch sử xuất nhập tồn';

        $modelProducts = $controller->loadModel('Products');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

        $conditions = array('id_member'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id_product'])){
            $conditions['id_product'] = (int) $_GET['id_product'];
        }

        $listData = $modelWarehouseHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->product = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
            }
        }

        // phân trang
        $totalData = $modelWarehouseHistories->find()->where($conditions)->all()->toList();
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
    }else{
        return $controller->redirect('/login');
    }
}

function viewWarehouseProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id_member'])){
            $metaTitleMantan = 'Kho hàng đại lý';

            $modelProducts = $controller->loadModel('Products');
            $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
            $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

            $conditions = array('id_member'=>(int) $_GET['id_member']);
            $limit = 20;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            if(!empty($_GET['id_product'])){
                $conditions['id_product'] = (int) $_GET['id_product'];
            }

            $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            

            if(!empty($listData)){
                foreach($listData as $key => $item){
                    $listData[$key]->product = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
                    $listData[$key]->history = $modelWarehouseHistories->find()->where(['id_product'=>$item->id_product, 'id_member'=>$item->id_member ])->first();
                }
            }

            // phân trang
            $totalData = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
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
        }else{
            return $controller->redirect('/listMember');
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>