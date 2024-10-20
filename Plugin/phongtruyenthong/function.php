<?php 
$menus= array();
$menus[0]['title']= 'Phòng truyền thống ảo';
$menus[0]['sub'][0]= array(	'title'=>'Lớp học',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-class-listClassAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listClassAdmin'
						);


$menus[0]['sub'][]= array(	'title'=>'Thông tin trường',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-school-infoSchoolAdmin',
							'classIcon'=>'bx bxs-school',
							'permission'=>'infoSchoolAdmin'
						);

$menus[0]['sub'][]= array(	'title'=>'Giáo viên',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-teacher-listTeacherAdmin',
							'classIcon'=>'bx bx-user-voice',
							'permission'=>'listTeacherAdmin'
						);

$menus[0]['sub'][]= array(	'title'=>'Học sinh tiêu biểu',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-student-listStudentAdmin',
							'classIcon'=>'bx bx-user-voice',
							'permission'=>'listStudentAdmin'
						);

$menus[0]['sub'][]= array(	'title'=>'Quyên góp',
							'url'=>'/plugins/admin/phongtruyenthong-view-admin-domate-listDonateAdmin',
							'classIcon'=>'bx bx-dollar',
							'permission'=>'listDonateAdmin'
						);

$menus[0]['sub'][]= array('title'=>'Cài đặt',
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

					                        array('title'=>'Không gian 3D',
					                          	'url'=>'/plugins/admin/phongtruyenthong-view-admin-config-configRoom3DAdmin',
					                          	'classIcon'=>'bx bx-category',
					                          	'permission'=>'configRoom3DAdmin',
					                        ),
									)
						);

addMenuAdminMantan($menus);