<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/ketoan-admin-settingHomeThemeKeToan.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeKeToan'
                        );
addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeKeToan');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);

    if(!empty($settingThemes['idMenu_footer'])){
        $settingThemes['menu_footer'] = $modelMenus->find()->where(['id_menu' => (int) $settingThemes['idMenu_footer'], 'id_parent'=>0])->order(['weighty'=>'ASC'])->all()->toList();
    }
}



?>