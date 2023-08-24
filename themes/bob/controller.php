<?php 
function settingHomeThemeBOB($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeBOB');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 
    					'facebook' => $dataSend['facebook'],
    					'youtube' => $dataSend['youtube'],
    					'tiktok' => $dataSend['tiktok'],
    					'instagram' => $dataSend['instagram'],
    					'pinterest' => $dataSend['pinterest'],
    					'twitter' => $dataSend['twitter'], 
                        'id_slide' => $dataSend['id_slide'], 

                        // Section 1
                        'title_section1' => $dataSend['title_section1'], 
                        'titlesub_section1' => $dataSend['titlesub_section1'], 

                        // Section 2
                        'title_section2' => $dataSend['title_section2'], 
                        'titlesub_section2' => $dataSend['titlesub_section2'], 

                        // Section 3
                        'title_section3' => $dataSend['title_section3'], 
                        'titlesub_section3' => $dataSend['titlesub_section3'], 
                        'image_section3' => $dataSend['image_section3'], 


                        // Chân trang
                        'title3_footer' => $dataSend['title3_footer'], 
                        'hotline_footer' => $dataSend['hotline_footer'], 
                        'link_hotline_footer' => $dataSend['link_hotline_footer'], 
                        'address_footer' => $dataSend['address_footer'], 
                        'link_address_footer' => $dataSend['link_address_footer'], 
                        'email_footer' => $dataSend['email_footer'], 
                        'link_email_footer' => $dataSend['link_email_footer'], 
                        
                    );

        $data->key_word = 'settingHomeThemeBOB';
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

    // // Slide photo ảnh
    // $conditions = array('id_category'=>3);
    // $limit = 8;
    // $page = 1;
    // $order = array('id'=>'desc');
 
    // $album_photo = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    //  // Slide photo ảnh
    //  $modelProjects = $controller->loadModel('Projects');
    //  $conditions = array();
    //  $order = array('id'=>'desc');
 
    //  $home_projects = $modelProjects->find()->where($conditions)->order($order)->all()->toList();

    

    setVariable('slide_home', $slide_home);
    // setVariable('album_photo', $album_photo);
    // setVariable('home_projects', $home_projects);

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