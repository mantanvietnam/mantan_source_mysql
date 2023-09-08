<?php
function getClassInYearAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

	$dataSend = $_REQUEST;

	$modelClasses = $controller->loadModel('Classes');

	if(!empty($dataSend['id_year'])){
		$conditions = ['id_year'=>(int) $dataSend['id_year'], 'status'=>'active'];

		$listData = $modelClasses->find()->where($conditions)->all()->toList();

		return ['code'=>0, 'listData'=>$listData];
	}else{
    	return ['code'=>1, 'mess'=>'Chưa gửi dữ liệu'];
    }
}