<?php
function aiVirtualAssistant($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $modelOptions;
	global $isRequestPost;

	$metaTitleMantan = 'AI trợ lý ảo';

	$modelMembers = $controller->loadModel('Members');
	$modelDataAis = $controller->loadModel('DataAis');

	if(!empty($session->read('infoUser'))){
		$mess = '';
		$member = $session->read('infoUser');

		$conditions = array('id_member' => $member->id);
	    $data = $modelDataAis->find()->where($conditions)->first();
	    if(empty($data)){
	        $data = $modelDataAis->newEmptyEntity();
	    }

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			$value = array( 'personal_story' => $dataSend['personal_story'],
	    					'personal_achievements' => $dataSend['personal_achievements'],

	    					'company_name' => $dataSend['company_name'],
	    					'company_address' => $dataSend['company_address'],
	    					'company_phone' => $dataSend['company_phone'],
	    					'company_tax_code' => $dataSend['company_tax_code'],
	    					'company_vision' => $dataSend['company_vision'],
	                        'company_mission' => $dataSend['company_mission'],
	                        'company_core_value' => $dataSend['company_core_value'],
	                        'company_culture' => $dataSend['company_culture'],
	                        'company_rule' => $dataSend['company_rule'],

	                        'agency_script' => $dataSend['agency_script'],
	                        'agency_reject' => $dataSend['agency_reject'],
	                        'agency_story' => $dataSend['agency_story'],
	                        'agency_plan_content' => $dataSend['agency_plan_content'],

	                        'sell_script' => $dataSend['sell_script'],
	                        'sell_reject' => $dataSend['sell_reject'],
	                        'sell_care_customer' => $dataSend['sell_care_customer'],
	                        'sell_content' => $dataSend['sell_content'],

	                        'business_potential_customers' => $dataSend['business_potential_customers'],
	                        'business_increase_sales' => $dataSend['business_increase_sales'],
	                        'business_returning_customers' => $dataSend['business_returning_customers'],

	                        'newperson_plan' => $dataSend['newperson_plan'],
	                        'newperson_order' => $dataSend['newperson_order'],
	                        'newperson_training' => $dataSend['newperson_training'],

	                        'training_sell' => $dataSend['training_sell'],
	                        'training_culture' => $dataSend['training_culture'],
	                        'training_agency' => $dataSend['training_agency'],
	                        'training_brand' => $dataSend['training_brand'],
	                        'training_plan' => $dataSend['training_plan'],
	                        'training_business' => $dataSend['training_business'],
	                        
	                        'competitor_research' => $dataSend['competitor_research'],
	                        'competitor_compare' => $dataSend['competitor_compare'],

	                        'product' => $dataSend['product'],
	                        
	                        'control_executive' => $dataSend['control_executive'],
	                        'control_mkt' => $dataSend['control_mkt'],
	                        'control_sales' => $dataSend['control_sales'],
	                        'control_business' => $dataSend['control_business'],
	                        'control_finance' => $dataSend['control_finance'],
	                        'control_administration' => $dataSend['control_administration'],
	                        'control_branch' => $dataSend['control_branch'],
	                        'control_person' => $dataSend['control_person'],
	                        'control_device' => $dataSend['control_device'],

	                    );

	        $data->id_member = $member->id;
	        $data->data = json_encode($value);
	        $data->create_ai = 'process';

	        $modelDataAis->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công, hệ thống đang tự động tạo Ai Trợ Lý Ảo cho bạn</p>';
		}

		$data_value = array();
	    if(!empty($data->data)){
	        $data_value = json_decode($data->data, true);
	    }

	    setVariable('data_ai', $data);
	    setVariable('data', $data_value);

		setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function checkapi(){
	callAIphoenixtech('Việt cho tao bai content giới thiệu bản thân');
	debug('abc');
	 die;
}
?>

