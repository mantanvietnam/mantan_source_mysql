<?php 
function getCategoryProductAPI($input)
{
    global $modelCategories;
    
    $conditionCategorieProduct = array('type' => 'category_product', 'status'=>'active');
    
    return  $modelCategories->find()->where($conditionCategorieProduct)->order(['weighty'=>'asc'])->all()->toList();
}
?>