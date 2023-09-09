<?php 

function categoryProject($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

	$modelProductProjects = $controller->loadModel('ProductProjects');
    $modelProduct = $controller->loadModel('Products');


	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;

    if(!empty($listData)){
        $kind[0] = $modelCategories->newEmptyEntity();

    	foreach ($listData as $key => $value) {
    		if(empty($kind[$value->id_kind])){
    			$kind[$value->id_kind] = $modelCategories->get( (int) $value->id_kind);
    		}
    		
    		$listData[$key]->name_category = (!empty($kind[$value->id_kind]->name))?$kind[$value->id_kind]->name:'';
    	}
    }
    
    $listData = $modelProductProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


 
    // phân trang
    $totalData = $modelProductProjects->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_kind');
    $listKind = $modelCategories->find()->where($conditions)->all()->toList();

    if(!empty($listData)){
        foreach($listData as $key => $value){
            if(!empty($value->id_kind)){
                $infoKind = $modelCategories->find()->where(['id'=> $value->id_kind])->first();
                $listData[$key]->infoKind = $infoKind;
            }   
           
        }
    }    

    if(!empty($listData)){
        foreach($listData as $key => $value){
            if(!empty($value->id_product)){
                $arrProductID = explode(',', $value->id_product);
                $listData[$key]->infoProduct = [];
                foreach($arrProductID as $item){
                    $infoProduct = $modelProduct->find()->where(['id'=> (int)$item])->first();
                    $listData[$key]->infoProduct[(int)$item] = $infoProduct;                  
                }
            }   
           
        }
    }    

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
    setVariable('listKind', $listKind);

}


?>