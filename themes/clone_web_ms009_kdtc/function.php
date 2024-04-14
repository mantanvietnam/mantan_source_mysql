<?php
    /*
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/ms009-admin-settingHomeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );
    
    addMenuAdminMantan($menus);
    */

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
            $metaTitleMantan = $data_value['title_web'];
        }

        if(!empty($data_value['des_web'])){
            $metaDescriptionMantan = $data_value['des_web'];
        }

        if(!empty($data_value['image_web'])){
            $metaImageMantan = $data_value['image_web'];
        }

        return $data_value;
    }
?>