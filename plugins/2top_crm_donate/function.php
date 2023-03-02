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

$menus[0]['sub'][2]= array( 'title'=>'Cài đặt chung',
                            'url'=>'/plugins/admin/2top_crm_donate-view-admin-setting-settingCharityCRM.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingCharityCRM'
                        );

$menus[0]['sub'][3]= array( 'title'=>'Hướng dẫn APIs',
                            'url'=>'/plugins/admin/2top_crm_donate-view-admin-guide-guideCharityAPIsCRM.php',
                            'classIcon'=>'bx bx-support',
                            'permission'=>'guideCharityAPIsCRM'
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

function calculateMoney($idCharity=0)
{
	global $controller;
	
	$modelDonate = $controller->loadModel('Donates');
	$modelCharity = $controller->loadModel('Charities');

	$conditions['id_charity'] = (int) $idCharity;
	$listData = $modelDonate->find()->where($conditions)->all()->toList();

	$money = 0;
	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			$money += $value->coin;
		}
	}

	$charity = $modelCharity->get((int) $idCharity);

	if(!empty($charity)){
		$charity->money_donate = $money;

		$modelCharity->save($charity);
	}
}