<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/training-admin-settingHomeThemeTraining.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeTraining'
                        );

addMenuAdminMantan($menus);

global $modelOptions;

$conditionsSetting = array('key_word' => 'settingHomeThemeTraining');
$settingTraining2TOPCRM = $modelOptions->find()->where($conditionsSetting)->first();
if(empty($settingTraining2TOPCRM)){
    $settingTraining2TOPCRM = $modelOptions->newEmptyEntity();
}

$setting_value = array();
if(!empty($settingTraining2TOPCRM->value)){
    $setting_value = json_decode($settingTraining2TOPCRM->value, true);
}


setVariable('setting_value', $setting_value);
?>