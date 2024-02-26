<?php
	$menus= array();
	$menus[0]['title']= 'Cài đặt giao diện';
	$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/minhtrang-admin-settingHomeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );
	$menus[0]['sub'][1]= array( 'title'=>'Câu chuyện của tôi',
                            'url'=>'/plugins/admin/minhtrang-admin-cauchuyencuatoi',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'cauchuyencuatoi'
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