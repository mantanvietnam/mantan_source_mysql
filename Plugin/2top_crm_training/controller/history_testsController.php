<?php 
function listHistoryTestCRM($input)
{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Lịch sử thi';

	$modelHistoryTests = $controller->loadModel('Historytests');
    $modelCustomers = $controller->loadModel('Customers');
    $modelTests = $controller->loadModel('Tests');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;

    if(!empty($_GET['order_by_point'])){
        switch ($_GET['order_by_point']) {
            case 'point_z_a': $order['point'] = 'desc';break;
            case 'point_a_z': $order['point'] = 'asc';break;
        }
    }

    if(!empty($_GET['order_by_time_end'])){
        switch ($_GET['order_by_time_end']) {
            case 'time_end_z_a': $order['time_end'] = 'desc';break;
            case 'time_end_a_z': $order['time_end'] = 'asc';break;
        }
    }

    if(empty($order)){
        $order = array('id'=>'desc');
    }

    if(!empty($_GET['id_customer'])){
        $conditions['id_customer'] = (int) $_GET['id_customer'];
    }

    if(!empty($_GET['id_test'])){
        $conditions['id_test'] = (int) $_GET['id_test'];
    }

    $listData = $modelHistoryTests->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    
    if(!empty($listData)){
        $listTest = array();
        $listCustomer = array();
    	foreach ($listData as $key => $value) {
            if(empty($listCustomer[$value->id_customer])){
                $listCustomer[$value->id_customer] = $modelCustomers->get($value->id_customer);

                if($listCustomer[$value->id_customer]->id_parent > 0){
                    $parent = $modelCustomers->get($listCustomer[$value->id_customer]->id_parent);

                    $listCustomer[$value->id_customer]->name_parent = @$parent->full_name;
                }
            }

            if(empty($listTest[$value->id_test])){
                $listTest[$value->id_test] = $modelTests->get($value->id_test);
            }

            $listData[$key]->name_test = @$listTest[$value->id_test]->title;
            $listData[$key]->customer = $listCustomer[$value->id_customer];

    	}
    }
    

    // phân trang
    $totalData = $modelHistoryTests->find()->where($conditions)->all()->toList();
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

function deleteHistoryTestCRM($input){
    global $controller;

    $modelHistoryTests = $controller->loadModel('Historytests');
    
    if(!empty($_GET['id'])){
        $data = $modelHistoryTests->get($_GET['id']);
        
        if($data){
            $modelHistoryTests->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/2top_crm_training-view-admin-history-listHistoryTestCRM');
}
?>