<?php 
function settinghomevemoi($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';
    $conditions = array('key_word' => 'settinghomevemoi');
    
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $value = array(
            'logo' =>$dataSend['logo'],
            'slide_banner'=>$dataSend['slide_banner'],
            'titleredbanner' =>$dataSend['titleredbanner'],
            'titleblackbanner' =>$dataSend['titleblackbanner'],
            'descriptionbanner' =>$dataSend['descriptionbanner'],
            'image1' =>$dataSend['image1'],
            'image2' =>$dataSend['image2'],
            'number1' =>$dataSend['number1'],
            'number2'=>$dataSend['number2'],
            'number3' =>$dataSend['number3'],
            'icon1' =>$dataSend['icon1'],
            'icon2' =>$dataSend['icon2'],
            'icon3' =>$dataSend['icon3'],
            'titleicon1' =>$dataSend['titleicon1'],
            'titleicon2' =>$dataSend['titleicon2'],
            'titleicon3' =>$dataSend['titleicon3'],


            'slidealbumNTT' =>$dataSend['slidealbumNTT'],
            'titleNTT'=>$dataSend['titleNTT'],
            'titleNTTsmall'=>$dataSend['titleNTTsmall'],


            'imagefull'=>$dataSend['imagefull'],
            'titlesukien'=>$dataSend['titlesukien'],
            'titlesmallsukien'=>$dataSend['titlesmallsukien'],

            'descriptionfooter'=>$dataSend['descriptionfooter'],
            'emailfooter'=>$dataSend['emailfooter'],
            'Instagram'=>$dataSend['Instagram'],
            'Facebook'=>$dataSend['Facebook'],
            'Twitter'=>$dataSend['Twitter'],
            'YouTube'=>$dataSend['YouTube'],
            // contact 
            'imageheadercontact'=>$dataSend['imageheadercontact'],
            'imagecontact'=>$dataSend['imagecontact'],
            'map'=>$dataSend['map'],
    
            'phone'=>$dataSend['phone'],
            'address'=>$dataSend['address'],
     

        );
    $data->key_word = 'settinghomevemoi';
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
function indexTheme($input){
    global $modelAlbums;
	global $modelOptions;
	global $modelNotices;
	global $modelPosts;
	global $modelAlbuminfos;
	global $settingThemes;
    global $controller;
    global $modelCategories;
    global $session;
    $info = $session->read('infoUser');
	$conditions = array('key_word' => 'settinghomevemoi');

    $order = array('id'=>'desc');
    $modelevents = $controller->loadModel('events');
    $listDataevent= $modelevents->find()->where(['show_on_homepage' => 1])->order($order)->all()->toList();

    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $order = array('id'=>'desc');
    $listDatatop= $modelPosts->find()->limit(4)->where(array( 'type'=>'post'))->order($order)->all()->toList();
    $slide_banner = [];
    if(!empty($settingThemes['slide_banner'])){
        $slide_banner = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['slide_banner']])->all()->toList();
    }
    $slidealbumNTT = [];
    if(!empty($settingThemes['slidealbumNTT'])){
        $slidealbumNTT = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['slidealbumNTT']])->all()->toList();
    }
    if(!empty($info)){
        setVariable('info', $info);
    }
    setVariable('listDataevent', $listDataevent);
    setVariable('listDatatop', $listDatatop);
    setVariable('slidealbumNTT', $slidealbumNTT);
    setVariable('slide_banner', $slide_banner);
}
function categoryPostTheme($input){
    global $modelPosts;
    global $modelCategories;
    global $category;
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();
    $order = array('id'=>'desc');
    $listDatatop2= $modelPosts->find()->limit(2)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    $listDatatop= $modelPosts->find()->limit(12)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    setVariable('listDatatop2', $listDatatop2);
    setVariable('listDatatop', $listDatatop);
    setVariable('category_post', $category_post);
}

?>