<?php
global $keyFirebase;

$keyFirebase = 'AAAAmV3l9xI:APA91bH_cEaRYEz8d-_JbIDDk32k1aqlt8PgB7ctT8Qx-0ErMU70ja_aT9QTsT5rUG2xdPOxxIhFLGxRpUAIr1LaBxCiRF2KH5aMD0T5NN4kARg1KKwGsPIAl2g3PYF8XYa0FAB0CZYi';

$menus= array();
$menus[0]['title']= 'Cộng Tác Viên';
$menus[0]['sub'][]= array(	'title'=>'Danh sách Cộng Tác Viên',
							'url'=>'/plugins/admin/tuvi-view-admin-collaborator-listCollaboratorAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCollaboratorAdmin',
							
						);
$menus[0]['sub'][]= array(	'title'=>'Cài đặt hoa hồng',
							'url'=>'/plugins/admin/tuvi-view-admin-collaborator-settingAffiliateAdmin',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingAffiliateAdmin'
						);

$menus[1]['title']= 'Khách hàng';
$menus[1]['sub'][]= array(	'title'=>'Danh Sách Khách Hàng',
							'url'=>'/plugins/admin/tuvi-view-admin-customers-listCustomersAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCustomersAdmin',
							
							);

$menus[3]['title']= 'Tử Vi';
$menus[3]['sub'][]= array(	'title'=>'Danh Sách Tử Vi',
							'url'=>'/plugins/admin/tuvi-view-admin-horoscope-listHoroscopeAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listHoroscopeAdmin',
							
							);
addMenuAdminMantan($menus);

?>