<?php 
function listCombo($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Sản phẩm nhà cung cấp';

		$modelCombos = $controller->loadModel('Combos');
		$modelComboProducts = $controller->loadModel('ComboProducts');
		
		$user = $session->read('infoUser');

		$conditions = array('status'=>1);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
			
			/*
			$conditions['OR'] = [
									['name LIKE'=>'%'.$_GET['name'].'%'],
									['keyword LIKE'=>'%'.$_GET['name'].'%']
								];
			*/
		}

		$listData = $modelCombos->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$totalData = $modelCombos->find()->where($conditions)->all()->toList();

	    
	    $totalData = count($totalData);

	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function viewCombo($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $modelCombos = $controller->loadModel('Combos');

		if(!empty($input['request']->getAttribute('params')['pass'][1])){
			$slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);

			$infoCombo = $modelCombos->find()->where(['slug'=>$slug])->first();

			if(!empty($infoCombo)){
				$metaTitleMantan = $infoCombo->name;

				setVariable('infoCombo', $infoCombo);
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