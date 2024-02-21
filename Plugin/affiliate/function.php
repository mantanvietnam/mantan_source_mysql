<?php 
$menus= array();
$menus[0]['title']= 'Tiếp thị liên kết';
$menus[0]['sub'][0]= array(	'title'=>'Thành viên tiếp thị',
							'url'=>'/plugins/admin/affiliate-view-admin-affiliater-listAffiliaterAdmin',
							'classIcon'=>'bx bxs-user-voice',
							'permission'=>'listAffiliaterAdmin'
						);

$menus[0]['sub'][1]= array(	'title'=>'Cài đặt hoa hồng',
							'url'=>'/plugins/admin/affiliate-view-admin-config-settingAffiliateAdmin',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingAffiliateAdmin'
						);


addMenuAdminMantan($menus);

if(!empty($_GET['aff'])){
	global $session;

	$_GET['aff'] = trim(str_replace(array(' ','.','-'), '', $_GET['aff']));
    $_GET['aff'] = str_replace('+84','0',$_GET['aff']);

	$session->write('aff_phone', $_GET['aff']);
}

function calculateAffiliate($money=0, $id_order=0)
{
	global $session;
	global $modelOptions;

	$modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');
	$modelAffiliaters = $controller->loadModel('Affiliaters');

	if(!empty($session->read('aff_phone')) && $money>0){
		$checkAff = $modelAffiliaters->find()->where(['phone' => $session->read('aff_phone')])->first();

		if(!empty($checkAff)){
			$conditions = array('key_word' => 'settingAffiliateAdmin');
	    	$settingAffiliateAdmin = $modelOptions->find()->where($conditions)->first();

	    	$setting = array();
		    if(!empty($settingAffiliateAdmin->value)){
		        $setting = json_decode($settingAffiliateAdmin->value, true);
		    }

		    if(!empty($setting['percent1'])){
		    	$money_back = $setting['percent1'] * $money;
		    	
		    	// lưu lịch sử trích hoa hồng
		    	$saveBack = $modelTransactionAffiliateHistories->newEmptyEntity();
		    	
		    	$saveBack->id_affiliater = $checkAff->id;
		    	$saveBack->money_total = $money;
		    	$saveBack->money_back = $money_back;
		    	$saveBack->percent = $setting['percent1'];
		    	$saveBack->id_order = $id_order;
		    	$saveBack->create_at = time();
		    	$saveBack->status = 'new';

		    	$modelTransactionAffiliateHistories->save($saveBack);

		    	$level = 2;
		    	if($checkAff->id_father > 0 && $setting['percent'.$level] > 0){
		    		calculateAffiliateFather($money, $id_order, $level, $checkAff->id_father);
		    	}
		    }
		}
	}
}

function calculateAffiliateFather($money=0, $id_order=0, $level=1, $id_father=0)
{
	global $session;
	global $modelOptions;

	$modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');
	$modelAffiliaters = $controller->loadModel('Affiliaters');

	if($level>1 && $level<=10 && $id_father>0){
		$checkAff = $modelAffiliaters->find()->where(['id' => $id_father])->first();

		if(!empty($checkAff)){
			$conditions = array('key_word' => 'settingAffiliateAdmin');
	    	$settingAffiliateAdmin = $modelOptions->find()->where($conditions)->first();

	    	$setting = array();
		    if(!empty($settingAffiliateAdmin->value)){
		        $setting = json_decode($settingAffiliateAdmin->value, true);
		    }

		    if(!empty($setting['percent'.$level])){
		    	$money_back = $setting['percent'.$level] * $money;
		    	
		    	// lưu lịch sử trích hoa hồng
		    	$saveBack = $modelTransactionAffiliateHistories->newEmptyEntity();
		    	
		    	$saveBack->id_affiliater = $checkAff->id;
		    	$saveBack->money_total = $money;
		    	$saveBack->money_back = $money_back;
		    	$saveBack->percent = $setting['percent'.$level];
		    	$saveBack->id_order = $id_order;
		    	$saveBack->create_at = time();
		    	$saveBack->status = 'new';

		    	$modelTransactionAffiliateHistories->save($saveBack);

		    	$level ++;
		    	if($checkAff->id_father > 0 && $setting['percent'.$level] > 0){
		    		calculateAffiliateFather($money, $id_order, $level, $checkAff->id_father);
		    	}
		    }
		}
	}
}
?> 