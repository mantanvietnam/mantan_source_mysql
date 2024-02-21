<?php
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/bioza-admin-settingHomeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );
    
    addMenuAdminMantan($menus);

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