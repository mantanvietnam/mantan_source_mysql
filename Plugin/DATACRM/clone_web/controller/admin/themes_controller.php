<?php
function listThemeCLoneWebAdmin($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelMemberWebs = $controller->loadModel('MemberWebs');

    $listFolder = list_files(__DIR__.'/../../../../themes');
    $static = [];

    if(!empty($listFolder)){
        foreach ($listFolder as $key => $value) {
            if(strpos($value, 'clone_web') !== false){
                $conditions = ['theme'=>$value, 'status'=>'active'];

                $number_theme = $modelMemberWebs->find()->where($conditions)->all()->toList();

                $static[$value] = count($number_theme);
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
?>