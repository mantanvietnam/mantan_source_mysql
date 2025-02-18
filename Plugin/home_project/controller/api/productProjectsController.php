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
