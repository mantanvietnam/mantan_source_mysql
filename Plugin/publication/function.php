<?php 
$menus= array();
$menus[0]['title']= 'Danh sách ấn phẩm';
$menus[0]['sub'][0]= array(	'title'=>'Danh sách ấn phẩm',
							'url'=>'/plugins/admin/publication-view-admin-listpublication',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listpublication.php'
						);
addMenuAdminMantan($menus);