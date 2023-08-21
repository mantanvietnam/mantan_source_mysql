<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/warm-admin-settingHomeThemeWarm.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeWarm'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $settingThemes;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeWarm');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);
}