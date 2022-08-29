<?php 
function listCategoryEzpics($input){
    global $isRequestPost;
    global $modelCategories;

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
        $infoCategory->slug = createSlugMantan($infoCategory->name);
        $infoCategory->parent = 0;
        $infoCategory->image = $dataSend['image'];
        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
        $infoCategory->type = 'ezpics';

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'ezpics');
    $category_ezpics = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('category_ezpics', $category_ezpics);
}
?>