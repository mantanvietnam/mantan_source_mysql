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
            $infoCategory->keyword = $dataSend['keyword'];
            $infoCategory->status = 'active';
            $infoCategory->description = $dataSend['description'];
            $infoCategory->type = 'system_positions';
            $infoCategory->slug = createSlugMantan($infoCategory->name);
            

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'system_positions', 'parent'=>$session->read('infoUser')->id_system, 'status'=>'active');
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

function deleteCategoryPosition($input){
    global $controller;
    global $session;

    global $modelCategories;
    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id'])){
            $data = $modelCategories->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelCategories->save($data);
                //deleteSlugURL($data->slug);
            }
        }

    // return $controller->redirect('/listProductAgency');

    }else{
        return $controller->redirect('/login');
    }
}

function settingSystem($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;

    $metaTitleMantan = 'Cài đặt hệ thống';
    
    if(!empty($session->read('infoUser'))){
        $mess = '';

        $data = $modelCategories->find()->where(array('id'=>$session->read('infoUser')->id_system ))->first();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                $data->name = $dataSend['name'];
                $data->image = $dataSend['image'];
                $data->keyword = $dataSend['keyword'];

                $modelCategories->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                $info_customer = $session->read('infoUser');
                $info_customer->info_system = $data;
                $session->write('infoUser', $info_customer);
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}
?>