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
                        'link_image360' => @$dataSend['link_image360'],
                        'welcome1' => @$dataSend['welcome1'],
                        'welcome2' => @$dataSend['welcome2'],
                        'title_travel1' => @$dataSend['title_travel1'],
                        'image_travel1' => @$dataSend['image_travel1'],
                        'link_travel1' => @$dataSend['link_travel1'],
                        'title_travel2' => @$dataSend['title_travel2'],
                        'image_travel2' => @$dataSend['image_travel2'],
                        'link_travel2' => @$dataSend['link_travel2'],
                        'title_travel3' => @$dataSend['title_travel3'],
                        'image_travel3' => @$dataSend['image_travel3'],
                        'link_travel3' => @$dataSend['link_travel3'],
                        'title_travel4' => @$dataSend['title_travel4'],
                        'image_travel4' => @$dataSend['image_travel4'],
                        'link_travel4' => @$dataSend['link_travel4'],
                        'title6' => @$dataSend['title6'],
                        'note6' => @$dataSend['note6'],
                        'image_6' => @$dataSend['image_6'],
                        'title_footer' => @$dataSend['title_footer'],
                        'agency' => @$dataSend['agency'],
                        'address' => @$dataSend['address'],
                        'phone' => @$dataSend['phone'],
                        'email' => @$dataSend['email'],
                        'responsibility' => @$dataSend['responsibility'],
                        'responsibilityphone' => @$dataSend['responsibilityphone'],
                        'responsibilityemail' => @$dataSend['responsibilityemail'],
                        'follow' => @$dataSend['follow'],
                        'idlink' => @$dataSend['idlink'],
                        'youtube' => @$dataSend['youtube'],
                        'tiktok' => @$dataSend['tiktok'],
                        'zalo' => @$dataSend['zalo'],
                        'facebook' => @$dataSend['facebook'],
                        'key_google_map' => @$dataSend['key_google_map'],
                        
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

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelEvent = $controller->loadModel('Events');
    $modelHistoricalSite = $controller->loadModel('HistoricalSites');
    $modelImage = $controller->loadModel('Images');

    $month = getdate()['mon'];
    $year = getdate()['year'];
    $order = array('id'=>'desc');

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }


    $conditionsmonth = array('month' => $month, 'year' => $year , 'status' => '1' );

    $conditionsTour =array('status' => '1');

    $listHistorie = $modelHistoricalSite->find()->limit(4)->page(1)->where()->order($order)->all()->toList();
    $listHistorieAll = $modelHistoricalSite->find()->where()->order($order)->all()->toList();
    
    $listDataEvent= $modelEvent->find()->limit(1)->page(1)->where($conditionsmonth)->order(['id'=>'desc','pin'=>'desc', 'outstanding' =>'desc'])->all()->toList();
    $listDataImage = $modelImage->find()->limit(30)->page(1)->where($conditionsTour)->order($order)->all()->toList();
    $typeHistoricalSites = $modelCategories->find()->where(['type' => 'typeHistoricalSites'])->all()->toList();

   /* $listDataPost= $modelPosts->find()->limit(4)->page(1)->where()->order($order)->all()->toList();
    $listDataTour= $modelTour->find()->limit(30)->page(1)->where($conditionsTour)->order($order)->all()->toList();
    
    setVariable('listDataPost', $listDataPost);
    setVariable('listDataTour', $listDataTour);*/
    setVariable('setting', $data_value);
    setVariable('listHistorie', $listHistorie);
    setVariable('listDataEvent', $listDataEvent);
    setVariable('listDataImage', $listDataImage);
    setVariable('typeHistoricalSites', $typeHistoricalSites);
    setVariable('listHistorieAll', $listHistorieAll);
}
?>