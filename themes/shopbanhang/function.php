<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/shopbanhang-admin-settingHomeTheme.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );

addMenuAdminMantan($menus);




?>