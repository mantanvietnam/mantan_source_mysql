<?php 
function listPosition($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;

    $metaTitleMantan = 'Chức vụ hệ thống';
    $modelMembers = $controller->loadModel('Members');

    if(!empty($session->read('infoUser'))){
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
                $infoCategory = $modelCategories->find()->where(['id'=>(int) $dataSend['idCategoryEdit'], 'parent'=>$session->read('infoUser')->id_system])->first();

                if(empty($infoCategory)){
                    $infoCategory = $modelCategories->newEmptyEntity();
                }
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->parent = $session->read('infoUser')->id_system;
            $infoCategory->image = '';
            $infoCategory->keyword = '';
            $infoCategory->description = '';
            $infoCategory->type = 'system_positions';
            $infoCategory->slug = createSlugMantan($infoCategory->name);
            

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $members = $modelMembers->find()->where(['id_position'=>$value->id])->all()->toList();
                $listData[$key]->number_member = count($members);
            }
        }

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}
?>