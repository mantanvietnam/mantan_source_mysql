<?php 
function listgroupfood($input){
    
        global $controller;
        global $urlCurrent;
        global $metaTitleMantan;
        global $modelCategories;
    
        $metaTitleMantan = 'Danh sách các loại thức ăn';
    
        $modelfood = $controller->loadModel('food');
    
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
        
        $listData = $modelfood->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
     
        // phân trang
        $totalData = $modelfood->find()->where($conditions)->all()->toList();
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

}
function addgroupfood($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin nhóm thức ăn';
	$modelfood = $controller->loadModel('food');
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelfood->get( (int) $_GET['id']);
    }else{
        $data = $modelfood->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->description= $dataSend['description'];
            $data->image = $dataSend['image'];
            // tạo slug
            // $slug = createSlugMantan($dataSend['name']);
            // $slugNew = $slug;
            // $number = 0;

            // if(empty($data->slug) || $data->slug!=$slugNew){
            //     do{
            //     	$conditions = array('slug'=>$slugNew);
        	// 		$listData = $modelfood->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        	// 		if(!empty($listData)){
        	// 			$number++;
        	// 			$slugNew = $slug.'-'.$number;
        	// 		}
            //     }while (!empty($listData));
            // }
            // $data->slug = $slugNew;

            $modelfood->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletefood($input){
    global $controller;

    $modelfood = $controller->loadModel('food');
    
    if(!empty($_GET['id'])){
        $data = $modelfood->get($_GET['id']);
        
        if($data){
            $modelfood->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-food-listfoodadmin');
}
function listbreakfastfood($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách bữa sáng';

    $modelfood = $controller->loadModel('food');
    $modelbreakfast = $controller->loadModel('breakfast');
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
    
    $listData = $modelbreakfast->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelbreakfast->find()->where($conditions)->all()->toList();
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

}
function addbreakfastfood($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm bữa sáng';
	$modelfood = $controller->loadModel('food');
	$mess= '';

    if(!empty($_GET['id'])){
        $data = $modelfood->get( (int) $_GET['id']);
    }else{
        $data = $modelfood->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->description= $dataSend['content'];
            $data->image = $dataSend['image'];
            $data->Ingredients = $dataSend['Ingredients'];
            $data->eatformat = $dataSend['eatformat'];
            $data->id_food = $dataSend['id_food'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelfood->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelfood->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }
    setVariable('data', $data);
    setVariable('mess', $mess);
}
?>