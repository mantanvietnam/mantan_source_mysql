<?php 
$menus= array();
$menus[0]['title']= 'Keys';
$menus[0]['sub'][]= array(	'title'=>'Danh sách key',
							'url'=>'/plugins/admin/keys-view-admin-key-listKey',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listKey'
						);


$menus[0]['sub'][]= array('title'=>'Loại key',
							'url'=>'/plugins/admin/keys-view-admin-category-listCategoryKey',
							'classIcon'=>'bx bx-category',
							'permission'=>'listCategoryKey',
						);
$menus[0]['sub'][]= array('title'=>'Cài đặt id',
							'url'=>'/plugins/admin/keys-view-admin-key-setingKey',
							'classIcon'=>'bx bx-category',
							'permission'=>'setingKey',
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
		$timeNow = time();
		
		$conditions = ['id_category'=>$id_application, 'deadline >'=>$timeNow, 'status'=>'active'];

		if($app->description > 0){
			$conditions['used <'] = (int) $app->description;
		}

		$key = $modelKeys->find()->where($conditions)->order('RAND()')->limit(1)->first();
		
		// tìm thêm tháng khác
		if(empty($key)){
			$conditions = ['id_category'=>$id_application, 'deadline <='=>$timeNow, 'status'=>'active'];

			$key = $modelKeys->find()->where($conditions)->order('RAND()')->limit(1)->first();
		}

		if(!empty($key)){
			// cập nhập số lần sử dụng trong tháng
			if($key->deadline > $timeNow){
				$key->used ++;
			}else{
				$key->used = 1;

				if($app->keyword == 'first_month'){
                    $key->deadline = getLastDayOfMonthTimestamp();
                }else{
                	do{
                    	$key->deadline += 30*24*60*60; // cộng thêm 30 ngày
                    }while($key->deadline<$timeNow);
                }

				$key->month = $month;
			}
			
			$modelKeys->save($key);

			return $key->value;
		}else{
			return '';
		}
		
	}

	return '';
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

function getLastDayOfMonthTimestamp() {
    // Lấy ngày hiện tại
    $currentDate = getdate();
    
    // Lấy số ngày trong tháng của tháng hiện tại
    $lastDayOfMonth = date('t', mktime(0, 0, 0, $currentDate['mon'], 1, $currentDate['year']));
    
    // Tạo timestamp cho 23:59 của ngày cuối cùng trong tháng hiện tại
    $lastDayTimestamp = mktime(23, 59, 59, $currentDate['mon'], $lastDayOfMonth, $currentDate['year']);
    
    return $lastDayTimestamp;
}

function getByIdCategoryKey(){
    global $modelOptions;
    global $controller;
    $data_value = array();
    $conditions = array('key_word' => 'setingKey');
    $data = $modelOptions->find()->where($conditions)->first();        
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }   
    return $data_value;
}