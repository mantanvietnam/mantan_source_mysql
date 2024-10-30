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
    $modeluserpeople = $controller->loadModel('userpeople');
    $mess= '';
    $listDatamyplane =  $modelmyplane->find()->all()->toList();
    $listDatauserpeople =  $modeluserpeople->find()->all()->toList();
    if (!empty($_GET['id'])) {
        $data = $modelmyplane->get((int)$_GET['id']);
    } else {
        $data = $modelmyplane->newEmptyEntity();
    }
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            if (!empty($dataSend['day'])) {
                $alldata = array(); 
                
                foreach ($dataSend['day'] as $key => $dayValue) {
                    if (!empty($dayValue)) {

                        $alldata[$key] = array( 
                            'day' =>  $dayValue,
                            'water' => !empty($dataSend['water'][$key]) ? $dataSend['water'][$key] : 0,
                            'meal' => !empty($dataSend['meal'][$key]) ? $dataSend['meal'][$key] : 0,
                            'workout' => !empty($dataSend['workout'][$key]) ? $dataSend['workout'][$key] : 0,
                            'coutwater' => !empty($dataSend['coutwater'][$key]) ? $dataSend['coutwater'][$key] : 0,
                            'coutmeal' => !empty($dataSend['coutmeal'][$key]) ? $dataSend['coutmeal'][$key] : 0,
                            'coutworkout' => !empty($dataSend['coutworkout'][$key]) ? $dataSend['coutworkout'][$key] : 0,
                        );
                    }
                }
    

                $data->alldata = json_encode($alldata);
            }
    

            $modelmyplane->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        }
    }
    $alldata = json_decode($data->alldata, true);
    setVariable('alldata', $alldata);
    setVariable('listDatamyplane', $listDatamyplane);
    setVariable('listDatauserpeople', $listDatauserpeople);
    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deletemyplane($input){
    global $controller;

    $modelmyplane = $controller->loadModel('myplane');
    
    if(!empty($_GET['id'])){
        $data = $modelmyplane->get($_GET['id']);
        
        if($data){
            $modelmyplane->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-myplane-listmyplane');
}
function listmealtime($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $listfasting;
    $metaTitleMantan = 'Danh sách ';
    $modelmealtime = $controller->loadModel('mealtime');
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
    
    $listData = $modelmealtime->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelmealtime->find()->where($conditions)->all()->toList();
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
    setVariable('listfasting', $listfasting);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}
function addmealtime($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $listfasting;
    $metaTitleMantan = 'Thêm mealtime';
    $modelmealtime = $controller->loadModel('mealtime');
    $mess= '';
    $listDatamealtime =  $modelmealtime->find()->all()->toList();
    if (!empty($_GET['id'])) {
        $data = $modelmealtime->get((int)$_GET['id']);
    } else {
        $data = $modelmealtime->newEmptyEntity();
    }
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    
        if (!empty($dataSend['id_level'])) {
            $data->id_level = $dataSend['id_level'];
            $data->fasting = $dataSend['fasting'];
            $data->eating = $dataSend['eating'];

            $data->image = $dataSend['image'];
            $data->description1 = $dataSend['description1'];
            $data->description2 = $dataSend['description2'];
            $data->beginner = isset($dataSend['beginner']) ? 1 : 0; 
            $data->populer = isset($dataSend['populer']) ? 1 : 0;
            $modelmealtime->save($data);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        }
    }
    setVariable('listfasting', $listfasting);
    setVariable('listDatamealtime', $listDatamealtime);
    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deletemealtime($input){
    global $controller;

    $modelmealtime = $controller->loadModel('mealtime');
    
    if(!empty($_GET['id'])){
        $data = $modelmealtime->get($_GET['id']);
        
        if($data){
            $modelmealtime->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-mealtime-listmealtime');
}
?>