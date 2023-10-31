<?php 
function listProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách sản phẩm';

	$modelProduct = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(!empty($_GET['id_category'])){
        $conditions['id_category'] = (int) $_GET['id_category'];
    }

    if(!empty($_GET['id_manufacturer'])){
        $conditions['id_manufacturer'] = (int) $_GET['id_manufacturer'];
    }

    if(isset($_GET['hot'])){
        if($_GET['hot']!=''){
            $conditions['hot'] = (int) $_GET['hot'];
        }
    }

    if(!empty($_GET['code'])){
        $conditions['code'] = $_GET['code'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    $listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        $category[0] = $modelCategories->newEmptyEntity();

    	foreach ($listData as $key => $value) {
    		if(empty($category[$value->id_category])){
    			$category[$value->id_category] = $modelCategories->get( (int) $value->id_category);
    		}
    		
    		$listData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
    	}
    }

    // phân trang
    $totalData = $modelProduct->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_product');
    $categories = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'manufacturer_product');
    $manufacturers = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('categories', $categories);
    setVariable('manufacturers', $manufacturers);
}

function addProduct($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin sản phẩm';

	$modelProduct = $controller->loadModel('Products');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProduct->get( (int) $_GET['id']);

        $data->images = json_decode($data->images, true);
    }else{
        $data = $modelProduct->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = str_replace(array('"', "'"), '’', @$dataSend['title']);
            $data->id_category = (int) @$dataSend['id_category'];
            $data->hot = (int) @$dataSend['hot'];
            $data->description = @$dataSend['description'];
            $data->keyword = @$dataSend['keyword'];
	        $data->info = @$dataSend['info'];
	        $data->image = @$dataSend['image'];
            $data->images = json_encode(@$dataSend['images']);
            $data->code = @$dataSend['code'];
            $data->price = (int) @$dataSend['price'];
            $data->price_old = (int) @$dataSend['price_old'];
            $data->quantity = (int) @$dataSend['quantity'];
            $data->id_manufacturer = (int) @$dataSend['id_manufacturer'];
	        $data->status = @$dataSend['status'];
            $data->rule = @$dataSend['rule'];
            $data->specification = @$dataSend['specification'];
            $data->id_product = @$dataSend['id_product'];
            $data->idpro_discount = @$dataSend['idpro_discount'];
            $data->pricepro_discount = @$dataSend['pricepro_discount'];
	        
            
	        // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelProduct->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }

            $data->slug = $slugNew;

	        $modelProduct->save($data);

            $data->images = json_decode($data->images, true);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên sản phẩm</p>';
	    }
    }

    $conditions = array('type' => 'category_product');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'manufacturer_product');
    $listManufacturer = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCategory', $listCategory);
    setVariable('listManufacturer', $listManufacturer);
}

function deleteProduct($input){
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	
	if(!empty($_GET['id'])){
		$data = $modelProduct->get($_GET['id']);
		
		if($data){
         	$modelProduct->delete($data);

         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/product-view-admin-product-listProduct.php');
}

function addFlashSale($input){
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    
    if(!empty($_GET['id'])){
        $data = $modelProduct->get($_GET['id']);
            
        $data->flash_sale = $_GET['flash_sale'];
      
        $modelProduct->save($data);
        
    }



    return $controller->redirect('/plugins/admin/product-view-admin-product-listProduct.php');
}



function listQuestion($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách câu hỏi thường gặp';

    $modelQuestion = $controller->loadModel('Questions');

    if(!isset($_GET['id_product'])){
        return $controller->redirect('/plugins/admin/product-view-admin-product-listProduct.php');
    }
    
    $conditions = array();
    $conditions['id_product']=$_GET['id_product'];
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');


    
    $listData = $modelQuestion->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelQuestion->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelQuestion->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addQuestion($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin lịch trình';


    $modelQuestion = $controller->loadModel('Questions');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelQuestion->get( (int) $_GET['id']);

    }else{
        $data = $modelQuestion->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['question'])){
            // tạo dữ liệu save
            $data->question = @$dataSend['question'];
            $data->answer = @$dataSend['answer'];
            $data->id_product = @$_GET['id_product'];

            $modelQuestion->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/product-view-admin-product-ListQuestion.php?status=2&id_product='.$_GET['id_product']);
            }else{
                return $controller->redirect('/plugins/admin/product-view-admin-product-ListQuestion.php?status=1&id_product='.$_GET['id_product']);
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteQuestion($input){
    global $controller;
    $modelQuestion = $controller->loadModel('Questions');
    if(!empty($_GET['id'])){
        $data = $modelQuestion->get($_GET['id']);
        
        if($data){
            $modelQuestion->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/product-view-admin-product-ListQuestion.php?status=3&id_product='.$_GET['id_product']);
}
?>