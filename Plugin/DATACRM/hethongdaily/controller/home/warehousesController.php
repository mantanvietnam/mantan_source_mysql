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
         if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelWarehouseProducts->find()->where($conditions)->order($order)->all()->toList();
            $titleExcel =   [
                ['name'=>'Hàng hóa', 'type'=>'text', 'width'=>25],
                ['name'=>'Số lượng', 'type'=>'text', 'width'=>25],
                ['name'=>'Giá bán', 'type'=>'text', 'width'=>25],
                ['name'=>'Xuất nhập lần cuối', 'type'=>'text', 'width'=>25],
            ];
            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                    $history = $modelWarehouseHistories->find()->where(['id_product'=>$value->id_product, 'id_member'=>$value->id_member ])->order(['id'=>'desc'])->first();
                    if(!empty($product)){
                        $dataExcel[] = [
                            @$product->title,  
                            @$value->quantity,  
                            @$product->price,  
                            @$history->note,  
                        ];
                    }
                }
            }

            export_excel($titleExcel,$dataExcel,'danh_sach_tong_kho');
        }else{

            $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->product = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
                $listData[$key]->history = $modelWarehouseHistories->find()->where(['id_product'=>$item->id_product, 'id_member'=>$item->id_member ])->order(['id'=>'desc'])->first();
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
            $infoProduct = [];
            foreach($listData as $key => $item){
                if(empty($infoProduct[$item->id_product])){
                    $infoProduct[$item->id_product] = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
                }
                
                $listData[$key]->product = $infoProduct[$item->id_product];
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
                    $listData[$key]->history = $modelWarehouseHistories->find()->where(['id_product'=>$item->id_product, 'id_member'=>$item->id_member ])->order(['id'=>'desc'])->first();
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

function editProductWarehouse($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Kho hàng đại lý';

        $modelProducts = $controller->loadModel('Products');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['idWarehouseProduct']) && isset($dataSend['number']) && !empty($dataSend['note'])){
                $checkData = $modelWarehouseProducts->find()->where(['id'=>(int) $dataSend['idWarehouseProduct'], 'id_member'=>$session->read('infoUser')->id])->first();

                if(!empty($checkData)){
                    $quantity_old = $checkData->quantity;

                    $checkData->quantity = (int) $dataSend['number'];

                    $modelWarehouseProducts->save($checkData);

                    // lưu nhật ký
                    if($checkData->quantity >= $quantity_old){
                        $type = 'plus';
                        $quantity = $checkData->quantity - $quantity_old;
                    }else{
                        $type = 'minus';
                        $quantity = $quantity_old - $checkData->quantity;
                    }

                    $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                    $saveWarehouseHistories->id_member = $session->read('infoUser')->id;
                    $saveWarehouseHistories->id_product = $checkData->id_product;
                    $saveWarehouseHistories->quantity = $quantity;
                    $saveWarehouseHistories->note = 'Chỉnh sửa số lượng hàng trong kho vì: '.$dataSend['note'];
                    $saveWarehouseHistories->create_at = time();
                    $saveWarehouseHistories->type = $type;
                    $saveWarehouseHistories->id_order_member = 0;

                    $modelWarehouseHistories->save($saveWarehouseHistories);

                    return $controller->redirect('/warehouseProductAgency/');
                }else{
                    return $controller->redirect('/warehouseProductAgency/?error=dataNotExist');
                }
            }else{
                return $controller->redirect('/warehouseProductAgency/?error=emptyData');
            }
        }else{
            return $controller->redirect('/warehouseProductAgency/?error=errorPost');
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>