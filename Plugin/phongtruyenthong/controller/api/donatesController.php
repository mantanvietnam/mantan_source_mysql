<?php
function getListDonateAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

	$dataSend = $_REQUEST;

	$modelClasses = $controller->loadModel('Classes');
	$modelDonates = $controller->loadModel('Donates');

	$listData = $modelDonates->find()->where()->all()->toList();

	if(!empty($listData)){
        $years[0] = $modelCategories->newEmptyEntity();
        $classes[0] = $modelCategories->newEmptyEntity();

    	foreach ($listData as $key => $value) {
    		if(empty($years[$value->id_year])){
    			$years[$value->id_year] = $modelCategories->get( (int) $value->id_year);
    		}

            if(empty($classes[$value->id_class])){
                $classes[$value->id_class] = $modelClasses->get( (int) $value->id_class);
            }
    		
    		$listData[$key]->name_year = (!empty($years[$value->id_year]->name))?$years[$value->id_year]->name:'';
            $listData[$key]->name_class = (!empty($classes[$value->id_class]->name))?$classes[$value->id_class]->name:'';
    	}
    }

	return $listData;

}