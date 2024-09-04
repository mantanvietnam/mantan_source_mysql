<?php

$menus = array();
$menus[0]['title'] = 'Cố lên nao';

$menus[0]['sub'][0] = array(
    'title' => 'Danh sách thành viên',
    'url' => '/plugins/admin/excgo-view-admin-user-listUserAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUserAdmin',
);



addMenuAdminMantan($menus);


?>