<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/snaggolf-admin-settingHomeThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeSnagGolf'
                        );

// Cài đặt khoá học (người lớn, trẻ em, giải đấu)
$menus[1]['title']= 'Cài đặt khoá học';
$menus[1]['sub'][0]= array( 'title'=>'Khoá học cho người lớn',
                            'url'=>'/plugins/admin/snaggolf-admin-settingAdultCourseThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingAdultCourseThemeSnagGolf'
                        );
$menus[1]['sub'][1]= array( 'title'=>'Khoá học cho trẻ em',
                            'url'=>'/plugins/admin/snaggolf-admin-settingKidCourseThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingKidCourseThemeSnagGolf'
                        );
$menus[1]['sub'][2]= array( 'title'=>'Khoá học cho giải đấu',
                            'url'=>'/plugins/admin/snaggolf-admin-settingTourCourseThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingTourCourseThemeSnagGolf'
                        );

// Cài đặt khoá học HLV
$menus[2]['title']= 'Cài đặt khoá học HLV';
$menus[2]['sub'][0]= array( 'title'=>'Khoá học cho HLV',
                            'url'=>'/plugins/admin/snaggolf-admin-settingTrainerCourseThemeSnagGolf.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingTrainerCourseThemeSnagGolf'
                        );
// Danh sách đăng ký khoá học
$menus[3]['title']= 'Đăng ký khoá học';
$menus[3]['sub'][0]= array( 'title'=>'Danh sách đăng ký',
                            'url'=>'/plugins/admin/register-view-admin-listRegisterAdmin',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listRegisterAdmin'
                        );
// Danh sách dụng cụ
$menus[4]['title']= 'Dụng Cụ';
$menus[4]['sub'][0]= array( 'title'=>'Danh sách dụng cụ',
                            'url'=>'/plugins/admin/product-view-admin-product-listProduct',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listProduct'
                        );
// Form đăng ký
$menus[5]['title']= 'Form Đăng Ký';
$menus[5]['sub'][0]= array( 'title'=>'Danh sách đăng ký',
                            'url'=>'/plugins/admin/form-view-admin-listFormAdmin',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listFormAdmin'
                        );
// Form đăng ký HLV
$menus[6]['title']= 'Form Đăng Ký HLV';
$menus[6]['sub'][0]= array( 'title'=>'Danh sách đăng ký HLV',
                            'url'=>'/plugins/admin/trainers-view-admin-listTrainerAdmin',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listTrainerAdmin'
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

// CÀI ĐẶT KHOÁ HỌC CHO NGƯỜI LỚN
$conditions = array('key_word' => 'settingAdultCourseThemeSnagGolf');
$data = $modelOptions->find()->where($conditions)->first();

$settingAdultCourse = array();
if(!empty($data->value)){
    $settingAdultCourse = json_decode($data->value, true);
}

// CÀI ĐẶT KHOÁ HỌC CHO TRẺ EM
$conditions = array('key_word' => 'settingKidCourseThemeSnagGolf');
$data = $modelOptions->find()->where($conditions)->first();

$settingKidCourse = array();
if(!empty($data->value)){
    $settingKidCourse = json_decode($data->value, true);
}

// CÀI ĐẶT KHOÁ HỌC CHO GIẢI ĐẤU
$conditions = array('key_word' => 'settingTourCourseThemeSnagGolf');
$data = $modelOptions->find()->where($conditions)->first();

$settingTourCourse = array();
if(!empty($data->value)){
    $settingTourCourse = json_decode($data->value, true);
}

// CÀI ĐẶT KHOÁ HỌC CHO HLV
$conditions = array('key_word' => 'settingTrainerCourseThemeSnagGolf');
$data = $modelOptions->find()->where($conditions)->first();

$settingTrainer = array();
if(!empty($data->value)){
    $settingTrainer = json_decode($data->value, true);
}

?>