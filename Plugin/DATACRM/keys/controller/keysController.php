<?php 
function listKey($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khóa';

	$modelKeys = $controller->loadModel('Appkeys');

    $listData = $modelKeys->find()->all()->toList();
    $app = [];
    $timeNow = time();
    foreach ($listData as $key => $value) {
        if(empty($app[$value->id_category])){
            $app[$value->id_category] = $modelCategories->find()->where(['id'=>(int) $value->id_category])->first();
        }

        if(empty($value->deadline)){
            if($app[$value->id_category]->keyword == 'first_month'){
                $value->deadline = getLastDayOfMonthTimestamp();
            }else{
                do{
                    $value->deadline += 30*24*60*60; // cộng thêm 30 ngày
                }while($value->deadline<$timeNow);
            }

            $modelKeys->save($value);
        }
    }

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['value'])){
        $conditions['value'] = trim($_GET['value']);
    }

    if(!empty($_GET['user'])){
        $conditions['user'] = trim($_GET['user']);
    }

    if(!empty($_GET['id_category'])){
        $conditions['id_category'] = (int) $_GET['id_category'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    if(!empty($_GET['action'])){
        $listData = $modelKeys->find()->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if($_GET['action'] == 'active'){
                    $value->status = 'active';

                    $modelKeys->save($value);
                }
            }
        }

        return $controller->redirect('/plugins/admin/keys-view-admin-key-listKey');
    }else{
        $listData = $modelKeys->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		if(empty($category[$value->id_category])){
    			$category[$value->id_category] = $modelCategories->get( (int) $value->id_category);
    		}
    		
    		$listData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
            $listData[$key]->max_request = (!empty($category[$value->id_category]->description))?$category[$value->id_category]->description:10000000;
    	}
    }

    // phân trang
    $totalData = $modelKeys->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'application_key');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
}

function addKey($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Thông tin khóa';

	$modelKeys = $controller->loadModel('Appkeys');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelKeys->get( (int) $_GET['id']);

        if(!empty($data) && empty($data->create_at)){
            $data->create_at = time();
        }
    }else{
        $data = $modelKeys->newEmptyEntity();

        $data->create_at = time();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['value'])){
            $session->write('id_category_key', $dataSend['id_category']);

            $conditions = ['value'=>trim($dataSend['value']), 'id_category'=>(int) $dataSend['id_category']];

            if(!empty($_GET['id'])){
                $conditions['id !='] = (int) $_GET['id'];
            }

            $checkKey = $modelKeys->find()->where($conditions)->first();

            if(empty($checkKey)){
                $app = $modelCategories->find()->where(['id'=>(int) $dataSend['id_category']])->first();

    	        // tạo dữ liệu save
    	        $data->value = trim($dataSend['value']);
                $data->id_category = (int) $dataSend['id_category'];
                $data->status = $dataSend['status'];
                $data->user = $dataSend['user'];
                $data->pass = $dataSend['pass'];

                if(empty($data->used)) $data->used = 0;
                if(empty($data->month)) $data->month = (int) date('m');

                if(!empty($dataSend['create_at'])){
                    $create_at = explode('/', $dataSend['create_at']);

                    $data->create_at = mktime(0, 0, 0, $create_at[1], $create_at[0], $create_at[2]);
                }

                if($app->keyword == 'first_month'){
                    $data->deadline = getLastDayOfMonthTimestamp();
                }else{
                    $data->deadline = $data->create_at;
                    $timeNow = time();

                    do{
                        $data->deadline += 30*24*60*60; // cộng thêm 30 ngày
                    }while($data->deadline < $timeNow);
                }

    	        $modelKeys->save($data);

    	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Key đã tồn tại</p>';
            }
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập key</p>';
	    }
    }

    if(empty($data->id_category) && !empty($session->read('id_category_key'))){
        $data->id_category = $session->read('id_category_key');
    }

    $conditions = array('type' => 'application_key');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    if(empty($listCategory)){
        return $controller->redirect('/plugins/admin/keys-view-admin-category-listCategoryKey');
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCategory', $listCategory);
}

function deleteKey($input){
	global $controller;

	$modelKeys = $controller->loadModel('Appkeys');
	
	if(!empty($_GET['id'])){
		$data = $modelKeys->get($_GET['id']);
		
		if($data){
         	$modelKeys->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/keys-view-admin-key-listKey');
}

function refreshKey($input){
    global $controller;

    $modelKeys = $controller->loadModel('Appkeys');
    
    if(!empty($_GET['id'])){
        $data = $modelKeys->get($_GET['id']);
        
        if($data){
            $data->used= 0;
            $data->month= (int) date('m');

            $modelKeys->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/keys-view-admin-key-listKey');
}

function setingKey($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingKey');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array('id_tinypng' =>(int) @$dataSend['id_tinypng'], 
                       
                    );
        $data->key_word = 'setingKey';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}
?>