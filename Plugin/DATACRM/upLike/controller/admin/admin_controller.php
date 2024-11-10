<?php
function settingUpLikeAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt Tăng tương tác';
    $mess= '';
    $conditions = array('key_word' => 'settingUpLikeAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'tokenOngTrum' => $dataSend['tokenOngTrum'],
                        'multiplier' => (int) $dataSend['multiplier'],
                    );

        $data->key_word = 'settingUpLikeAdmin';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data', $data_value);
    setVariable('mess', $mess);
}