<?php 
$menus= array();
$menus[0]['title']= 'VinGG';
$menus[0]['sub'][0]= array(	'title'=>'Mô tả chung',
							'url'=>'/plugins/admin/vingg_apis-view-admin-setting-generalDescription',
							'classIcon'=>'bx bx-cog',
							'permission'=>'generalDescription'
						);

$menus[0]['sub'][1]= array(	'title'=>'Địa điểm 360',
							'url'=>'/plugins/admin/vingg_apis-view-admin-location-listLocation',
							'classIcon'=>'bx bx-timer',
							'permission'=>'listLocation'
						);

addMenuAdminMantan($menus);