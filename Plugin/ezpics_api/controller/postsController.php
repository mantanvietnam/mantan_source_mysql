<?php 
function getNewPostAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelPosts;

	$dataSend = $input['request']->getData();

	$conditions = array('type'=>'blog');
	$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	$order = array('id'=>'desc');

	$listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	return 	array('listData'=>$listData);
}

function getInfoPostAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelPosts;

	$dataSend = $input['request']->getData();
	$data = $modelPosts->newEmptyEntity();

	if(!empty($dataSend['id'])){
		$data = $modelPosts->get((int) $dataSend['id']);

		if(!empty($data)){
			$data->view ++;
			$modelPosts->save($data);
		}
	}

	return 	array('data'=>$data);
}
?>