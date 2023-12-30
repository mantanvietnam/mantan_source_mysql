<?php
	$menus= array();
    $menus[0]['title']= 'Subscribe';
	/*$menus[0]['sub'][0]= array(	'title'=>'Gửi email thông báo',
								'url'=>'/plugins/admin/subscribe-view-admin-send_subscribe',
								'classIcon'=>'bx bx-mail-send',
								'permission'=>'send_subscribe');*/

	$menus[0]['sub'][1]= array(	'title'=>'Danh sách email',
								'url'=> '/plugins/admin/subscribe-view-admin-list_subscribe',
								'classIcon'=>'bx bx-envelope',
								'permission'=>'list_subscribe');
	
    addMenuAdminMantan($menus);
?>