<?php 
function listRewardAPI($input){
    global $controller;
    
    $modelReward = $controller->loadModel('Rewards');

    $conditions = array('status'=>1);


    $listData = $modelReward->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();
    
    return apiResponse(0, 'Lấy thông tin thành công', $listData);

}

function checkRewardAPI($input){
    global $controller;
    global $isRequestPost;

    
    $modelUser = $controller->loadModel('Users');
    $modelReward = $controller->loadModel('Rewards');
    $modelBooking = $controller->loadModel('Bookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        $conditions = array('status'=>1,'id'=>$dataSend['id']);
        $rewardData = $modelReward->find()->where($conditions)->first();

        if(empty($rewardData)) {
            return apiResponse(4, 'Phần thưởng này không tồn tại');
        }

        $conditions = array(
            'created_at >='=> $rewardData->start_date->format('Y-m-d H:i:s'),
            'created_at <='=> $rewardData->end_date->format('Y-m-d 23:59:59'),
            'posted_by' => $currentUser->id,
            'status' => 3,
        );

        $booking = count($modelBooking->find()->where($conditions)->all()->toList());

        if($booking < $rewardData->quantity_booking){
            return apiResponse(2, 'Bạn chưa đủ cuốc để nhận phần thưởng này');
        }

        if(empty($rewardData->user_id)){
            $rewardData->user_id ='';
        }

        if(in_array($currentUser->id, explode(',', @$rewardData->user_id))){
            return apiResponse(5, 'Bạn đã nhận phần thưởng này rồi');
        }


        return apiResponse(1, 'Bạn đã đủ cuốc để nhận phần thưởng này',$rewardData);

    }
    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');

}

function receiveRewardAPI($input){
    global $controller;
    global $isRequestPost;
    global $transactionType;
    
    $modelUser = $controller->loadModel('Users');
    $modelReward = $controller->loadModel('Rewards');
    $modelBooking = $controller->loadModel('Bookings');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        $conditions = array('status'=>1,'id'=>$dataSend['id']);
        $rewardData = $modelReward->find()->where($conditions)->first();

        if(empty($rewardData)) {
            return apiResponse(4, 'Phần thưởng này không tồn tại');
        }

        $conditions = array(
            'created_at >='=> $rewardData->start_date->format('Y-m-d H:i:s'),
            'created_at <='=> $rewardData->end_date->format('Y-m-d 23:59:59'),
            'posted_by' => $currentUser->id,
            'status' => 3,
        );

        $booking = count($modelBooking->find()->where($conditions)->all()->toList());

        if($booking < $rewardData->quantity_booking){
            return apiResponse(2, 'Bạn chưa đủ cuốc để nhận phần thưởng này');
        }

        if(empty($rewardData->user_id)){
            $rewardData->user_id ='';
        }
        if(in_array($currentUser->id, explode(',', @$rewardData->user_id))){
            return apiResponse(5, 'Bạn đã nhận phần thưởng này rồi');
        }

        $currentUser->total_coin += $rewardData->money;
        $modelUser->save($currentUser);

        $newTransaction = $modelTransaction->newEmptyEntity();
        $newTransaction->user_id = $currentUser->id;
        $newTransaction->amount = $rewardData->money;
        $newTransaction->type = $transactionType['add'];
        $newTransaction->name = "Tiền thưởng của phần thưởng $rewardData->name";
        $newTransaction->description = '+' . number_format($rewardData->money) . ' EXC-xu';
        $newTransaction->created_at = date('Y-m-d H:i:s');
        $newTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($newTransaction);
                        // Thông báo cho người đăng
        $title = 'Nhận phần thưởng" ';
        $content = "Chúc mừng bạn đã được nhận phần thưởng  $rewardData->name";
        $notification = $modelNotification->newEmptyEntity();
        $notification->user_id = $currentUser->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $modelNotification->save($notification);
        if ($currentUser->device_token) {
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'action' => 'addMoneySuccess',
                'user_id' => $currentUser->id,
            );
            sendNotification($dataSendNotification, $currentUser->device_token);
        }


        $rewardData->user_id .= $currentUser->id.',';

        $modelReward->save($rewardData);

         return apiResponse(1, 'Bạn nhận phần thưởng này thành công',$rewardData);


    }

    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');

}

function geDetailRewardAPI($input){
    global $controller;
    global $isRequestPost;

    
    $modelUser = $controller->loadModel('Users');
    $modelReward = $controller->loadModel('Rewards');
    $modelBooking = $controller->loadModel('Bookings');
    $modelUserReward = $controller->loadModel('UserRewards');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id'])) {
                if(!empty($dataSend['access_token'])){
                    $currentUser = getUserByToken($dataSend['access_token']);
                }

        $conditions = array('status'=>1,'id'=>$dataSend['id']);
        $rewardData = $modelReward->find()->where($conditions)->first();

        if(empty($rewardData)) {
            return apiResponse(4, 'Phần thưởng này không tồn tại');
        }

        if(!empty($currentUser)){
            $rewardData->myUserJoin = $modelUserReward->find()->where(['user_id'=>(int)$currentUser->id,'reward_id'=>$rewardData->id])->first();

            $rewardData->so_cuoc_ban_thanh_cong =(int)@$rewardData->myUserJoin->quantity_booking;
        }else{
            $rewardData->myUserJoin = array();
            $rewardData->so_cuoc_ban_thanh_cong = 0;
        }
        

        if(!empty($rewardData->bonu)){
            $rewardData->tien_thuong_theo_chuyen = json_decode($rewardData->bonu, true);
        }


        return apiResponse(1, 'Bạn lấy đữ liệu thành công ',$rewardData);
    }
     return apiResponse(0, 'thiếu dữ liệu');

    }
    return apiResponse(0, 'Bắt buộc sử dụng phương thức POST');

}

?>