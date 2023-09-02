<?php 
function settingHomeThemeKDTC($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeKDTC');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'image_speaker' => $dataSend['image_speaker'],
    					'name_project' => $dataSend['name_project'],
    					'time_learning' => $dataSend['time_learning'],
                        'commit' => $dataSend['commit'],
                        'content_training' => $dataSend['content_training'],
                        'link_reg' => $dataSend['link_reg'],

    					'facebook' => $dataSend['facebook'],
    					'youtube' => $dataSend['youtube'],
    					'tiktok' => $dataSend['tiktok'],
    					'instagram' => $dataSend['instagram'],
    					'linkedIn' => $dataSend['linkedIn'],
    					'twitter' => $dataSend['twitter'],

    					'learn1' => $dataSend['learn1'],
                        'learn2' => $dataSend['learn2'],
                        'learn3' => $dataSend['learn3'],
                        'learn4' => $dataSend['learn4'],
                        'learn5' => $dataSend['learn5'],
                        'learn6' => $dataSend['learn6'],
                        'learn7' => $dataSend['learn7'],
                        'learn8' => $dataSend['learn8'],

                        'title_demand' => $dataSend['title_demand'],
                        'des_demand' => $dataSend['des_demand'],
                        'content_demand' => $dataSend['content_demand'],

                        'introduce' => $dataSend['introduce'],
                        'call_registration' => $dataSend['call_registration'],
                        'video_introduce' => $dataSend['video_introduce'],

                        'title_info_speaker' => $dataSend['title_info_speaker'],
                        'name_speaker' => $dataSend['name_speaker'],
                        'image_speaker2' => $dataSend['image_speaker2'],
                        'info_speaker_introduce' => $dataSend['info_speaker_introduce'],

                        'title_reason_join' => $dataSend['title_reason_join'],
                        'image_speaker3' => $dataSend['image_speaker3'],
                        'info_reason_join' => $dataSend['info_reason_join'],

                        'title_return' => $dataSend['title_return'],
                        'note_return' => $dataSend['note_return'],
                        'return_1' => $dataSend['return_1'],
                        'return_2' => $dataSend['return_2'],
                        'return_3' => $dataSend['return_3'],
                        'return_4' => $dataSend['return_4'],
                        'return_5' => $dataSend['return_5'],
                        'return_6' => $dataSend['return_6'],

                        'should_join' => $dataSend['should_join'],
                        'not_should_join' => $dataSend['not_should_join'],

                        'title_keep_place' => $dataSend['title_keep_place'],
                        'des_keep_place' => $dataSend['des_keep_place'],
                        'title_price_1' => $dataSend['title_price_1'],
                        'price_old_1' => $dataSend['price_old_1'],
                        'price_sell_1' => $dataSend['price_sell_1'],
                        'benefit_1' => $dataSend['benefit_1'],
                        'link_reg_1' => $dataSend['link_reg_1'],
                        'title_price_2' => $dataSend['title_price_2'],
                        'price_old_2' => $dataSend['price_old_2'],
                        'price_sell_2' => $dataSend['price_sell_2'],
                        'benefit_2' => $dataSend['benefit_2'],
                        'link_reg_2' => $dataSend['link_reg_2'],

                        'title_gift' => $dataSend['title_gift'],
                        'list_gift' => $dataSend['list_gift'],
                        'price_gift' => $dataSend['price_gift'],

                        'id_album_course' => $dataSend['id_album_course'],
                        'company' => $dataSend['company'],
                    );

        $data->key_word = 'settingHomeThemeKDTC';
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

function indexTheme($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;

    setVariable('settingThemes', $settingThemes);
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