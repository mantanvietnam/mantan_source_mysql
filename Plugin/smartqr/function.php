<?php 
$menus= array();
$menus[0]['title']= 'Smart QR';
$menus[0]['sub'][0]= array(	'title'=>'Mã QR',
							'url'=>'/plugins/admin/smartqr-view-admin-smartqr-listQR.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listQR'
						);
$menus[0]['sub'][1]= array(	'title'=>'Khách hàng',
							'url'=>'/plugins/admin/smartqr-view-admin-member-listMember.php',
							'classIcon'=>'bx bxs-user-detail',
							'permission'=>'listMember'
						);




addMenuAdminMantan($menus);