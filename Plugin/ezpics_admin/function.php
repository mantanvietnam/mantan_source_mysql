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

$menus[0]['sub'][2]= array('title'=>'Cài đặt',
                            'url'=>'/',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingsEzpics',
                            'sub'=> array(array('title'=>'Danh mục thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-category-listCategoryEzpics.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCategoryEzpics',
                                            ),
                                    )
                        );


addMenuAdminMantan($menus);