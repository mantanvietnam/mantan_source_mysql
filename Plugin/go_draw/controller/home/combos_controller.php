<?php
function detailCombo($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	
    $modelCombos = $controller->loadModel('Combos');
    $modelComboProducts = $controller->loadModel('ComboProducts');
    $modelProducts = $controller->loadModel('Products');

	if(!empty($_GET['id'])){
		$infoCombo = $modelCombos->find()->where(['id'=>(int) $_GET['id']])->first();

		if(!empty($infoCombo)){
			$metaTitleMantan = $infoCombo->name;

			$list_products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

			$list_product = [];

			foreach ($list_products as $key => $value) {
				$infoProduct = $modelProducts->find()->where(['id'=>$value->product_id, 'status'=>1])->first();

				if(!empty($infoProduct)){
					$infoProduct->amount_combo = $value->amount;
					$list_product[] = $infoProduct;
				}
			}

			setVariable('infoCombo', $infoCombo);
			setVariable('list_product', $list_product);
		}else{
			return $controller->redirect('/home');
		}
	}else{
		return $controller->redirect('/home');
	}
	
}
?>