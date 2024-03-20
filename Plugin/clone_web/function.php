<?php 
$menus= array();
$menus[0]['title']= 'Clone Web';
$menus[0]['sub'][0]= array('title'=>'Web đại lý',
                            'url'=>'/plugins/admin/clone_web-view-admin-website-listWebMemberAdmin',
                            'classIcon'=>'bx bxl-wordpress',
                            'permission'=>'listWebMemberAdmin',
                        );

$menus[0]['sub'][1]= array('title'=>'Kho giao diện',
                            'url'=>'/plugins/admin/clone_web-view-admin-theme-listThemeCLoneWebAdmin',
                            'classIcon'=>'bx bx-layout',
                            'permission'=>'listThemeCLoneWebAdmin',
                        );

addMenuAdminMantan($menus);

function check_domain_clone()
{
    global $controller;

    $modelMemberWebs = $controller->loadModel('MemberWebs');

    $conditions['domain'] = $_SERVER['HTTP_HOST'];

    $memberWebs = $modelMemberWebs->find()->where($conditions)->first();

    if(!empty($memberWebs)){
        if(file_exists(__DIR__.'/theme/'.$memberWebs->theme.'/routes.php')){
            include(__DIR__.'/theme/'.$memberWebs->theme.'/routes.php');
        }

        if(file_exists(__DIR__.'/theme/'.$memberWebs->theme.'/function.php')){
            include(__DIR__.'/theme/'.$memberWebs->theme.'/function.php');
        }

        if(file_exists(__DIR__.'/theme/'.$memberWebs->theme.'/controller.php')){
            include(__DIR__.'/theme/'.$memberWebs->theme.'/controller.php');
        }

        //include(__DIR__.'/theme/'.$memberWebs->theme.'/index.php');
        die();
    }
}

check_domain_clone();
?>