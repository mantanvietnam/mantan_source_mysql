<?php 
function listChallengeAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelUser = $controller->loadModel('Users');
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

			    $conditionChallenge = array('id_user'=> $user->id);

			    $conditionChallenge['OR'] = ['deadline =' => 0,'deadline >' => time()];

			    $checkUserChallenges = $modelUserChallenges->find()->where($conditionChallenge)->order(['id' => 'desc'])->all()->toList();
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

			    if(!empty($listData)){
			    	foreach($listData as $key => $item){
			    		$listData[$key]->number_user = count($modelUserChallenges->find()->where(['id_challenge'=>$item->id])->order(['id' => 'desc'])->all()->toList());

			    		$UserChallenges = $modelUserChallenges->find()->limit(2)->where(['id_challenge'=>$item->id])->order('RAND()')->all()->toList();
			    		$user = array();
			    		if(!empty($UserChallenges)){
			    			foreach($UserChallenges as $k => $value){
			    				$avatar = $modelUser->find()->where(['id'=>$value->id_user])->first()->avatar;
			    				if(empty($avatar)){
			    					$avatar = $urlHomes.'/plugins/colennao/view/image/default-avatar.png';
			    				}
			    				
                          		$user[] = $avatar;
			    			}
			    		}
			    		$listData[$key]->randomUser =$user;
			    	}
			    }		  
			   
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
    global $urlHomes;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUser = $controller->loadModel('Users');
    $modelUserChallenges = $controller->loadModel('UserChallenges');

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

		            $data->number_user = count($modelUserChallenges->find()->where(['id_challenge'=>$data->id])->order(['id' => 'desc'])->all()->toList());

		            $UserChallenges = $modelUserChallenges->find()->limit(2)->where(['id_challenge'=>$data->id])->order('RAND()')->all()->toList();
		            $user = array();
		            if(!empty($UserChallenges)){
		            	foreach($UserChallenges as $k => $value){
		            		$avatar = $modelUser->find()->where(['id'=>$value->id_user])->first()->avatar;
		            		if(empty($avatar)){
		            			$avatar = $urlHomes.'/plugins/colennao/view/image/default-avatar.png';
		            		}

		            		$user[] = $avatar;
		            	}
		            }
		            $data->randomUser =$user;
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

    $modelUserChallenges = $controller->loadModel('UserChallenges');
    $modelTipChallenges = $controller->loadModel('TipChallenges');



    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $user = getUserByToken($dataSend['token']);

            
            if (!empty($user)) {
    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
    		
	    	$data = $modelChallenge->find()->where($conditions)->first();

	    	if(!empty($data)){

	    		if(empty($dataSend['type_use'])){
	    			$dataSend['type_use'] = 'forever';
	    		}
	    		$price =0;
	    		if(@$dataSend['type_use']=='trial'){
	   				if(!empty($data->price_trial)){
	   					$price = $data->price_trial;
	   				}
	    		}else{
	    			if(!empty($data->price)){
	    				$price = $data->price;
	    			}
	    		}

	    		if(!empty($price)){
	    			$checkTransaction = $modelTransactions->find()->where(['id_challenge'=>$data->id,'id_user'=>$user->id])->first();
		    		if(empty($checkTransaction)){
		    			$checkTransaction = $modelTransactions->newEmptyEntity();
		    			$checkTransaction->id_user = $user->id;
		    			$checkTransaction->name = $data->title;
		    			$checkTransaction->name_en = $data->title_en;
		    			$checkTransaction->total = $price;
		    			$checkTransaction->id_course = 0;
		    			$checkTransaction->id_challenge = $data->id;
		    			$checkTransaction->status = 1;
		    			$checkTransaction->type = 2;
		    			$checkTransaction->created_at = time();
		    			$checkTransaction->type_use = @$dataSend['type_use'];
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
	    		}else{
	    			$tip = $modelTipChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
		            $checkUserChallenge = $modelUserChallenges->find()->where(['id_challenge'=>$data->id,'id_user'=>$user->id])->first();
		            if(empty($checkUserChallenge)){
		                $checkUserChallenge = $modelUserChallenges->newEmptyEntity();
		                $checkUserChallenge->id_user = $user->id;
		                $checkUserChallenge->name = $data->title;
		                $checkUserChallenge->name_en = $data->title_en;
		                $checkUserChallenge->id_challenge = $data->id;
		                $checkUserChallenge->totalDay = $data->day;
		                $checkUserChallenge->status = 0;
		                $checkUserChallenge->date_start = time();
		                $checkUserChallenge->created_at = time();
		                $checkUserChallenge->id_transaction = 0;
		                $checkUserChallenge->note = '';
						$checkUserChallenge->deadline = 0;
		                $listTip = array();

		                if(!empty($tip)){
		                    foreach($tip as $key => $value){
		                        $listTip[] = array('id'=>$value->id,
		                            'tip'=>$value->tip,
		                            'tip_en'=>$value->tip_en,
		                            'status'=>''

		                        );
		                    }
		                }

		                $checkUserChallenge->tip = json_encode($listTip);
		                $modelUserChallenges->save($checkUserChallenge);

		            }
	    		}
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

			    $conditions['OR'] = ['deadline =' => 0,'deadline >' => time()];

			    
			    $data = $modelUserChallenges->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();

			    $listData = array();
			    if(!empty($data)){
			    	foreach ($data as $key => $value) {
		    			$Challenge = $modelChallenge->find()->where(array('id'=> $value->id_challenge))->first();
		    			if(!empty($Challenge)){
		    				$Challenge->date_start = @$value->date_start;
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

	$mess = processAddMoney(10000000, 4);

	debug($mess);

	die();
}
 ?>
