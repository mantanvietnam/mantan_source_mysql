<?php

function listRegAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đăng ký';

    $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int)  $_GET['id'];
    }

    if(!empty($_GET['system_name'])){
        $conditions['system_name LIKE'] = '%'.$_GET['system_name'].'%';
    }

    if(!empty($_GET['boss_name'])){
        $conditions['boss_name LIKE'] = '%'.$_GET['boss_name'].'%';
    }

    if(!empty($_GET['boss_phone'])){
        $conditions['boss_phone'] = $_GET['boss_phone'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    $listData = $modelRequestDatacrms->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelRequestDatacrms->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0)
        $totalPage+=1;

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
}

function updateCodeAdmin($input)
{
    global $controller;
    
    $root = __DIR__.'/../../../../../../';
    $listFile = list_files($root);

    $domain_done = [];
    $domain_error = [];

    if(!empty($listFile)){
        foreach ($listFile as $key => $domain) {
            
            $public = $root.$domain.'/public_html/';

            if(file_exists($public.'plugins/hethongdaily/info.xml')){
                $info= @simplexml_load_file($public.'plugins/hethongdaily/info.xml');
                
                if($info->ver != '3'){
                    // copy file zip
                    $source = __DIR__.'/../../code/data_crm_update.zip'; // Đường dẫn tới file ZIP nguồn

                    $zipArchive = new ZipArchive();
                    $result = $zipArchive->open($source);
                    if ($result === TRUE) {
                        $zipArchive ->extractTo($public);
                        $zipArchive ->close();

                        $domain_done[] = $domain;
                    }else{
                        $domain_error[] = $domain;
                    }

                    //return $controller->redirect('/updateCodeAdmin/?time='.time());
                }else{
                    $domain_done[] = $domain;
                }
            }
            
        }
    }
    
    setVariable('domain_done', $domain_done);
    setVariable('domain_error', $domain_error);
}