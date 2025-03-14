<?php 
function getPackageWorkoutAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUser = $controller->loadModel('Users');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $conditions = ['token' => $dataSend['token']];
        	$conditions['status'] = 'active';
    		$user = $modelUser->find()->where($conditions)->first();

            if (!empty($user)) {



	    		$conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
	    		
		    	$data = $modelPackageWorkout->find()->where($conditions)->first();

		    	if(!empty($data->id)){
		    		$checkUser = $modelUser->get($user->id);
            		$checkUser->id_package =(int) $data->id;
            		$modelUser->save($checkUser);
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
    $modelUser = $controller->loadModel('Users');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();
    	 if (!empty($dataSend['token']) && !empty($dataSend['id']) && !empty($dataSend['id_price'])) {
            $conditions = ['token' => $dataSend['token']];
        	$conditions['status'] = 'active';
    		$user = $modelUser->find()->where($conditions)->first();

            
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

	    		$checkTransaction = $modelTransactions->find()->where(['id_package'=>$data->id,'id_user'=>$user->id, 'status'=>1])->first();
	    		if(empty($checkTransaction)){
	    			$checkTransaction = $modelTransactions->newEmptyEntity();
	    			$checkTransaction->id_user = $user->id;
	    			$checkTransaction->name = $data->title;
	    			$checkTransaction->total = $price;
	    			$checkTransaction->id_course = 0;
	    			$checkTransaction->id_package = $data->id;
	    			$checkTransaction->id_challenge = 0;
	    			$checkTransaction->status = 1;
	    			$checkTransaction->type = 3;
	    			$checkTransaction->created_at = time();
	    			$checkTransaction->type_use = @$dataSend['id_price'];
	    			$checkTransaction->code = time().$user->id.rand(0,10000);

	    			

	    		}else{
	    			$checkTransaction->total = $price;
	    			$checkTransaction->type_use = @$dataSend['id_price'];
	    			$checkTransaction->updated_at = time();
	    		}


	    		$modelTransactions->save($checkTransaction);
	    		$bank = getBankAccount();


	    		$sms = $checkTransaction->id.' '.$transactionKey;

	    		if(function_exists('checkpayos')){
                    $infobank =  checkpayos($price,$sms);
                    if(!empty($infobank)){
                        $data->infobank = $infobank;
                        $bank['bank_code'] = $infobank['bin'];
						$bank['name_bank'] = $infobank['code_bank'];
                        $bank['bank_name'] = $infobank['accountName'];
                        $bank['bank_number'] = $infobank['accountNumber'];
                        $sms = $infobank['description'];
                        $price = $infobank['amount'];

                    }
                }

                $link_qr_bank = 'https://img.vietqr.io/image/'.$bank['bank_code'].'-'.$bank['bank_number'].'-compact2.png?amount='.$price.'&addInfo='.$sms.'&accountName='.$bank['bank_name'];
                $data->infoQR =   array('name_bank'=>$bank['name_bank'],
                				'account_holders_bank'=>$bank['bank_name'],
                				'link_qr_bank'=>$link_qr_bank,
                				'bank_number'=>$bank['bank_number'],
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

    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');

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

			   
			    $tota = 0;
			    $listData = array();
			    if(!empty($data)){
			    	foreach ($data as $key => $value) {
		    			$interme = $modelIntermePackageWorkout->find()->where(array('id_package'=> $value->id_package))->all()->toList();
		    			if(!empty($interme)){
		    				foreach($interme as $k => $item){
		    					$workouts =  $modelWorkout->find()->where(array('id'=> $item->id_workout))->first();
		    					$workouts->total_exercise = count($modelExerciseWorkouts->find()->where(['id_workout'=>$item->id_workout])->all()->toList());

		    					$listData[] = $workouts;
		    					$tota++;
		    				}
		    				
		    			}
			    	}
			    }


			    return apiResponse(0, 'lấy dữ liệu thành công', $listData, $tota);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function listAllWorkoutAPI($input){
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

			    
			    // $data = $modelUserPackages->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();

			   

			    $listData = array();
			    // if(!empty($data)){
		    		$listData =  $modelWorkout->find()->where(array('status'=>'active'))->all()->toList();
		    		if(!empty($listData)){
		    			foreach($listData as $key => $item){
		    				$listData[$key]->total_exercise = count($modelExerciseWorkouts->find()->where(['id_workout'=>$item->id])->all()->toList());
		    			}
		    		}
		    				
			    	return apiResponse(0, 'lấy dữ liệu thành công', $listData,count($listData));
			    // }


			    // return apiResponse(1, 'bạn chưa mua gói nào');
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
    global $listLevel;
    global $searchtime;
    global $listLevel;
    global $listdevice;

    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelAreas = $controller->loadModel('Areas');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	if(!empty($dataSend['token']) && $dataSend['id']){
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

			    	if(!empty($data->search)){
            			$search = json_decode($data->search, true);

            			

            			$time = json_decode(@$search['time'], true);
            			$area = json_decode(@$search['area'], true);
            			$level = json_decode(@$search['level'], true);
            			$device = json_decode(@$search['device'], true);
            			$times = array();
            			if(!empty($searchtime)){
                            foreach($searchtime as $key => $item){
                                if(!empty($time) && in_array($item['id'],  @$time)){
                                    $times[] =  $item;
                                }
                            }
                        }
            			
            			$areas = array();
            			if(!empty($area)){
                            foreach($area as $key => $item){
                                $areas[] = $modelAreas->find()->where(['id'=>$item])->first();
                            }
                        }

                        $levels = array();
            			if(!empty($listLevel)){
                            foreach($listLevel as $key => $item){
                                if(!empty($level) && in_array($item['id'],  @$level)){
                                    $levels[] =  $item;
                                }
                            }
                        }

                        $devices = array();
            			if(!empty($listdevice)){
                            foreach($listdevice as $key => $item){
                                if(!empty($device) && in_array($item['id'],  @$device)){
                                    $devices[] =  $item;
                                }
                            }
                        }

                        $search['device'] = $devices;
                        $search['level'] = $levels;
                        $search['area'] = $areas;
                        $search['time'] = $times;


                        $data->search = $search;
        			}
			    	$conditions = array('id_workout'=> $data->id);
			    	if(!empty($dataSend['id_level'])){
			    		$conditions['level']=  $dataSend['id_level'];
			    	}
			    	if(!empty($dataSend['id_time'])){
			    		if(!empty($searchtime)){
                            foreach($searchtime as $key => $item){
                                if($item['id'] == (int) $dataSend['id_time']){
                                    $conditions['time >=']= $item['min'];
                                    $conditions['time <=']= $item['max'];
                                }
                            }
                        }
			    	}

			    	if(!empty($dataSend['id_device'])){
			    		if($dataSend['id_device']==1){
			    			$conditions['device !=']=   '[]';
			    		}elseif($dataSend['id_device']==2){
			    			$conditions['device']=   '[]';
			    		}
			    		
			    	}

			    	if(!empty($dataSend['id_area'])){
			    		$conditions['area LIKE']=  '%'.$dataSend['id_area'].'%';
			    	}

			    	
			    	
		    		$exerciseWorkout = $modelExerciseWorkouts->find()->where($conditions)->order(['sort_order'=>'ASC','id' => 'ASC'])->all()->toList();
		    		if(!empty($exerciseWorkout)){
		    			foreach($exerciseWorkout as $key => $item){
		    				if(!empty($item->level)){
		        				foreach($listLevel as $k => $value){
		        					if($item->level ==$value['id']){
		        						$item->level_en = $value['name_en'];
		        						$item->level = $value['name'];
		        					}
		        				}
		        			}else{
		        				$item->level_en = null;
		        				$item->level = null;
		        			}
		    			}
		    			$exerciseWorkout[$key] = $item;
		    		}

		    		$data->ExerciseWorkout = $exerciseWorkout;
		    		$data->total_exercise = count($data->ExerciseWorkout);
			    }


			    return apiResponse(0, 'lấy dữ liệu thành công', $data);
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function workoutRandomAPI($input){
	global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $listLevel;
    global $searchtime;
    global $listLevel;
    global $listdevice;

    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelAreas = $controller->loadModel('Areas');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');
    
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
			   
			    
			   /* $data = $modelWorkout->find()->where($conditions)->order('RAND()')->first();
			   
			    if(!empty($data)){

			    	if(!empty($data->search)){
            			$search = json_decode($data->search, true);

            			

            			$time = json_decode(@$search['time'], true);
            			$area = json_decode(@$search['area'], true);
            			$level = json_decode(@$search['level'], true);
            			$device = json_decode(@$search['device'], true);
            			$times = array();
            			if(!empty($searchtime)){
                            foreach($searchtime as $key => $item){
                                if(!empty($time) && in_array($item['id'],  @$time)){
                                    $times[] =  $item;
                                }
                            }
                        }
            			
            			$areas = array();
            			if(!empty($area)){
                            foreach($area as $key => $item){
                                $areas[] = $modelAreas->find()->where(['id'=>$item])->first();
                            }
                        }

                        $levels = array();
            			if(!empty($listLevel)){
                            foreach($listLevel as $key => $item){
                                if(!empty($level) && in_array($item['id'],  @$level)){
                                    $levels[] =  $item;
                                }
                            }
                        }

                        $devices = array();
            			if(!empty($listdevice)){
                            foreach($listdevice as $key => $item){
                                if(!empty($device) && in_array($item['id'],  @$device)){
                                    $devices[] =  $item;
                                }
                            }
                        }

                        $search['device'] = $devices;
                        $search['level'] = $levels;
                        $search['area'] = $areas;
                        $search['time'] = $times;


                        $data->search = $search;
        			}
			    	$conditions = array('id_workout'=> $data->id);
			    	if(!empty($dataSend['id_level'])){
			    		$conditions['level']=  $dataSend['id_level'];
			    	}
			    	if(!empty($dataSend['ìd_time'])){
			    		if(!empty($searchtime)){
                            foreach($searchtime as $key => $item){
                                if($item['id'] == (int) $dataSend['ìd_time']){
                                    $conditions['time >=']=$item['min'];
                                    $conditions['time <=']=$item['max'];
                                }
                            }
                        }
			    	}

			    	if(!empty($dataSend['id_device'])){
			    		if($dataSend['id_device']==1){
			    			$conditions['device !=']=   '[]';
			    		}elseif($dataSend['id_device']==2){
			    			$conditions['device']=   '[]';
			    		}
			    		
			    	}

			    	if(!empty($dataSend['id_area'])){
			    		$conditions['area LIKE']=  '%'.$dataSend['id_area'].'%';
			    	}
			    	
		    		$exerciseWorkout = $modelExerciseWorkouts->find()->where($conditions)->order('RAND()')->first();;
		    		if(!empty($exerciseWorkout)){
		    			// foreach($exerciseWorkout as $key => $item){
		    				if(!empty($exerciseWorkout->level)){
		        				foreach($listLevel as $k => $value){
		        					if($exerciseWorkout->level ==$value['id']){
		        						$item->level_en = $value['name_en'];
		        						$item->level = $value['name'];
		        					}
		        				}
		        			}else{
		        				$exerciseWorkout->level_en = null;
		        				$exerciseWorkout->level = null;
		        			}
		    			// }
		    			// $exerciseWorkout[$key] = $item;
		    		}

		    		$data->ExerciseWorkout = $exerciseWorkout;
		    		// $data->total_exercise = count($data->ExerciseWorkout);
			    }*/

			     $data = $modelExerciseWorkouts->find()->where($conditions)->order('RAND()')->first();
			   
			    if(!empty($data)){
                    if(!empty($data->group_exercise)){
                    	$group = json_decode($data->group_exercise, true);
                    	foreach($group as $key => $item){
								$exercise = $modelChildExerciseWorkouts->find()->where(['id_exercise'=>$data->id, 'id_group'=>$item['id']])->all()->toList();

								if(!empty($exercise)){
									foreach($exercise as $k => $value){
										if(!empty($value->device)){
                                        $value->device = json_decode($value->device, true);
											if(!empty($value->device)){
												foreach($value->device as $e => $device){
													$datadevice =  $modelDevices->find()->where(['id'=>$device])->first();
													$value->device[$e] = $datadevice;
												}
												$value->device = $value->device;
											}
											$exercise[$k] = $value;
										}
									}
								}

								$item['exercise'] = $exercise;

								$item['total'] = count($item['exercise']);
								$group[$key] = $item;
                    	}
                    	$data->group_exercise = $group;
                    }	

                    if(!empty($data->device)){
            			$device = json_decode($data->device, true);
            			if(!empty($device)){
            				foreach($device as $k => $value){
								$value =  $modelDevices->find()->where(['id'=>$value])->first();
								$device[$k] = $value;
                    		}
                    		$data->device = $device;
            			}
            			
        			}

        			if(!empty($data->area)){
            			$area = json_decode($data->area, true);
            			if(!empty($area)){
            				foreach($area as $k => $value){
								$value =  $modelAreas->find()->where(['id'=>$value])->first();
								$area[$k] = $value;
                    		}
                    		$data->area = $area;
                    	}
                    	
        			}

        			if(!empty($data->level)){
        				foreach($listLevel as $key => $item){
        					if($data->level ==$item['id']){
        						$data->level_en = $item['name_en'];
        						$data->level = $item['name'];
        					}
        				}
        			}else{
        				$data->level_en = null;
        				$data->level = null;
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

function getUserExerciseWorkoutAPI($input){
	global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $listLevel;
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelAreas = $controller->loadModel('Areas');
    $modelDevices = $controller->loadModel('Devices');
    $modelCategoryConnect = $controller->loadModel('CategoryConnects');

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
			    
			    $data = $modelExerciseWorkouts->find()->where($conditions)->order(['sort_order'=>'ASC','id' => 'ASC'])->first();
			   
			    if(!empty($data)){
                    if(!empty($data->group_exercise)){
                    	$group = json_decode($data->group_exercise, true);
                    	foreach($group as $key => $item){
                    			$checkContent = $modelCategoryConnect->find()->where(['keyword'=>'child_exercise', 'id_category'=>@$data->id, 'id_group'=>$item['id']])->order(['sort_order'=>'ASC','id'=>'ASC'])->all()->toList();
								$exercise = [];
								// = $modelChildExerciseWorkouts->find()->where(['id_exercise'=>$data->id, 'id_group'=>$item['id']])->order(['sort_order'=>'ASC','id'=>'ASC'])->all()->toList();

								if(!empty($checkContent)){
									foreach($checkContent as $k => $child){
										 $value = $modelChildExerciseWorkouts->find()->where(['id'=>$child->id_parent])->first();
										if(!empty($value->device)){
                                        $value->device = json_decode($value->device, true);
											if(!empty($value->device)){
												foreach($value->device as $e => $device){
													$datadevice =  $modelDevices->find()->where(['id'=>$device])->first();
													$value->device[$e] = $datadevice;
												}
												$value->device = $value->device;
											}
											$exercise[$k] = $value;
										}
									}
								}

								$item['exercise'] = $exercise;

								$item['total'] = count($item['exercise']);
								$group[$key] = $item;
                    	}
                    	$data->group_exercise = $group;
                    }	

                    if(!empty($data->device)){
            			$device = json_decode($data->device, true);
            			if(!empty($device)){
            				foreach($device as $k => $value){
								$value =  $modelDevices->find()->where(['id'=>$value])->first();
								$device[$k] = $value;
                    		}
                    		$data->device = $device;
            			}
            			
        			}

        			if(!empty($data->area)){
            			$area = json_decode($data->area, true);
            			if(!empty($area)){
            				foreach($area as $k => $value){
								$value =  $modelAreas->find()->where(['id'=>$value])->first();
								$area[$k] = $value;
                    		}
                    		$data->area = $area;
                    	}
                    	
        			}

        			if(!empty($data->level)){
        				foreach($listLevel as $key => $item){
        					if($data->level ==$item['id']){
        						$data->level_en = $item['name_en'];
        						$data->level = $item['name'];
        					}
        				}
        			}else{
        				$data->level_en = null;
        				$data->level = null;
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
    global $listLevel;


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
            			if(!empty($device)){
            			foreach($device as $k => $value){
								$value =  $modelDevices->find()->where(['id'=>$value])->first();
								$device[$k] = $value;
                    	}
                    		$data->device = $device;
        				}else{
        					$data->device = [];
        				}
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

function searchChildExerciseWorkoutAPI() {
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return = array();
    
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');

    $dataSend = $_REQUEST;

    $conditions = [];

    if (!empty($dataSend['term'])) {
        $conditions['OR'] = [
            'title LIKE' => '%' . $dataSend['term'] . '%', 
            'code LIKE' => '%' . $dataSend['term'] . '%'
        ];
    }

   

    $listData = $modelChildExerciseWorkouts->find()->where($conditions)->all()->toList();

    if ($listData) {
        foreach ($listData as $data) {
           	
            $return[] = array(
                'label' => $data->title . ' (' . $data->code . ')',
                'id' => $data->id,
                'value' => $data->id,
                'title' => $data->title,
                'code' => $data->code,
                'title_en' => $data->title_en,
                'image' => $data->image,
                'youtube_code' => $data->youtube_code,
                'image' => $data->image,
            );
        }
    } else {
        $return = array(array(
            'id' => 0, 
            'label' => 'Không tìm thấy dữ liệu', 
            'value' => '', 
        ));
    }

    return $return;
}
?>


