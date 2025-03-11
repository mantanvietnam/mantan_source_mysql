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

    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');
	$modelProductProjects = $controller->loadModel('ProductProjects');
    $order = array('id'=>'desc');
  
   
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
        $metaDescriptionMantan = strip_tags($project->description);
        
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
     
        if(!empty($project->id_apart_type)) {
            $listType = $modelCategories->find()
                ->where(['id' => $project->id_apart_type])
                ->first();
        } else {
            $listType = null; 
        }
        if(!empty($project->id_apart_type)){
            $infoType = $modelCategories->find()->where(['id'=> $project->id_apart_type])->first();
            $project->infoType = $infoType;
        }    
    
        // **Lấy dữ liệu từ Commerce**
        $commerceData = $modelCommerce->find()->where(['id_product' => $project->id])->all()->toList();
        $project->commerceData = $commerceData;

        // **Lấy dữ liệu từ CommerceItems**
        if (!empty($commerceData)) {
            foreach ($commerceData as $commerce) {
                $commerce->items = $modelCommerceItems->find()->where(['id_commerce' => $commerce->id])->all()->toList();
            }
        }

        $listDataproduct_projects= $modelProductProjects->find()->limit(3)->order($order)->all()->toList();
        setVariable('listDataproduct_projects', $listDataproduct_projects);
        setVariable('project', $project);
        setVariable('listKind', $listKind);
        setVariable('listType', $listType);

        
    }else{
        return $controller->redirect('/');
    }
    
}