<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/snaggolf-admin-settingHomeThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeSnagGolf'
                        );





addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $settingAdultCourse;
global $settingKidCourse;
global $settingTourCourse;
global $settingTrainer;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeSnagGolf');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);
}

// CÀI ĐẶT KHOÁ HỌC CHO HLV
$conditions = array('key_word' => 'settingTrainerCourseThemeSnagGolf');
$data = $modelOptions->find()->where($conditions)->first();

$settingTrainer = array();
if(!empty($data->value)){
    $settingTrainer = json_decode($data->value, true);
}

?>