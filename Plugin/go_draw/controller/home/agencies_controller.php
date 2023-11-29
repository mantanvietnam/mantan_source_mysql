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

	if(!empty($_GET['ward_id'])){
		$conditions['ward_id'] = (int) $_GET['ward_id'];
	}
	

	$listAgency = $modelAgencies->find()->where($conditions)->all()->toList();

	$listCity = [];
    if(function_exists('getProvince')){
        $listCity = getProvince();
    }

	setVariable('listAgency', $listAgency);
	setVariable('listCity', $listCity);
}

function store($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$metaTitleMantan = 'Sản phẩm có sẵn tại cửa hàng';

	$modelAgencies = $controller->loadModel('Agencies');
	$modelAgencyAccounts = $controller->loadModel('AgencyAccounts');
	$modelCombos = $controller->loadModel('Combos');
	$modelComboProducts = $controller->loadModel('ComboProducts');
	$modelAgencyProducts = $controller->loadModel('AgencyProducts');

	if($_GET['id']){
		$agency = $modelAgencyAccounts->find()->where(['agency_id'=>(int) $_GET['id'], 'type'=>1])->first();

		if(!empty($agency)){
			$conditions = array('status'=>1);

			$listCombo = $modelCombos->find()->where($conditions)->all()->toList();
			$list_combo = [];

			$list_product_agency = $modelAgencyProducts->find()->where(['agency_id'=>$agency->id])->all()->toList();

				
			$product_agency = [];

			if(!empty($list_product_agency)){
				foreach ($list_product_agency as $item) {
					$product_agency[$item->product_id] = $item->amount;
				}
			}
			
			// nếu kho đại lý có sản phẩm
			if(!empty($product_agency)){
				if(!empty($listCombo)){
					foreach ($listCombo as $infoCombo) {
						$list_product_combo = $modelComboProducts->find()->where(['combo_id'=>$infoCombo->id])->all()->toList();
						
						$check = true;
						if(!empty($list_product_combo)){
							foreach ($list_product_combo as $item) {
								if(empty($product_agency[$item->product_id]) || $product_agency[$item->product_id]<$item->amount){
									$check = false;
								}
							}
						}
						
						if($check){
							$list_combo[] = $infoCombo;
						}
					}
				}
			}

			setVariable('list_combo', $list_combo);
		}else{
			return $controller->redirect('/home/?status=emptyStore');
		}
	}else{
		return $controller->redirect('/home');
	}
}
?>