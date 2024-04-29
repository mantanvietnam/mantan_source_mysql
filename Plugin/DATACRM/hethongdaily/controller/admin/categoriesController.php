<?php 
function listSystemAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục hệ thống';
    $modelMembers = $controller->loadModel('Members');

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
        $infoCategory->type = 'system_sales';
        $infoCategory->slug = createSlugMantan($infoCategory->name);
        

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'system_sales');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $members = $modelMembers->find()->where(['id_system'=>$value->id])->all()->toList();
            $listData[$key]->number_member = count($members);
        }
    }

    setVariable('listData', $listData);
}

function listPositionAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Chức danh hệ thống';
    $modelMembers = $controller->loadModel('Members');

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
        $infoCategory->parent = (int) $dataSend['parent']; // id hệ thống
        $infoCategory->image = '';
        $infoCategory->keyword = (int) $dataSend['keyword']; // giá trị đơn hàng tối thiểu
        $infoCategory->description = $dataSend['description']; // phăm trăm chiết khấu
        $infoCategory->type = 'system_positions';
        $infoCategory->slug = createSlugMantan($infoCategory->name);
        

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'system_sales');
    $listSystemAdmin = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'system_positions');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $members = $modelMembers->find()->where(['id_position'=>$value->id])->all()->toList();
            $listData[$key]->number_member = count($members);
        }
    }

    setVariable('listData', $listData);
    setVariable('listSystemAdmin', $listSystemAdmin);
}
?>