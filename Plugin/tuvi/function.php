<?php
global $keyFirebase;

$keyFirebase = 'AAAAmV3l9xI:APA91bH_cEaRYEz8d-_JbIDDk32k1aqlt8PgB7ctT8Qx-0ErMU70ja_aT9QTsT5rUG2xdPOxxIhFLGxRpUAIr1LaBxCiRF2KH5aMD0T5NN4kARg1KKwGsPIAl2g3PYF8XYa0FAB0CZYi';

$menus= array();
$menus[0]['title']= 'Cộng Tác Viên';
$menus[0]['sub'][]= array('title'=>'Danh sách Cộng Tác Viên',

							'url'=>'/plugins/admin/tuvi-view-admin-collaborator-listCollaboratorsAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCollaboratorsAdmin',
							
						);
						$menus[0]['sub'][1]= array('title'=>'Danh Sách Khách Hàng',
							'url'=>'/plugins/admin/tuvi-view-admin-customers-listCustomersAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCustomersAdmin',
						);
addMenuAdminMantan($menus);

?>