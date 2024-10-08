<?php 
function setingBankAccount($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingBankAccount');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'bank_name' => @$dataSend['bank_name'],
                        'bank_number' => @$dataSend['bank_number'],
                        'bank_code' => @$dataSend['bank_code'],
                        'referral_commission' => @$dataSend['referral_commission'],
                       
                    );
        $data->key_word = 'setingBankAccount';
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