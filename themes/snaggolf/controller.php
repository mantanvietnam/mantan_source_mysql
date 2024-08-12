<?php 
function settingHomeThemeSnagGolf($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeSnagGolf');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'logo' => $dataSend['logo'],

                        'welcome_title_1' => $dataSend['welcome_title_1'],
                        'welcome_title_2' => $dataSend['welcome_title_2'],
                        'welcome_title_3' => $dataSend['welcome_title_3'],
                        'welcome_title_4' => $dataSend['welcome_title_4'],
                        'welcome_title_main' => $dataSend['welcome_title_main'],

                        'course_title' => $dataSend['course_title'],
                        'middle_title_1' => $dataSend['middle_title_1'],
                        'middle_title_2' => $dataSend['middle_title_2'],
                        'middle_title_3' => $dataSend['middle_title_3'],

                        'middle_card_content_1' => $dataSend['middle_card_content_1'],
                        'middle_card_content_2' => $dataSend['middle_card_content_2'],
                        'middle_card_content_3' => $dataSend['middle_card_content_3'],

                        'trainer_name' => $dataSend['trainer_name'],

                        'course_info_header' => $dataSend['course_info_header'],
                        'course_time_1' => $dataSend['course_time_1'],
                        'course_place_1' => $dataSend['course_place_1'],
                        'course_time_2' => $dataSend['course_time_2'],
                        'course_place_2' => $dataSend['course_place_2'],
                        'course_time_3' => $dataSend['course_time_3'],
                        'course_place_3' => $dataSend['course_place_3'],

                        'footer_content' => $dataSend['footer_content'],
                    );

        $data->key_word = 'settingHomeThemeSnagGolf';
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







function settingTrainerCourseThemeSnagGolf($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang khoá học';
    $mess= '';

    $conditions = array('key_word' => 'settingTrainerCourseThemeSnagGolf');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'trainer_title' => $dataSend['trainer_title'],

                        'content_info_trainer_course' => $dataSend['content_info_trainer_course'],

                        'trainer_title_1' => $dataSend['trainer_title_1'],
                        'trainer_content_1' => $dataSend['trainer_content_1'],
                        'trainer_title_2' => $dataSend['trainer_title_2'],
                        'trainer_content_2' => $dataSend['trainer_content_2'],
                        'trainer_title_3' => $dataSend['trainer_title_3'],
                        'trainer_content_3' => $dataSend['trainer_content_3'],

                        'trainer_paragraph' => $dataSend['trainer_paragraph'],
                    );

        $data->key_word = 'settingTrainerCourseThemeSnagGolf';
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
    global $modelPosts;
    global $settingThemes;
    global $controller;
    global $modelAlbuminfos;

 

    //SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');


    // TIN TỨC MỚI
    $conditions = array('type'=>'post');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $listPosts= $modelPosts->find()->limit(12)->where(array('type'=>'post'))->order($order)->all()->toList();
    $otherPosts= $modelPosts->find()->limit(12)->where(array('type'=>'post'))->order($order)->all()->toList();

    setVariable('listPosts', $listPosts);
    setVariable('otherPosts', $otherPosts);
 
}

function postTheme($input)
{
    global $controller;
    global $modelCategories;

    

     // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('category_post', $category_post);
    
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{
    global $controller;
    global $modelCategories;

    

    // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

 

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

   
    setVariable('category_post', $category_post);
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