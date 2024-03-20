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
        echo $_SERVER['HTTP_HOST'];
        die();
    }
}

?>