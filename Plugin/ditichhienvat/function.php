<?php 
$menus= array();
$menus[0]['title']= "Di tích và hiện vật";
$menus[0]['sub'][0]= array(	'title'=>'Phường / Xã',
							'url'=>'/plugins/admin/ditichhienvat-admin-ward-listWardAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);
$menus[0]['sub'][1]= array(	'title'=>'Điểm đến di tích và danh lam',
							'url'=>'/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);
$menus[0]['sub'][2]= array(	'title'=>'Hiện vật',
							'url'=>'/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);


addMenuAdminMantan($menus);

