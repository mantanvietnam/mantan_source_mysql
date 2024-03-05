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
                            'image_top'=> @$dataSend['image_top'],
                            'title_dv_nho'=> @$dataSend['title_dv_nho'],
                            'title_dv_to'=> @$dataSend['title_dv_to'],
                            'content_dv'=> @$dataSend['content_dv'],
                            'title_dv_1'=> @$dataSend['title_dv_1'],
                            'content_dv_1'=> @$dataSend['content_dv_1'],
                            'image_dv_1'=> @$dataSend['image_dv_1'],
                            'title_dv_2'=> @$dataSend['title_dv_2'],
                            'content_dv_2'=> @$dataSend['content_dv_2'],
                            'image_dv_2'=> @$dataSend['image_dv_2'],
                            'title_dv_3'=> @$dataSend['title_dv_3'],
                            'content_dv_3'=> @$dataSend['content_dv_3'],
                            'image_dv_3'=> @$dataSend['image_dv_3'],
                            'title_dv_4'=> @$dataSend['title_dv_4'],
                            'content_dv_4'=> @$dataSend['content_dv_4'],
                            'image_dv_4'=> @$dataSend['image_dv_4'],
                            'image_gt'=> @$dataSend['image_gt'],
                            'title_gt_nho'=> @$dataSend['title_gt_nho'],
                            'title_gt_to'=> @$dataSend['title_gt_to'],
                            'content_gt_den'=> @$dataSend['content_gt_den'],
                            'content_gt_tim'=> @$dataSend['content_gt_tim'],
                            'link_gt'=> @$dataSend['link_gt'],
                            'title_ds_nho'=> @$dataSend['title_ds_nho'],
                            'title_ds_to'=> @$dataSend['title_ds_to'],
                            'content_ds'=> @$dataSend['content_ds'],
                            'image_ds'=> @$dataSend['image_ds'],
                            'title_ds_1'=> @$dataSend['title_ds_1'],
                            'content_ds_1'=> @$dataSend['content_ds_1'],
                            'title_ds_2'=> @$dataSend['title_ds_2'],
                            'content_ds_2'=> @$dataSend['content_ds_2'],
                            'title_ds_3'=> @$dataSend['title_ds_3'],
                            'content_ds_3'=> @$dataSend['content_ds_3'],
                            'title_ds_4'=> @$dataSend['title_ds_4'],
                            'content_ds_4'=> @$dataSend['content_ds_4'],
                            'title_ds_5'=> @$dataSend['title_ds_5'],
                            'content_ds_5'=> @$dataSend['content_ds_5'],
                            'title_ds_6'=> @$dataSend['title_ds_6'],
                            'content_ds_6'=> @$dataSend['content_ds_6'],
                            'title_ds_7'=> @$dataSend['title_ds_7'],
                            'content_ds_7'=> @$dataSend['content_ds_7'],
                            'title_ds_8'=> @$dataSend['title_ds_8'],
                            'content_ds_8'=> @$dataSend['content_ds_8'],
                            
                            
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