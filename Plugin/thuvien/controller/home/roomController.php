<?php 
function listRoom($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listRoom');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách phòng';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $modelShelf = $controller->loadModel('Shelfs');
         $conditions = array();
        if(!empty($_GET['id_floor'])) {
            $conditions['id_floor'] =(int) $_GET['id_floor'];

            $data = $modelFloor->find()->where(['id'=>$_GET['id_floor']])->first();

            if(empty($data)){
                return $controller->redirect('/');
            }

            $data->building =  $modelBuilding->find()->where(['id'=>$data->id_building])->first();
             if(empty($data->building)){
                return $controller->redirect('/');
            }
             $conditions['id_building'] =(int) $data->id_building;
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
            $listData = $modelRoom->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        //}

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->total_shelf = $modelShelf->find()->where(['id_room'=>$item->id])->count();
            }
        }

        // phân trang
        $totalData = $modelRoom->find()->where($conditions)->all()->toList();
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

function addRoom($input)
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

        $mess= '';
         if(!empty($_GET['id_floor'])) {
            $conditions['id_floor'] =(int) $_GET['id_floor'];

            $checkFloor = $modelFloor->find()->where(['id'=>$_GET['id_floor']])->first();

            if(empty($checkFloor)){
                return $controller->redirect('/');
            }

            $checkFloor->building =  $modelBuilding->find()->where(['id'=>$checkFloor->id_building])->first();
             if(empty($checkFloor->building)){
                return $controller->redirect('/');
            }
             $conditions['id_building'] =(int) $checkFloor->id_building;
        }else{
             return $controller->redirect('/');
        }
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelRoom->find()->where(['id'=>(int) $_GET['id'],'id_floor'=>$checkFloor->id])->first();

            if(empty($data)){
                return $controller->redirect('/');
            }
        }else{
            $data = $modelRoom->newEmptyEntity();
            $data->created_at = time();
            $data->id_building = $checkFloor->id_building;
            $data->id_floor = $checkFloor->id;
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){                  
                    $data->name = @$dataSend['name'];
                    $data->description = @$dataSend['description'];
                    

                    $modelRoom->save($data);

                    if(!empty($_GET['id'])){
                        $note = $user->name.' sửa thông tin phòng '.$data->name.' tầng '.$checkFloor->name.' tòa nhà '.$checkFloor->building->name.' có id phòng là:'.$data->id;
                    }else{
                        $note = $user->name.' tạo  phòng '.$data->name.' tầng '.$checkFloor->name.' tòa nhà '.$checkFloor->building->name.' có id phòng là:'.$data->id;
                    }

                    addActivityHistory($user,$note,'addRoom',$data->id);

                    return $controller->redirect('/listRoom?mess=saveSuccess&id_floor='.$checkFloor->id);
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('checkFloor', $checkFloor);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteRoom($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('deleteRoom');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        
        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        if(!empty($_GET['id_floor'])) {
            $conditions['id_floor'] =(int) $_GET['id_floor'];

            $checkFloor = $modelFloor->find()->where(['id'=>$_GET['id_floor']])->first();

            if(empty($checkFloor)){
                return $controller->redirect('/');
            }

            $checkFloor->building =  $modelBuilding->find()->where(['id'=>$checkFloor->id_building])->first();
             if(empty($checkFloor->building)){
                return $controller->redirect('/');
            }
             $conditions['id_building'] =(int) $checkFloor->id_building;
        }else{
             return $controller->redirect('/');
        }
        if(!empty($_GET['id'])){
            $data = $modelRoom->find()->where([ 'id'=>(int) $_GET['id'],'id_floor'=>$checkFloor->id])->first();
            
            if($data){
                $note = $user->name.' xóa thông tin phòng '.$data->name.' tầng '.$checkFloor->name.' tòa nhà '.$checkFloor->building->name.' có id phòng là:'.$data->id;
                addActivityHistory($user,$note,'deleteRoom',$data->id);
                $modelRoom->delete($data);

                
                 return $controller->redirect('/listRoom?mess=deleteSuccess&id_floor='.$checkFloor->id);
            }
        }
         return $controller->redirect('/listRoom?mess=deleteError&id_floor='.$checkFloor->id);
    }else{
        return $controller->redirect('/login');
    }
}

?>