<?php 


$menus= array();
$menus[0]['title']= "Quản lý công việc";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'',
                            'url'=>'',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listCustomerAdmin'
                        );



addMenuAdminMantan($menus);

?>