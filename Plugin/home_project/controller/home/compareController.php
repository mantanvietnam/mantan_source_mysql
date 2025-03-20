<?php 

function compare($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'So sánh bất động sản Vinhomes';

    $modelProductProjects = $controller->loadModel('ProductProjects');

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
                'map' => $project->map,
                'acreage' => $project->acreage,
                'investor' => $project->investor,
                'apart_type' => !empty($apartType) ? $apartType->name : '',
                'direction' => $project->direction,
                'ownership_type' => $project->ownership_type,
                'images' => $images,
                'preferential_policy' => $project->preferential_policy,
                'construction_density' => $project->construction_density,
                'construction_date' => $project->construction_date,
                'studio_apartment' => $project->studio_apartment,
                'key_amenities' => $project->key_amenities

            ];
            
            $compareData[] = $projectData;
        }
    }
    
    $allProjects = $modelProductProjects->find()
        ->select(['id', 'name', 'status', 'image'])
        ->order(['id' => 'DESC'])
        ->all()
        ->toList();
    
    
    // Gửi dữ liệu ra view
    setVariable('compareData', $compareData);
    setVariable('allProjects', $allProjects);
}
?>