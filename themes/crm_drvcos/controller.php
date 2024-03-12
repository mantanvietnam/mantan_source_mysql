<?php
function settingHomeThemeCRMZikii($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeCRMZikii');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
		if($isRequestPost){
			$dataSend = $input['request']->getData();

			 $value = array('logo'=> @$dataSend['logo'],
            				'name_web'=> @$dataSend['name_web'],
                            'content_footer'=> @$dataSend['content_footer'],
                            'background_color'=> @$dataSend['background_color'],

            				'facebook'=> @$dataSend['facebook'],
            				'youtube'=> @$dataSend['youtube'],
                            'tiktok'=> @$dataSend['tiktok'],
                            'instagram'=> @$dataSend['instagram'],
                            'linkedIn'=> @$dataSend['linkedIn'],
                            'twitter'=> @$dataSend['twitter'],

                            'background_image_1'=> @$dataSend['background_image_1'],
                            'image_product_1'=> @$dataSend['image_product_1'],
                            'image_product_2'=> @$dataSend['image_product_2'],
                            'image_product_3'=> @$dataSend['image_product_3'],
                            'image_product_4'=> @$dataSend['image_product_4'],
                            'image_product_5'=> @$dataSend['image_product_5'],

                            'background_image_2'=> @$dataSend['background_image_2'],
                            'background_image_3'=> @$dataSend['background_image_3'],
				

			 );

    

        $data->key_word = 'settingHomeThemeCRMZikii';
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