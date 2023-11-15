<?php 
function infoSchoolAdmin($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt thông tin trường học';
    $mess= '';

    $conditions = array('key_word' => 'infoSchoolAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'name' => $dataSend['name'],
    					'image' => $dataSend['image'],
    					'logo' => $dataSend['logo'],
    					'video' => $dataSend['video'],

    					'address' => $dataSend['address'],
    					'phone' => $dataSend['phone'],
    					'email' => $dataSend['email'],
    					'info' => $dataSend['info'],
                        'image_donate' => $dataSend['image_donate'],
                        'image_backdrop' => $dataSend['image_backdrop'],
                        'audio_background' => $dataSend['audio_background'],
                        'link_image_360' => $dataSend['link_image_360'],
                        
                        // dòng thời gian
                        'image_timeline' => $dataSend['image_timeline'],
                        'info_timeline' => $dataSend['info_timeline'],
                        'id_album_event' => $dataSend['id_album_event'],

                        // thành tích nhà trường
                        'id_album_achievement' => $dataSend['id_album_achievement'],
                        
                        'image_achievement_1' => $dataSend['image_achievement_1'],
                        'des_achievement_1' => $dataSend['des_achievement_1'],

                        'image_achievement_2' => $dataSend['image_achievement_2'],
                        'des_achievement_2' => $dataSend['des_achievement_2'],

                        'image_achievement_3' => $dataSend['image_achievement_3'],
                        'des_achievement_3' => $dataSend['des_achievement_3'],

                        // hiệu trưởng 
                        'image_principal_1' => $dataSend['image_principal_1'],
                        'des_principal_1' => $dataSend['des_principal_1'],
                        'image_principal_2' => $dataSend['image_principal_2'],
                        'des_principal_2' => $dataSend['des_principal_2'],


                        
                    );

        $data->key_word = 'infoSchoolAdmin';
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