<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/thanhgia-admin-settingHomeThemeThanhgia.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeThanhgia'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeThemeThanhgia');
$data = $modelOptions->find()->where($conditions)->first();

$settingThemes = array();
if(!empty($data->value)){
    $settingThemes = json_decode($data->value, true);

    if(!empty($settingThemes['idMenu2_footer'])){
        $settingThemes['menu2_footer'] = $modelMenus->find()->where(['id_menu' => (int) $settingThemes['idMenu2_footer'], 'id_parent'=>0])->order(['weighty'=>'ASC'])->all()->toList();
    }
}

?>