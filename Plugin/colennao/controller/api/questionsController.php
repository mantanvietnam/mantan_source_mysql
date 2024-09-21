<?php 
function listquestionAPI($input) {
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    $metaTitleMantan = 'danh sách câu hỏi';

    $modelquestions = $controller->loadModel('questions');
    $Modelanswerquestion = $controller->loadModel('answerquestion');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
    }

}

?>