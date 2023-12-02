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
    $conditions = array('id_album'=>3);
    $order = array('id'=>'desc');
 
    $album_photo = $modelAlbuminfos->find()->where($conditions)->order($order)->all()->toList();

     // Slide photo ảnh
     $modelProjects = $controller->loadModel('Projects');
     $conditions = array();
     $order = array('id'=>'asc');
 
     $home_projects = $modelProjects->find()->where($conditions)->order($order)->all()->toList();

    

    setVariable('slide_home', $slide_home);
    setVariable('album_photo', $album_photo);
    setVariable('home_projects', $home_projects);

}

function postTheme($input)
{
    global $modelPosts;
   
    $slug= $_SERVER['REQUEST_URI'];
       
    if(!empty($slug)){
        $slug = explode('.html', $slug);
        $slug = $slug[0];
        $slug = str_replace('/', '', $slug);

        $conditions = array('slug'=>$slug);

        $data = $modelPosts->find()->where($conditions)->first();
    
        if($data){
            // lấy danh sách tin tức khác
            $conditions = array('id !='=>$data->id, 'type'=>$data->type);
            $limit = 10;
            $page = 1;
            $order = array('id'=>'desc');
            
            $otherNews = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            setVariable('otherNews', $otherNews);
        }
    }

}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    $modelPosts = $controller->loadModel('Posts');
    // TIN TỨC MỚI
    $conditions = array('type'=>'post');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');
    $news = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

  

    // Tin tức nổi bật
    $conditions = array('idCategory'=>"1");
    $order = array('id'=>'desc');

    $highligh_post = $modelPosts->find()->where($conditions)->order($order)->all()->toList();

    // WARM Facility News 
    $conditions = array('idCategory'=>"4");
    $order = array('id'=>'desc');

    $facility_post = $modelPosts->find()->where($conditions)->order($order)->all()->toList();


    // Projects News 
    $conditions = array('idCategory'=>"7");
    $order = array('id'=>'desc');
    $project_post = $modelPosts->find()->where($conditions)->order($order)->all()->toList();

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('category_post', $category_post);
    setVariable('highligh_post', $highligh_post);
    setVariable('facility_post', $facility_post);
    setVariable('project_post', $project_post);

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