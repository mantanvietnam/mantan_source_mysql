<?php 
function listLibrary($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Library';

    $modelLibrary = $controller->loadModel('Librarys');

    $conditions = array();
    $limit = 2;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelLibrary->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelLibrary->find()->where($conditions)->all()->toList();
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

function listAlbum($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;


    $conditions = array();
    $limit = 2;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    //$conditions['id_category'] = 41;

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
        $slug = explode('-', $slug);
        $count = count($slug)-1;
        $id = (int) $slug[$count];

        $data = $modelAlbums->find()->where(['id'=>$id])->first();

        $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->first();


        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
        setVariable('data', $data);
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/');
    }

}
 ?>
