<?php 
function listSchoolYearAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách niên khóa';

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
        $infoCategory->image = (!empty($dataSend['image']))?$dataSend['image']:$urlHomes.'/plugins/phongtruyenthong/view/home/assets/img/year.png';
        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
        $infoCategory->type = 'school_year';
        $infoCategory->slug = createSlugMantan($infoCategory->name);

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'school_year');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}
?>