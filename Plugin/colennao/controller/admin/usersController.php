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

    if (isset($_GET['type']) && $_GET['type'] !== '' && is_numeric($_GET['type'])) {
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
        $domain = 'https://apis.exc-go.vn/';


        if (!empty($dataSend['full_name'])) {
            $data->full_name = $dataSend['full_name'];
            $data->avatar = @$dataSend['avatar'];
            $data->phone = @$dataSend['phone'];
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


?>
