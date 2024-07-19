<?php 
function settingHomeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeTheme');
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

    

        $data->key_word = 'settingHomeTheme';
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

function settingAboutUs($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingAboutUs');
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

        $value = array( 'image_banner' => @$dataSend['image_banner'],
                        'titel' => @$dataSend['titel'],
                        'content' => @$dataSend['content'],
                        'image1' => @$dataSend['image1'],
                        'content1' => @$dataSend['content1'],
                        'image2' => @$dataSend['image2'],
                        'content2' => @$dataSend['content2'],
                        'image3' => @$dataSend['image3'],
                        

                    );

    

        $data->key_word = 'settingAboutUs';
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

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelProduct = $controller->loadModel('Products');
    $modelCategorieProduct = $controller->loadModel('CategorieProducts');

    

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }


    $slide_home = $modelAlbums->find()->where(['id'=>(int)@$data_value['id_slide']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->order(['id'=>'desc'])->all()->toList();
    }

    $listAlbum = $modelAlbums->find()->limit(8)->page(1)->where(['id_category'=>(int)@$data_value['id_album']])->all()->toList();
    $listAlbuminfos = $modelAlbuminfos->find()->limit(8)->page(1)->where(['id_album'=>(int)@$data_value['id_albumdt']])->all()->toList();
    $listVideo = $modelVideos->find()->where(['id_category'=>(int)@$data_value['id_video']])->all()->toList();


     // $news = $modelAlbums->find()->where(['id'=>(int)$data_value['id_bc']])->first();

    if(!empty($news)){
        $news->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$news->id])->all()->toList();
    }

    $conditionCategorieProduct = array('type' => 'category_product','status'=>'active');
    $listCategorieProduct = $modelCategories->find()->where($conditionCategorieProduct)->all()->toList();

    $totalProductSell = 0;
    if(!empty($listCategorieProduct)){
        foreach ($listCategorieProduct as $key => $value) {
            $products = $modelCategorieProduct->find()->where(array('id_category'=>$value->id))->all()->toList();
            $listCategorieProduct[$key]->number_product = count($products);
           // $totalProductSell += count($products);
        }
    }

   $listproduct1 =  $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->where(array('cp.id_category'=>(int) @$data_value['id_category_product1'],'status'=>'active'))->all()->toList();

   // $modelProduct->find()->limit(6)->page(1)->where(['id_category'=>@$data_value['id_category_product1'], 'status'=>'active'])->all()->toList();
   $listproduct2 = $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->where(array('cp.id_category'=>@$data_value['id_category_product2'],'status'=>'active'))->all()->toList();
    // $modelProduct->find()->limit(6)->page(1)->where(['id_category'=>@$data_value['id_category_product2'], 'status'=>'active'])->all()->toList();

    $product_search = $modelProduct->find()->limit(4)->where(['hot'=>1])->all()->toList();

    $listDataPost = $modelPosts->find()->limit(20)->where(array('pin'=>1))->all()->toList();

    setVariable('setting', $data_value);
    setVariable('slide_home', $slide_home);
    setVariable('listAlbum', $listAlbum);
    setVariable('listAlbuminfos', $listAlbuminfos);
    setVariable('listVideo', $listVideo);
    setVariable('listproduct1', $listproduct1);
    setVariable('listproduct2', $listproduct2);
    setVariable('listCategorieProduct', $listCategorieProduct);
    setVariable('listDataPost', $listDataPost);

}

function detailAlbum($input){
     global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }

        $album = $modelAlbums->find()->where($conditions)->first();

        if(!empty($album)){
            $listData = $modelAlbuminfos->find()->where(array('id_album'=>$album->id))->all()->toList();
            setVariable('listData',$listData);
            setVariable('album',$album);
        }else{
            return $controller->redirect('/');
        }


    }else{
        return $controller->redirect('/');
    }

}

function aboutUs($input){
     global $modelOptions;

      $conditions = array('key_word' => 'settingAboutUs');
    $data = $modelOptions->find()->where($conditions)->first();    

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data', $data_value);

}
 ?>
