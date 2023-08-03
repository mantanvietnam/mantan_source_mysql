<?php 
require_once __DIR__.'/lib/Guzzle/vendor/autoload.php';
require_once __DIR__ . '/lib/google/vendor/autoload.php';

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

$menus[0]['sub'][4]= array(	'title'=>'Cài đặt giá',
							'url'=>'/plugins/admin/zoomcheap-view-admin-price-listPriceAdmin.php',
							'classIcon'=>'bx bxl-zoom',
							'permission'=>'listPriceAdmin'
						);

addMenuAdminMantan($menus);

global $urlHomes;
global $google_clientId;
global $google_clientSecret;
global $google_redirectURL;

$google_clientId= '637094275991-2f53f5g9ls2d34r05ugshhugb57ng4rm.apps.googleusercontent.com';
$google_clientSecret= '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';

$google_redirectURL= $urlHomes . 'ggCallback';