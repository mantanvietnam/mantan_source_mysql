<?php
function getProvinceAPI($input)
{
	global $controller;

	$modelProvince = $controller->loadModel('Province');

	return $modelProvince->find()->all()->toList();
}

function getDistrictAPI($input)
{
	global $controller;

	$modelDistrict = $controller->loadModel('District');

	if(empty($_REQUEST['province_id'])) $_REQUEST['province_id'] = 0;

	return $modelDistrict->find()->where(['province_id'=>(int) $_REQUEST['province_id']])->all()->toList();
}

function getWardAPI($input)
{
	global $controller;

	$modelWards = $controller->loadModel('Wards');

	if(empty($_REQUEST['district_id'])) $_REQUEST['district_id'] = 0;

	return $modelWards->find()->where(['district_id'=>(int) $_REQUEST['district_id']])->all()->toList();
}