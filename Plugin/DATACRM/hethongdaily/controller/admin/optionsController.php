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
?>