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
						
						$data->created_at = date('Y-m-d H:i:s');
						$data->point = 0;
				        $data->name = $dataSend['name'];
				        $data->id_member =(int) $dataSend['id_member'];
				        $data->id_spa = (int) $dataSend['id_spa'];
				        $data->phone = $dataSend['phone'];
				        $data->sex = $dataSend['sex'];
				        $data->email = @$dataSend['email'];
				        $data->address = @$dataSend['address'];
				        $data->updated_at = date('Y-m-d H:i:s');
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
						
						$data->created_at = date('Y-m-d H:i:s');
						$data->point = 0;
				        $data->name = $dataSend['name'];
				        $data->id_member =(int) $dataSend['id_member'];
				        $data->id_spa = (int) $dataSend['id_spa'];
				        $data->phone = $dataSend['phone'];
				        $data->sex = $dataSend['sex'];
				        $data->email = @$dataSend['email'];
				        $data->address = @$dataSend['address'];
				        $data->updated_at = date('Y-m-d H:i:s');
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
				        $return = array('code'=>1 ,'mess'=>'Số điện thoại đã tồn tại', 'data'=>$data);
				    }else{
						$return = array('code'=>0 ,'mess'=>'Số điện thoại đã tồn tại');
				    }
				}else{
					$return = array('code'=>0 ,'mess'=>'Tài khoản này chưa có SPA');
				}
			}else{
				$return = array('code'=>0 ,'mess'=>'Gửi sai id_campain');
			}
	    }else{
	    	$return = array('code'=>0 ,'mess'=>'Gửi thiếu name, phone hoặc id_campain');
	    }
    }
    return $return;
}
?>