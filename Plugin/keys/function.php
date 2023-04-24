<?php 
$menus= array();
$menus[0]['title']= 'Keys';
$menus[0]['sub'][0]= array(	'title'=>'Danh sách key',
							'url'=>'/plugins/admin/keys-view-admin-key-listKey.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listKey'
						);


$menus[0]['sub'][1]= array('title'=>'Loại key',
							'url'=>'/plugins/admin/keys-view-admin-category-listCategoryKey.php',
							'classIcon'=>'bx bx-category',
							'permission'=>'listCategoryKey',
						);


addMenuAdminMantan($menus);

function getKey($id_application)
{
	global $modelCategories;
	global $controller;

	$modelKeys = $controller->loadModel('Appkeys');

	$app = $modelCategories->find()->where(['id'=>$id_application])->first();

	if(!empty($app)){
		$month = (int) date('m');

		$conditions = ['id_category'=>$id_application, 'month'=>$month, 'status'=>'active'];

		if($app->description > 0){
			$conditions['used <'] = (int) $app->description;
		}

		$key = $modelKeys->find()->where($conditions)->first();
		
		// tìm thêm tháng khác
		if(empty($key)){
			$conditions = ['id_category'=>$id_application, 'month !='=>$month, 'status'=>'active'];

			$key = $modelKeys->find()->where($conditions)->first();
		}

		if(!empty($key)){
			// cập nhập số lần sử dụng trong tháng
			if($key->month == $month){
				$key->used ++;
			}else{
				$key->used = 1;
				$key->month = $month;
			}
			
			$modelKeys->save($key);

			return $key->value;
		}else{
			return '';
		}
	}else{
		return '';
	}
}

function lockKey($value='')
{
	global $modelCategories;
	global $controller;

	$modelKeys = $controller->loadModel('Appkeys');

	$key = $modelKeys->find()->where(['value'=>$value])->first();

	if(!empty($key)){
		$key->status = 'lock';

		$modelKeys->save($key);
	}
}