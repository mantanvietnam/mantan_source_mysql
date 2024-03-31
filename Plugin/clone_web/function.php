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

function show_text_clone($str='')
{
    global $session;

    $infoMemberWeb = $session->read('infoMemberWeb');
    
    if(!empty($infoMemberWeb) && !empty($str)){
        $str = @str_replace('%name%', $infoMemberWeb->name, $str);
        $str = @str_replace('%position%', $infoMemberWeb->name_position, $str);
        $str = @str_replace('%avatar%', $infoMemberWeb->avatar, $str);
        $str = @str_replace('%phone%', $infoMemberWeb->phone, $str);
        $str = @str_replace('%email%', $infoMemberWeb->email, $str);
        $str = @str_replace('%address%', $infoMemberWeb->address, $str);
        $str = @str_replace('%birthday%', $infoMemberWeb->birthday, $str);
        $str = @str_replace('%description%', $infoMemberWeb->description, $str);
        $str = @str_replace('%banner%', $infoMemberWeb->banner, $str);
        $str = @str_replace('%facebook%', $infoMemberWeb->facebook, $str);
        $str = @str_replace('%instagram%', $infoMemberWeb->instagram, $str);
        $str = @str_replace('%tiktok%', $infoMemberWeb->tiktok, $str);
        $str = @str_replace('%youtube%', $infoMemberWeb->youtube, $str);
        $str = @str_replace('%zalo%', $infoMemberWeb->zalo, $str);
        $str = @str_replace('%web%', $infoMemberWeb->web, $str);
        $str = @str_replace('%twitter%', $infoMemberWeb->twitter, $str);
        $str = @str_replace('%linkedin%', $infoMemberWeb->linkedin, $str);
        $str = @str_replace('%portrait%', $infoMemberWeb->portrait, $str);
    }

    return $str;
}

function check_domain_clone()
{
    global $controller;
    global $session;
    global $modelOptions;
    global $modelCategories;
    global $metaTitleMantan;
    global $metaImageMantan;

    $modelMemberWebs = $controller->loadModel('MemberWebs');
    $modelMembers = $controller->loadModel('Members');
    $modelAffiliaters = $controller->loadModel('Affiliaters');

    $conditions['domain'] = $_SERVER['HTTP_HOST'];

    $memberWebs = $modelMemberWebs->find()->where($conditions)->first();

    if(!empty($memberWebs)){
        if($memberWebs->type == 'member'){
            $infoMemberWeb = $modelMembers->find()->where(['id'=>$memberWebs->id_member, 'status'=>'active'])->first();

            if(!empty($infoMemberWeb)){
                $infoMemberWeb->type_member = 'member';
            }
        }else{
            $infoMemberWeb = $modelAffiliaters->find()->where(['id'=>$memberWebs->id_member])->first();

            if(!empty($infoMemberWeb)){
                $infoMemberWeb->type_member = 'affiliate';
            }
        }

        if(!empty($infoMemberWeb)){
            if(file_exists(__DIR__.'/theme/'.$memberWebs->theme.'/routes.php')){
                include(__DIR__.'/theme/'.$memberWebs->theme.'/routes.php');
            }

            if(file_exists(__DIR__.'/theme/'.$memberWebs->theme.'/function.php')){
                include(__DIR__.'/theme/'.$memberWebs->theme.'/function.php');
            }

            if(file_exists(__DIR__.'/theme/'.$memberWebs->theme.'/controller.php')){
                include(__DIR__.'/theme/'.$memberWebs->theme.'/controller.php');
            }

            // lấy thông tin hệ thống
            $position = [];
            if(!empty($infoMemberWeb->id_position)){
                $position = $modelCategories->find()->where(array('id'=>$infoMemberWeb->id_position))->first();
            }
            
            $system = $modelCategories->find()->where(array('id'=>$infoMemberWeb->id_system ))->first();

            $infoMemberWeb->name_position = @$position->name;
            $infoMemberWeb->name_system = @$system->name;
            $infoMemberWeb->image_system = @$system->image;

            // cài lại SEO
            $metaTitleMantan = $infoMemberWeb->name_position.' '.$infoMemberWeb->name;
            if(!empty($infoMemberWeb->banner)){
                $metaImageMantan = $infoMemberWeb->banner;
            }else{
                if(!empty($infoMemberWeb->avatar)){
                    $metaImageMantan = $infoMemberWeb->avatar;
                }
            }

            $session->write('themeActive', $memberWebs->theme);
            $session->write('infoMemberWeb', $infoMemberWeb);
        }
    }else{
        $conditions = array('key_word' => 'theme_active_site');
        $theme_active_site = $modelOptions->find()->where($conditions)->first();

        $session->write('themeActive', $theme_active_site->value);
    }
}

check_domain_clone();
?>