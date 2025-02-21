<?php 
function settinghometruyenthongao($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;
    global $modelAlbuminfos;
    global $modelAlbums;
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';
    $conditions = array('key_word' => 'settinghometruyenthongao');
    
    $data = $modelOptions->find()->where($conditions)->first();
    $dataalbumsinfo= $modelAlbuminfos->find()->where()->all();
    $datacategory = $modelCategories->find()->where()->all();
    $dataalbums = $modelAlbums->find()->where()->all();
  
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $value = array(
            'logo' =>$dataSend['logo'],
            'titleheader' =>$dataSend['titleheader'],
            'descriptionheader' =>$dataSend['descriptionheader'],
            'banner' =>$dataSend['banner'],
            'image1' =>$dataSend['image1'],
            'image2' =>$dataSend['image2'],
            'image3' =>$dataSend['image3'],
            'image4' =>$dataSend['image4'],

            'titlecontent1' =>$dataSend['titlecontent1'],
            'titlecontent2' =>$dataSend['titlecontent2'],
            'titlecontent3' =>$dataSend['titlecontent3'],
            'titlecontent4' =>$dataSend['titlecontent4'],
            'titlecustomer'=>$dataSend['titlecustomer'],
            'video'=>$dataSend['video'],
            'id_slidelistcustomer'=>$dataSend['id_slidelistcustomer'],

            'titleintroduce' =>$dataSend['titleintroduce'],
            'descriptionintroduce' =>$dataSend['descriptionintroduce'],
            'vision' =>$dataSend['vision'],
            'descriptionvision' =>$dataSend['descriptionvision'],
            'mission' =>$dataSend['mission'],
            'descriptionmission' =>$dataSend['descriptionmission'],
            'target'=>$dataSend['target'],
            'descriptiontarget'=>$dataSend['descriptiontarget'],
            'business'=>$dataSend['business'],
            'descriptionbusiness'=>$dataSend['descriptionbusiness'],

            'titleoperational' =>$dataSend['titleoperational'],
            'yearactive' =>$dataSend['yearactive'],
            'numberactive' =>$dataSend['numberactive'],
            'customer' =>$dataSend['customer'],
            'numbercustomer'=>$dataSend['numbercustomer'],
            'events'=>$dataSend['events'],
            'numberevents'=>$dataSend['numberevents'],
            'id_active'=>$dataSend['id_active'],

            'pricelist' =>$dataSend['pricelist'],
            'descriptionpricelist' =>$dataSend['descriptionpricelist'],
            'prilistfooter' =>$dataSend['prilistfooter'],
            'pricelistbasic' =>$dataSend['pricelistbasic'],
            'pricelistsmallbasic' =>$dataSend['pricelistsmallbasic'],
            'pricelistreducebasic'=>$dataSend['pricelistreducebasic'],
            'pricelistPresentbasic'=>$dataSend['pricelistPresentbasic'],
            'pricelistbasicvat'=>$dataSend['pricelistbasicvat'],
            'pricelistreceivebasic1'=>$dataSend['pricelistreceivebasic1'],
            'pricelistreceivebasic2'=>$dataSend['pricelistreceivebasic2'],
            'pricelistreceivebasic3'=>$dataSend['pricelistreceivebasic3'],
            'pricelistreceivebasic4'=>$dataSend['pricelistreceivebasic4'],
            'pricelistreceivebasic5'=>$dataSend['pricelistreceivebasic5'],
            'pricelistreceivebasic6'=>$dataSend['pricelistreceivebasic6'],
            'pricelistreceivebasic7'=>$dataSend['pricelistreceivebasic7'],
            'pricelistreceivebasic8'=>$dataSend['pricelistreceivebasic8'],
            'pricelistreceivebasic9'=>$dataSend['pricelistreceivebasic9'],
            'pricelistreceivebasic10'=>$dataSend['pricelistreceivebasic10'],

            'pricelistfull' =>$dataSend['pricelistfull'],
            'pricelistsmallfull' =>$dataSend['pricelistsmallfull'],
            'pricelistreducefull'=>$dataSend['pricelistreducefull'],
            'pricelistPresentfull'=>$dataSend['pricelistPresentfull'],
            'pricelistfullvat'=>$dataSend['pricelistfullvat'],
            'pricelistreceivefull1'=>$dataSend['pricelistreceivefull1'],
            'pricelistreceivefull2'=>$dataSend['pricelistreceivefull2'],
            'pricelistreceivefull3'=>$dataSend['pricelistreceivefull3'],
            'pricelistreceivefull4'=>$dataSend['pricelistreceivefull4'],
            'pricelistreceivefull5'=>$dataSend['pricelistreceivefull5'],
            'pricelistreceivefull6'=>$dataSend['pricelistreceivefull6'],
            'pricelistreceivefull7'=>$dataSend['pricelistreceivefull7'],
            'pricelistreceivefull8'=>$dataSend['pricelistreceivefull8'],
            'pricelistreceivefull9'=>$dataSend['pricelistreceivefull9'],
            'pricelistreceivefull10'=>$dataSend['pricelistreceivefull10'],

            'pricelistadvanced' =>$dataSend['pricelistadvanced'],
            'pricelistsmalladvanced' =>$dataSend['pricelistsmalladvanced'],
            'pricelistreduceadvanced'=>$dataSend['pricelistreduceadvanced'],
            'pricelistPresentadvanced'=>$dataSend['pricelistPresentadvanced'],
            'pricelistadvancedvat'=>$dataSend['pricelistadvancedvat'],
            'pricelistreceiveadvanced1'=>$dataSend['pricelistreceiveadvanced1'],
            'pricelistreceiveadvanced2'=>$dataSend['pricelistreceiveadvanced2'],
            'pricelistreceiveadvanced3'=>$dataSend['pricelistreceiveadvanced3'],
            'pricelistreceiveadvanced4'=>$dataSend['pricelistreceiveadvanced4'],
            'pricelistreceiveadvanced5'=>$dataSend['pricelistreceiveadvanced5'],
            'pricelistreceiveadvanced6'=>$dataSend['pricelistreceiveadvanced6'],
            'pricelistreceiveadvanced7'=>$dataSend['pricelistreceiveadvanced7'],
            'pricelistreceiveadvanced8'=>$dataSend['pricelistreceiveadvanced8'],
            'pricelistreceiveadvanced9'=>$dataSend['pricelistreceiveadvanced9'],
            'pricelistreceiveadvanced10'=>$dataSend['pricelistreceiveadvanced10'],


            'id_albumcustomer'=>$dataSend['id_albumcustomer'],

            'titlefooterleft'=>$dataSend['titlefooterleft'],
            'address'=>$dataSend['address'],
            'phone'=>$dataSend['phone'],
            'email'=>$dataSend['email'],
            'facebook'=>$dataSend['facebook'],
            'youtube'=>$dataSend['youtube'],
            'instagram'=>$dataSend['instagram'],
            'twiter'=>$dataSend['twiter'],
            'imagedeep'=>$dataSend['imagedeep'],
            
            'codebusiness'=>$dataSend['codebusiness'],
            'name_company'=>$dataSend['name_company'],
            'legal_representative'=>$dataSend['legal_representative'],
            'date_start_company'=>$dataSend['date_start_company'],

            
        );
    $data->key_word = 'settinghometruyenthongao';
	$data->value = json_encode($value);
	$modelOptions->save($data);
	$mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    setVariable('dataalbums', $dataalbums);
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
    global $modelCategories;
    $modelfeedback = $controller->loadModel('feedbacks');
    $datafeedback = $modelfeedback->find()->where()->all();
	$conditions = array('key_word' => 'settinghometruyenthongao');
    $id_slidelistcustomer = [];
    if(!empty($settingThemes['id_slidelistcustomer'])){
        $id_slidelistcustomer = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slidelistcustomer']])->all()->toList();
    }
    $id_active = [];
    if(!empty($settingThemes['id_active'])){
        $id_active = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_active']])->all()->toList();
    }
    $id_albumcustomer = [];
    if(!empty($settingThemes['id_albumcustomer'])){
        $id_albumcustomer = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_albumcustomer']])->all()->toList();
    }

    $order = array('id'=>'desc');

    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $order = array('id'=>'desc');
    $listDatatop= $modelPosts->find()->limit(3)->where(array( 'type'=>'post'))->order($order)->all()->toList();

    setVariable('datafeedback', $datafeedback);
    setVariable('id_albumcustomer', $id_albumcustomer);
    setVariable('id_active', $id_active);
    setVariable('id_slidelistcustomer', $id_slidelistcustomer);
    setVariable('listDatatop', $listDatatop);

  
}
function operational($input){
    global $modelAlbums;
	global $modelOptions;
	global $modelNotices;
	global $modelPosts;
	global $modelAlbuminfos;
	global $settingThemes;
    global $controller;
    global $modelCategories;
    global $session;
    global $modelCategories;
	$conditions = array('key_word' => 'settinghometruyenthongao');
    if(!empty($settingThemes['id_active'])){
        $id_active = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_active']])->all()->toList();
    }
    $order = array('id'=>'desc');

    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    setVariable('id_active', $id_active);



  
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