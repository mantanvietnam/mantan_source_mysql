<?php 
function searchAgency($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelAgencies = $controller->loadModel('Agencies');

	$listData = $modelAgencies->find()->where(['status'=>1, 'deleted_at IS'=>null])->all()->toList();

	setVariable('listData', $listData);
}
?>