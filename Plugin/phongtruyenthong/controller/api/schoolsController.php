<?php
function getInfoSchoolAPI($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;
    global $modelCategories;

    $conditions = array('key_word' => 'infoSchoolAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $conditions = array('type' => 'school_year');
    $listYear = $modelCategories->find()->where($conditions)->all()->toList();

    $data_value['listYear'] = [];
    if(!empty($listYear)){
        foreach ($listYear as $key => $value) {
            $data_value['listYear'][] = ['id'=>$value->id, 'name'=>$value->name];
        }
    }

    return $data_value;
}