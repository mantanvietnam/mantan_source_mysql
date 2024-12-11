<?php 
function listWarehouse($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listWarehouse');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Sách trong kho';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelWarehouse = $controller->loadModel('Warehouses');
        $modelBook = $controller->loadModel('Books');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modelShelf = $controller->loadModel('Shelfs');
        
        $order = array('id'=>'desc');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_book'])){
            $conditions['id_book'] = (int) $_GET['id_book'];
        }
        if(!empty($_GET['id_building'])){
            $conditions['id_building'] = (int) $_GET['id_building'];
            $dataFloor= $modelFloor->find()->where(['id_building'=>(int)$_GET['id_building']])->all()->toList();
        }
        if(!empty($_GET['id_floor'])){
            $conditions['id_floor'] = (int) $_GET['id_floor'];
            $dataRoom= $modelRoom->find()->where(['id_floor'=>(int) $_GET['id_floor']])->all()->toList();
        }
        if(!empty($_GET['id_room'])){
            $conditions['id_room'] = (int) $_GET['id_room'];
            $dataShelf= $modelShelf->find()->where(['id_room'=>(int) $_GET['id_room']])->all()->toList();
        }
        if(!empty($_GET['id_shelf'])){
            $conditions['id_shelf'] = (int) $_GET['id_shelf'];
        }
        

       


       /* if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelBuilding->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                ['name'=>'Ngày sinh', 'type'=>'text', 'width'=>25], 
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Khóa';
                    if($value->status=='active'){ 
                        $status= 'Kích hoạt';
                    }

                    $birthday = '';
                    if(!empty($value->birthday)){
                        $birthday = date('d/m/Y',$value->birthday);
                    }

                    $dataExcel[] = [
                        $value->full,   
                        $value->phone,   
                        $value->address,   
                        $value->email,  
                        $status,
                        $birthday
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_t');
        }else{*/
            $listData = $modelWarehouse->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        //}

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->building = $modelBuilding->find()->where(['id'=>$item->id_building])->first();
                $listData[$key]->book = $modelBook->find()->where(['id'=>$item->id_book])->first();
                $listData[$key]->room = $modelRoom->find()->where(['id'=>$item->id_room])->first();
                $listData[$key]->floor = $modelFloor->find()->where(['id'=>$item->id_floor])->first();
                $listData[$key]->shelf = $modelShelf->find()->where(['id'=>$item->id_shelf])->first();
                $listData[$key]->quantity_warehous = $item->quantity - $item->quantity_borrow;
            }
        }

        // phân trang
        $totalData = $modelWarehouse->find()->where($conditions)->all()->toList();
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $dataBuilding = $modelBuilding->find()->where()->all()->toList();

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', @$totalData);
        setVariable('dataBuilding', @$dataBuilding);
        setVariable('dataFloor', @$dataFloor);
        setVariable('dataRoom', @$dataRoom);
        setVariable('dataShelf', @$dataShelf);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

function addWarehouse($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listWarehouse');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Nhập sánh';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelWarehouse = $controller->loadModel('Warehouses');
        $modelBook = $controller->loadModel('Books');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modelShelf = $controller->loadModel('Shelfs');
        
        $order = array('id'=>'desc');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_book'])){
            $conditions['id_book'] = (int) $_GET['id_book'];
        }
        if(!empty($_GET['id_building'])){
            $conditions['id_building'] = (int) $_GET['id_building'];
            $dataFloor= $modelFloor->find()->where(['id_building'=>(int)$_GET['id_building']])->all()->toList();
        }
        if(!empty($_GET['id_floor'])){
            $conditions['id_floor'] = (int) $_GET['id_floor'];
            $dataRoom= $modelRoom->find()->where(['id_floor'=>(int) $_GET['id_floor']])->all()->toList();
        }
        if(!empty($_GET['id_room'])){
            $conditions['id_room'] = (int) $_GET['id_room'];
            $dataShelf= $modelShelf->find()->where(['id_room'=>(int) $_GET['id_room']])->all()->toList();
        }
        if(!empty($_GET['id_shelf'])){
            $conditions['id_shelf'] = (int) $_GET['id_shelf'];
        }
        

       



            $listData = $modelWarehouse->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->building = $modelBuilding->find()->where(['id'=>$item->id_building])->first();
                $listData[$key]->book = $modelBook->find()->where(['id'=>$item->id_book])->first();
                $listData[$key]->room = $modelRoom->find()->where(['id'=>$item->id_room])->first();
                $listData[$key]->floor = $modelFloor->find()->where(['id'=>$item->id_floor])->first();
                $listData[$key]->shelf = $modelShelf->find()->where(['id'=>$item->id_shelf])->first();
                $listData[$key]->quantity_warehous = $item->quantity - $item->quantity_borrow;
            }
        }

        // phân trang
        $totalData = $modelWarehouse->find()->where($conditions)->all()->toList();
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $dataBuilding = $modelBuilding->find()->where()->all()->toList();

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', @$totalData);
        setVariable('dataBuilding', @$dataBuilding);
        setVariable('dataFloor', @$dataFloor);
        setVariable('dataRoom', @$dataRoom);
        setVariable('dataShelf', @$dataShelf);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

 ?>