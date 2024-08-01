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

        $checkOrderPoint = $modelOrderPoint->find()->where(['user_sell'=>$currentUser->id, 'type'=>1,'status'=>0])->all()->toList();

        if (!empty($checkOrderPoint)) {
            return apiResponse(5, 'Yêu cầu của bạn chưa dc xử lý');
        }


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

        return apiResponse(0, 'đăng bán điểm thành công');
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
            return apiResponse(3, 'Bạn mua tối thiểu '.$minimumPointSold.' điểm');
        }

        $checkOrderPoint = $modelOrderPoint->find()->where(['user_buy'=>$currentUser->id, 'type'=>2,'status'=>0])->all()->toList();

        if (!empty($checkOrderPoint)) {
            return apiResponse(5, 'Yêu cầu của bạn chưa dc xử lý');
        }

        $total =  $point*$convertPointMoney;

        if ($currentUser->total_coin < $total) {
            return apiResponse(3, 'Số tiển của bạn chưa đủ');
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

 ?>