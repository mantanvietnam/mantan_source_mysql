<?php
function listThemeCLoneWebAdmin($input)
{
    global $controller;
    global $isRequestPost;
    InstallistCloneWeb();

    global $modelOptions;
    $conditions = array('key_word' => 'price_clone_web');

    $data = $modelOptions->find()->where($conditions)->first();

    if(!empty($data->value)){
        $price = json_decode($data->value,true);
    }

    
    
    $modelMemberWebs = $controller->loadModel('MemberWebs');

    $listFolder = list_files(__DIR__.'/../../../../themes');
    $static = [];

    if(!empty($listFolder)){
        foreach ($listFolder as $key => $value) {
            if(strpos($value, 'clone_web') !== false){
                $conditions = ['theme'=>$value, 'status'=>'active'];

                $number_theme = $modelMemberWebs->find()->where($conditions)->all()->toList();

                $static[$value] =array('number_theme'=> count($number_theme), 'price'=>$price[$value]);
            }else{
                unset($listFolder[$key]);
            }
        }
    }

    setVariable('listFolder', $listFolder);
    setVariable('static', $static);
}

function settingThemeCloneWebAdmin($input)
{   
    global $controller;
    global $isRequestPost;

    if(!empty($_GET['theme'])){
        if(file_exists(__DIR__.'/../../../../themes/'.$_GET['theme'].'/controller.php')){
            include(__DIR__.'/../../../../themes/'.$_GET['theme'].'/controller.php');

            if(function_exists('setting_theme_clone_web')){
                setting_theme_clone_web($input);
            }
        }

        setVariable('theme', $_GET['theme']);
    }else{
        return $controller->redirect('/plugins/admin/clone_web-view-admin-theme-listThemeCLoneWebAdmin');
    }
}

function editPriceThemeCloneWebAdmin(){
    global $controller;
    global $modelOptions;
    $conditions = array('key_word' => 'price_clone_web');

    $data = $modelOptions->find()->where($conditions)->first();
    $value = [];
    if(!empty($data->value)){
        $value = json_decode($data->value,true);
        foreach ($value as $key => $item) {
            if($key==$_GET['theme']){
                $value[$key]= (int)$_GET['price'];
               
            }
        }
        $data->value = json_encode($value);

        $modelOptions->save($data);
    }

    return $controller->redirect('/plugins/admin/clone_web-view-admin-theme-listThemeCLoneWebAdmin');                                                               
}
?>