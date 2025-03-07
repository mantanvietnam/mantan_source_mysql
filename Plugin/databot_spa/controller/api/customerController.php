<?php
function searchCustomerApi($input)
{
	global $controller;
	global $session;

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelCustomer = $controller->loadModel('Customers');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member);
            $conditions['OR'] = [['name LIKE' => '%'.$_GET['key'].'%'], ['phone LIKE' => '%'.$_GET['key'].'%'], ['email LIKE' => '%'.$_GET['key'].'%']];
          
            $order = array('name' => 'asc');

            $listData = $modelCustomer->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->phone,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'phone'=>$data->phone,
                    				'email'=>$data->email,
                    				'cmnd'=>$data->cmnd,
                    				'address'=>$data->address,
                    				'sex'=>$data->sex,
                    				'avatar'=>$data->avatar,
                    				'birthday'=>$data->birthday,
                    				'point'=>$data->point,
                    			);
                }
            }
        }
	}

	return $return;
}

function addCustomerCampainApi($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

	$return = [];

	$modelCampains = $controller->loadModel('Campains');
	$modelCampainCustomers = $controller->loadModel('CampainCustomers');
	$modelCustomer = $controller->loadModel('Customers');
	$modelSpas = $controller->loadModel('Spas');

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['id_member']) ){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	if(!empty($dataSend['id_customer'])){
    			$infoCampain = $modelCampains->find()->where(['id'=>(int) $dataSend['id_campain']])->first();
        	}

        	if(!empty($dataSend['id_member'])){
        		$listSpa = $modelSpas->find()->where(['id_member'=>(int) $dataSend['id_member']])->all()->toList();

        		if(!empty($listSpa)){
        			if(empty($dataSend['id_spa'])) $dataSend['id_spa'] = $listSpa[0]->id;

		        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=> (int) $dataSend['id_member']];
		        	$checkPhone = $modelCustomer->find()->where($conditions)->first();

		        	if(empty($checkPhone)){
				        // tạo dữ liệu save
				        $data = $modelCustomer->newEmptyEntity();
						
						$data->created_at = time();
						$data->point = 0;
				        $data->name = $dataSend['name'];
				        $data->id_member =(int) $dataSend['id_member'];
				        $data->id_spa = (int) $dataSend['id_spa'];
				        $data->phone = $dataSend['phone'];
				        $data->sex = $dataSend['sex'];
				        $data->email = @$dataSend['email'];
				        $data->address = @$dataSend['address'];
				        $data->updated_at = time();
				        $data->avatar = (!empty($dataSend['avatar']))?$dataSend['avatar']:$urlHomes.'/plugins/databot_spa/view/home/assets/img/avatar-default.png';
				        $data->id_staff = (int) $dataSend['id_staff'];
				        $data->note = '';

						
						if(!empty($dataSend['referral_code'])){
							$dataSend['referral_code'] = trim(str_replace(array(' ','.','-'), '', $dataSend['referral_code']));
	        				$dataSend['referral_code'] = str_replace('+84','0',$dataSend['referral_code']);

							$checkAff = $modelCustomer->find()->where(['phone'=>$dataSend['referral_code'], 'id_member'=> (int) $dataSend['id_member']])->first();

							if(!empty($checkAff)){
								$data->referral_code = $checkAff->phone;
								$data->id_customer_aff = $checkAff->id;
							}
						}
						

				        $modelCustomer->save($data);

				        $checkPhone = $data;
				        
				        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
				        $return['infoCustomer'] =  $checkPhone;
				    }

				    if(!empty($checkPhone)){
				    	if($dataSend['id_campain']){
				    		$checkCustomerReg = $modelCampainCustomers->find()->where(['id_campain'=>(int) $dataSend['id_campain'], 'id_customer'=> $checkPhone->id])->first();
				    	}
				    	

				    	if(empty($checkCustomerReg)){
				    		$infoCampain->codeUser ++;
				    		$modelCampains->save($infoCampain);

				    		$dataCampainCustomers = $modelCampainCustomers->newEmptyEntity();

				    		$dataCampainCustomers->id_campain = (int) $dataSend['id_campain'];
				    		$dataCampainCustomers->id_customer = $checkPhone->id;
				    		$dataCampainCustomers->create_at = time();
				    		$dataCampainCustomers->code = $infoCampain->codeUser;
				    		$dataCampainCustomers->note = $dataSend['note'];

				    		$modelCampainCustomers->save($dataCampainCustomers);

				    		if(empty($dataSend['hiddenMessages']) || $dataSend['hiddenMessages']!=1){
		                        $return['messages']= array(array('text'=>'Mã số đăng ký của bạn là '.$dataCampainCustomers->code));
		                    }else{
		                        unset($return['messages']);
		                    }

		                    $return['set_attributes']['codeQT']= $dataCampainCustomers->code;
				    	}else{
				    		if(empty($dataSend['hiddenMessages']) || $dataSend['hiddenMessages']!=1){
		                        $return['messages']= array(array('text'=>'Mã số đăng ký của bạn là '.$checkCustomerReg->code));
		                    }else{
		                        unset($return['messages']);
		                    }

		                    $return['set_attributes']['codeQT']= $checkCustomerReg->code;
				    	}
				    }else{
				    	$return['messages']= array(array('text'=>'Hệ thống không xác định được người dùng số điện thoại '.$dataSend['phone']));
				    }

				}else{
					$return['messages']= array(array('text'=>'Tài khoản này chưa có SPA'));
				}
			}else{
				$return['messages']= array(array('text'=>'Gửi sai id_campain'));
			}
	    }else{
	    	$return['messages']= array(array('text'=>'Gửi thiếu name, phone hoặc id_campain'));
	    }
    }
    return $return;
}


