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


                        'title1_footer' => $dataSend['title1_footer'], 
                        'id1_menu_footer' => $dataSend['id1_menu_footer'], 
                        'id2_menu_footer' => $dataSend['id2_menu_footer'], 

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
    global $modelProduct;
    global $modelCategories;

    $modelProduct = $controller->loadModel('Products');
    $modelMenus = $controller->loadModel('Menus');
    $modelProductProjects = $controller->loadModel('ProductProjects');

    // SLIDE HOME
    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }

    // SẢN PHẨM MỚI
    $conditions = array('type' => 'category_product');
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    $new_category_product = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


    // Menu 
    if(!empty($settingThemes['id1_menu_footer'])){
        $menu_footer = $modelMenus->find()->where(['id_menu'=>(int) $settingThemes['id1_menu_footer']])->all()->toList();
    }

    if(!empty($settingThemes['id1_menu_footer'])){
        $menu_footer2 = $modelMenus->find()->where(['id_menu'=>(int) $settingThemes['id2_menu_footer']])->all()->toList();
    }

    // Dự án sản phẩm
    $conditions2 = array('type' => 'category_kind');
    $listProductProjects = $modelProductProjects->find()->limit($limit)->page($page)->order($order)->all()->toList();
    $listKind = $modelCategories->find()->where($conditions2)->all()->toList();

    if(!empty($listProductProjects)){
        foreach($listProductProjects as $key => $value){
            if(!empty($value->id_kind)){
                $infoKind = $modelCategories->find()->where(['id'=> $value->id_kind])->first();
                $listProductProjects[$key]->infoKind = $infoKind;
            }   
           
        }
    }    

    if(!empty($listProductProjects)){
        foreach($listProductProjects as $key => $value){
            if(!empty($value->id_product)){
                $arrProductID = explode(',', $value->id_product);
                foreach($arrProductID as $item){
                    $infoProduct = $modelProduct->find()->where(['id'=> (int)$item])->all()->toList();
                    $listProductProjects[$key]->infoProduct = $infoProduct;

                    debug($infoProduct);                   
                }
            }   
           
        }
    }    


    setVariable('slide_home', $slide_home);
    setVariable('new_category_product', $new_category_product);
    setVariable('slide_home', $slide_home);
    setVariable('menu_footer', $menu_footer);
    setVariable('menu_footer2', $menu_footer2);
    setVariable('infoKind', $infoKind);
    setVariable('listKind', $listKind);
    setVariable('infoProduct', $infoProduct);
    setVariable('listProductProjects', $listProductProjects);
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