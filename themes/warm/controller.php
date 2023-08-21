<?php 
function settingHomeThemeWarm($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeWarm');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'name_button_sub' => $dataSend['name_button_sub'],
    					'link_button_sub' => $dataSend['link_button_sub'],
                        'id_slide' => $dataSend['id_slide'],

    					'facebook' => $dataSend['facebook'],
    					'youtube' => $dataSend['youtube'],
    					'tiktok' => $dataSend['tiktok'],
    					'instagram' => $dataSend['instagram'],
    					'linkedIn' => $dataSend['linkedIn'],
    					'twitter' => $dataSend['twitter'],

                        // section 1
                        'title_section_1' => $dataSend['title_section_1'],
                        'title_content_section_1' => $dataSend['title_content_section_1'],
                        'title_sub_section_1' => $dataSend['title_sub_section_1'],
                        'content_section_1' => $dataSend['content_section_1'],
                        'link_video_section_1' => $dataSend['link_video_section_1'],
                        
                        // section 2
                        'title_section_2' => $dataSend['title_section_2'],

                        // section 3
                        'title_section_3' => $dataSend['title_section_3'],
                        'title_content_1_section_3' => $dataSend['title_content_1_section_3'],
                        'content_1_section_3' => $dataSend['content_1_section_3'],
                        'title_content_2_section_3' => $dataSend['title_content_2_section_3'],
                        'content_2_section_3' => $dataSend['content_2_section_3'],
                        'title_content_3_section_3' => $dataSend['title_content_3_section_3'],
                        'content_3_section_3' => $dataSend['content_3_section_3'],
                        'title_content_4_section_3' => $dataSend['title_content_4_section_3'],
                        'content_4_section_3' => $dataSend['content_4_section_3'],

                        // section 4
                        'title_section_4' => $dataSend['title_section_4'],

                        // Chân trang
                        'title_1_section_footer' => $dataSend['title_1_section_footer'],
                        'address_section_footer' => $dataSend['address_section_footer'],
                        'tel_section_footer' => $dataSend['tel_section_footer'],
                        'title_2_section_footer' => $dataSend['title_2_section_footer'],
                        'address_2_section_footer' => $dataSend['address_2_section_footer'],
                        'address_2_2_section_footer' => $dataSend['address_2_2_section_footer'],
                        'tel_2_section_footer' => $dataSend['tel_2_section_footer'],



                    );

        $data->key_word = 'settingHomeThemeWarm';
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

    // SLIDE HOME
    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }

    // Slide photo ảnh
    $conditions = array('id_category'=>3);
    $limit = 8;
    $page = 1;
    $order = array('id'=>'desc');
 
    $album_photo = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


    setVariable('slide_home', $slide_home);
    setVariable('album_photo', $album_photo);

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