<?php
function requestExportFull($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách yêu cầu xuất bản đầy đủ';

    $modelRequestExports = $controller->loadModel('RequestExports');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['status_pay'])){
        $conditions['status_pay'] = $_GET['status_pay'];
    }

    if(!empty($_GET['email'])){
        $conditions['email'] = $_GET['email'];
    }
    
    $listData = $modelRequestExports->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelRequestExports->find()->where($conditions)->all()->toList();
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

function deleteRequestExport($input){
    global $controller;

    $modelRequestExports = $controller->loadModel('RequestExports');
    
    if(!empty($_GET['id'])){
        $data = $modelRequestExports->get($_GET['id']);
        
        if($data){
            $modelRequestExports->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/matmathanhcong-view-admin-requestExportFull');
}

function sendFullMMTCAdmin($input)
{
    global $controller;

    $modelRequestExports = $controller->loadModel('RequestExports');

    if(!empty($_GET['id'])){
        $data = $modelRequestExports->get($_GET['id']);
        
        if($data){
            process_send_link($_GET['id']);
        }
    }

    return $controller->redirect('/plugins/admin/matmathanhcong-view-admin-requestExportFull');
}

function settingMMTCAPI($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt MMTC';
    $mess= '';

    $conditions = array('key_word' => 'settingMMTCAPI');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'userAPI' => $dataSend['userAPI'],
                        'passAPI' => $dataSend['passAPI'],
                        'maxExport' => (int) $dataSend['maxExport'],
                        'numberExport' => (int) $dataSend['numberExport'],

                        'price' => (int) $dataSend['price'],
                        'note_pay' => $dataSend['note_pay'],
                        'number_bank' => $dataSend['number_bank'],
                        'account_bank' => $dataSend['account_bank'],
                        'key_bank' => $dataSend['key_bank'],
                        'idBot' => $dataSend['idBot'],
                        'tokenBot' => $dataSend['tokenBot'],
                        'idBlockConfirm' => $dataSend['idBlockConfirm'],
                        'idBlockDownload' => $dataSend['idBlockDownload'],
                    );

        $data->key_word = 'settingMMTCAPI';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data', $data_value);
    setVariable('mess', $mess);
}

function regenerateRequestAdmin($input){
   global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách yêu cầu xuất bản đầy đủ';

    $modelRequestExports = $controller->loadModel('RequestExports');  


    if(!empty($_GET['id'])){
        $data = $modelRequestExports->get($_GET['id']);

        if(empty($data->email)){
            $data->email ='ezpicsvn@gmail.com';
        }

        if(empty($data->address)){
            $data->address ='18 Thanh Bình, HN';
        }

        if(empty($data->avatar)){
            $data->avatar ='https://matmathanhcong.vn/upload/admin/files/avatar-trang-4.jpg';
        }

        $infoFull = getLinkFullMMTCAPI(@$data->name, @$data->birthday, @$data->phone, @$data->email, @$data->address, @$data->avatar, 1);
        
        $save = $modelRequestExports->get($_GET['id']);
        
        if(!empty($infoFull)){
            $save->link_download = @$infoFull;
            $modelRequestExports->save($save);
            
        }

        return $controller->redirect('/plugins/admin/matmathanhcong-view-admin-requestExportFull');
    }
    return $controller->redirect('/plugins/admin/matmathanhcong-view-admin-requestExportFull');
}

?>