function addCustomerApi($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

	$return = [];

	$modelCampains = $controller->loadModel('Campains');
	$modelCampainCustomers = $controller->loadModel('CampainCustomers');
	$modelCustomer = $controller->loadModel('Customers');
	$modelMembers  = $controller->loadModel('Customers');
	$modelSpas = $controller->loadModel('Spas');

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'], '','staff');

            if(empty($infoMember)){
            	return apiResponse(3,'Tài khoản không tồn tại hoặc sai token');
           }

           if(empty($dataSend['id_staff'])){
           		$dataSend['id_staff'] = $infoMember->id;
           }
            if(empty($dataSend['id_spa'])){
           		$dataSend['id_spa'] = $infoMember->id_spa;
           }
            if(empty($dataSend['id_member'])){
           		$dataSend['id_member'] = $infoMember->id_member;
           }
       }

       // lấy data edit
			    if(!empty($dataSend['id'])){
			        $data = $modelCustomer->get( (int) $dataSend['id']);
			        
			    }else{
			        $data = $modelCustomer->newEmptyEntity();
			        $data->created_at = time();
			        $data->point = 0;
			    }


        if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['id_member']) ){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);
        	$listSpa = $modelSpas->find()->where(['id_member'=>(int) $dataSend['id_member']])->all()->toList();

        		if(!empty($listSpa)){
        			if(empty($dataSend['id_spa'])) $dataSend['id_spa'] = $listSpa[0]->id;

		        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=> (int) $dataSend['id_member']];
		        	$checkPhone = $modelCustomer->find()->where($conditions)->first();

		        	if(empty($checkPhone) || (!empty($dataSend['id']) && $dataSend['id']==$checkPhone->id) ){
				   		
				        $data->name = $dataSend['name'];
				        $data->id_member =(int) $dataSend['id_member'];
				        $data->id_spa = (int) $dataSend['id_spa'];
				        $data->phone = $dataSend['phone'];
				        $data->sex = $dataSend['sex'];
				        $data->email = @$dataSend['email'];
				        $data->address = @$dataSend['address'];
				        $data->source = @$dataSend['source'];
				        $data->id_group = @$dataSend['id_group'];
				        $data->updated_at = time();
				        

				        if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
							$avatar = uploadImage($data->phone, 'avatar', 'avatar'.$data->phone);
						}

						if(!empty($avatar['linkOnline'])){

							$data->avatar = $avatar['linkOnline'].'?time='.time();
			    		}

			    		if(empty($data->avatar)){
			    			$data->avatar = $urlHomes.'/plugins/databot_spa/view/home/assets/img/avatar-default.png';
			    		}


				        $data->id_staff = (int) $dataSend['id_staff'];
				        $data->note = '';

						
						if(!empty($dataSend['referral_code'])){
							$dataSend['referral_code'] = trim(str_replace(array(' ','.','-'), '', $dataSend['referral_code']));
	        				$dataSend['referral_code'] = str_replace('+84','0',$dataSend['referral_code']);

							$checkAff = $modelCustomer->find()->where(['phone'=>$dataSend['referral_code'], 'id_member'=> (int) $dataSend['id_member']])->first();

							if(!empty($checkAff)){
								$data->referral_code = $checkAff->phone;
								$data->id_customer_aff = $checkAff->id;
							}
						}
						

				        $modelCustomer->save($data);
				        return  array(1 ,'Lưu dữ liệu thành công',$data);
				    }
				  	return apiResponse(3,'Lỗi hệ thống' );
				}
				return apiResponse(3,'Tài khoản không tồn tại' );
			}
			return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}


function listCategoryCustomerAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCategoryCustomer','customer');
			if(!empty($infoUser)){ 
				$limit = 20;
				$order = ['status'=>'desc','id' => 'DESC'];

				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
		        $conditions = array('type' => 'category_customer', 'id_member'=>$infoUser->id_member);
		        $listData = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->all()->toList();
		        $totalData = $modelCategories->find()->where($conditions)->count();

		      	return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addCategoryCustomerAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCategoryCustomer','customer');
			if(!empty($infoUser)){

		// lấy data edit
	    if(!empty($dataSend['id'])){
	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id'], 'type'=>'category_customer'])->first();
	    }else{
	        $data = $modelCategories->newEmptyEntity();
	        $data->created_at = time();
	    }
	  
	        	// tạo dữ liệu save
			    $data->name = @$dataSend['name'];
			    $data->type = 'category_customer';
			    $data->slug = createSlugMantan($data->name).'-'.time();

			    $modelCategories->save($data);

			    return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailCategoryCustomerAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCategoryCustomer','customer');
			if(!empty($infoUser)){

	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id'], 'type'=>'category_customer'])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteCategoryCustomerAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;


        $infoUser = $session->read('infoUser');
        $modelCustomer = $controller->loadModel('Customers');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteCategoryCustomer','customer');
			if(!empty($infoUser)){
	            $conditions = array('id'=> $dataSend['id'], 'type' => 'category_customer', 'id_member'=>$infoUser->id_member);
	            
	            $data = $modelCategories->find()->where($conditions)->first();

	            $checkSevice = $modelCustomer->find()->where(array('id_category'=>$data->id))->all()->toList();
	            if(empty($checkSevice)){
	                if(!empty($data)){
	                    $modelCategories->delete($data);
	                    return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(5,'không xóa được dữ liệu' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listSourceCustomerAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listSourceCustomer','customer');
			if(!empty($infoUser)){ 
				$limit = 20;
				$order = ['status'=>'desc','id' => 'DESC'];

				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
		        $conditions = array('type' => 'category_source_customer', 'id_member'=>$infoUser->id_member);
		        $listData = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->all()->toList();
		        $totalData = $modelCategories->find()->where($conditions)->count();

		      	return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addSourceCustomerAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listSourceCustomer','customer');
			if(!empty($infoUser)){

		// lấy data edit
	    if(!empty($dataSend['id'])){
	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id'], 'type'=>'category_source_customer'])->first();
	    }else{
	        $data = $modelCategories->newEmptyEntity();
	        $data->created_at = time();
	    }
	  
	        	// tạo dữ liệu save
			    $data->name = @$dataSend['name'];
			    $data->type = 'category_service';
			    $data->slug = createSlugMantan($data->name).'-'.time();

			    $modelCategories->save($data);

			    return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailSourceCustomerAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listSourceCustomer','customer');
			if(!empty($infoUser)){

	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id'], 'type'=>'category_source_customer'])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteSourceCustomerAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;


    $infoUser = $session->read('infoUser');
    $modelCustomer = $controller->loadModel('Customers');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteCategoryCustomer','customer');
			if(!empty($infoUser)){
	            $conditions = array('id'=> $dataSend['id'], 'type' => 'category_source_customer', 'id_member'=>$infoUser->id_member);
	            
	            $data = $modelCategories->find()->where($conditions)->first();

	            $checkSevice = $modelCustomer->find()->where(array('id_category'=>$data->id))->all()->toList();
	            if(empty($checkSevice)){
	                if(!empty($data)){
	                    $modelCategories->delete($data);
	                    return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(5,'không xóa được dữ liệu' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listCustomerAPI($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $session;
	global $isRequestPost;

	$modelCustomer = $controller->loadModel('Customers');
	$modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCustomer','customer');
			if(!empty($infoUser)){	

				$conditions = array('id_member'=>$infoUser->id_member);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['phone'])){
					$conditions['phone'] = $dataSend['phone'];
				}

				if(!empty($dataSend['email'])){
					$conditions['email'] = $dataSend['email'];
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}
				
				$listData = $modelCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
				
				if(!empty($listData)){
					foreach($listData as $key => $item){
						$listData[$key]->Prepaycard = count($modelCustomerPrepaycard->find()->where(array('id_customer'=>$item->id))->all()->toList());
						if(!empty($item->id_group)){
							$listData[$key]->category = $modelCategories->find()->where(array('id'=>@$item->id_group))->first();
						}
					}
				}
				$totalData = $modelCustomer->find()->where($conditions)->count();
				return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailCustomerAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelCustomer = $controller->loadModel('Customers');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCustomer','customer');
			if(!empty($infoUser)){

	        $data = $modelCustomer->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


?>