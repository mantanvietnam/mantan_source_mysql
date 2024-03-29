<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/datacrm-admin-settingHomeThemeDataCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeDataCRM'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeDataCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);
}

?>