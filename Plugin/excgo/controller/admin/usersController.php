<?php

function listUserAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thành viên';
    $modelUser = $controller->loadModel('Users');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['phone_number LIKE'] = '%' . $_GET['phone_number'] . '%';
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
                ['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],  
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],  
                ['name'=>'Số tiền', 'type'=>'text', 'width'=>25],  
                ['name'=>'Loại tài khoản', 'type'=>'text', 'width'=>25],  
                ['name'=>'Ngàn hàng', 'type'=>'text', 'width'=>25],  
                ['name'=>'Số tài khoản ngân hàng', 'type'=>'text', 'width'=>25],  
            ];
            $dataExcel = [];
            if(!empty($listData)){
                
                foreach ($listData as $key => $value) {
                    if ($value->type == 0) {
                        $type = 'Người dùng';
                    } else {
                        $type = 'Tài xế';
                    }
                    
                    $dataExcel[] = [
                                    @$value->id,
                                    $value->created_at->format('H:i d-m-Y'), 
                                    @$value->name,   
                                    @$value->phone_number,   
                                    @$value->email,   
                                    @$value->address,   
                                    number_format(@$value->total_coin),   
                                    @$type,   
                                    @$value->bank_account,   
                                    @$value->account_number,   
                            ];
                }
            }            
            export_excel($titleExcel,$dataExcel,'danh_sach_thanh_vien');
        }
        $listData = $modelUser->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
        $totalUser = $modelUser->find()->where($conditions)->all()->toList();
        $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 
        

    

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

    return $controller->redirect('/plugins/admin/excgo-view-admin-user-listUserAdmin');
}

function viewUserDetailAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');
    $modelImage = $controller->loadModel('Images');
    $modelDriverRequest = $controller->loadModel('DriverRequests');
    $metaTitleMantan = 'Thông tin người dùng';
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
        $idCardFront = $modelImage->find()
            ->where([
                'owner_id' => $_GET['id'],
                'owner_type' => 'users',
                'type' => 'id-card-front'
            ])->first();
        $idCardBack = $modelImage->find()
            ->where([
                'owner_id' => $_GET['id'],
                'owner_type' => 'users',
                'type' => 'id-card-back'
            ])->first();
        $car = $modelImage->find()
            ->where([
                'owner_id' => $_GET['id'],
                'owner_type' => 'users',
                'type' => 'car'
            ])->all();

        $isRequestUpgrade = $modelDriverRequest->find()
            ->where(['user_id' => $_GET['id']])
            ->where(['status' => 0])
            ->first();
    } else {
        $data = $modelUser->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        /*debug($dataSend);
        $domain = 'https://apis.exc-go.vn//';
        $del_str=str_replace($domain, '', $dataSend['avatar']);
        debug($del_str);
        die;*/


        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            $data->avatar = $dataSend['avatar'];
            $data->phone_number = $dataSend['phone_number'];
            $data->status = $dataSend['status'];
            $data->type = $dataSend['type'];
            $data->email = $dataSend['email'];
            $data->maximum_trip = (int) $dataSend['maximum_trip'];

            $modelUser->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';




            if (!empty($_GET['id'])) {
                $data = $modelUser->find()->where(['id' => (int)$_GET['id']])->first();
                if(!empty($dataSend['idCardFront'])){
                    $idCardFront = $modelImage->find()->where(['owner_id' => $_GET['id'], 'owner_type' => 'users', 'type' => 'id-card-front'])->first();
                    if(!empty($idCardFront)){
                        $idCardFront->path = $dataSend['idCardFront'];
                        $modelImage->save($idCardFront);
                    }else{
                        $idCardFront = $modelImage->newEmptyEntity();
                        $idCardFront->path = $dataSend['idCardFront'];
                        $idCardFront->local_path =str_replace($domain, '', $dataSend['idCardFront']);
                        $idCardFront->type = 'users';
                        $idCardFront->owner_id =$_GET['id'];
                        $idCardFront->owner_type = 'id-card-front';
                        $modelImage->save($idCardFront);
                    }
                }
                if(!empty($dataSend['idCardBack'])){
                    $idCardBack = $modelImage->find()->where(['owner_id' => $_GET['id'], 'owner_type' => 'users', 'type' => 'id-card-back'])->first();
                    if(!empty($idCardBack)){
                        $idCardBack->path = $dataSend['idCardBack'];
                        $modelImage->save($idCardBack);
                    }else{
                        $idCardBack = $modelImage->newEmptyEntity();
                        $idCardBack->path = $dataSend['idCardBack'];
                        $idCardBack->local_path =str_replace($domain, '', $dataSend['idCardBack']);
                        $idCardBack->type = 'users';
                        $idCardBack->owner_id =$_GET['id'];
                        $idCardBack->owner_type = 'id-card-back';
                        $modelImage->save($idCardBack);
                    }
                }


                $car = $modelImage->deleteAll([ 'owner_id' => $_GET['id'], 'owner_type' => 'users', 'type' => 'car']);
                $domain = 'https://apis.exc-go.vn//';
                if(!empty($dataSend['car'])){
                    foreach($dataSend['car'] as $key => $item){
                        if(!empty($item)){
                            $save = $modelImage->newEmptyEntity();
                            $save->path = $item;
                            $save->local_path =str_replace($domain, '', $item);
                            $save->type = 'car';
                            $save->owner_id =$_GET['id'];
                            $save->owner_type = 'users';
                            $modelImage->save($save);
                        }
                        
                    }
                }
                $car = $modelImage->find()->where(['owner_id' => $_GET['id'],'owner_type' => 'users','type' => 'car'])->all();

            }
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }

    if (isset($idCardFront) && isset($idCardBack) && isset($car)) {
        setVariable('idCardFront', $idCardFront);
        setVariable('idCardBack', $idCardBack);
        setVariable('car', $car);
    }

    if (isset($isRequestUpgrade)) {
        setVariable('isRequestUpgrade', $isRequestUpgrade);
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function listUpgradeRequestToDriverAdmin($input)
{
    global $controller;

    $modelDriverRequest = $controller->loadModel('DriverRequests');
    $modelUser = $controller->loadModel('Users');

    $conditions = [];
    
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;


    $conditions['DriverRequests.status'] = 0;
    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['DriverRequests.status'] = $_GET['status'];
    } 


    if (!empty($_GET['name'])) {
        $conditions['us.name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['us.phone_number LIKE'] = '%' . $_GET['phone_number'] . '%';
    }

    if (!empty($_GET['email'])) {
        $conditions['us.email LIKE'] = '%' . $_GET['email'] . '%';
    }

    if (isset($_GET['type']) && $_GET['type'] !== '' && is_numeric($_GET['type'])) {
        $conditions['us.type'] = $_GET['type'];
    }

    $listData = $modelDriverRequest->find()->select(['DriverRequests.id','us.id','us.name', 'us.phone_number', 'us.email', 'us.avatar','us.total_coin','us.address','DriverRequests.created_at'])->join([
                            'table' => 'users',
                            'alias' => 'us',
                            'type' => 'INNER',
                            'conditions' => 'us.id = DriverRequests.user_id',
                        ])->limit($limit)->page($page)->where($conditions)->order(['DriverRequests.created_at' => 'desc'])->all()->toList();
       

    $totalUser = count($modelDriverRequest->find()->join([
                            'table' => 'users',
                            'alias' => 'us',
                            'type' => 'INNER',
                            'conditions' => 'us.id = DriverRequests.user_id',
                        ])->where($conditions)->all()->toList());

    $paginationMeta = createPaginationMetaData($totalUser, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function acceptUpgradeToDriverAdmin($input)
{
    global $controller;
    global $memberType;

    $modelUser = $controller->loadModel('Users');
    $modelDriverRequest = $controller->loadModel('DriverRequests');
    $notificationModel = $controller->loadModel('Notifications');

    if (!empty($_GET['id'])) {
        $user = $modelUser->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($user) {
            $user->type = $memberType['driver'];
            $modelUser->save($user);

            $request = $modelDriverRequest->find()
                ->where(['user_id' => $_GET['id']])
                ->first();
            $request->status = 1;
            $request->handled_by = 1;
            $modelDriverRequest->save($request);

            if ($user->device_token) {
                $title = 'Yêu cầu nâng cấp tài khoản được chấp nhận';
                $content = 'Yêu cầu nâng cấp tài khoản thành tài xế của bạn đã được chấp nhận';
                $dataSendNotification= array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'upgradeToDriverSuccess'
                );

                $newNotification = $notificationModel->newEmptyEntity();
                $newNotification->user_id = $user->id;
                $newNotification->title = $title;
                $newNotification->content = $content;
                $newNotification->created_at = date('Y-m-d H:i:s');
                $newNotification->updated_at = date('Y-m-d H:i:s');
                $notificationModel->save($newNotification);
                sendNotification($dataSendNotification, $user->device_token);
            }
        }

        return $controller->redirect("/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=$user->id");
    }
}

function listWithdrawRequestAdmin($input)
{
    global $controller;
    global $withdrawRequestStatus;

    $withdrawRequestModel = $controller->loadModel('WithdrawRequests');
    $conditions = [];
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $query = $withdrawRequestModel->find()
        ->join([
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'LEFT',
                'conditions' => [
                    'WithdrawRequests.user_id = Users.id',
                ],
            ],
        ]);

    if (!empty($_GET['user_id'])) {
        $conditions['Users.id'] = $_GET['user_id'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['WithdrawRequests.status'] = $_GET['status'];
    } else {
        $conditions['WithdrawRequests.status'] = $withdrawRequestStatus['pending'];
    }

    if (!empty($_GET['name'])) {
        $conditions['Users.name LIKE'] =  '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['Users.phone_number'] = $_GET['phone_number'];
    }

    if (!empty($_GET['email'])) {
        $conditions['Users.email'] = $_GET['email'];
    }

    $requestList = $query->select([
            'Users.id',
            'Users.name',
            'Users.avatar',
            'Users.total_coin',
            'Users.phone_number',
            'Users.bank_account',
            'Users.account_number',
            'Users.email',
            'WithdrawRequests.id',
            'WithdrawRequests.amount',
            'WithdrawRequests.status',
            'WithdrawRequests.created_at',
        ])->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['WithdrawRequests.created_at' => 'DESC'])
        ->all()
        ->toList();
    $totalRequest = $query->where($conditions)->count();
    $paginationMeta = createPaginationMetaData($totalRequest, $limit, $page);

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $requestList);
}

