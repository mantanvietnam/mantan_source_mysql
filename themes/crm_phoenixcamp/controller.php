<?php
function settingHomeThemeCRM($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeCRMZikii');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
		if($isRequestPost){
			$dataSend = $input['request']->getData();

			 $value = array('logo'=> @$dataSend['logo'],
            				'name_web'=> @$dataSend['name_web'],
                            'content_footer'=> @$dataSend['content_footer'],
                            'background_color'=> @$dataSend['background_color'],

            				'facebook'=> @$dataSend['facebook'],
            				'youtube'=> @$dataSend['youtube'],
                            'tiktok'=> @$dataSend['tiktok'],
                            'instagram'=> @$dataSend['instagram'],
                            'linkedIn'=> @$dataSend['linkedIn'],
                            'twitter'=> @$dataSend['twitter'],

                            'background_image_1'=> @$dataSend['background_image_1'],
                            'image_product_1'=> @$dataSend['image_product_1'],
                            'image_product_2'=> @$dataSend['image_product_2'],
                            'image_product_3'=> @$dataSend['image_product_3'],
                            'image_product_4'=> @$dataSend['image_product_4'],
                            'image_product_5'=> @$dataSend['image_product_5'],

                            'background_image_2'=> @$dataSend['background_image_2'],
                            'background_image_3'=> @$dataSend['background_image_3'],
                            'title_footer1'=> @$dataSend['title_footer1'],
                            'link_footer1'=> @$dataSend['link_footer1'],
                            'title_footer2'=> @$dataSend['title_footer2'],
                            'link_footer2'=> @$dataSend['link_footer2'],
                            'title_footer3'=> @$dataSend['title_footer3'],
                            'link_footer3'=> @$dataSend['link_footer3'],
                            'title_footer4'=> @$dataSend['title_footer4'],
                            'link_footer4'=> @$dataSend['link_footer4'],
                            'title_footer5'=> @$dataSend['title_footer5'],
                            'link_footer5'=> @$dataSend['link_footer5'],
                            'title_footer6'=> @$dataSend['title_footer6'],
                            'link_footer6'=> @$dataSend['link_footer6'],
				

			 );

    

        $data->key_word = 'settingHomeThemeCRMZikii';
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


function indexTheme($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelProduct;
    global $modelCategories;

    $order = array('id'=>'desc');

    $listDataNew= $modelPosts->find()->limit(6)->where(array('type'=>'post','pin'=>1))->order($order)->all()->toList();


    setVariable('listDataNew', $listDataNew);

    
}

?>