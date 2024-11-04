<?php 
function listcategorydiet($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách';

    $modelcategorydiet = $controller->loadModel('categorydiet');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    
    $listData = $modelcategorydiet->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelcategorydiet->find()->where($conditions)->all()->toList();
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
function addcategorydiet($input){
global $controller;
global $isRequestPost;
global $modelCategories;
global $metaTitleMantan;
$metaTitleMantan = 'Thông tin tin tức';
$modelcategorydiet = $controller->loadModel('categorydiet');
$mess= '';
// lấy data edit
if(!empty($_GET['id'])){
    $data = $modelcategorydiet->get( (int) $_GET['id']);
}else{
    $data = $modelcategorydiet->newEmptyEntity();
}

if ($isRequestPost) {
    $dataSend = $input['request']->getData();

    if(!empty($dataSend['name'])){
        
        $data->name = $dataSend['name'];
        $data->image = $dataSend['image'];
        $data->nameen = $dataSend['nameen'];
        $modelcategorydiet->save($data);   
        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }else{
        $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
    }
}
setVariable('data', $data);
setVariable('mess', $mess);
}
function deletecategorydiet($input){
global $controller;

$modelcategorydiet = $controller->loadModel('categorydiet');

if(!empty($_GET['id'])){
    $data = $modelcategorydiet->get($_GET['id']);
    
    if($data){
        $modelcategorydiet->delete($data);
    }
}

return $controller->redirect('/plugins/admin/colennao-view-admin-post-listcategorydiet');
}


?>