<?php 
function settingCharityCRM($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt chung - Từ thiện';
    $mess= '';

    $conditions = array('key_word' => 'settingCharity2TOPCRM');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

        if(empty($dataSend['logo'])) $dataSend['logo'] = '/plugins/2top_crm_donate/view/home/img/logo.png';
        if(empty($dataSend['background'])) $dataSend['background'] = '/plugins/2top_crm_donate/view/home/img/background.png';
        if(empty($dataSend['textColor'])) $dataSend['textColor'] = '#000';

    	$value = array( 'logo' => $dataSend['logo'],
                        'background' => $dataSend['background'],
                        'textColor' => $dataSend['textColor'],
                    );

        $data->key_word = 'settingCharity2TOPCRM';
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