<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/snaggolf-admin-settingHomeThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeSnagGolf'
                        );
$menus[0]['sub'][1]= array( 'title'=>'Cài đặt HLV',
                            'url'=>'/plugins/admin/snaggolf-admin-settingtrainer.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingtrainer'
                            );
$menus[0]['sub'][2]= array( 'title'=>'Cài đặt trang về chúng tôi',
                            'url'=>'/plugins/admin/snaggolf-admin-settingabout.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingabout'
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


$conditions = array('key_word' => 'settingtrainer');
$data = $modelOptions->find()->where($conditions)->first();
$settingTrainer = array();
if(!empty($data->value)){
    $settingTrainer = json_decode($data->value, true);
}



$conditions = array('key_word' => 'settingabout');
$data = $modelOptions->find()->where($conditions)->first();
$settingabout = array();
if(!empty($data->value)){
    $settingabout = json_decode($data->value, true);
}

?>