<?php
function callbackZalo($input)
{
	global $controller;

	if(!empty($_GET['code']) && !empty($_GET['oa_id'])){
		$modelZaloOas = $controller->loadModel('ZaloOas');

		$zalooa = $modelZaloOas->find()->where(['id_oa'=>$_GET['oa_id']])->first();

		if(!empty($zalooa)){
			$zalooa->oauth_code = $_GET['code'];

			$modelZaloOas->save($zalooa);

			$return = getAccessTokenZaloOA($zalooa->id_oa, $zalooa->id_app);
		}
	}

	return $controller->redirect('/plugins/admin/zalo_zns-view-admin-listZaloOAAdmin');
}