function updateStatusWithdrawRequestAdmin($input)
{
    global $controller;
    global $withdrawRequestStatus;
    global $transactionType;

    $withdrawRequestModel = $controller->loadModel('WithdrawRequests');
    $userModel = $controller->loadModel('Users');
    $transactionModel = $controller->loadModel('Transactions');
    $notificationModel = $controller->loadModel('Notifications');

    if (!empty($_GET['id'])) {
        $request = $withdrawRequestModel->find()
            ->where([
                'id' => $_GET['id']
            ])->first();

        $user = $userModel->find()
            ->where([
                'id' => $request->user_id
            ])->first();

        if ($request && isset($_GET['status'])) {
            $request->status = $_GET['status'];
            $withdrawRequestModel->save($request);

            if($_GET['status']==1){
                $user->total_coin -= $request->amount;
                $userModel->save($user);

                // Save transaction
                $newTransaction = $transactionModel->newEmptyEntity();
                $newTransaction->user_id = $user->id;
                $newTransaction->amount = $request->amount;
                $newTransaction->type = $transactionType['subtract'];
                $newTransaction->name = 'Rút tiền EXC-xu thành công';
                $newTransaction->description = '-' . number_format($request->amount) . ' EXC-xu';
                $newTransaction->created_at = date('Y-m-d H:i:s');
                $newTransaction->updated_at = date('Y-m-d H:i:s');
                $transactionModel->save($newTransaction);

                if ($user->device_token && (int)$_GET['status'] === $withdrawRequestStatus['done']) {
                    $title = 'Rút tiền thành công EXC-GO';
                    $content = 'Rút tiền thành công '.number_format($request->amount).'đ từ tài khoản ' . $user->phone_number;
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'withdrawMoneySuccess'
                    );

                    $newNotification = $notificationModel->newEmptyEntity();
                    $newNotification->user_id = $user->id;
                    $newNotification->title = $title;
                    $newNotification->content = $content;
                    $newNotification->created_at = date('Y-m-d H:i:s');
                    $newNotification->updated_at = date('Y-m-d H:i:s');
                    $notificationModel->save($newNotification);
                    sendNotification($dataSendNotification, $user->device_token);
                }
            }else{
                if($user->device_token) {
                    $title = 'Rút tiền không thành công EXC-GO';
                    $content = 'Bạn không đủ điều kiện để rút tiền';
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'withdrawMoneySuccess'
                    );

                    $newNotification = $notificationModel->newEmptyEntity();
                    $newNotification->user_id = $user->id;
                    $newNotification->title = $title;
                    $newNotification->content = $content;
                    $newNotification->created_at = date('Y-m-d H:i:s');
                    $newNotification->updated_at = date('Y-m-d H:i:s');
                    $notificationModel->save($newNotification);
                    sendNotification($dataSendNotification, $user->device_token);
                }
            }
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-withdrawRequest-listWithdrawRequestAdmin');
}

