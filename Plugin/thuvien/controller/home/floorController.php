<?php 
function listFloor($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listFloor');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách tầng';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        $modelRoom = $controller->loadModel('Rooms');
        $conditions = array();
        
     
        if(!empty($_GET['id_building'])) {
            if($user->type=='staff'){
                $id_building = json_decode($user->id_building, true);
                if(!empty($id_building) && in_array((int)$_GET['id_building'], $id_building, true)){

                    $conditions['id_building'] =(int) $_GET['id_building'];

                    $data = $modelBuilding->find()->where(['id'=>$_GET['id_building']])->first();

                    if(empty($data)){
                        return $controller->redirect('/');
                    }
                }else{
                    return $controller->redirect('/');
                }
            }else{
                $conditions['id_building'] =(int) $_GET['id_building'];

                $data = $modelBuilding->find()->where(['id'=>$_GET['id_building']])->first();

                if(empty($data)){
                    return $controller->redirect('/');
                }
            }
        }else{
             $conditions['id_building'] = $user->idbuilding;
             $data = $modelBuilding->find()->where(['id'=>$user->idbuilding])->first();
            
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
            $listData = $modelFloor->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        //}

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->total_room = $modelRoom->find()->where(['id_floor'=>$item->id])->count();
            }
        }

        // phân trang
        $totalData = $modelFloor->find()->where($conditions)->all()->toList();
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

function addFloor($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

     $user = checklogin('addFloor');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $mess = '';

        $metaTitleMantan = 'Thông tin tâng';
        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        if(!empty($_GET['id_building'])) {

            $checkBuilding = $modelBuilding->find()->where(['id'=>$_GET['id_building']])->first();

                if(empty($checkBuilding)){
                    return $controller->redirect('/');
                }


        }else{
             return $controller->redirect('/');
        }
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelFloor->find()->where(['id'=>(int) $_GET['id'],'id_building'=>$checkBuilding->id])->first();

            if(empty($data)){
                return $controller->redirect('/');
            }
        }else{
            $data = $modelFloor->newEmptyEntity();
            $data->created_at = time();
            $data->id_building = $checkBuilding->id;
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){                  
                    $data->name = @$dataSend['name'];
                    $data->description = @$dataSend['description'];
                    

                    $modelFloor->save($data);

                    if(!empty($_GET['id'])){
                        $note = $user->name.' sửa thông tin tầng '.$data->name.' tòa nhà '.$checkBuilding->name.' có id tầng là:'.$data->id;
                    }else{
                        $note = $user->name.' tạo  tầng '.$data->name.' tòa nhà '.$checkBuilding->name.' có id tầng là:'.$data->id;
                    }

                    addActivityHistory($user,$note,'addFloor',$data->id);

                    return $controller->redirect('/listFloor?mess=saveSuccess&id_building='.$checkBuilding->id);
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('checkBuilding', $checkBuilding);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteFloor($input){
      global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('deleteFloor');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        if(!empty($_GET['id_building'])) {

            $checkBuilding = $modelBuilding->find()->where(['id'=>$_GET['id_building']])->first();

                if(empty($checkBuilding)){
                    return $controller->redirect('/');
                }
        }else{
             return $controller->redirect('/');
        }
        if(!empty($_GET['id'])){
            $data = $modelFloor->find()->where([ 'id'=>(int) $_GET['id'],'id_building'=>$checkBuilding->id])->first();
            
            if($data){
                $note = $user->name.' xóa thông tin tòa nhà '.$data->name.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteFloor',$data->id);
                $modelFloor->delete($data);

                
                 return $controller->redirect('/listFloor?mess=deleteSuccess&id_building='.$checkBuilding->id);
            }
        }
         return $controller->redirect('/listFloor?mess=deleteError&id_building='.$checkBuilding->id);
    }else{
        return $controller->redirect('/login');
    }
}

?>