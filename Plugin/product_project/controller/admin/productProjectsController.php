<?php 
function listProductProjectAdmin($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Dự án';

	$modelProductProjects = $controller->loadModel('ProductProjects');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($listData)){
        $kind[0] = $modelCategories->newEmptyEntity();

    	foreach ($listData as $key => $value) {
    		if(empty($kind[$value->id_kind])){
    			$kind[$value->id_kind] = $modelCategories->get( (int) $value->id_kind);
    		}
    		
    		$listData[$key]->name_category = (!empty($kind[$value->id_kind]->name))?$kind[$value->id_kind]->name:'';
    	}
    }
    
    $listData = $modelProductProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelProductProjects->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_kind');
    $listKind = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
    setVariable('listKind', $listKind);

}

function addProductProjectAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Dự án';

	$modelProductProjects = $controller->loadModel('ProductProjects');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProductProjects->get( (int) $_GET['id']);
        $data->images = json_decode($data->images, true);     
        // $data->id_product = json_decode($data->id_product, true);

    }else{
        $data = $modelProductProjects->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
            $data->year = $dataSend['year'];
            $data->donor = $dataSend['donor'];
	        $data->name = $dataSend['name'];
            $data->address = $dataSend['address'];
            $data->company_design = $dataSend['company_design'];
            $data->designer = $dataSend['designer'];
            $data->company_build= $dataSend['company_build'];
            $data->description= $dataSend['description'];
            $data->city= $dataSend['city'];
            $data->id_product= $dataSend['id_product'];
            $data->status= $dataSend['status'];
            $data->images = json_encode($dataSend['images']);
            $data->image = $dataSend['image'];
            $data->id_kind = $dataSend['id_kind'];
            $data->info = $dataSend['info'];



            // if(!empty($dataSend['id_kind'])){
            //     $data->id_kind = implode(',', $dataSend['id_kind']);
            // }

            

            
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelProductProjects->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelProductProjects->save($data);   

            $data->images = json_decode($data->images, true);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    $conditions = array('type' => 'category_kind');
    $listKind = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listKind', $listKind);
    

}

function deleteProductProjectAdmin($input){
	global $controller;

	$modelProductProjects = $controller->loadModel('ProductProjects');
	
	if(!empty($_GET['id'])){
		$data = $modelProductProjects->get($_GET['id']);
		
		if($data){
         	$modelProductProjects->delete($data);
         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/product_project-view-admin-product_project-listProductProjectAdmin');
}

?>