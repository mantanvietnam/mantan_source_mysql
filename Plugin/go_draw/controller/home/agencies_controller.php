<?php 
function searchAgency($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelAgencies = $controller->loadModel('Agencies');

	$conditions = ['status'=>1, 'deleted_at IS'=>null];

	if(!empty($_GET['name_agency'])){
		$conditions['name LIKE'] = '%'.$_GET['name_agency'].'%';
	}

	if(!empty($_GET['province_id'])){
		$conditions['province_id'] = (int) $_GET['province_id'];
	}

	if(!empty($_GET['district_id'])){
		$conditions['district_id'] = (int) $_GET['district_id'];
	}

	$listAgency = $modelAgencies->find()->where($conditions)->all()->toList();

	$listCity = [];
    if(function_exists('getProvince')){
        $listCity = getProvince();
    }

	setVariable('listAgency', $listAgency);
	setVariable('listCity', $listCity);
}
?>