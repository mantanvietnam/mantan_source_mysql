<?php
function getInfoActivities($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $modelAlbuminfos;

	$dataSend = $_REQUEST;
	$listData = ['code'=>1, 'listData'=>[]];

	if(!empty($dataSend['id_album'])){
		$listData['code'] = 0;
		$listData['listData'] = $modelAlbuminfos->find()->where(['id_album'=>(int) $dataSend['id_album']])->order(['id'=>'desc'])->all()->toList();
	}

	return $listData;
}