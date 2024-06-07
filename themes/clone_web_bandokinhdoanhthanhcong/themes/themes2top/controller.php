<?php
function settingHomeThemew2top($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';
	
    $conditions = array('key_word' => 'settingHomeThemew2top');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
		if($isRequestPost){
			$dataSend = $input['request']->getData();
			
			$value = array(
				'logo'=> @$dataSend['logo'],
                'buttontest'=> @$dataSend['buttontest'],
				'facebook'=> @$dataSend['facebook'],
                'id_slide' => $dataSend['id_slide'],
                'titleselft'=> @$dataSend['titleselft'],
                'title1'=> @$dataSend['title1'],
                'title2'=> @$dataSend['title2'],
                'button1'=> @$dataSend['button1'],

                // dich vu

                'dichvu'=> @$dataSend['dichvu'],
                'moredichvu'=> @$dataSend['moredichvu'],

                'logodichvu'=> @$dataSend['logodichvu'],
                'titledichvu'=> @$dataSend['titledichvu'],
                'paragrapdichvu'=> @$dataSend['paragrapdichvu'],
                'buttonxem'=> @$dataSend['buttonxem'] ,
                // nhan su

                'nhansu' => @$dataSend['nhansu'],
                'questionnhansu'=> @$dataSend['questionnhansu'],
                'imagenhansu'=> @$dataSend['imagenhansu'],
                'chucvu'=> @$dataSend['chucvu'],
                'namenhansu'=> @$dataSend['namenhansu'],
                // gia tri khac biet

                'giatrikhacbiet'=> @$dataSend['giatrikhacbiet'],
                'parag1'=> @$dataSend['parag1'],
                'parag2'=> @$dataSend['parag2'],
                'parag3'=> @$dataSend['parag3'],


                'uytin'=> @$dataSend['uytin'],
                'chuyennghiep'=> @$dataSend['chuyennghiep'],
                'sangtao'=> @$dataSend['sangtao'],
                'tongthe'=> @$dataSend['tongthe'],
                'tienphong'=> @$dataSend['tienphong'],
                'baomat'=> @$dataSend['baomat'],

                'image1'=> @$dataSend['image1'],
                'image2'=> @$dataSend['image2'],
                'image3'=> @$dataSend['image3'],
                'image4'=> @$dataSend['image4'],
                'image5'=> @$dataSend['image5'],
                'image6'=> @$dataSend['image6'],

                'paragrap1'=> @$dataSend['paragrap1'],


                // doi tac noi j 

                'namekhachhang'=> @$dataSend['namekhachhang'],
                'whatabout'=> @$dataSend['whatabout'],
                'idsideyourself'=> @$dataSend['idsideyourself'],

                // tin tuc noi bat
                'news'=> @$dataSend['news'],
                'newsnoibat'=> @$dataSend['newsnoibat'],
                'idnews'=> @$dataSend['idnews'],
                'time'=> @$dataSend['time'],
                'titletintuc'=> @$dataSend['titletintuc'],
                'contenttintuc'=> @$dataSend['contenttintuc'],

                // footer

                'diachi'=> @$dataSend['diachi'],
                'sdt'=> @$dataSend['sdt'],
                'email'=> @$dataSend['email'],
                'timeaction'=> @$dataSend['timeaction'],
                // mang xa hoi

                'youtube'=> @$dataSend['youtube'],
			);
	
	$data->key_word = 'settingHomeThemew2top';
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


	$conditions = array('key_word' => 'settingHomeThemew2top');
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
   
    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }
    $slideyourself = [];
    if(!empty($settingThemes['idsideyourself'])){
        $slideyourself = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['idsideyourself']])->all()->toList();
    }
    $slidenews = [];
    if(!empty($settingThemes['idnews'])){
        $slidenews = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['idnews']])->all()->toList();
    }
    
    
    setVariable('slidenews', $slidenews);
    setVariable('slideyourself', $slideyourself);
    setVariable('slide_home', $slide_home);
    setVariable('setting', $data_value);
 
  
	
}
function news($input){

    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $modelPosts;
    global $metaTitleMantan;
    

    $metaTitleMantan = 'Cài đặt giao diện tin tức';
    $mess= '';
    $conditions = array('key_word' => 'settingPostThemew2top');
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $order = array('id'=>'desc');
    $listDatatop= $modelPosts->find()->limit(4)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    $listDataPost= $modelPosts->find()->limit(12)->where(array('type'=>'post'))->order($order)->all()->toList();


  
    setVariable('listDataPost', $listDataPost);
    setVariable('listDatatop', $listDatatop);
    
  

}
function requeriment($input){ 
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $modelPosts;
    global $metaTitleMantan;
    global $modelrequeriment;

    $modelrequeriment = $controller->loadModel('requeriment');
    $order = array('id'=>'desc');
    $listDatarequeriment= $modelrequeriment->find()->limit(12)->where(array('type'=>'detaire'))->order($order)->all()->toList();
    setVariable('listDatarequeriment', $listDatarequeriment);

}
function detailrequeriment($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $metaTitleMantan;
    $conditions = array('key_word' => 'settingHomeThemew2top');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelrequeriment = $controller->loadModel('requeriment');
    $modelEvaluate = $controller->loadModel('Evaluates');
    
    $order = array('id'=>'desc');

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }



    $conditions = array();


    $list_requeriment = $modelrequeriment->find()->where($conditions)->order($order)->all()->tolist();

  
    $conditionsEvaluat = array();
    if(!empty($_GET['id_requeriment'])){
        $conditionsEvaluat['id_requeriment'] = $_GET['id_requeriment'];
    }

    $evaluate = $modelEvaluate->find()->where($conditionsEvaluat)->order($order)->all()->toList();

    foreach($evaluate as $k => $value){
        $evaluate[$k]->requeriment = $modelrequeriment->find()->where(['id'=>$value->id_requeriment])->first();
    }


    setVariable('setting', $data_value);
    setVariable('list_requeriment', $list_requeriment);
    setVariable('evaluate', $evaluate);
}