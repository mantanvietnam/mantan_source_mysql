<?php 
$menus= array();
$menus[0]['title']= 'Camera AI';
/*$menus[0]['sub'][0]= array(	'title'=>'Sản phẩm',
							'url'=>'/plugins/admin/product-view-admin-product-listProduct',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);*/

$menus[0]['sub'][0]= array(	'title'=>'Quản lý xã phường',
							'url'=>'/plugins/admin/camera_ai-view-admin-precinct-listAdminPrecinct',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listAdminPrecinct'
						);
$menus[0]['sub'][1]= array(	'title'=>'Location camera',
						'url'=>'/plugins/admin/camera_ai-view-admin-cameralocation-listAdmincameralocation',
						'classIcon'=>'bx bxs-data',
						'permission'=>'listAdmincameralocation'
					);
addMenuAdminMantan($menus);


?> 