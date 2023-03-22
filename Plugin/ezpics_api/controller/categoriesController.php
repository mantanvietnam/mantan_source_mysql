<?php 
function getProductCategoryAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$conditions = array('type'=>'product_categories');

	$order = array('id'=>'desc');

	$listData = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

	return 	array('listData'=>$listData);
}
?>