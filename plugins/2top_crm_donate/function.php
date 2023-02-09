<?php 
$menus= array();
$menus[0]['title']= 'Từ thiện';
$menus[0]['sub'][0]= array(	'title'=>'Chương trình từ thiện',
							'url'=>'/plugins/admin/2top_crm_donate-view-admin-charity-listCharityCRM.php',
							'classIcon'=>'bx bx-donate-heart',
							'permission'=>'listCharityCRM'
						);
$menus[0]['sub'][1]= array( 'title'=>'Danh sách đóng góp',
                            'url'=>'/plugins/admin/2top_crm_donate-view-admin-donate-listDonateCharityCRM.php',
                            'classIcon'=>'bx bx-money-withdraw',
                            'permission'=>'listDonateCharityCRM'
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