function updateUserCoinAdmin($input)
{
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $metaTitleMantan;

    $userModel = $controller->loadModel('Users');
    $notificationModel = $controller->loadModel('Notifications');
    $transactionModel = $controller->loadModel('Transactions');
    $metaTitleMantan = 'Thông tin người dùng';
    $mess = '';

    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        $user = $userModel->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($isRequestPost && $user) {
            $dataSend = $input['request']->getData();
            if (!empty($dataSend['coin']) && !empty($dataSend['note'])) {
                $newTransaction = $transactionModel->newEmptyEntity();

                if ($_GET['type'] === 'plus') {
                    $user->total_coin += $dataSend['coin'];
                    $newTransaction->user_id = $user->id;
                    $newTransaction->amount = $dataSend['coin'];
                    $newTransaction->type = $transactionType['add'];
                    $newTransaction->name = 'Admin cộng coin cho người dùng';
                    $newTransaction->description = $dataSend['note'];
                    $newTransaction->created_at = date('Y-m-d H:i:s');
                    $newTransaction->updated_at = date('Y-m-d H:i:s');

                    $userModel->save($user);
                    $transactionModel->save($newTransaction);

                    $title = 'Tài khoản của bạn đã được cộng coin';
                    $content = "Tài khoản của bạn đã được cộng $newTransaction->amount coin bởi admin";
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'plusCoinSuccess'
                    );
                } else if ($_GET['type'] === 'minus') {
                    $user->total_coin -= $dataSend['coin'];
                    $newTransaction->user_id = $user->id;
                    $newTransaction->amount = $dataSend['coin'];
                    $newTransaction->type = $transactionType['subtract'];
                    $newTransaction->name = 'Admin trừ coin của người dùng';
                    $newTransaction->description = $dataSend['note'];
                    $newTransaction->created_at = date('Y-m-d H:i:s');
                    $newTransaction->updated_at = date('Y-m-d H:i:s');

                    $userModel->save($user);
                    $transactionModel->save($newTransaction);

                    $title = 'Tài khoản của bạn đã bị trừ coin';
                    $content = "Tài khoản của bạn đã bị trừ $newTransaction->amount coin bởi admin";
                    $dataSendNotification= array(
                        'title' => $title,
                        'time' => date('H:i d/m/Y'),
                        'content' => $content,
                        'action' => 'minusCoinSuccess'
                    );
                }

                // Gửi thông báo tới người dùng
                if (!empty($newTransaction)) {
                    $newNotification = $notificationModel->newEmptyEntity();
                    $newNotification->user_id = $user->id;
                    $newNotification->title = $title ?? '';
                    $newNotification->content = $content ?? '';
                    $newNotification->created_at = date('Y-m-d H:i:s');
                    $newNotification->updated_at = date('Y-m-d H:i:s');
                    $notificationModel->save($newNotification);
                    sendNotification($dataSendNotification ?? [], $user->device_token);
                }

                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            } else {
                $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
            }
        }
    } else {
        $user = $userModel->newEmptyEntity();
    }

    setVariable('data', $user);
    setVariable('mess', $mess);
}

