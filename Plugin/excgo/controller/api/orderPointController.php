<?php 
// tạo đơn bán điểm của người bán 
function createOrderSellPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['point'])){
         	return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        /*$checkOrderPoint = $modelOrderPoint->find()->where(['user_sell'=>$currentUser->id, 'type'=>1,'status'=>0])->all()->toList();

        if (!empty($checkOrderPoint)) {
            return apiResponse(5, 'Yêu cầu của bạn chưa dc xử lý xong');
        }*/


        $point = (int)$dataSend['point'];
        if ($currentUser->point < $minimumPointSold && $point < $minimumPointSold && $currentUser->point < $point) {
            return apiResponse(4, 'Số điểm chưa đủ để bán ');
        }

        $currentUser->point -= $point;
        $modelUser->save($currentUser);

		$order = $modelOrderPoint->newEmptyEntity();
		$order->user_sell = $currentUser->id;
		$order->point = $point;
		$order->total = $point*$convertPointMoney;
		$order->created_at = date('Y-m-d H:i:s');
		$order->updated_at = date('Y-m-d H:i:s');
		$order->status = 0;
		$order->type = 1;
        
        $modelOrderPoint->save($order);   

        return apiResponse(0, 'Đăng bán điểm thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

// tạo đơn mua điểm của người bán 
function createOrderBuyPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');
    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];
    

    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['point'])){
         	return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }
        $point = (int)$dataSend['point'];
      
        if ($point < $minimumPointSold) {
            return apiResponse(4, 'Bạn mua tối thiểu '.$minimumPointSold.' điểm');
        }

       /* $checkOrderPoint = $modelOrderPoint->find()->where(['user_buy'=>$currentUser->id, 'type'=>2,'status'=>0])->all()->toList();

        if (!empty($checkOrderPoint)) {
            return apiResponse(5, 'Yêu cầu của bạn chưa dc xử lý  xong');
        }*/

        $total =  $point*$convertPointMoney;

        if ($currentUser->total_coin < $total) {
            return apiResponse(4, 'Số tiển của bạn chưa đủ');
        }

		$order = $modelOrderPoint->newEmptyEntity();
		$order->user_buy = $currentUser->id;
		$order->point = $point;
		$order->total = $total;
		$order->created_at = date('Y-m-d H:i:s');
		$order->updated_at = date('Y-m-d H:i:s');
		$order->status = 0;
		$order->type = 2;
        
        $modelOrderPoint->save($order);  

         // xử lý giao dịch người mua điểm  
        $currentUser->total_coin -= $order->total;
        $modelUser->save($currentUser);

        // Giao dịch trừ phí nhận cuốc xe
        $receiveTransaction = $modelTransaction->newEmptyEntity();
        $receiveTransaction->user_id = $currentUser->id;
        $receiveTransaction->amount = $order->total;
        $receiveTransaction->type = $transactionType['subtract'];
        $receiveTransaction->id_order = $order->id;
        $receiveTransaction->name = "Cọc tiền mua $order->point điểm ";
        $receiveTransaction->description = '-' . number_format($order->total) . ' EXC-xu';
        $receiveTransaction->created_at = date('Y-m-d H:i:s');
        $receiveTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($receiveTransaction);  

        return apiResponse(0, 'đăng mua điểm thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function listOrderPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if(empty($dataSend['access_token']) && empty($dataSend['type'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }
        
        $conditions = array('type'=>(int)$dataSend['type'], 'status'=>0);

        if($dataSend['type']==1){
             $conditions['user_sell !='] = @$currentUser->id;
        }else{
             $conditions['user_buy !='] = @$currentUser->id;
        }

        $listData = $modelOrderPoint->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $user_sell = array();
                if(!empty($item->user_sell)){
                    $user_sell = $modelUser->find()->where(['id'=>$item->user_sell])->first();

                    unset($user_sell->password);
                }

                $item->infoUser_sell = $user_sell;
                $user_buy = array();
                if(!empty($item->user_buy)){
                    $user_buy = $modelUser->find()->where(['id'=>$item->user_buy])->first();

                    unset($user_buy->password);
                }

                $item->infoUser_buy = $user_buy;

                $listData[$key]= $item;
                
            }
        }

        return apiResponse(0, 'lấy láy dữ liệu thành công', $listData);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function listOrderPointMyUserApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if(empty($dataSend['access_token']) && empty($dataSend['type'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }
        
        $conditions = array('type'=>(int)$dataSend['type']);

        if($dataSend['type']==1){
             $conditions['user_sell'] = @$currentUser->id;
        }else{
             $conditions['user_buy'] = @$currentUser->id;
        }

        $listData = $modelOrderPoint->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $user_sell = array();
                if(!empty($item->user_sell)){
                    $user_sell = $modelUser->find()->where(['id'=>$item->user_sell])->first();

                    unset($user_sell->password);
                }

                $item->infoUser_sell = $user_sell;
                $user_buy = array();
                if(!empty($item->user_buy)){
                    $user_buy = $modelUser->find()->where(['id'=>$item->user_buy])->first();

                    unset($user_buy->password);
                }

                $item->infoUser_buy = $user_buy;

                $listData[$key]= $item;
                
            }
        }

        return apiResponse(2, 'lấy láy dữ liệu thành công', $listData);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function buyOrderPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');
    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $order = $modelOrderPoint->find()->where(['id'=>(int)$dataSend['id'], 'type'=>1,'status'=>0])->first();

        if (empty($order)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        if($order->user_sell == $currentUser->id){
             return apiResponse(6, 'Đơn này của bạn lên không mua được');
        }

        if ($currentUser->total_coin < $order->total) {
            return apiResponse(4, 'Số tiển chưa đủ mua');
        }

        $order->updated_at = date('Y-m-d H:i:s');
        $order->user_buy = $currentUser->id;
        $order->status = 2;
        
        $modelOrderPoint->save($order);  

         // xử lý giao dịch người mua điểm  
        $currentUser->total_coin -= $order->total;
        $currentUser->point += $order->point;
        $modelUser->save($currentUser);

        // Giao dịch trừ phí nhận cuốc xe
        $receiveTransaction = $modelTransaction->newEmptyEntity();
        $receiveTransaction->user_id = $currentUser->id;
        $receiveTransaction->amount = $order->total;
        $receiveTransaction->type = $transactionType['subtract'];
        $receiveTransaction->id_order = $order->id;
        $receiveTransaction->name = "Thanh toán tiền mua $order->point điểm ";
        $receiveTransaction->description = '-' . number_format($order->total) . ' EXC-xu';
        $receiveTransaction->created_at = date('Y-m-d H:i:s');
        $receiveTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($receiveTransaction); 

        // gửi thông báo bên bán 
        $infoUserSell = $modelUser->find()->where(['id'=>$order->user_sell])->first();

        $infoUserSell->total_coin += $order->total;
        $modelUser->save($infoUserSell);

        // Lưu giao dịch hoàn tiền
        $newTransaction = $modelTransaction->newEmptyEntity();
        $newTransaction->user_id = $infoUserSell->id;
        $newTransaction->id_order = $order->id;
        $newTransaction->amount = $order->total;
        $newTransaction->type = $transactionType['add'];
        $newTransaction->name = "Cộng phí bán $order->point điểm ";
        $newTransaction->description = '+' . number_format($order->total) . ' EXC-xu';
        $newTransaction->created_at = date('Y-m-d H:i:s');
        $newTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($newTransaction);


         // Thông báo cho người đăng cuốc xe
        $title = 'Có người mua điểm của bạn';
        $content = "bạn đã bán $order->total điểm cho tài xế $currentUser->name";
        $notification = $modelNotification->newEmptyEntity();
        $notification->user_id = $infoUserSell->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->id_order = $order->id;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $modelNotification->save($notification);

        if ($infoUserSell->device_token) {
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'id_order' => $order->id,
                'action' => 'buyOrderPointSuccess'
            );
            sendNotification($dataSendNotification, $infoUserSell->device_token);
        }

        return apiResponse(0, 'Bạn mua điểm thành công ');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

