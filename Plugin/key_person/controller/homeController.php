<?php 
function person($input){
        global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = "Đại lý khu vực";

    $modelPerson = $controller->loadModel('Persons');

   
    $conditions = array('type' => 'category_person');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->person = $modelPerson->find()->where(array('id_category'=>$item->id))->all()->toList();

        }
    }

    setVariable('listData', $listData);
}
?>