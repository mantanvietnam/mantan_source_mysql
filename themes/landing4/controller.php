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
                            'content_top'=> @$dataSend['content_top'],
                            'link_top'=> @$dataSend['link_top'],
                            'image_Portrait'=> @$dataSend['image_Portrait'],
                            'iamhuman'=> @$dataSend['iamhuman'],
                            'content_2'=> @$dataSend['content_2'],
                            'link_2'=> @$dataSend['link_2'],
                            'fullname'=> @$dataSend['fullname'],
                            'phone'=> @$dataSend['phone'],
                            'email'=> @$dataSend['email'],
                            'address'=> @$dataSend['address'],
                            'icon_service1'=> @$dataSend['icon_service1'],
                            'service1'=> @$dataSend['service1'],
                            'content_service1'=> @$dataSend['content_service1'],
                            'icon_service2'=> @$dataSend['icon_service2'],
                            'service2'=> @$dataSend['service2'],
                            'content_service2'=> @$dataSend['content_service2'],
                            'icon_service3'=> @$dataSend['icon_service3'],
                            'service3'=> @$dataSend['service3'],
                            'content_service3'=> @$dataSend['content_service3'],
                            'background_4'=> @$dataSend['background_4'],
                            'content_4'=> @$dataSend['content_4'],
                            'link_4'=> @$dataSend['link_4'],
                            'id_album'=> @$dataSend['id_album'],
                            'statistics1'=> @$dataSend['statistics1'],
                            'content_statistics1'=> @$dataSend['content_statistics1'],
                            'statistics2'=> @$dataSend['statistics2'],
                            'content_statistics2'=> @$dataSend['content_statistics2'],
                            'statistics3'=> @$dataSend['statistics3'],
                            'content_statistics3'=> @$dataSend['content_statistics3'],
                            'statistics4'=> @$dataSend['statistics4'],
                            'content_statistics4'=> @$dataSend['content_statistics4'],
                            'background_5'=> @$dataSend['background_5'],
                            'facebook'=> @$dataSend['facebook'],
                            'instagram'=> @$dataSend['instagram'],
                            'tiktok'=> @$dataSend['tiktok'],
                            'youtube'=> @$dataSend['youtube'],
                            'linkedin'=> @$dataSend['linkedin'],
                            'twitter'=> @$dataSend['twitter'],
                            'background_6'=> @$dataSend['background_6'],
                            'image_Port'=> @$dataSend['image_Port'],
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
        $album_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$album_home->id])->order(['id'=>'desc'])->all()->toList();
    }

    setVariable('setting', $data_value);
    setVariable('listDataNew', $listDataNew);
    setVariable('album_home', $album_home);

    }
?>