<?php 

$menus= array();
$menus[0]['title']= 'Projects';

$menus[0]['sub'][0]= array('title'=>'Thông tin Projects',
                            'url'=>'/plugins/admin/project-view-admin-project-listProjectAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listProjectAdmin',
                        );
$menus[0]['sub'][1]= array('title'=>'Thông tin Library',
                            'url'=>'/plugins/admin/project-view-admin-library-listLibraryAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listLibraryAdmin',
                        );


addMenuAdminMantan($menus);


?>
