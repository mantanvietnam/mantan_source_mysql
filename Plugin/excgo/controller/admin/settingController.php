<?php 
function settingAdmin($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'pilePercentage' => @$dataSend['pilePercentage'],
                        'maximumTrip' => @$dataSend['maximumTrip'],
                        'moneyUpgradeToDriver' => @$dataSend['moneyUpgradeToDriver'],
                        'contentUpgradeToDriver' => @$dataSend['contentUpgradeToDriver'],
                        'contentPopupUpgradeToDriver' => @$dataSend['contentPopupUpgradeToDriver'],
                        'convertPointMoney' => @$dataSend['convertPointMoney'],
                        'minimumPointSold' => @$dataSend['minimumPointSold'],
        				'pointControl' => @$dataSend['pointControl'],
                    );
        $data->key_word = 'settingAdmin';
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
