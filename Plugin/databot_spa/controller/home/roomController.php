<?php 
function listRoom($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh Phòng';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idEdit'])){
                $data = $modelRoom->get( (int) $dataSend['idEdit']);
            }else{
                $data = $modelRoom->newEmptyEntity();
            }
            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->status = 1;
            $data->id_spa = $infoUser->id_spa;
            $data->id_member = $infoUser->id_member;

            $modelRoom->save($data);

        }

        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$infoUser->id_spa);
        $listData = $modelRoom->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteRoom($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            $data = $modelRoom->find()->where($conditions)->first();
            if(!empty($data)){
                $modelRoom->delete($data);
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}
 ?>