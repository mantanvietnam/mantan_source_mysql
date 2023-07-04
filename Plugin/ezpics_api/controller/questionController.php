<?php 
function listCategoryQuestionAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục câu hỏi';
    $modelQuestion = $controller->loadModel('Questions');
    $return = array('code'=> 0);


    $conditions = array('type' => 'question_categories');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    $return = array('code'=> 1,
                    'data'=>$listData,
                    'mess'=>'bạn lấy data thành công'
                    );

    return $return;
}

function listQuestionAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục câu hỏi';
    $modelQuestion = $controller->loadModel('Questions');
    $return = array('code'=> 0);

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $conditions = array('type' => 'question_categories', 'id'=> $dataSend['idCategory']);

    $data = $modelCategories->find()->where($conditions)->first();
    if(!empty($data)){
        $listData = $modelQuestion->find()->where(['category_id'=>$data->id])->all()->toList();
        $return = array('code'=> 1,
                    'data'=>$listData,
                    'mess'=>'bạn lấy data thành công'
                    );
    }else{
         $return = array('code'=> 3,
                        'mess'=> 'bạn nhập sai thông tin'
                        );
     }
    }
    return $return;
}

function getQuestionAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Danh mục câu hỏi';
    $modelQuestion = $controller->loadModel('Questions');
    $return = array('code'=> 0);


    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $conditions = array('id'=> $dataSend['idQuestion']);

    $data = $modelQuestion->find()->where($conditions)->first();
    if(!empty($data)){
        $return = array('code'=> 1,
                    'data'=>$data,
                    'mess'=>'bạn lấy data thành công'
                    );
    }else{
         $return = array('code'=> 3,
                        'mess'=> 'bạn nhập sai thông tin'
                        );
     }
    }
    return $return;
}
 ?>