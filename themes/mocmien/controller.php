<?php 
function settingHomeThemeMocMien($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeMocMien');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'id_slide' => $dataSend['id_slide'],

                        'image_logo' => $dataSend['image_logo'],
                        'images_1' => $dataSend['images_1'],
                        'images_2' => $dataSend['images_2'],
                        'images_3' => $dataSend['images_3'],

                        'image_story' => $dataSend['image_story'],
                        'big_content' => $dataSend['big_content'],
                        'small_content' => $dataSend['small_content'],
                        'link_story' => $dataSend['link_story'],

                        'legit_icon' => $dataSend['legit_icon'],

                        'legit_content_1' => $dataSend['legit_content_1'],
                        'legit_content_2' => $dataSend['legit_content_2'],
                        'legit_content_3' => $dataSend['legit_content_3'],
                        'legit_content_4' => $dataSend['legit_content_4'],
                        'legit_content_5' => $dataSend['legit_content_5'],
                        'legit_content_6' => $dataSend['legit_content_6'],

                        'title_main' => $dataSend['title_main'],

                        'delivery_title_1' => $dataSend['delivery_title_1'],
                        'delivery_content_1' => $dataSend['delivery_content_1'],
                        'delivery_title_2' => $dataSend['delivery_title_2'],
                        'delivery_content_2' => $dataSend['delivery_content_2'],
                        'delivery_title_3' => $dataSend['delivery_title_3'],
                        'delivery_content_3' => $dataSend['delivery_content_3'],

                        'footer_address' => $dataSend['footer_address'],
                        'footer_email' => $dataSend['footer_email'],
                        'footer_phone_number' => $dataSend['footer_phone_number'],

                        'instagram_link' => $dataSend['instagram_link'],
                        'facebook_link' => $dataSend['facebook_link'],
                        'linkedin_link' => $dataSend['linkedin_link'],
                        'youtube_link' => $dataSend['youtube_link'],
                        'video_1' => $dataSend['video_1'],
                        'video_2' => $dataSend['video_2'],
                        'sale_title' => $dataSend['sale_title'],
                        'day' => $dataSend['day'],
                        'hours' => $dataSend['hours'],
                        'minutes' => $dataSend['minutes'],
                        'seconds' => $dataSend['seconds'],
                    );

        $data->key_word = 'settingHomeThemeMocMien';
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
    global $modelOptions;

    $limit = 8;
    $conditions = array('key_word' => 'settingHomeThemeMocMien');
    $modelProduct = $controller->loadModel('Products');
    $modelCategories = $controller->loadModel('Categories');

    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    // SLIDE HOME
    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }

    $order = array('RAND()');

    $listDatatop= $modelPosts->find()->limit(3)->where(array('type'=>'post'))->order($order)->all()->toList();

    // SẢN PHẨM NỔI BẬT
    $conditions = array('hot'=>1);
    $limit = 3;
    $page = 1;
    $order = array('id'=>'desc');

    $hot_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // DANH MỤC SẢN PHẨM 
    $conditions = array(
        'type' => 'category_product',
        'name !=' => 'COMBO'
    );
    
    $limit = 3;
    $page = 1;
    $order = array('id' => 'desc');
    
    $category_product = $modelCategories->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order($order)
        ->all()
        ->toList();
    

    //Sản phẩm bán chạy
    $conditions = array('hot'=>1);
    $limit = 4;
    $page = 1;
    $order = ['RAND()'];
    $best_selling_products = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    //Lấy sản phẩm theo combo
    $comboCategory = $modelCategories->find()
    ->where(['type' => 'category_product', 'name' => 'COMBO'])
    ->first();

    if ($comboCategory) {
    $comboProducts = $modelProduct->find()
        ->where(['id_category' => $comboCategory->id])
        ->order(['RAND()'])
        ->limit(4)
        ->page(1)
        ->all()
        ->toList();
    } else {
    $comboProducts = [];
    }


    setVariable('slide_home', $slide_home);
    setVariable('hot_product', $hot_product);
    setVariable('category_product', $category_product);
    setVariable('best_selling_products', $best_selling_products);
    setVariable('comboProducts', $comboProducts);
    setVariable('listDatatop', $listDatatop);    
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

function categoryPostTheme($input)
{
    global $controller;
    global $modelCategories;

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
