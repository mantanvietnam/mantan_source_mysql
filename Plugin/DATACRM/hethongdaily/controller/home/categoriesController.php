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
    global $maxExport;
    global $numberExport;

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
                $description = array('convertPoint'=> (int)@$dataSend['convertPoint'],
                                    'max_export_mmtc'=>(int) @$dataSend['max_export_mmtc'],
                                    'price_export_mmtc'=>(int) @$dataSend['price_export_mmtc'],
                                    'point_introduce_user'=>(int) @$dataSend['point_introduce_user'],
                                    'point_wall_post'=>(int) @$dataSend['point_wall_post'],
                                    'point_feedback'=>(int) @$dataSend['point_feedback'],
                                    'point_expor_numerology'=>(int) @$dataSend['point_expor_numerology'],
                                    'point_deposit_money'=>(int) @$dataSend['point_deposit_money'],
                                    'point_complete_quiz'=>(int) @$dataSend['point_complete_quiz'],
                                    );
                $data->description = json_encode($description);


                $modelCategories->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                $info_customer = $session->read('infoUser');
                $info_customer->info_system = $data;
                $session->write('infoUser', $info_customer);
                $data = $modelCategories->find()->where(array('id'=>$session->read('infoUser')->id_system ))->first();
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }

        if(!empty($data->description)){
        $description = json_decode($data->description, true);
        $data->convertPoint = (int)@$description['convertPoint'];
        $data->max_export_mmtc = (int)@$description['max_export_mmtc'];
        $data->price_export_mmtc =(int) @$description['price_export_mmtc'];
        $data->point_introduce_user =(int) @$description['point_introduce_user'];
        $data->point_wall_post =(int) @$description['point_wall_post'];
        $data->point_feedback =(int) @$description['point_feedback'];
        $data->point_expor_numerology =(int) @$description['point_expor_numerology'];
        $data->point_deposit_money =(int) @$description['point_deposit_money'];
        $data->point_complete_quiz =(int) @$description['point_complete_quiz'];
        }
       


        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('maxExport', $maxExport);
        setVariable('numberExport', $numberExport);
    }else{
        return $controller->redirect('/login');
    }
}
?>