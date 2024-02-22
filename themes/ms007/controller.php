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
                            'title_top'=> @$dataSend['title_top'],
                            'link1'=> @$dataSend['link1'],
                            'image_hd1'=> @$dataSend['image_hd1'],
                            'title_hd1'=> @$dataSend['title_hd1'],
                            'title_hdv1'=> @$dataSend['title_hdv1'],
                            'content_hd1'=> @$dataSend['content_hd1'],
                            'image_hd3'=> @$dataSend['image_hd3'],
                            'title_hd3'=> @$dataSend['title_hd3'],
                            'title_hdv3'=> @$dataSend['title_hdv3'],
                            'content_hd3'=> @$dataSend['content_hd3'],
                            'image_hd2'=> @$dataSend['image_hd2'],
                            'title_hd2'=> @$dataSend['title_hd2'],
                            'title_hdv2'=> @$dataSend['title_hdv2'],
                            'content_hd2'=> @$dataSend['content_hd2'],
                            'title_gt1'=> @$dataSend['title_gt1'],
                            'title_gt2'=> @$dataSend['title_gt2'],
                            'image_portrait1'=> @$dataSend['image_portrait1'],
                            'content2'=> @$dataSend['content2'],
                            'title_bd1'=> @$dataSend['title_bd1'],
                            'title_bd2'=> @$dataSend['title_bd2'],
                            'content_bd'=> @$dataSend['content_bd'],
                            'link2'=> @$dataSend['link2'],
                            'link3'=> @$dataSend['link3'],
                            'title_dv1'=> @$dataSend['title_dv1'],
                            'title_dvv1'=> @$dataSend['title_dvv1'],
                            'content_dv'=> @$dataSend['content_dv'],
                            'service1'=> @$dataSend['service1'],
                            'content_dv1'=> @$dataSend['content_dv1'],
                            'linkdv1'=> @$dataSend['linkdv1'],
                            'service2'=> @$dataSend['service2'],
                            'content_dv2'=> @$dataSend['content_dv2'],
                            'linkdv2'=> @$dataSend['linkdv2'],
                            'service3'=> @$dataSend['service3'],
                            'content_dv3'=> @$dataSend['content_dv3'],
                            'linkdv3'=> @$dataSend['linkdv3'],
                            'title_tt1'=> @$dataSend['title_tt1'],
                            'title_ttv1'=> @$dataSend['title_ttv1'],
                            'content_tt'=> @$dataSend['content_tt'],
                            'id_post'=> @$dataSend['id_post'],
                            'image_post'=> @$dataSend['image_post'],
                            'title_lh'=> @$dataSend['title_lh'],
                            'title_lhv'=> @$dataSend['title_lhv'],
                            'content_lh'=> @$dataSend['content_lh'],
                            'content_lhv'=> @$dataSend['content_lhv'],
                            'banner4'=> @$dataSend['banner4'],
                            'facebook'=> @$dataSend['facebook'],
                            'messenger'=> @$dataSend['messenger'],
                            'tiktok'=> @$dataSend['tiktok'],
                            'youtube'=> @$dataSend['youtube'],
                            'textfooter'=> @$dataSend['textfooter'],
                            'image_contac'=> @$dataSend['image_contac'],
                            
                            
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


    $listDataPost = $modelPosts->find()->limit(20)->where(array('idCategory'=>(int) $data_value['id_post'],'pin'=>1))->all()->toList();

    setVariable('setting', $data_value);
    setVariable('listDataPost', $listDataPost);

    }
?>