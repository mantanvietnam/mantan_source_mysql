<?php
function getListPositionAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategories;

    $modelMember = $controller->loadModel('Members');

    $return = array();
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id_system'])){
            $conditions = array('type' => 'system_positions', 'parent'=>(int) $dataSend['id_system']);
            $return = $modelCategories->find()->where($conditions)->all()->toList();
        }
    
    }

    return $return;
}
?>