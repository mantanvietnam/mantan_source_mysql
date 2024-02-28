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
                            'title_top_nho'=> @$dataSend['title_top_nho'],
                            'title_top_to'=> @$dataSend['title_top_to'],
                            'content_top'=> @$dataSend['content_top'],
                            'link_top'=> @$dataSend['link_top'],
                            'image_avatar'=> @$dataSend['image_avatar'],
                            'title_2'=> @$dataSend['title_2'],
                            'content_1'=> @$dataSend['content_1'],
                            'icon_mn_1'=> @$dataSend['icon_mn_1'],
                            'title_mn_1'=> @$dataSend['title_mn_1'],
                            'content_mn_1'=> @$dataSend['content_mn_1'],
                            'icon_mn_2'=> @$dataSend['icon_mn_2'],
                            'title_mn_2'=> @$dataSend['title_mn_2'],
                            'content_mn_2'=> @$dataSend['content_mn_2'],
                            'icon_mn_3'=> @$dataSend['icon_mn_3'],
                            'title_mn_3'=> @$dataSend['title_mn_3'],
                            'content_mn_3'=> @$dataSend['content_mn_3'],
                            'title_dichvu'=> @$dataSend['title_dichvu'],
                            'icon_dichvu_1'=> @$dataSend['icon_dichvu_1'],
                            'title_dichvu_1'=> @$dataSend['title_dichvu_1'],
                            'content_dichvu_1'=> @$dataSend['content_dichvu_1'],
                            'icon_dichvu_2'=> @$dataSend['icon_dichvu_2'],
                            'title_dichvu_2'=> @$dataSend['title_dichvu_2'],
                            'content_dichvu_2'=> @$dataSend['content_dichvu_2'],
                            'icon_dichvu_3'=> @$dataSend['icon_dichvu_3'],
                            'title_dichvu_3'=> @$dataSend['title_dichvu_3'],
                            'content_dichvu_3'=> @$dataSend['content_dichvu_3'],
                            'icon_dichvu_4'=> @$dataSend['icon_dichvu_4'],
                            'title_dichvu_4'=> @$dataSend['title_dichvu_4'],
                            'content_dichvu_4'=> @$dataSend['content_dichvu_4'],
                            'icon_dichvu_5'=> @$dataSend['icon_dichvu_5'],
                            'title_dichvu_5'=> @$dataSend['title_dichvu_5'],
                            'content_dichvu_5'=> @$dataSend['content_dichvu_5'],
                            'icon_dichvu_6'=> @$dataSend['icon_dichvu_6'],
                            'title_dichvu_6'=> @$dataSend['title_dichvu_6'],
                            'content_dichvu_6'=> @$dataSend['content_dichvu_6'],
                            'title_album'=> @$dataSend['title_album'],
                            'id_album'=> @$dataSend['id_album'],
                            'title_doingu'=> @$dataSend['title_doingu'],
                            'image_avatar_1'=> @$dataSend['image_avatar_1'],
                            'fullname_1'=> @$dataSend['fullname_1'],
                            'field_1'=> @$dataSend['field_1'],
                            'facebook_1'=> @$dataSend['facebook_1'],
                            'twitter_1'=> @$dataSend['twitter_1'],
                            'instagram_1'=> @$dataSend['instagram_1'],
                            'image_avatar_2'=> @$dataSend['image_avatar_2'],
                            'fullname_2'=> @$dataSend['fullname_2'],
                            'field_2'=> @$dataSend['field_2'],
                            'facebook_2'=> @$dataSend['facebook_2'],
                            'twitter_2'=> @$dataSend['twitter_2'],
                            'instagram_2'=> @$dataSend['instagram_2'],
                            'image_avatar_3'=> @$dataSend['image_avatar_3'],
                            'fullname_3'=> @$dataSend['fullname_3'],
                            'field_3'=> @$dataSend['field_3'],
                            'facebook_3'=> @$dataSend['facebook_3'],
                            'twitter_3'=> @$dataSend['twitter_3'],
                            'instagram_3'=> @$dataSend['instagram_3'],
                            'image_avatar_4'=> @$dataSend['image_avatar_4'],
                            'fullname_4'=> @$dataSend['fullname_4'],
                            'field_4'=> @$dataSend['field_4'],
                            'facebook_4'=> @$dataSend['facebook_4'],
                            'twitter_4'=> @$dataSend['twitter_4'],
                            'instagram_4'=> @$dataSend['instagram_4'],
                            
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

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $order = array('id'=>'desc');

    $listDataNew= $modelPosts->find()->limit(4)->where(array('type'=>'post'))->order($order)->all()->toList();

    $album_home = $modelAlbums->find()->where(['id'=>(int)@$data_value['id_album']])->first();

    if(!empty($album_home)){
        $album_home->imageinfo = $modelAlbuminfos->find()->limit(6)->where(['id_album'=>(int)$album_home->id])->order(['id'=>'desc'])->all()->toList();
    }



    setVariable('setting', $data_value);
    setVariable('listDataNew', $listDataNew);
    setVariable('album_home', $album_home);

    }
?>