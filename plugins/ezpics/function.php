<?php 
$menus= array();
$menus[0]['title']= 'Ezpics';
$menus[0]['sub'][0]= array('title'=>'Người dùng','url'=>'/plugins/admin/ezpics-view-admin-user-listUserEzpics.php','classIcon'=>'bx bxs-user-detail','permission'=>'listUserEzpics');

$menus[0]['sub'][10]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingsEzpics',
							'sub'=> array(array('title'=>'Chủ đề',
												'url'=>'/plugins/admin/ezpics-view-admin-category-listCategoryEzpics.php',
												'classIcon'=>'bx bx-category',
												'permission'=>'listCategoryEzpics',
											)

									)
						);

addMenuAdminMantan($menus);

global $session;
global $infoUser;

$infoUser = $session->read('infoUser');