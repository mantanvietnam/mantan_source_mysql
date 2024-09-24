<?php
function listThemeCLoneWeb($input)
{
    global $controller;
    global $isRequestPost;
    global $session;
    global $modelOptions;

    $conditions = array('key_word' => 'price_clone_web');
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }
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

                    $static[$value] =array('number_theme'=> count($number_theme), 'price'=>@$price[$value]);
                }else{
                    unset($listFolder[$key]);
                }
            }
        }

        setVariable('listFolder', $listFolder);
        setVariable('static', $static);

    }else{
        return $controller->redirect('/login');
    }
}

function settingThemeCloneWeb($input)
{   
    global $controller;
    global $isRequestPost;
    global $session;
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        if(!empty($_GET['theme'])){
            if(file_exists(__DIR__.'/../../../../themes/'.$_GET['theme'].'/controller.php')){
                include(__DIR__.'/../../../../themes/'.$_GET['theme'].'/controller.php');

                if(function_exists('setting_theme_clone_web')){
                    setting_theme_clone_web($input);
                }
            }

            setVariable('theme', $_GET['theme']);
        }else{
            return $controller->redirect('/listThemeCLoneWeb');
        }

    }else{
        return $controller->redirect('/login');
    }
}


?>