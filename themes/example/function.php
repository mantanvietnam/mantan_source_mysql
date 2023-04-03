<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/example-admin-settingHomeThemeExample.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeExample'
                        );

addMenuAdminMantan($menus);

?>