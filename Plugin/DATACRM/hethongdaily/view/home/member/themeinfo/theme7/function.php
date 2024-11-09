<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/Kyiova-admin-settingHomeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );
$menus[0]['sub'][1]= array( 'title'=>'Cài đặt câu chuyện',
                            'url'=>'/plugins/admin/Kyiova-admin-settingAboutUs',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingAboutUs'
                        );


addMenuAdminMantan($menus);

function setting(){
    global $controller;
    global $modelOptions;
     $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

   

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    return $data_value;
}

function slide_home($id){
    global $modelAlbums;
    global $modelAlbuminfos;
    
    $slide_home = $modelAlbums->find()->where(['id'=>(int)$id])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->all()->toList();
    }

    return $slide_home;
}

function getByIdCategory($id){
    global $modelCategories;

    $Categories = $modelCategories->find()->where(['id'=>(int)$id])->first();



    return $Categories;
}

function getCategorieProduct(){
    global $modelCategories;
    $conditionCategorieProduct = array('type' => 'category_product','status'=>'active');
    return  $modelCategories->find()->where($conditionCategorieProduct)->all()->toList();
}

function getPostPin(){
    global $modelPosts;

    return $modelPosts->find()->limit(5)->where(array('pin'=>1))->all()->toList();
}


?>