<?php 
// function projectDetail($input)
// {
	
// 	global $controller;
// 	global $urlCurrent;
//     global $metaTitleMantan;
//     global $modelCategories;

//     $metaTitleMantan = 'Chi tiết dự án';

// 	$modelProductProjects = $controller->loadModel('ProductProjects');

// 	$conditions = array();
// 	$limit = 20;
// 	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
// 	if($page<1) $page = 1;
//     $order = array('id'=>'asc');

//     if(!empty($_GET['id'])){
//         $conditions['id'] = (int) $_GET['id'];
//     }

//     if(!empty($_GET['name'])){
//         $conditions['name LIKE'] = '%'.$_GET['name'].'%';
//     }

//     if(!empty($_GET['status'])){
//         $conditions['status'] = $_GET['status'];
//     }

//     if(!empty($listData)){
//         $kind[0] = $modelCategories->newEmptyEntity();

//     	foreach ($listData as $key => $value) {
//     		if(empty($kind[$value->id_kind])){
//     			$kind[$value->id_kind] = $modelCategories->get( (int) $value->id_kind);
//     		}
    		
//     		$listData[$key]->name_category = (!empty($kind[$value->id_kind]->name))?$kind[$value->id_kind]->name:'';
//     	}
//     }
    
//     $listData = $modelProductProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
//     // phân trang
//     $totalData = $modelProductProjects->find()->where($conditions)->all()->toList();
//     $totalData = count($totalData);

//     $balance = $totalData % $limit;
//     $totalPage = ($totalData - $balance) / $limit;
//     if ($balance > 0)
//         $totalPage+=1;

//     $back = $page - 1;
//     $next = $page + 1;
//     if ($back <= 0)
//         $back = 1;
//     if ($next >= $totalPage)
//         $next = $totalPage;

//     if (isset($_GET['page'])) {
//         $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
//         $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
//     } else {
//         $urlPage = $urlCurrent;
//     }
//     if (strpos($urlPage, '?') !== false) {
//         if (count($_GET) >= 1) {
//             $urlPage = $urlPage . '&page=';
//         } else {
//             $urlPage = $urlPage . 'page=';
//         }
//     } else {
//         $urlPage = $urlPage . '?page=';
//     }

//     $conditions = array('type' => 'category_kind');
//     $listKind = $modelCategories->find()->where($conditions)->all()->toList();
//     setVariable('page', $page);
//     setVariable('totalPage', $totalPage);
//     setVariable('back', $back);
//     setVariable('next', $next);
//     setVariable('urlPage', $urlPage);
//     setVariable('totalData', $totalData);
//     setVariable('listData', $listData);
//     setVariable('listKind', $listKind);

// }




function projectDetail($input)
{
	global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;
    global $modelProduct;


    $metaTitleMantan = 'Chi tiết sản phẩm';;

	$modelProductProjects = $controller->loadModel('ProductProjects');
    $order = array('id'=>'desc');
    $modelProduct = $controller->loadModel('Products');
   
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }
    }
    


    $conditions['status'] = 'active';
    
    $project = $modelProductProjects->find()->where($conditions)->first();

    if(!empty($project)){
        $metaTitleMantan = $project->name;
        $metaImageMantan = $project->image;
        $metaDescriptionMantan = $project->description;
        
        $project->images = json_decode($project->images, true);

        // DANH MỤC Thể loại
        $listKind = $modelCategories->find()->where(['id'=>$project->id_kind])->first();
   
        if(!empty($project->id_kind)){
            $infoKind = $modelCategories->find()->where(['id'=> $project->id_kind])->first();
            $project->infoKind = $infoKind;
        }    
     
    

            if(!empty($project->id_product)){
                $arrProductID = explode(',', $project->id_product);
                $project->infoProduct = [];
                foreach($arrProductID as $item){
                    $infoProduct = $modelProduct->find()->where(['id'=> (int)$item])->first();
                    $project->infoProduct[(int)$item] = $infoProduct;                  
                }
            }       

        $listDataproduct_projects= $modelProductProjects->find()->limit(3)->order($order)->all()->toList();
        setVariable('listDataproduct_projects', $listDataproduct_projects);
        setVariable('project', $project);
        setVariable('listKind', $listKind);

        
    }else{
        return $controller->redirect('/');
    }
    
}