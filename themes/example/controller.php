<?php 
function settingHomeThemeExample($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeExample');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'name_web' => $dataSend['name_web'],
    					'time_open' => $dataSend['time_open'],
    					'id_slide' => $dataSend['id_slide'],
                    );

        $data->key_word = 'settingHomeThemeExample';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->content)){
        $data_value = json_decode($data->content, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function indexTheme($input)
{
	
}

function postTheme($input)
{
	
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{

}

function categoryAlbumTheme($input)
{

}

function categoryVideoTheme($input)
{

}

function albumTheme($input)
{
    
}

function videoTheme($input)
{
    
}

?>