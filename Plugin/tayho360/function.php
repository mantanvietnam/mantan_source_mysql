<?php 
$menus= array();
$menus[0]['title']= 'Tây Hồ 360';
$menus[0]['sub'][0]= array(	'title'=>'Điểm đến di tích và danh lam',
							'url'=>'/plugins/admin/tayho360-admin-historicalSites-listHistoricalSitesAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listHistoricalSitesAdmin'
						);


$menus[0]['sub'][1]= array('title'=>'Cơ quan hành chính',
							'url'=>'/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listGovernanceAgencysAdmin',
							
						);
$menus[0]['sub'][2]= array('title'=>'Lễ hội',
							'url'=>'/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listFestivalAdmin',
							
						);
$menus[0]['sub'][3]= array('title'=>'Dịch vụ hỗ trợ du lịch',
							'url'=>'/plugins/admin/tayho360-admin-tour-listTourAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
$menus[0]['sub'][4]= array('title'=>'Điểm đến làng nghề',
							'url'=>'/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);


addMenuAdminMantan($menus);
