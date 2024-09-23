<?php 
function getPackageWorkoutAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
	    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
	    		
		    	$data = $modelPackageWorkout->find()->where($conditions)->first();

		    	if(!empty($data->id)){
	            $data->workout = $modelIntermePackageWorkout->find()->where(['id_package'=>$data->id])->all()->toList();
	        	}

	        	if(!empty($data->price_package)){
        			$data->price_package = json_decode($data->price_package, true);
    			}
		   
		        
		    	return apiResponse(0, 'lấy dữ liệu thành công công', $data);
			}
			return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function paymentPackageWorkoutAPI($input){
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $transactionKey;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');

    $modelTransactions = $controller->loadModel('Transactions');


    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id']) && !empty($dataSend['id_price'])) {
            $user = getUserByToken($dataSend['token']);

            
            if (!empty($user)) {
    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
    		
	    	$data = $modelPackageWorkout->find()->where($conditions)->first();

	    	if(!empty($data)){
	    		$price = 0;
	    		if(!empty($data->price_package)){
        			$price_package = json_decode($data->price_package, true);
    				foreach($price_package as $key => $item){
						if($item['id']==(int)$dataSend['id_price']){
							$price = (int)$item['price'];
						}
    				}
    			}

	    		$checkTransaction = $modelTransactions->find()->where(['id_package'=>$data->id,'id_user'=>$user->id])->first();
	    		if(empty($checkTransaction)){
	    			$checkTransaction = $modelTransactions->newEmptyEntity();
	    			$checkTransaction->id_user = $user->id;
	    			$checkTransaction->name = $data->title;
	    			$checkTransaction->total = $price;
	    			$checkTransaction->id_course = 0;
	    			$checkTransaction->id_package = $data->id;
	    			$checkTransaction->id_challenge = 2;
	    			$checkTransaction->status = 1;
	    			$checkTransaction->type = 3;
	    			$checkTransaction->created_at = time();
	    			$checkTransaction->type_use = @$dataSend['id_price'];
	    			$checkTransaction->updated_at = time();
	    			$checkTransaction->code = time().$user->id.rand(0,10000);

	    			$modelTransactions->save($checkTransaction);

	    		}
	    		$bank = getBankAccount();


	    		$sms = $checkTransaction->id.' '.$transactionKey;

                $link_qr_bank = 'https://img.vietqr.io/image/'.$bank['bank_code'].'-'.$bank['bank_number'].'-compact2.png?amount='.$price.'&addInfo='.$sms.'&accountName='.$bank['bank_name'];
                $data->infoQR =   array('name_bank'=>$bank['bank_code'],
                				'account_holders_bank'=>$bank['bank_name'],
                				'link_qr_bank'=>$link_qr_bank,
                				'money'=>$bank['bank_number'],
                				'content'=>$sms,
                				'money'=>$price
							);

  
        	}
	   
	        
	    	return apiResponse(0, 'Tạo yêu câu thành công công', $data);
			}
			return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}



 ?>