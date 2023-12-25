<?php 
$menus= array();
$menus[0]['title']= 'Phòng truyền thống ảo';
$menus[0]['sub'][0]= array(	'title'=>'Lớp học',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-class-listClassAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listClassAdmin'
						);


$menus[0]['sub'][1]= array(	'title'=>'Thông tin trường',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-school-infoSchoolAdmin',
							'classIcon'=>'bx bxs-school',
							'permission'=>'infoSchoolAdmin'
						);

$menus[0]['sub'][2]= array(	'title'=>'Giáo viên',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-teacher-listTeacherAdmin',
							'classIcon'=>'bx bx-user-voice',
							'permission'=>'listTeacherAdmin'
						);

$menus[0]['sub'][3]= array(	'title'=>'Quyên góp',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-domate-listDonateAdmin',
							'classIcon'=>'bx bx-dollar',
							'permission'=>'listDonateAdmin'
						);

$menus[0]['sub'][4]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingsPhongtruyenthong',
							'sub'=> array(  array('title'=>'Niên khóa',
												'url'=>'/plugins/admin/phongtruyenthong-view-admin-year-listSchoolYearAdmin',
												'classIcon'=>'bx bx-timer',
												'permission'=>'listSchoolYearAdmin'
											),

					                        array('title'=>'Chức danh',
					                          	'url'=>'/plugins/admin/phongtruyenthong-view-admin-teacher-listPositionAdmin',
					                          	'classIcon'=>'bx bx-category',
					                          	'permission'=>'listPositionAdmin',
					                        ),
									)
						);

addMenuAdminMantan($menus);