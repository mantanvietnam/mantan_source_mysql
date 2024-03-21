<?php 
function setting_theme_clone_web($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
   
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingThemeZikiiCloneWeb');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['targetTime'])){
            $time = explode(' ', $dataSend['targetTime']);
            $date = explode('/', $time[1]);
            $hour = explode(':', $time[0]);
            $targetTime = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
        }

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'compan_name' => @$dataSend['compan_name'],
                        'address' => @$dataSend['address'],
                        'email' => @$dataSend['email'],
                        'phone' => @$dataSend['phone'],
                        'id_slide' => @$dataSend['id_slide'],
                        'icon1' => @$dataSend['icon1'],
                        'titel1' => @$dataSend['titel1'],
                        'content1' => @$dataSend['content1'],
                        'icon2' => @$dataSend['icon2'],
                        'titel2' => @$dataSend['titel2'],
                        'content2' => @$dataSend['content2'],
                        'icon3' => @$dataSend['icon3'],
                        'titel3' => @$dataSend['titel3'],
                        'content3' => @$dataSend['content3'],
                        'icon4' => @$dataSend['icon4'],
                        'titel4' => @$dataSend['titel4'],
                        'content4' => @$dataSend['content4'],
                        'id_albumdt' => @$dataSend['id_albumdt'],
                        'id_album' => @$dataSend['id_album'],
                        'id_video' => @$dataSend['id_video'],
                        'id_category_product1' => @$dataSend['id_category_product1'],
                        'id_category_product2' => @$dataSend['id_category_product2'],
                        'titel_category_product1' => @$dataSend['titel_category_product1'],
                        'titel_category_product2' => @$dataSend['titel_category_product2'],
                        'titel6' => @$dataSend['titel6'],
                        'content6' => @$dataSend['content6'],
                        'link1' => @$dataSend['link1'],
                        'title_footer_left' => @$dataSend['title_footer_left'],
                        'title_footer_right' => @$dataSend['title_footer_right'],
                        'title_footer_green' => @$dataSend['title_footer_green'],
                        'address_footer' => @$dataSend['address_footer'],
                        'phone_footer' => @$dataSend['phone_footer'],
                        'email_footer' => @$dataSend['email_footer'],
                        'web_footer' => @$dataSend['web_footer'],
                        'page_footer' => @$dataSend['page_footer'],
                        'link_page' => @$dataSend['link_page'],
                        'business_certificates' => @$dataSend['business_certificates'],
                        'represent' => @$dataSend['represent'],
                        'image_qc' => @$dataSend['image_qc'],
                        'textfooter'=>@$dataSend['textfooter'],
                        'insta'=>@$dataSend['insta'],
                        'youtube'=>@$dataSend['youtube'],
                        'tiktok'=>@$dataSend['tiktok'],
                    );

        $data->key_word = 'settingThemeZikiiCloneWeb';
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

function indexTheme($input){
    global $modelAlbums;
    global $modelVideos;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $modelPosts;
    global $settingThemes;

    $modelCategorieProduct = $controller->loadModel('CategorieProducts');
    $modelProduct = $controller->loadModel('Products');

    // slide trang chủ
    $slide_home = $modelAlbums->find()->where(['id'=>(int)@$settingThemes['id_slide']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->order(['id'=>'desc'])->all()->toList();
    }

    // thư viện ảnh
    $listAlbum = $modelAlbums->find()->limit(8)->page(1)->where(['id_category'=>(int)@$settingThemes['id_album']])->all()->toList();

    // hình ảnh điều trị
    $listAlbuminfos = $modelAlbuminfos->find()->limit(8)->page(1)->where(['id_album'=>(int)@$settingThemes['id_albumdt']])->all()->toList();
    
    // thư viện video
    $listVideo = $modelVideos->find()->where(['id_category'=>(int)@$settingThemes['id_video']])->all()->toList();

    // danh mục sản phẩm
    $conditionCategorieProduct = array('type' => 'category_product','status'=>'active');
    $listCategorieProduct = $modelCategories->find()->where($conditionCategorieProduct)->all()->toList();

    $totalProductSell = 0;
    if(!empty($listCategorieProduct)){
        foreach ($listCategorieProduct as $key => $value) {
            $products = $modelCategorieProduct->find()->where(array('id_category'=>$value->id))->all()->toList();
            $listCategorieProduct[$key]->number_product = count($products);
        }
    }

    // sản phẩm nổi bật
    $listproduct1 =  $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->where(array('cp.id_category'=>(int)@$settingThemes['id_category_product1'],'status'=>'active'))->all()->toList();

    // tin tức mới
    $listDataPost = $modelPosts->find()->limit(20)->where()->all()->toList();

    setVariable('slide_home', $slide_home);
    setVariable('listAlbum', $listAlbum);
    setVariable('listAlbuminfos', $listAlbuminfos);
    setVariable('listVideo', $listVideo);
    setVariable('listCategorieProduct', $listCategorieProduct);
    setVariable('listproduct1', $listproduct1);
    setVariable('listDataPost', $listDataPost);
}

?>