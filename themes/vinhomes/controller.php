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

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'text_logo' => @$dataSend['text_logo'],
                        'background_image' => @$dataSend['background_image'],
                        'title_footer' => @$dataSend['title_footer'],
                        'agency' => @$dataSend['agency'],
                        'address' => @$dataSend['address'],
                        'phone' => @$dataSend['phone'],
                        'email' => @$dataSend['email'],
                        'responsibilityphone' => @$dataSend['responsibilityphone'],
                        'responsibilityemail' => @$dataSend['responsibilityemail'],
                        'follow' => @$dataSend['follow'],
                        'idlink' => @$dataSend['idlink'],
                        'youtube' => @$dataSend['youtube'],
                        'tiktok' => @$dataSend['tiktok'],
                        'zalo' => @$dataSend['zalo'],
                        'facebook' => @$dataSend['facebook'],       
                        'title_introduce_1' => @$dataSend['title_introduce_1'],       
                        'title_introduce_2' => @$dataSend['title_introduce_2'],       
                        'logo_introduce' => @$dataSend['logo_introduce'],       
                        'image_introduce' => @$dataSend['image_introduce'],       
                        'content1_introduce' => @$dataSend['content1_introduce'],       
                        'content2_introduce' => @$dataSend['content2_introduce'],       
                        'content3_introduce' => @$dataSend['content3_introduce'],       
                        'title_why_choose' => @$dataSend['title_why_choose'],       
                        'content1_why_choose' => @$dataSend['content1_why_choose'],       
                        'content2_why_choose' => @$dataSend['content2_why_choose'],       
                        'content3_why_choose' => @$dataSend['content3_why_choose'],       
                        'content4_why_choose' => @$dataSend['content5_why_choose'],       
                        'image1_news_hot' => @$dataSend['image1_news_hot'],       
                        'image2_news_hot' => @$dataSend['image2_news_hot'],       
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
    global $controller; 
    global $modelCategories;
    global $modelOptions;

    // $conditions = array('key_word' => 'settingHomeTheme');
    // $data = $modelOptions->find()->where($conditions)->first();
    // $modelEvent = $controller->loadModel('Events');
    // $modelPosts = $controller->loadModel('Posts');
    // $modelTour = $controller->loadModel('Tours');
    // $modelImage = $controller->loadModel('Images');

    // $month = getdate()['mon'];
    // $year = getdate()['year'];
    // $order = array('id'=>'desc');


    // $conditionsmonth = array('month' => $month, 'year' => $year , 'status' => '1' );

    // $conditionsTour =array('status' => '1');
    
    // $listDataEvent= $modelEvent->find()->limit(1)->page(1)->where($conditionsmonth)->order(['id'=>'desc','pin'=>'desc', 'outstanding' =>'desc'])->all()->toList();
    // $listDataPost= $modelPosts->find()->limit(4)->page(1)->where()->order($order)->all()->toList();
    // $listDataTour= $modelTour->find()->limit(30)->page(1)->where($conditionsTour)->order($order)->all()->toList();
    // $listDataImage = $modelImage ->find()->limit(30)->page(1)->where($conditionsTour)->order($order)->all()->toList();


    // $data_value = array();
    // if(!empty($data->value)){
    //     $data_value = json_decode($data->value, true);
    // }

    // setVariable('setting', $data_value);
    // setVariable('listDataEvent', $listDataEvent);
    // setVariable('listDataPost', $listDataPost);
    // setVariable('listDataTour', $listDataTour);
    // setVariable('listDataImage', $listDataImage);
}
?>