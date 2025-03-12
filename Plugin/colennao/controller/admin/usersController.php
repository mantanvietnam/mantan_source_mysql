<?php

function listUserAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thành viên';
    $modelUser = $controller->loadModel('Users');
    $modelUserpeople = $controller->loadModel('Userpeople');

    $modelHistoryResultUser = $controller->loadModel('HistoryResultUsers');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    $conditions['OR'] = [
                    ['status'=>'active'],
                    ['status'=>'lock']
    ];

    if (!empty($_GET['name'])) {
        $conditions['full_name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['phone LIKE'] = '%' . $_GET['phone_number'] . '%';
    }

    if (!empty($_GET['email'])) {
        $conditions['email LIKE'] = '%' . $_GET['email'] . '%';
    }

    if (!empty($_GET['id_affsource'])) {
        $conditions['id_affsource'] =  $_GET['id_affsource'];
    }

    if (!empty($_GET['type'])) {
        $conditions['type'] = $_GET['type'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['excel']) && $_GET['excel']=='Excel'){
            $listData = $modelUser->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();
            $titleExcel =   [
                ['name'=>'ID', 'type'=>'text', 'width'=>10],
                ['name'=>'Thời gian tạo', 'type'=>'text', 'width'=>25],
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],  
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],  
            ];
            $dataExcel = [];
            if(!empty($listData)){
                
                foreach ($listData as $key => $value) {
                   
                    $dataExcel[] = [
                                    @$value->id,
                                    date('H:i d-m-Y', $value->created_at), 
                                    @$value->full_name,   
                                    @$value->phone,   
                                    @$value->email,   
                                    @$value->address,   
                            ];
                }
            }            
            export_excel($titleExcel,$dataExcel,'danh_sach_thanh_vien');
        }
        $listData = $modelUser->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
        $totalUser = $modelUser->find()->where($conditions)->all()->toList();
        $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 

        if(!empty($listData)){
            foreach($listData as $key =>$item){
                $listData[$key]->name_people = $modelUserpeople->find()->where(['id'=>$item->id_group_user])->first();

                $listData[$key]->historyResult= $modelHistoryResultUser->find()->where(['id_user'=>$item->id])->first();
                $listData[$key]->number_user= $modelUser->find()->where(['id_affsource'=>$item->id])->count();
            }
        }
        

    

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function updateStatusUserAdmin($input)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelUser->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-user-listUserAdmin');
}

function viewUserDetailAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');
    $metaTitleMantan = 'Thông tin người dùng';
    $modelUserpeople = $controller->loadModel('Userpeople');
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
    } else {
        $data = $modelUser->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        /*debug($dataSend);
        
        $del_str=str_replace($domain, '', $dataSend['avatar']);
        debug($del_str);
        die;*/


        if (!empty($dataSend['full_name'])) {
            $data->full_name = $dataSend['full_name'];
            $data->avatar = @$dataSend['avatar'];
            $data->phone = @$dataSend['phone'];
            $data->type = @$dataSend['type'];
            if(!empty($dataSend['password'])){
                $data->password = md5($dataSend['password']);
            }
            $data->status = @$dataSend['status'];
            $data->id_group_user = @$dataSend['id_group_user'];
            $data->sex = (int) $dataSend['sex']?? 1;
            //$data->birthday = (int) strtotime($dataSend['birthday']);
            $data->email = @$dataSend['email'] ?? null;
            $data->address = @$dataSend['address'] ?? null;
            $data->current_weight =  (int) @$dataSend['current_weight'];
            $deadline = explode('/', $dataSend['deadline']);
            $data->deadline = mktime(23,59,59,$deadline[1],$deadline[0],$deadline[2]);
            $data->target_weight =  (int) @$dataSend['target_weight'];
            $data->height =  (int) @$dataSend['height'];
            $modelUser->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';

        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    $userpeople = $modelUserpeople->find()->where()->all()->toList();


    if (isset($idCardFront) && isset($idCardBack) ) {
        setVariable('idCardFront', $idCardFront);
        setVariable('idCardBack', $idCardBack);
        // setVariable('car', $car); && isset($car)
    }

    if (isset($isRequestUpgrade)) {
        setVariable('isRequestUpgrade', $isRequestUpgrade);
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('userpeople', $userpeople);
}

function listhistoryResult($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thành viên';
    $modelUser = $controller->loadModel('Users');
    $modelUserpeople = $controller->loadModel('Userpeople');

    $modelQuestions = $controller->loadModel('Questions');
    $modelHistoryResultUser = $controller->loadModel('HistoryResultUsers');
    if(!empty($_GET['id'])){
        $conditions = array('id_user'=>$_GET['id']);
       
       
        $data = $modelHistoryResultUser->find()->where($conditions)->first();
        if(!empty(@$data)){       
            $data->answers = json_decode($data->answers, true);
            if(!empty($data->answers)){
                foreach($data->answers as $key => $item){
                    $questions= $modelQuestions->find()->where(['id'=>$key])->first();
                    $listQuestions = array();
                    $name = $questions->name;
                    $answers = '';
                    if($item=='a'){
                        $answers = json_decode(@$questions->answer1, true)['vi'];
                    }elseif($item=='b'){
                        $answers = json_decode(@$questions->answer2, true)['vi'];
                    }elseif($item=='c'){
                        $answers = json_decode(@$questions->answer3, true)['vi'];
                    }elseif($item=='d'){
                        $answers = json_decode(@$questions->answer4, true)['vi'];
                    }elseif($item=='e'){
                        $answers = json_decode(@$questions->answer5, true)['vi'];
                    }elseif($item=='f'){
                        $answers = json_decode(@$questions->answer6, true)['vi'];
                    }elseif($item=='g'){
                        $answers = json_decode(@$questions->answer7, true)['vi'];
                    }elseif($item=='h'){
                        $answers = json_decode(@$questions->answer8, true)['vi'];
                    } 

                    $listQuestions['questions']  = $name; 
                    $listQuestions['answers'] = $answers;

                    $data->answers[$key] = $listQuestions;

                }
            }
            $data->info = $modelUser->find()->where(['id'=>$data->id_user])->first();
            if($data->info->id_group_user){
                $data->name_people = $modelUserpeople->find()->where(['id'=>$data->info->id_group_user])->first();
            }

            setVariable('data', $data);
        }else{
            
        return $controller->redirect('/plugins/admin/colennao-view-admin-user-listUserAdmin');
        }        
    }else{
           return $controller->redirect('/plugins/admin/colennao-view-admin-user-listUserAdmin');  
    }
}

?>
