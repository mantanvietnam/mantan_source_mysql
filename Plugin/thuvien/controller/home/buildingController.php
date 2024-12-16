<?php 
function listBuilding($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listBuilding');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelBuilding = $controller->loadModel('Buildings');
        $modelFloor = $controller->loadModel('Floors');
        
        $order = array('id'=>'desc');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        



        if($user->type=='staff'){
            if($user->id_building){
                $conditions['id IN'] =  json_decode($user->id_building, true);
            }else{
                $conditions['id'] =  0;
            }
            
        }else{
            if(!empty($_GET['id'])){
                $conditions['id'] = (int) $_GET['id'];
            }
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['phone'] = $_GET['phone'];
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
            $listData = $modelBuilding->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        //}

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->total_floor = $modelFloor->find()->where(['id_building'=>$item->id])->count();
            }
        }

        // phân trang
        $totalData = $modelBuilding->find()->where($conditions)->all()->toList();
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
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

function addBuilding($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

     $user = checklogin('addBuilding');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $mess = '';

        $metaTitleMantan = 'Thông tin nhân viên';
        $modelBuilding = $controller->loadModel('Buildings');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelBuilding->find()->where(['id'=>(int) $_GET['id']])->first();

            if(empty($data)){
                return $controller->redirect('/listBuilding');
            }
        }else{
            $data = $modelBuilding->newEmptyEntity();
            $data->created_at = time();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $conditions = ['phone'=>$dataSend['phone']];
                $checkPhone = $modelBuilding->find()->where($conditions)->first();

                if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
                  

                  
                    
                    $data->name = @$dataSend['name'];
                    $data->address = @$dataSend['address'];
                    $data->phone = @$dataSend['phone'];
                    $data->description = @$dataSend['description'];
                    

                    $modelBuilding->save($data);

                    if(!empty($_GET['id'])){
                        $note = $user->name.' sửa thông tin tòa nhà '.$data->name.'('.$data->phone.') có id là:'.$data->id;
                    }else{
                        $note = $user->name.' tạo tòa nhà '.$data->name.'('.$data->phone.') có id là:'.$data->id;
                    }


                    addActivityHistory($user,$note,'addBuilding',$data->id);

                     return $controller->redirect('/listBuilding?mess=saveSuccess');
                }else{
                    $mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
                }
            
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteBuilding($input){
      global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('deleteBuilding');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
         $modelBuilding = $controller->loadModel('Buildings');
        if(!empty($_GET['id'])){
            $data = $modelBuilding->find()->where([ 'id'=>(int) $_GET['id']])->first();
            
            if($data){
                $note = $user->name.' xóa thông tin tòa nhà '.$data->name.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteBuilding',$data->id);
                $modelBuilding->delete($data);

                
                 return $controller->redirect('/listBuilding?mess=deleteSuccess');
            }
        }
         return $controller->redirect('/listBuilding?mess=deleteError');
    }else{
        return $controller->redirect('/login');
    }
}

?>