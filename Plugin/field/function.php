<?php 
$menus= array();
$menus[0]['title']= 'lĩnh vực';
$menus[0]['sub'][0]= array(	'title'=>'lĩnh vực',
							'url'=>'/plugins/admin/field-view-admin-listfield',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listfield.php'
						);
addMenuAdminMantan($menus);