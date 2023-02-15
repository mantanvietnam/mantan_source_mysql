<?php 
$menus= array();
$menus[0]['title']= 'Thi đua';
$menus[0]['sub'][0]= array(	'title'=>'Chiến dịch',
							'url'=>'/plugins/admin/2top_crm_compete-view-admin-campain-listCompeteCRM.php',
							'classIcon'=>'bx bx-calendar-event',
							'permission'=>'listCompeteCRM'
						);

$menus[0]['sub'][1]= array(	'title'=>'Mục tiêu',
							'url'=>'/plugins/admin/2top_crm_compete-view-admin-target-listTargetCRM.php',
							'classIcon'=>'bx bx-target-lock',
							'permission'=>'listTargetCRM'
						);

$menus[0]['sub'][2]= array(	'title'=>'Báo cáo thi đua',
							'url'=>'/plugins/admin/2top_crm_compete-view-admin-report-listReportCRM.php',
							'classIcon'=>'bx bx-list-ol',
							'permission'=>'listReportCRM'
						);


addMenuAdminMantan($menus);