<?php 
$menus= array();
$menus[0]['title']= 'Ezpics';
$menus[0]['sub'][0]= array( 'title'=>'Người dùng',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bx-user',
                            'permission'=>'listMemberAdmin'
                        );

$menus[0]['sub'][1]= array( 'title'=>'Mẫu thiết kế',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php',
                            'classIcon'=>'bx bx-paint',
                            'permission'=>'listProductAdmin'
                        );

addMenuAdminMantan($menus);