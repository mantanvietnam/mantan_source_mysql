<?php
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/clone_web_thcn005-setting_theme_clone_web',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'setting_theme_clone_web'
                        );
    
    addMenuAdminMantan($menus);

    function setting()
    {
        global $controller;
        global $modelOptions;
        
        $conditions = array('key_word' => 'settingThemeTHCN005CloneWeb');
        $data = $modelOptions->find()->where($conditions)->first();

        $data_value = array();
        if(!empty($data->value)){
            $data_value = json_decode($data->value, true);
        }
        
        return $data_value;
    }

    
?>