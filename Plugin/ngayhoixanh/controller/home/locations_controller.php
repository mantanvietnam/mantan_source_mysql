<?php
function detail($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

	if(!empty($_GET['id_city'])){
		$listCity = getVietnamProvinces();

		if(!empty($listCity[$_GET['id_city']])){
			$metaTitleMantan = $listCity[$_GET['id_city']];

			$modelTrees = $controller->loadModel('Trees');
	        $modelImageTrees = $controller->loadModel('ImageTrees');
	        $modelLocations = $controller->loadModel('Locations');

	        $conditions['id_city'] = (int) $_GET['id_city'];
	        $order = array('id'=>'asc');

	        $listData = $modelLocations->find()->where($conditions)->order($order)->all()->toList();

	        if(!empty($listData)){
		        foreach ($listData as $key => $value) {
		            $listData[$key]->listTree = $modelTrees->find()->where(['id_location'=>$value->id])->all()->toList();

		            if(!empty($listData[$key]->listTree)){
		            	foreach ($listData[$key]->listTree as $keyTree => $valueTree) {
		            		$listData[$key]->listTree[$keyTree]->listImageTree = $modelImageTrees->find()->where(['id_tree'=>$valueTree->id])->all()->toList();
		            	}
		            }
		        }
		    }

		    setVariable('listData', $listData);
		    setVariable('nameCity', $listCity[$_GET['id_city']]);
		}else{
			return $controller->redirect('/');
		}
	}else{
		return $controller->redirect('/');
	}
}