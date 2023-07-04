<?php 
function listCategoryQuestion($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục câu hỏi';
    $modelQuestion = $controller->loadModel('Questions');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
        if(!empty($dataSend['idCategoryEdit'])){
            $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
        }else{
            $infoCategory = $modelCategories->newEmptyEntity();
        }

        // tạo dữ liệu save
        $infoCategory->name = str_replace(array('"', "'"), '’', @$dataSend['name']);
        $infoCategory->parent = 0;
        $infoCategory->image = $dataSend['image'];
        $infoCategory->meta_title = $infoCategory->name;
        $infoCategory->keyword = str_replace(array('"', "'"), '’', @$dataSend['meta_keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’',@$dataSend['meta_description']);
        $infoCategory->type = 'question_categories';
        $infoCategory->created_at = date('Y-m-d H:i:s');

        // tạo slug
        $slug = createSlugMantan($infoCategory->name);
        $slugNew = $slug;
        $number = 0;
        do{
            $conditions = array('slug'=>$slugNew,'type'=>'product_categories');
            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

            if(!empty($listData)){
                $number++;
                $slugNew = $slug.'-'.$number;
            }
        }while (!empty($listData));

        $infoCategory->slug = $slugNew;

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'question_categories');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    $totalQuestion = 0;
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
        $question  = $modelQuestion->find()->where(['category_id'=>$value->id])->all()->toList();
            $listData[$key]->question = count($question);
            $totalQuestion += count($question);
        }
    }

    setVariable('listData', $listData);
    setVariable('totalQuestion', $totalQuestion);
}

function listQuestion($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    global $urlCurrent;

    $metaTitleMantan = 'Danh sách câu hỏi';
    $modelQuestion = $controller->loadModel('Questions');
   
       $conditions = array();
            if(!empty($_GET['category_id'])){
                $conditions['category_id'] = $_GET['category_id'];
            }
            if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $listData = $modelQuestion->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $category  = $modelCategories->find()->where(['id'=>$value->category_id])->first();
            $listData[$key]->category = @$category;
            
        }
    }

    $totalData = $modelQuestion->find()->where($conditions)->all()->toList();
    $totalMoney = 0;
    if(!empty($totalData)){
        foreach($totalData as $key => $item){
            $totalMoney += $item->total;
        }
    }

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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    


    $condit = array('type' => 'question_categories');
    $listDataCategories = $modelCategories->find()->where($condit)->order(['id' => 'DESC'])->all()->toList();

    $totalQuestion = count($listData);

    setVariable('listData', $listData);
    setVariable('totalQuestion', $totalQuestion);
    setVariable('listCategory', $listDataCategories);
}

function addQuestion($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    global $urlCurrent;

    $metaTitleMantan = 'thông tin câu hỏi';
    $modelQuestion = $controller->loadModel('Questions');

     if(!empty($_GET['id'])){
            $data = $modelQuestion->get( (int) $_GET['id']);
        }else{
            $data = $modelQuestion->newEmptyEntity();
        }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
       

        // tạo dữ liệu save
        $data->name = str_replace(array('"', "'"), '’', @$dataSend['name']);
        $data->category_id = @$dataSend['category_id'];
        $data->created_at = date('Y-m-d H:i:s');

        $modelQuestion->save($data);
         return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-question-listQuestion.php');
    }

    $condit = array('type' => 'question_categories');
    $listCategory = $modelCategories->find()->where($condit)->order(['id' => 'DESC'])->all()->toList();

    setVariable('data', $data);
    setVariable('listCategory', $listCategory);


   
}

function deleteQuestion($input){
    global $controller;

   
    $modelQuestion = $controller->loadModel('Questions');
    
    if(!empty($_GET['id'])){
        $data = $modelQuestion->get($_GET['id']);
        
        if($data){
            // xóa mẫu thiết kế
            $modelQuestion->delete($data);

          
        }
    }

    return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-question-listQuestion.php');
}
 ?>