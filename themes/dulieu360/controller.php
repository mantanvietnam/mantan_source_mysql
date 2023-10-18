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
                        'content' => @$dataSend['content'],
                        'profile' => @$dataSend['profile'],
                        'imge_profile' => @$dataSend['imge_profile'],



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
     $modelPosts = $controller->loadModel('Posts');
     $modelTour = $controller->loadModel('Tours');
     $modelImage = $controller->loadModel('Images');

    $month = getdate()['mon'];
    $year = getdate()['year'];
    $order = array('id'=>'desc');

    $getmonth   = getmonth();
   

    foreach($getmonth as $key => $item){
        $months = array('month' => $key, 'year' => $year, 'outstanding'=>1, 'status' => '1' );
    

       $event =  $modelEvent->find()->limit(5)->page(1)->where($months)->order($order)->all()->toList();

       if(!empty($event)){
        $getmonth[$key]['event'] = $event;
       }
       if($key==(int)$month){
            $getmonth[$key]['status'] = 1;
       }
    }
    

    $conditionsTour =array('status' => '1');
    


    $listDataPost= $modelPosts->find()->limit(5)->page(1)->where()->order($order)->all()->toList();
    $listDataTour= $modelTour->find()->limit(3)->page(1)->where($conditionsTour)->order($order)->all()->toList();
    $listDataImage = $modelImage ->find()->limit(30)->page(1)->where($conditionsTour)->order($order)->all()->toList();


    

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

     setVariable('setting', $data_value);
     setVariable('listDataEvent', $getmonth);
     setVariable('listDataPost', $listDataPost);
     setVariable('listDataTour', $listDataTour);
     setVariable('listDataImage', $listDataImage);
    


}
 ?>