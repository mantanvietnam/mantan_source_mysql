<?php 
// function categoryProject($input){
//     global $isRequestPost;
//     global $modelCategories;
//     global $metaTitleMantan;

//     $metaTitleMantan = 'Danh sách Loại dự án';

//     if ($isRequestPost) {
//         $dataSend = $input['request']->getData();
        
//         // tính ID category
//         if(!empty($dataSend['idCategoryEdit'])){
//             $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
//         }else{
//             $infoCategory = $modelCategories->newEmptyEntity();
//         }

//         // tạo dữ liệu save
//         $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
//         $infoCategory->parent = 0;
//         $infoCategory->image = $dataSend['image'];
//         $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
//         $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
//         $infoCategory->type = 'category_kind';

//         // tạo slug
//         $slug = createSlugMantan($infoCategory->name);
//         $slugNew = $slug;
//         $number = 0;
//         do{
//             $conditions = array('slug'=>$slugNew,'type'=>'category_kind');
//             $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

//             if(!empty($listData)){
//                 $number++;
//                 $slugNew = $slug.'-'.$number;
//             }
//         }while (!empty($listData));

//         $infoCategory->slug = $slugNew;

//         $modelCategories->save($infoCategory);

//     }

//     $conditions = array('type' => 'category_kind');
//     $listData = $modelCategories->find()->where($conditions)->all()->toList();

//     setVariable('listData', $listData);
// }


function categoryProject($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Dự án';

	$modelProductProjects = $controller->loadModel('ProductProjects');
    $modelProduct = $controller->loadModel('Products');


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

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

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