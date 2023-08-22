<?php 

$menus= array();
$menus[0]['title']= 'Projects';

$menus[0]['sub'][0]= array('title'=>'Thông tin Projects',
                            'url'=>'/plugins/admin/project-view-admin-listProjectAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listProjectAdmin',
                        );



addMenuAdminMantan($menus);


?>