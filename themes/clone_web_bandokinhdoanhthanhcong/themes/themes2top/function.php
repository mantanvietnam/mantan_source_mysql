<?php
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/themes2top-admin-settingHomeThemew2top',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemew2top'
                        );
    $menus[0]['sub'][1]= array( 'title'=>'Cài đặt Dịch Vụ',
                            'url'=>'/plugins/admin/themes2top-admin-settingPostThemew2top',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingPostThemew2top'
                        );
    addMenuAdminMantan($menus);



    global $modelOptions;
    global $modelMenus;
    global $settingThemes;
    global $infoUser;
    global $session;
    
    // CÀI ĐẶT TRANG CHỦ
    $conditions = array('key_word' => 'settingHomeThemew2top');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $settingThemes = array();
    if(!empty($data->value)){
        $settingThemes = json_decode($data->value, true);
    
       
    }
    
    // INFO USER LOGIN
    $infoUser = $session->read('infoUser');


 

?>