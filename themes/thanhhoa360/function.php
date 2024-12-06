<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/thanhhoa360-admin-settingHomeTheme.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );

addMenuAdminMantan($menus);

global $modelOptions;

$conditionsSetting = array('key_word' => 'settingHomeTheme');
$settingTraining2TOPCRM = $modelOptions->find()->where($conditionsSetting)->first();
if(empty($settingTraining2TOPCRM)){
    $settingTraining2TOPCRM = $modelOptions->newEmptyEntity();
}

$setting_value = array();
if(!empty($settingTraining2TOPCRM->value)){
    $setting_value = json_decode($settingTraining2TOPCRM->value, true);
}


setVariable('setting_value', $setting_value);

function setting(){
    global $controller;
    global $modelOptions;
     $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

   

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    return $data_value;
}


?>