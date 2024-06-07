<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/clone_web_msvh-admin-settinghomebandothanhcong.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settinghomebandothanhcong'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $settingThemes;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settinghomebandothanhcong');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);

   
}
?>