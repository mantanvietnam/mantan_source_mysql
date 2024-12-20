<?php 
function listRewardAdmin($input){
	global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách phần thưởng';
    $modelReward = $controller->loadModel('Rewards');

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

    $listData = $modelReward->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['id' => 'desc'])
        ->all()
        ->toList();
    $totalReward = $modelReward->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalReward),
        $limit,
        $page
    );

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);

}

function addRewardAdmin($input){
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
   

    $metaTitleMantan = 'Thông tin phần thưởng';
    $modelReward = $controller->loadModel('Rewards');
    $conditions = array();
    $modelUser = $controller->loadModel('Users');
    $modelNotification = $controller->loadModel('Notifications');

	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelReward->get( (int) $_GET['id']);

    }else{
        $data = $modelReward->newEmptyEntity();
        $data->created_at = time();
    }

    // Tạo subquery để tìm giá trị point_min cao nhất
        $subquery = $modelReward->find();
        $subquery->select(['max_end_date' => $subquery->func()->max('end_date')]);
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name']) && !empty($dataSend['image']) && !empty($dataSend['type']) && !empty($dataSend['content'])){
	        // tạo dữ liệu save
            $data->name = @$dataSend['name'];
             if(!empty($dataSend['start_date'])){
                $date_start = explode('/', $dataSend['start_date']);
                $start_date = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            }

            if(!empty($dataSend['end_date'])){
                $date_end = explode('/', $dataSend['end_date']);
                $end_date = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                    
            }
            if(!empty($_GET['id'])){
                $conditions =array('end_date' => $subquery, 'id !='=>$data->id);
            }else{
                 $conditions =array('end_date' => $subquery);
            }
            $query = $modelReward->find()->where($conditions)->first();
            $time= 0;
            if(!empty($query->end_date)){
                $time = $query->end_date;
            }
            if($start_date > $time){
                if($start_date < $end_date){
                    $data->updated_at = time();
                    $data->quantity_booking = (int) @$dataSend['quantity_booking'];
                    $data->money = (int) @$dataSend['money'];
                    $data->type = (int) @$dataSend['type'];
                    $data->status =(int) @$dataSend['status'];
                    $data->note = @$dataSend['note'];
                    $data->image = @$dataSend['image'];
                    $data->content = @$dataSend['content'];
                    $data->contentnotification = @$dataSend['contentnotification'];
                    $data->end_date = @$end_date;
                    $data->start_date = @$start_date;

                    $bonu = [];
                    if(!empty($dataSend['soluong_cuoc'])){
                        foreach($dataSend['soluong_cuoc'] as $key => $item){
                         $bonu[]=['soluong_cuoc' =>(int)$item,
                           'tien_thuong' =>(int)@$dataSend['tien_thuong'][$key],
                            ];
                        }
                    }

                    $data->bonu = json_encode(@$bonu);   
                   
        	        $modelReward->save($data);

                    if(!empty($dataSend['checkNotification']) && !empty($data->id)){
                        $conditions = array();
                        $conditions['device_token IS NOT'] = null;
                        $listUser = $modelUser->find()->where($conditions)->all()->toList();

                        if(!empty($listUser)){
                            $title = 'Thông báo chương trình thưởng mới';
                            if(!empty($dataSend['contentnotification'])){
                                $content = $dataSend['contentnotification'];
                            }else{
                                $content = 'Tham gia ngay để nhận phần thưởng lớn.!';
                            }
                            
                            $number = 0;
                            $device_token = [];

                            foreach ($listUser as $key => $value) {
                                if(!empty($value->device_token)){
                                    $device_token[] = $value->device_token;
                                    $number++;
                                    $notification = $modelNotification->newEmptyEntity();
                                    $notification->user_id = $value->id;
                                    $notification->title = $title;
                                    $notification->content = $content;
                                    $notification->id_reward = (int) $data->id;
                                    $notification->created_at = date('Y-m-d H:i:s');
                                    $notification->updated_at = date('Y-m-d H:i:s');
                                    $notification->action = 'sendNotificationReward';
                                    $modelNotification->save($notification);
                                }
                            }
                            

                            $dataSendNotification= array(
                                'title' => $title,
                                'time' => date('H:i d/m/Y'),
                                'content' => $content,
                                'id_reward' => "$data->id",
                                'action' => 'sendNotificationReward'
                            );

                            if(!empty($device_token)){
                                $rabbitMQClient = new RabbitMQClient();

                                $requestMessage = json_encode([ 'dataSendNotification' => $dataSendNotification, 
                                                    'listToken' => $device_token,
                                                    'keyFirebase' => $keyFirebase,
                                                    'projectId' => $projectId
                                                ]);    
                               $rabbitMQClient->sendMessage('send_notification_firebase', $requestMessage);
                                 //sendNotification($dataSendNotification, $device_token);                            
                            }
                        }
                        $mess= '<p class="text-success">Lưu dữ liệu thành công và bát được '.$number.' cho người dùng </p>';

                    }else{
                        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                    }

        	        
                }else{
                     $mess= '<p class="text-success">Thời gian bắt đầu nhỏ hơi thời gian kết thúc </p>';
                }
            }else{
                $mess= '<p class="text-success">Thời gian này có dang có chương trình đang diễn ra rồi  </p>';
            }

	    }else{
	    	$mess= '<p class="text-danger">Bạn thiếu dữ liệu </p>';
	    }
        if(!empty($data->id)){
	      $data = $modelReward->get(@$data->id);
        }
    }

    if(!empty($data->bonu)){
            $data->bonu = json_decode($data->bonu, true);
        }   




    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteRewardAdmin($input){
    global $controller;

    // $modelHistoricalsite = $controller->loadModel('Historicalsites');
    
    $modelReward = $controller->loadModel('Rewards');
    if(!empty($_GET['id'])){
        $data = $modelReward->find()->where(['id'=> (int) $_GET['id']])->first();
        
        if($data){
            $modelReward->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-reward-listRewardAdmin.php');
}
?>
