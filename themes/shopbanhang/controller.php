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

        $time = explode(' ', $dataSend['targetTime']);
        $date = explode('/', $time[1]);
        $hour = explode(':', $time[0]);
        $targetTime = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);

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
                       'targetTime' => $targetTime,
                        



                        
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
 ?>