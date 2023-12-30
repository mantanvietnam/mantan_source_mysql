<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/shopbanhang-admin-settingHomeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );
$menus[0]['sub'][1]= array( 'title'=>'Cài đặt chính sách bảo hành',
                            'url'=>'/plugins/admin/shopbanhang-admin-sttingGuaranteeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'sttingGuaranteeTheme'
                        );
$menus[0]['sub'][2]= array( 'title'=>'Cài đặt trang Review',
                            'url'=>'/plugins/admin/shopbanhang-admin-sttingReviewTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'sttingReviewTheme'
                        );
$menus[0]['sub'][3]= array( 'title'=>'Cài đặt trang About us',
                            'url'=>'/plugins/admin/shopbanhang-admin-settingAboutusTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingAboutuTheme'
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

function checkFlasl(){

    global $controller; 
    $modelProduct = $controller->loadModel('Products');

    $product_flasl = $modelProduct->find()->limit(4)->where(['flash_sale'=>1,'status'=>'active'])->all()->toList();

    return $product_flasl;
}


?>