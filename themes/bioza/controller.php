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

             $value = array('logo'=> @$dataSend['logo'],
                            'background_top'=> @$dataSend['background_top'],
                            'full_name'=> @$dataSend['full_name'],
                            'content_top1'=> @$dataSend['content_top1'],
                            'content_top2'=> @$dataSend['content_top2'],
                            'image_Portrait'=> @$dataSend['image_Portrait'],
                            'code_videoyoutube'=> @$dataSend['code_videoyoutube'],
                            'speaker_name'=> @$dataSend['speaker_name'],
                            'image_Portrait2'=> @$dataSend['image_Portrait2'],
                            'background_2'=> @$dataSend['background_2'],
                            'content_2'=> @$dataSend['content_2'],
                            'email'=> @$dataSend['email'],
                            'phone'=> @$dataSend['phone'],
                            'address'=> @$dataSend['address'],
                            'icon1'=> @$dataSend['icon1'],
                            'service1'=> @$dataSend['service1'],
                            'content_service1'=> @$dataSend['content_service1'],
                            'icon2'=> @$dataSend['icon2'],
                            'service2'=> @$dataSend['service2'],
                            'content_service2'=> @$dataSend['content_service2'],
                            'icon3'=> @$dataSend['icon3'],
                            'service3'=> @$dataSend['service3'],
                            'content_service3'=> @$dataSend['content_service3'],
                            'icon4'=> @$dataSend['icon4'],
                            'service4'=> @$dataSend['service4'],
                            'content_service4'=> @$dataSend['content_service4'],
                            'icon5'=> @$dataSend['icon5'],
                            'service5'=> @$dataSend['service5'],
                            'content_service5'=> @$dataSend['content_service5'],
                            'icon6'=> @$dataSend['icon6'],
                            'service6'=> @$dataSend['service6'],
                            'content_service6'=> @$dataSend['content_service6'],
                            'background_3'=> @$dataSend['background_3'],
                            'id_album1'=> @$dataSend['id_album1'],
                            'id_album2'=> @$dataSend['id_album2'],
                            'textred'=> @$dataSend['textred'],
                            'background_4'=> @$dataSend['background_4'],
                            'textwhite'=> @$dataSend['textwhite'],
                            'id_post'=> @$dataSend['id_post'],
                            'background_5'=> @$dataSend['background_5'],
                            'facebook'=> @$dataSend['facebook'],
                            'twitter'=> @$dataSend['twitter'],
                            'instagram'=> @$dataSend['instagram'],
                            'behance'=> @$dataSend['behance'],
                            'dribbble'=> @$dataSend['dribbble'],
                            'textfooter'=> @$dataSend['textfooter'],
                            
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

    setVariable('data', $data_value);
    setVariable('mess', $mess);
    
}


function indexTheme(){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelOptions;
    global $modelNotices;
    global $modelPosts;
    global $modelCategories;

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $order = array('id'=>'desc');

    $listDataNew= $modelPosts->find()->limit(4)->where(array('type'=>'post'))->order($order)->all()->toList();

    $album_home1 = $modelAlbums->find()->where(['id'=>(int)@$data_value['id_album1']])->first();

    if(!empty($album_home1)){
        $album_home1->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$album_home1->id])->order(['id'=>'desc'])->all()->toList();
    }

    $album_home2 = $modelAlbums->find()->where(['id'=>(int)@$data_value['id_album2']])->first();

    if(!empty($album_home2)){
        $album_home2->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$album_home2->id])->order(['id'=>'desc'])->all()->toList();
    }

    $category = $modelCategories->find()->where(array('id'=>@$data_value['id_post']))->first();

    $listDataNew= $modelPosts->find()->limit(4)->where(array('idCategory'=>@$data_value['id_post'],'type'=>'post'))->order($order)->all()->toList();

    setVariable('setting', $data_value);
    setVariable('listDataNew', $listDataNew);
    setVariable('album_home1', $album_home1);
    setVariable('album_home2', $album_home2);
    setVariable('listDataNew', $listDataNew);
    setVariable('category', $category);

    }
?>