<?php 
$menus= array();
$menus[0]['title']= 'Phòng truyền thống ảo';
$menus[0]['sub'][0]= array(	'title'=>'Lớp học',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-class-listClassAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listClassAdmin'
						);

$menus[0]['sub'][1]= array(	'title'=>'Niên khóa',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-year-listSchoolYearAdmin.php',
							'classIcon'=>'bx bx-timer',
							'permission'=>'listSchoolYearAdmin'
						);

$menus[0]['sub'][2]= array(	'title'=>'Thông tin trường',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-school-infoSchoolAdmin.php',
							'classIcon'=>'bx bxs-school',
							'permission'=>'infoSchoolAdmin'
						);

$menus[0]['sub'][3]= array(	'title'=>'Giáo viên',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-teacher-listTeacherAdmin.php',
							'classIcon'=>'bx bx-user-voice',
							'permission'=>'listTeacherAdmin'
						);

$menus[0]['sub'][4]= array(	'title'=>'Quyên góp',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-domate-listDonateAdmin.php',
							'classIcon'=>'bx bx-dollar',
							'permission'=>'listDonateAdmin'
						);

addMenuAdminMantan($menus);