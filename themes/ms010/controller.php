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
                            'title_top'=> @$dataSend['title_top'],
                            'image_avatar'=> @$dataSend['image_avatar'],
                            'content_top'=> @$dataSend['content_top'],
                            'title_ck'=> @$dataSend['title_ck'],
                            'content_ck'=> @$dataSend['content_ck'],
                            'background_2'=> @$dataSend['background_2'],
                            'content_ck_1'=> @$dataSend['content_ck_1'],
                            'title_ck_1'=> @$dataSend['title_ck_1'],
                            'image_ck_1'=> @$dataSend['image_ck_1'],
                            'content_ck_2'=> @$dataSend['content_ck_2'],
                            'title_ck_2'=> @$dataSend['title_ck_2'],
                            'image_ck_2'=> @$dataSend['image_ck_2'],
                            'content_ck_3'=> @$dataSend['content_ck_3'],
                            'title_ck_3'=> @$dataSend['title_ck_3'],
                            'image_ck_3'=> @$dataSend['image_ck_3'],
                            'image_avatar1'=> @$dataSend['image_avatar1'],
                            'title_gt'=> @$dataSend['title_gt'],
                            'content_gt'=> @$dataSend['content_gt'],
                            
                            
                            
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