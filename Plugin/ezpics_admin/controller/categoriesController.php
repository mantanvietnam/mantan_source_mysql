<?php 
function listCategoryEzpics($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục mẫu thiết kế';
    $modelProducts = $controller->loadModel('Products');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
        if(!empty($dataSend['idCategoryEdit'])){
            $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
        }else{
            $infoCategory = $modelCategories->newEmptyEntity();
        }

        // tạo dữ liệu save
        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
        $infoCategory->parent = 0;
        $infoCategory->image = $dataSend['image'];
        $infoCategory->meta_title = $infoCategory->name;
        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['meta_keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['meta_description']);
        $infoCategory->type = 'product_categories';
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

    $conditions = array('type' => 'product_categories');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    $totalProductSell = 0;
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $products = $modelProducts->find()->where(['category_id'=>$value->id, 'type'=>'user_create', 'status'=>2])->all()->toList();
            $listData[$key]->number_product = count($products);
            $totalProductSell += count($products);
        }
    }

    setVariable('listData', $listData);
    setVariable('totalProductSell', $totalProductSell);
}
?>