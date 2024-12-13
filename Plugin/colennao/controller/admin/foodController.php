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
            $data->nameen = $dataSend['nameen'];
            $data->contenten = $dataSend['contenten'];
            $data->month = $dataSend['month'];
            $data->icon = $dataSend['icon'];

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

    return $controller->redirect('/plugins/admin/colennao-view-admin-food-listgroupfood');
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
    $modelbreakfast = $controller->loadModel('breakfast');
	$mess= '';

    if(!empty($_GET['id'])){
        $data = $modelbreakfast->get( (int) $_GET['id']);
    }else{
        $data = $modelbreakfast->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->content= $dataSend['content'];
            $data->image = $dataSend['image'];
            $data->Ingredients = $dataSend['Ingredients'];
            // $data->eatformat = $dataSend['eatformat'];
            $data->id_food = $dataSend['id_food'];
            $data->timeeat = $dataSend['timeeat'];
            $data->time = $dataSend['time'];
            $data->nameen = $dataSend['nameen'];
            $data->contenten = $dataSend['contenten'];
            $data->ingredientsen = $dataSend['ingredientsen'];
            $data->calories = $dataSend['calories'];
            $data->proteins = $dataSend['proteins'];
            $data->fats = $dataSend['fats'];
            $data->carbs = $dataSend['carbs'];
            $data->note = $dataSend['note'];
            $data->noteen = $dataSend['noteen'];
            $data->category = $dataSend['category'];
            $data->categoryen = $dataSend['categoryen'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelbreakfast->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelbreakfast->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
	    }
    }
    $listData =  $modelfood->find()->all()->toList();
    setVariable('listData', $listData);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletebreakfast($input){
    global $controller;

    $modelbreakfast = $controller->loadModel('breakfast');
    
    if(!empty($_GET['id'])){
        $data = $modelbreakfast->get($_GET['id']);
        
        if($data){
            $modelbreakfast->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-breakfastfood-listbreakfastfood');
}


function listlunchfood($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách bữa trưa';

    $modelfood = $controller->loadModel('food');
    $modellunch = $controller->loadModel('lunch');
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
    
    $listData = $modellunch->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modellunch->find()->where($conditions)->all()->toList();
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
function addlunchfood($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm bữa trưatrưa';
	$modelfood = $controller->loadModel('food');
    $modellunch = $controller->loadModel('lunch');
	$mess= '';

    if(!empty($_GET['id'])){
        $data = $modellunch->get( (int) $_GET['id']);
    }else{
        $data = $modellunch->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->content= $dataSend['content'];
            $data->image = $dataSend['image'];
            $data->Ingredients = $dataSend['Ingredients'];
            // $data->eatformat = $dataSend['eatformat'];
            $data->id_food = $dataSend['id_food'];
            $data->timeeat = $dataSend['timeeat'];
            $data->time = $dataSend['time'];
            $data->nameen = $dataSend['nameen'];
            $data->contenten = $dataSend['contenten'];
            $data->ingredientsen = $dataSend['ingredientsen'];
            $data->calories = $dataSend['calories'];
            $data->proteins = $dataSend['proteins'];
            $data->fats = $dataSend['fats'];
            $data->carbs = $dataSend['carbs'];
            $data->note = $dataSend['note'];
            $data->noteen = $dataSend['noteen'];
            $data->category = $dataSend['category'];
            $data->categoryen = $dataSend['categoryen'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modellunch->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modellunch->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }
    $listData =  $modelfood->find()->all()->toList();
    setVariable('listData', $listData);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletelunch($input){
    global $controller;

    $modellunch = $controller->loadModel('lunch');
    
    if(!empty($_GET['id'])){
        $data = $modellunch->get($_GET['id']);
        
        if($data){
            $modellunch->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-lunchfood-listlunchfood');
}

function listdinnerfood($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách bữa tốitối';

    $modelfood = $controller->loadModel('food');
    $modeldinner = $controller->loadModel('dinner');
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
    
    $listData = $modeldinner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modeldinner->find()->where($conditions)->all()->toList();
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
function adddinnerfood($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm bữa tối';
	$modelfood = $controller->loadModel('food');
    $modeldinner = $controller->loadModel('dinner');
	$mess= '';

    if(!empty($_GET['id'])){
        $data = $modeldinner->get( (int) $_GET['id']);
    }else{
        $data = $modeldinner->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->content= $dataSend['content'];
            $data->image = $dataSend['image'];
            $data->Ingredients = $dataSend['Ingredients'];
            // $data->eatformat = $dataSend['eatformat'];
            $data->id_food = $dataSend['id_food'];
            $data->timeeat = $dataSend['timeeat'];
            $data->time = $dataSend['time'];
            $data->nameen = $dataSend['nameen'];
            $data->contenten = $dataSend['contenten'];
            $data->ingredientsen = $dataSend['ingredientsen'];
            $data->calories = $dataSend['calories'];
            $data->proteins = $dataSend['proteins'];
            $data->fats = $dataSend['fats'];
            $data->carbs = $dataSend['carbs'];
            $data->note = $dataSend['note'];
            $data->noteen = $dataSend['noteen'];
            $data->category = $dataSend['category'];
            $data->categoryen = $dataSend['categoryen'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modeldinner->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modeldinner->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }
    $listData =  $modelfood->find()->all()->toList();
    setVariable('listData', $listData);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletedinner($input){
    global $controller;

    $modeldinner = $controller->loadModel('dinner');
    
    if(!empty($_GET['id'])){
        $data = $modeldinner->get($_GET['id']);
        
        if($data){
            $modeldinner->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-dinnerfood-listdinnerfood');
}
function listsnacksfood($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách bữa ăn nhẹ';

    $modelfood = $controller->loadModel('food');
    $modelsnacks = $controller->loadModel('snacks');
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
    
    $listData = $modelsnacks->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelsnacks->find()->where($conditions)->all()->toList();
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
function addsnacksfood($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm bữa ăn nhẹ';
	$modelfood = $controller->loadModel('food');
    $modelsnacks = $controller->loadModel('snacks');
	$mess= '';

    if(!empty($_GET['id'])){
        $data = $modelsnacks->get( (int) $_GET['id']);
    }else{
        $data = $modelsnacks->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->content= $dataSend['content'];
            $data->image = $dataSend['image'];
            $data->Ingredients = $dataSend['Ingredients'];
            // $data->eatformat = $dataSend['eatformat'];
            $data->id_food = $dataSend['id_food'];
            $data->timeeat = $dataSend['timeeat'];
            $data->time = $dataSend['time'];
            $data->nameen = $dataSend['nameen'];
            $data->contenten = $dataSend['contenten'];
            $data->ingredientsen = $dataSend['ingredientsen'];
            $data->calories = $dataSend['calories'];
            $data->proteins = $dataSend['proteins'];
            $data->fats = $dataSend['fats'];
            $data->carbs = $dataSend['carbs'];
            $data->note = $dataSend['note'];
            $data->noteen = $dataSend['noteen'];
            $data->category = $dataSend['category'];
            $data->categoryen = $dataSend['categoryen'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelsnacks->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelsnacks->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }
    $listData =  $modelfood->find()->all()->toList();
    setVariable('listData', $listData);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletesnacks($input){
    global $controller;

    $modelsnacks = $controller->loadModel('snacks');
    
    if(!empty($_GET['id'])){
        $data = $modelsnacks->get($_GET['id']);
        
        if($data){
            $modelsnacks->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-snackfood-listsnacksfood');
}
?>