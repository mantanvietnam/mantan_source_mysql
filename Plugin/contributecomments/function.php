<?php

$menus = array();
$menus[0]['title'] = 'Đóng góp ý kiến';
$menus[0]['sub'][0] = array('title' => 'Danh sách đóng góp ý kiến',
                            'url'=>'/plugins/admin/contributecomments-views-admin-listcontributecommentsAdmin.php',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'listcontributecommentsAdmin'
);
addMenuAdminMantan($menus);

$categoryMenu[0]['title'] = 'đóng góp';
$categoryMenu[0]['sub'] = array(array ( 'url' => '/contributecomments',
                                        'name' => 'đóng góp'
                                    ),
                            );


addMenusAppearance($categoryMenu);

?>