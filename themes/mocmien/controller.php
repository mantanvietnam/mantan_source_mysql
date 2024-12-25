
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
                        'youtube_link' => $dataSend['youtube_link']
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

    $order = array('id' => 'asc');

    $listDatatop= $modelPosts->find()->limit(3)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();

    setVariable('slide_home', $slide_home);
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
