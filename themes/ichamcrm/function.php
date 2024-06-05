<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/ichamcrm-admin-settingHomeThemeIchamCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeDataCRM'
                        );
$menus[0]['sub'][1]= array( 'title'=>'Cài đặt trang Tuyển Dụng',
                            'url'=>'/plugins/admin/ichamcrm-admin-settingRecruitmentThemeIchamCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingRecruitmentThemeIchamCRM'
                        );
$menus[0]['sub'][2]= array( 'title'=>'Cài đặt trang Liên Hệ',
                            'url'=>'/plugins/admin/ichamcrm-admin-settingContactThemeIchamCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingContactThemeIchamCRM'
                        );

$menus[1]['title']= 'Liên Hệ';
$menus[1]['sub'][0]= array( 'title'=>'Danh sách Liên Hệ',
                            'url'=>'/plugins/admin/contacts-view-admin-listContactAdmin',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listContactAdmin'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $settingRecruitments;
global $settingContacts;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeIchamCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);
}

// CÀI ĐẶT TRANG TUYỂN DỤNG
$conditions = array('key_word' => 'settingRecruitmentThemeIchamCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingRecruitments = array();
if(!empty($data->value)){
    $settingRecruitments = json_decode($data->value, true);
}

// CÀI ĐẶT TRANG LIÊN HỆ
$conditions = array('key_word' => 'settingContactThemeIchamCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingContacts = array();
if(!empty($data->value)){
    $settingContacts = json_decode($data->value, true);
}

?>