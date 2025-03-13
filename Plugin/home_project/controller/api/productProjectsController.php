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
    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');

    // Nhận dữ liệu từ request
    $dataSend = $_REQUEST;

    if (!empty($dataSend['id'])) {
        $projectId = (int) $dataSend['id'];

        $project = $modelProductProjects->find()->where(['id' => $projectId])->first();

        if (!empty($project)) {
            // Xử lý JSON
            $images = !empty($project->images) ? json_decode($project->images, true) : [];
            $officially = !empty($project->officially) ? json_decode($project->officially, true) : [];

            // Lấy thông tin danh mục cho loại dự án
            $kindCategory = null;
            if (!empty($project->id_kind)) {
                $kindCategory = $modelCategories->find()->where(['id' => $project->id_kind])->first();
            }

            // Lấy thông tin loại căn hộ
            $apartType = null;
            if (!empty($project->id_apart_type)) {
                $apartType = $modelCategories->find()->where(['id' => $project->id_apart_type])->first();
            }

            // Xử lý dữ liệu dự án
            $return = [
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

            // Lấy thông tin tiện ích qua bảng commerce
            $commerceData = $modelCommerce->find()->where(['id_product' => $project->id])->first();
            if (!empty($commerceData)) {
                $return['commerce'] = [
                    'main_title' => $commerceData->main_title,
                    'main_description' => $commerceData->main_description,
                    'view_type' => $commerceData->view_type
                ];

                // Lấy danh sách các tiện ích
                $commerceItems = $modelCommerceItems->find()->where(['id_commerce' => $commerceData->id])->all()->toList();
                $return['amenities'] = [];

                foreach ($commerceItems as $item) {
                    $return['amenities'][] = [
                        'title' => $item->title,
                        'description' => $item->description,
                        'image' => $item->image
                    ];
                }
            }
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