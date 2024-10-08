<?php 


$menus= array();
$menus[0]['title']= "Mạng xã hội";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'',
                            'url'=>'',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listCustomerAdmin'
                        );



addMenuAdminMantan($menus);




?>