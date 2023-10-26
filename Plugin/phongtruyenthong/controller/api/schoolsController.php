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
        $data_value['info'] = nl2br($data_value['info']);

        // thông tin thành tích nhà trường
        $data_value['des_achievement_1'] = nl2br($data_value['des_achievement_1']);
        $data_value['des_achievement_2'] = nl2br($data_value['des_achievement_2']);
        $data_value['des_achievement_3'] = nl2br($data_value['des_achievement_3']);

        // thông tin hiệu trưởng nhà trường
        $data_value['des_principal_1'] = nl2br($data_value['des_principal_1']);
        $data_value['des_principal_2'] = nl2br($data_value['des_principal_2']);
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