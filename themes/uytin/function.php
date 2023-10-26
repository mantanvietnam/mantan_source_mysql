<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/uytin-admin-settingHomeTheme.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $themeSettings;

$conditionsSetting = array('key_word' => 'settingHomeThemeUyTin');
$settingTraining2TOPCRM = $modelOptions->find()->where($conditionsSetting)->first();

if(empty($settingTraining2TOPCRM)){
    $settingTraining2TOPCRM = $modelOptions->newEmptyEntity();
}

$setting_value = array();
if(!empty($settingTraining2TOPCRM->value)){
    $setting_value = json_decode($settingTraining2TOPCRM->value, true);
}

$themeSettings = $setting_value;
?>