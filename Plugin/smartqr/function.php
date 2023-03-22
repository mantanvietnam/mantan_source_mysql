<?php 
$menus= array();
$menus[0]['title']= 'Smart QR';
$menus[0]['sub'][0]= array(	'title'=>'Mã QR',
							'url'=>'/plugins/admin/smartqr-view-admin-smartqr-listQR.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listQR'
						);





addMenuAdminMantan($menus);
