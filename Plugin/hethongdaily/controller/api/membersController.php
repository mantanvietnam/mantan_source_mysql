<?php 
function getInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['id']))->first();
		}else if(!empty($dataSend['phone'])){
			$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();
		}

		if(!empty($checkPhone)){
			$position = $modelCategories->find()->where(array('id'=>$checkPhone->id_position))->first();
			
			$checkPhone->name_position = @$position->name;
			
			$return = array('code'=>0,
							 'data'=>$checkPhone,
							 'messages'=>array(array('text'=>'Bạn lấy dữ liệu thành công'))
							);
		}else{
			$return = array('code'=>3,
								'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
							);
		}
	
	}

	return $return;
}

function resendOTPAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelZalos = $controller->loadModel('Zalos');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['id']))->first();

			if(!empty($checkPhone)){
				$checkPhone->otp = rand(1000,9999);
				$modelMember->save($checkPhone);

				// gửi mã xác thức qua Zalo
				$zalo = $modelZalos->find()->where(['id_system'=>$checkPhone->id_system])->first();
				
				if(!empty($zalo->access_token)){
					$returnZalo = sendZNSZalo($zalo->template_otp, ['otp'=>$checkPhone->otp], $checkPhone->phone, $zalo->id_oa, $zalo->id_app);

					$return = array('code'=>0,
									'messages'=>array(array('text'=>'Gửi mã OTP thành công')),
									'zalo' => $returnZalo
								);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Hệ thống chưa cài đặt Zalo OA'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
								);
			}
		}else{
			$return = array('code'=>2,
									'messages'=>array(array('text'=>'Bạn thiếu dữ liệu'))
								);
		}
	}

	return $return;
}

?>