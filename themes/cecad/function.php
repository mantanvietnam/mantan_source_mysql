<?php
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/cecad-admin-settingHomececad',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomececad'
                        );
    $menus[0]['sub'][1]= array( 'title'=>'Cài đặt trang giới thiệu',
                        'url'=>'/plugins/admin/cecad-admin-settingAboutusTheme',
                        'classIcon'=>'bx bx-cog',
                        'permission'=>'settingAboutusTheme'
                    );
    addMenuAdminMantan($menus);



    global $modelOptions;
    global $modelMenus;
    global $settingThemes;
    global $infoUser;
    global $session;
    
    // CÀI ĐẶT TRANG CHỦ
    $conditions = array('key_word' => 'settingHomececad');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $settingThemes = array();
    if(!empty($data->value)){
        $settingThemes = json_decode($data->value, true);
    }
    $slide_about1 = [];
    if(!empty($setting['idslidenumber1'])){
        $slide_about1 = $modelAlbuminfos->find()->where(['id_album'=>(int) $setting['idslidenumber1']])->all()->toList();
    }
    
    // INFO USER LOGIN
    $infoUser = $session->read('infoUser');


 

?>