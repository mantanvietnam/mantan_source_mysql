<?php 
function saveFeedbackAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelCustomer = $controller->loadModel('Customers');
	$modelFeedback = $controller->loadModel('Feedbacks');
	$modelFeedbackinfo = $controller->loadModel('Feedbackinfos');

	$return = array('code'=>1,
					'set_attributes'=>array(),
					'messages'=>array(array('text'=>''))
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['phone'])){

			$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
			$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

			$checkUser = $modelCustomer->find()->where(array('phone'=>$dataSend['phone']))->first();

			// nếu chưa có tài khoản thì tạo tài khoản mới
			if(empty($checkUser)){
				if(!empty($dataSend['sex'])){
					$dataSend['sex'] = strtolower($dataSend['sex']);

					if($dataSend['sex']=='male') $dataSend['sex']=1;
					if($dataSend['sex']=='female') $dataSend['sex']=0;
				}

				if(empty($dataSend['id_city'])) $dataSend['id_city']=1;
				if(empty($dataSend['status'])) $dataSend['status']='active';
				if(empty($dataSend['pass'])) $dataSend['pass']= $dataSend['phone'];
				if(empty($dataSend['id_parent'])) $dataSend['id_parent']= 0;
				if(empty($dataSend['id_level'])) $dataSend['id_level']= 0;
				if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';

				if(!empty($dataSend['full_name'])){
					$birthday_date = 0;
					$birthday_month = 0;
					$birthday_year = 0;

					$birthday = explode('/', trim($dataSend['birthday']));
					if(count($birthday)==3){
						$birthday_date = (int) $birthday[0];
						$birthday_month = (int) $birthday[1];
						$birthday_year = (int) $birthday[2];
					}

					$dataCustomer = array(	'full_name'=>$dataSend['full_name'],
		    								'phone'=>$dataSend['phone'],
		    								'email'=>@$dataSend['email'],
		    								'address'=>@$dataSend['address'],
		    								'sex'=>(int) @$dataSend['sex'],
		    								'id_city'=>(int) @$dataSend['id_city'],
		    								'id_messenger'=>@$dataSend['id_messenger'],
		    								'avatar'=>@$dataSend['avatar'],
		    								'status'=>@$dataSend['status'],
		    								'pass'=>@$dataSend['pass'],
		    								'id_parent'=>(int) @$dataSend['id_parent'],
		    								'id_level'=>(int) @$dataSend['id_level'],
		    								
		    								'birthday_date'=>(int) @$birthday_date,
		    								'birthday_month'=>(int) @$birthday_month,
		    								'birthday_year'=>(int) @$birthday_year,
		    						);
		    		$id_customer = addCustomer($dataCustomer);

		    		$checkUser = $modelCustomer->get($id_customer);
				}else{
					$return = array('code'=>2,
							'set_attributes'=>array('id_customer'=>0),
							'messages'=>array(array('text'=>'Gửi thiếu họ tên'))
						);
				}
			}

			if(!empty($checkUser)){
				if(!empty($dataSend['id_product']) && !empty($dataSend['point'])){
					$list_rate = $dataSend['point'];
					if(is_string($list_rate)
				      && is_array(json_decode($list_rate, true))
				      && (json_last_error() == JSON_ERROR_NONE)
				    ){
				      $list_rate = json_decode($list_rate, true);
				    } else {
				      $list_rate = [];
				    }

				    // lưu đánh giá
					$saveFeedback = $modelFeedback->newEmptyEntity();

					$saveFeedback->id_product = (int) $dataSend['id_product'];
			        $saveFeedback->id_customer = (int) $checkUser->id;
			        $saveFeedback->note = (string) @$dataSend['note'];
			        $saveFeedback->time_create = time();

			        $modelFeedback->save($saveFeedback);

			        // lưu chi tiết đánh giá
			        if(!empty($list_rate)){
			        	foreach ($list_rate as $id_criteria => $point) {
				        	$feedbackInfo = $modelFeedbackinfo->newEmptyEntity();

				        	$feedbackInfo->id_criteria = (int) $id_criteria;
				        	$feedbackInfo->point = (int) $point;
				        	$feedbackInfo->id_feedback = (int) $saveFeedback->id;
				        	$feedbackInfo->id_customer = (int) $checkUser->id;
				        	$feedbackInfo->id_product = (int) $dataSend['id_product'];

				        	$modelFeedbackinfo->save($feedbackInfo);

				        	$return = array('code'=>0, 
	    						'set_attributes'=>array('id_customer'=>$checkUser->id),
	    						'messages'=>array(array('text'=>'Lưu thông tin thành công'))
	    					);
				        }
			        }
			    }else{
			    	$return = array('code'=>2,
									'set_attributes'=>array('id_customer'=>0),
									'messages'=>array(array('text'=>'Gửi thiếu ID sản phẩm dịch vụ'))
								);
			    }
			}
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>'Gửi thiếu số điện thoại'))
				);
		}
	}

	return $return;
}
?>