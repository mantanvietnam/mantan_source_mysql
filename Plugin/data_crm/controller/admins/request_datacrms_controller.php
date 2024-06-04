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

    /*
    $listData = $modelRequestDatacrms->find()->all()->toList();
    foreach ($listData as $key => $value) {
        if(empty($value->create_at)){
            $value->create_at = 1721618183;
            $value->deadline = 1721618183 + 30*24*60*60;

            $modelRequestDatacrms->save($value);
        }
    }
    */
    
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
                        // giải nén code
                        $zipArchive ->extractTo($public);
                        $zipArchive ->close();

                        // xoá thư mục bộ nhớ đệm
                        $files_tmp = glob($public . 'tmp/cache/models/*');

                        if(!empty($files_tmp)){
                            foreach ($files_tmp as $file) {
                                if (is_file($file)) {
                                    unlink($file);
                                    //echo 'Xoá file ' . $file . ' thành công. <br>';
                                }
                            }
                        }

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

function fixDatabaseAdmin($input)
{
    global $controller;
    
    $root = __DIR__.'/../../../../../../';
    $listFile = list_files($root);

    $domain_done = [];
    $domain_error = [];

    $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

    if(!empty($listFile)){
        foreach ($listFile as $key => $domain) {
            
            $public = $root.$domain.'/public_html/';
            
            if(file_exists($public.'config/app_local.php')){
                $app_local = file_get_contents($public.'config/app_local.php');
               
                //$app_local = str_replace('"DEBUG", true', '"DEBUG", false', $app_local);

                //file_put_contents($public.'config/app_local.php', $app_local);

                $username = explode('"username" => "', $app_local);
                $password = explode('"password" => "', $username[1]);

                $username = explode('",', $password[0]);
                $password = explode('",', $password[1]);

                $checkReg = $modelRequestDatacrms->find()->where(['domain'=>$domain])->first();

                if(!empty($checkReg)){
                    $checkReg->user_db = $username[0];
                    $checkReg->pass_db = $password[0];

                    $modelRequestDatacrms->save($checkReg);

                    debug($domain.' '.$username[0].' '.$password[0]);
                }else{
                    debug('ER: '.$domain);

                    $files_tmp = glob($public . 'tmp/cache/models/*');

                    foreach ($files_tmp as $file) {
                        if (is_file($file)) {
                            unlink($file);
                            echo 'Xoá file ' . $file . ' thành công. <br>';
                        }
                    }
                }
                
            }
            
        }
    }

    die;
}