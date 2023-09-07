<?php 
function listIngredientAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách thư viện ảnh';

    $modelIngredients = $controller->loadModel('Ingredients');
    
    $conditions = array();
     if(!empty($_GET['keyword'])){

        $conditions['keyword LIKE']= '%'.$_GET['keyword'].'%';
    }

    if(!empty($_GET['category_id'])){

        $conditions['category_id']= $_GET['category_id'];
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelIngredients->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->category_id);
            $listData[$key]->categories = $modelCategories->find()->where($conditions_scan)->first();
        }
    }

    // phân trang
    $totalData = $modelIngredients->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'ingredient_categories');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
}

function addIngredientAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategories;
    
    $metaTitleMantan = 'Thông tin thư viện ảnh';


    $modelIngredients = $controller->loadModel('Ingredients');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelIngredients->get( (int) $_GET['id']);

    }else{
        $data = $modelIngredients->newEmptyEntity();
        $data->created_at = date('Y-m-d H:i:s');
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        // tạo dữ liệu saves
        $data->image = @$dataSend['image'];
        $data->category_id = @$dataSend['category_id'];
        $data->status = @$dataSend['status'];
        $data->keyword = @$dataSend['keyword'];
        $data->updated_at = date('Y-m-d H:i:s');

        $modelIngredients->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

        if(!empty($_GET['id'])){
            return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-ingredient-listIngredientAdmin.php?status=2');
        }else{
            return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-ingredient-listIngredientAdmin.php?status=1');
        }
    }

    $conditions = array('type' => 'ingredient_categories');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCategory', $listCategory);
}

function deleteIngredientAdmin($input){
    global $controller;
    $modelIngredients = $controller->loadModel('Ingredients');
    if(!empty($_GET['id'])){
        $data = $modelIngredients->get($_GET['id']);
        
        if($data){
            $modelIngredients->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-ingredient-listIngredientAdmin.php?status=3');
}

function listCategoryIngredientEzpics($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục thư viện ảnh';
    $modelProducts = $controller->loadModel('Products');$modelIngredients = $controller->loadModel('Ingredients');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
        if(!empty($dataSend['idCategoryEdit'])){
            $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
        }else{
            $infoCategory = $modelCategories->newEmptyEntity();
        }

        // tạo dữ liệu save
        $infoCategory->name = $dataSend['name'];
        $infoCategory->type = 'ingredient_categories';
        $infoCategory->created_at = date('Y-m-d H:i:s');

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'ingredient_categories');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    $totalIngredient = 0;
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $products = $modelIngredients->find()->where(['category_id'=>$value->id])->all()->toList();
            $listData[$key]->number_product = count($products);
            $totalIngredient += count($products);
        }
    }

    setVariable('listData', $listData);
}
?>