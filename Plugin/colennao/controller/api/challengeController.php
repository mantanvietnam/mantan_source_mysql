<?php 
function listChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
			    $conditions = array('status'=>'active');
			    $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
			    $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
			    if ($page < 1) $page = 1;
			    if (!empty($dataSend['id']) && is_numeric($dataSend['id'])) {
			        $conditions['id'] = $dataSend['id'];
			    }

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    $checkUserChallenges = $modelUserChallenges->find()->where(array('id_user'=> $user->id))->order(['id' => 'desc'])->all()->toList();
			    $listid = array();

			    if(!empty($checkUserChallenges)){
			    	foreach($checkUserChallenges as $key => $item){
			    		$listid[] = $item->id_challenge;
			    	}
			    }

			    if(!empty($listid)){
			    	$conditions['id NOT IN'] = $listid;
			    }
			    
			    $listData = $modelChallenge->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();		   
			   
			    $totalData = count($modelChallenge->find()->where($conditions)->all()->toList());
			        
			    return apiResponse(0, 'lấy dữ liệu thành công', $listData, $totalData);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');

    $modelTipChallenges = $controller->loadModel('TipChallenges');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
	    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
	    		
		    	$data = $modelChallenge->find()->where($conditions)->first();

		    	if(!empty($data->id)){
	            $data->Feedback = $modelFeedbackChallenge->find()->where(['id_challenge'=>$data->id])->all()->toList();
	            $data->Result = $modelResultChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
	            $data->Tip = $modelTipChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
	        	}
		   
		        
		    	return apiResponse(0, 'lấy dữ liệu thành công công', $data);
			}
			return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function paymentChallengeAPI($input){
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $transactionKey;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelTransactions = $controller->loadModel('Transactions');

    $modelTipChallenges = $controller->loadModel('TipChallenges');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $user = getUserByToken($dataSend['token']);

            
            if (!empty($user)) {
    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
    		
	    	$data = $modelChallenge->find()->where($conditions)->first();

	    	if(!empty($data)){
	    		$checkTransaction = $modelTransactions->find()->where(['id_challenge'=>$data->id,'id_user'=>$user->id])->first();
	    		if(empty($checkTransaction)){
	    			$checkTransaction = $modelTransactions->newEmptyEntity();
	    			$checkTransaction->id_user = $user->id;
	    			$checkTransaction->name = $data->title;
	    			$checkTransaction->total = $data->price;
	    			$checkTransaction->id_course = 0;
	    			$checkTransaction->id_challenge = $data->id;
	    			$checkTransaction->status = 1;
	    			$checkTransaction->type = 2;
	    			$checkTransaction->created_at = time();
	    			$checkTransaction->updated_at = time();
	    			$checkTransaction->code = time().$user->id.rand(0,10000);

	    			$modelTransactions->save($checkTransaction);

	    		}
	    		$bank = getBankAccount();

	    		$sms = $checkTransaction->id.' '.$transactionKey;

                $link_qr_bank = 'https://img.vietqr.io/image/'.$bank['bank_code'].'-'.$bank['bank_number'].'-compact2.png?amount='.$data->price.'&addInfo='.$sms.'&accountName='.$bank['bank_name'];
                $data->infoQR =   array('name_bank'=>$bank['bank_code'],
                				'account_holders_bank'=>$bank['bank_name'],
                				'link_qr_bank'=>$link_qr_bank,
                				'money'=>$bank['bank_number'],
                				'content'=>$sms,
                				'money'=>$data->price
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

function listUserChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');

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
			    if (!empty($dataSend['id']) && is_numeric($dataSend['id'])) {
			        $conditions['id'] = $dataSend['id'];
			    }

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    
			    $data = $modelUserChallenges->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();

			    $listData = array();
			    if(!empty($data)){
			    	foreach ($data as $key => $value) {
		    			$Challenge = $modelChallenge->find()->where(array('id'=> $value->id_challenge))->first();
		    			if(!empty($Challenge)){
		    				$listData[]=  $Challenge;
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

function getUserChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');
    $modelcoach = $controller->loadModel('coach');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token']) && !empty($dataSend['id_challenge'])){
            $user = getUserByToken($dataSend['token']);
            if(!empty($user)){
			    $conditions = array('id_user'=> $user->id);
			  
			    $conditions['id_challenge'] = (int) $dataSend['id_challenge'];

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    
			    $data = $modelUserChallenges->find()->where($conditions)->first();

			    if(!empty($data)){
			    	$Challenge = $modelChallenge->find()->where(array('id'=> $data->id_challenge))->first();
			    	if(!empty($Challenge)){
			    		
				        $Challenge->feedback = $modelFeedbackChallenge->find()->where(['id_challenge'=>$Challenge->id])->all()->toList();
				        $Challenge->result = $modelResultChallenges->find()->where(['id_challenge'=>$Challenge->id])->all()->toList();
				        $Challenge->coach = $modelcoach->find()->where(['id'=>$Challenge->id_coach])->first();
				    	$data->Challenge =  $Challenge;
				    

				    	$data->tip = json_decode($data->tip, true);
				        
				    	return apiResponse(0, 'lấy dữ liệu thành công', $data);
					}
					return apiResponse(4, 'Thử thách này không tồn tại');
					
			    }
			    return apiResponse(5, 'bạn chưa mua thử thách này');
		    	
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getTipUserChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');
    $modelcoach = $controller->loadModel('coach');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token']) && !empty($dataSend['id_challenge']) && !empty($dataSend['id_tip'])){
            $user = getUserByToken($dataSend['token']);
            if(!empty($user)){
			    $conditions = array('id_user'=> $user->id);
			  
			    $conditions['id_challenge'] = (int) $dataSend['id_challenge'];

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    
			    $data = $modelUserChallenges->find()->where($conditions)->first();

			    if(!empty($data)){
			    	$Challenge = $modelChallenge->find()->where(array('id'=> $data->id_challenge))->first();
			    	if(!empty($Challenge)){
			  			if(!empty($data->tip)){
			  				$tip = json_decode($data->tip, true);
			  				foreach($tip as $key => $item){
			  					if($item['id']==$dataSend['id_tip']){
			  						$data->tip = $item;
			  					}
			  				}
			  			}
				        
				    	return apiResponse(0, 'lấy dữ liệu thành công', $data);
					}
					return apiResponse(4, 'Thử thách này không tồn tại');
					
			    }
			    return apiResponse(4, 'bạn chưa mua thử thách này');
		    	
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function updateStatusTipUserChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');
    $modelcoach = $controller->loadModel('coach');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token']) && !empty($dataSend['id_challenge']) && !empty($dataSend['id_tip']) && !empty($dataSend['status'])){
            $user = getUserByToken($dataSend['token']);
            if(!empty($user)){
			    $conditions = array('id_user'=> $user->id);
			  
			    $conditions['id_challenge'] = (int) $dataSend['id_challenge'];

			    if (!empty($dataSend['title'])) {
			        $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
			    }

			    
			    $data = $modelUserChallenges->find()->where($conditions)->first();
			    $tips = array();
			    if(!empty($data)){
			    	$Challenge = $modelChallenge->find()->where(array('id'=> $data->id_challenge))->first();
			    	if(!empty($Challenge)){
			  			if(!empty($data->tip)){

			  				$tip = json_decode($data->tip, true);
			  				foreach($tip as $key => $item){
			  					if($item['id']==$dataSend['id_tip']){
			  						$item['status'] = $dataSend['status'];

			  						$tip[$key] =  $item;

			  						$tips = $item;
			  					}
			  				}
			  				$data->tip = json_encode($tip);

			  			}

			  			$modelUserChallenges->save($data);
			  			$data->tip = $tips; 
				        
				    	return apiResponse(0, 'cập nhập dữ liệu thành công', $data);
					}
					return apiResponse(4, 'Thử thách này không tồn tại');
					
			    }
			    return apiResponse(4, 'bạn chưa mua thử thách này');
		    	
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
function checkprocessAddMoney(){

	$mess = processAddMoney(500000, 1);

	debug($mess);

	die();
}
 ?>
