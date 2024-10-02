<?php 

function listmyplane($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách ';
    $modelmyplane = $controller->loadModel('myplane');
    $modeluserpeople = $controller->loadModel('userpeople');
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
    
    $listData = $modelmyplane->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelmyplane->find()->where($conditions)->all()->toList();
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
function addmyplane($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm myplane';
    $modelmyplane = $controller->loadModel('myplane');
    $modelbreakfast = $controller->loadModel('breakfast');
    $modeluserpeople = $controller->loadModel('userpeople');
    $modellunch = $controller->loadModel('lunch');
    $modeldinner = $controller->loadModel('dinner');
    $modelsnacks = $controller->loadModel('snacks');
    $mess= '';
    $listDatamyplane =  $modelmyplane->find()->all()->toList();
    $listDatabreakfast =  $modelbreakfast->find()->all()->toList();
    $listDatauserpeople =  $modeluserpeople->find()->all()->toList();
    $listDatalunch =  $modellunch->find()->all()->toList();
    $listDatadinner =  $modeldinner->find()->all()->toList();
    $listDatasnacks =  $modelsnacks->find()->all()->toList();
    if (!empty($_GET['id'])) {
        $data = $modelmyplane->get((int)$_GET['id']);
    } else {
        $data = $modelmyplane->newEmptyEntity();
    }
    
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['id_userpeople'])) {
            $data->id_userpeople = $dataSend['id_userpeople'];
            $data->id_breakfast = $dataSend['id_breakfast'];
            $data->id_lunch = $dataSend['id_lunch'];
            $data->id_dinner = $dataSend['id_dinner'];
            $data->id_snack = $dataSend['id_snack'];
            $data->water = $dataSend['water'];
            $data->meal = $dataSend['meal'];
            $data->workout = $dataSend['workout'];
            $data->day = $dataSend['day'];
            $modelmyplane->save($data);
            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }
    }
    setVariable('listDatabreakfast', $listDatabreakfast);
    setVariable('listDatamyplane', $listDatamyplane);
    setVariable('listDatauserpeople', $listDatauserpeople);
    setVariable('listDatalunch', $listDatalunch);
    setVariable('listDatadinner', $listDatadinner);
    setVariable('listDatasnacks', $listDatasnacks);
    setVariable('data', $data);
    setVariable('mess', $mess);
}


?>