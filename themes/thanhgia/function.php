<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/thanhgia-admin-settingHomeThemeThanhgia.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeThanhgia'
                        );

addMenuAdminMantan($menus);

?>