<?php 
function listKindAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Loại dự án';

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
        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
        $infoCategory->type = 'category_kind';

        // tạo slug
        $slug = createSlugMantan($infoCategory->name);
        $slugNew = $slug;
        $number = 0;
        do{
            $conditions = array('slug'=>$slugNew,'type'=>'category_kind');
            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

            if(!empty($listData)){
                $number++;
                $slugNew = $slug.'-'.$number;
            }
        }while (!empty($listData));

        $infoCategory->slug = $slugNew;

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'category_kind');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}