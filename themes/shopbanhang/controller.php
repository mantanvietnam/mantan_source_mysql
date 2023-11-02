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
                        'id_slide' => @$dataSend['id_slide'],
                        'id_bc' => @$dataSend['id_bc'],
                        'image1' => @$dataSend['image1'],
                        'image3' => @$dataSend['image3'],
                        'image2' => @$dataSend['image2'],
                        'image4' => @$dataSend['image4'],
                        'image5' => @$dataSend['image5'],
                        'image6' => @$dataSend['image6'],
                        'image7' => @$dataSend['image7'],
                        'link_image1' => @$dataSend['link_image1'],
                        'link_image2' => @$dataSend['link_image2'],
                        'link_image3' => @$dataSend['link_image3'],
                        'link_image4' => @$dataSend['link_image4'],
                        'company' => @$dataSend['company'],
                        'address' => @$dataSend['address'],
                        'phone' => @$dataSend['phone'],
                        'business' => @$dataSend['business'],
                        'side_plan' => @$dataSend['side_plan'],
                        'call_buy' => @$dataSend['call_buy'],
                        'complain' => @$dataSend['complain'],
                        'id_category' => @$dataSend['id_category'],
                        'id_service' => @$dataSend['id_service'],
                        'facebook' => @$dataSend['facebook'],
                        'youtube' => @$dataSend['youtube'],
                        'instagram' => @$dataSend['instagram'],
                        'email' => @$dataSend['email'],
                        'fax' => @$dataSend['fax'],
                        'menu_image1' => @$dataSend['menu_image1'],
                        'menu_title1' => @$dataSend['menu_title1'],
                        'menu_link1' => @$dataSend['menu_link1'],
                        'menu_image2' => @$dataSend['menu_image2'],
                        'menu_title2' => @$dataSend['menu_title2'],
                        'menu_link2' => @$dataSend['menu_link2'],
                        'menu_image3' => @$dataSend['menu_image3'],
                        'menu_title3' => @$dataSend['menu_title3'],
                        'menu_link3' => @$dataSend['menu_link3'],
                        'menu_image4' => @$dataSend['menu_image4'],
                        'menu_title4' => @$dataSend['menu_title4'],
                        'menu_link4' => @$dataSend['menu_link4'],
                       
                        'sela_title1' => @$dataSend['sela_title1'],
                        'baner_sele' => @$dataSend['baner_sele'],
                        'sela_title2' => @$dataSend['sela_title2'],
                        'sela_title3' => @$dataSend['sela_title3'],
                        'background_sele' => @$dataSend['background_sele'],
                        'baner_product' => @$dataSend['baner_product'],

                       'targetTime' => @$targetTime,
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

function sttingGuaranteeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'sttingGuaranteeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'content' => @$dataSend['content'],
                        'code_video' => @$dataSend['code_video'],                    
                        'title' => @$dataSend['title'],                    
                        'title_video' => @$dataSend['title_video'],                    
                    );

    

        $data->key_word = 'sttingGuaranteeTheme';
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
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $modelProduct = $controller->loadModel('Products');

    

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }


    $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_slide']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->all()->toList();
    }

     $news = $modelAlbums->find()->where(['id'=>(int)$data_value['id_bc']])->first();

    if(!empty($news)){
        $news->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$news->id])->all()->toList();
    }

    $product_flasl = $modelProduct->find()->limit(4)->where(['flash_sale'=>1])->all()->toList();
    $product_sold = $modelProduct->find()->limit(4)->where(['sold >'=>1])->all()->toList();
    $product_search = $modelProduct->find()->limit(4)->where(['hot'=>1])->all()->toList();

    setVariable('setting', $data_value);
    setVariable('product_flasl', $product_flasl);
    setVariable('product_sold', $product_sold);
    setVariable('product_search', $product_search);
    setVariable('slide_home', $slide_home);
    setVariable('news', $news);

}

function news(){
    global $modelPosts;
    global $controller;

    $order = array('id'=>'desc');

    $listDatatop= $modelPosts->find()->limit(1)->where(array('pin'=>1))->order($order)->all()->toList();
    $listDataView= $modelPosts->find()->limit(4)->where(array('view >'=>1))->order(array('view'=>'desc'))->all()->toList();
    $listDataNew= $modelPosts->find()->limit(3)->where(array())->order($order)->all()->toList();
    $listDataCategory1= $modelPosts->find()->limit(3)->where(array('idCategory'=>4))->order($order)->all()->toList();
    $listDataCategory2= $modelPosts->find()->limit(3)->where(array('idCategory'=>3))->order($order)->all()->toList();
    $listDataPost= $modelPosts->find()->limit(12)->where(array())->order($order)->all()->toList();



    setVariable('listDataPost', $listDataPost);
    setVariable('listDatatop', $listDatatop);
    setVariable('listDataNew', $listDataNew);
    setVariable('listDataCategory1', $listDataCategory1);
    setVariable('listDataCategory2', $listDataCategory2);
    setVariable('listDataView', $listDataView);

}

function guarantee(){
    global $modelOptions;

    $conditions = array('key_word' => 'sttingGuaranteeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
   
    setVariable('setting', $data_value);    

}

 ?>
