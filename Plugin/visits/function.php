<?php 
function toVisits(){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'visits');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    $data->value = (int)$data->value + 1;

    $data->key_word = 'visits';
        
    $modelOptions->save($data);
    

   return $data->value;
}

 ?>