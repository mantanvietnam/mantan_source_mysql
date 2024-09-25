<?php 
function getPackageWorkoutAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

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
		   
		        
		    	return apiResponse(0, 'lấy dữ liệu thành công', $data);
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
	   
	        
	    	return apiResponse(0, 'Tạo yêu câu thành công', $data);
			}
			return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


function listUserPackageWorkoutAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
			    $conditions = array('id_user'=> $user->id);
			    $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
			    $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
			    if ($page < 1) $page = 1;
			    if (!empty($dataSend['id'])) {
			        $conditions['id'] = $dataSend['id'];
			    }

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    $conditions['OR'] = ['deadline =' => 0,'deadline >' => time()];

			    
			    $data = $modelUserPackages->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();

			    $listData = array();
			    if(!empty($data)){
			    	foreach ($data as $key => $value) {
		    			$Package = $modelPackageWorkout->find()->where(array('id'=> $value->id_package))->first();
		    			if(!empty($Package)){
		    				$listData[]=  $Package;
		    			}
			    	}
			    }
			    // $totalData = count($modelChallenge->find()->where($conditions)->all()->toList());
			        
			    return apiResponse(0, 'lấy dữ liệu thành công', $listData);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function listUserWorkoutAPI($input){
	global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
			    $conditions = array('id_user'=> $user->id);
			    $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
			    $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
			    if ($page < 1) $page = 1;
			    if (!empty($dataSend['id'])) {
			        $conditions['id'] = $dataSend['id'];
			    }

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    $conditions['OR'] = ['deadline =' => 0,'deadline >' => time()];

			    
			    $data = $modelUserPackages->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();

			   

			    $listData = array();
			    if(!empty($data)){
			    	foreach ($data as $key => $value) {
		    			$interme = $modelIntermePackageWorkout->find()->where(array('id_package'=> $value->id_package))->all()->toList();
		    			if(!empty($interme)){
		    				foreach($interme as $k => $item){
		    					$listData[]=  $modelWorkout->find()->where(array('id'=> $item->id_workout))->first();
		    				}
		    				
		    			}
			    	}
			    }


			    return apiResponse(0, 'lấy dữ liệu thành công', $listData);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getUserWorkoutAPI($input){
	global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);
            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
			    $conditions = array();
			    $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
			    $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
			    if ($page < 1) $page = 1;
			    if (!empty($dataSend['id'])) {
			        $conditions['id'] = $dataSend['id'];
			    }
			    
			    $data = $modelWorkout->find()->where($conditions)->order(['id' => 'desc'])->first();
			   
			    if(!empty($data)){
		    		$data->ExerciseWorkout = $modelExerciseWorkouts->find()->where(array('id_workout'=> $data->id))->all()->toList();
		    		$data->total_exercise = count($data->ExerciseWorkouts);
			    }


			    return apiResponse(0, 'lấy dữ liệu thành công', $data);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getUserExerciseWorkoutAPI($input){
	global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelAreas = $controller->loadModel('Areas');
    $modelDevices = $controller->loadModel('Devices');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);
            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
			    $conditions = array();
			    $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
			    $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
			    if ($page < 1) $page = 1;
			    if (!empty($dataSend['id'])) {
			        $conditions['id'] = $dataSend['id'];
			    }
			    
			    $data = $modelExerciseWorkouts->find()->where($conditions)->order(['id' => 'desc'])->first();
			   
			    if(!empty($data)){
                    if(!empty($data->group_exercise)){
                    	$group = json_decode($data->group_exercise, true);
                    	foreach($group as $key => $item){
								$item['exercise'] = $modelChildExerciseWorkouts->find()->where(['id_exercise'=>$data->id, 'id_group'=>$item['id']])->all()->toList();

								$item['total'] = count($item['exercise']);
								$group[$key] = $item;
                    	}
                    	$data->group_exercise = $group;
                    }	

                    if(!empty($data->device)){
            			$device = json_decode($data->device, true);

            			foreach($device as $k => $value){
								$value =  $modelDevices->find()->where(['id'=>$value])->first();
								$device[$k] = $value;
                    	}
                    	$data->device = $device;
        			}

        			if(!empty($data->area)){
            			$area = json_decode($data->area, true);

            			foreach($area as $k => $value){
								$value =  $modelAreas->find()->where(['id'=>$value])->first();
								$area[$k] = $value;
                    	}
                    	$data->area = $area;
        			}
			    }

			    return apiResponse(0, 'lấy dữ liệu thành công', $data);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getUserChildExerciseWorkoutAPI($input){
	global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;

    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');

    $modelDevices = $controller->loadModel('Devices');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	if(!empty($dataSend['token']) && (!empty($dataSend['id']))){
            $user = getUserByToken($dataSend['token']);
            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
			    $conditions = array();
			  
			        $conditions['id'] = (int)$dataSend['id'];
			    
			    
			    $data = $modelChildExerciseWorkouts->find()->where($conditions)->order(['id' => 'desc'])->first();
			   
			    if(!empty($data)){
                  if(!empty($data->device)){
            			$device = json_decode($data->device, true);

            			foreach($device as $k => $value){
								$value =  $modelDevices->find()->where(['id'=>$value])->first();
								$device[$k] = $value;
                    	}
                    	$data->device = $device;
        			}
			    }

			    return apiResponse(0, 'lấy dữ liệu thành công', $data);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');

}
?>
