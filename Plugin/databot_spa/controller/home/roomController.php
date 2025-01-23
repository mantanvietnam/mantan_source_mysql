<?php 
function listRoom($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách Phòng';
    
    if(!empty(checkLoginManager('listRoom', 'room'))){
        $mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestRoom':
                    $mess= '<p class="text-danger">Bạn cần tạo phòng trước</p>';
                    break;
            }
        }

        $infoUser = $session->read('infoUser');
        
        $modelRoom = $controller->loadModel('Rooms');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idEdit'])){
                $data = $modelRoom->get( (int) $dataSend['idEdit']);
            }else{
                $data = $modelRoom->newEmptyEntity();
                $data->created_at = time();
            }

            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->status = 1;
            $data->id_spa = $session->read('id_spa');
            $data->id_member = $infoUser->id_member;

            $modelRoom->save($data);

            $mess= '<p class="text-success">Lưu thông tin thành công</p>';
        }

        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'));
        $listData = $modelRoom->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/');
    }
}

function deleteRoom($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa phòng';
    
    if(!empty(checkLoginManager('deleteRoom', 'room'))){
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
        return $controller->redirect('/');
    }
}
 ?>