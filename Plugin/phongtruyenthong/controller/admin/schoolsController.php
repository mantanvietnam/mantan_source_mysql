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
                        'video_local' => $dataSend['video_local'],
                        'video_mc' => $dataSend['video_mc'],

    					'address' => $dataSend['address'],
    					'phone' => $dataSend['phone'],
    					'email' => $dataSend['email'],
    					'info' => $dataSend['info'],
                        
                        'audio_background' => $dataSend['audio_background'],
                        
                        // dòng thời gian
                        'image_timeline' => $dataSend['image_timeline'],
                        'info_timeline' => $dataSend['info_timeline'],
                        'id_album_event' => $dataSend['id_album_event'],

                        // thành tích nhà trường
                        'id_album_achievement' => $dataSend['id_album_achievement'],
                        
                        
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

function configRoom3DAdmin($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt hiển thị phòng 3D';
    $mess= '';

    $conditions = array('key_word' => 'configRoom3DAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'color' => $dataSend['color'],
                        'video_tvc' => $dataSend['video_tvc'],
                        'video_mc' => $dataSend['video_mc'],
                        'pillar_logo' => $dataSend['pillar_logo'],
                    );

        $data->key_word = 'configRoom3DAdmin';
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