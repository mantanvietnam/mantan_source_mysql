<?php 
function listkeywordAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Keyword';
     $modelKeyword = $controller->loadModel('Keywords');
     $mess = '';
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
        if(!empty($dataSend['idEdit'])){
            $data = $modelKeyword->get( (int) $dataSend['idEdit']);
        }else{
            $data = $modelKeyword->newEmptyEntity();
        }
        if(!empty($dataSend['keyword']) && !empty($dataSend['replacement'])){
            // tạo dữ liệu save
            $data->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $data->replacement = str_replace(array('"', "'"), '’', $dataSend['replacement']);

            $modelKeyword->save($data);
            return $controller->redirect('/plugins/admin/mangxahoi-view-admin-keyword-listkeywordAdmin');
        }else{
            $mess= '<p class="text-danger">Bạn thiếu dữ liệu</p>';
        }
       
        
    }

    $conditions = array();
    $listData = $modelKeyword->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

    setVariable('listData', $listData);
    setVariable('mess', $mess);
}

function deleteKeyword($input){
    global $controller;

    $modelKeyword = $controller->loadModel('Keywords');
    
    if(!empty($_GET['id'])){
        $data = $modelKeyword->get($_GET['id']);
        
        if($data){
            $modelKeyword->delete($data);

        }
    }
    return array('code'=>1);
}


?>