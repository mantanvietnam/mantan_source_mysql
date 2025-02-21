<?php 
function setingBankAccount($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingBankAccount');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array('rose_ambassador' => @$dataSend['rose_ambassador'], 
                        'nutritional_function' => @$dataSend['nutritional_function'],
                        'fasting_function' => @$dataSend['fasting_function'],
                        'meal_function' => @$dataSend['meal_function'],
                        'challenge_function' => @$dataSend['challenge_function'],
                        'payment' => @$dataSend['payment']
                       
                    );
        $data->key_word = 'setingBankAccount';
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
function settinghome($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setinghomepage');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array('slide_home_page' => @$dataSend['slide_home_page'], 
                       
                    );
        $data->key_word = 'setinghomepage';
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
function setingAbout($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingAbout');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'titel_header' => @$dataSend['titel_header'],
                        'titel_header_en' => @$dataSend['titel_header_en'],
                        'desc_header' => @$dataSend['desc_header'],
                        'desc_header_en' => @$dataSend['desc_header_en'],
                        'image_header' => @$dataSend['image_header'],
                        'titel_tamnhin' => @$dataSend['titel_tamnhin'],
                        'titel_tamnhin_en' => @$dataSend['titel_tamnhin_en'],
                        'desc_tamnhin_phantu1' => @$dataSend['desc_tamnhin_phantu1'],
                        'desc_tamnhin_phantu1_en' => @$dataSend['desc_tamnhin_phantu1_en'],
                        'image_tamnhin_phantu1' => @$dataSend['image_tamnhin_phantu1'],
                        'desc_phantu2' => @$dataSend['desc_phantu2'],
                        'desc_tamnhin_phantu2_en' => @$dataSend['desc_tamnhin_phantu2_en'],
                        'image_tamnhin_phantu2' => @$dataSend['image_tamnhin_phantu2'],
                        'titel_sanpham' => @$dataSend['titel_sanpham'],
                        'titel_sanpham_en' => @$dataSend['titel_sanpham_en'],
                        'desc_sanpham' => @$dataSend['desc_sanpham'],
                        'desc_sanpham_en' => @$dataSend['desc_sanpham_en'],
                        'link_sanpham' => @$dataSend['link_sanpham'],
                        'link_sanpham_en' => @$dataSend['link_sanpham_en'],
                        'image_sanpham' => @$dataSend['image_sanpham'],
                        'titel_nhasangnlap' => @$dataSend['titel_nhasangnlap'],
                        'desc_nhasangnlap' => @$dataSend['desc_nhasangnlap'],
                        'titel_nhasangnlap_en' => @$dataSend['titel_nhasangnlap_en'],
                        'desc_nhasangnlap_en' => @$dataSend['desc_nhasangnlap_en'],
                        'image_nhasangnlap' => @$dataSend['image_nhasangnlap'],
                        'id_album' => @$dataSend['id_album'],
                       
                    );
        $data->key_word = 'setingAbout';
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
function settingproduct($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingproduct');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'image_product_header' => @$dataSend['image_product_header'],
                        'title_header_product' => @$dataSend['title_header_product'],
                        'title_header_product_en' => @$dataSend['title_header_product_en'],
                        'title_header_product2' => @$dataSend['title_header_product2'],
                        'title_header_product2_en' => @$dataSend['title_header_product2_en'],
                        'title_header_product3' => @$dataSend['title_header_product3'],
                        'title_header_product3_en' => @$dataSend['title_header_product3_en'],
                        'link_header_product' => @$dataSend['link_header_product'],
                        'title_popular_product' => @$dataSend['title_popular_product'],
                        'title_popular_product_en' => @$dataSend['title_popular_product_en'],
                        'text1_popular' => @$dataSend['text1_popular'],
                        'text1_popular_en' => @$dataSend['text1_popular_en'],
                        'text2' => @$dataSend['text2'],
                        'text2_en' => @$dataSend['text2_en'],
                        'desctv' => @$dataSend['desctv'],
                        'descen' => @$dataSend['descen'],
                        'desctv2' => @$dataSend['desctv2'],
                        'descen2' => @$dataSend['descen2'],
                        'text_description_banner_2' => @$dataSend['text_description_banner_2'],
                        'text_description_banner2_en' => @$dataSend['text_description_banner2_en'],
                        'image_banner_3' => @$dataSend['image_banner_3'],
                       
                        'image_popular_1' => @$dataSend['image_popular_1'],
                        'image_popular_2' => @$dataSend['image_popular_2'],
                        'text_banner_1' => @$dataSend['text_banner_1'],
                        'text_banner_1_en' => @$dataSend['text_banner_1_en'],
                        'text_banner_2' => @$dataSend['text_banner_2'],
                        'text_banner_2_en' => @$dataSend['text_banner_2_en'],
                        'text_banner_3' => @$dataSend['text_banner_3'],
                        'text_banner_3_en' => @$dataSend['text_banner_3_en'],
                        'image_banner_1' => @$dataSend['image_banner_1'],
                        'text_description_banner_1' => @$dataSend['text_description_banner_1'],
                        'text_description_banner1_en' => @$dataSend['text_description_banner1_en'],
                        'text_description_banner3' => @$dataSend['text_description_banner3'],
                        'text_description_banner3_en' => @$dataSend['text_description_banner3_en'],
                        'image_banner_2' => @$dataSend['image_banner_2'],
                        'link_dowload_banner' => @$dataSend['link_dowload_banner'],


                        'id_slide_product' => @$dataSend['id_slide_product'],
          


                        'discover_text_title1' => @$dataSend['discover_text_title1'],
                        'discover_text_title1_en' => @$dataSend['discover_text_title1_en'],
                        'discover_description_title1' => @$dataSend['discover_description_title1'],
                        'discover_description_title1_en' => @$dataSend['discover_description_title1_en'],
                        'discover_link1' => @$dataSend['discover_link1'],
                        'image_discover_1' => @$dataSend['image_discover_1'],
                        'discover_text_title2' => @$dataSend['discover_text_title2'],
                        'discover_text_title2_en' => @$dataSend['discover_text_title2_en'],
                        'discover_description_title2' => @$dataSend['discover_description_title2'],
                        'discover_description_title2_en' => @$dataSend['discover_description_title2_en'],
                        'image_discover_2' => @$dataSend['image_discover_2'],
                        'discover_text_title3' => @$dataSend['discover_text_title3'],
                        'discover_text_title3_en' => @$dataSend['discover_text_title3_en'],
                        'discover_description_title3' => @$dataSend['discover_description_title3'],
                        'discover_description_title3_en' => @$dataSend['discover_description_title3_en'],

                        'discover_link2' => @$dataSend['discover_link2'],
                        'image_discover_3' => @$dataSend['image_discover_3'],
                        'discover_link3' => @$dataSend['discover_link3'],
                       
                    );
        $data->key_word = 'settingproduct';
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
function settingbusiness($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingbusiness');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'link_business_1' => @$dataSend['link_business_1'],
                        'link_business_2' => @$dataSend['link_business_2'],
                        'title_business' => @$dataSend['title_business'],
                        'title_business_en' => @$dataSend['title_business_en'],
                        'desc_business' => @$dataSend['desc_business'],
                        'desc_business_en' => @$dataSend['desc_business_en'],
                        'link_business_youtube' => @$dataSend['link_business_youtube'],
                        'image_poster' => @$dataSend['image_poster'],
                        'text_data_business1' => @$dataSend['text_data_business1'],
                        'title_desc_reason1' => @$dataSend['title_desc_reason1'],
                        'title_desc_reason_en1' => @$dataSend['title_desc_reason_en1'],
                        'image_reason1' => @$dataSend['image_reason1'],
                        'text_data_business2' => @$dataSend['text_data_business2'],
                        'title_desc_reason2' => @$dataSend['title_desc_reason2'],
                        'title_desc_reason_en2' => @$dataSend['title_desc_reason_en2'],
                        'image_reason2' => @$dataSend['image_reason2'],
                        'text_data_business3' => @$dataSend['text_data_business3'],
                        'title_desc_reason3' => @$dataSend['title_desc_reason3'],
                        'title_desc_reason_en3' => @$dataSend['title_desc_reason_en3'],
                        'image_reason3' => @$dataSend['image_reason3'],
                        'exclusive_title1' => @$dataSend['exclusive_title1'],
                        'exclusive_title1_en' => @$dataSend['exclusive_title1_en'],
                        'exclusive_desc1' => @$dataSend['exclusive_desc1'],
                        'exclusive_desc1_en' => @$dataSend['exclusive_desc1_en'],
                        'exclusive_text1' => @$dataSend['exclusive_text1'],
                        'exclusive_text1_en' => @$dataSend['exclusive_text1_en'],
                        'poster_exclusive1' => @$dataSend['poster_exclusive1'],
                        'exclusive_title2' => @$dataSend['exclusive_title2'],
                        'exclusive_title2_en' => @$dataSend['exclusive_title2_en'],
                        'exclusive_desc2' => @$dataSend['exclusive_desc2'],
                        'exclusive_desc2_en' => @$dataSend['exclusive_desc2_en'],
                        'exclusive_text2' => @$dataSend['exclusive_text2'],
                        'exclusive_text2_en' => @$dataSend['exclusive_text2_en'],
                        'poster_exclusive2' => @$dataSend['poster_exclusive2'],
                        'slide_business' => @$dataSend['slide_business'],
                        'zoom_title' => @$dataSend['zoom_title'],
                        'zoom_title_en' => @$dataSend['zoom_title_en'],
                        'zoom_desc' => @$dataSend['zoom_desc'],
                        'zoom_desc_en' => @$dataSend['zoom_desc_en'],
                        'zoom_image' => @$dataSend['zoom_image'],
                        'link_video_coaching1' => @$dataSend['link_video_coaching1'],
                        'title_coaching1' => @$dataSend['title_coaching1'],
                        'title_coaching1_en' => @$dataSend['title_coaching1_en'],
                        'text_description_coaching1' => @$dataSend['text_description_coaching1'],
                        'text_description_coaching2' => @$dataSend['text_description_coaching2'],
                        'text_description_coaching3' => @$dataSend['text_description_coaching3'],
                        'text_description_coaching4' => @$dataSend['text_description_coaching4'],
                        'text_description_coaching5' => @$dataSend['text_description_coaching5'],
                        'text_description_coaching6' => @$dataSend['text_description_coaching6'],
                        'text_description_coaching7' => @$dataSend['text_description_coaching7'],
                        'link_video1_coaching1' => @$dataSend['link_video1_coaching1'],
                        'title1_coaching1' => @$dataSend['title1_coaching1'],
                        'title1_coaching1_en' => @$dataSend['title1_coaching1_en'],
                        'text_description1_coaching1' => @$dataSend['text_description1_coaching1'],
                        'text_description1_coaching2' => @$dataSend['text_description1_coaching2'],
                        'text_description1_coaching3' => @$dataSend['text_description1_coaching3'],
                        'text_description1_coaching4' => @$dataSend['text_description1_coaching4'],
                        'text_description1_coaching5' => @$dataSend['text_description1_coaching5'],
                        'text_description1_coaching6' => @$dataSend['text_description1_coaching6'],
                        'text_description1_coaching7' => @$dataSend['text_description1_coaching7'],
                        'image_coaching' => @$dataSend['image_coaching'],
                        'title2_coaching1' => @$dataSend['title2_coaching1'],
                        'title2_coaching1_en' => @$dataSend['title2_coaching1_en'],
                        'text_description2_coaching1' => @$dataSend['text_description2_coaching1'],
                        'text_description2_coaching2' => @$dataSend['text_description2_coaching2'],
                        'text_description2_coaching3' => @$dataSend['text_description2_coaching3'],
                        'text_description2_coaching4' => @$dataSend['text_description2_coaching4'],
                        'text_description2_coaching5' => @$dataSend['text_description2_coaching5'],
                        'text_description2_coaching6' => @$dataSend['text_description2_coaching6'],
                        'text_description2_coaching7' => @$dataSend['text_description2_coaching7'],
                        'text_description_coaching1_en' => @$dataSend['text_description_coaching1_en'],
                        'text_description_coaching2_en' => @$dataSend['text_description_coaching2_en'],
                        'text_description_coaching3_en' => @$dataSend['text_description_coaching3_en'],
                        'text_description_coaching4_en' => @$dataSend['text_description_coaching4_en'],
                        'text_description_coaching5_en' => @$dataSend['text_description_coaching5_en'],
                        'text_description_coaching6_en' => @$dataSend['text_description_coaching6_en'],
                        'text_description_coaching7_en' => @$dataSend['text_description_coaching7_en'],
                        'text_description7_coaching7_en' => @$dataSend['text_description7_coaching7_en'],
                        'text_description6_coaching6_en' => @$dataSend['text_description6_coaching6_en'],
                        'text_description5_coaching5_en' => @$dataSend['text_description5_coaching5_en'],
                        'text_description4_coaching4_en' => @$dataSend['text_description4_coaching4_en'],
                        'text_description3_coaching3_en' => @$dataSend['text_description3_coaching3_en'],
                        'text_description2_coaching2_en' => @$dataSend['text_description2_coaching2_en'],
                        'text_description1_coaching1_en' => @$dataSend['text_description1_coaching1_en'],

                        'text_description2_coaching1_en' => @$dataSend['text_description2_coaching1_en'],
                        'text_description1_coaching2_en' => @$dataSend['text_description1_coaching2_en'],
                        'text_description2_coaching3_en' => @$dataSend['text_description2_coaching3_en'],
                        'text_description2_coaching4_en' => @$dataSend['text_description2_coaching4_en'],
                        'text_description2_coaching5_en' => @$dataSend['text_description2_coaching5_en'],
                        'text_description2_coaching6_en' => @$dataSend['text_description2_coaching6_en'],
                        'text_description2_coaching7_en' => @$dataSend['text_description2_coaching7_en'],

                        'id_slide_price' => @$dataSend['id_slide_price'],

                       
                    );
        $data->key_word = 'settingbusiness';
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
 ?>
