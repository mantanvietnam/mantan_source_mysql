<?php 

function compare($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'So sánh bất động sản Vinhomes';

    $modelProductProjects = $controller->loadModel('ProductProjects');
    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');

    $compareData = [];
    
    $projectIds = [];
    if (!empty($_GET['project1'])) {
        $projectIds[] = (int) $_GET['project1'];
    }
    if (!empty($_GET['project2'])) {
        $projectIds[] = (int) $_GET['project2'];
    }
    if (!empty($_GET['project3'])) {
        $projectIds[] = (int) $_GET['project3'];
    }
    
    foreach ($projectIds as $projectId) {
        $project = $modelProductProjects->find()->where(['id' => $projectId])->first();
        
        if (!empty($project)) {
            $images = !empty($project->images) ? json_decode($project->images, true) : [];
            $officially = !empty($project->officially) ? json_decode($project->officially, true) : [];
            
            $kindCategory = null;
            if (!empty($project->id_kind)) {
                $kindCategory = $modelCategories->find()->where(['id' => $project->id_kind])->first();
            }
            
            $apartType = null;
            if (!empty($project->id_apart_type)) {
                $apartType = $modelCategories->find()->where(['id' => $project->id_apart_type])->first();
            }
            
            $projectData = [
                'id' => $project->id,
                'name' => $project->name,
                'image' => $project->image,
                'kind' => !empty($kindCategory) ? $kindCategory->name : '',
                'address' => $project->address,
                'description' => $project->description,
                'status' => $project->status,
                'map' => $project->map,
                'text_location' => $project->text_location,
                'acreage' => $project->acreage,
                'officially' => $officially,
                'investor' => $project->investor,
                'apart_type' => !empty($apartType) ? $apartType->name : '',
                'direction' => $project->direction,
                'ownership_type' => $project->ownership_type,
                'ecological_space' => $project->ecological_space,
                'utility_services' => $project->utility_services,
                'price' => $project->price,
                'images' => $images
            ];
            
            $commerceData = $modelCommerce->find()->where(['id_product' => $project->id])->first();
            if (!empty($commerceData)) {
                $projectData['commerce'] = [
                    'main_title' => $commerceData->main_title,
                    'main_description' => $commerceData->main_description,
                    'view_type' => $commerceData->view_type
                ];
                
                $commerceItems = $modelCommerceItems->find()->where(['id_commerce' => $commerceData->id])->all()->toList();
                $projectData['amenities'] = [];
                
                foreach ($commerceItems as $item) {
                    $projectData['amenities'][] = [
                        'title' => $item->title,
                        'description' => $item->description,
                        'image' => $item->image
                    ];
                }
            }
            
            $compareData[] = $projectData;
        }
    }
    
    $allProjects = $modelProductProjects->find()
        ->select(['id', 'name', 'status', 'image'])
        ->order(['id' => 'DESC'])
        ->all()
        ->toList();
    
    $compareFeatures = [
        'price' => 'Giá niêm yết',
        'acreage' => 'Diện tích',
        'direction' => 'Hướng',
        'investor' => 'Chủ đầu tư',
        'ownership_type' => 'Loại sở hữu',
        'status' => 'Tình trạng'
    ];
    
    $locationFeatures = [
        'address' => 'Địa chỉ',
        'text_location' => 'Khu vực'
    ];
    
    setVariable('compareData', $compareData);
    setVariable('allProjects', $allProjects);
    setVariable('compareFeatures', $compareFeatures);
    setVariable('locationFeatures', $locationFeatures);
}
?>