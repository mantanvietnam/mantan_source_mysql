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
                    'facebook' => $dataSend['facebook'],
                    'youtube' => $dataSend['youtube'],
                    'tiktok' => $dataSend['tiktok'],
                    'instagram' => $dataSend['instagram'],
                    'linkedIn' => $dataSend['linkedIn'],
                    'twitter' => $dataSend['twitter'],

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

                    // Footer
                    'title1_footer' => $dataSend['title1_footer'],
                    'title2_footer' => $dataSend['title2_footer'],
                    'idMenu_footer' => $dataSend['idMenu_footer'],
                    'copyright_footer' => $dataSend['copyright_footer'],

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
    global $modelCategories;


    // SLIDE HOME
    $slide_home = [];
    $slide_home = $modelAlbuminfos->find()->where(['id_album'=>1])->all()->toList();
        

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    // TIN TỨC MỚI
    $conditions = array('type'=>'post');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $news = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // TIN TRANG CHỦ
    $limit = 4;
    $page = 1;
    $order = array('id'=>'desc');

    $news_home = [];
    foreach ($category_post as $key => $value) {
        $news_home[$key] = $modelPosts->find()->limit($limit)->where(['idCategory'=>$value->id])->page($page)->order($order)->all()->toList();
        
    }
    setVariable('slide_home', $slide_home);
    setVariable('category_post', $category_post);
    setVariable('news', $news);
    setVariable('news_home', $news_home);


    // setVariable('news', $news);
}

function postTheme($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelCategories;




    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    // TIN TỨC MỚI
    $conditions = array('type'=>'post');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $news = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
  

    setVariable('category_post', $category_post);
    setVariable('news', $news);
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelCategories;

    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    // TIN TỨC MỚI
    $conditions = array('type'=>'post');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $news = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
  

    setVariable('category_post', $category_post);
    setVariable('news', $news);
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