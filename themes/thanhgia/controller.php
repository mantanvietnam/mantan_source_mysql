<?php 
function settingHomeThemeThanhgia($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeThanhgia');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'name_web' => $dataSend['name_web'],
    					'time_open' => $dataSend['time_open'],
    					'id_slide' => $dataSend['id_slide'],

    					'facebook' => $dataSend['facebook'],
    					'youtube' => $dataSend['youtube'],
    					'tiktok' => $dataSend['tiktok'],
    					'instagram' => $dataSend['instagram'],
    					'linkedIn' => $dataSend['linkedIn'],
    					'twitter' => $dataSend['twitter'],

    					'title_why_choose' => $dataSend['title_why_choose'],
    					'image1_why_choose' => $dataSend['image1_why_choose'],
    					'title1_why_choose' => $dataSend['title1_why_choose'],
    					'content1_why_choose' => $dataSend['content1_why_choose'],
    					'image2_why_choose' => $dataSend['image2_why_choose'],
    					'title2_why_choose' => $dataSend['title2_why_choose'],
    					'content2_why_choose' => $dataSend['content2_why_choose'],
    					'image3_why_choose' => $dataSend['image3_why_choose'],
    					'title3_why_choose' => $dataSend['title3_why_choose'],
    					'content3_why_choose' => $dataSend['content3_why_choose'],
    					'image4_why_choose' => $dataSend['image4_why_choose'],
    					'title4_why_choose' => $dataSend['title4_why_choose'],
    					'content4_why_choose' => $dataSend['content4_why_choose'],

    					'title_product_best' => $dataSend['title_product_best'],
    					'image_product_best' => $dataSend['image_product_best'],
    					'image1_product_best' => $dataSend['image1_product_best'],
    					'title1_product_best' => $dataSend['title1_product_best'],
    					'content1_product_best' => $dataSend['content1_product_best'],
    					'image2_product_best' => $dataSend['image2_product_best'],
    					'title2_product_best' => $dataSend['title2_product_best'],
    					'content2_product_best' => $dataSend['content2_product_best'],
    					'image3_product_best' => $dataSend['image3_product_best'],
    					'title3_product_best' => $dataSend['title3_product_best'],
    					'content3_product_best' => $dataSend['content3_product_best'],
    					'image4_product_best' => $dataSend['image4_product_best'],
    					'title4_product_best' => $dataSend['title4_product_best'],
    					'content4_product_best' => $dataSend['content4_product_best'],
    					'image5_product_best' => $dataSend['image5_product_best'],
    					'title5_product_best' => $dataSend['title5_product_best'],
    					'content5_product_best' => $dataSend['content5_product_best'],
    					'image6_product_best' => $dataSend['image6_product_best'],
    					'title6_product_best' => $dataSend['title6_product_best'],
    					'content6_product_best' => $dataSend['content6_product_best'],
    					'image7_product_best' => $dataSend['image7_product_best'],
    					'title7_product_best' => $dataSend['title7_product_best'],
    					'content7_product_best' => $dataSend['content7_product_best'],
    					'image8_product_best' => $dataSend['image8_product_best'],
    					'title8_product_best' => $dataSend['title8_product_best'],
    					'content8_product_best' => $dataSend['content8_product_best'],

    					'title_news_hot' => $dataSend['title_news_hot'],
    					'image1_news_hot' => $dataSend['image1_news_hot'],
    					'title1_news_hot' => $dataSend['title1_news_hot'],
    					'content1_news_hot' => $dataSend['content1_news_hot'],
    					'link1_news_hot' => $dataSend['link1_news_hot'],
    					'image2_news_hot' => $dataSend['image2_news_hot'],
    					'title2_news_hot' => $dataSend['title2_news_hot'],
    					'content2_news_hot' => $dataSend['content2_news_hot'],
    					'link2_news_hot' => $dataSend['link2_news_hot'],

    					'title_working' => $dataSend['title_working'],
    					'image_working' => $dataSend['image_working'],
                        'image1_working' => $dataSend['image1_working'],
    					'title1_working' => $dataSend['title1_working'],
    					'content1_working' => $dataSend['content1_working'],
                        'image2_working' => $dataSend['image2_working'],
    					'title2_working' => $dataSend['title2_working'],
    					'content2_working' => $dataSend['content2_working'],
    					'image3_working' => $dataSend['image3_working'],
                        'title3_working' => $dataSend['title3_working'],
    					'content3_working' => $dataSend['content3_working'],
                        'image4_working' => $dataSend['image4_working'],
                        'title4_working' => $dataSend['title4_working'],
                        'content4_working' => $dataSend['content4_working'],

    					'title1_footer' => $dataSend['title1_footer'],
    					'content1_footer' => $dataSend['content1_footer'],
    					'title2_footer' => $dataSend['title2_footer'],
    					'idMenu2_footer' => $dataSend['idMenu2_footer'],
                    );

        $data->key_word = 'settingHomeThemeThanhgia';
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

    $modelProduct = $controller->loadModel('Products');

    // SLIDE HOME
    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }

    // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // SẢN PHẨM NỔI BẬT
    $conditions = array('hot'=>1);
    $limit = 8;
    $page = 1;
    $order = array('id'=>'desc');

    $hot_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // TIN TỨC MỚI
    $conditions = array('type'=>'post');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $news = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    setVariable('slide_home', $slide_home);
    setVariable('new_product', $new_product);
    setVariable('hot_product', $hot_product);
    setVariable('news', $news);
}

function postTheme($input)
{
    global $controller;
    global $modelCategories;

	$modelProduct = $controller->loadModel('Products');

    // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('new_product', $new_product);
    setVariable('category_post', $category_post);
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{
    global $controller;
    global $modelCategories;

    $modelProduct = $controller->loadModel('Products');

    // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $new_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('new_product', $new_product);
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