function blockUserProvince($input){
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Block thành viên trong Khu vực';
    $modelUser = $controller->loadModel('Users');
    $modelBlockUserProvinces = $controller->loadModel('BlockUserProvinces');
    $modelProvinces = $controller->loadModel('Provinces');
    $mess = '';
    $listProvince = $modelProvinces->find()->where(['parent_id' => 0, 'status' => 1])->order(['id'=>"asc"])->all()->toList();
    if(!empty($_GET['id'])){
        $user = $modelUser->find()->where(['id'=>(int)$_GET['id']])->first();
        if(!empty($_GET['id'])){

        }else{
            return $controller->redirect('/plugins/admin/excgo-view-admin-user-listUserAdmin');
        }
    }else{
        return $controller->redirect('/plugins/admin/excgo-view-admin-user-listUserAdmin');
    }
    
    // $listBlock = $modelBlockUserProvinces->find()->where(['user_id'=>(int)$_GET['id']])->all()->toList();


    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['province_id'])){
            $conditions = ['user_id'=>$user->id];
            $modelBlockUserProvinces->deleteAll($conditions);

            foreach ($dataSend['province_id'] as $province_id) {
                $block = $modelBlockUserProvinces->newEmptyEntity();

                $block->province_id = $province_id;
                $block->user_id = $user->id;

                $modelBlockUserProvinces->save($block); 
            }
        }else{
            $conditions = ['user_id'=>$user->id];
            $modelBlockUserProvinces->deleteAll($conditions);
        }


        $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $listBlock = [];
    if(!empty($user->id)){
        $Block = $modelBlockUserProvinces->find()->where(['user_id'=>$user->id])->all()->toList();

        if(!empty($Block)){
            foreach ($Block as $check) {
                $listBlock[] = $check->province_id;
            }
        }
    }

    if(!empty($listProvince)){
        foreach($listProvince as $key => $item){
            $listProvince[$key]->lower = $modelProvinces->find()->where(['parent_id' => $item->id, 'status' => 1])->order(['id'=>"asc"])->all()->toList();
        }
    }

    // debug($listBlock);
    // die();

    setVariable('mess', $mess);
    setVariable('listProvince', $listProvince);
    setVariable('user', $user);
    setVariable('listBlock', $listBlock);
}

function listUserStatisticAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thành viên';
    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['phone_number LIKE'] = '%' . $_GET['phone_number'] . '%';
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

    $listData = $modelUser->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['id' => 'desc'])
        ->all()
        ->toList();
    $totalUser = $modelUser->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalUser),
        $limit,
        $page
    );

    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->received = count($modelBooking->find()->where(array('received_by'=>$item->id,'status'=>3))->all()->toList());
            $listData[$key]->posted = count($modelBooking->find()->where(array('posted_by'=>$item->id,'status'=>3))->all()->toList());
        }
    }

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}
?>
