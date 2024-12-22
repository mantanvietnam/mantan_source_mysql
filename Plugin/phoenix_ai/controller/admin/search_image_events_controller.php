<?php
function listAISearchImageAdmin($input)
{
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $mess = '';
    
    $metaTitleMantan = 'AI tìm kiếm ảnh sự kiện';

    $modelSearchImageEvents = $controller->loadModel('SearchImageEvents');
    $modelMembers = $controller->loadModel('Members');
    
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    
    $listData = $modelSearchImageEvents->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    

    // phân trang
    $totalData = $modelSearchImageEvents->find()->where($conditions)->all()->toList();
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
    setVariable('mess', $mess);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}


function deleteSearchImageEventAdmin($input)
{
    global $controller;
    global $session;

    $modelSearchImageEvents = $controller->loadModel('SearchImageEvents');
    
    if(!empty($_GET['id'])){
        $data = $modelSearchImageEvents->get($_GET['id']);
        
        if($data){
            deleteAISearchImage($data->collection_ai);

            $modelSearchImageEvents->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/phoenix_ai-view-admin-ai_search_image-listAISearchImageAdmin');
    
}

function deleteAllSearchImageEventAdmin($input)
{
    global $controller;
    global $session;

    $modelSearchImageEvents = $controller->loadModel('SearchImageEvents');
    
    $listData = $modelSearchImageEvents->find()->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $data) {
            deleteAISearchImage($data->collection_ai);

            $modelSearchImageEvents->delete($data);
        }
    }

    deleteAISearchImage('bac-thay-ai-1731472284');
    deleteAISearchImage('bac-thay-ai-1731472294');
    deleteAISearchImage('find-faces');
    deleteAISearchImage('tests');
    

    return $controller->redirect('/plugins/admin/phoenix_ai-view-admin-ai_search_image-listAISearchImageAdmin');
}