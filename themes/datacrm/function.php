<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/datacrm-admin-settingHomeThemeDataCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeDataCRM'
                        );
$menus[0]['sub'][1]= array( 'title'=>'Cài đặt trang Tuyển Dụng',
                            'url'=>'/plugins/admin/datacrm-admin-settingRecruitmentThemeDataCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingRecruitmentThemeDataCRM'
                        );
$menus[0]['sub'][2]= array( 'title'=>'Cài đặt trang Liên Hệ',
                            'url'=>'/plugins/admin/datacrm-admin-settingContactThemeDataCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingContactThemeDataCRM'
                        );
/*
$menus[1]['title']= 'Liên Hệ';
$menus[1]['sub'][0]= array( 'title'=>'Danh sách Liên Hệ',
                            'url'=>'/plugins/admin/contacts-view-admin-listContactAdmin',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listContactAdmin'
                        );
$menus[2]['title']= 'Dịch Vụ';
$menus[2]['sub'][0]= array( 'title'=>'Danh sách báo giá Dịch Vụ',
                            'url'=>'/plugins/admin/services-view-admin-listServicesAdmin',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listServicesAdmin'
                        );
*/
addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $settingRecruitments;
global $settingContacts;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeDataCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);
}

// CÀI ĐẶT TRANG TUYỂN DỤNG
$conditions = array('key_word' => 'settingRecruitmentThemeDataCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingRecruitments = array();
if(!empty($data->value)){
    $settingRecruitments = json_decode($data->value, true);
}

// CÀI ĐẶT TRANG LIÊN HỆ
$conditions = array('key_word' => 'settingContactThemeDataCRM');
$data = $modelOptions->find()->where($conditions)->first();

$settingContacts = array();
if(!empty($data->value)){
    $settingContacts = json_decode($data->value, true);
}

?>