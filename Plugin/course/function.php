<?php 
$menus= array();
$menus[0]['title']= 'Danh sách khóa học';
$menus[0]['sub'][0]= array(	'title'=>'Danh sách khóa học',
							'url'=>'/plugins/admin/course-view-admin-listcourse',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listcourse.php'
						);
addMenuAdminMantan($menus);