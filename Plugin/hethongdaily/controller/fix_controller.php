<?php
function fixBug()
{
	global $modelCategoryConnects;
	global $controller ;

	$modelCustomers = $controller->loadModel('Customers');

	$all = $modelCustomers->find()->where()->all()->toList();

	foreach ($all as $key => $value) {
		if(!empty($value->id_group)){
			$categoryConnects = $modelCategoryConnects->newEmptyEntity();

	        $categoryConnects->keyword = 'group_customers';
	        $categoryConnects->id_parent = $value->id;
	        $categoryConnects->id_category = (int) $value->id_group;

	        $modelCategoryConnects->save($categoryConnects);
	    }
	}
}
?>