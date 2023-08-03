<?php 
include(__DIR__.'/lib/Guzzle/vendor/autoload.php');

$menus= array();
$menus[0]['title']= 'Zoom Cheap';
$menus[0]['sub'][0]= array(	'title'=>'Khách hàng',
							'url'=>'/plugins/admin/zoomcheap-view-admin-manager-listManagerAdmin.php',
							'classIcon'=>'bx bxs-user-detail',
							'permission'=>'listManagerAdmin'
						);

$menus[0]['sub'][1]= array(	'title'=>'Lịch sử nạp tiền',
							'url'=>'/plugins/admin/zoomcheap-view-admin-history-listHistoryAddMoney.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listHistoryAddMoney'
						);

$menus[0]['sub'][2]= array(	'title'=>'Đơn hàng thuê Zoom',
							'url'=>'/plugins/admin/zoomcheap-view-admin-order-listOrderZoomAdmin.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listOrderZoomAdmin'
						);

$menus[0]['sub'][3]= array(	'title'=>'Tài khoản Zoom',
							'url'=>'/plugins/admin/zoomcheap-view-admin-zoom-listAccountZoomAdmin.php',
							'classIcon'=>'bx bxl-zoom',
							'permission'=>'listAccountZoomAdmin'
						);

addMenuAdminMantan($menus);