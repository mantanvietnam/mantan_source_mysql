<?php
function settingPhoenixAI($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;
    global $listBank;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingPhoenixAI');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'api_key_dify' => @$dataSend['api_key_dify'],
                       
                    );
        $data->key_word = 'settingPhoenixAI';
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
?>