<?php
function sendSMS($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    global $modelCategoryConnects;

   	$user = checklogin('sendSMS');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/');
        }
	    $metaTitleMantan = 'Gửi tin SMS';
		$mess= '';

		$modelCampaigns = $controller->loadModel('Campaigns');
		$modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
		$modelMembers = $controller->loadModel('Members');
		$modelCustomers = $controller->loadModel('Customers');
		$modelTransactionHistories = $controller->loadModel('TransactionHistories');

		$infoUser = $modelMembers->find()->where(['id'=>$user->id])->first();

		// danh sách chiến dịch
		$conditions = array('id_member'=>$session->read('infoUser')->id);
		$listCampaign = $modelCampaigns->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

		// danh sách nhóm khách hàng
		$conditions = array('type' => 'group_customer', 'parent'=>$session->read('infoUser')->id);
        $listGroupCustomer = $modelCategories->find()->where($conditions)->all()->toList();

        // danh sách chức danh đại lý
        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active');
        $listPositions = $modelCategories->find()->where($conditions)->all()->toList();

		if ($isRequestPost) {
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['mess']) && !empty($dataSend['type_user'])){
				if($dataSend['type_user'] == 'customer_campaign'){
	        		if(!empty($dataSend['id_campaign'])){
	        			$infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$session->read('infoUser')->id])->first();

	        			if(!empty($infoCampaign)){
	        				$conditions = array('id_member'=>$session->read('infoUser')->id, 'id_campaign'=>(int) $infoCampaign->id);

	        				$listCampaignCustomers = $modelCampaignCustomers->find()->where($conditions)->all()->toList();

	        				if(!empty($listCampaignCustomers)){
			                    foreach ($listCampaignCustomers as $key => $value) {
			                        // thông tin khách hàng
			                        $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();

			                        if(!empty($checkCustomer)){
			                        	$listCustomers[] = $checkCustomer;
			                    	}
			                    }
			                }
	        			}
	        		}
	        	}elseif($dataSend['type_user'] == 'customer_group'){
	        		if(!empty($dataSend['id_group_customer'])){
	        			$infoGroup = $modelCategories->find()->where(['id'=>(int) $dataSend['id_group_customer'], 'parent'=>$session->read('infoUser')->id, 'type' => 'group_customer'])->first();

	        			if(!empty($infoGroup)){
		        			$customer_in_group = $modelCategoryConnects->find()->where(['keyword'=>'group_customers','id_category'=> (int) $dataSend['id_group_customer']])->all()->toList();

		        			if(!empty($customer_in_group)){
		        				foreach ($customer_in_group as $key => $value) {
		        					// thông tin khách hàng
			                        $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_parent])->first();

			                        if(!empty($checkCustomer)){
			                        	$listCustomers[] = $checkCustomer;
			                    	}
		        				}
		        			}
		        		}
	        		}else{
	        			$join = [
						            [
						                'table' => 'category_connects',
						                'alias' => 'CategoryConnects',
						                'type' => 'LEFT',
						                'conditions' => [
						                    'Customers.id = CategoryConnects.id_parent'
						                ],
						            ]
						        ];

						$select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

						$conditions = array('CategoryConnects.id_category'=>$session->read('infoUser')->id, 'CategoryConnects.keyword'=>'member_customers');

	        			$listCustomers = $modelCustomers->find()->join($join)->select($select)->where($conditions)->all()->toList();
	        		}
	        	}elseif($dataSend['type_user'] == 'member_position'){
	        		if(!empty($dataSend['id_position'])){
	        			$infoPosition = $modelCategories->find()->where(['id'=>(int) $dataSend['id_position'], 'type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active'])->first();

	        			if(!empty($infoPosition)){
	        				$listCustomers = $modelMembers->find()->where(['id_position'=>(int) $dataSend['id_position']])->all()->toList();
	        			}
	        		}
	        	}elseif($dataSend['type_user'] == 'test'){
	        		if(!empty($dataSend['phone_test'])){
	        			$infoCustomer = $modelCustomers->newEmptyEntity();

	        			$dataSend['phone_test'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_test']));
	        			$dataSend['phone_test'] = str_replace('+84','0',$dataSend['phone_test']);

	        			$infoCustomer->id = 0;
	        			$infoCustomer->full_name = 'Khách Test';
	        			$infoCustomer->phone = $dataSend['phone_test'];

	        			$listCustomers[] = $infoCustomer;
	        		}
	        	}
	        	
	        	if(!empty($listCustomers)){
					$requestMoney = 700 * count($listCustomers);

					if($infoUser->coin >= $requestMoney){
						$numberSend = 0;
				        foreach ($listCustomers as $customer) {
				        	if(strlen($customer->phone)==10){
				        		$id_history_sms = rand(1, 1000);
				        		$return = sendSMSByESMS($customer->phone, $dataSend['mess'], $id_history_sms);

				        		if($return == 1){
				        			$numberSend ++;
				        		}
				        	}
				        }

				        if($numberSend > 0){
					        // trừ tiền tài khoản
					        $requestMoney = $numberSend * 700;

					        $infoUser->coin -= $requestMoney;
					        $modelMembers->save($infoUser);

					        // tạo lịch sử giao dịch
			                $histories = $modelTransactionHistories->newEmptyEntity();

			                $histories->id_member = $infoUser->id;
			                $histories->id_system = $infoUser->id_system;
			                $histories->coin = $requestMoney;
			                $histories->type = 'minus';
			                $histories->note = 'Trừ tiền dịch vụ gửi '.number_format($numberSend).' tin nhắn SMS cho khách hàng, số dư tài khoản sau giao dịch là '.number_format($infoUser->coin).'đ, nội dung tin nhắn gửi: '.$dataSend['mess'];
			                $histories->create_at = time();
			                
			                $modelTransactionHistories->save($histories);
			                $note = $user->type_tv.' '. $user->name.' đã gửi tin nhắn SMS cho khách hàng nội dung là '.@$dataSend['mess'];
                 			addActivityHistory($user,$note,'sendSMS',0);
					        $mess = '<p class="text-success">Gửi thành công '.number_format($numberSend).' tin nhắn SMS cho khách hàng</p>';
				        }else{
				        	$mess= '<p class="text-danger">Không gửi được tin nhắn cho khách hàng nào</p>';
				        }
					}else{
				    	$mess = '<p class="text-danger">Tài khoản bạn không đủ tiền, vui lòng nạp thêm '.number_format($requestMoney).'đ để gửi tin nhắn cho '.number_format(count($listCustomers)).' khách hàng. Liên hệ hotline 081.656.000 để được hỗ trợ nạp tiền</p>';	
				    }
				}else{
		        	$mess= '<p class="text-danger">Không tìm được khách hàng phù hợp</p>';
		        }
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('mess', $mess);
	    setVariable('listCampaign', $listCampaign);
	    setVariable('listGroupCustomer', $listGroupCustomer);
	    setVariable('listPositions', $listPositions);
	    setVariable('infoUser', $infoUser);
	}else{
		return $controller->redirect('/login');
	}
}
?>