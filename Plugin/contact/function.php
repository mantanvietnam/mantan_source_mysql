<?php

$menus = array();
$menus[0]['title'] = 'Liên hệ';
$menus[0]['sub'][0] = array('title' => 'Danh sách liên hệ',
                            'url'=>'/plugins/admin/contact-views-admin-listContactAdmin.php',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'listContactAdmin'
);
addMenuAdminMantan($menus);

$categoryMenu[0]['title'] = 'Liên hệ';
$categoryMenu[0]['sub'] = array(array ( 'url' => '/contact',
                                        'name' => 'Liên hệ'
                                    ),
                            );


addMenusAppearance($categoryMenu);
?>