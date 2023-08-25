<?php 

$menus= array();
$menus[0]['title']= 'Dự án';

$menus[0]['sub'][0]= array('title'=>'Thông tin Dự án',
                            'url'=>'/plugins/admin/product_project-view-admin-product_project-listProductProjectAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listProductProjectAdmin',
                        );



addMenuAdminMantan($menus);


?>