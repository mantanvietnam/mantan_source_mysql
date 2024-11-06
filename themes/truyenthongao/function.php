<?php 
    $menus= array();
    $menus[0]['title']= 'Cài đặt giao diện';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/truyenthongao-admin-settinghometruyenthongao',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settinghometruyenthongao'
                        );
    addMenuAdminMantan($menus);

    global $modelOptions;
    global $modelMenus;
    global $settingThemes;
    global $infoUser;
    global $session;
    
    // CÀI ĐẶT TRANG CHỦ
    $conditions = array('key_word' => 'settinghometruyenthongao');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $settingThemes = array();
    if(!empty($data->value)){
        $settingThemes = json_decode($data->value, true);
    }

    
    // INFO USER LOGIN
    $infoUser = $session->read('infoUser');

?>