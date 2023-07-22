<?php
function settingSmaxbotAdmin($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt Smax Bot';
    $mess= '';

    $conditions = array('key_word' => 'settingSmaxBotProduct');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'idBlockNewOrder' => $dataSend['idBlockNewOrder'],
                    );

        $data->key_word = 'settingSmaxBotProduct';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data_value', $data_value);
    setVariable('mess', $mess);
}
?>