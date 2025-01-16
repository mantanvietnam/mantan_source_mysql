<?php 
function listCategoryKey($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh sách ứng dụng';

    $modelKeys = $controller->loadModel('Appkeys');

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
        $infoCategory->type = 'application_key';

        // tạo slug
        $slug = createSlugMantan($infoCategory->name);
        $slugNew = $slug;
        $number = 0;
        do{
            $conditions = array('slug'=>$slugNew,'type'=>'application_key');
            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

            if(!empty($listData)){
                $number++;
                $slugNew = $slug.'-'.$number;
            }
        }while (!empty($listData));

        $infoCategory->slug = $slugNew;

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'application_key');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listKeys = $modelKeys->find()->where(['id_category'=>$value->id, 'status'=>'active'])->all()->toList();

            $listData[$key]->number_key = count($listKeys);
        }
    }

    setVariable('listData', $listData);
}
?>