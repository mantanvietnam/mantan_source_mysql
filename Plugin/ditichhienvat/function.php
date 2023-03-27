<?php 
$menus= array();
$menus[0]['title']= "Di tích và hiện vật";
$menus[0]['sub'][0]= array(	'title'=>'Điểm đến di tích và danh lam',
							'url'=>'/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);




addMenuAdminMantan($menus);
