<?php 
$menus= array();
$menus[0]['title']= 'Đào tạo';

$menus[0]['sub'][]= array(	'title'=>'Khóa học',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-course-listCourseCRM',
							'classIcon'=>'bx bxs-graduation',
							'permission'=>'listCourseCRM'
						);

$menus[0]['sub'][]= array(	'title'=>'Bài học',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-lesson-listLessonCRM',
							'classIcon'=>'bx bx-list-ul',
							'permission'=>'listLessonCRM'
						);

$menus[0]['sub'][]= array(	'title'=>'Bài thi',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-test-listTestCRM',
							'classIcon'=>'bx bx-timer',
							'permission'=>'listTestCRM'
						);

$menus[0]['sub'][]= array(	'title'=>'Câu hỏi',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-question-listQuestionCRM',
							'classIcon'=>'bx bx-question-mark',
							'permission'=>'listQuestionCRM'
						);

$menus[0]['sub'][]= array(	'title'=>'Lịch sử thi',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-history-listHistoryTestCRM',
							'classIcon'=>'bx bx-history',
							'permission'=>'listHistoryTestCRM'
						);

$menus[0]['sub'][]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settings2TopCRMTraining',
							'sub'=> array(array('title'=>'Danh mục đào tạo',
												'url'=>'/plugins/admin/2top_crm_training-view-admin-category-listCategoryLessonCRM',
												'classIcon'=>'bx bx-category',
												'permission'=>'listCategoryLessonCRM',
											),
										array('title'=>'Cài đặt chung',
												'url'=>'/plugins/admin/2top_crm_training-view-admin-setting-settingTrainingCRM',
												'classIcon'=>'bx bx-category',
												'permission'=>'settingTrainingCRM',
											),
									)
						);

$menus[0]['sub'][]= array( 'title'=>'Hướng dẫn APIs',
                            'url'=>'/plugins/admin/2top_crm_training-view-admin-guide-guideTrainingAPIsCRM',
                            'classIcon'=>'bx bx-support',
                            'permission'=>'guideTrainingAPIsCRM'
                        );

addMenuAdminMantan($menus);