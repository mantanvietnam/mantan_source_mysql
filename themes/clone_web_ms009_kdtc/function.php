<?php
    
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/clone_web_ms009_kdtc-setting_theme_clone_web',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );
    
    addMenuAdminMantan($menus);
    

    function setting()
    {
        global $controller;
        global $modelOptions;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;
        global $metaImageMantan;

        $conditions = array('key_word' => 'settingCloneWebMS009KDTCTheme');
        $data = $modelOptions->find()->where($conditions)->first();

        $data_value = array();
        if(!empty($data->value)){
            $data_value = json_decode($data->value, true);
        }

        if(!empty($data_value['title_web'])){
            $metaTitleMantan = show_text_clone($data_value['title_web']);
        }

        if(!empty($data_value['des_web'])){
            $metaDescriptionMantan = show_text_clone($data_value['des_web']);
        }

        if(!empty($data_value['image_web'])){
            $metaImageMantan = show_text_clone($data_value['image_web']);
        }

        return $data_value;
    }

    if(!function_exists('show_text_clone')){
        function show_text_clone($text){
            return $text;
        }
    }
?>