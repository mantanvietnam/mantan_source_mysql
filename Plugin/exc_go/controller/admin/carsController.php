<?php
function listCarAdmin($input)
{
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách xe';

	$modelCars = $controller->loadModel('Cars');
    $modelMembers = $controller->loadModel('Members');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name_car'])){
        $conditions['name_car LIKE'] = '%'.$_GET['name_car'].'%';
    }

    if(!empty($_GET['license_plates'])){
        $conditions['license_plates LIKE'] = '%'.$_GET['license_plates'].'%';
    }

    if(!empty($_GET['imge'])){
        $conditions['imge'] = $_GET['imge'];
    }

    if(!empty($_GET['type_car'])){
        $conditions['type_car'] = $_GET['type_car'];
    }

    if(!empty($_GET['type_book'])){
        $conditions['type_book'] = $_GET['type_book'];
    }

    if(!empty($_GET['price_min'])){
        $conditions['price_min'] = $_GET['price_min'];
    }

    if(!empty($_GET['price_max'])){
        $conditions['price_max'] = $_GET['price_max'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }
    
    $listData = $modelCars->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach($listData as $key => $value){
            if(!empty($value->id_member)){
                $infoMember = $modelMembers->find()->where(['id'=> $value->id_member])->first(); 
                $listData[$key]->infoMember = $infoMember;
            }
        }
    }   

    // phân trang
    $totalData = $modelCars->find()->where($conditions)->all()->toList();
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

?>