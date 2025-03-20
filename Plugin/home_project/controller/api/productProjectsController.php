<?php

function searchProjectAPI()
{
    global $isRequestPost;
    global $controller;

    $return = array();
    $modelProject = $controller->loadModel('ProductProjects');

    $dataSend = $_REQUEST;

    $conditions = [];

    if (!empty($dataSend['term'])) {
        $conditions['OR'] = [
            'name LIKE' => '%' . $dataSend['term'] . '%',
        ];
    }

    if (!empty($dataSend['id'])) {
        $conditions['id'] = (int) $dataSend['id'];
    }

    $listData = $modelProject->find()->where($conditions)->all()->toList();

    if ($listData) {
        foreach ($listData as $data) {
            $return[] = array(
                'label' => $data->name . ' (' . $data->id . ')',
                'id' => $data->id,
                'value' => $data->id,
                'name' => $data->name,
                'code' => $data->code,
                'location' => $data->location,
                'status' => $data->status,
            );
        }
    } else {
        $return = array(
            array(
                'id' => 0,
                'label' => 'Không tìm thấy dự án',
                'value' => '',
            )
        );
    }

    return $return;
}

function getProjectDetailsAPI()
{
    global $controller;
    global $modelCategories;

    $return = array();
    $modelProductProjects = $controller->loadModel('ProductProjects');

    $dataSend = $_REQUEST;

    if (!empty($dataSend['id'])) {
        $projectId = (int) $dataSend['id'];

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

            $return = [
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

        } else {
            $return = [
                'error' => true,
                'message' => 'Không tìm thấy dự án'
            ];
        }
    } else {
        $return = [
            'error' => true,
            'message' => 'Thiếu ID dự án'
        ];
    }

    return $return;
}

function addProductProjectAPI($input) {
    global $controller;
    global $isRequestPost;
    global $modelCategories;

    $return = array();

    if($isRequestPost){
        $modelProductProjects = $controller->loadModel('ProductProjects');
        
        $dataSend = $input['request']->getData();
       
        $idProjectEdit = isset($dataSend['id']) ? (int) $dataSend['id'] : 0;
        
        if(!empty($dataSend['name'])){
            // Lấy data edit hoặc tạo mới
            if ($idProjectEdit > 0) {
                $data = $modelProductProjects->get($idProjectEdit);
                $data->images = json_decode($data->images, true);
            } else {
                $data = $modelProductProjects->newEmptyEntity();
            }
            
            // Xử lý dữ liệu
            $data->name = $dataSend['name'];
            $data->address = $dataSend['address'];
            $data->status = $dataSend['status'];
            $data->id_kind = $dataSend['id_kind'];
            $data->id_apart_type = $dataSend['id_apart_type'];
            $data->map = $dataSend['map'];
            $data->investor = $dataSend['investor'];
            $data->direction = $dataSend['direction'];
            $data->ownership_type = $dataSend['ownership_type'];
            $data->preferential_policy = $dataSend['preferential_policy'];
            $data->construction_density = $dataSend['construction_density'];
            $data->construction_date = $dataSend['construction_date'];
            $data->studio_apartment = $dataSend['studio_apartment'];
            $data->key_amenities = $dataSend['key_amenities'];
            $data->view_id = $dataSend['view_id'];
            $data->acreage = $dataSend['acreage'];
            
            // Xử lý ảnh chính
            if (!empty($_FILES['image']['name'])) {
                $upload = uploadImage('vinhome_', 'image', 'image_'.time().rand(0, 1000000));
                if (!empty($upload['linkOnline'])) {
                    $data->image = $upload['linkOnline'];
                }
            }
            
            // Xử lý danh sách ảnh
            $uploadedImages = [];
            
            if (!empty($_FILES['images']['name'][0])) {
                $user_id = 'vinhome_';
                
                foreach ($_FILES['images']['name'] as $key => $value) {
                    $temp_file = [
                        'name' => $_FILES['images']['name'][$key],
                        'type' => $_FILES['images']['type'][$key],
                        'tmp_name' => $_FILES['images']['tmp_name'][$key],
                        'error' => $_FILES['images']['error'][$key],
                        'size' => $_FILES['images']['size'][$key]
                    ];
                    
                    $_FILES['temp_image'] = $temp_file;
                    
                    $upload = uploadImage($user_id, 'temp_image', 'image_'.time().rand(0,1000000));
                    
                    if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                        $uploadedImages[] = $upload['linkOnline'];
                    }
                }
            } else {
                $uploadedImages = !empty($data->images) ? (is_array($data->images) ? $data->images : json_decode($data->images, true)) : [];
            }
            
            if (!empty($_FILES['img_premises']['name'])) {
                $upload = uploadImage('vinhome_', 'img_premises', 'image_'.time().rand(0, 1000000));
                if (!empty($upload['linkOnline'])) {
                    $uploadedImages['img_premises'] = $upload['linkOnline'];
                }
            } else {
                if (!empty($data->images['img_premises'])) {
                    $uploadedImages['img_premises'] = $data->images['img_premises'];
                }
            }
            
            $formattedImages = [];
            $index = 1;
            foreach ($uploadedImages as $key => $imageUrl) {
                if ($key === 'img_premises') {
                    $formattedImages[$key] = $imageUrl;
                } else {
                    $formattedImages[$index++] = $imageUrl;
                }
            }
            
            $data->images = json_encode($formattedImages);
            
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;
            
            if(empty($data->slug) || $data->slug != $slugNew){
                do{
                    $conditions = array('slug' => $slugNew);
                    $listData = $modelProductProjects->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
                    
                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));
            }
            $data->slug = $slugNew;
           
            
            if ($modelProductProjects->save($data)) {
                if (!empty($dataSend['productItems'])) {
                    $modelCommerce = $controller->loadModel('Commerce');
                    
                    $productItems = json_decode($dataSend['productItems'], true);
                    if (is_array($productItems)) {
                        foreach ($productItems as $item) {
                            $newItem = $modelCommerce->newEmptyEntity();
                            $newItem->id_product = $data->id;
                            $newItem->main_title = isset($item['main_title']) ? $item['main_title'] : '';
                            $newItem->view_type = isset($item['view_type']) ? $item['view_type'] : "";
                            $newItem->main_view_id = isset($item['main_view_id']) ? $item['main_view_id'] : "";
            
                            $modelCommerce->save($newItem);
                        }
                    }else {
                        $return = array(
                            'success' => false,
                            'message' => 'Lỗi: productItems không đúng định dạng JSON.'
                        );
                        return $return;
                    }
                }
                
                $project = $modelProductProjects->get($data->id);
                $project->images = json_decode($project->images, true);
                
                $modelCommerce = $controller->loadModel('Commerce');
                $productItems = $modelCommerce->find()
                    ->where(['id_product' => $data->id])
                    ->all()
                    ->toArray();
                
                $return = array(
                    'success' => true,
                    'message' => 'Lưu dữ liệu thành công',
                    'project' => $project,
                    'projectId' => $data->id,
                    'productItems' => $productItems
                );
            } else {
                $return = array(
                    'success' => false,
                    'message' => 'Không thể lưu dữ liệu dự án'
                );
            }
        } else {
            $return = array(
                'success' => false,
                'message' => 'Bạn chưa nhập đầy đủ thông tin'
            );
        }
    } else {
        $return = array(
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ'
        );
    }
    
    return $return;
}