<?php 
$menus= array();
$menus[0]['title']= 'Đánh giá';
$menus[0]['sub'][0]= array(	'title'=>'Đánh giá',
							'url'=>'/plugins/admin/product_feedback-view-admin-feedback-listFeedback.php',
							'classIcon'=>'bx bx-user-voice',
							'permission'=>'listFeedback'
						);

$menus[0]['sub'][1]= array(	'title'=>'Tiêu chí đánh giá',
							'url'=>'/plugins/admin/product_feedback-view-admin-criteria-listCriteriaFeedback.php',
							'classIcon'=>'bx bx-cog',
							'permission'=>'listCriteriaFeedback'
						);

$menus[0]['sub'][2]= array( 'title'=>'Hướng dẫn APIs',
                            'url'=>'/plugins/admin/product_feedback-view-admin-guide-guideFeedbackAPIsCRM.php',
                            'classIcon'=>'bx bx-support',
                            'permission'=>'guideFeedbackAPIsCRM'
                        );

addMenuAdminMantan($menus);