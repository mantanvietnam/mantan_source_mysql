<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/clone_web_zikii-setting_theme_clone_web',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'setting_theme_clone_web'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingThemeZikiiCloneWeb');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);
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