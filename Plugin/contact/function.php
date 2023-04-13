<?php

$menus = array();
$menus[0]['title'] = 'Liên hệ';
$menus[0]['sub'][0] = array('title' => 'Danh sách thông tin liên hệ',
    'url'=>'/plugins/admin/contact-views-admin-index.php',
    'classIcon' => 'menu-icon tf-icons bx bxs-data',
);
addMenuAdminMantan($menus);
