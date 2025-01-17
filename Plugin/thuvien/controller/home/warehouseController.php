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
        }else{
            $conditions['id_building'] = (int) $user->idbuilding;
            $dataFloor= $modelFloor->find()->where(['id_building'=>(int)$user->idbuilding])->all()->toList();
            $_GET['id_building'] = $user->idbuilding;
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
        

       


        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelWarehouse->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Sách', 'type'=>'text', 'width'=>25],
                ['name'=>'Toàn nhà', 'type'=>'text', 'width'=>25],
                ['name'=>'Tầng', 'type'=>'text', 'width'=>25],
                ['name'=>'Phòng', 'type'=>'text', 'width'=>25],
                ['name'=>'Kệ sách', 'type'=>'text', 'width'=>25],
                ['name'=>'Tổng SL', 'type'=>'text', 'width'=>25], 
                ['name'=>'SL dang mượn', 'type'=>'text', 'width'=>25], 
                ['name'=>'SL trong kho', 'type'=>'text', 'width'=>25], 
            ];
               

            $dataExcel = [];
            if(!empty($listData)){
                 foreach($listData as $key => $item){
                $item->building = $modelBuilding->find()->where(['id'=>$item->id_building])->first();
                $item->book = $modelBook->find()->where(['id'=>$item->id_book])->first();
                $item->room = $modelRoom->find()->where(['id'=>$item->id_room])->first();
                $item->floor = $modelFloor->find()->where(['id'=>$item->id_floor])->first();
                $item->shelf = $modelShelf->find()->where(['id'=>$item->id_shelf])->first();
                $item->quantity_warehous = $item->quantity - $item->quantity_borrow;

                    $dataExcel[] = [
                        $item->book->name,   
                        $item->building->name,   
                        $item->floor->name,
                        $item->room->name,  
                        $item->shelf->name,
                        $item->quantity,
                        $item->quantity_borrow,
                        $item->quantity_warehous,
                       
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_t');
        }else{
            $listData = $modelWarehouse->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

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

        $conditions = array();
        if($user->type=='staff'){
            if($user->id_building){
                $conditions['id IN'] =  json_decode($user->id_building, true);
            }else{
                $conditions['id'] =  0;
            }
            
        }

        $dataBuilding = $modelBuilding->find()->where($conditions)->all()->toList();

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
    global $isRequestPost;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('addWarehouse');   
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
        $modelWarehouseHistory = $controller->loadModel('WarehouseHistorys');
        
        $order = array('id'=>'desc');

        $mess = '';
        $disabled ='';
        if(!empty($_GET['id'])){
            $data = $modelWarehouse->find()->where(['id'=>(int)$_GET['id']])->first();
            if(empty($data)){
                return $controller->redirect('/listWarehouse');
            }
            $disabled='disabled';
            $data->quantity_warehous = $data->quantity - $data->quantity_borrow;
        }else{
            $data = $modelWarehouse->newEmptyEntity();
            $data->quantity = 0;
            $data->quantity_borrow = 0;
            $data->created_at = time();
        }

        if($isRequestPost){
            $dataSend = $input['request']->getData();


            if(empty($_GET['id'])){
                if(!empty($dataSend['id_building']) && !empty($dataSend['id_book']) && !empty($dataSend['id_room']) && !empty($dataSend['id_floor']) && !empty($dataSend['id_shelf']) && !empty($dataSend['quantity'])){
                    $data->id_building  = (int)$dataSend['id_building'];
                    $data->id_book  = (int)$dataSend['id_book'];
                    $data->id_room  = (int)$dataSend['id_room'];
                    $data->id_floor  = (int)$dataSend['id_floor'];
                    $data->id_shelf  = (int)$dataSend['id_shelf'];
                   $checklWarehousebuilding = $modelWarehouse->find()->where(['id_building'=>$dataSend['id_building'],'id_book'=>$dataSend['id_book']])->first();

                    if(empty($checklWarehousebuilding)){
                        $data->quantity +=  (int)$dataSend['quantity'];
                        $data->updated_at = time();
                        $modelWarehouse->save($data);

                        $building = $modelBuilding->find()->where(['id'=>$data->id_building])->first();
                        $book = $modelBook->find()->where(['id'=>$data->id_book])->first();
                        $room = $modelRoom->find()->where(['id'=>$data->id_room])->first();
                        $floor = $modelFloor->find()->where(['id'=>$data->id_floor])->first();
                        $shelf = $modelShelf->find()->where(['id'=>$data->id_shelf])->first();

                        $note = $user->name.' thêm '.$dataSend['quantity'].' quyển sách '.$book->name.' mới vào kệ '.$shelf->name.' trong phòng '.$room->name.' tầng '.$floor->name.' của tòa nhà '.$building->name.'  id là:'.$data->id;
                
                        addActivityHistory($user,$note,'addWarehouse',$data->id);

                        $history = $modelWarehouseHistory->newEmptyEntity();
                        $history->id_book = $data->id_book;
                        $history->id_warehouse = $data->id;
                        $history->id_member = $user->id;
                        $history->quantity = $dataSend['quantity'];
                        $history->type = 'plus';
                        $history->created_at = time();
                        $history->note =$note;
                        $history->id_building = $data->id_building;
                        $modelWarehouseHistory->save($history);
                    
                        return $controller->redirect('/listWarehouse?id_building='.$data->id_building.'&id_book='.$data->id_book);
                    }else{
                       $mess = 1;
                       $data = $checklWarehousebuilding;
                    }
                }else{
                     $mess = 2;
                }
                
            }else{
                if(!empty($dataSend['quantity'])){
                    if(@$_GET['type']=='plus'){
                        $data->quantity +=  (int)$dataSend['quantity'];
                        $data->updated_at = time();
                        $modelWarehouse->save($data);

                        $building = $modelBuilding->find()->where(['id'=>$data->id_building])->first();
                        $book = $modelBook->find()->where(['id'=>$data->id_book])->first();
                        $room = $modelRoom->find()->where(['id'=>$data->id_room])->first();
                        $floor = $modelFloor->find()->where(['id'=>$data->id_floor])->first();
                        $shelf = $modelShelf->find()->where(['id'=>$data->id_shelf])->first();

                        $note = $user->name.' thêm '.$dataSend['quantity'].' quyển sách '.$book->name.' mới vào kệ '.$shelf->name.' trong phòng '.$room->name.' tầng '.$floor->name.' của tòa nhà '.$building->name.'  id là:'.$data->id;
                    
                        addActivityHistory($user,$note,'addWarehouse',$data->id);    
                        $history = $modelWarehouseHistory->newEmptyEntity();
                        $history->id_book = $data->id_book;
                        $history->id_warehouse = $data->id;
                        $history->id_member = $user->id;
                        $history->quantity = $dataSend['quantity'];
                        $history->type = 'plus';
                        $history->created_at = time();
                        $history->note =$note;
                        $history->id_building = $data->id_building;
                        $modelWarehouseHistory->save($history);
                        return $controller->redirect('/listWarehouse?id_building='.$data->id_building.'&id_book='.$data->id_book);
                    }elseif(@$_GET['type']=='minus'){
                        if($data->quantity_warehous>=(int)@$dataSend['quantity']){
                            $data->quantity -=  (int)$dataSend['quantity'];
                            $data->updated_at = time();
                            $modelWarehouse->save($data);

                            $building = $modelBuilding->find()->where(['id'=>$data->id_building])->first();
                            $book = $modelBook->find()->where(['id'=>$data->id_book])->first();
                            $room = $modelRoom->find()->where(['id'=>$data->id_room])->first();
                            $floor = $modelFloor->find()->where(['id'=>$data->id_floor])->first();
                            $shelf = $modelShelf->find()->where(['id'=>$data->id_shelf])->first();

                            $note = $user->name.' hủy '.$dataSend['quantity'].' quyển sách '.$book->name.' mới vào kệ '.$shelf->name.' trong phòng '.$room->name.' tầng '.$floor->name.' của tòa nhà '.$building->name.'  id là:'.$data->id;
                        
                            addActivityHistory($user,$note,'addWarehouse',$data->id);    
                            $history = $modelWarehouseHistory->newEmptyEntity();
                            $history->id_book = $data->id_book;
                            $history->id_warehouse = $data->id;
                            $history->id_member = $user->id;
                            $history->quantity = $dataSend['quantity'];
                            $history->type = 'minus';
                            $history->created_at = time();
                            $history->note =$note;
                            $history->id_building = $data->id_building;
                            $modelWarehouseHistory->save($history);
                            return $controller->redirect('/listWarehouse?id_building='.$data->id_building.'&id_book='.$data->id_book);
                        }else{
                            $mess = 3;
                        }

                    }
                }else{
                     $mess = 2;
                }
            }

        }


        if(!empty($data->id)){
                $data->building = $modelBuilding->find()->where(['id'=>$data->id_building])->first();
                $data->book = $modelBook->find()->where(['id'=>$data->id_book])->first();
                $data->room = $modelRoom->find()->where(['id'=>$data->id_room])->first();
                $data->floor = $modelFloor->find()->where(['id'=>$data->id_floor])->first();
                $data->shelf = $modelShelf->find()->where(['id'=>$data->id_shelf])->first();
                $data->quantity_warehous = $data->quantity - $data->quantity_borrow;


            $dataFloor= $modelFloor->find()->where(['id_building'=>(int)$data->id_building])->all()->toList();

            $dataRoom= $modelRoom->find()->where(['id_floor'=>(int) $data->id_floor])->all()->toList();

            $dataShelf= $modelShelf->find()->where(['id_room'=>(int) $data->id_room])->all()->toList();

            
            $dataBuilding = $modelBuilding->find()->where()->all()->toList();
        }else{
            $dataBuilding = $modelBuilding->find()->where(['id'=>$user->idbuilding])->all()->toList();
            $dataFloor= $modelFloor->find()->where(['id_building'=>(int)$user->idbuilding])->all()->toList();
        }
        if($mess==1){
            $mess = '<p class="text-danger" style="padding: 0px 1.5em;">quyển sách '.$data->book->name.' đã có trong tòa nhà '.$data->building->name.' rồi </p>'; 
        }elseif($mess==2){
            $mess = '<p class="text-danger" style="padding: 0px 1.5em;">Thiếu dữ liệu</p>'; 
        }elseif($mess==3){
            $mess = '<p class="text-danger" style="padding: 0px 1.5em;">Số lượng hủy phải nhỏ hơn hoặc bằng số lượng sách trong kho</p>'; 
        }       
       
        $type = 'Nhập sách vào kho';
        $to = 'nhập';
        if(@$_GET['type']=='minus'){
           $type = 'hủy sách trong kho';
           $to = 'hủy';
        }

        setVariable('dataBuilding', @$dataBuilding);
        setVariable('dataFloor', @$dataFloor);
        setVariable('dataRoom', @$dataRoom);
        setVariable('dataShelf', @$dataShelf);
        setVariable('mess', $mess);
        setVariable('data', $data);
        setVariable('type', $type);
        setVariable('to', $to);
        setVariable('disabled', $disabled);
    }else{
        return $controller->redirect('/login');
    }
}

function listWarehouseHistory($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listWarehouseHistory');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Lịch sử nhập và hủy sách';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelWarehouse = $controller->loadModel('Warehouses');
        $modelBook = $controller->loadModel('Books');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modelShelf = $controller->loadModel('Shelfs');
        $modelWarehouseHistory = $controller->loadModel('WarehouseHistorys');
        
        $order = array('id'=>'desc');

        $conditions = array();
        $conditionsWarehouse = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }



        if(!empty($_GET['id_book'])){
            $conditionsWarehouse['id_book'] = (int) $_GET['id_book'];
        }
        if(!empty($_GET['id_building'])){
            $conditionsWarehouse['id_building'] = (int) $_GET['id_building'];
            $dataFloor= $modelFloor->find()->where(['id_building'=>(int)$_GET['id_building']])->all()->toList();
        }
        if(!empty($_GET['id_floor'])){
            $conditionsWarehouse['id_floor'] = (int) $_GET['id_floor'];
            $dataRoom= $modelRoom->find()->where(['id_floor'=>(int) $_GET['id_floor']])->all()->toList();
        }
        if(!empty($_GET['id_room'])){
            $conditionsWarehouse['id_room'] = (int) $_GET['id_room'];
            $dataShelf= $modelShelf->find()->where(['id_room'=>(int) $_GET['id_room']])->all()->toList();
        }
        if(!empty($_GET['id_shelf'])){
            $conditionsWarehouse['id_shelf'] = (int) $_GET['id_shelf'];
        }
        if(!empty($conditionsWarehouse)){
            $warehouses = $modelWarehouse->find()->where($conditionsWarehouse)->all()->toList();
            if(!empty($warehouses)){
                $id_warehouse = array();
                foreach($warehouses as $k => $value){
                    $id_warehouse[] = $value->id;
                }
                $conditions['id_warehouse IN'] =$id_warehouse;    
            }else{
                $conditions['id_warehouse'] = 0;
            }
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
            $listData = $modelWarehouseHistory->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        //}

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $warehouse = $modelWarehouse->find()->where(['id'=>$item->id_warehouse])->first();
                $listData[$key]->building = $modelBuilding->find()->where(['id'=>$warehouse->id_building])->first();
                $listData[$key]->book = $modelBook->find()->where(['id'=>$warehouse->id_book])->first();
                $listData[$key]->room = $modelRoom->find()->where(['id'=>$warehouse->id_room])->first();
                $listData[$key]->floor = $modelFloor->find()->where(['id'=>$warehouse->id_floor])->first();
                $listData[$key]->shelf = $modelShelf->find()->where(['id'=>$warehouse->id_shelf])->first();
                $listData[$key]->warehouse = $warehouse;
            }
        }

        // phân trang
        $totalData = $modelWarehouseHistory->find()->where($conditions)->all()->toList();
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