<?php

function listRegAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $modelOptions;
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

    if(!empty($_GET['domain'])){
        $conditions['domain LIKE'] = '%'.$_GET['domain'].'%';
    }

    if(!empty($_GET['sort'])){
        if($_GET['sort'] == 'deadline_asc'){
            $order = array('deadline'=>'asc');
        }
    }

    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
        $listData = $modelRequestDatacrms->find()->where($conditions)->order($order)->all()->toList();
        
        $titleExcel =   [
            ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
            ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
            ['name'=>'Email', 'type'=>'text', 'width'=>25],
            ['name'=>'Domain', 'type'=>'text', 'width'=>25],
            ['name'=>'Deadline', 'type'=>'text', 'width'=>25],
            ['name'=>'Database', 'type'=>'text', 'width'=>25], 
            ['name'=>'Pass', 'type'=>'text', 'width'=>25], 
        ];

        $dataExcel = [];
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $dataExcel[] = [
                    $value->boss_name,   
                    $value->boss_phone,   
                    $value->boss_email,   
                    $value->domain,
                    date('d/m/Y', $value->deadline),
                    $value->user_db,
                    $value->pass_db,
                ];
            }
        }
        export_excel($titleExcel,$dataExcel,'danh_sach_dang_ky_icham');
    }else{
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
}

function updateCodeCRM($input)
{
    global $controller;
    
    if(!empty($_GET['version'])){
        $root = __DIR__.'/../../../../../../';
        $listFile = list_files($root);

        $domain_done = [];
        $domain_error = [];

        if(!empty($listFile)){
            foreach ($listFile as $key => $domain) {
                $public = $root.$domain.'/public_html/';

                if(file_exists($public.'plugins/hethongdaily/info.xml')){
                    $info= @simplexml_load_file($public.'plugins/hethongdaily/info.xml');
                    
                    if($info->ver != $_GET['version']){
                        echo $domain.'<br/>';
                    }
                }

                if(file_exists($public.'__MACOSX')){
                    //unlink($public.'__MACOSX');
                }
            }

            foreach ($listFile as $key => $domain) {
                
                $public = $root.$domain.'/public_html/';

                if(file_exists($public.'plugins/hethongdaily/info.xml')){
                    $info= @simplexml_load_file($public.'plugins/hethongdaily/info.xml');
                    
                    if($info->ver != $_GET['version']){
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

                            $updateDatabase = sendDataConnectMantan('https://'.$domain.'/installs/updateDatabase');

                            if($updateDatabase == '1'){
                                $domain_done[] = $domain;

                                echo '<br/><br/>Xử lý xong: '.$domain.'<br/>';die;
                            }else{
                                $domain_error[] = $domain;
                            }
                            
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
    }else{
        return $controller->redirect('/plugins/admin/data_crm-views-admin-listRegAdmin');
    }
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

function deleteRegAdmin($input)
{
    global $controller;

    $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');
    
    if(!empty($_GET['id'])){
        $data = $modelRequestDatacrms->get($_GET['id']);
        
        if($data){
            // xóa thư mục code
            deleteDomain($data->domain);

            // xóa database
            deleteDatabase($data->user_db);

            // xóa bản ghi trong DB
            $modelRequestDatacrms->delete($data);
        }
    }
   
    return $controller->redirect('/plugins/admin/data_crm-views-admin-listRegAdmin');
}

function checkFolderDomain($input)
{
    global $controller;
    
    $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

    $root = __DIR__.'/../../../../../../';
    $listFile = list_files($root);

    $domain_error = [];

    if(!empty($listFile)){
        foreach ($listFile as $key => $domain) {
            $checkDomain = $modelRequestDatacrms->find()->where(['domain'=>$domain])->first();

            if(empty($checkDomain)){
                $domain_error[] = $domain;
            }
        }
    }

    echo implode('<br/>', $domain_error);die;
}

function addRegAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'thông tin datacrm';
    $mess = '';
    $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

    if(!empty($_GET['id'])){
        $data = $modelRequestDatacrms->find()->where(['id'=>$_GET['id']])->first();
        if(!empty($data)){
            if($isRequestPost){
                $dataSend = $input['request']->getData();
                $data->system_name = @$dataSend['system_name'];
                $data->boss_name = @$dataSend['boss_name'];
                $data->boss_phone = @$dataSend['boss_phone'];
                $data->boss_email = @$dataSend['boss_email'];
                $data->domain = @$dataSend['domain'];

                $modelRequestDatacrms->save($data);
                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            }
            setVariable('mess', $mess);
            setVariable('data', $data);
        }else{
            return $controller->redirect('/plugins/admin/data_crm-views-admin-listRegAdmin');
        }
    }else{
        return $controller->redirect('/plugins/admin/data_crm-views-admin-listRegAdmin');
    }
}
?>