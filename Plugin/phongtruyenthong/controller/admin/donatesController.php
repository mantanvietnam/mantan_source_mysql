<?php 
function listDonateAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách quyên góp';

	$modelDonates = $controller->loadModel('Donates');
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

    if(!empty($_GET['id_class'])){
        $conditions['id_class'] = (int) $_GET['id_class'];
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }
    
    $listData = $modelDonates->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

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
            $listData[$key]->name_class = (!empty($classes[$value->id_year]->name))?$classes[$value->id_year]->name:'';
    	}
    }

    // phân trang
    $totalData = $modelDonates->find()->where($conditions)->all()->toList();
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

function addDonateAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin quyên góp';

	$modelClasses = $controller->loadModel('Classes');
    $modelDonates = $controller->loadModel('Donates');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelDonates->get( (int) $_GET['id']);
    }else{
        $data = $modelDonates->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            if(empty($dataSend['avatar'])) $dataSend['avatar'] = $urlHomes.'/plugins/phongtruyenthong/view/home/assets/img/avatar-default.jpg';

	        // tạo dữ liệu save
	        $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $data->id_year = (int) $dataSend['id_year'];
            $data->id_class = (int) $dataSend['id_class'];
            $data->donate = (int) $dataSend['donate'];
	        $data->phone = $dataSend['phone'];
	        $data->email = $dataSend['email'];
	        $data->avatar = $dataSend['avatar'];
            $data->job = $dataSend['job'];

	        $modelDonates->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên người quyên góp</p>';
	    }
    }

    $conditions = array('type' => 'school_year');
    $years = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('years', $years);
}

function deleteDonateAdmin($input){
	global $controller;

	$modelDonates = $controller->loadModel('Donates');
	
	if(!empty($_GET['id'])){
		$data = $modelDonates->get($_GET['id']);
		
		if($data){
         	$modelDonates->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/phongtruyenthong-view-admin-domate-listDonateAdmin.php');
}
?>