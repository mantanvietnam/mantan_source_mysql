<?php 
function settingAffiliateAdmin($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;

    $metaTitleMantan = 'Cài đặt hoa hồng giới thiệu';
    $mess= '';

    $conditions = array('key_word' => 'settingAffiliateAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'percent1' => (double) $dataSend['percent1'],
                        'percent2' => (double) $dataSend['percent2'],
                        'percent3' => (double) $dataSend['percent3'],
                        'percent4' => (double) $dataSend['percent4'],
                        'percent5' => (double) $dataSend['percent5'],
                        'percent6' => (double) $dataSend['percent6'],
                        'percent7' => (double) $dataSend['percent7'],
                        'percent8' => (double) $dataSend['percent8'],
                        'percent9' => (double) $dataSend['percent9'],
                        'percent10' => (double) $dataSend['percent10'],
                    );

        $data->key_word = 'settingAffiliateAdmin';
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