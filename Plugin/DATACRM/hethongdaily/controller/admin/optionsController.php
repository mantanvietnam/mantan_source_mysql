<?php
function moduleSystemAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelOptions;

    $metaTitleMantan = 'Cài đặt module';
    $mess = '';

    $config = $modelOptions->find()->where(['key_word' => 'crm_module'])->first();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        
        if (empty($config)) {
            $config = $modelOptions->newEmptyEntity();
            $config->key_word = 'crm_module';
        }

        $value = [];
        if(!empty($dataSend['crm_module'])){
            $value = $dataSend['crm_module'];
        }
        
        $config->value = json_encode($value);

        $modelOptions->save($config);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($config->value)){
        $data_value = json_decode($config->value, true);
    }

    setVariable('data_value', $data_value);
    setVariable('mess', $mess);
}

function setingParameterAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingParameterAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array('payment' => @$dataSend['payment'],
                    );
        $data->key_word = 'setingParameterAdmin';
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