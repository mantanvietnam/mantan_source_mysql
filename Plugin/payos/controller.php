<?php
function addMoneyPayOSBankAPI($input)
{

	global $controller;
	global $isRequestPost;

	// $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['code']) && !empty($dataSend['desc']) && !empty($dataSend['success']) && !empty($dataSend['data'])){
			if($dataSend['success']==true){
				$data =json_decode($dataSend['data'], true);
				$id_ransaction = explode(" ", $data['description']);
				processAddMoney($data['amount'], $id_ransaction[0]);
			

					return array('code'=>0, 'mess'=>'bạn giao dịch thành công');

			}
			return array('code'=>0, 'mess'=>'không phải nhận khoản');

		}
	return array('code'=>0, 'mess'=>'thiếu dữ liệu');

	}

	return array('code'=>0, 'mess'=>'Bắt buộc sử dụng phương thức POST');
}

function settingpayos($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingPayos');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'client_id' => @$dataSend['client_id'],
                        'api_key' => @$dataSend['api_key'],
                        'checksum_key' => @$dataSend['checksum_key']
                       
                    );
        $data->key_word = 'settingPayos';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function checkthangtoan(){
	debug(checkpayos());
	die;
}
?>
