<?php
// lấy danh sách tỉnh thành
function getProvince()
{
	global $controller;

	$modelProvince = $controller->loadModel('Province');

	return $modelProvince->find()->all()->toList();
}

// lấy danh sách quận huyện
function getDistrict($province_id = 0)
{
	global $controller;

	$modelDistrict = $controller->loadModel('District');

	return $modelDistrict->find()->where(['province_id'=>(int) $province_id])->all()->toList();
}

// lấy danh sách xã phường
function getWard($district_id = 0)
{
	global $controller;

	$modelWards = $controller->loadModel('Wards');

	return $modelWards->find()->where(['district_id'=>(int) $district_id])->all()->toList();
}
?>