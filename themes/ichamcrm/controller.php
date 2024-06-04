<?php 
function settingHomeThemeIchamCRM($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeIchamCRM');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'logo' => $dataSend['logo'],
    					'link_contact' => $dataSend['link_contact'],
    					'id_slide' => $dataSend['id_slide'],
                        'id_blog_service' => $dataSend['id_blog_service'],
                        'id_slide_partner' => $dataSend['id_slide_partner'],

    					'facebook' => $dataSend['facebook'],
    					'youtube' => $dataSend['youtube'],
    					'tiktok' => $dataSend['tiktok'],
    					'instagram' => $dataSend['instagram'],
    					'linkedIn' => $dataSend['linkedIn'],
    					'twitter' => $dataSend['twitter'],

                        'name_brand' => $dataSend['name_brand'],
                        'title_about' => $dataSend['title_about'],
                        'content_about' => $dataSend['content_about'],
                        'link_about' => $dataSend['link_about'],

    					'title_product_best' => $dataSend['title_product_best'],
    					'des_product_best' => $dataSend['des_product_best'],
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

                        'content1_footer' => $dataSend['content1_footer'],
                        'id_menu_footer' => $dataSend['id_menu_footer'],

                    );

        $data->key_word = 'settingHomeThemeIchamCRM';
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

function settingRecruitmentThemeIchamCRM($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang Tuyển Dụng';
    $mess= '';

    $conditions = array('key_word' => 'settingRecruitmentThemeIchamCRM');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'banner_title_1' => $dataSend['banner_title_1'], 
                        'banner_content_1' => $dataSend['banner_content_1'],

                        'banner_title_2' => $dataSend['banner_title_2'], 
                        'banner_content_2' => $dataSend['banner_content_2'],

                        'banner_title_3' => $dataSend['banner_title_3'], 
                        'banner_content_3' => $dataSend['banner_content_3'],
                        'link_content' => $dataSend['link_content'],

                        'culture_title' => $dataSend['culture_title'],
                        'culture_content' => $dataSend['culture_content'],

                        'decoration_title' => $dataSend['decoration_title'],
                        'decoration_content' => $dataSend['decoration_content'],
                    );

        $data->key_word = 'settingRecruitmentThemeIchamCRM';
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

function settingContactThemeIchamCRM($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang Tuyển Dụng';
    $mess= '';

    $conditions = array('key_word' => 'settingContactThemeIchamCRM');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'contact_email' => $dataSend['contact_email'],
                        'contact_phone' => $dataSend['contact_phone'],
                        'contact_address' => $dataSend['contact_address'],
                    );

        $data->key_word = 'settingContactThemeIchamCRM';
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
    global $modelAlbuminfos;

    $blog_service = [];
    if(!empty($settingThemes['id_blog_service'])){
        $blog_service = $modelPosts->find()->where(['idCategory'=>@$settingThemes['id_blog_service']])->all()->toList();
    }

    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }

    $slide_partner = [];
    if(!empty($settingThemes['id_slide_partner'])){
        $slide_partner = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide_partner']])->all()->toList();
    }

    $listFeed = [];
    if(function_exists('getListFeedback')){
        $listFeed = getListFeedback();
    }

    $menuFooter = [];
    if(!empty($settingThemes['id_menu_footer'])){
        $menuFooter = getMenusDefault((int) $settingThemes['id_menu_footer']);
    }

    $staff = [];
    if(function_exists('get_all_person')){
        $staff = get_all_person();
    }
   
    setVariable('blog_service', $blog_service);
    setVariable('slide_home', $slide_home);
    setVariable('slide_partner', $slide_partner);
    setVariable('listFeed', $listFeed);
    setVariable('menuFooter', $menuFooter);
    setVariable('staff', $staff);
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