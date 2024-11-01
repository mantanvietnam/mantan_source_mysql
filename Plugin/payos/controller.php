<?php
function addMoneyPayOSBankAPI($input)
{

	$json = file_get_contents('php://input');

	$data = json_decode($json, true);

	if(!empty($data['data'])){
		$datas =$data['data'];
		$id_ransaction = explode(" ", $datas['description']);
		$ransaction = (int)$id_ransaction[0];
		processAddMoney($datas['amount'], $ransaction);
		return array('code'=>1, 'mess'=>'bạn giao dịch thành công');
	}
	return array('code'=>0, 'mess'=>'giao dịch không thành công');
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
