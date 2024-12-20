<?php 



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


        if (!empty($project->id_kind)) {
            $listKind = $modelCategories->find()
                ->where(['id' => $project->id_kind])
                ->first();
        } else {
            $listKind = null; 
        }
        
   
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