<?php 
function settingHomeThemeKeToan($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeKeToan');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 
                   // Section 1
                   'title_section1' => $dataSend['title_section1'], 
                   'content_title_section1_1' => $dataSend['content_title_section1_1'], 
                   'content_title_section1_2' => $dataSend['content_title_section1_2'], 
                   'content_title_section1_3' => $dataSend['content_title_section1_3'], 
                   'content_title_section1_4' => $dataSend['content_title_section1_4'], 
                   'content_detail_section1_1' => $dataSend['content_detail_section1_1'], 
                   'content_detail_section1_2' => $dataSend['content_detail_section1_2'], 
                   'content_detail_section1_3' => $dataSend['content_detail_section1_3'], 
                   'content_detail_section1_4' => $dataSend['content_detail_section1_4'], 

                   // Section 2
                   'title_section2' => $dataSend['title_section2'], 
                   'content_title_section2_1' => $dataSend['content_title_section2_1'], 
                   'content_title_section2_2' => $dataSend['content_title_section2_2'], 
                   'content_title_section2_3' => $dataSend['content_title_section2_3'], 
                   'content_detail_section2_1' => $dataSend['content_detail_section2_1'], 
                   'content_detail_section2_2' => $dataSend['content_detail_section2_2'], 
                   'content_detail_section2_3' => $dataSend['content_detail_section2_3'], 
                    );

        $data->key_word = 'settingHomeThemeKeToan';
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
    $slide_home = $modelAlbuminfos->find()->where(['id_album'=>1])->all()->toList();
        


    // $news = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    setVariable('slide_home', $slide_home);
    // setVariable('news', $news);
}

function postTheme($input)
{
    global $controller;
    global $modelCategories;


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
    // $conditions = array();
    // $limit = 6;
    // $page = 1;
    // $order = array('id'=>'desc');

    // $listPost = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // // DANH MỤC TIN TỨC
    // $conditions = array('type' => 'post');
    // $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    // setVariable('category_post', $category_post);
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