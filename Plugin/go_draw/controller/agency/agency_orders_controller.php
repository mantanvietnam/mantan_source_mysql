<?php
function addToCart($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thêm vào giỏ hàng';

	    $modelCombos = $controller->loadModel('Combos');
	    $modelComboProducts = $controller->loadModel('ComboProducts');
	    $modelProducts = $controller->loadModel('Products');

	    if(!empty($_GET['idCombo'])){
	    	$infoCombo = $modelCombos->find()->where(['id'=>(int) $_GET['idCombo']])->first();

	    	if(!empty($infoCombo)){
	    		$list_products = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();

				$list_product = [];

				foreach ($list_products as $key => $value) {
					$infoProduct = $modelProducts->find()->where(['id'=>$value->product_id, 'status'=>1])->first();

					if(!empty($infoProduct)){
						$infoProduct->amount_combo = $value->amount;
						$list_product[] = $infoProduct;
					}
				}

				$infoCombo->list_product = $list_product;

				$infoCart = $session->read('infoCart');
				if(empty($infoCart)) $infoCart = [];

				if(empty($infoCart[$infoCombo->id])){
					$infoCombo->amount = 1;
					$infoCart[$infoCombo->id] = $infoCombo;
				}else{
					$infoCart[$infoCombo->id]->amount ++;
				}

				$session->write('infoCart', $infoCart);

				return $controller->redirect('/cart');
	    	}else{
		    	return $controller->redirect('/listCombo');
		    }
	    }else{
	    	return $controller->redirect('/listCombo');
	    }

	}else{
		return $controller->redirect('/login');
	}
}

function cart($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Giỏ hàng';

	    $infoCart = $session->read('infoCart');

	    setVariable('infoCart', $infoCart);
	}else{
		return $controller->redirect('/login');
	}
}
?>