<?php 
function settinghometruyenthongao($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';
    $conditions = array('key_word' => 'settinghometruyenthongao');
    
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $value = array(
            'logo' =>$dataSend['logo'],

     

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
	$conditions = array('key_word' => 'settinghometruyenthongao');

    $order = array('id'=>'desc');

    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $order = array('id'=>'desc');
    $listDatatop= $modelPosts->find()->limit(4)->where(array( 'type'=>'post'))->order($order)->all()->toList();

    setVariable('listDatatop', $listDatatop);

  
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