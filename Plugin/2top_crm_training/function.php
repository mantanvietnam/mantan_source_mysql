<?php 
$menus= array();
$menus[0]['title']= 'Đào tạo';
$menus[0]['sub'][0]= array(	'title'=>'Bài học',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-lesson-listLessonCRM.php',
							'classIcon'=>'bx bxs-graduation',
							'permission'=>'listLessonCRM'
						);

$menus[0]['sub'][1]= array(	'title'=>'Bài thi',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-test-listTestCRM.php',
							'classIcon'=>'bx bx-timer',
							'permission'=>'listTestCRM'
						);

$menus[0]['sub'][2]= array(	'title'=>'Câu hỏi',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-question-listQuestionCRM.php',
							'classIcon'=>'bx bx-question-mark',
							'permission'=>'listQuestionCRM'
						);

$menus[0]['sub'][3]= array(	'title'=>'Lịch sử thi',
							'url'=>'/plugins/admin/2top_crm_training-view-admin-history-listHistoryTestCRM.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listHistoryTestCRM'
						);

$menus[0]['sub'][4]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settings2TopCRMTraining',
							'sub'=> array(array('title'=>'Danh mục đào tạo',
												'url'=>'/plugins/admin/2top_crm_training-view-admin-category-listCategoryLessonCRM.php',
												'classIcon'=>'bx bx-category',
												'permission'=>'listCategoryLessonCRM',
											),
										array('title'=>'Cài đặt chung',
												'url'=>'/plugins/admin/2top_crm_training-view-admin-setting-settingTrainingCRM.php',
												'classIcon'=>'bx bx-category',
												'permission'=>'settingTrainingCRM',
											),
									)
						);


addMenuAdminMantan($menus);