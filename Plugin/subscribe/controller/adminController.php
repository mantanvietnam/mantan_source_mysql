<?php 
function list_subscribe($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đăng ký';

	$modelSubscribes = $controller->loadModel('Subscribes');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['email'])){
        $conditions['email'] = $_GET['email'];
    }
    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
        $listData = $modelSubscribes->find()->where($conditions)->order($order)->all()->toList();
        $titleExcel =   [
                            ['name'=>'ID', 'type'=>'text', 'width'=>10],
                            ['name'=>'Email', 'type'=>'text', 'width'=>25],               
                    ];

        $dataExcel = [];
        if(!empty($listData)){
            foreach ($listData as $key => $value) {                   
                $dataExcel[] = [
                            $value->id, 
                            $value->email, 
                                    
                            ];
            }
        }            
        export_excel($titleExcel, $dataExcel, 'danh-sach-email'.date('d-m-Y'));
    }else{
        $listData = $modelSubscribes->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }

    // phân trang
    $totalData = $modelSubscribes->find()->where($conditions)->all()->toList();
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
    
    setVariable('listData', $listData);
}

function delete_subscribe($input){
    global $controller;

    $modelSubscribes = $controller->loadModel('Subscribes');
    
    if(!empty($_GET['id'])){
        $data = $modelSubscribes->get($_GET['id']);
        
        if($data){
            $modelSubscribes->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/subscribe-view-admin-list_subscribe');
}