/*function acceptSellPointApi($input){
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $order = $modelOrderPoint->find()->where(['user_sell'=>$currentUser->id,'id'=>(int)$dataSend['id'], 'type'=>1,'status'=>1])->first();

        if (empty($order)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        // gửi thông báo bên bán 
        $infoUserBuy = $modelUser->find()->where(['id'=>$order->user_buy])->first();

        if ($infoUserBuy->total_coin < $order->total) {
           

            return apiResponse(4, 'Số tiển người mua không chưa đủ tiền');
        }

        $order->updated_at = date('Y-m-d H:i:s');
        $order->status = 2;

        $modelOrderPoint->save($order);

        // xử lý giao dịch người báng điểm  
        $currentUser->total_coin += $order->total;
        $modelUser->save($currentUser);

        // Lưu giao dịch hoàn tiền
        $newTransaction = $modelTransaction->newEmptyEntity();
        $newTransaction->user_id = $currentUser->id;
        $newTransaction->id_order = $order->id;
        $newTransaction->amount = $order->total;
        $newTransaction->type = $transactionType['add'];
        $newTransaction->name = "Cộng phí bán  $order->point điểm ";
        $newTransaction->description = '+' . number_format($order->total) . ' EXC-xu';
        $newTransaction->created_at = date('Y-m-d H:i:s');
        $newTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($newTransaction);



        $infoUserBuy->point += $order->point;
        $modelUser->save($infoUserBuy);

         // Thông báo cho người mua 
        $title = ' bạn mua điểm thành công ';
        $content = "Bạn được cộng $order->point điểm bởi tài xế $currentUser->name bán cho bạn ";
        $notification = $modelNotification->newEmptyEntity();
        $notification->user_id = $infoUserBuy->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->id_order = $order->id;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $modelNotification->save($notification);

        if ($infoUserBuy->device_token) {
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'id_order' => $order->id,
                'action' => 'buyOrderPointSuccess'
            );
            sendNotification($dataSendNotification, $infoUserBuy->device_token);
        }

        return apiResponse(0, ' Xác nhận bán điểm thành công',$order);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
} */


function sellOrderPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');
    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $order = $modelOrderPoint->find()->where(['id'=>(int)$dataSend['id'], 'type'=>2,'status'=>0])->first();

        if (empty($order)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        if($order->user_buy == $currentUser->id){
             return apiResponse(6, 'Đơn này của bạn lên không bán được');
        }

        if ($currentUser->point < $order->point) {
            return apiResponse(4, 'Số điểm chưa đủ để bán');
        }

        $order->updated_at = date('Y-m-d H:i:s');
        $order->user_sell = $currentUser->id;
        $order->status = 2;
        
        $modelOrderPoint->save($order);

        $currentUser->total_coin += $order->total;
        $currentUser->point -= $order->point;
        $modelUser->save($infoUserSell);

        // Lưu giao dịch hoàn tiền
        $newTransaction = $modelTransaction->newEmptyEntity();
        $newTransaction->user_id = $currentUser->id;
        $newTransaction->id_order = $order->id;
        $newTransaction->amount = $order->total;
        $newTransaction->type = $transactionType['add'];
        $newTransaction->name = "Cộng phí bán  $order->point điểm ";
        $newTransaction->description = '+' . number_format($order->total) . ' EXC-xu';
        $newTransaction->created_at = date('Y-m-d H:i:s');
        $newTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($newTransaction);

        // gửi thông báo bên bán 
        $infoUserBuy = $modelUser->find()->where(['id'=>$order->user_buy])->first();

        $infoUserBuy->point += $order->point;
        $modelUser->save($infoUserBuy);

         // Thông báo cho người đăng mua điêm 
        $title = 'Có người bán điểm cho bạn';
        $content = "Tài xế $currentUser->name đã bán $order->point điểm cho bạn";
        $notification = $modelNotification->newEmptyEntity();
        $notification->user_id = $infoUserBuy->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->id_order = $order->id;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $modelNotification->save($notification);

        if ($infoUserBuy->device_token) {
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'id_order' => $order->id,
                'action' => 'buyOrderPointSuccess'
            );
            sendNotification($dataSendNotification, $infoUserBuy->device_token);
        }

        return apiResponse(0, 'Bạn bán điểm thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

/*function acceptBuyPointApi($input){
    global $controller;
    global $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $order = $modelOrderPoint->find()->where(['user_buy'=>$currentUser->id,'id'=>(int)$dataSend['id'], 'type'=>2,'status'=>1])->first();

        if (empty($order)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        // gửi thông báo bên bán 
        $infoUserSell = $modelUser->find()->where(['id'=>$order->user_sell])->first();

        if ($infoUserSell->point < $order->point) {
            
            

            return apiResponse(4, 'Số đểm người bán không chưa đủ đểm  ');
        }

        $order->updated_at = date('Y-m-d H:i:s');
        $order->status = 2;

        $modelOrderPoint->save($order); 



        // xử lý giao dịch người mua điểm  
        $currentUser->total_coin -= $order->total;
        $currentUser->point += $order->point;
        $modelUser->save($currentUser);

        // Giao dịch trừ phí nhận cuốc xe
        $receiveTransaction = $modelTransaction->newEmptyEntity();
        $receiveTransaction->user_id = $currentUser->id;
        $receiveTransaction->amount = $order->total;
        $receiveTransaction->type = $transactionType['subtract'];
        $receiveTransaction->id_order = $order->id;
        $receiveTransaction->name = "Thanh toán mua $order->point điểm ";
        $receiveTransaction->description = '-' . number_format($order->total) . ' EXC-xu';
        $receiveTransaction->created_at = date('Y-m-d H:i:s');
        $receiveTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($receiveTransaction);

         // xử lý giao dịch người báng điểm  
        $infoUserSell->total_coin += $order->total;
        $infoUserSell->point -= $order->point;
        $modelUser->save($infoUserSell);

        // Lưu giao dịch hoàn tiền
            $newTransaction = $modelTransaction->newEmptyEntity();
            $newTransaction->user_id = $infoUserSell->id;
            $newTransaction->id_order = $order->id;
            $newTransaction->amount = $order->total;
            $newTransaction->type = $transactionType['add'];
            $newTransaction->name = "Cộng phí bán  $order->point điểm ";
            $newTransaction->description = '+' . number_format($order->total) . ' EXC-xu';
            $newTransaction->created_at = date('Y-m-d H:i:s');
            $newTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($newTransaction);

         // Thông báo cho người mua 
        $title = 'Bán điểm thành công ';
        $content = "Điểm của đơn #$order->id đã được bán bởi tài xế $currentUser->name";
        $notification = $modelNotification->newEmptyEntity();
        $notification->user_id = $infoUserSell->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->id_order = $order->id;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $modelNotification->save($notification);

        if ($infoUserSell->device_token) {
            $dataSendNotification= array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'id_order' => $order->id,
                'action' => 'buyOrderPointSuccess'
            );
            sendNotification($dataSendNotification, $infoUserSell->device_token);
        }

        return apiResponse(0, 'Xác nhận mua điểm thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}*/ 

function cancelOrderSellPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');
    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

        if (empty($dataSend['access_token']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $order = $modelOrderPoint->find()->where(['id'=>(int)$dataSend['id'],'user_sell'=> $currentUser->id ,'type'=>1])->first();

        if (empty($order)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        if (empty($order->status == 2)) {
            return apiResponse(6, 'đơn này có người mua rồi ');
        }elseif($order->status ==3) {
            return apiResponse(4, 'đơn này đã bị hủy');
        }

        $order->status = 3;
        $modelOrderPoint->save($order);

        $currentUser->point += $order->point;
        $modelUser->save($currentUser);
        
        return apiResponse(0, 'Bạn hủy đơn bán điểm thành công ');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function cancelOrderBuyPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');
    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

        if (empty($dataSend['access_token']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $order = $modelOrderPoint->find()->where(['id'=>(int)$dataSend['id'],'user_buy'=> $currentUser->id ,'type'=>2])->first();

        if (empty($order)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        if (empty($order->status == 2)) {
            return apiResponse(5, 'đơn này có người bán điểm rồi ');
        }elseif($order->status ==3) {
            return apiResponse(4, 'đơn này đã bị hủy');
        }

        $order->status = 3;
        $modelOrderPoint->save($order);

        $currentUser->total_coin += $order->total;
        $modelUser->save($currentUser);

        // Lưu giao dịch hoàn tiền
        $newTransaction = $modelTransaction->newEmptyEntity();
        $newTransaction->user_id = $currentUser->id;
        $newTransaction->id_order = $order->id;
        $newTransaction->amount = $order->total;
        $newTransaction->type = $transactionType['add'];
        $newTransaction->name = "Hoàn lại phí cọc mua điểm đã hủy ";
        $newTransaction->description = '+' . number_format($order->total) . ' EXC-xu';
        $newTransaction->created_at = date('Y-m-d H:i:s');
        $newTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($newTransaction);
        
        return apiResponse(0, 'Bạn hủy đơn mua điểm thành công ');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

// sửa đơn bán điểm của người bán 
function updeatOrderSellPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];


    if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['point']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $checkOrderPoint = $modelOrderPoint->find()->where(['id'=>$dataSend['id'],'user_sell'=>$currentUser->id, 'type'=>1,'status'=>0])->first();

        if (empty($checkOrderPoint)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }

        


        $point = (int)$dataSend['point'];
        if ($currentUser->point < $minimumPointSold && $point < $minimumPointSold && $currentUser->point < $point) {
            return apiResponse(4, 'Số điểm chưa đủ để bán ');
        }

      
        $currentUser->point +=  $checkOrderPoint->point;
        $currentUser->point -=  $point;

        
        $modelUser->save($currentUser);


        $checkOrderPoint->point = $point;
        $checkOrderPoint->total = $point*$convertPointMoney;
        $checkOrderPoint->updated_at = date('Y-m-d H:i:s');
        
        $modelOrderPoint->save($checkOrderPoint);   

        return apiResponse(0, 'Sửa điểm thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

// sửa đơn mua điểm của người  
function updeatOrderBuyPointApi($input): array
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');
    $modelTransaction = $controller->loadModel('Transactions');
    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];
    

      if ($isRequestPost){
        $dataSend = $input['request']->getData();

         if (empty($dataSend['access_token']) && empty($dataSend['point']) && empty($dataSend['id'])){
            return apiResponse(2, 'Gửi thiếu dữ liệu');
         }

        $currentUser = getUserByToken($dataSend['access_token']);

        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }

        $checkOrderPoint = $modelOrderPoint->find()->where(['id'=>$dataSend['id'],'user_buy'=>$currentUser->id, 'type'=>2,'status'=>0])->first();

        if (empty($checkOrderPoint)) {
            return apiResponse(5, 'Đơn này không tồn tại');
        }


        $point = (int)$dataSend['point'];

         $total =  $point*$convertPointMoney;
        if ($currentUser->point < $minimumPointSold && $point < $minimumPointSold && $currentUser->point < $point) {
            return apiResponse(4, 'Số điểm chưa đủ để bán ');
        }

      
        $currentUser->total_coin +=  $checkOrderPoint->total;
        $currentUser->total_coin -=  $total;

        
        $modelUser->save($currentUser);

        if($point>$checkOrderPoint->point){
            // Giao dịch trừ phí nhận cuốc xe
            $p = $point - $checkOrderPoint->point;
            $tien = $p*$convertPointMoney;

            $receiveTransaction = $modelTransaction->newEmptyEntity();
            $receiveTransaction->user_id = $currentUser->id;
            $receiveTransaction->amount = $tien;
            $receiveTransaction->type = $transactionType['subtract'];
            $receiveTransaction->id_order = $checkOrderPoint->id;
            $receiveTransaction->name = "Cọc thêm tiền mua $p điểm của đơn $checkOrderPoint->id ";
            $receiveTransaction->description = '-' . number_format($tien) . ' EXC-xu';
            $receiveTransaction->created_at = date('Y-m-d H:i:s');
            $receiveTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($receiveTransaction);  
        }elseif($point<$checkOrderPoint->point){
            // Giao dịch trừ phí nhận cuốc xe
            $p =  $checkOrderPoint->point-$point;
            $tien = $p*$convertPointMoney;

            $receiveTransaction = $modelTransaction->newEmptyEntity();
            $receiveTransaction->user_id = $currentUser->id;
            $receiveTransaction->amount = $tien;
            $receiveTransaction->type = $transactionType['add'];
            $receiveTransaction->id_order = $checkOrderPoint->id;
            $receiveTransaction->name = "Bới tiền cọc của đơn $checkOrderPoint->id thành công ";
            $receiveTransaction->description = '-' . number_format($tien) . ' EXC-xu';
            $receiveTransaction->created_at = date('Y-m-d H:i:s');
            $receiveTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($receiveTransaction);  

        }


        $checkOrderPoint->point = $point;
        $checkOrderPoint->total = $point*$convertPointMoney;
        $checkOrderPoint->updated_at = date('Y-m-d H:i:s');
        
        $modelOrderPoint->save($checkOrderPoint);   

        return apiResponse(0, 'Sửa điểm thành công');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
?>
