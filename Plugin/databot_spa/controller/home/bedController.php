<?php 
function listBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh Phòng';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');



        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idEdit'])){
                $data = $modelBed->get( (int) $dataSend['idEdit']);
            }else{
                $data = $modelBed->newEmptyEntity();
            }
            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->status = 1;
            $data->id_room = $dataSend['id_room'];
            $data->id_spa = $infoUser->id_spa;
            $data->id_member = $infoUser->id_member;
            $data->created_at = date('Y-m-d H:i:s');

            $modelBed->save($data);
            return $controller->redirect('/listBed');

        }
      
        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$infoUser->id_spa);
        $listData = $modelBed->find()->where($conditions)->order(['id_room'=>'desc'])->all()->toList();
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $room = $modelRoom->find()->where(['id'=>$value->id_room])->first();
                if(!empty($room)){
                    $listData[$key]->room = $room;
                }
            }
        }
        $listRoom = $modelRoom->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('listRoom', $listRoom);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteBed($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelBed = $controller->loadModel('Beds');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            $data = $modelBed->find()->where($conditions)->first();
            if(!empty($data)){
                $modelBed->delete($data);
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}
 ?>