<?php 
function listClassAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách lớp học';

	$modelClasses = $controller->loadModel('Classes');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    if(!empty($_GET['id_year'])){
        $conditions['id_year'] = (int) $_GET['id_year'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    $listData = $modelClasses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        $years[0] = $modelCategories->newEmptyEntity();

    	foreach ($listData as $key => $value) {
    		if(empty($years[$value->id_year])){
    			$years[$value->id_year] = $modelCategories->get( (int) $value->id_year);
    		}
    		
    		$listData[$key]->name_year = (!empty($years[$value->id_year]->name))?$years[$value->id_year]->name:'';
    	}
    }

    // phân trang
    $totalData = $modelClasses->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'school_year');
    $years = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('years', $years);
}

function addClassAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin lớp học';

	$modelClasses = $controller->loadModel('Classes');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelClasses->get( (int) $_GET['id']);

        $data->images = json_decode($data->images, true);
        $data->des_image = json_decode($data->des_image, true);
        $data->audio_image = json_decode($data->audio_image, true);
    }else{
        $data = $modelClasses->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            if(empty($dataSend['image'])) $dataSend['image'] = $urlHomes.'/plugins/phongtruyenthong/view/home/assets/img/default-thumbnail.jpg';

            if(!empty($dataSend['des_image'])){
                foreach ($dataSend['des_image'] as $key => $value) {
                    if(!empty($dataSend['des_image'][$key])){
                        $dataSend['des_image'][$key] = str_replace(array('"', "'"), '’', $dataSend['des_image'][$key]);
                    }
                }
            }

	        // tạo dữ liệu save
	        $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $data->id_year = (int) $dataSend['id_year'];
	        $data->info = $dataSend['info'];
	        $data->image = $dataSend['image'];
            $data->images = json_encode(@$dataSend['images']);
            $data->des_image = json_encode(@$dataSend['des_image']);
            $data->audio_image = json_encode(@$dataSend['audio_image']);
	        $data->status = $dataSend['status'];
            $data->video = $dataSend['video'];
            $data->user = trim($dataSend['user']);
            $data->pass = $dataSend['pass'];
            $data->note_admin = $dataSend['note_admin'];

            $year = $modelCategories->get( (int) $dataSend['id_year']);
	        $data->slug = createSlugMantan($dataSend['name'].' '.$year->name);

	        $modelClasses->save($data);

            $data->images = json_decode($data->images, true);
            $data->des_image = json_decode($data->des_image, true);
            $data->audio_image = json_decode($data->audio_image, true);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên lớp học</p>';
	    }
    }

    $conditions = array('type' => 'school_year');
    $years = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('years', $years);
}

function deleteClassAdmin($input){
	global $controller;

	$modelClasses = $controller->loadModel('Classes');
	
	if(!empty($_GET['id'])){
		$data = $modelClasses->get($_GET['id']);
		
		if($data){
         	$modelClasses->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/phongtruyenthong-view-admin-class-listClassAdmin.php');
}
?>