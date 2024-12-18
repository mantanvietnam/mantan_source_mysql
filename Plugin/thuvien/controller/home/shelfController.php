<?php 
function listShelf($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listShelf');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách phòng';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modelWarehouse = $controller->loadModel('Warehouses');
        $modelShelf = $controller->loadModel('Shelfs');
         $conditions = array();
        if(!empty($_GET['id_room'])) {
            $conditions['id_room'] =(int) $_GET['id_room'];

            $data = $modelRoom->find()->where(['id'=>$_GET['id_room']])->first();

            if(empty($data)){
                return $controller->redirect('/');
            }

            $data->building =  $modelBuilding->find()->where(['id'=>$data->id_building])->first();
            if(empty($data->building)){
                return $controller->redirect('/');
            }
            $data->floor =  $modelFloor->find()->where(['id'=>$data->id_floor])->first();
            if(empty($data->floor)){
                return $controller->redirect('/');
            }

            $conditions['id_building'] =(int) $data->id_building;
            $conditions['id_floor'] =(int) $data->id_floor;
        }else{
             return $controller->redirect('/');
        }
        
        $order = array('id'=>'desc');

       
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }


        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
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
            $listData = $modelShelf->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        //}
        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->total_book = $modelWarehouse->find()->where(['id_shelf'=>$item->id])->count();
            }
        }
        
        // phân trang
        $totalData = $modelShelf->find()->where($conditions)->all()->toList();
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

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('data', $data);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);

        
       // / setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

function addShelf($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

     $user = checklogin('addRoom');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $mess = '';

        $metaTitleMantan = 'Thông tin phòng';
        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modelShelf = $controller->loadModel('Shelfs');

        $mess= '';
         if(!empty($_GET['id_room'])) {
            $conditions['id_room'] =(int) $_GET['id_room'];

            $checkRoom = $modelRoom->find()->where(['id'=>$_GET['id_room']])->first();

            if(empty($checkRoom)){
                return $controller->redirect('/');
            }

            $checkRoom->building =  $modelBuilding->find()->where(['id'=>$checkRoom->id_building])->first();
             if(empty($checkRoom->building)){
                return $controller->redirect('/');
            }
            $checkRoom->floor =  $modelFloor->find()->where(['id'=>$checkRoom->id_floor])->first();
            if(empty($checkRoom->floor)){
                return $controller->redirect('/');
            }
        }else{
             return $controller->redirect('/');
        }
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelShelf->find()->where(['id'=>(int) $_GET['id'],'id_room'=>$checkRoom->id])->first();

            if(empty($data)){
                return $controller->redirect('/');
            }
        }else{
            $data = $modelShelf->newEmptyEntity();
            $data->created_at = time();
            $data->id_building = $checkRoom->id_building;
            $data->id_floor = $checkRoom->id_floor;
            $data->id_room = $checkRoom->id;
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){                  
                    $data->name = @$dataSend['name'];
                    $data->description = @$dataSend['description'];
                    

                    $modelShelf->save($data);

                    if(!empty($_GET['id'])){
                        $note = $user->name.' sửa thông tin kệ '.$data->name.' phòng '.$checkRoom->name.' tầng '.$checkRoom->floor->name.' tòa nhà '.$checkRoom->building->name.' có id kệ là:'.$data->id;
                    }else{
                        $note = $user->name.' tạo kệ '.$data->name.' phòng '.$checkRoom->name.' tầng '.$checkRoom->floor->name.' tòa nhà '.$checkRoom->building->name.' có id kệ là:'.$data->id;
                    }

                    addActivityHistory($user,$note,'addShelf',$data->id);

                    return $controller->redirect('/listShelf?mess=saveSuccess&id_room='.$checkRoom->id);
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('checkRoom', $checkRoom);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteShelf($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('deleteShelf');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        
        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modeShelf = $controller->loadModel('Shelfs');
        $modelWarehouse = $controller->loadModel('Warehouses');
        if(!empty($_GET['id_room'])) {
            $conditions['id_room'] =(int) $_GET['id_room'];

            $checkRoom = $modelRoom->find()->where(['id'=>$_GET['id_room']])->first();

            if(empty($checkRoom)){
                return $controller->redirect('/');
            }

            $checkRoom->building =  $modelBuilding->find()->where(['id'=>$checkRoom->id_building])->first();
             if(empty($checkRoom->building)){
                return $controller->redirect('/');
            }
            $checkRoom->floor =  $modelFloor->find()->where(['id'=>$checkRoom->id_floor])->first();
            if(empty($checkRoom->floor)){
                return $controller->redirect('/');
            }
        }else{
             return $controller->redirect('/');
        }
        if(!empty($_GET['id'])){
            $data = $modeShelf->find()->where([ 'id'=>(int) $_GET['id'],'id_floor'=>$checkRoom->id])->first();
            
            if($data){

                $check = $modelWarehouse->find()->where(['id_shelf'=>$data->id])->first();
                if(empty($check)){
                    
                    $note = $user->name.' xóa thông tin kệ '.$data->name.' phòng '.$checkRoom->name.' tầng '.$checkRoom->floor->name.' tòa nhà '.$checkRoom->building->name.' có id kệ là:'.$data->id;
                    addActivityHistory($user,$note,'deleteShelf',$data->id);
                    $modeShelf->delete($data);

                    
                     return $controller->redirect('/listShelf?mess=deleteSuccess&id_room='.$checkRoom->id);
                 }
            }
        }
         return $controller->redirect('/listShelf?mess=deleteError&id_room='.$checkRoom->id);
    }else{
        return $controller->redirect('/login');
    }
}
 ?>