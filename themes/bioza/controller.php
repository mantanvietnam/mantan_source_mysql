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