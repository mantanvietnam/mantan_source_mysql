<?php 
$menus= array();
$menus[0]['title']= 'Đào tạo';
$menus[0]['sub'][0]= array(	'title'=>'Bài học',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-lesson-listLessonCRM.php',
							'classIcon'=>'bx bxs-graduation',
							'permission'=>'listLessonCRM'
						);

/*
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
*/

addMenuAdminMantan($menus);

/*
global $session;
global $infoUser;

$infoUser = $session->read('infoUser');
*/
